var cost = 0;
var discount = 0;
var lot = 0;
var SuppNetCostPack = 0;
var vendorType = "DC";
var MakerVatType 	= "-";
var SupperVatType 	= "-";

function checkBeforeCal(){
	var LotData 	= false;
	var VatData 	= false;
	var CostData	= false;
	var	BaseData	= false;
	
	vendorType	= $("#hddVendorType").val();
	
	// Check Lot Input
	var supLot1	= $("#txtSuppLotS").val();
	var MakLot1	= '1';
	var MakLot2 = '1';
	
	MakerVatType 	= $("#ddlMakerVatType option:selected").val();
	SupperVatType 	= $("#ddlSuppVatType option:selected").val();
	
	if( vendorType == 'DC') {
		MakLot1	= $("#txtMakerLotP").val();
		MakLot2	= $("#txtMakerLotS").val();
		$("#txtSuppCost").hide().val('0');
	} else if( vendorType == 'RE') {
		if(MakerVatType != '-' && SupperVatType != '-') {
			if(MakerVatType != SupperVatType) {
				MakLot1 = $("#txtMakerLotP").val();
				MakLot2 = $("#txtMakerLotS").val();
				if(MakLot1 == '0' && MakLot2 == '0')
				{
					$("#txtMakerLotC").show().val('1');
					$("#txtMakerLotP").show().val('1');
					$("#txtMakerLotS").show().val($("#txtSuppLotS").val());
				}
				else
				{
					$("#txtMakerLotC").show();
					$("#txtMakerLotP").show();
					$("#txtMakerLotS").show();
				}
				
				$("#txtMakerCost").show();
				$(".MakerShow").show();
				MakLot1	= $("#txtMakerLotP").val();
				MakLot2	= $("#txtMakerLotS").val();	
				$("#txtSuppCost").hide().val('0');
			} else {
				MakerVatType = '0';
				$("#txtMakerNetCostPack").val('');
				$("#txtMakerNetCostPiece").val('');
				$("#txtSuppCost").show();
				$("#txtMakerLotC").hide();
				$(".MakerShow").hide();
				$("#txtMakerLotP").val('0').hide();
				$("#txtMakerLotS").val('0').hide();
				$("#txtMakerCost").val('0').hide();
			}
		}
	} else {
		MakerVatType = '0';
		$("#txtSuppCost").show();
		$(".Maker").hide();
		$("#txtMakerNetCostPack").val('');
		$("#txtMakerNetCostPiece").val('');
		$("#txtMakerLotP").val('0').hide();
		$("#txtMakerLotS").val('0').hide();
		$("#txtMakerCost").val('0').hide();
		$(".MakerShow").hide();
	}
	
	if(supLot1 != '' && MakLot1 != ''  && MakLot2 != '') {
		LotData		= true;
	}
	// End Check Lot Input
	
	// Check VatType Input
	
	if(MakerVatType != "-" && SupperVatType != "-") {
		VatData 	= true;
	}
	// End Check VatType Input
	
	// Check Cost Input
	var CostSuppData	= $("#txtSuppCost").val();
	var CostMakeData	= '0';
	
	switch(vendorType) {
		case 'DC' :
			CostMakeData	= $("#txtMakerCost").val();
			CostSuppData	= '0';
			break;
		case 'RE' :
			if(MakerVatType != SupperVatType) {
				CostMakeData	= $("#txtMakerCost").val();	
				CostSuppData	= '0';
			}
		default :
			CostMakeData	= '0';
			break;
	}
	
	if( CostSuppData != "" &&  CostMakeData != "" ) {
		CostData	= true;
	}
	// End Check Cost Input
	
	// Check BaseData Input
	var sty = $(".VatBase").css("display");
	if(sty != 'none') {
		var inputVatBase	=  $("#txtMakerVatBase").val();
		if(inputVatBase != ''){
			BaseData = true;
		}
	} else {
		BaseData	= true;
	}
	
	//alert(LotData + ' - ' + VatData + ' - ' + CostData + ' - ' + BaseData);
	if(LotData && VatData && CostData && BaseData) {
		start_calculate();
	}
	
}

function cleraData(val,i) {
	if(val == 'bath') {
		//$("#txtDiscountBath"+i).val('');
		$("#txtDiscountPer"+i).val('');
		$("#txtDiscountBuy"+i).val('');
		$("#txtDiscountThrow"+i).val('');
	} else if(val == 'per') {
		$("#txtDiscountBath"+i).val('');
		//$("#txtDiscountPer"+i).val('');
		$("#txtDiscountBuy"+i).val('');
		$("#txtDiscountThrow"+i).val('');	
	} else {
		$("#txtDiscountBath"+i).val('');
		$("#txtDiscountPer"+i).val('');
		//$("#txtDiscountBuy"+i).val('');
		//$("#txtDiscountThrow"+i).val('');
	}
}

