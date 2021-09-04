<?php
// include 'common.php';
include 'header.php';
include 'menu.php';
?>

<div class="main">
    <div class="body container">
        <div class="row typecho-page-main" role="form">
            <div class="col-mb-12 col-tb-8 col-tb-offset-2">
                <?php 
                    $widget_options = Typecho_Widget::widget('Widget_Options');

                    $url = Typecho_Common::url(__TYPECHO_ADMIN_DIR__ . 'addtheme/add', $widget_options->index);
                    $form = new Typecho_Widget_Helper_Form($url, 'post');

                    $input_desc =  _t('目前支持 zip 压缩下载,例如： ') . '<br/><strong><a href="https://baidu.com/1.zip">https://baiduc.com/1.zip</a>';
                    $input = new Typecho_Widget_Helper_Form_Element_Textarea('url', NULL, '', _t('主题下载地址(必填)'), $input_desc);
                    $form->addInput($input);

                    // $input_desc = _t('解压缩后主题目录的名字（非常重要，因为目录名字错误的话，将会导致日后无法管理主题）');
                    // $input = new Typecho_Widget_Helper_Form_Element_Text('rename', NULL, '', _t('重命名(必填)'), $input_desc);
                    // $form->addInput($input);
                    
                    $submit = new Typecho_Widget_Helper_Form_Element_Submit('button', NULL, _t('确认提交？'));
                    $form->addInput($submit);
                   
                    $form->render();
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'form-js.php';
include 'footer.php';
?>