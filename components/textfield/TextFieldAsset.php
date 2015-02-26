<?php
namespace mii\components\textfield;
use yii\web\AssetBundle;

class TextFieldAsset extends AssetBundle
{

    public $sourcePath = '@app/components/textfield/js';
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