function cal_MalerLotSize(){
	var lot2	= Number($("#txtMakerLotP").val());
	var lot3	= Number($("#txtMakerLotS").val());
	//alert(lot2*lot3);
	return (lot2 * lot3);
	
}
function cal_SupplierLotSize(){
	return Number($("#txtSuppLotS").val());
}

/*
 * @ Cal Net Cost Pack = (Cost-Discount) * Vat
 * 
 * ## Get Cost From ? ##
 * IF Vendor Type is 'DC' or Diff Vat Type get cost from Maker
 * ELSE get cost from Supplier
 * 
 */
function start_calculate() {
	
	MakerVatType 	= $("#ddlMakerVatType option:selected").val();
	SupperVatType 	= $("#ddlSuppVatType option:selected").val();
	vendorType		= $("#hddVendorType").val();
	
	if($(".row_purchese").length == 0) {
		$(".btn_add_row_Pur").click();		
	}
	$("#txtPurPriceLot").val(cal_SupplierLotSize());
	
	if($(".row_supplier").length == 0){
		$(".btn_add_row_sup").click();
	}
	$("#txtsupPriceLot0").val(cal_MalerLotSize());
	
	if(MakerVatType != "-" || SupperVatType != "-") {
		var CostInput = 0;
		var showData = false;

		if(vendorType == "DC") {
			// Cost From Supplier
			CostInput = Number($("#txtMakerCost").val());
			showData = true;
		} else if(vendorType == "RE" ) {
			// Result
			if((MakerVatType != SupperVatType)) {
				// Diff
				CostInput = Number($("#txtMakerCost").val());
				showData = true;
			} else {
				// Same
				CostInput = Number($("#txtSuppCost").val());
			}
		}else {
			// Cost From Maker
			//showData = true;
			CostInput = Number($("#txtSuppCost").val());
		}

		CostInput = getDiscountData(CostInput);  // Call function getDiscountData()

		/*
		 * @ Set Cost to Net Cost Pack
		 */
		if(showData){
			cost = Number(CostInput) +  getVat(CostInput , 'Maker');
			$("#txtMakerNetCostPack").val(cost.toFixed(2));
			$("#txtsupPrice").val(cost.toFixed(2));
			$("#txtsupPriceLot").val(cal_MalerLotSize());
			$("#txtsupPrice0").val($("#txtMakerNetCostPack").val());
			cal_MakerNetCostPiece();
		}else {
			cost = Number(CostInput) +  getVat(CostInput , 'Supplier');
			$("#txtMakerNetCostPack").val("");
			$("#txtMakerNetCostPiece").val("");
			$("#txtsupPriceLot").val("");
			$("#txtsupPrice").val("");
		}
		
		cal_SupplierNetCostPack();
		cal_SupplierNetCostPiece();
		cal_MP();
		
	} else {
		/*
		 * No Select Vat type
		 */
	}		
}

function cal_MakerNetCostPiece() {
	var lotSize = cal_MalerLotSize();
	var result = (cost/lotSize).toFixed(2);
	if(result != "NaN")
	{
		$("#txtMakerNetCostPiece").val(result);
	}
	else
	{
		$("#txtMakerNetCostPiece").val('0.00');
	}
}

function cal_SupplierNetCostPack() {
	
	/*
	 * @ Check Vendor type is 'DC' or Vat Diff 
	 * IF TRUE ( NetCostPackOfMaker * Vat ) / MakerLot of index2
	 * ELSE Cost * Vat
	 */		
	var MakerLot2 = Number($("#txtMakerLotP").val());
	if( vendorType == "DC" ) {		
		SuppNetCostPack = (cost + getVat(cost , 'Supplier')) / MakerLot2;
	} else if(vendorType == "RE" ) {
		if((MakerVatType != SupperVatType)) {
			// Diff
			SuppNetCostPack = cost + getVat(cost , 'Maker');
		} else {
			// Same
			SuppNetCostPack = (cost + getVat(cost , 'Supplier'));
		}
	}
	else {
		// Cost From Maker
		SuppNetCostPack = cost + getVat(cost , 'Supplier');
		//alert(SuppNetCostPack);
	}
	
	$("#txtSuppplierNetCostPack").val(SuppNetCostPack.toFixed(2));
	$("#txtPurPrice").val($("#txtSuppplierNetCostPack").val());
	
}

