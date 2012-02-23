<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class MT0030 extends MY_Controller {

	function MT0030()
	{
		parent::MY_Controller();
		$this->scrPath = "MT";
		$this->scrId = "MT0030";
		$this->scrFull = "MT/MT0030";
		$this->pkId = "employee_code";
		
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function view()
	{
 		$this->colArray = array("location");
		parent::view();
	}
	
	function create()
	{
 		$this->colArray = array("location");
		parent::create();
	}
	
	function update()
	{
 		$this->colArray = array("location");
		parent::update();

	}
	
	
}
// END Header class

/* End of file MT0020 */
/* Location: ./system/application/controllers/MT/MT0020.php */