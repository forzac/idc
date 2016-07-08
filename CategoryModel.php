<?php
/**
	пример действия
**/

public function actionCategories($category_id = false, $mode = false)
{
    $response = CategoryModel::Initial($this)->Run($category_id, $mode)->getResponse();
	if(Yii::$app->request->isAjax){        
        echo json_encode($response["data"]);
		exit;
    }
	else{
        return $this->render($response['render'],["data"=>$response["data"]]);
    }    
}
?>

<?php

/**
	пример модели
**/

namespace admin\models;


use yii\base\ErrorException;
use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use admin\components\HandlingImage;
use yii\helpers\Html;
use yii\helpers\FileHelper;

class CategoryModel extends Model
{
    private $db;    
    private $controller;
    private $response = ["render"=>"categories/categories", "error"=>0, "message"=>"", "data"=>[]];

    public $status;
    public $age_verification;
    public $seo_keywords;
    public $seo_description;
    public $seo_title;
    public $description;
    public $category;
    public $seo_category;
    public $age_limit;
    public $age_message;
    public $category_id;
    public $file;

	public function __construct(&$controller){
        $this->db = Yii::$app->db;
        $this->isAjax = $isAjax;
        $this->controller = &$controller;
    }
	
    public function __destruct(){
        $this->db->close();
    }
	
    public static function Initial(&$controller){
        return new CategoryModel($controller);
	}

    public function scenarios()
    {
        return [
            'create' => ['seo_category', 'category', 'description','status', 'seo_keywords', 'seo_description', 'seo_title'],
            'edit' => ['seo_category', 'category', 'description','status', 'seo_keywords', 'seo_description', 'seo_title','age_limit', 'age_message', 'category_id', 'age_verification'],
            'ajax' => ['file'],
        ];
    }

    public function rules(){
		return [
			[['seo_keywords', 'seo_description', 'seo_title','description', 'category', 'seo_category'],'required', 'on' => 'edit'],
			[['seo_keywords', 'seo_description', 'seo_title','description', 'category', 'seo_category','age_message'],'filter', 'filter' => 'trim', 'on' => 'edit'],
			[['seo_category'],'match', 'pattern' => '/^[A-Za-z0-9а-яА-Я]+$/', 'on' => 'edit'],
			[['age_limit'],'integer', 'on' => 'edit'],
			[['category_id'],'integer', 'on' => 'edit'],
			[['status'], 'in', 'range' => ['on', false], 'on' => 'edit'],
			[['age_verification'], 'in', 'range' => ['on', false], 'on' => 'edit'],
			[['seo_category'],'match', 'pattern' => '/^[A-Za-z0-9а-яА-Я]+$/', 'on' => 'create'],
			['category', 'integer','on' => 'create'],
			[['seo_category', 'category', 'description','seo_keywords', 'seo_description', 'seo_title'], 'required', 'on' => 'create'],
			[['seo_category', 'category', 'description','seo_keywords', 'seo_description', 'seo_title'],'filter', 'filter' => 'trim', 'on' => 'create'],
			[['status'], 'in', 'range' => ['ON', 'OFF'], 'on' => 'create'],
			['file', 'file', 'extensions' => ['jpg', 'png'], 'maxSize' => 1024*1024*1024, 'on' => 'ajax'],
		];
	}

    public function Run($category_id,$mode){
		if(Yii::$app->request->isAjax){
			$this->AjaxRun{}		
		}
		else{
			if($mode=='create'){
				$this->createCategory();
			}
			elseif($mode=='edit' && $category_id){
					$this->showParam($category_id);
					$this->showFilters($category_id);
					$this->showCategoriesCat($category_id);
					$this->showCategoriesCatHook($category_id);
					$this->editCategory($category_id,$mode);
					$this->showParentCategory($category_id);
			}
			elseif($mode=='delete' && $category_id){
				$this->deleteCategory($category_id);
			}
			elseif(!$mode && !$category_id){
				$this->showCategories();
			}			
		}
        return $this;
    }

