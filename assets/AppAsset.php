<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/plugins/fontawesome-free/css/all.min.css',
        '/dist/css/adminlte.min.css',
        '/css/style.css',        
    ];
    public $js = [
        '/plugins/bootstrap/js/bootstrap.bundle.min.js',
        '/dist/js/adminlte.min.js',
        '/js/scripts.js',        
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
