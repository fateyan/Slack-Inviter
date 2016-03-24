# Slack-Inviter
A slack self-invite service written in PHP with random and fancy background

# Screenshots
![screenshot 1](https://raw.github.com/fateyan/Slack-Inviter/master/screenshot1.jpg)

![screenshot 2](https://raw.github.com/fateyan/Slack-Inviter/master/screenshot2.jpg)

# Building
## Deploy on Heroku
[![Deploy Button](https://www.herokucdn.com/deploy/button.png)](https://www.heroku.com/deploy/?template=https://github.com/fateyan/slack-inviter)
## Or you can set up it by yourself
1. Just clone this repo: `git clone ssh://git@github.com/fateyan/slack-inviter.git`  
2. Then run `composer install`
3. Set up environment variables  
For Nginx:
```nginx
fastcgi_param SLACK_TOKEN yourtoken;  
fastcgi_param SLACK_DOMAIN yourdomain;  
fastcgi_param SLACK_CHANNELS channel1,channel2,channel3;  
fastcgi_param SLACK_HEADER "Join&nbsp;our&nbsp;Slack";  
fastcgi_param SLACK_SUB_HEADER "Welcome";
fastcgi_param SLACK_INVITE_SUCCEED "Congratulations";
fastcgi_param SLACK_INVITE_FAIL "Error";
```
For Apache:
```
SetEnv VariableName VariableValue
```
4. There You Go~
  
Good Luck `>_>~`
