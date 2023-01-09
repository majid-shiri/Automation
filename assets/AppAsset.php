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
        'web/css/site.css',
        'web/css/nprogress/nprogress.css',
        'web/css/datepicker/persian-datepicker.min.css',
        'web/css/select2/select2.min.css',
        'web/fileuploader/dist/font/font-fileuploader.css',
        'web/fileuploader/dist/jquery.fileuploader.min.css',
        'web/css/uploader/shieldui-all.min.css',
    ];
    public $js = [
        'web/js/adm.js',
        'web/js/bootstrap.bundle.min.js',
        'web/js/nprogress/nprogress.js',
        'web/js/datepicker/persian-date.min.js',
        'web/js/datepicker/persian-datepicker.min.js',
        'web/ckeditor5/build/ckeditor.js',
        'web/js/sweetalert/sweetalert2.all.js',
        'web/js/select2/select2.min.js',
        'web/js/uploader/shieldui-all.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap4\BootstrapAsset',
        'rmrevin\yii\fontawesome\CdnProAssetBundle',
        'fedemotta\datatables\DataTablesAsset',
    ];
}
