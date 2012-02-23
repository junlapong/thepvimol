$(document).ready(function(){
	
	$(".button_save").live("click", function(){
		$("#msg_vat_type").html(validate_vat_type());	
		$("#msg_product_name_thai").html(validate_product_name($("#input_product_name_thai").val()));
		$("#msg_product_name_eng").html(validate_product_name($("#input_product_name_eng").val()));
		$("#msg_product_name_s_thai").html(validate_product_name($("#input_product_name_s_thai").val()));
		$("#msg_product_name_s_eng").html(validate_product_name($("#input_product_name_s_eng").val()));
		$("#msg_product_lift").html(validate_count_unit($("#input_product_lift").val()));
		$("#msg_product_lift2").html(validate_count_unit($("#input_product_lift2").val()));
		$("#msg_product_lift3").html(validate_count_unit($("#input_product_lift3").val()));
	});

});
function validate_vat_type() {
	var msg = "";
	var delivery_type = $("#input_deliverly_type").val();
	var vat_type 	  = $("#input_vat_type").val();
	
	if(delivery_type == "DC"){
		
		if(vat_type == "VE"){
			msg = "สินค้า DC ห้ามใช้ VatType VE";
		}
	} else if(delivery_type == "Chilled"){
		
		if(vat_type == "VI"){
			msg = "สินค้า Chilled ห้ามใช้ VatType VI";
		}
	}
	
	return msg;
}
function validate_product_name(input) {
	var msg = "";

	if(input.length > 35){
		msg = "ชื่อสินค้าแบบเต็มภาษาไทยและภาษาอังกฤษมีจำนวนอักษรไม่เกิน 35 อักษร";
	}
	
	//var exp = "[0-9a-zก-ฮ\.\_\-]";
	/*var exp = "[\^$.|?*+()]";
	var reg = new RegExp(exp);
	if(product_name.match(reg)){
		//alert("Match");
	} else {
		alert("notMatch");
	}*/
	
	return msg;
}

function validate_count_unit(input) {
	var msg = "";
	var exp = "^[1-9][0-9]*$";
	var reg = new RegExp(exp);
	if(!input.match(reg)){
		msg = "ข้อมูลที่เป็นจำนวนเต็มมากกว่าศูนย์";
	}

	return msg;
}