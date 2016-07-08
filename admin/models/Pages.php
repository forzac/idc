<?php
/**
 * Created by PhpStorm.
 * User: Proger
 * Date: 08.07.2015
 * Time: 15:25
 */

namespace admin\models;
use Yii;

class Pages {
    public $publicVar;
    protected $protectedVar;
    private $privateVar;

    private $db;
    private $error;
    private $result;


    public static function Init()
    {
        return new Pages();
    }

    public function __construct()
    {
        $this->db = \Yii::$app->db;
    }
    public  function __destruct()
    {
        $this->db->close();
    }

    public  function getPages()
    {
        $pages = $this->db->createCommand("SELECT * FROM idc_pages")->queryAll();
        return $pages;

        /*  $pages = Yii::$app->db->createCommand("SELECT * FROM idc_pages")->queryALl();
          return $pages;*/
    }

} 