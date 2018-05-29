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
class AppAssetSimplex_lt extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/simplex/html5shiv.js',
        'js/simplex/respond.min.js',
    ];
    // указывает, где подключать скрипты (вверху POS_BEGIN\внизу POS_END)
    public $jsOptions = [
        'condition' => 'lte IE9',
        'position' => \yii\web\View::POS_HEAD,
    ];
}
