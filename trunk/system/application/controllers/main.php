<?php

class Main extends MY_Controller {

	function Main()
	{
		parent::MY_Controller();	
	}
	
	function index()
	{
		$this->load->view('main_view');
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */