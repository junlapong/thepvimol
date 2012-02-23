<?php

class Menu extends MY_Controller {

	function Menu()
	{
		parent::MY_Controller();
		$this->load->model('menu_model','',TRUE);
	}
	
	function index()
	{
		$data = array();		
		$data['menus'] = $this->menu_model->getAllData()->result();	

		$this->load->view('menu_view', $data);
		
	}
}

// END Header class

/* End of file Menu */
/* Location: ./system/application/controllers/menu.php */