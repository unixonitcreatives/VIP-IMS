function add_row(t) {
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var a = "product_name" + count,
            tabindex = count * 4 ,
            e = document.createElement("tr");
            tab1 = tabindex + 1;
            tab2 = tabindex + 2;
            tab3 = tabindex + 3;
            tab4 = tabindex + 4;
            tab5 = tabindex + 5;
            tab6 = tabindex + 6;
            tab7 = tabindex + 7;
			tab8 = tabindex + 8;
           

        e.innerHTML = "<td><input type='text' name='product_name[]' autocomplete='off' class='form-control productSelection' placeholder='Item Name' id='" + a + "' required tabindex='"+tab1+"'></td> <td> <input type='text' placeholder='0' name='product_quantity[]' class='total_qty_" + count + " form-control text-right' autocomplete='off' id='total_qty_" + count + "' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' tabindex='"+tab2+"' required /></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' value='' autocomplete='off' placeholder='0.00' id='item_price_" + count + "' required class='item_price_"+count+" form-control text-right' tabindex='"+tab3+"' /></td><td class='text-right'><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='' placeholder='0.00' readonly='readonly'/></td><td><button style='text-align: right;' class='btn btn-danger' type='button' tabindex='"+tab4+"' value='Delete' onclick='deleteRow(this)'>Delete</button></td>",

        document.getElementById(t).appendChild(e), 
        document.getElementById(a).focus(),
        document.getElementById("add-invoice-item").setAttribute("tabindex", tab5);
        document.getElementById("paidAmount").setAttribute("tabindex", tab6);
        document.getElementById("full_paid_tab").setAttribute("tabindex", tab7);
        document.getElementById("add-invoice").setAttribute("tabindex", tab8);
        count++

    }
}

function quantity_calculate(item) {

	var total_qty = $(".total_qty_" + item).val();
	var item_price = $(".item_price_" + item).val();
	var total_price = (total_qty * item_price);
	$("#total_price_" + item).val(total_price);	
	
    calculateSum();
    invoice_paidamount();
}

function calculateSum() {
    var e = 0,
		t = 0;     
       
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
    }), 
   
    e = t.toFixed(2),   

    $("#grandTotal").val(e)
}

function invoice_paidamount() {
    var t = $("#grandTotal").val(),
        a = $("#paidAmount").val(),
        e = t - a;		
    $("#dueAmmount").val(e);
}

//Invoice full paid
function full_paid() {
    var grandTotal = $("#grandTotal").val();
    $("#paidAmount").val(grandTotal);
    calculateSum();
    invoice_paidamount();
}
// Invoice update due amount
function invoice_update() {
    var pa = $("#paidAmount").val();
     var   gt = $("#grandTotal").val();
	var	ra = $("#remainingamount").val();
     var   e = (pa * 1) + (ra * 1);
	var	nda = (gt * 1) - (e * 1);
		//alert(e);
    $("#dueAmmount").val(nda)
}
function deleteRow(t) {
    var a = $("#normalinvoice > tbody > tr").length;
    if (1 == a) alert("There only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e), 
        calculateSum();
        invoice_paidamount();
    }
}
var count = 2,
    limits = 500;