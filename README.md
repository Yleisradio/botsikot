# Botsikot
Botsikot is a web application that creates fictional headlines applying Markov Chains to real headlines used as source material.
Users can give "thumbs up" to headlines displayed in a list.
The headlines with the most thumbs up can be tweeted automatically.
Botsikot can be customized to generate other kind of content by changing the source material.
Botsikot does not work out of the box as it does not include enough source material.
You need to manually put the source material to `botsikot/protected/data/headings` and comment out line 13 in `botsikot/protected/commands/GenerateCommand.php`
You can also implement your own way of fetching the source material from a database.

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
You need to customize botsikot/protected/command/GenerateCommand.php for this to work with your source material
`php5 botsikot/protected/ yiic.php generate`

### Send Tweets
`php5 botsikot/protected/ yiic.php sendTweet`

## Updating
- `git reset --hard`
- `git pull https://github.com/Zeikko/botsikot.git`
- `cd kato-ite/protected`
- `./deploy.sh`
