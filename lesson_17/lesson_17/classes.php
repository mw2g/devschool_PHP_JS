<?php
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
