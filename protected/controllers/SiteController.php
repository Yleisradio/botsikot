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
        ));
    }

    public function actionError()
    {
        
    }

}