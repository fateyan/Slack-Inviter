<?php
namespace Fateyan;

class SlackInviter {
    private $captcha;
    private $phrase;
    private $config;

    public function __construct($config) {
        //---init---//
        $this->_checkConfig($config);
        $this->config = $config;
        $this->captcha = new \Gregwar\Captcha\CaptchaBuilder();
    }

    public function index() {
        $data['title']          = $this->config['title'];
        $data['welcomeMessage'] = $this->config['welcomeMessage'];
        include 'views/header.php';
        include 'views/content.php';
        include 'views/footer.php';
        return;
    }

    public function getPostData() {
        if(isset($_POST['email'])) {
      
        }
    }

    private function _setCaptcha() {
        $_SESSION['phrase'] = $this->captcha->build();
        return $phrase;
    }

    private function checkCaptcha($post) {
        if( empty($_SESSION['phrase'] ) )
            return;
        if( $post === $_SESSION['phrase'] ) {
            return TRUE;
        }
        return FALSE;
    }

    private function _getCaptcha() {
        return $this->captcha->inline();
    }

    private function _checkConfig($cfg) {
        if( !is_array($cfg) ) {
            die('missing configuration');
        }
        $message = array();
        $message[] = empty($cfg['token']) ? "mssing config['token']" : '';
        $message[] = empty($cfg['domain']) ? "mssing config['domain']" : '';
        $message[] = empty($cfg['channels']) ? "mssing config['channel']" : '';
        $message[] = empty($cfg['title']) ? "mssing config['title']" : '';
        $message[] = empty($cfg['welcomeMessage']) ? "mssing config['welcomeMessage']" : '';
        $message = array_filter($message);
        if(empty($message)) {
            return;
        }

        foreach( $message as $var) {
            echo $var . "<br>";
        }
        die();
    }
     
    private function _slackInvite($email, $firstName = '', $lastName = '') {
        $postdata = array();
        $url = $this->config['domain'] . 'slack.com/api/users.admin.invite?t=' . time();
        $postdata['channels'] = implode(",", $this->config['channels']);
        $postdata['set_active'] = 1;
        $postdata['token'] = $this->config['token'];
        $postdata['email'] = $email;
        
        if( !empty($firstname) ) {
            $postdata['firstname'] = $firstname;
        }

        if( !empty($lastname) ) {
            $postdata['lastname'] = $lastname;
        }

        $temp = '';
        foreach( $postdata as $key => $value ) {
            $temp .= $key . "=" . $value . "&";
        }
        $postdata = substr($temp, 0, -1);//$temp "key=value&key=value&"


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        //curl_exec($curl);
        
        return $curl;
    }
}
