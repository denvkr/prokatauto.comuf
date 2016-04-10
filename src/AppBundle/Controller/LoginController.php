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
use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\DebugClassLoader;

use Symfony\Component\Translation;

use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\LengthValidator;
use Symfony\Component\Validator\Validation;

use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\VarDumper\Dumper\HTMLDumper;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Translation\Translator;

use AppBundle\denvkrClasses\logged_user_class;
use AppBundle\denvkrClasses\user_profile_class;
use AppBundle\denvkrClasses\context_reader;
use AppBundle\denvkrClasses\config;

use AppBundle\Form\Type\UserLoginType;
use AppBundle\Entity\UserLogin;
use AppBundle\Entity\authority_user_form;
use AppBundle\Entity\authority_user_form_byquery;
use AppBundle\Form\Type\User_profileType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Gregwar\CaptchaBundle\Generator\CaptchaGenerator;
use Gregwar\CaptchaBundle\Validator\CapchaValidator;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Gregwar\CaptchaBundle\Generator\ImageFileHandler;

use AppBundle\Resources\images;

/**
 * Description of LoginController
 *
 * @author denvkr
 */
class LoginController extends Controller{
    public $config;
    public $encoders=array();
    public $normalizers=array();
    public $serializer;
    private $session;
    private $site_config='site_config.xml';
    private $captchabuilder;
    private $option;
     /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request){
        $html='';
        $str_tab='';
        $action='';
        $retval=array();
        
        //для тестов
        //?user=44c54155669c3adef054c3c2a32accf7&password=44c54155669c3adef054
	$retval=$this->get_site_config($this->site_config,'siteconfig');
        //echo 1;
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->getFormFactory();
        //$validator=Validation::createValidatorBuilder()->addMethodMapping('constrains');
        //пытаемся сделать простой валидатор с ограничениями по длинне слова
        $ln=new Assert\Length(array('min'=>3,'max'=>20));
        //var_dump($ln);
        $constraint = new Assert\Collection(array(
            'login' => array(new Assert\NotBlank(),new Assert\Length(array('min'=>3,'max'=>20))),
             'password' => new Assert\NotBlank(),
        ));
        $params['constraints']=$constraint;
        //echo 5;
	if (!isset($this->config))
            $this->config=new config();
        if ($retval===false) {
            $this->config->setDbServerName('localhost');
            $this->config->setDbUserName('prokatau_root');
            $this->config->setDbUserPassword('Hftg8bp');
            $this->config->setDbName('prokatau_rentcar');
            $this->config->setSiteUrl('prokatauto-symfony/');
        }
        //Генерим сессию для страницы
        //session_start();
        if (!$request->hasSession()) {
            $this->session = new Session();
            $this->session->start();
            //$session_id=$this->session->getId();

        } else $this->session=$request->getSession();

        $user_profile_class=new user_profile_class($this->config->getDbServerName(),$this->config->getDbName(),$this->config->getDbUserName(),$this->config->getDbUserPassword(),'mysql');
        //echo print_r($user_profile_class);
        //$this->session = new Session(new MockArraySessionStorage());
        if ($request->get('user') && $request->get('password') && !($request->get('data_modification'))) {
                //echo $request->get('user') .' '. $request->get('password');
                //echo $_REQUEST['user'].$_REQUEST['password'];
                //var_dump($this->session);
                //получаем опции для капчи
                //$options = $this->container->getParameter('gregwar_captcha.config');
                //echo $this->session->getId();
                //var_dump($options);
                //$generator = $this->container->get('gregwar_captcha.generator');
                //$this->session->set('captchabuilder',new CaptchaBuilder());
                //echo __DIR__;
                $this->option=$this->captcha_options();
                $phrasebuilderinterface=new PhraseBuilder;
                $imagefilehandler=new ImageFileHandler('AppBundle/Resources/images','',1,1);
                $router = $this->get('router');
                $this->captchabuilder=new CaptchaBuilder(null,$phrasebuilderinterface);
                $generator = new CaptchaGenerator($router,$this->captchabuilder,$phrasebuilderinterface,$imagefilehandler);//$this->session->get('captchabuilder')
                $translator = new Translator('en');
                $CaptchaType = new CaptchaType($this->session,$generator,$translator,$this->option);
                //echo $this->captchabuilder->getPhrase().' ';
                $GLOBALS['captchabuilder']=$this->captchabuilder;
                //$Translation=new Translation();
                $validator = $this->get('validator');
                $errors = $validator->validate($CaptchaType);
                if (count($errors) > 0) {
                /*
                 * Uses a __toString method on the $errors variable which is a
                 * ConstraintViolationList object. This gives us a nice string
                 * for debugging.
                 */
                $errorsString = (string) $errors;
                }
                VarDumper::dump(array('$retval'=>$retval,'$generator_phrase='=>$generator->getPhrase($this->option),'$phrase='=>$generator->phrase,'CaptchaType'=>$CaptchaType->getName(),'assert'=>$ln,'captcha_validation'=>$errors,'fingerprint'=>$this->captchabuilder->getPhrase()));
                //echo $CaptchaType->getBlockPrefix();
                //var_dump($generator);
                //var_dump($CaptchaType);    
                //$this->session->setId();
                $mail_link_activation=$request->get('mail_link_activation');
                $session_id=$request->cookies->get('PHPSESSID');
                //print_r($mail_link_activation);
                $user_profile_class->db_store_session_info($mail_link_activation,$session_id);
                $mail_link_activation_old=$user_profile_class->db_check_mail_link_info('',$request->get('user'),$request->get('password'));
                //echo substr($mail_link_activation_old,-33);
                //echo $mail_link_activation_old;
                $retval=$user_profile_class->db_get_user_info(substr($mail_link_activation_old,-33));
                //print_r($retval);
                $action="/login?mail_link_activation=".substr($mail_link_activation_old,-33)."&data_modification=1";
                //$str_tab='<div id="userinfo_level1" class="ul.nav" style="position:relative;left:35%;top:130px !important;width:300px;height:150px;z-index:0"><table border="1" cols="2"><tr><td>Логин:</td><td><input type="text" name="login" value="'.$retval[0].'"/></td></tr><tr><td>Пароль:</td><td><input type="text" name="password" value="'.$retval[1].'"/><br></td></tr><tr><td>Ел. почта:</td><td><input type="text" name="mail_address" value="'.$retval[2].'"/><br></td></tr><tr><td>Имя:</td><td><input type="text" name="name" value="'.$retval[3].'"/><br></td></tr><tr><td>Фамилия:</td><td><input type="text" name="last_name" value="'.$retval[4].'"/><br></tr><tr><td>Дом. адрес:</td><td><input type="text" name="address" value="'.$retval[5].'"/><br></td></tr><tr><td>Возраст:</td><td><input type="text" name="age" value="'.$retval[6].'"/><br></td></tr><tr><td>Стаж:</td><td><input type="text" name="drivers_length" value="'.$retval[7].'"/><br></td></tr><tr><td>Желаемые условия аренды автомобиля:</td><td><textarea name="rent_request" style="width:227px;height:81px;">'.$retval[8].'</textarea><br></td></tr></table></div><div id="captcha" class="ul" style="position:relative;left:40%;top:340px;width:150px;height:30px">Введите код с картинки: <img src="captcha.php?mail_link_activation='.$mail_link_activation.'" width=50 height=30><input name="captcha" size=5 type="text" /><input type="submit" name="_Registering" value="Обновить данные"></div></form>';
                //$defaults = array('login' => $retval[0],'password'=>$retval[1],'captcha'=>null);
                //echo 6;
                $formoptions['data']['login']=$retval[0];
                $formoptions['data']['password']=$retval[1];
                $formoptions['data']['user']=$request->get('user');
                $formoptions['data']['mail_link_activation_old']=substr($mail_link_activation_old,-33);
                $formoptions['data']['phrasebuilderinterface']=$phrasebuilderinterface->niceize($generator->getPhrase($this->option));
                $UserLogin=new UserLogin();
                $UserLoginType=new UserLoginType($this->get('router'),$this->session);
                $form =$this->createForm($UserLoginType, $UserLogin,$formoptions);
                /*
                $form = $formFactory->createBuilder('form',$defaults, array('action' => $action,'method' => 'POST'))
                        ->add('login',TextType::class,array('attr' => array('maxlength' => 50,'required' => true)))//array('attr' => array('maxlength' => 50,'required' => true)))
                        ->add('password',TextType::class,array('attr' => array('maxlength' => 20,'required' => true)))
                        ->add('captcha', $CaptchaType,array('attr' => array('required' => true,'disabled' => false)))
                        ->add('Save', SubmitType::class, array('attr'=>array('class'=>'btn btn-lg btn-primary btn-block'),'label' => 'Сохранить'))
                        ->add('user', HiddenType::class,array('data' => $request->get('user')))
                        ->add('data_modification', HiddenType::class,array('data' => 1))
                        ->add('mail_link_activation', HiddenType::class,array('data' => substr($mail_link_activation_old,-33)))
                        ->add('system_captcha', HiddenType::class,array('data' =>$phrasebuilderinterface->niceize($generator->getPhrase($this->option))) )
                        ->getForm();
                */
                //$capchavalidator=new CaptchaValidator($translator,$this->session,)
                //$request->getSession()->set('data_modification', 1);
                //$request->getSession()->set('mail_link_activation', substr($mail_link_activation_old,-33));
        } else if ($request->request->get('form')['login'] && $request->request->get('form')['password'] && $request->request->get('form')['data_modification']) {
                //echo 'capcha='.$request->request->get('form')['captcha'];
                $prev_capcha=$request->request->get('form')['captcha'];
                //echo 'system_capcha='.$request->request->get('form')['system_captcha'];
                //$VarDumper=new VarDumper();
                //echo __DIR__;
                if (!isset($GLOBALS['captchabuilder']))
                    $this->captchabuilder=new CaptchaBuilder();
                else
                    $this->captchabuilder=$GLOBALS['captchabuilder'];
                    
                $phrasebuilderinterface=new PhraseBuilder;
                $imagefilehandler=new ImageFileHandler('AppBundle/Resources/images','',1,1);
                $router = $this->get('router');
                $generator = new CaptchaGenerator($router,$this->captchabuilder,$phrasebuilderinterface,$imagefilehandler);
                $translator = new Translator('en');
                $CaptchaType = new CaptchaType($this->session,$generator,$translator,$this->captcha_options());
                $coption=$this->captcha_options();

                VarDumper::dump(array('phrasebuilderinterface'=>$phrasebuilderinterface->niceize($generator->getPhrase($coption))));
                //echo 'testphrase='.$this->captchabuilder->testPhrase($prev_capcha);                
                //echo $CaptchaType->getBlockPrefix();
                //var_dump($generator);
                //var_dump($CaptchaType);    
                //$this->session->setId();
                $mail_link_activation=$request->request->get('form')['mail_link_activation'];
                $session_id=$request->cookies->get('PHPSESSID');
                //print_r($mail_link_activation);
                $user_profile_class->db_store_session_info($mail_link_activation,$session_id);
                $mail_link_activation_old=$user_profile_class->db_check_mail_link_info('',$request->request->get('form')['user'],$request->request->get('form')['password']);
                //echo substr($mail_link_activation_old,-33);
                //echo $mail_link_activation_old;
                //при обновлении страницы сначала получаем данные из базы о пользователе а потом обновляем их если этот пользователь есть в базе
                $retval=$user_profile_class->db_get_user_info(substr($mail_link_activation_old,-33));
                
                $user_profile_class->db_update_user_data($request->request->get('form')['login'], $request->request->get('form')['password'], $retval[2],$retval[3],$retval[4],$retval[5],$retval[6],$retval[7],$retval[8],$mail_link_activation);
                //print_r($retval);
                $action="/login?mail_link_activation=".substr($mail_link_activation_old,-33)."&data_modification=1";
                //$str_tab='<div id="userinfo_level1" class="ul.nav" style="position:relative;left:35%;top:130px !important;width:300px;height:150px;z-index:0"><table border="1" cols="2"><tr><td>Логин:</td><td><input type="text" name="login" value="'.$retval[0].'"/></td></tr><tr><td>Пароль:</td><td><input type="text" name="password" value="'.$retval[1].'"/><br></td></tr><tr><td>Ел. почта:</td><td><input type="text" name="mail_address" value="'.$retval[2].'"/><br></td></tr><tr><td>Имя:</td><td><input type="text" name="name" value="'.$retval[3].'"/><br></td></tr><tr><td>Фамилия:</td><td><input type="text" name="last_name" value="'.$retval[4].'"/><br></tr><tr><td>Дом. адрес:</td><td><input type="text" name="address" value="'.$retval[5].'"/><br></td></tr><tr><td>Возраст:</td><td><input type="text" name="age" value="'.$retval[6].'"/><br></td></tr><tr><td>Стаж:</td><td><input type="text" name="drivers_length" value="'.$retval[7].'"/><br></td></tr><tr><td>Желаемые условия аренды автомобиля:</td><td><textarea name="rent_request" style="width:227px;height:81px;">'.$retval[8].'</textarea><br></td></tr></table></div><div id="captcha" class="ul" style="position:relative;left:40%;top:340px;width:150px;height:30px">Введите код с картинки: <img src="captcha.php?mail_link_activation='.$mail_link_activation.'" width=50 height=30><input name="captcha" size=5 type="text" /><input type="submit" name="_Registering" value="Обновить данные"></div></form>';
                $defaults = array('login' => $request->request->get('form')['login'],'password'=>$request->request->get('form')['password'],'captcha'=>null);
                //echo 6;
                
                $form = $formFactory->createBuilder('form',$defaults, array('action' => $action,'method' => 'POST'))
                        ->add('login',TextType::class,array('attr' => array('maxlength' => 50,'required' => true),'constraints'=>$ln))//array('attr' => array('maxlength' => 50,'required' => true)))
                        ->add('password',TextType::class,array('attr' => array('maxlength' => 20,'required' => true)))
                        ->add('captcha', $CaptchaType,array('attr' => array('required' => true,'disabled' => false)))
                        ->add('Save', SubmitType::class, array('attr'=>array('class'=>'btn btn-lg btn-primary btn-block'),'label' => 'Сохранить'))
                        ->add('user', HiddenType::class,array('data' => $request->get('user')))
                        ->add('data_modification', HiddenType::class,array('data' => 1))
                        ->add('mail_link_activation', HiddenType::class,array('data' => substr($mail_link_activation_old,-33)))
                        ->add('system_captcha', HiddenType::class,array('data' =>$phrasebuilderinterface->niceize($generator->getPhrase($coption))) )
                        ->getForm();
                //$request->getSession()->set('data_modification', 1);
                //$request->getSession()->set('mail_link_activation', substr($mail_link_activation_old,-33));
            
        }

                //$CaptchaView=$CaptchaType->buildView($form->createView(), $form, $this->captcha_options());
                //var_dump($CaptchaView);
        if (isset($form)){
            $html = $this->container->get('templating')->render('login_form.html.twig',array('form' => $form->createView()));//,'captcha'=>$CaptchaView
        } else {
            //var_dump($request->request->all());
            //echo $request->get('user').' '.$request->get('password').' '. $request->get('data_modification').' '.$request->get('mail_link_activation');
            $html = $this->container->get('templating')->render('base.html.twig',array('user' =>$request->request->get('form')['login']));
        }
        //echo $this->captchabuilder->getPhrase().' ';
        //if($form->isValid()) {
            return new Response($html);            
        //} else {
        //    $errorsRaw = $this->get('validator')->validate($form);
        //    if (count($errorsRaw) > 0) {
        //        $errorsString = (string) $errorsRaw;
        //    }

        //}
        
    }
    
    function get_site_config($xmlfile,$attribute)
    {
        try {
        $this->config=new config();
        //получаем конфигурационный файл
        $finder = new Finder();
        $contents='';        
        $finder->files()->name($xmlfile);
        //$request=Request::createFromGlobals();
        //читаем конфигурационный файл
        foreach ($finder->in(__DIR__) as $file) {
            $contents = $file->getContents();
        }
        $xmlEncoder=new XmlEncoder();
        $xmlEncoder->setRootNodeName('config');
        $this->encoders = array($xmlEncoder, new JsonEncoder());
        $this->normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($this->normalizers, $this->encoders);

        $retval=$xmlEncoder->encode($this->config, 'xml');
        $xmlContent = $this->serializer->serialize($this->config, 'xml');
        $this->serializer->deserialize($contents, 'AppBundle\denvkrClasses\config', 'xml',array('object_to_populate' => $this->config));

         return true;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }
    function captcha_options($key=false,$val=false){
        /*
         * You can define the following configuration options globally or on the CaptchaType itself:
            width: the width of the captcha image (default=120)
            height: the height of the captcha image (default=40)
            disabled: disable globally the CAPTCHAs (can be useful in dev environment), it will still appear but won't be editable and won't be checked
            length: the length of the captcha (number of chars, default 5)
            quality: jpeg quality of captchas (default=30)
            charset: the charset used for code generation (default=abcdefhjkmnprstuvwxyz23456789)
            font: the font to use (default is random among some pre-provided fonts), this should be an absolute path
            keep_value: the value will be the same until the form is posted, even if the page is refreshed (default=true)
            as_file: if set to true an image file will be created instead of embedding to please IE6/7 (default=false)
            as_url: if set to true, a URL will be used in the image tag and will handle captcha generation. This can be used in a multiple-server environment and support IE6/7 (default=false)
            invalid_message: error message displayed when an non-matching code is submitted (default="Bad code value", see the translation section for more information)
            bypass_code: code that will always validate the captcha (default=null)
            whitelist_key: the session key to use for keep the session keys that can be used for captcha storage, when using as_url (default=captcha_whitelist_key)
            reload: adds a link to reload the code
            humanity: number of extra forms that the user can submit after a correct validation, if set to a value different of 0, only 1 over (1+humanity) forms will contain a CAPTCHA (default=0, i.e each form will contain the CAPTCHA)
            distortion: enable or disable the distortion on the image (default=true, enabled)
            max_front_lines, max_behind_lines: the maximum number of lines to draw on top/behind the image. 0 will draw no lines; null will use the default algorithm (the number of lines depends on the size of the image). (default=null)
            background_color: sets the background color, if you want to force it, this should be an array of r,g &b, for instance [255, 255, 255] will force the background to be white
            background_images: Sets custom user defined images as the captcha background (1 image is selected randomly). It is recommended to turn off all the effects on the image (ignore_all_effects). The full paths to the images must be passed.
            interpolation: enable or disable the interpolation on the captcha
            ignore_all_effects: Recommended to use when setting background images, will disable all image effects.
         */
        $option=array ('width'=>'240',
                        'height'=>'80',
                        'disabled'=>true,
                        'length'=>'6',
                        'quality'=>'30',
                        'charset'=>'abcdefghijklmnopqrstuxywz23456789',
                        'font'=>__DIR__ . '/Font/captcha0.ttf',
                        'keep_value'=>true,
                        'as_file'=>false,
                        'invalid_message'=>'Введенный код не совпадает с картинкой.',
                        'bypass_code'=>null,
                        'whitelist_key'=>'captcha_whitelist_key',
                        'max_front_lines'=>null,
                        'max_behind_lines'=>null,
                        'interpolation'=>false,
                        'expiration'=>'5',
                        'reload'=>'',
                        'as_url'=>false,
                        'humanity'=>0,
                        'distortion'=>false,
                        'background_color'=>array(255,255,255),
                        'background_images'=>array('../images/podcatalog2.png','../images/phone_bg.png'),
                        'ignore_all_effects'=>true,
                        'text_color'=>array(0,0,0),
                        'disabled'=>false,
            );
        return $option;
    }

}
