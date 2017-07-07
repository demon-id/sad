<?php 
require_once "config.php";
$setup_sql[] = "DROP TABLE IF EXISTS`". DB_PREFIX ."albums`";
$sql[] = "DELETE FROM `". DB_PREFIX ."setting` WHERE `group` = 'gallery_settings'";
$sql[] = "DELETE FROM `". DB_PREFIX ."extension` WHERE `type` = 'module' AND `code` = 'gallery'";

//If Use Mysql Database + cache
require_once(DIR_SYSTEM . 'library/cache.php');
require_once(DIR_SYSTEM . 'library/cache/file.php');

$cache = new Cache('file');
$cache->delete('gallery_photos');		
$cache->delete('gallery_gallery');		
$cache->delete('gallery_module');		
$cache->delete('seo_pro_gallery');

require_once(DIR_SYSTEM . 'library/db.php');
require_once(DIR_SYSTEM . 'library/db/mysqli.php');
// Database 
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
foreach ($setup_sql as $key => $value) {
  $db->query($value);
}

$files = array(
	// admin
	"admin/view/template/gallery/album_form.tpl",
	"admin/controller/gallery/settings.php",
	"admin/controller/gallery/modules.php",
	"admin/controller/gallery/album.php",
	"admin/controller/module/gallery.php",
	"admin/view/template/gallery/modules.tpl",
	"admin/view/template/gallery/album_list.tpl",
	"admin/view/template/gallery/settings.tpl",
	"admin/language/english/gallery/index.php",
	"admin/language/english/module/gallery.php",
	"admin/language/russian/gallery/index.php",
	"admin/language/russian/module/gallery.php",
	"admin/model/gallery/index.php",
	// catalog
	"catalog/model/catalog/gallery.php",
	"catalog/controller/gallery/photos.php",
	"catalog/controller/module/gallery.php",
	"catalog/controller/gallery/gallery.php",
	"catalog/view/theme/default/template/module/gallery_photos_with_tabs.tpl",
	"catalog/view/theme/default/template/gallery/gallery.tpl",
	"catalog/view/theme/default/template/gallery/photos.tpl",
	"catalog/view/theme/default/template/module/gallery_photos_without_tabs.tpl",
	"catalog/view/theme/default/template/module/gallery_gallery_grid.tpl",
	"catalog/view/theme/default/template/module/gallery_gallery_list.tpl",
	"catalog/controller/common/seo_gallery.php",
	"catalog/view/theme/default/stylesheet/photo_gallery.manager.css",
	"catalog/controller/feed/gallery.php",
	"catalog/language/english/gallery/gallery.php",
	"catalog/language/russian/gallery/gallery.php"
);

$dirs = array(
	// admin
	"admin/model/gallery",
	"admin/controller/gallery",
	"admin/language/russian/gallery",
	"admin/language/english/gallery",
	"admin/view/template/gallery",
	// catalog
	"catalog/controller/gallery",
	"catalog/language/english/gallery",
	"catalog/language/russian/gallery",
	"catalog/view/javascript/jquery/colorbox",
	"catalog/view/javascript/jquery/fancybox",
	"catalog/view/javascript/jquery/lightbox",
	"catalog/view/theme/default/template/gallery"
);

foreach ($files as $key => $value) {
	@unlink($value);
}
foreach ($dirs as $key => $value) {
	@rmdir($value);
}
header('Content-Type: text/html; charset=utf-8');
echo "<html><head><title>Модуль галерей полностью удален. </title></head><body><h1>Модуль галерей полностью удален. </h1></body></html> ";
?>