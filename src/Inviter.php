<?php
namespace Slack;

/**
 * Inviting their own to Slack
 * @author fateyan <fateyan.tw@gmail.com>
 */

class Inviter {

    /**
     * Composer dependency, \Gregwar\Captcha\CaptchaBuilder
     * @var object
     */
    private $_captcha;

    /**
     * Coniguration in public/index.php
     * @var array
     */
    private $_config;

    public function __construct($config) {
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
        $data['captcha']   = $this->_getCaptcha();
        $data['title']     = $this->_config['title'];
        $data['header']    = $this->_config['message']['header'];
        $data['subheader'] = $this->_config['message']['subheader'];
        $data['postTo']    = 'send';

        include BASE_PATH . 'views/header.php';
        include BASE_PATH . 'views/content.php';
        include BASE_PATH . 'views/footer.php';
        return;
    }

    /**
     * A page for send invitation request to Slack
     * @uses $_POST(email, firstname, lastname, captcha)
     */
    public function send() {
        $data = [];
        $errors = [];
        $message = $this->_config['message'];

        if( isset($_POST['captcha']) )
            if( !$this->_checkCaptcha($_POST['captcha']) ) {
                $errors[] = 'Your captcha is wrong.';
                include BASE_PATH . 'views/error.php';
                return;
            }
        if( empty($_POST['email']) ) {
            $errors[] = 'Your email is empty.';
            include BASE_PATH . 'views/error.php';
            return;
        }

        $data['email'] = $_POST['email'];

        if( isset($_POST['firstname']) )
            $data['firstname'] = $_POST['firstname'];
        if( isset($_POST['lastname']) )    
            $data['lastname'] = $_POST['lastname'];

        $response = json_decode($this->_slackInvite($data), TRUE);

        if(isset($response['ok']) && $response['ok'] === TRUE) {
            include BASE_PATH . 'views/succeed.php';
            return;
        } 

        if(isset($response['error'])) {
            if($response['error'] === 'invalid_email')
                $errors[] = "Your email is invalid.";
            if($response['error'] === 'already_invited')
                $errors[] = "You has already been invited.";
        }
        include BASE_PATH . 'views/error.php';
        return;
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
        $errors = [];
        $errors[] = empty($cfg['token']) ? "This application missing config['token']." : '';
        $errors[] = empty($cfg['domain']) ? "This application missing config['domain']." : '';
        $errors[] = empty($cfg['title']) ? "This application missing config['title']." : '';
        $errors[] = empty($cfg['message']['header']) ? "This application missing config['header']." : '';
        $errors[] = empty($cfg['message']['subheader']) ? "This application missing config['subheader']." : '';
        $errors[] = empty($cfg['message']['succeed']) ? "This application missing config['succeed']." : '';
        $errors[] = empty($cfg['message']['fail']) ? "This application missing config['fail']." : '';
        $errors = array_filter($errors);
        if(!empty($errors)) {
            $message['fail'] = 'Missing configuration.';
            include BASE_PATH . "views/error.php";
            die();
            return;
        }

        return;
    }

    /**
     * @param array postdata(email, [firstname], [lastname])
     */ 
    private function _slackInvite($data) {
        $postdata = [];
        $url = 'https://' . $this->_config['domain'] . '.slack.com/api/users.admin.invite?t=' . time();
        if(!empty($config['channels']))
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
        $options = [
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_URL => $url,
            CURLOPT_POST => TRUE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_POSTFIELDS => $postdata
        ];
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        return $response;
    }
}
