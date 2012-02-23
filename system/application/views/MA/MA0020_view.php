
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MA0020"; 
	$pkId = "username";
	
	$col = "ur";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"username","type"=>"string","editor"=>	"textFieldNBlank,width:110","df"=>"" );				
	${$col}[1]	=	array("name"=>	"password"	,"type"=>"string","editor"=>	"textFieldNBlank,width:110","df"=>"" );				
	${$col}[2]	=	array("name"=>	"employee_code"	,"type"=>"string","editor"=>	"textFieldBlank,width:110","df"=>"" );				
	${$col}[3]	=	array("name"=>	"admin_flag"	,"type"=>"string","editor"=>	"textFieldBlank,width:110","df"=>"" );				
	${$col}[4]	=	array("name"=>	"last_login"	,"type"=>"datetime","editor"=>	"textFieldBlank,width:110","df"=>"0000-00-00 00:00:00" );				
	${$col}[5]	=	array("name"=>	"default_lang"	,"type"=>"string","editor"=>	"textFieldBlank,width:110","df"=>"th" );
				
	${$col}[6]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[7]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[8]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[9]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[10]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[11]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			

	include(APPPATH.'/views/common/h_include'.EXT);	
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	

var userField = new Object();		
userField["xtype"] = "textfield";
userField["allowBlank"] = true;
userField["name"] = 'username';
userField["fieldLabel"] = '<?=lang('username')?>';

// Row Editor ^^^

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
    	
	// Search
	<?php 
		$gname = "ur";
		$leftComp = "userField";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  

    
	// Grid
	<?php 
		$gname = "ur";
		$width = "auto";
		$height = "513";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		include_once(APPPATH.'/views/common/simpleGrid1'.EXT);
		include_once(APPPATH.'/views/common/simpleAddEvent1'.EXT);
		include_once(APPPATH.'/views/common/simpleDelEvent1'.EXT);
		include_once(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
	?>

	// Final panel	
	<?php 
		$panelItem = "";
		$gname	= "ur";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});

</script>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>