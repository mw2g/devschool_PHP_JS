<?php
    require_once ("oop.php");
    
    AdsStore::instance()->getAllAdsFromDb()->prepareForOut()->display();
    
?>