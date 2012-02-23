<?php 
	/*	Grid with following Condition
	 *	- NO autosave
	 *	- NO autoload at initial
	 *	- NO Proxy ( Manual Define )
	 * 
	 *  Require Variable
	 *  $cname = combo Name
	 *  $pk = primary key
	 *  $dname = combo list display value
	 *  $vname = combo list save value
	 *  $url = Url For load data
	 *  $editable = Read Only?
	 *  $allowBlank = Can be Blank or not?
	 */

?>
var <?=$cname?>Store = new Ext.data.JsonStore({
    root: 'data',
    idProperty: '<?=$pk?>',  // Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: '<?=$dname?>'}
			 ,{name: '<?=$vname?>'}
			 <?php if( isset($optionField) && $optionField != "" ) {?>
			 	<?=$optionField;?>
			 <?php }?>
			],
    url: '<?=$url?>'
});

var <?=$cname?>Combo = new Object();		
<?=$cname?>Combo["xtype"] = 'combo';
<?=$cname?>Combo["displayField"] = '<?=$dname?>';
<?=$cname?>Combo["valueField"] = '<?=$vname?>';
<?=$cname?>Combo["hiddenName"] = '<?=$vname?>';
<?=$cname?>Combo["allowBlank"] = <?=$allowBlank?>;
<?=$cname?>Combo["editable"] = <?=$editable?>;
<?=$cname?>Combo["mode"] = 'local';
<?=$cname?>Combo["typeAhead"] = true;
<?=$cname?>Combo["triggerAction"] = 'all';
<?=$cname?>Combo["store"] = <?=$cname?>Store;
<?=$cname?>Combo["selectOnFocus"] = true;
<?=$cname?>Combo["forceSelection"] = true;
<?=$cname?>Combo["minChars"] = 2;
<?php if( isset($readonly) && $readonly != "" ) {?>
	<?=$cname?>Combo["readOnly"] = <?=$readonly?>;	
<?php }?>

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