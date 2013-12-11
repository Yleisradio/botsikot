<?php

class SiteController extends Controller
{

    public function actionIndex()
    {
        $headings = new Heading('search');
        $headings->unsetAttributes();
        if (isset($_GET['Heading'])) {
            $headings->attributes = $_GET['Heading'];
        }
        $this->render('index', array(
            'headings' => $headings,
            'headingsData' => $headings->search(),
        ));
    }

    public function actionNew()
    {
        $headings = new Heading('search');
        $headings->unsetAttributes();
        if (isset($_GET['Heading'])) {
            $headings->attributes = $_GET['Heading'];
        }
        $headingsData = $headings->searchNew();
        $this->render('new', array(
            'headings' => $headings,
            'headingsData' => $headings->searchNew(),
        ));
    }

    public function actionBest()
    {
        $headings = new Heading('search');
        $headings->unsetAttributes();
        if (isset($_GET['Heading'])) {
            $headings->attributes = $_GET['Heading'];
        }
        $headingsData = $headings->searchBest();
        $this->render('best', array(
            'headings' => $headings,
            'headingsData' => $headings->searchBest(),
        ));
    }

    public function actionHeading($id)
    {
        $heading = Heading::model()->findByPk($id);
        Yii::app()->ClientScript->registerMetaTag($heading->heading, null, null, array('property' => 'og:title'));
        Yii::app()->ClientScript->registerMetaTag(Yii::app()->getBaseUrl(true) . "/botsikko?id=" . $heading->id, null, null, array('property' => 'og:url'));
        Yii::app()->ClientScript->registerMetaTag('Botsikot', null, null, array('property' => 'og:site_name'));
        $this->render('heading', array(
            'heading' => $heading,
        ));
    }

    public function actionError()
    {
        
    }

}