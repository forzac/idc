<?php
namespace frontend\models;

use Yii;
use yii\mongodb\ActiveRecord;

class Poster extends ActiveRecord
{
    private $db;
    private $controller;
    private $response = ["render" => "poster", "error" => 0, "message" => "", "data" => []];


    public static function collectionName()
    {
        return 'poster';
    }

    public function attributes()
    {
        return [
            '_id',
            'name',
            'description',
            'status'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'description'], 'required']
        ];
    }

    public function __construct(){
        $this->db = Yii::$app->db;
        //$this->isAjax = $isAjax;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public static function Initial()
    {
        return new Poster();
    }

    public function Run($mode)
    {

        if (Yii::$app->request->isAjax) {
            //$this->AjaxRun{}
        } else {
            if ($mode == 'poster') {
                $this->poster();
            }
            if ($mode == 'manager') {
                $this->response['data']['model'] = $this;
                $this->response['render'] = 'manager';
            }
        }
        return $this;
    }

    public function poster()
    {
        if (Yii::$app->request->post()) {
            $poster = new Poster();
            $poster->name = $_POST['name'];
            $poster->description = $_POST['description'];
            $poster->status = 0;
            if ($poster->save()) {
                $this->db->createCommand()->insert('poster', ['name' => 'poster'])->execute();
                $this->_id = $this->db->getLastInsertID();
                $this->actionPostExample($this->_id);
            }
        }
        $this->response['data']['model'] = $this;
    }

    public function actionPostExample($value)
    {
        $curl = new Curl();
        $response = $curl->setOption(
            CURLOPT_POSTFIELDS,
            http_build_query(array(
                    'id' => $value,
                    'type' => 'poster'
                )
            ))
            ->post('http://127.0.0.1:3000');
    }

}