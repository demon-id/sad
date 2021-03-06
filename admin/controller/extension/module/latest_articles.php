<?php
class ControllerExtensionModuleLatestArticles extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('extension/module/latest_articles');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('latest_articles', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}	
			
			$this->cache->delete('product');
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_module_type'] = $this->language->get('entry_module_type');
		$data['entry_parent'] = $this->language->get('entry_parent');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_show_date'] = $this->language->get('entry_show_date');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['help_parent'] = $this->language->get('help_parent');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = array();
		}
		
		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}
		
		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/latest_articles', 'token=' . $this->session->data['token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/latest_articles', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true)
			);			
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/latest_articles', 'token=' . $this->session->data['token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/latest_articles', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
		}
		
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();

		foreach ($languages as $language) {
			if (isset($this->request->post['title'])) {
				$data['title'] = $this->request->post['title'];
			} elseif (!empty($module_info['title'])) {
				$data['title'] = $module_info['title'];
			} else {
				$data['title'] = array();
			}
		}

		$data['languages'] = $languages;

		$data['article_module_types'] = array(
			"1" => $this->language->get('text_type_1'), 
			"2" => $this->language->get('text_type_2'), 
			"3" => $this->language->get('text_type_3')
		);

		if (isset($this->request->post['module_type'])) {
			$data['module_type'] = $this->request->post['module_type'];
		} elseif (!empty($module_info['module_type'])) {
			$data['module_type'] = $module_info['module_type'];
		} else {
			$data['module_type'] = 1;
		}

		if (isset($this->request->post['parent_id'])) {
			$data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($module_info['parent_id'])) {
			$data['parent_id'] = $module_info['parent_id'];
		} else {
			$data['parent_id'] = 0;
		}

		$this->load->model('catalog/article');
		$category = $this->model_catalog_article->getPath($data['parent_id']);

		if (isset($this->request->post['path'])) {
			$data['path'] = $this->request->post['path'];
		} elseif (!empty($category)) {
			$data['path'] = $category;
		} else {
			$data['path'] = '';
		}
						
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 4;
		}	

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = 260;
		}	
			
		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = 165;
		}

		if (isset($this->request->post['show_date'])) {
			$data['show_date'] = $this->request->post['show_date'];
		} elseif (!empty($module_info['show_date'])) {
			$data['show_date'] = $module_info['show_date'];
		} else {
			$data['show_date'] = '';
		}		
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['token'] = $this->session->data['token'];

		$this->response->setOutput($this->load->view('extension/module/latest_articles', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/latest_articles')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		foreach ($this->request->post['title'] as $language_id => $title) {
			if ((utf8_strlen($title) < 3) || (utf8_strlen($title) > 32)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}
		}
		
		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}
		
		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/article');

			$filter_data = array(
				'category'        => 1,
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
}