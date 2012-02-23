
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "QC0011"; 
	$pkId = "id";
	
	$col = "item";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]   = array("name" => "id","type" => "string", "editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]   = array("name" => "production_date","type" => "string", "editor" => "readOnlyTxt,width:66","df"=>"" );
	${$col}[2]   = array("name" => "item_code","type" => "string", "editor" => "readOnlyTxt,width:110","df"=>"" );
	${$col}[3]   = array("name" => "job_no","type" => "string", "editor" => "readOnlyTxt,width:70","df"=>"" );
	${$col}[4]   = array("name" => "machine_code","type" => "string", "editor" => "readOnlyTxt,width:70","df"=>"" );
	${$col}[5]   = array("name" => "mat_code","type" => "string", "editor" => "readOnlyTxt,width:110","df"=>"" );
	${$col}[6]   = array("name" => "input_lot","type" => "string", "editor" => "readOnlyTxt,width:50","df"=>"" );
	${$col}[7]   = array("name" => "input_pp_date","type" => "string", "editor" => "readOnlyTxt,width:66","df"=>"" );
	${$col}[8]   = array("name" => "input_seq","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[9]   = array("name" => "input_tower_no","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[10]  = array("name" => "frame_height","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[11]  = array("name" => "thickness","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[12]  = array("name" => "frame_speed","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[13]  = array("name" => "frame_length","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[14]  = array("name" => "color","type" => "string", "editor" => "{xtype:'combo', typeAhead: true,triggerAction: 'all',transform: 'color',lazyRender: true, listClass: 'x-combo-list-small'},width:50","df"=>"" );
	${$col}[15]  = array("name" => "film","type" => "string", "editor" => "{xtype:'combo', typeAhead: true,triggerAction: 'all',transform: 'film',lazyRender: true, listClass: 'x-combo-list-small'},width:50","df"=>"" );
	${$col}[16]  = array("name" => "in_skin","type" => "string", "editor" => "{xtype:'combo', typeAhead: true,triggerAction: 'all',transform: 'inSkin',lazyRender: true, listClass: 'x-combo-list-small'},width:50","df"=>"" );
	${$col}[17]  = array("name" => "check_frame_qty","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[18]  = array("name" => "dirt_qty","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[19]  = array("name" => "broken_qty","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[20]  = array("name" => "shape_qty","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[21]  = array("name" => "film_problem_qty","type" => "string", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[22]  = array("name" => "check_time","type" => "string", "editor" => "startTime,width:66","df"=>"" );

	${$col}[23]  = array("name" => "notes","type" => "string", "editor" => "textFieldBlank,width:200","df"=>"" );
	
	${$col}[24]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"0" );
	${$col}[25]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[26]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[27]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[28]=array("name"=>"created_user","type"=>"string","editor"=>"","df"=>"" );
	${$col}[29]=array("name"=>"updated_user","type"=>"string","editor"=>"","df"=>"" );
	
	include_once(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component Define Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	
var readOnlyNum = rowEditNumField1(false,true);
var readOnlyTxt = rowEditTextField1(false,true);		

var startTime		= new Ext.form.TimeField({
	name: 'starttime',
	editable:false,
	format:"H:i:s"
});

var jobSearch = formTextField1(true,false,'job_no','<?=lang('job_no')?>');	
var itemSearch = formTextField1(true,false,'item_code','<?=lang('item_code')?>');	
var ProductionDate  = formDateField1(true,false,'production_date','<?=lang('production_date')?>','','Y-m-d');

    Ext.QuickTips.init();

	// Search
	<?php 
		$gname = "item";
		$leftComp = "jobSearch,itemSearch";
		$rightComp = "ProductionDate";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// Grid
	<?php 
			$gname = "item";
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
			$gname	= "item";
			$render = $screenId;
			include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>

});

</script>

<select name="color" id="color" style="display: none;">
    <option value="WH">ขาว</option>
    <option value="BK">ดำ</option>
    <option value="GL">เขียว</option>
    <option value="BL">ฟ้า</option>
</select>

<select name="film" id="film" style="display: none;">
    <option value="">ไม่มี</option>
    <option value="01">ใส</option>
    <option value="WY">ลายไม้</option>
    <option value="SB">บันไดฟ้า</option>
    <option value="AY">AYK</option>
    <option value="HK">Hinoki</option>
    <option value="WO">ไม้ส้ม</option>
</select>

<select name="inSkin" id="inSkin" style="display: none;">
    <option value="ละเอียด">ละเอียด</option>
    <option value="หยาบ">หยาบ</option>
    <option value="FILM">film</option>
</select>
	
<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>