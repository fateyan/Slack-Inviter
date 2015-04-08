<?php
namespace Fateyan;

/**
 * Slack invite their own
 * @author fateyan <fateyan.tw@gmail.com>
 */

class SlackInviter {

    /**
     * Composer dependency, \Gregwar\Captcha\CaptchaBuilder
     * @var object
     */
    private $_captcha;

    /**
     * Storing configuration of /config.inc.php
     * @var array
     */
    private $_config;


    public function __construct($config) {
        //---init---//
        $this->_checkConfig($config);
        $this->_config = $config;
        $this->_captcha = new \Gregwar\Captcha\CaptchaBuilder();
    }

    /**
     * Homepage
     * @var
     */
    public function index() {
        $this->_setCaptcha();
        $data['captcha']        = $this->_getCaptcha();
        $data['title']          = $this->_config['title'];
        $data['welcomeMessage'] = $this->_config['welcomeMessage'];
        include BASE_PATH . 'views/header.php';
        include BASE_PATH . 'views/content.php';
        include BASE_PATH . 'views/footer.php';
        return;
    }

    /**
     * A page for get postData
     * post(email, firstname, lastname, captcha)
     */
    public function postData() {
        $data = array();
        if( isset($_POST['captcha']) ) {
            if( !$this->_checkCaptcha($_POST['captcha']) )
                die('wrong captcha');
        }
        if( isset($_POST['firstname']) )
            $data['firstname'] = $_POST['firstname'];

        if( isset($_POST['lastname']) )    
            $data['lastname'] = $_POST['lastname'];

        if( empty($_POST['email']) ) {
            die('<a href="index.php">missing email</a>');
        }
        $data['email'] = trim($_POST['email']);

        $this->_slackInvite($data);
    }

    /**
     * set captcha
     */
    private function _setCaptcha() {
        $this->_captcha->build();
        $_SESSION['phrase'] = $this->_captcha->getPhrase();
        return;
    }

    /**
     * Checking whether post-captcha is right
     * @param string captcha
     * @return bool
     */
    private function _checkCaptcha($post) {
        $phrase = $_SESSION['phrase'];
        $this->_captcha->build();
        if( empty( $phrase ) )
            return FALSE;
        if( $post === $phrase ) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @return string image of captcha
     */
    private function _getCaptcha() {
        return $this->_captcha->inline();
    }

    /**
     * @param array configuration of /config.inc.php
     */
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

    /**
     * @param array postdata(email, [firstname], [lastname])
     */ 
    private function _slackInvite($data) {
        $postdata = array();
        $url = 'https://' . $this->_config['domain'] . '.slack.com/api/users.admin.invite?t=' . time();
        $postdata['channels'] = $this->_config['channels'];
        $postdata['set_active'] = 1;
        $postdata['token'] = $this->_config['token'];
        $postdata['email'] = $data['email'];
        
        if( !empty($data['firstname']) ) {
            $postdata['firstname'] = $data['firstname'];
        }

        if( !empty($data['lastname']) ) {
            $postdata['lastname'] = $data['lastname'];
        }

        $postdata = http_build_query($postdata);

        $curl = curl_init();
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_URL => $url,
            CURLOPT_POST => TRUE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_POSTFIELDS => $postdata
        );
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        return $response;
    }
}
