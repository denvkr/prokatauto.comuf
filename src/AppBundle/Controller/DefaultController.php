<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Task;

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

use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Translation\Translator;

use AppBundle\denvkrClasses\logged_user_class;
use AppBundle\denvkrClasses\user_profile_class;
use AppBundle\denvkrClasses\context_reader;
use AppBundle\denvkrClasses\config;

use AppBundle\Entity\authority_user_form;
use AppBundle\Entity\authority_user_form_byquery;
use AppBundle\Form\Type\User_profileType;
use Gregwar\CaptchaBundle\Type\CaptchaType;


class DefaultController extends Controller
{
    public $config;
    public $encoders=array();
    public $normalizers=array();
    public $serializer;
    private $session;
    private $site_config='site_config.xml';
    /**
     * @Route("/luckynumber", name="homepage")
     */
    public function showAction(Request $request)
    {
        // replace this example code with whatever you need
        //return $this->render('default/index.html.twig', array('base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),));
        return new Response('<html><body>Lucky number: 1</body></html>');
    }
    /**
     * @Route("/index", name="index")
     */
    public function showindexAction(Request $request)
    {
        try {
        //Debug::enable();
        //DebugClassLoader::enable();
        //ErrorHandler::register();
        //ExceptionHandler::register();
        $site_info2='';
        $retval='';
        $html='';
	$retval=$this->get_site_config($this->site_config,'siteconfig');
	if (!isset($this->config))
            $this->config=new config();
        if ($retval===false) {
            $this->config->setDbServerName('localhost');
            $this->config->setDbUserName('prokatau_root');
            $this->config->setDbUserPassword('Hftg8bp');
            $this->config->setDbName('prokatau_rentcar');
            $this->config->setSiteUrl('prokatauto-symfony/');
        }
        //открываем сессию
        $this->session = new Session();
        $session_id=$this->session->getId();
        if (empty($session_id)){
            $this->session->start();
        }
        //читаем новости
        $myreader=new context_reader();
        //читаем za_rulem auto_ru
        //$site_info=$myreader->read("za_rulem");
        $site_info2=$myreader->read('auto_ru');
        
        $my_user=new authority_user_form();
        //$validator = $this->get('validator');
        //$errors = $validator->validate($my_user);

        //if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            //$errorsString = (string) $errors;
        //}
        //$site_info2="test";
        //session_start();
        // register some session variables
        //session_register("SESSIONID");
        //$_SESSION['SESSIONID']=$session->getId();//session_id();
        //session_register('id_aut');
        //$_SESSION['id_aut']=$session->getId();//session_id();
        //session_register("CNT");
        //$_SESSION['CNT']=0;
        //session_register('TIME');
        //$_SESSION['TIME']=time();
        //$_COOKIE['CNT']=0;
        /*
        $mylogged_user_class=new logged_user_class();
        $mylogged_user_class->set_dbhost($dbhost);
        $mylogged_user_class->set_user($dbuser);
        $mylogged_user_class->set_dbpass($dbpass);
        $mylogged_user_class->set_dbname($dbname);
        $mylogged_user_class->add_row_logged_user($_SESSION['SESSIONID'],$_SESSION['SESSIONID'],$_SESSION['CNT']);
        $myreader=new AppBundle\denvkrClasses\context_reader();

        //читаем za_rulem auto_ru
        //$site_info=$myreader->read("za_rulem");
        $site_info2=$myreader->read('auto_ru');

        //$pattern = '/^\="leed"/';
        //preg_match($pattern ,$site_info, $matches, PREG_OFFSET_CAPTURE);
        //print_r($matches);

        //$outstr.= $site_info;
        //$smarty->assign('site_info2', $site_info2);
        //** un-comment the following line to show the debug console
        //$smarty->debugging = true;
        //$smarty->assign('session_id',$_SESSION['SESSIONID']);
        //$smarty->display('index.tpl');
        */
        //$site_info2="test";
        
        $html = $this->container->get('templating')->render('index.html.twig',array('session_id' => $session_id,'site_info2' => $site_info2));
        //$html='<pre>'.'$this->config='.var_dump($this->config).'$session_id='.$session_id.'</pre>';//.'1'.$dbhost.$dbuser.$dbpass.$dbname..'<br>$retval='.var_dump($retval).'<br>$xmlContent='.var_dump($xmlContent).'<br>$xmlEncoder->getRootNodeName()='.$xmlEncoder->getRootNodeName()
        //return new Response($html);
        return new Response($html);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

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
        $option=array ('width'=>150,'height'=>50,'length'=>6,'expiration'=>5,);
        return $option;
    }
    
}
