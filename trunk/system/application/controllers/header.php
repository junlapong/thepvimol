<?php

class Header extends Controller {

	function Header()
	{
		parent::Controller();
	}
	
	function index()
	{
		$data = array();

		$this->load->view('header_view', $data);
		
	}
}

// END Header class

/* End of file Header */
/* Location: ./system/application/controllers/header.php */