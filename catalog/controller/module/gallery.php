<?php
/**
* @author Shashakhmetov Talgat <talgatks@gmail.com>
*/
class ControllerModuleGallery extends Controller {
    private $cacher = array();
    private $current_language_id;
    private $current_store_id;

    public function __construct($registry){
        parent::__construct($registry);
        $this->current_language_id = $this->config->get('config_language_id');
        $this->current_store_id = $this->config->get('config_store_id');
    }

    /*
    * Faster check category_id and product_id
    */
    public function index($setting)
    {

        if ($this->config->get("seogallery") != 1) {

            $this->load->controller('common/seo_gallery');
            $this->config->set("seogallery", 1);

            if ($this->gallery_flag == 'photos') {
                $this->load->controller('gallery/photos');
                $this->response->output();
                exit();
            }

            if ($this->gallery_flag == 'gallery') {
                $this->load->controller('gallery/gallery');
                $this->response->output();
                exit();
            }
        }

        if ($setting['module_type'] == 2) {
            return;
        }
        $data['microtime'] = microtime(true);
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        $this->load->model('catalog/gallery');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/photo_gallery.manager.css');

        $module_cache_name = md5($setting['name'].$this->current_store_id.$this->current_language_id);
        $this->cacher = $this->cache->get('gallery_module.'.$module_cache_name);
        if (empty($this->cacher) || (!$this->config->get('config_gallery_modules_cache_enabled'))) {
            $this->cacher['galleries_link'] = $this->url->link('gallery/gallery');
            switch ($setting['module_type']) {
                case 0: // Galleries
                    $this->cacher['show_header'] = $setting['show_header'][$this->current_language_id];
                    if ($this->cacher['show_header']) {
                        $this->cacher['heading_title'] = $setting['header'][$this->current_language_id];
                    }

                    // Bootstrap
                    $bootstrap_columns = array(1=>6, 2=>5, 3=>4, 4=>3, 5=>2, 6=>1);
                    $this->cacher['bootstrap_grid'] = implode(' ', array(
                        (isset($setting['number_of_columns_xs']) && (int)$setting['number_of_columns_xs'] !== 0) ? 'col-xs-'.$bootstrap_columns[$setting['number_of_columns_xs']] : '',
                        (isset($setting['number_of_columns_sm']) && (int)$setting['number_of_columns_sm'] !== 0) ? 'col-sm-'.$bootstrap_columns[$setting['number_of_columns_sm']] : '',
                        (isset($setting['number_of_columns_md']) && (int)$setting['number_of_columns_md'] !== 0) ? 'col-md-'.$bootstrap_columns[$setting['number_of_columns_md']] : '',
                        (isset($setting['number_of_columns_lg']) && (int)$setting['number_of_columns_lg'] !== 0) ? 'col-lg-'.$bootstrap_columns[$setting['number_of_columns_lg']] : ''
                    ));

                    if (!empty($setting['album_list'])) {
                        $albums = array();
                        foreach ($setting['album_list'] as $key => $album_id) {
                            $pre_album = $this->model_catalog_gallery->getAlbum($album_id);
                            if (!empty($pre_album)) {
                                $albums[$key] = $pre_album;
                                //Add data
                                if ($setting['show_counter']) {
                                    $cached_images_name = "gallery_photos.$album_id.1.0.$this->current_store_id.$this->current_language_id";
                                    $cached = $this->cache->get($cached_images_name);
                                    if (!empty($cached)) {
                                        $albums[$key]['images'] = $cached;
                                    }else{
                                        $cached_data = $this->model_catalog_gallery->getAlbumImages($album_id);
                                        $this->cache->set($cached_images_name, $cached_data);
                                        $albums[$key]['images'] = $cached_data;
                                    }
                                }
                                //counter
                                $album_name_postfix = ($setting['show_counter'] ? ' ('.count($albums[$key]['images']).')' : '');

                                $albums[$key]['album_name'] = $albums[$key]['album_data']['album_name'][$this->current_language_id].$album_name_postfix;
                                $albums[$key]['album_link'] = $this->url->link('gallery/photos', 'album_id='.$albums[$key]['album_id']);
                                if (!empty($albums[$key]['album_data']['cover_image']['image'])) {
                                    $albums[$key]['album_data']['cover_image']['thumb'] = $this->model_tool_image->resize($albums[$key]['album_data']['cover_image']['image'], $setting['cover_image_width'], $setting['cover_image_height']);
                                }else{
                                    $albums[$key]['album_data']['cover_image']['thumb'] = $this->model_tool_image->resize('no_image.jpg', $setting['cover_image_width'], $setting['cover_image_height']);
                                }

                                $this->cacher['cover_image_width'] = $setting['cover_image_width'];
                                $this->cacher['cover_image_height'] = $setting['cover_image_height'];

                                $this->cacher['show_album_galleries_link'] = $setting['show_album_galleries_link'];
                                $this->cacher['album_galleries_link_text'] = $setting['album_galleries_link_text'][$this->current_language_id];
                            }
                        }
                        $this->cacher['albums'] = $albums;
                        if ($setting['show_covers']) {
                            $this->cacher['template_name'] = 'gallery_gallery_grid';
                        }else{
                            $this->cacher['template_name'] = 'gallery_gallery_list';
                        }
                    }else{
                        return;
                    }

                break;
                case 1: // Photos
                    $this->cacher['show_header'] = $setting['show_header'][$this->current_language_id];
                    if ($this->cacher['show_header']) {
                        $this->cacher['heading_title'] = $setting['header'][$this->current_language_id];
                    }

                    // Bootstrap
                    $bootstrap_columns = array(1=>12, 2=>6, 3=>4, 4=>3, 5=>2, 6=>1);
                    $this->cacher['bootstrap_grid'] = implode(' ', array(
                        (isset($setting['number_of_columns_xs']) && (int)$setting['number_of_columns_xs'] !== 0) ? 'col-xs-'.$bootstrap_columns[$setting['number_of_columns_xs']] : '',
                        (isset($setting['number_of_columns_sm']) && (int)$setting['number_of_columns_sm'] !== 0) ? 'col-sm-'.$bootstrap_columns[$setting['number_of_columns_sm']] : '',
                        (isset($setting['number_of_columns_md']) && (int)$setting['number_of_columns_md'] !== 0) ? 'col-md-'.$bootstrap_columns[$setting['number_of_columns_md']] : '',
                        (isset($setting['number_of_columns_lg']) && (int)$setting['number_of_columns_lg'] !== 0) ? 'col-lg-'.$bootstrap_columns[$setting['number_of_columns_lg']] : ''
                    ));

                    if (!empty($setting['photo_album_list'])) {
                        foreach ($setting['photo_album_list'] as $key => $album_id) {
                            $albums[$key] = $this->model_catalog_gallery->getAlbum($album_id);
                            if (!empty($albums[$key])) {
                                //Add data
                                if (!empty($albums[$key]['album_data']['album_description']) && $setting['show_album_description']) {
                                    $albums[$key]['album_description'] = html_entity_decode($albums[$key]['album_data']['album_description'][$this->current_language_id], ENT_QUOTES, 'UTF-8');
                                }

                                $albums[$key]['album_name'] = $albums[$key]['album_data']['album_name'][$this->current_language_id];
                                $albums[$key]['album_link'] = $this->url->link('gallery/photos', 'album_id='.$albums[$key]['album_id']);
                                $cached_images_name = "gallery_photos.$album_id.1.".$setting['photos_limit'].".$this->current_store_id.$this->current_language_id";
                                $cached = $this->cache->get($cached_images_name);
                                if (!empty($cached)) {
                                    $albums[$key]['images'] = $cached;
                                }else{
                                    $cached = $this->model_catalog_gallery->getAlbumImages($album_id, 1, $setting['photos_limit']);
                                    $this->cache->set($cached_images_name, $cached);
                                    $albums[$key]['images'] = $cached;
                                }
                                $this->cacher['show_album_link'] = $setting['show_album_link'];
                                $this->cacher['album_link_text'] = $setting['album_link_text'][$this->current_language_id];

                                $this->cacher['gallery_thumb_image_width'] = $setting['gallery_thumb_image_width'];
                                $this->cacher['gallery_thumb_image_height'] = $setting['gallery_thumb_image_height'];
                                switch ($albums[$key]['album_data']['js_lib_type']) {
                                    case 0: // ColorBox
                                        if ($this->config->get('config_gallery_include_colorbox')) {
                                            $this->cacher['scripts'][] = 'catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js';
                                            $this->cacher['styles'][] = 'catalog/view/javascript/jquery/colorbox/colorbox.css';
                                        }
                                        $albums[$key]['js_lib_type_text'] = 'colorbox';
                                    break;
                                    case 1: // LightBox
                                        if ($this->config->get('config_gallery_include_lightbox')) {
                                            $this->cacher['scripts'][] = 'catalog/view/javascript/jquery/lightbox/lightbox.min.js';
                                            $this->cacher['styles'][] = 'catalog/view/javascript/jquery/lightbox/lightbox.css';
                                        }
                                        $albums[$key]['js_lib_type_text'] = 'lightbox';
                                    break;
                                    case 2: // FancyBox
                                        if ($this->config->get('config_gallery_include_fancybox')) {
                                            $this->cacher['scripts'][] = 'catalog/view/javascript/jquery/fancybox/jquery.fancybox.pack.js';
                                            $this->cacher['styles'][] = 'catalog/view/javascript/jquery/fancybox/jquery.fancybox.css';
                                        }
                                        $albums[$key]['js_lib_type_text'] = 'fancybox';
                                    break;
                                    case 3: // Magnific PopUp
                                        if ($this->config->get('config_gallery_include_magnific_popup')) {
                                            $this->cacher['scripts'][] = 'catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js';
                                            $this->cacher['styles'][] ='catalog/view/javascript/jquery/magnific/magnific-popup.css';
                                        }
                                        $album['js_lib_type_text'] = 'magnific_popup';
                                    break;
                                }


                                foreach ($albums[$key]['images'] as $img_key => $image) {
                                    if (empty($image['image'])) {
                                        $image['thumb'] = $this->model_tool_image->resize('no_image.jpg', $setting['gallery_thumb_image_width'] , $setting['gallery_thumb_image_height']);
                                        $image['popup'] = $this->model_tool_image->resize('no_image.jpg', $setting['gallery_popup_image_width'] , $setting['gallery_popup_image_height']);
                                    }else{
                                        $image['thumb'] = $this->model_tool_image->resize($image['image'], $setting['gallery_thumb_image_width'] , $setting['gallery_thumb_image_height']);
                                        $image['popup'] = $this->model_tool_image->resize($image['image'], $setting['gallery_popup_image_width'] , $setting['gallery_popup_image_height']);
                                    }
                                    $albums[$key]['images'][$img_key] = $image;
                                }
                                $this->cacher['albums'] = $albums;
                            }
                        }

                        if (!isset($this->cacher['albums']) || empty($this->cacher['albums'])) {
                            return;
                        }

                        if (count($this->cacher['albums']) > 1 ) {
                            $this->cacher['template_name'] = 'gallery_photos_with_tabs';
                        }else{
                            $this->cacher['album'] = end($this->cacher['albums']);
                            $this->cacher['template_name'] = 'gallery_photos_without_tabs';
                        }
                    }else{
                        return;
                    }
                break;
            }
            $this->cache->set('gallery_module.'.$module_cache_name, $this->cacher);
        }

        // if (!empty($this->cacher['albums']) && $this->config->get('config_gallery_include_jstabs') && count($this->cacher['albums']) >= 2) {
        //     $this->document->addScript('catalog/view/javascript/jquery/tabs.js');
        // }

        if (!empty($this->cacher['scripts'])) {
            foreach ($this->cacher['scripts'] as $key => $script) {
                $this->document->addScript($script);
            }
        }
        if (!empty($this->cacher['styles'])) {
            foreach ($this->cacher['styles'] as $key => $style) {
                $this->document->addStyle($style);
            }
        }
        if (isset($this->request->get['album_id'])) {
            $data['current_album_id'] = (int)$this->request->get['album_id'];
        }
        $data['no_conflict'] = substr(md5(rand(0, 99)), 20);
        $data['microtime'] = microtime(true) - $data['microtime'];

        foreach ($this->cacher as $key => $value) {
            $data[$key] = $value;
        }

        if (version_compare('2.2', VERSION) <= 0) {
            return $this->load->view('module/' . $this->cacher['template_name'], $data);
        }else{
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $this->cacher['template_name'] . '.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/module/' . $this->cacher['template_name'] . '.tpl', $data);
            } else {
                return $this->load->view('default/template/module/' . $this->cacher['template_name'] . '.tpl', $data);
            }
        }
    }
}