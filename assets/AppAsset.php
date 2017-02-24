<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/font-awesome.min.css',
        'css/simple-line-icons.css',
    ];
    public $js = [
    //'bower_components/jquery/dist/jquery.min.js',
    'bower_components/tether/dist/js/tether.min.js',
    'bower_components/bootstrap/dist/js/bootstrap.min.js',
    'bower_components/pace/pace.min.js',
    'js/app.js',
    'https://api-maps.yandex.ru/2.1/?lang=ru_RU',
    'js/event_reverse_geocode.js',
    //'js/views/main.js',
    //'bower_components/chart.js/dist/Chart.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}








