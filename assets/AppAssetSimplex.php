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
class AppAssetSimplex extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/simplex/templatemo_justified.css',
        'css/simplex/article.css',
        // UItoTop jQuery Plugin 1.2:
        'css/simplex/ui.totop.css',
    ];
    public $js = [
        'js/menu_ms_widget/jquery.accordion.js',
        'js/menu_ms_widget/jquery.cookie.js',
        'js/simplex/main.js',
        // UItoTop jQuery Plugin 1.2:
        'js/simplex/ulto_plugin/easing.js',
        'js/simplex/ulto_plugin/jquery.ui.totop.js',
        'js/simplex/ulto_plugin/jquery.ui.totop.min.js',
        
    ];
    // указывает, где подключать скрипты (вверху POS_BEGIN\внизу POS_END)
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];
    // зависимости:
    public $depends = [
        'yii\web\YiiAsset',
        // подключает стили бутстрап
        //'yii\bootstrap\BootstrapAsset',

        // подключает и стили js бутстрап
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
