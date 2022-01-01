<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Context;
use app\models\Archive;

class SiteController extends Controller
{


    
    public function home(Request $request)
    {
        if(Application::$TIMEZONE == ""){
            throw new \Exception("Cannot detected browser's timezone", 424);
            return false;
        }

        $urlParams = $request->getBody();

        $params = [
            'context'=>null,
            'archive'=>null
        ];

        if (count($urlParams)>1) {
            
            $archive = new Archive($urlParams['entry_uid'], $urlParams['channels']);
            $params['archive'] = $archive;

            return $this->render('home', $params);
        }



        $context = Context::defaultDate(Application::$TIMEZONE);
        $params['context'] = $context;
        
        $archive = new Archive($context->latest_entry());
        $params['archive'] = $archive;
        


        return $this->render('home', $params);
    }


    public function handleEntry(Request $request, Response $response){
        echo '<div class="code"><pre>';
        var_dump($_GET);
        echo '</pre></div>';
        exit;
    }






    public function contact()
    {
        $this->setLayout('simple');
        return $this->render('contact');
    }



    public function handleContact(Request $request)
    {
        $msg = '';

        $msgClass = '';

        $sent = false;

        $body = $request->getBody();

        $exist = Request::checkArrayKeyExist($body);

        if($exist){

            //check email
            if(filter_var($body['email'], FILTER_VALIDATE_EMAIL) ===false){
                //Failed
                $msg = 'Please enter a valid email';
                $msgClass = 'alert-danger';
            }else{
                //Passed
                $to = Application::$CONTACT_EMAIL;
                $subject = $body['subject'];
                $from = $body['email'];

                $b  = "From: ". $body['name']. "\r\n";
                $b .= "Email: ". $from. ".\n\n";
                $b .= "Message: ". "\r\n". $body['body'];

                $headers = "From: ". $from;

                if(mail($to, $subject, $b, $headers)){
                    //Email sent
                    $sent = true;
                }else{

                    $msg = "Your email was not sent";
                    $msgClass = 'alert-danger';
                }
            }

        }else {
            $msg = 'Please fill in all fields';
            $msgClass = "alert-danger";
        }

        $params = [
            'msg'=>$msg,
            'msgClass'=>$msgClass,
            'sent' => $sent
        ];

        $html_body = Request::useHtmlSpecialChar($body);

        $this->setLayout('simple');
        return $this->render('contact', array_merge($params, $html_body));


    }

    public function dev (Request $request) {
        $this->setLayout('simple');
        return $this->render('development');
    }

    public function about(Request $request){
        $this->setLayout('simple');
        return $this->render('about');
    }
}
