<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo CHtml::encode('Botsikot'); ?></title>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <script src="http://tunnus.yle.fi/xdomain.js" slave="https://login.api.yle.fi/v1/xdomain/proxy.html?app_id=59476439&app_key=0e8f095d8c0b432d223bd1dd04f3ea3d"></script>
        <script src="http://tunnus.yle.fi/xdomain.js" slave="http://tunnus.yle.fi/yletunnus/proxy.html"></script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <script src="http://tunnus.yle.fi/xdomain.js" slave="https://profiles.api.yle.fi/v1/xdomain/proxy.html?app_id=<?php echo Yii::app()->params['profilesApi']['appId'] ?>&app_key=<?php echo Yii::app()->params['profilesApi']['appKey'] ?>"></script>
    </head>
    <body>
        <?php
        GoogleAnalytics::echoTrackingScript();
        ?>
        <?php echo $content; ?>
        <script data-main="<?php echo Yii::app()->baseUrl; ?>/js/login" src="<?php echo Yii::app()->baseUrl; ?>/js/require.js"></script>
    </body>
</html>