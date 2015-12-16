<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\denvkrClasses;

/**
 * Description of config
 *
 * @author Denvkr
 */
class config {
    //put your code here
    private $dbservername;
    private $dbname;
    private $dbusername;
    private $dbuserpassword;
    private $siteurl;
    public function setDbServerName($dbservername){
        $this->dbservername=$dbservername;
    }
    public function getDbServerName(){
        return $this->dbservername;
    }
    public function setDbName($dbname) {
        $this->dbname=$dbname;
    }
    public function getDbName(){
        return $this->dbname;
    }
    public function setDbUserName($dbusername) {
        $this->dbusername=$dbusername;
    }
    public function getDbUserName(){
        return $this->dbusername;
    }
    public function setDbUserPassword($dbuserpassword) {
        $this->dbuserpassword=$dbuserpassword;
    }
    public function getDbUserPassword(){
        return $this->dbuserpassword;
    }
    public function setSiteUrl($siteurl) {
        $this->siteurl=$siteurl;
    }
    public function getSiteUrl(){
        return $this->siteurl;
    }
}
