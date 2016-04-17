# Slack-Inviter
A slack self-invite service written in PHP with random and fancy background

# Screenshots
![screenshot 1](https://raw.github.com/fateyan/Slack-Inviter/master/.github/screenshot1.jpg)

![screenshot 2](https://raw.github.com/fateyan/Slack-Inviter/master/.github/screenshot2.jpg)

# Building
## 1. Deploy on Heroku
[![Deploy Button](https://www.herokucdn.com/deploy/button.png)](https://www.heroku.com/deploy/?template=https://github.com/fateyan/slack-inviter)
  
## 2. Deploy on your server
1. Just clone this repo: `git clone ssh://git@github.com/fateyan/slack-inviter.git`  
2. Then run `composer install`
3. Edit `.env.example` and rename it to `.env`
  
Environment Variables:   
  
| Key               | Description                                                                              |
|-------------------|------------------------------------------------------------------------------------------|
| SLACK_TOKEN       | Slack token, it can be found on https://api.slack.com/web                                |
| SLACK_DOMAIN      | Your team name of Slack, {team_name}.slack.com                                           |
| SLACK_CHANNELS    | Separate by comma[,], it can be found on https://api.slack.com/methods/channel.list/test |
| SLACK_HEADER      | Title for invite form                                                                    |
| SLACK_SUB_HEADER  | Sub title for invite form                                                                |
| SLACK_TITLE       | Page title                                                                               |
| RECAPTCHA_SITEKEY | Site key for reCaptcha, you can get it from https://www.google.com/recaptcha/admin       |
| RECAPTCHA_SECRET  | Secret key for reCaptcha, you can get it from https://www.google.com/recaptcha/admin     |

4. There You Go~
  
Good Luck `>_>~`

