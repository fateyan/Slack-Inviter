# Slack-Inviter
A Slack Inviter Written By PHP

# Building
## Deploy on Heroku
[![Deploy Button](https://www.herokucdn.com/deploy/button.png)](https://www.heroku.com/deploy/?template=https://github.com/fateyan/slack-inviter)
## Or You Can Set Up It by Yourself
1. Just Clone this Repo: `git clone ssh://git@github.com/fateyan/slack-inviter.git`  
2. Then run `composer install`
3. Set Up Environment Variables  
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
