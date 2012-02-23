<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class MT0020 extends MY_Controller {
		
	function MT0020()
	{
		parent::MY_Controller();
		$this->scrPath = "MT";
		$this->scrId = "MT0020";
		$this->scrFull = "MT/MT0020";
		$this->pkId = "mol_code";
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

/* End of file MT0020 */
/* Location: ./system/application/controllers/MT/MT0020.php */