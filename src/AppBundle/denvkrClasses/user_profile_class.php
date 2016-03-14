<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\denvkrClasses;
use \mysqli;
/**
 * Description of user_profile_class
 *
 * @author TanyaNekhaj
 */
class user_profile_class extends database_connection_base_class {
    
    function db_check_mail_link_info($mail_link_activation,$username,$userpassword)
    {
        //проверяем линк пользователя на предмет существования такового а бд
        $retval =0;
        $conn = mysqli_connect($this->get_dbhost(), $this->get_dbuser(), $this->get_dbpass()) or die ('Error connecting to mysql');
        //$dbname = 'prokatau_rentcar';
        mysqli_select_db($conn,$this->get_dbname());
        mysqli_query($conn,"SET NAMES utf8");
        mysqli_query($conn,"SET @retval = 0;");
            if ($mail_link_activation!='') {
                    mysqli_query($conn,"set @retval=(SELECT DISTINCT mail_link_info FROM userinfo WHERE substr(mail_link_info,LENGTH(mail_link_info)-32,33)='".$mail_link_activation."')");
                    $result = mysqli_query($conn,"select @retval;");
                    $row = mysqli_fetch_array($result);
                    if (isset($result)===true){
                            $str='';
                            if (!empty($row[0])) {
                                    $str= $row[0];
                                    //print ($result);
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                    return $str;
                            }
                            else {
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                    return 0;
                            }
                    }
                    else {
                            mysqli_free_result($result);
                            return 0;	
                    }
            }

            if (($username!='' && $userpassword=='') || ($username!='' && $userpassword!='')){
                    //echo "set @retval=(SELECT DISTINCT mail_link_info FROM userinfo WHERE  login='".$username."' and password='".$userpassword."')";
                    mysqli_query($conn,"set @retval=(SELECT DISTINCT mail_link_info FROM userinfo WHERE login='".$username."' and password='".$userpassword."')");
                    $result = mysqli_query($conn,"select @retval;");
                    if (isset($result)===true){
                            $str='';
                            $row = mysqli_fetch_array($result);
                            $str= $row[0];
                            mysqli_free_result($result);
                            mysqli_close($conn);
                            return $str;
                    }
                    else {
                            mysqli_free_result($result);
                            mysqli_close($conn);
                            return 0;	
                    }

            }
    }
    
    function db_get_user_info($mail_link_activation){
        $retval =0;
        $conn = mysqli_connect($this->get_dbhost(), $this->get_dbuser(), $this->get_dbpass()) or die ('Error connecting to mysql');
        //$dbname = 'prokatau_rentcar';
        mysqli_select_db($conn,$this->get_dbname());
        mysqli_query($conn,"SET NAMES utf8");
        $result = mysqli_query($conn,"SELECT DISTINCT login,password,mail_address,Name,Last_Name,Address,Age,drivers_length,rent_request,Mail_Link_Info FROM ".$this->get_dbname().".userinfo WHERE substr(mail_link_info,LENGTH(mail_link_info)-32,33)='".$mail_link_activation."'",MYSQLI_USE_RESULT);
        //echo "SELECT DISTINCT login,password,mail_address,Name,Last_Name,Address,Age,drivers_length,rent_request,Mail_Link_Info FROM ".$dbname.".userinfo WHERE substr(mail_link_info,LENGTH(mail_link_info)-32,33)='".$mail_link_activation."'"; 
        //print_r($retval);
        if (isset($result)===true){
                            $row = mysqli_fetch_row($result);
                            //print_r($row);
                            mysqli_free_result($result);
                            mysqli_close($conn);
                            return $row;
            }
            else {
                    return 0;	
            }
    }

    function db_store_user_data($login, $password, $mail_address,$user_name,$user_last_name,$address,$age,$drivers_length,$rent_request,$mail_link_activation)
    {
        $conn = mysqli_connect($this->get_dbhost(), $this->get_dbuser(), $this->get_dbpass()) or die ('Error connecting to mysql');
        //$dbname = 'prokatau_rentcar';
        mysqli_select_db($conn,$this->get_dbname());
            //print ("call STORE_USER_DATA('".$login."','".$password."','".$mail_address."','".$user_name."','".$user_last_name."','".$address."',".$age.",".$drivers_length.",'".$mail_link_activation."',".$retval.")");
            mysqli_query($conn,"SET NAMES utf8");
            mysqli_query($conn,"SET @retval = 0;");
            $result = mysqli_query($conn,"INSERT INTO userinfo(login,PASSWORD,mail_address,NAME,Last_Name,Address,age,drivers_length,rent_request,rent_event_id,Mail_link_Info) VALUES ('".$login."','".$password."','".$mail_address."','".$user_name."','".$user_last_name."','".$address."',".$age.",".$drivers_length.",'".$rent_request."',-1,'".$mail_link_activation."')");
            if ((empty(mysqli::$error)===true)){
                      //print "Data was inserted cusessfully.";
            }
            //mysqli_free_result($result); 
            mysqli_close($conn);
    }

