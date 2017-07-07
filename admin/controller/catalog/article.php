<?php 
class ControllerCatalogArticle extends Controller { 
	private $error = array();
	private $article_id = 0;
	private $path = array();
 
	public function index() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/article');
		 
		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/article');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$article_id = $this->model_catalog_article->addArticle($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->post['apply'])) { 
	
			if (isset($this->request->get['article_id'])) {	
				$this->response->redirect($this->url->link('catalog/article/edit', 'token=' . $this->session->data['token'] . '&article_id=' . $this->request->get['article_id'] . $url, true)); 
			} else {
				$this->response->redirect($this->url->link('catalog/article/edit', 'token=' . $this->session->data['token'] . '&article_id=' . $article_id . $url, true)); 
			} 
			} else {
				$this->response->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'] . $url, true));
			}

		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/article');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_article->editArticle($this->request->get['article_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->post['apply']) && isset($this->request->get['article_id'])) {	
				$this->response->redirect($this->url->link('catalog/article/edit', 'token=' . $this->session->data['token'] . '&article_id=' . $this->request->get['article_id'] . $url, true)); 
			} else {
				$this->response->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'] . $url, true));
			}
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/article');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $article_id) {
				$this->model_catalog_article->deleteArticle($article_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}


			$this->response->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = NULL;
		}

		if (isset($this->request->get['filter_category'])) {
			$filter_category = $this->request->get['filter_category'];
		} else {
			$filter_category = NULL;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ad.name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->document->addStyle('view/stylesheet/articles.css');

   		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/article', 'token=' . $this->session->data['token'] . $url, true)
   		);
									
		$data['add'] = $this->url->link('catalog/article/add', 'token=' . $this->session->data['token'], true);
		$data['delete'] = $this->url->link('catalog/article/delete', 'token=' . $this->session->data['token'], true);
		
		$data['articles'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
      			'filter_category' => $filter_category,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$article_total = $this->model_catalog_article->getTotalArticles($filter_data);

		$results = $this->model_catalog_article->getArticlesList($filter_data);

		foreach ($results as $result) {

			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$category = $this->model_catalog_article->getArticleCategory($result['parent_id']);

			$data['articles'][] = array(
				'article_id' => $result['article_id'],
				'image'      => $image,
				'name'        => $result['name'],
				'category'  => $category,
				'sort_order'  => $result['sort_order'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'edit'        => $this->url->link('catalog/article/edit', 'token=' . $this->session->data['token'] . '&article_id=' . $result['article_id'] . $url, true),
				'delete'      => $this->url->link('catalog/article/delete', 'token=' . $this->session->data['token'] . '&article_id=' . $result['article_id'] . $url, true)
			);
		}

		$filter_data_categories = array(
			'category'        => 1,
			'filter_name' => '',
			'sort'        => 'name',
			'order'       => 'ASC',
			'start'       => 0,
			'limit'       => 1000
		);

		$data['categories'] = $this->model_catalog_article->getArticles($filter_data_categories);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_category'] = $this->language->get('entry_category');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_category'] = $this->language->get('column_category');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['error_selected'] = $this->language->get('error_selected');

		$data['token'] = $this->session->data['token'];
 
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/article', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_sort_order'] = $this->url->link('catalog/article', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);
		$data['sort_date_added'] = $this->url->link('catalog/article', 'token=' . $this->session->data['token'] . '&sort=date_added' . $url, true);

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $article_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/article', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($article_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($article_total - $this->config->get('config_limit_admin'))) ? $article_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $article_total, ceil($article_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_category'] = $filter_category;
		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/article_list', $data));
	}

	protected function getForm() {
	    //CKEditor
		$data['lang'] = '';
	    if ($this->config->get('config_editor_default')) {
	        $this->document->addScript('view/javascript/ckeditor/ckeditor.js');
	        $this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
	    } else {
	        $this->document->addScript('view/javascript/summernote/summernote.js');
	    	if ($this->language->get('code') == 'ru') {
		$data['lang'] = 'ru-RU';
	        $this->document->addScript('view/javascript/summernote/lang/summernote-ru-RU.js');
		}
	        $this->document->addScript('view/javascript/summernote/opencart.js');
	        $this->document->addStyle('view/javascript/summernote/summernote.css');
	    }

		$this->document->addStyle('view/stylesheet/articles.css');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['article_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_cat_edit'] = $this->language->get('text_cat_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');		
		$data['text_enabled'] = $this->language->get('text_enabled');
    	$data['text_disabled'] = $this->language->get('text_disabled');
    	$data['text_disabled_list'] = $this->language->get('text_disabled_list');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');
				
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_cat_name'] = $this->language->get('entry_cat_name');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_alternative_link'] = $this->language->get('entry_alternative_link');
		$data['entry_short_description'] = $this->language->get('entry_short_description');
		$data['entry_cat_additional_description'] = $this->language->get('entry_cat_additional_description');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_cat_description'] = $this->language->get('entry_cat_description');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_related_title'] = $this->language->get('entry_related_title');
		$data['entry_related'] = $this->language->get('entry_related');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_parent'] = $this->language->get('entry_parent');
		$data['entry_image'] = $this->language->get('entry_image');	
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_viewed'] = $this->language->get('entry_viewed');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_seo_title'] = $this->language->get('entry_seo_title');
		$data['entry_seo_h1'] = $this->language->get('entry_seo_h1');

		$data['help_short_description'] = $this->language->get('help_short_description');
		$data['help_cat_additional_description'] = $this->language->get('help_cat_additional_description');
		$data['help_parent'] = $this->language->get('help_parent');
		$data['help_related_title'] = $this->language->get('help_related_title');
		$data['help_related'] = $this->language->get('help_related');
		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_alternative_link'] = $this->language->get('help_alternative_link');
		$data['help_image'] = $this->language->get('help_image');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_apply'] = $this->language->get('button_apply');
		$data['button_cancel'] = $this->language->get('button_cancel');

    		$data['tab_general'] = $this->language->get('tab_general');
    		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_design'] = $this->language->get('tab_design');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
	
 		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/article', 'token=' . $this->session->data['token'], true)
   		);
		
		if (!isset($this->request->get['article_id'])) {
			$data['action'] = $this->url->link('catalog/article/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/article/edit', 'token=' . $this->session->data['token'] . '&article_id=' . $this->request->get['article_id'] . $url, true);
		}
		
		$data['cancel'] = $this->url->link('catalog/article', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['article_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$article_info = $this->model_catalog_article->getArticle($this->request->get['article_id']);
    	}
		
		$data['token'] = $this->session->data['token'];
		$data['ckeditor'] = $this->config->get('config_editor_default');
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['article_description'])) {
			$data['article_description'] = $this->request->post['article_description'];
		} elseif (isset($this->request->get['article_id'])) {
			$data['article_description'] = $this->model_catalog_article->getArticleDescriptions($this->request->get['article_id']);
		} else {
			$data['article_description'] = array();
		}

		if (isset($this->request->post['path'])) {
			$data['path'] = $this->request->post['path'];
		} elseif (!empty($article_info)) {
			$data['path'] = $article_info['path'];
		} else {
			$data['path'] = '';
		}

		if (isset($this->request->post['parent_id'])) {
			$data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($article_info)) {
			$data['parent_id'] = $article_info['parent_id'];
		} else {
			$data['parent_id'] = 0;
		}
						
		$this->load->model('setting/store');
		
		$data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['article_store'])) {
			$data['article_store'] = $this->request->post['article_store'];
		} elseif (isset($this->request->get['article_id'])) {
			$data['article_store'] = $this->model_catalog_article->getArticleStores($this->request->get['article_id']);
		} else {
			$data['article_store'] = array(0);
		}

		$this->load->model('catalog/product');

		$data['products'] = array();

		if (isset($this->request->post['product'])) {
			$products = $this->request->post['product'];
		} elseif (isset($this->request->get['article_id'])) {
			$products = $this->model_catalog_article->getProductRelated($this->request->get['article_id']);
		} else {
			$products = array();
		}

		if ($products) {
		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		    }	
		}		
		
		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($article_info)) {
			$data['keyword'] = $article_info['keyword'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->post['alternative_link'])) {
			$data['alternative_link'] = $this->request->post['alternative_link'];
		} elseif (!empty($article_info)) {
			$data['alternative_link'] = $article_info['alternative_link'];
		} else {
			$data['alternative_link'] = '';
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($article_info)) {
			$data['image'] = $article_info['image'];
		} else {
			$data['image'] = '';
		}
		
		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($article_info) && is_file(DIR_IMAGE . $article_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($article_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
				
		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($article_info)) {
			$data['sort_order'] = $article_info['sort_order'];
		} else {
			$data['sort_order'] = 0;
		}

		if (isset($this->request->post['date_added'])) {
       			$data['date_added'] = $this->request->post['date_added'];
		} elseif (!empty($article_info)) {
			$data['date_added'] = date('Y-m-d', strtotime($article_info['date_added']));
		} else {
			$data['date_added'] = date('Y-m-d', time());
		}

		if (isset($this->request->post['viewed'])) {
			$data['viewed'] = $this->request->post['viewed'];
		} elseif (!empty($article_info)) {
			$data['viewed'] = $article_info['viewed'];
		} else {
			$data['viewed'] = 0;
		}
		
		$data['statuses'] = array(
			"1" => $this->language->get('text_enabled'), 
			"2" => $this->language->get('text_disabled_list'), 
			"0" => $this->language->get('text_disabled')
		);

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($article_info)) {
			$data['status'] = $article_info['status'];
		} else {
			$data['status'] = 1;
		}
				
		if (isset($this->request->post['article_layout'])) {
			$data['article_layout'] = $this->request->post['article_layout'];
		} elseif (isset($this->request->get['article_id'])) {
			$data['article_layout'] = $this->model_catalog_article->getArticleLayouts($this->request->get['article_id']);
		} else {
			$data['article_layout'] = array();
		}

		$data['cat_detect'] = false;
		if (isset($this->request->get['article_id'])) {
			$article_parent = $this->model_catalog_article->getTotalArticlesByParent($this->request->get['article_id']);
			if ($article_parent > 0) {
				$data['cat_detect'] = true;
			}else{
				$data['cat_detect'] = false;
			}
		}

		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();
						
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/article_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/article')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['article_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if (empty($this->request->post['keyword'])) {
			$keyword = $this->translit($this->request->post['article_description'][$this->config->get('config_language_id')]['name']);
		} else {
			$keyword = $this->request->post['keyword'];
		}

		$keyword = htmlspecialchars_decode($keyword);
		$keyword = preg_replace('/[^a-zа-я0-9-]+/is', '', $keyword);
		$keyword = preg_replace('/[-]{2,}/', '-', $keyword);
		$keyword = trim($keyword, '-');

		
		if (utf8_strlen($keyword) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($keyword);
		
			if ($url_alias_info && isset($this->request->get['article_id']) && $url_alias_info['query'] != 'article_id=' . $this->request->get['article_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			} else {
				$this->request->post['keyword'] = $keyword;
			}

			if ($url_alias_info && !isset($this->request->get['article_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

		}

			if ($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/article')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('catalog/article');

			foreach ($this->request->post['selected'] as $article_id) {
	
			$article_parent = $this->model_catalog_article->getTotalArticlesByParent($article_id);
	
			if ($article_parent) {
				$this->error['warning'] = sprintf($this->language->get('error_delete'), $article_parent);
			}
	
			}
 
		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/article');

			$filter_data = array(
				'current'        => $this->request->get['article_id'],
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_article->getArticles($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'article_id' => $result['article_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function translit($str) {
	    $tr = array(
	        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
	        "Д"=>"d","Е"=>"e","Ё"=>"e","Ж"=>"zh","З"=>"z","И"=>"i",
	        "Й"=>"i","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
	        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
	        "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"c","Ч"=>"ch",
	        "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"y","Ь"=>"",
	        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
	        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","ж"=>"zh",
	        "з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l",
	        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
	        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
	        "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"",
	        "ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
	        " "=> "-"
	    );
	    return strtr($str,$tr);
	}

}
