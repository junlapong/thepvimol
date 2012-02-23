<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Menu Maintenance
 *------------------------------------------------------------------------------
 */
class MA0010 extends MY_Controller {

	function MA0010()
	{
		parent::MY_Controller();
		
		$this->scrPath = "MA";
		$this->scrId = "MA0010";
		$this->scrFull = "MA/MA0010";
		$this->pkId = "menu_code";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function view()
	{
 		$this->colArray = null;
		parent::view();
	}
	
	function create()
	{
 		$this->colArray = null;
		parent::create();
	}
	
	function update()
	{
 		$this->colArray = null;
		parent::update();

	}
}

// END Header class

/* End of file MA0010 */
/* Location: ./system/application/controllers/MA/MA0010.php */