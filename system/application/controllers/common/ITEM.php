<?php
/*
 *------------------------------------------------------------------------------
 * Description  : EMPLOYEE for common employee
 *------------------------------------------------------------------------------
 */
class ITEM extends MY_Controller {

		
	function ITEM()
	{
		parent::MY_Controller();
		
		$this->scrPath = "common";
		$this->scrId = "ITEM";
		$this->scrFull = "common/ITEM";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}

	// Function: getItemCodeList()
	// Input: query -> item_code
	// Return Key: item_code
	// Return value: des_item_code , item_name (item_code:item_name)
	function getItemCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "มีข้อผิดพลาดในการค้นหา";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			//$query = "";
			$ret['success'] = true;
			$ret['message'] = "ผลการค้นหา OK";
			$data = $this->model->getListNoLimit($this->model->getItemCodeSQL($query))->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}	
	
	// Function: getPurchaseItemList()
	// Input: no input request
	// Return Key: item_code
	// Return Value: item_name (item_code:item_name)
	function getPurchaseItemList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "มีข้อผิดพลาดในการค้นหา";
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$query = "";
			$ret['success'] = true;
			$ret['message'] = "ผลการค้นหา OK";
			$data = $this->model->getListNoLimit($this->model->getPurchaseItemSQL())->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	// Function: getRequestPurchaseItemByVendorList()
	// Input: query -> vendor_code
	//		  item_code -> item_code   (by request: มีก็ได้)
	// Return: vendor_code
	// 			,item_code
	//			,order_qty
	//			,price
	//			,step1_discount_rate
	function getRequestPurchaseItemByVendorList()
	{		
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "มีข้อผิดพลาดในการค้นหา";
		if($_POST != NULL) {
			$vendorCode = $this->input->post('query');
			$itemCode = $this->input->post('item_code');
			
			$ret['success'] = true;
			$ret['message'] = "ผลการค้นหา OK";
			$data = $this->model->getListNoLimit($this->model->getRequestPurchaseItemByVendorSQL($vendorCode,$itemCode))->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	
}
// END Header class

/* End of file EMPLOYEE */
/* Location: ./system/application/controllers/common/EMPLOYEE.php */