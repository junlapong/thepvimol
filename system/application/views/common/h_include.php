<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= lang($screenId . '_PAGE_HEADER') ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- /_/_/_/_/_/_/_/_/_ START COMMON CSS /_/_/_/_/_/_/_/_/_-->
<link href="<?=base_url()?>system/styles/common.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>system/styles/ext-all.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>system/styles/ux-all.css" rel="stylesheet" type="text/css" />

<!-- END COMMON CSS -->

<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<style>
.x-grid3-col {
    border-left:  1px solid #EEEEEE;
    border-right: 1px solid #D2D2D2;
}
 
.x-grid3-row td, .x-grid3-summary-row td {
    padding-left: 0px;
    padding-right: 0px;
}

</style>
<!-- END USER CSS -->

<!-- /_/_/_/_/_/_/_/_/_ START COMMON JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript" src="<?=base_url()?>system/scripts/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/ext-all.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/App.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/ux-all.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/ext-common.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/Exporter-all.js"></script>

<!-- END COMMON JAVASCRIPT -->
<script type="text/javascript">
<?php 
	$temp = $this->session->userdata('permission');
	$user = $this->session->userdata('username');
	
	if( empty($temp[$screenId]) )
	{	
		$permCode = 0;
		$show_result = false; // First Load Search
		$has_result = true;  // Search result
	}
	else
	{	
		$permCode = $temp[$screenId];
		$show_result = true; // First Load Search
		$has_result = true;  // Search result
	}
	
	
	if($user == "admin")
	{	
		$permCode = 15;
		$show_result = true; // First Load Search
		$has_result = true;  // Search result
	}
?>
</script>