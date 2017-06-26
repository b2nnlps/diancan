<?php
/**
 * Created by crazyfd.
 * User: Administrator
 * Date: 2014/10/12
 * Time: 10:25
 */
namespace common\widgets;

use yii;
use yii\helpers\Html;
use yii\helpers\Url;

class FileInput extends \yii\widgets\InputWidget
{
    public $maxnum = 5;
    public $url = [];
    public $name = '';
    public $dir;
    public $width =500;
    public $height = null;
    public function init()
    {
        parent::init();
        if($this->url){
            $this->value = implode(',',$this->url);
        }
        $this->value = $this->value ? $this->value : ($this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : '') ;
        $this->registerClientScript();
    }

    public function run()
    {
        $name = $this->name ? $this->name : ($this->hasModel() ? Html::getInputName($this->model, $this->attribute) : $this->id);
        $fileInputName = $this->attribute;
        $token = Yii::$app->request->getCsrfToken();
        $tokenName = Yii::$app->request->csrfParam;
        $srcipt = '';
        $photos = explode(',',$this->value);
        if ($photos) {
            $srcipt .= '<script type="text/uploader-files">[';
            foreach($photos as $value){
                $srcipt .= '{"name":"test.jpg","url": "' . $value . '","desc":"iimages"},';
            }
            $srcipt = substr($srcipt,0,-1);
            $srcipt .=']</script>';
        }
        $html = <<<EOD
        <div class="grid">
                <input type="file" class="g-u" id="J_{$this->options['id']}" value="上传图片" name="{$fileInputName}" accept="image/*" postData='{"{$tokenName}":"{$token}","dir":"{$this->dir}","width":"{$this->width}","height":"{$this->height}"}' />
                <input type="hidden" id="{$this->options['id']}" name="{$name}" value="{$this->value}" />

        </div>
        <ul id="J_que_{$this->options['id']}" class="grid">{$srcipt}</ul>
EOD;
        return $html;
    }

    protected function registerClientScript()
    {
        if(isset($_SESSION['uploadnum'])){$this->maxnum=$_SESSION['uploadnum'];}
        $url = Url::to(['/site/upload', 'type' => 'input']);
        $id = $this->options['id'];
        $view = $this->getView();
        $view->registerJsFile('http://g.tbcdn.cn/kissy/k/1.4.2/seed-min.js');
        $js = <<<EOD
            KISSY.config({
            packages:[
                {
                    name:"kg",
                    path:"http://g.tbcdn.cn/kg/",
                    charset:"utf-8",
                    ignorePackageNameInUri:true
                }
            ]
        });
EOD;
        $init = $this->value ? 'uploader.restore();' : '';
        $view->registerJs($js);
        $js = <<<EOD
        KISSY.use('kg/uploader/2.0.0/index,kg/uploader/2.0.0/themes/imageUploader/index,kg/uploader/2.0.0/themes/imageUploader/style.css', function (KISSY, Uploader,ImageUploader) {
            //上传组件插件
             var plugins = 'kg/uploader/2.0.0/plugins/auth/auth,' +
                'kg/uploader/2.0.0/plugins/urlsInput/urlsInput,' +
                'kg/uploader/2.0.0/plugins/proBars/proBars,' +
                'kg/uploader/2.0.0/plugins/filedrop/filedrop,' +
                'kg/uploader/2.0.0/plugins/preview/preview,' +
                'kg/uploader/2.0.0/plugins/tagConfig/tagConfig';

            KISSY.use(plugins,function(KISSY,Auth,UrlsInput,ProBars,Filedrop,Preview,TagConfig){
                var uploader = new Uploader('#J_{$id}',{
                    //处理上传的服务器端脚本路径
                    action:"{$url}"
                });
//                uploader.on('add',function(ev){
//                    var file = ev.file;
//                    var target = file.target;
//                    //alert();
//                });
//              uploader.on('success',function(ev){
//                 var result =ev.result;
//                 alert(result.thumb);
//               });
                //使用主题
                uploader.theme(new ImageUploader({
                    queueTarget:'#J_que_{$id}'
                }))
                //验证插件
                uploader.plug(new Auth({
                    //最多上传个数
                    max:{$this->maxnum},
                    //图片最大允许大小
                   // maxSize:2048
                    maxSize:1000
                }))
                //url保存插件
                .plug(new UrlsInput({target:'#{$id}'}))
                //进度条集合
                .plug(new ProBars())
                //拖拽上传
                .plug(new Filedrop())
                //图片预览
                .plug(new Preview())
                .plug(new TagConfig())
                ;
                {$init}
            });
        })
EOD;
        $view->registerJs($js);
    }
}
