<?php
namespace Slack;

/**
 * Inviting their own to Slack
 * @author fateyan <fateyan.tw@gmail.com>
 */

class Inviter {

    /**
     * Composer dependency, Google reCAPTCHA, \ReCaptcha\ReCaptcha
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
        $this->_captcha = new \ReCaptcha\ReCaptcha($this->_config['recaptcha']['secret']);

        // domain compatibility fixing
        $this->_config['domain'] = $this->_fixDomain($config['domain']);

    }

    /**
     * Homepage
     * @var
     */
    public function index() {
        $data['captcha']   = $this->_config['recaptcha']['sitekey'];
        $data['title']     = $this->_config['title'];
        $data['header']    = $this->_config['message']['header'];
        $data['subheader'] = $this->_config['message']['subheader'];
        $data['domain']    = $this->_config['domain'];
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

        if( !$this->_checkCaptcha($_POST) ) {
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
                $errors[] = "Invalid email.";
            if($response['error'] === 'already_invited')
                $errors[] = "We have already invited you.";
        }
        include BASE_PATH . 'views/error.php';
        return;
    }

    /**
     * Checking whether post-captcha is right
     * @param string captcha
     * @return bool
     */
    private function _checkCaptcha($post) {
        $resp = $this->_captcha->verify($post['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        return $resp->isSuccess() ? TRUE : FALSE;
    }

    /**
     * fixing domain
     *
     * for domain compatibility
     * Example:
     * fixDomain('XXXX.slack.com') // XXXX
     * fixDomain('XXXX')           // XXXX
     * fixDomain('XXXX.')          // XXXX
     * 
     * @param $domain
     * @return $fixedDomain
     */
    private function _fixDomain($domain) {
        return trim(preg_replace('/\.slack\.com/', '', $domain), '. ');
    }

    /**
     * @param array configuration of /config.inc.php
     */
    private function _checkConfig($cfg) {
        if( !is_array($cfg) ) {
            die('missing configuration');
        }
        $errors = [];
        $errors[] = empty($cfg['token']) ? "Missing SLACK_TOKEN" : '';
        $errors[] = empty($cfg['domain']) ? "Missing SLACK_DOMAIN" : '';
        $errors[] = empty($cfg['title']) ? "Missing SLACK_TITLE" : '';
        $errors[] = empty($cfg['message']['header']) ? "Missing SLACK_HEADER" : '';
        $errors[] = empty($cfg['message']['subheader']) ? "Missing SLACK_SUB_HEADER" : '';
        $errors[] = empty($cfg['message']['succeed']) ? "Missing SLACK_SUCCEED" : '';
        $errors[] = empty($cfg['message']['fail']) ? "Missing SLACK_FAILED" : '';
        $errors[] = empty($cfg['recaptcha']['sitekey']) ? "Missing RECAPTCHA_SITEKEY" : '';
        $errors[] = empty($cfg['recaptcha']['secret']) ? "Missing RECAPTCHA_SECRET" : '';
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
