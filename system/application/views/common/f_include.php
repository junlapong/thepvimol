<!-- END USER JAVASCRIPT -->
</head>

<!-- /_/_/_/_/_/_/_/_/_ HTML START HERE /_/_/_/_/_/_/_/_/_ -->
<body>

<!-- DIV MESSAGE BOX -->
	<script type="text/javascript" src="<?=base_url()?>system/scripts/notifyMessage.js"></script>	
<!-- END DIV MESSAGE BOX -->

<!-- /_/_/_/_/_/_/_/_/_ START PAGE HEADER /_/_/_/_/_/_/_/_/_-->
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td id="page_header" width="100%"><?= lang($screenId . '_PAGE_HEADER') ?></td>
		<td>
			<img src="<?=base_url()?>system/images/icon/help.png" />
		</td>
		<td class="fontNormal" nowrap="nowrap">&nbsp;<?= lang('HELP') ?>&nbsp;</td>
	</tr>
</table>
<!-- END PAGE HEADER -->

<!-- /_/_/_/_/_/_/_/_/_ START DIV DETAIL /_/_/_/_/_/_/_/_/_-->

<div id="page_detail">

	<!-- START SEARCH CONDITION  -->
	<!-- END SEARCH CONDITION --> 

	<!-- START PAGE BUTTONS -->
	<!-- END PAGE BUTTONS --> 
	
	<!--  div class="line"><img src="<?=base_url()?>system/images/blank.gif" /></div-->

	<!-- START DIV RESULT  -->
	<div id="div_result" <?= ($show_result == FALSE)? "style='display: none;'" : ''?>>
	<?php 
		if($has_result == TRUE)
		{
	?>
		<!-- ********** START RESULT TABLE **********-->
		<div id="<?=$screenId?>_search"></div>
		<div id="<?=$screenId?>_chart"></div>
		<div id="<?=$screenId?>"></div>
		<div id="<?=$screenId?>_detail1"></div>

		<!-- END RESULT TABLE -->
	<?php 
		} 
		else
		{
	?>
		<!-- ********** START DATA NOT FOUND BLOCK **********-->
		<div id="div_empty"/>
		<!-- END DATA NOT FOUND BLOCK -->
	<?php 
		} 
	?>
	</div>
	<!-- END DIV RESULT  -->

</div>

<!-- END DIV DETAIL -->
</body>
</html>