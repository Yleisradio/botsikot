<?php

class GenerateCommand extends CConsoleCommand
{

    /**
     * Create a file with the source material to /data/headings
     * Create a file with the generated headings to /data/generated_headings 
     */
    public function run()
    {
        $this->getSourceMaterial();
        $this->generateHeadings();
    }

    /**
     * Save the source material to data/headings
     * NOTE: This function does not work out of the box as it relies on database tables not in the scope of this project.
     * Included only for demonstration purposes.
     */
    protected function getSourceMaterial()
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
    }

    /**
     * Generate the headings using the source material at data/headings
     * The source material needs to be a text file where entries are separated by line break.
     */
    protected function generateHeadings()
    {
        $cmd = 'python ' . Yii::app()->basePath . '/python/titles.py ' . Yii::app()->basePath . '/data/headings' . ' > ' . Yii::app()->basePath . '/data/generated_headings';
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