    public function AjaxRun($category_id,$mode)
	{
        if($mode=='edit' && $category_id){
            if(Yii::$app->request->post('ARM') == "AddUpdateFilter") {
                $this->setAjaxFilters($category_id);
            }
            if(Yii::$app->request->post('ARM') == "AddUpdateParam") {
                $this->setAjaxParams($category_id);
            }
            if(Yii::$app->request->post('ARM') == "RemoveFilter") {
                $this->deleteAjaxFilter();
            }
            if(Yii::$app->request->post('ARM') == "RemoveParam") {
                $this->deleteAjaxParams();
            }
            if(Yii::$app->request->post('ARM') == "UpdateRMFilter") {
                $this->updateRmFilter();
            }
            if(Yii::$app->request->post('ARM') == "AddCategoryImage") {
                $this->addAjaxImage();
            }
            if(Yii::$app->request->post('ARM') == "RemoveCategoryImage") {
                $this->deleteAjaxImage();
            }
            if(Yii::$app->request->post('ARM') == "AddParentCategory"){
                $this->setParentCategory();
            }
            if(Yii::$app->request->post('ARM') == "RemoveParentCategory"){
                $this->deleteAjaxParent();
            }
            if(Yii::$app->request->post('ARM') == "GetCategoryChildren"){
                $this->getAjaxChildren();
            }
            if(Yii::$app->request->post('ARM') == "SearchParam"){
                $this->searchParam();
            }
            if(Yii::$app->request->post('ARM') == "SearchFilter"){
                $this->searchFilter();
            }
			
        }elseif(!$mode && !$category_id){
            if(Yii::$app->request->post('ARM') == "EditStatus") {
                $this->editAjaxStatus();
            }
            if(Yii::$app->request->post('ARM') == "GetCategoryChildren"){
                $this->getAjaxChildren();
            }
            if(Yii::$app->request->post('ARM') == "GetBackCategories") {
                $this->getBackCategory();
            }
            if(Yii::$app->request->post('ARM') == "SetParentPosition"){
                $this->setAjaxPosition();
            }
        }
        return $this;
    }
	 
	public function getResponse(){
       return $this->response;
    }
	
