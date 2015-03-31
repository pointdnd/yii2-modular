<?php
namespace mii\map;
use yii\web\AssetBundle;

class MapFieldAsset extends AssetBundle
{

    public $sourcePath = '@mii/map/js';
    public $jsOptions = [
        'position'=>\yii\web\View::POS_HEAD
    ];
    public $js = [
        'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=drawing',
        'googleMap.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}