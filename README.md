# Slack-Inviter
Slack Inviter By PHP

## You can deploy it on heroku
[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://www.heroku.com/deploy/?template=https://github.com/fateyan/slack-inviter)
## Or You can set it up by yourself
1. Clone it :`git clone https://github.com/fateyan/slack-inviter.git`  
(remove /.git directory when you are in production environment) 
2. `composer install`
3. Set Environment Variable  
nginx:  
```nginx
fastcgi_param SLACK_TOKEN yourtoken;  
fastcgi_param SLACK_DOMAIN yourdomain;  
fastcgi_param SLACK_CHANNELS channel1,channel2,channel3;  
fastcgi_param SLACK_HEADER "Join&nbsp;our&nbsp;Slack";  
fastcgi_param SLACK_SUB_HEADER "Welcome";
```
apache:
```
SetEnv VariableName VariableValue
```
...etc  
4. Run your server  
  
Good Luck `>_>~`