function cal_SupplierNetCostPiece() {
	
	/*
	 * @ Calculate = NetCostPackOfSupplier / lotSize Supplier
	 */
	
	$("#txtSuppplierNetCostPiece").val( (SuppNetCostPack / cal_SupplierLotSize()).toFixed(2));
	
}

function cal_MP() {
	
}

function getDiscountData(price) {
	/*
	 * 	@ TODO Get discount from table discount
	 * Check Row of discount
	 * 
	 */
	var discount = 0;
	var nRow = $("#hddDiscountRow").val();
	for(var i=0 ; i<nRow ; i++) {
		
			var bath 	= $("#txtDiscountBath"+i).val();
			//alert("$(#txtDiscountPer"+i+").val() = "+$("#txtDiscountPer"+i).val());
			var per		= $("#txtDiscountPer"+i).val();
			var buy		= $("#txtDiscountBuy"+i).val();
			var uBuy	= $("#ddlDiscountBuyUnit"+i).val();
			var give	= $("#txtDiscountThrow"+i).val();
			var uGive	= $("#ddlDiscountTrowUnit"+i).val();
			
		
			if( bath != undefined | per != undefined| buy != undefined | give != undefined ) {
			// convert type to number;
				bath	= Number(bath);
				per		= Number(per);
				buy		= Number(buy);
				give	= Number(give);
				//alert(bath.NaN + " - " + per+ " - " + buy+" - " +give);
			
				if(bath != 0 | per != 0 | buy != 0 | give != 0) {
	
					if(bath != 0 && buy == 0 && give == 0 && per == 0) {
						price -= bath;
						//alert('Bath = ' + price);
					} else if (per != 0 && buy == 0 && give == 0 && bath == 0) {
						price -= (price * (per/100));
						//alert("Per = " + price);
					} else {
						//alert('Buy+Give' + buy + ' - ' + give);
						// get buy + give
						// check unit type
						if(uBuy ==  uGive) {
							price = (price * buy)/(buy + give);
							//alert("same");
						} else {
							//alert(price);
							var FOC 		= 0;
							var MakerUnit	= $("#ddlMakerUnit option:selected").val();
							var SuppUnit	= $("#ddlSupplierUnit option:selected").val();
							var RetailUnit 	= $("#ddlRetailUnit option:selected").val();
							/* Check Buy Unit */
							if(uBuy == MakerUnit) {
								FOC = buy * cal_MalerLotSize();
								//alert("Maker convert = "+FOC);
							} else if( uBuy == SuppUnit) {
								FOC =  buy * cal_SupplierLotSize();
								//alert("Supplier convert Buy = "+FOC);
							} else {
								FOC = buy;
								//alert("Retail b = "+FOC);
							}
							/* Check Give Unit */
							var Giv_FOC = 0;
							//alert(uGive + ' - '+MakerUnit+ ' - '+SuppUnit)
							if(uGive == MakerUnit) {
								Giv_FOC = give * cal_MalerLotSize();
								//alert("Maker convert = "+Giv_FOC);
							} else if( uGive == SuppUnit ){
								Give_FOC = give * cal_SupplierLotSize();
								//alert("Supplier convert Give = "+Giv_FOC);
							} else {
								Give_FOC = give;
								//alert("Retail g = "+give);
							}
							//alert(price + " - " + FOC + " - " + Give_FOC);
							price = (price * FOC) / (FOC + Give_FOC); 
						}
					}
				}
			//alert(price);
		}
	}
	return price;
}

function getVat(cost,type) {
	/*
	 * 	@ TODO GetVat for cal Vat
	 * ddlMakerVatType
	 * ddlSuppVatType
	 */
	var InputVatType = null;
	var vat = null;
	var vat_rate = 0;
	if(type == 'Maker') {
		InputVatType 	= MakerVatType;
	} else {
		InputVatType 	= SupperVatType;
	}
	

	switch(InputVatType)
	{		
	case "VI":
		vat = ( cost * vat_rate );
		break;
	case "VR":
		var vatBase = Number($("#txtMakerVatBase").val());
		var base = vatBase * cal_MalerLotSize();
		vat = (base * vat_rate );
		break;
	default:
		vat = 0;
	}
	
	return vat;
}

function copyval(me,item) {
	$("#"+item).val($("#"+me).val());
}

$(document).ready(function() {	
	vendorType = $("#hddVendorType").val();
	$("#txtPurPriceLot").attr("readyonly","readyonly");
	$("#txtsupPriceLot").attr("readyonly","readyonly");
});