<?php
namespace mii\components\web;

use yii\web\Controller as BaseController;

class Controller extends BaseController
{
    public function actionUpload()
    {
        $uploader = new \mii\components\uploader\UploadHandler();
        $uploader->upload(array('png','jpg','jpeg','csv','xls','xlsx','doc','docx','pdf','rar','zip','txt','mp4','mp3','mov','swf'),30 * 1024 * 1024);
    }
}