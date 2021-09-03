<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class AddTheme_Action extends Typecho_Widget
{
   public function add()
	{
		//禁止非管理员访问
      $this->widget('Widget_User')->pass('administrator');
      $options = $this->widget('Widget_options');
      
      // $rename = $this->request->rename;
      $url = $this->request->url;
      $themes = __TYPECHO_ROOT_DIR__ . __TYPECHO_THEME_DIR__;
      if (!$url)
         throw new Typecho_Widget_Exception(_t('必填项都需要填写'), 401);
      
      if (!class_exists('ZipArchive'))
         throw new Typecho_Widget_Exception(_t('主机未安装ZipArchive扩展, 无法解压'), 401);

      if (!is_dir($themes))
         throw new Typecho_Widget_Exception(_t('主题目录权限不足'), 401);

      // if(is_dir($themes . DIRECTORY_SEPARATOR . $rename))
      //    throw new Typecho_Widget_Exception(_t('存在相同名字的主题目录'), 401);
      
      // mkdir($themes . DIRECTORY_SEPARATOR . $rename, 0755);

      $rename = time();
      $zipFile =  @file_get_contents($url, 0, stream_context_create(array('http'=>array('timeout'=>20)))); //设20秒超时
      if (!$zipFile) {
         throw new Typecho_Widget_Exception(_t('压缩包下载失败'), 401);
      }

      $zip = file_put_contents($themes . DIRECTORY_SEPARATOR . $rename.'.zip', $zipFile);
      
      $phpZip = new ZipArchive();
      
      $open = $phpZip->open($themes . DIRECTORY_SEPARATOR . $rename.'.zip', ZipArchive::CHECKCONS);

      if ($open !==  true) {
         throw new Typecho_Widget_Exception(_t('打开压缩包失败'), 401);
      }
      
      if (!$phpZip->extractTo($themes . DIRECTORY_SEPARATOR)) {
         throw new Typecho_Widget_Exception(_t('无法解压到主题目录'), 401);
      }
      
      $phpZip->close();
      echo '主題模板已添加';
      @unlink($themes . DIRECTORY_SEPARATOR . $rename.'.zip');
      $this->response->redirect(Typecho_Common::url('themes.php', $options->adminUrl));
	}
   
}
