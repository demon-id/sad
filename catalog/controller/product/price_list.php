<?php
class ControllerProductCategory extends Controller {
	public function index()
	{
		$this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data = [];
		$this->response->setOutput($this->load->view('product/price_list', $data));
	}
}
