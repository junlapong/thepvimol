<?php

class Dashboard extends Controller {

	function Dashboard()
	{
		parent::Controller();
	}
	
	function index()
	{
		$data = array();
		
		//$data['menus'] = $this->session->userdata('usermenu');

		$this->load->view('dashboard_view', $data);
		
	}
}

// END Header class

/* End of file dashboard */
/* Location: ./system/application/controllers/dashboard.php */