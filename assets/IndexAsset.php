<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/25/15
 * Time: 10:14 PM
 */

namespace app\assets;


class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/index.css',
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}