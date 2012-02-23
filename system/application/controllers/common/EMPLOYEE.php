<?php
/*
 *------------------------------------------------------------------------------
 * Description  : EMPLOYEE for common employee
 *------------------------------------------------------------------------------
 */
class EMPLOYEE extends MY_Controller {

		
	function EMPLOYEE()
	{
		parent::MY_Controller();
		
		$this->scrPath = "common";
		$this->scrId = "EMPLOYEE";
		$this->scrFull = "common/EMPLOYEE";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}

	// Function: getAllStaffNameList
	// Return Key: staff1_code
	// Return Value: staff_name (employee_firstname:employee_nickname)
	function getAllStaffNameList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "มีข้อผิดพลาดในการค้นหา";
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$query = "";
			$ret['success'] = true;
			$ret['message'] = "ผลการค้นหา OK";
			$data = $this->model->getListNoLimit($this->model->getAllStaffNameSQL())->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
}
// END Header class

/* End of file EMPLOYEE */
/* Location: ./system/application/controllers/common/EMPLOYEE.php */