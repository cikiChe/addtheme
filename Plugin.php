<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 在线下载主题
 * 
 * @package 在线下载主题
 * @author ciki
 * @version 0.0.1
 * @link https://blog.2pp.link/
 */
class AddTheme_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('admin/menu.php')->navBar = array('AddTheme_Plugin', 'render');
		Helper::addPanel(1, 'AddTheme/theme.php', _t('在线下载主题'), _t('在线下载主题'), 'administrator');
		Helper::addRoute('addtheme_add', __TYPECHO_ADMIN_DIR__ . 'addtheme/add', 'AddTheme_Action', 'add');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
        //卸载配置的路由
        Helper::removePanel(1,'AddTheme/theme.php');
        Helper::removeRoute('addtheme_add');
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        /** 分类名称 */
        // $name = new Typecho_Widget_Helper_Form_Element_Text('name', NULL, '???', _t('???'));
        // $form->addInput($name);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function render()
    {
        // echo '<span class="message success">'
        //     . htmlspecialchars(Typecho_Widget::widget('Widget_Options')->plugin('AddTheme')->name)
        //     . '</span>';
    }
}
