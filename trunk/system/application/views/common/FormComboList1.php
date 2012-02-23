<?php 
	/*	Grid with following Condition
	 *	- NO autosave
	 *	- NO autoload at initial
	 *	- NO Proxy ( Manual Define )
	 * 
	 *  Require Variable
	 *  $cname = combo Name
	 *  $fname = field Name (Combo Name)
	 *  $pk = primary key
	 *  $dname = combo list display value
	 *  $vname = combo list save value
	 *  $url = Url For load data
	 *  $editable = Read Only?
	 *  $allowBlank = Can be Blank or not?
	 *  $initialLoad = load data
	 *  $initParam = param
	 *  $mode = local ,remote
	 */

?>
var <?=$cname?>Store = new Ext.data.JsonStore({
    root: 'data',
    idProperty: '<?=$pk?>',  // Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: '<?=$dname?>'},{name: '<?=$vname?>'}],
    url: '<?=$url?>'
});

var <?=$cname?>Combo = new Object();		
<?=$cname?>Combo["xtype"] = 'combo';
<?=$cname?>Combo["displayField"] = '<?=$dname?>';
<?=$cname?>Combo["valueField"] = '<?=$vname?>';
<?=$cname?>Combo["hiddenName"] = '<?=$vname?>';
<?=$cname?>Combo["allowBlank"] = <?=$allowBlank?>;
<?php if( isset($value) && $value != "" ) {?>
	<?=$cname?>Combo["value"] = "<?=$value?>";	
<?php }?>
<?php if( isset($readonly) && $readonly != "" ) {?>
	<?=$cname?>Combo["readOnly"] = <?=$readonly?>;	
<?php }?>
<?=$cname?>Combo["editable"] = <?=$editable?>;

<?php if(!isset($mode) || $mode == "local"){?>
<?=$cname?>Combo["mode"] = 'local';
<?php }?>

<?php if(isset($width)) {?>
<?=$cname?>Combo["width"] = <?=$width?>;
<?php }?>
<?=$cname?>Combo["typeAhead"] = true;
<?=$cname?>Combo["triggerAction"] = 'all';
<?=$cname?>Combo["store"] = <?=$cname?>Store;
<?=$cname?>Combo["selectOnFocus"] = true;
<?=$cname?>Combo["forceSelection"] = true;
<?=$cname?>Combo["minChars"] = 2;
<?=$cname?>Combo["name"] = '<?=$fname?>';
//<?=$cname?>Combo["id"] = '<?=$fname?>';
<?=$cname?>Combo["fieldLabel"] = '<?=lang($fname)?>';


<?=$cname?>Combo["listeners"] = {
	select:{fn:function(combo, value) {
	<?=$cname?>OnSelect(combo,value);
    }}
    <?php if($editable == "true") {  
    	?>
		,change:{fn:function(combo, newvalue , oldvalue) {
		<?=$cname?>OnSelect(combo,newvalue);
	    }}
	<?php }?>
};
<?php  if($initialLoad){ ?>
	var obj = new Object();
	obj["params"] = new Object();
	obj["params"]["query"] = "<?=$initParam?>";
	<?=$cname?>Store.load(obj);
<?php }?>