<?php

class GenerateCommand extends CConsoleCommand
{

    public function run()
    {
        $sql = 'SELECT site.title, facebook_shares + linkedin_shares + twitter_tweets AS shares
                FROM site
                WHERE site.title IS NOT NULL 
                AND published < ' . time() . '
                AND published > ' . time() . ' - 30 * 86400
                AND facebook_shares + linkedin_shares + twitter_tweets > 1
                AND url NOT LIKE  "%areena%"';
        $command = Yii::app()->db->createCommand($sql);
        $sites = $command->queryAll();
        $headings = fopen(Yii::app()->basePath . '/data/headings', 'w');
        foreach ($sites as $site) {
            fputs($headings, $site['title'] . "\r\n");
        }
        fclose($headings);

        $cmd = 'python ' . Yii::app()->basePath . '/python/titles.py ' . Yii::app()->basePath . '/data/headings'  . ' > ' . Yii::app()->basePath . '/data/generated_headings';
        exec($cmd);
        
        $generatedHeadings = fopen(Yii::app()->basePath . '/data/generated_headings', 'r');
        if ($generatedHeadings) {
            while (($heading = fgets($generatedHeadings, 4096)) !== false) {
                $headingModel = Heading::model()->findByAttributes(array('heading' => $heading));
                if (!$headingModel) {
                    $headingModel = new Heading();
                    $headingModel->heading = trim($heading);
                    $headingModel->generated = time();
                    $headingModel->save();
                }
            }
            if (!feof($generatedHeadings)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($generatedHeadings);
        }
    }

}
