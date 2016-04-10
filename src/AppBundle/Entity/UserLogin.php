<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of UserLogin
 *
 * @author denvkr
 */
class UserLogin {
    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      maxMessage = "Your login cannot be longer than {{ limit }} characters"
     *      minMessage = "Your login must be at least {{ limit }} characters long",
     * )
     */
    private $login;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     *      maxMessage = "Your password cannot be longer than {{ limit }} characters"
     * )
     */
    private $password;

    private $save;
    /**
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Your user must be at least {{ limit }} characters long",
     *      maxMessage = "Your user cannot be longer than {{ limit }} characters"
     * )
     */
    private $user;
    /**
     * @Assert\Type(
     *     type="integer",
     *     message="The data_modification {{ value }} is not a valid {{ type }}."
     * )
     */
    private $data_modification;
    private $mail_link_activation;
    private $system_captcha;
    function SetLogin($login){
       $this->login=$login;
    }
    function GetLogin(){
        return $this->login;
    }
    function SetPassword($password){
        $this->password=$password;
    }
    function GetPassword(){
        return $this->password;
    }
    function SetSave($save){
        $this->save=$save;
    }
    function GetSave(){
        return $this->save;
    }
    function SetUser($user){
        $this->user=$user;
    }
    function GetUser(){
        return $this->user;
    }
    function SetData_modification($data_modification){
        $this->data_modification=$data_modification;
    }
    function GetData_modification(){
        return $this->data_modification;
    }
    function SetMail_link_activation($mail_link_activation){
        $this->mail_link_activation=$mail_link_activation;
    }
    function GetMail_link_activation(){
        return $this->mail_link_activation;
    }
    function SetSystem_captcha($system_captcha){
        $this->system_captcha=$system_captcha;
    }
    function GetSystem_captcha(){
        return $this->system_captcha;
    }
}
