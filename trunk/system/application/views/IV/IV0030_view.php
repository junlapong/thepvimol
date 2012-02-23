
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0030"; 
	$pkId = "id";
	
	$col = "reciss";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();

	//left array						
	${$col}[0]=array("name"=>"id","type"=>"string" ,"editor"=>"textFieldBlank, hidden: true , hideable: false");		
	${$col}[1]=array("name"=>"ri_date","type"=>"string" ,"editor"=>"textFieldBlank,width:110");		
	${$col}[2]=array("name"=>"ri_type","type"=>"string" ,"editor"=>"textFieldBlank,width:50");		
	
	${$col}[3]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[4]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[5]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[6]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[8]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );						
	
	$col = "riDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	
	${$col}[0]=array("name"=>"id","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"");						
	${$col}[1]=array("name"=>"ri_no","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );						
	${$col}[2]=array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );						
	${$col}[3]=array("name"=>"location_name","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );						
	${$col}[4]=array("name"=>"lot_no","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[5]=array("name"=>"seq_no","type"=>"string","editor"=>"textFieldBlank,width:50","df"=>"" );						
	${$col}[6]=array("name"=>"ri_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[7]=array("name"=>"ri_staff","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[8]=array("name"=>"remark","type"=>"string","editor"=>"textFieldBlank,width:180","df"=>"" );						
	
	${$col}[9]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[10]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[11]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[12]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[13]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[14]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
	include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	

var recvNoField = new Object();		
recvNoField["xtype"] = "textfield";
recvNoField["allowBlank"] = true;
recvNoField["name"] = 'received_no';
recvNoField["fieldLabel"] = '<?=lang('ri_no')?>';

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
    	
	// Search
	<?php 
		$gname = "reciss";
		$leftComp = "";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// ReadOnly Grid
	<?php 
		$gname = "reciss";
		$width = "auto";
		$height = "513";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["ri_type"] = values['ri_type'];
        obj["params"]["ri_date"] = values['ri_date'];
        //selUser = values['username'];
        
        riDetailDataStore.load(obj); // Update data
        //riDetailEnableButton(false); // Enable Button

	}

	// ReadOnly Grid
	<?php 
		$gname = "riDetail";
		$width = "auto";
		$height = "513";
		$initialLoad = false;
		$view = "viewDetail";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}
	
	// Final panel	
	<?php 
		$render = $screenId;
	 	$leftWidth = 0.2;
	 	$rightWidth = 0.8;
	 	$leftComp = "reciss";
	 	$rightComp = "riDetail";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel2'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>