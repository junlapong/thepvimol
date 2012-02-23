<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class MT0150 extends MY_Controller {

	function MT0150()
	{
		parent::MY_Controller();
		$this->scrPath = "MT";
		$this->scrId = "MT0150";
		$this->scrFull = "MT/MT0150";
		$this->pkId = "sale_code";
		
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	
	
}
// END Header class

/* End of file MT0150 */
/* Location: ./system/application/controllers/MT/MT0150.php */