<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
/**
 * Description of UdlController
 *
 * @author denvkr
 */
class UdlController extends Controller {
    private $session;    
     /**
     * @Route("/udl", name="udl")
     */
    public function udlAction(Request $request){
        if ($request->hasSession())
            $this->session=$request->getSession();
        //сохраняем данные в json массив
        $right_captha=$this->session->get('gcb_captcha');
        $mas['ok']=$request->get('a');
        $mas['rk']=$right_captha['phrase'];
        return new Response(json_encode($mas));
    }
}
