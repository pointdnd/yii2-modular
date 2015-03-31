<?php
namespace mii\textfield;
use yii\web\AssetBundle;

class TextFieldAsset extends AssetBundle
{

    public $sourcePath = '@mii/textfield/js';
    public $jsOptions = [
        'position'=>\yii\web\View::POS_HEAD
    ];
    public $js = [
        'charCount.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}