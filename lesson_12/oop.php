<?php

class Ads{
    protected $id;
    protected $type;
    protected $seller_name;
    protected $email;
    protected $allow_mail;
    protected $phone;
    protected $city_id;
    protected $category_id;
    protected $title;
    protected $description;
    protected $price;
    
    public function __construct($ad) {
        if (isset($ad['id'])){
            $this->id = $ad['id'];
        }
        $this->type = $ad['type'];
        $this->seller_name = $ad['seller_name'];
        $this->email = $ad['email'];
        if (isset($ad['allow_mail'])){
            $this->allow_mail = $ad['allow_mail'];
        }
        else{
            $this->allow_mail = 0;
        }
        $this->phone = $ad['phone'];
        $this->city_id = $ad['city_id'];
        $this->category_id = $ad['category_id'];
        $this->title = $ad['title'];
        $this->description = $ad['description'];
        $this->price = $ad['price'];
    }
    
    public function save() {                                                       // создаёт/изменяет объявление в БД
        $db = db::instance();
        $vars = get_object_vars($this);
        $a=array_values($vars);
        if ($this->getID()){
            $db->query('UPDATE ads SET ?a where id='.$this->getId(), $vars);
        }
        else{
            $this->id = $db->query('INSERT INTO ads(?#) VALUES(?a)',  array_keys($vars),  array_values($vars));
        }
    }
    
    public function del() {                                                      // удаляет объявление из БД
        $db = db::instance();
        $db->query('delete from `ads` where id=?d', $this->getId());
    }
    
    public function getId(){
        return $this->id;
    }
    public function getType(){
        return $this->type;
    }
    public function getSeller_name(){
        return $this->seller_name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getAllow_mail(){
        return $this->allow_mail;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getCity_id(){
        return $this->city_id;
    }
    public function getCategory_id(){
        return $this->category_id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getPrice(){
        return $this->price;
    }
}

class adsCompany extends ads{                                         // дочерний класс для объявлений Компаний
    protected $color;
    
    function __construct($ad) {
        parent::__construct($ad);
        if (isset($ad['color'])){
            $this->color = $ad['color'];
        }
        else{
            $this->color = 0;
        }
    }
    
    public function getColor(){
        return $this->color;
    }
}

class AdsStore{
    private static $instance = NULL;
    private static $ads = array();
    
    public static function instance() {
        if(self::$instance == NULL){
            self::$instance = new AdsStore();
        }
        return self::$instance;
    }
    
    public function getAdFromDb($id){                                           // возвращает объявление из базы по id
        $db = db::instance();
        return $db->selectRow('SELECT * FROM `ads` WHERE id=?d', $id);
    }
    
    public function addAds(Ads $ad) {                                           // добавляет объекты в массив хранилища
        if(!($this instanceof AdsStore)){
            die('Нельзя использовать этот метод в конструкторе классов');
        }
        self::$ads[$ad->getId()]=$ad;
    }
    
    public function save($post) {                                               // сохраняет/создаёт объявление в бд
        $post['type'] ? $ad = new AdsCompany($post) : $ad = new Ads($post);
        $id = $ad->save();                                                            // сохраняем в бд
        self::addAds($ad);
        return self::$instance;
    }
    
    public function del($id) {                                                  // удаляет объявление из хранилища и бд
        self::$ads[$id]->del();
        unset(self::$ads[$id]);
        return self::$instance;
    }
    
    public function getAllAdsFromDb() {                                         // помещает все объявления из базы в хранилище
        $db = db::instance();
        $all = $db->select('select * from ads');
        foreach ($all as $value){
            $value['type'] ? $ad = new adscompany($value) : $ad = new Ads($value);
            self::addAds($ad); //помещаем объекты в хранилище
        }
        return self::$instance;
    }
    
    public function prepareForOut() {                                           // формирует таблицу с объявлениями для вывода
        global $smarty;
        $row='';
        foreach (self::$ads as $value) {
            $smarty->assign('ad',$value);
            $row.=$smarty->fetch('table_row.tpl');
        }
        $smarty->assign('ads_rows',$row);
        return self::$instance;
    }
    public function display($id = 0) {                                              // вывод на экран
        global $smarty;
        $id ? $ad = self::getAdFromDb($id) : $ad = 0;
        $ad['type'] ? $display = new adsCompany($ad) : $display = new ads($ad);
        $smarty->assign('display', $display);
        $smarty->assign('cities', self::getCities());
        $smarty->assign('categories', self::getCategories());
        $smarty->display('oop.tpl');
    }
    
    function getCities(){                                                       // возвращает список городов для селектора
        $db = db::instance();
        $cities = $db->selectCol('SELECT id AS ARRAY_KEY,city FROM cities');
        return $cities;
    } 
    
    function getCategories(){                                            // возвращает список категорий для селектора
        $db = db::instance();
        $categories_query = $db->select('SELECT * FROM `categories`');      //выбираем из базы данных категории и записываем их в массив
        foreach ($categories_query as $value) {
            $categories[$value['subcategory']][$value['id']] = $value['category'];
        }
        $categories[0] = $categories[0][1];
        return $categories;
    }
    
    function clearDB(){                                              // очищает базу данных
        $db = db::instance();
        $db->query("delete from `ads` where 1");
        self::$ads = array();
        return self::$instance;
    }
}

class db{                                                       // подключение к базе данных
    private static $instance=NULL;
    private $db;

    public static function instance() {
        if(self::$instance == NULL){
            self::$instance = new db();
        }
        return self::$instance->db;
    }
    
    function __construct() {
        require_once __DIR__.'/dbsimple/config.php';
        require_once __DIR__.'/dbsimple/dbsimple/Generic.php';
        if ((!file_exists('connect.cfg')) || (!file_get_contents('connect.cfg'))){
            header("Location: install.php");
        }  
        $this->db = DbSimple_Generic::connect(file_get_contents('connect.cfg'));
    }
}