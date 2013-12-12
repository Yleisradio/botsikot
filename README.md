# Botsikot


## Dependencies
- Yii Framework 1.1.14 ( http://www.yiiframework.com/download/ )
- PHP 5.1.6 or newer
- php5-curl
- Apache mod_rewrite
- MySQL
- APC-Cache

## Installation
- `git clone https://github.com/Zeikko/botsikot.git`
- `cd botsikot/protected`
- `./deploy.sh`
- Download the latest version of Yii framework (1.x.x) from http://www.yiiframework.com/download/
- Edit the correct location of Yii framework to botsikot/shared/config/bootstrap.php (line 6)
- Create MySQL credentials and database
- Configure the correct database information to botsikot/shared/config/common.php
- `./deploy.sh`
- `php5 botsikot/protected/yiic.php migrate`

## Usage

### Generating headings
`php5 botsikot/protected/ yiic.php generate`

### Send Tweets
`php5 botsikot/protected/ yiic.php sendTweet`

## Updating
- `git reset --hard`
- `git pull https://github.com/Zeikko/botsikot.git`
- `cd kato-ite/protectedv
- `./deploy.sh`
