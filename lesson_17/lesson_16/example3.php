<?php
include 'config.php';
class Ads {
    private $id;
    private $name;
    private $desc;
    private $type;
    
    public function __construct($ad) {
        if(isset($ad['id'])){
        $this->id=$ad['id'];
        }
        $this->name=$ad['name'];
        $this->desc=$ad['desc'];
        $this->type=$ad['type'];
    }
    
    public function save(){
        global $db;
        $vars = get_object_vars($this);
//        INSERT INTO `ads` (`id`,`name`, `desc`, `type`)
//VALUES (6,'Продам машину', 'красная', 1) ON DUPLICATE KEY UPDATE `desc`=VALUES(`desc`)
        $db->query('REPLACE INTO ads(?#) VALUES(?a)',
                array_keys($vars), array_values($vars));
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    public function getDesc() {
        return $this->desc;
    }
}

//singleton
class AdsStore{
    private static $instance=NULL;
    private $ads=array();
    
    public function instance() {
        if(self::$instance == NULL){
            self::$instance = new AdsStore();
        }
            return self::$instance;
    }
    
    public function addAds(Ads $ad) {
       if(!($this instanceof AdsStore)){
           die("нельзя использовать этот метод в конструкторе классов");
       } 
       $this->ads[$ad->getId()]=$ad;
    }
    
    public function getAllAdsFromDb() {
        global $db;
        //зайти в бд
        $all=$db->select('select * from ads');
        //выбрать все объекты из бд
        //создать объекты класса Ads
        foreach ($all as $value) {
            $ad=new Ads($value);
            self::addAds($ad);
        }
        //поместить объекты в хранилище
    }
    
    public function writeOut(){
        global $smarty;
        //вывод всех объектов из хранилища на экран в таблицу
        //использовать smarty
        $row="";
        foreach($this->ads as $value){
            $smarty->assign('ad',$value);
            $row.=$smarty->fetch('table_row.tpl.html');
        }
        $smarty->assign('ads_rows',$row);
    }
    
}

if(isset($_POST['name'])&&isset($_POST['desc'])){
    $ad=new Ads($_POST);
    $ad->save();
}

$main=AdsStore::instance();
$main->getAllAdsFromDb();
$main->writeOut();

$smarty->display('example3.tpl.html');

