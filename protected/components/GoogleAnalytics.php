<?php

/**
 * Google Analytics wrapper
 */
class GoogleAnalytics
{

    /**
     * Echoes Google Analytics script
     */
    public static function echoTrackingScript()
    {
        if (isset(Yii::app()->params['googleAnalytics']))
            if (isset(Yii::app()->params['googleAnalytics']['id'])) {
                ?>
                <script type="text/javascript">
                    var _gaq = _gaq || [];
                    _gaq.push(['_setAccount', '<?php echo Yii::app()->params['googleAnalytics']['id']; ?>']);
                    _gaq.push(['_trackPageview']);

                    (function() {
                        var ga = document.createElement('script');
                        ga.type = 'text/javascript';
                        ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(ga, s);
                    })();
                </script>
                <?php
            }
    }

}