    public function setAjaxFilters($category_id){
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $filter = new FilterModel();
            try{
                $this->response['data'] = $filter->setFilter($category_id, $post, $this->db);

            }catch(\yii\db\IntegrityException $e){
                $this->response['error'] = 4;
                $this->response['message'] = 'Дублирование фильтра';
            }
        }
    }

    public function setAjaxParams($category_id){
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $param = new ParamsModel();
            try {
                $this->response['data'] = $param->setParam($category_id, $post, $this->db);
            }catch(\yii\db\IntegrityException $e){
                $this->response['error'] = 3;
                $this->response['message'] = 'Дублирование параметра';
            }
        }
    }

    public function searchParam(){
        if(Yii::$app->request->isPost){
            $word = $_POST['title'];
            $param = $this->db->createCommand("SELECT param FROM idc_categories_filters_params WHERE param LIKE '".$word."%' LIMIT 5")->queryColumn();
            $this->response['data'] = ['params' => $param];
        }
    }

    public function searchFilter(){
        if(Yii::$app->request->isPost){
            $word = $_POST['filter'];
            $param = $this->db->createCommand("SELECT filter FROM idc_categories_filters WHERE filter LIKE '".$word."%' LIMIT 5")->queryColumn();
            $this->response['data'] = ['params' => $param];
        }
    }

    public function setAjaxPosition(){
        $cid = (int)$_POST['cid'];
        $pos = (int)$_POST['pos'];
        if($cid && $pos){
            $this->db->createCommand("UPDATE idc_categories_parents
                                        SET idc_categories_parents.position = :pos
                                        WHERE idc_categories_parents.category_id = :cid")->bindValues([':pos' => $pos, ':cid' => $cid])
                ->execute();
            $this->response['data'] = ['pos' => $pos];
        }
    }


    public function editAjaxStatus(){
        $cid = (int)$_POST['cid'];
        $status = (int)Yii::$app->request->post('status') == 1 ? 0 : 1;
        if($cid){
            $this->db->createCommand("UPDATE idc_categories
                                        SET idc_categories.status = :status
                                        WHERE idc_categories.category_id = :cid")->bindValues([':status' => $status, ':cid' => $cid])
                ->execute();
            $this->response['data'] = ['status' => $status];
        }
    }

    public function updateRmFilter(){
            $cid = (int)$_POST['cid'];
            $fid = (int)$_POST['fid'];
            $value = (int)$_POST['status'] == 1 ? 0 : 1;
            ($_POST['btn'] == "R") ? $field = "required" : false;
            ($_POST['btn'] == "M") ? $field = "multiple" : false;
            if ($cid && $fid) {
                $this->db->createCommand("UPDATE idc_categories_filters_hooks
                                        SET $field = :value
                                        WHERE category_id = :cid
                                        AND filter_id = :fid")->bindValues([':value' => $value, ':cid' => $cid, ':fid' => $fid])
                    ->execute();
                $this->response['data'] = ["status" => $value];
            }
    }

    public function deleteAjaxFilter(){
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $filter = new FilterModel();
            $filter->deleteFilter($post, $this->db);
        }
    }

    public function deleteAjaxParams(){
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $filter = new ParamsModel();
            $filter->deleteParam($post, $this->db);
        }
    }

    public function deleteAjaxParent(){
            $cid = $_POST['cid'];
            $id_path = $_POST['id_path'];
            $count_parent = $this->db->createCommand("SELECT COUNT(*) FROM idc_categories_parents WHERE category_id = :cid")->bindValues([':cid' => $cid])->queryScalar();
        if ($cid && $id_path && (int)$count_parent > 1){
            $this->db->createCommand("DELETE idc_categories_parents FROM idc_categories_parents
                        WHERE idc_categories_parents.id_path = :id_path
                        AND idc_categories_parents.category_id = :cid")->bindValues([':cid' => $cid, ':id_path' => $id_path])->execute();
        }else {
            $this->response['error'] = 1;
            $this->response['message'] = 'Нельзя удалить';
        }
    }

    public function addAjaxImage(){
        $this->scenario = 'ajax';
        $this->file = UploadedFile::getInstanceByName('file');
        if($this->validate()){
            $types = array("SI" => "small_img", "AI" => "average_img", "BI" => "big_img");
            $cid = (int)$_POST['cid'];
            $type = $types[$_POST['type']] ? $types[$_POST['type']] : false;
            $seo_category = $this->db->createCommand("SELECT seo_category FROM idc_categories WHERE category_id = :cid")->bindValues([':cid' => $cid])->queryScalar();
            $ext_photo = $this->file->extension;
            if ($cid && $type && $seo_category && $ext_photo) {
                $file_name = $seo_category . '_c' . $cid . '.' . $ext_photo;
                $path = "imgs/categories/" . $type . '/';
                $ImgObject = new HandlingImage();
                if($ImgObject->load($this->file->tempName))
                if($ImgObject->getHeight() < $ImgObject->getWidth())
                {
                    $ImgObject->resizeToWidth(800);
                }
                else
                {
                    $ImgObject->resizeToHeight(800);
                }
                if($ImgObject->save($path . $file_name)){
                    $this->db->createCommand("UPDATE idc_categories SET $type = :file_name WHERE category_id = :cid")->bindValues([':cid' => $cid, ':file_name' => $file_name])->execute();
                    $this->response['data'] = ['image' => $file_name, 'path' => $path . $file_name];
                } else {
                    $this->response['error'] = 2;
                    $this->response['message'] = 'Изображение не удалось загрузить!';
                }
            } else {
                $this->response['error'] = 1;
                $this->response['message'] = 'Некорректные входные данные!';
            }
        }else{
            $this->response['error'] = 3;
            $this->response['message'] = $this->errors['file'];
        }
    }

    public function deleteAjaxImage(){

            $types = array("SI"=>"small_img", "AI"=>"average_img", "BI"=>"big_img");
            $cid = (int)$_POST['cid'];
            $type = $types[$_POST['type']] ? $types[$_POST['type']] : false;
            $image = trim($_POST['image']);
            if($cid && $type && $image && file_exists("." . $image))
            {
                $this->db->createCommand("UPDATE idc_categories SET $type = '' WHERE category_id = $cid")->bindValues([':cid' => $cid])->execute();
                @unlink("." . $image);
            }
    }

    public function getAjaxChildren(){
        $cid = (int)$_POST['cid'];
        if($cid)
        {
            $categories = $this->db->createCommand("SELECT cc.category_id, cc.category, cc.status, cp.parent_id, cp.id_path, cp.position
                                                    FROM idc_categories AS cc
                                                    INNER JOIN idc_categories_parents AS cp
                                                    ON cp.category_id = cc.category_id
                                                    WHERE cp.parent_id = :cid")->bindValues([':cid' => $cid])->queryAll();
            if($categories)
            {
                foreach($categories as $key=>$category)
                {
                    $categories[$key]['edit_url'] = "/categories?mode=edit&category_id={$category['category_id']}";
                    $categories[$key]['del_url'] = "/categories?mode=delete&category_id=".$category['category_id'];
                }
                $this->response['data'] = ['categories' => $categories];
            }
            else {
                $this->response['error'] = 2;
                $this->response['message'] = "Это последняя категория в данной ветви!";
                $this->response['data'] = ['href' => "/categories?mode=edit&category_id=$cid"];
            }
        }
        else {
            $this->response['error'] = 1;
            $this->response['message'] = "Некорректные данные фильтра!";
        }
    }

    public function getBackCategory(){
        $par_id = (int)$_POST['par_id'];
        $path_id = preg_match("/^(\d{1,})(\/\d{1,}){0,2}$/", $_POST['path_id']) ? preg_replace("/(\/\d{1,})$/","",$_POST['path_id']) : false;
        if(isset($par_id) && isset($path_id)) {
            $categories = $this->db->createCommand("SELECT ic.category_id, ic.category, ic.status, cp.parent_id, cp.id_path, cp.position
                                                FROM idc_categories AS ic
                                                INNER JOIN idc_categories_parents AS cp
                                                ON cp.category_id = ic.category_id
                                                WHERE cp.parent_id = :par_id
                                                ORDER BY ic.category")->bindValues([':par_id' => $par_id])->queryAll();
            if ($categories) {
                foreach ($categories as $key => $category) {
                    $categories[$key]['edit_url'] = "/categories?mode=edit&category_id=" . $category['category_id'];
                    $categories[$key]['del_url'] = "/categories?mode=delete&category_id=" . $category['category_id'];
                }
                $back_caterory_id = ($par_id && $path_id) ? $this->db->createCommand("SELECT parent_id FROM idc_categories_parents WHERE category_id = :par_id AND id_path = :path_id")->bindValues([':par_id' => $par_id, ':path_id' => $path_id])->queryScalar() : false;
                $back_categories = ($back_caterory_id || $back_caterory_id === '0') ? $this->db->createCommand("SELECT ic.category_id, ic.category, ic.status, cp.parent_id, cp.id_path, cp.position FROM idc_categories AS ic INNER JOIN idc_categories_parents AS cp ON cp.category_id = ic.category_id WHERE cp.parent_id = :back_caterory_id ORDER BY ic.category")
                    ->bindValues([':back_caterory_id' => $back_caterory_id])->queryAll() : array();
                $this->response['data'] = ['categories' => $categories, 'back_categories' => $back_categories, 'par_id' => $par_id];
            } else {
                $this->response['error'] = 1;
                $this->response['message'] = "Категория неопределена";
            }
        }
    }




    public function createCategory()
    {
        if(Yii::$app->request->isPost){
        $this->scenario = 'create';
        $this->attributes = \Yii::$app->request->post();
		
        if($this->validate()){
            
			
			$this->db->createCommand()->insert('idc_categories', [
                'category' => $this->category,
                'seo_category' => $this->seoTranslitCategory($this->seo_category),
                'status' => $this->status  == 'ON' ? 1 : 0,
                'create_time' => time(),
                'update_time' => time(),
            ])->execute();
			
            $category_id = $this->db->getLastInsertID();
			
            $this->db->createCommand()->insert('idc_categories_objects', [
                'category_id' => $category_id,
                'description' => $this->description,
                'seo_title' => $this->seo_title,
                'seo_description' => $this->seo_description,
                'seo_keywords' => $this->seo_keywords,
            ])->execute();
			
            $this->db->createCommand("INSERT INTO idc_categories_parents (category_id, parent_id, id_path, level)
                                      VALUES (:category_id,0,:category_id,1)")->bindValues([':category_id' => $category_id])->execute();
									  
            $this->controller->redirect('/categories');
			
			
        }else
            
		
		    $this->response['error'] = $this->errors;
            $this->response['data'] = \Yii::$app->request->post();
            $this->response['render']='createCategory';
			
			
        }else $this->response['render']='createCategory';
    }

    public function editCategory()
    {

        if(Yii::$app->request->isPost){
            $this->scenario = 'edit';
            $this->attributes = \Yii::$app->request->post();
        if($this->validate()) {
            $this->db->createCommand()->update('idc_categories_objects', [
                'description' => $this->description,
                'seo_title' => $this->seo_title,
                'seo_description' => $this->seo_description,
                'seo_keywords' => $this->seo_keywords,
                'age_message' => $this->age_message,
            ], 'category_id = ' . $this->category_id . '')->execute();
            $this->db->createCommand()->update('idc_categories', [
                'category' => $this->category,
                'seo_category' => $this->seoTranslitCategory($this->seo_category),
                'status' => $this->status == 'on' ? 1 : 0,
                'update_time' => time(),
                'age_verification' => $this->age_verification == 'on' ? 1 : 0,
                'age_limit' => $this->age_limit,
            ], 'category_id = ' . $this->category_id . '')->execute();

            $this->controller->redirect(Yii::$app->request->url);
        }else
            $this->response['error'] = $this->errors;
            $this->response['render']='editCategory';
        }else
            $this->response['render']='editCategory';
    }




    public function deleteCategory($category_id)
    {
        if(Yii::$app->request->isGet){
            $this->db->createCommand('DELETE cc, co, cp, cfh, cfph
                                      FROM idc_categories AS cc
                                       LEFT JOIN idc_categories_objects AS co
                                       ON co.category_id = cc.category_id
                                       LEFT JOIN idc_categories_parents AS cp
                                       ON cp.category_id = cc.category_id
                                       LEFT JOIN idc_categories_filters_hooks AS cfh
                                       ON cfh.category_id = cc.category_id
                                       LEFT JOIN idc_categories_filters_params_hooks AS cfph
                                       ON cfph.cfh_id = cfh.cfh_id
                                      WHERE cc.category_id = :category_id')->bindValues([':category_id' => $category_id])->execute();
            $this->controller->redirect('/categories');
        }
    }
    public function generatePassword(){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ234567891234567890';
        $numChars = strlen($chars);
        $string = '';
        $length = 5;
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    public function showCategories(){
//    for($j = 0; $j < 20000; $j++){
//        $this->db->createCommand()->insert('idc_categories_filters', [
//            'filter' => $this->generatePassword(),
//        ])->execute();
//}
        print_r(json_decode(Yii::$app->session->readSession('currency')));
        $this->response['data']['cat'] = $this->db->createCommand('SELECT ic.category, ic.category_id, ic.status, cp.position, cp.parent_id, cp.id_path
                                                                    FROM idc_categories AS ic
                                                                    INNER JOIN idc_categories_parents AS cp
                                                                    ON ic.category_id = cp.category_id
                                                                    WHERE cp.parent_id = :parent_id')->bindValues([':parent_id' => 0])->queryAll();
    }

    public function showCategoriesCat($category_id){
        $this->response['data']['category'] = $this->db->createCommand('SELECT cf.category, cf.seo_category,cf.category_id,
                                                                        cf.status, cf.age_verification,
                                                                        cf.small_img, cf.average_img, cf.big_img,
                                                                        cf.age_limit, co.description,
                                                                        co.seo_title, co.seo_description,
                                                                        co.seo_keywords, co.age_message
                                                                        FROM idc_categories AS cf
                                                                        INNER JOIN idc_categories_objects AS co
                                                                        ON co.category_id = cf.category_id
                                                                        WHERE co.category_id = :category_id')->bindValues([':category_id' => $category_id])->queryOne();

        $this->response['data']['parents'] = $this->db->createCommand("SELECT id_path
                                                                        FROM idc_categories_parents
                                                                        WHERE category_id = :category_id")->bindValues([':category_id' => $category_id])->queryAll();

        foreach($this->response['data']['parents'] as $key=>$parent)
        {
            $this->response['data']['parents'][$key]['path'] = $parent['id_path'];

            $path_categories = $this->db->createCommand("SELECT category_id, category
                                                        FROM idc_categories
                                                        WHERE category_id
                                                        IN (".str_replace("/",",",$parent['id_path']).")")->queryAll();

            $this->response['data']['parents'][$key]['path'] = "<".str_replace("/", '>/<', $this->response['data']['parents'][$key]['path']).">";
            foreach($path_categories as $path_category)
                $this->response['data']['parents'][$key]['path'] = str_replace("<".$path_category['category_id'].">",$path_category['category'],$this->response['data']['parents'][$key]['path']);
            unset($path_categories);
        }
    }

    public function showCategoriesCatHook($category_id){
        $this->response['data']['hooks'] = $this->db->createCommand('SELECT cfh.required, cfh.multiple, cfh.filter_id
                                                                    FROM idc_categories_filters_hooks AS cfh
                                                                    WHERE cfh.category_id = :category_id')->bindValues([':category_id' => $category_id])->queryAll();
    }

    public static function seoTranslitCategory($string){
        $string = trim(html_entity_decode($string));
        $string = preg_replace("/\s{2,}/", " ", $string);
        $alphavit = array(  "а"=>"a","б"=>"b","в"=>"v","г"=>"g","ґ"=>"g","д"=>"d","е"=>"e","є"=>"ye",
            "ё"=>"e","ж"=>"zh","з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l","м"=>"m",
            "н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
            "у"=>"u","ф"=>"f","х"=>"kh","ц"=>"ts","ч"=>"ch", "ш"=>"sh","щ"=>"shch",
            "ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","ь"=>"","ъ"=>"","і"=>"i","ї"=>"yi",
            "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g","Ґ"=>"g","Д"=>"d","Е"=>"e","Є"=>"ye",
            "Ё"=>"e","Ж"=>"zh","З"=>"z","И"=>"i","Й"=>"y","К"=>"k","Л"=>"l","М"=>"m",
            "Н"=>"n","О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
            "У"=>"u","Ф"=>"f","Х"=>"kh","Ц"=>"ts","Ч"=>"ch", "Ш"=>"sh","Щ"=>"shch",
            "Ы"=>"y","Э"=>"e","Ю"=>"yu","Я"=>"ya","Ь"=>"","Ъ"=>"","І"=>"i","Ї"=>"yi","&"=>"_and_","-"=>"_","|"=>"_",":"=>"_",
            " "=>"_",);
        $string = strtr($string, $alphavit);
        $string = strtolower($string);
        $string = preg_replace("/\_{2,}/","_", $string);
        $string = preg_replace(array("/^\_*/","/\W/","/\_*$/"),"",$string);
        $string = preg_replace(array("/\_/"),"-",$string);
        return $string;
    }


    public function showParam($category_id){
        $this->response['data']['params'] = $this->db->createCommand('SELECT cfph.cfh_id, cfph.param_id, cf.param
                                                                    FROM idc_categories_filters_params_hooks AS cfph
                                                                    INNER JOIN idc_categories_filters_params AS cf
                                                                    ON cf.param_id = cfph.param_id
                                                                    INNER JOIN idc_categories_filters_hooks AS cfh
                                                                    ON cfph.cfh_id = cfh.cfh_id
                                                                    WHERE cfh.category_id = category_id')->bindValues([':category_id' => $category_id])->queryAll();
        $this->response['data']['category_id'] = $category_id;
    }

    public function showFilters($category_id){
        $this->response['data']['filters'] = $this->db->createCommand('SELECT cfh.cfh_id, cfh.filter_id, cf.filter
                                                                        FROM idc_categories_filters_hooks AS cfh
                                                                        INNER JOIN idc_categories_filters AS cf
                                                                        ON cf.filter_id = cfh.filter_id
                                                                        WHERE cfh.category_id = :category_id')->bindValues([':category_id' => $category_id])->queryAll();
        $this->response['data']['category_id'] = $category_id;
    }

    public function showParentCategory($category_id){
        $this->response['data']['categories'] = $this->db->createCommand("SELECT cc.category_id , cp.parent_id , cp.id_path, cc.category
                                                                        FROM idc_categories AS cc
                                                                        INNER JOIN idc_categories_parents AS cp
                                                                        ON cp.category_id = cc.category_id
                                                                        WHERE cc.category_id != :category_id
                                                                        AND cp.parent_id = :parent_id
                                                                        GROUP BY cc.category_id")
            ->bindValues([':category_id' => $category_id, ':parent_id' => 0])->queryAll();
    }

    public function setParentCategory(){
            $cid = (int)$_POST['cid'];
            $parent_id = (int)$_POST['parent_id'];
            if ($cid && preg_match("/^(\d{1,})(\/\d{1,}){0,2}$/", $_POST['id_path'])) {
            $level = 2 + substr_count($_POST['id_path'], "/");
            $id_path = $_POST['id_path'] . '/' . $cid;
                try{
                    $this->db->createCommand()->insert('idc_categories_parents',
                        ['category_id' => $cid,
                            'parent_id' => $parent_id,
                            'id_path' => $id_path,
                            'level' => $level])->execute();
                }catch(\yii\db\IntegrityException $e){
                    $this->response['error'] = 4;
                    $this->response['message'] = 'Дублирование категории';
                }
        }
    }
}
