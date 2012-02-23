<?php
	// Option for grid Create Delete Buttom

// Check permission for Create and Delete
if(($permCode & 0x9) > 0 ){

	echo "tbar: [";

	//Check permission for Create
	if(($permCode & 0x8) > 0 ){
		//echo " addDeleteButton('add') , ";
		echo "{
			text : 'Add',
			iconCls: 'silk-add',	
			itemId: 'addAction',	
			handler: function(btn, ev) { addEvent(btn,ev); }	
		},";
	}
	
	//Check permission for Delete
	if(($permCode & 0x1) > 0 ){
		//echo " '-', addDeleteButton('delete') , ";
		echo "'-',{
			text : 'Delete',
			iconCls: 'silk-delete',	
			itemId: 'deleteAction',	
			handler: function(btn, ev) { deleteEvent(btn,ev); }	
		},";
	}
	
	echo "'-' ],";
}
?>