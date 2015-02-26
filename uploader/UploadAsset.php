<?php
namespace mii\uploader;
use yii\web\AssetBundle;

class UploadAsset extends AssetBundle
{

    public $sourcePath = '@mii/uploader/js';
    public $jsOptions = [
        'position'=>\yii\web\View::POS_HEAD
    ];
    public $js = [
        'fileuploader.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}