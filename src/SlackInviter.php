<?php
namespace Fateyan;

class SlackInviter {

    private $config;
    private $captcha;
    private $phrase;

    public function __construct($config) {
        //---init---//
        $this->config = $config;
        $this->captcha = new Gregwar\Captcha\CaptchaBuilder;

	}

    public function index() {
        
    }

    private function _setCaptcha() {
        $this->captcha->build();
        $phrase = $this->captcha->getPhrase();
        $_SESSION['phrase'] = $phrase;
        return;
    }

    
}
