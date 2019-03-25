<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class UMEditor extends Field
{
    public static $js = [
        'packages/umeditor/umeditor.config.js',
        'packages/umeditor/umeditor.min.js',
        'packages/umeditor/lang/zh-cn/zh-cn.js'
    ];

    public static $css = [
        'packages/umeditor/themes/default/css/umeditor.css'
    ];

    protected $view = 'admin.umeditor';

    public function render()
    {
        $this->script = <<<EOT
        //解决第二次进入加载不出来的问题
        UM.delEditor("ueditor");
        // 默认id是ueditor
        var ue = UM.getEditor('ueditor', {
            // 自定义工具栏
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'source', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode: true,
            wordCount: false,
            imagePopup: false,
            autotypeset: {indent: true, imageBlockLine: 'center'}
        });
EOT;
        return parent::render();
    }
}