    function db_update_user_data($login, $password, $mail_address,$user_name,$user_last_name,$address,$age,$drivers_length,$rent_request,$mail_link_activation)
    {
        $conn = mysqli_connect($this->get_dbhost(), $this->get_dbuser(), $this->get_dbpass()) or die ('Error connecting to mysql');
        //$dbname = 'prokatau_rentcar';
        mysqli_select_db($conn,$this->get_dbname());
            //print ("call STORE_USER_DATA('".$login."','".$password."','".$mail_address."','".$user_name."','".$user_last_name."','".$address."',".$age.",".$drivers_length.",'".$mail_link_activation."',".$retval.")");
            mysqli_query($conn,"SET NAMES utf8");
            mysqli_query($conn,"SET @retval = 0;");
            if (empty($mail_link_activation)){
                $result = mysqli_query($conn,"UPDATE userinfo set login='".$login."',PASSWORD='".$password."',mail_address='".$mail_address."',NAME='".$user_name."',Last_Name='".$user_last_name."',Address='".$address."',age=".$age.",drivers_length=".$drivers_length.",rent_request='".$rent_request."' WHERE Mail_link_Info='".$mail_link_activation."'");                
            } else
                $result = mysqli_query($conn,"UPDATE userinfo set login='".$login."',PASSWORD='".$password."',mail_address='".$mail_address."',NAME='".$user_name."',Last_Name='".$user_last_name."',Address='".$address."',age=".$age.",drivers_length=".$drivers_length.",rent_request='".$rent_request."' WHERE Mail_link_Info like'%".$mail_link_activation."%'");
            if ((empty(mysqli::$error)===true)){
                      //print "Data was modified cusessfully.";
            }
            //mysqli_free_result($result); 
            mysqli_close($conn);
    }
/**
 * Description of user_profile_class
 *
 * @var mail_link_activation user login id
 * @var session_id user session id
 */
    function db_store_session_info($mail_link_activation,$session_id) {
        $conn = mysqli_connect($this->get_dbhost(), $this->get_dbuser(), $this->get_dbpass()) or die ('Error connecting to mysql');
        //$dbname = 'prokatau_rentcar';
        mysqli_select_db($conn,$this->get_dbname());
            mysqli_query($conn,"SET NAMES utf8");
            $result = mysqli_query($conn,"SELECT DISTINCT login FROM user_session_info WHERE login='".$mail_link_activation."'");
            $row = mysqli_fetch_row($result);
            if ($row[0]==$mail_link_activation){
                    mysqli_free_result($result);
                    mysqli_query($conn,"UPDATE user_session_info SET session_id='".$session_id."',login_time='".date("Y-m-d H:i:s")."' WHERE login='".$mail_link_activation."'");
                    //echo "UPDATE user_session_info SET session_id='".session_id()."' WHERE login='".$mail_link_activation."'";
            } else {
                    mysqli_query($conn,"INSERT INTO user_session_info(login,session_id,login_time) VALUES ('".$mail_link_activation."','".$session_id."','".date("Y-m-d H:i:s")."');");
                    //echo "INSERT INTO user_session_info(login,session_id,login_time) VALUES ('".$mail_link_activation."','".session_id()."','".date("Y-m-d H:i:s")."');"; 
            }	
            if (empty(mysqli::$error)===true){
                      //echo "Data was  modified cusessfully.";
            }
            mysqli_close($conn);
    }

    function db_get_session_id($mail_link_activation){
        $conn = mysqli_connect($this->get_dbhost(), $this->get_dbuser(), $this->get_dbpass()) or die ('Error connecting to mysql');
        //$dbname = 'prokatau_rentcar';
        mysqli_select_db($conn,$this->get_dbname());
            mysqli_query($conn,"SET NAMES utf8");
            $result = mysqli_query($conn,"SELECT DISTINCT session_id FROM user_session_info WHERE login='".$mail_link_activation."'");
            if ((mysqli_errno)){
                    $row = mysqli_fetch_row($result);
                    mysqli_free_result($result);
                    mysqli_close($conn);		
                    return $row[0];
            } else {
                    return 0;
            }
    }

}
