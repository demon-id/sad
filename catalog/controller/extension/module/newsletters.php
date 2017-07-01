<?php
class ControllerExtensionModuleNewsletters extends Controller {

	private $error = array();

	public function index() {
		$this->load->language('extension/module/newsletter');
		$this->load->model('extension/module/newsletters');
		
		$this->model_extension_module_newsletters->createNewsletter();

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_placeholder'] = $this->language->get('text_placeholder');
		$data['text_subscribe'] = $this->language->get('text_subscribe');

		$data['text_brands'] = $this->language->get('text_brands');
		$data['text_index'] = $this->language->get('text_index');
		
		$data['footernewstext'] = $this->load->controller('common/footernewstext');
		
		$data['brands'] = array();

						
		return $this->load->view('extension/module/newsletters', $data);
	}
	
	public function news()
	{
		$this->load->model('extension/module/newsletters');
		
		$json = array();
		$json['message'] = $this->model_extension_module_newsletters->subscribes($this->request->post);
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
		
	}
	
	public function uninstall() {
		$this->load->model('megnor/newsletter');

		$this->model_megnor_newsletter->dropNewsletter();
	}
	
}
