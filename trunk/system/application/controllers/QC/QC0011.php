<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Item Master
 *------------------------------------------------------------------------------
 */
class QC0011 extends MY_Controller {
		
	function QC0011()
	{
		parent::MY_Controller();
		
		$this->scrPath = "QC";
		$this->scrId = "QC0011";
		$this->scrFull = "QC/QC0011";
		$this->pkId = "id";
		
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

/* End of file MT0010 */
/* Location: ./system/application/controllers/MT/MT0010.php */