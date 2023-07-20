/*
 * remember email,password after clicking check box
 * 
 */
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function validateInput(inputField) {
    var regex = /^[a-zA-Z.]+$/; // Regular expression to allow only characters and dot operator

    if (!regex.test(inputField.value)) {
      // If the input does not match the allowed pattern
      inputField.value = ''; // Clear the input field
      alert('Only characters and the dot operator (.) are allowed.');
    }
  }

function copy_paste(id){
    // this code for copy past the textbox error Start
    var x= document.getElementById(id).value;
    if(isNaN(x))
    {
     document.getElementById(id).value="";
    }
// End
}

// $(document).ready(function() {
//   $('.btnSubmit').click(function(event) {
//     event.preventDefault();

//     if (!$(this).hasClass('clicked')) {
//       $(this).addClass('clicked');
//       $(this).attr('disabled', 'disabled');

//       // Your code for handling the button click goes here
//     }
//   });
// });


function getCount(type=null) {
    if(type=='noclone'){
       
    var counting  = $('#showData tr:last').find("td:first").find("input").attr('id');
     var result = counting.split("_")[1];
    }else{
    
    var counting  = $('#invoice_listing_table tr:last').attr('id');
    var result = counting.split("_")[3];

    }
    
   // console.log(result);
    $('#maxCount').val(result);
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function delCookie(cname)
{
    if(getCookie(cname))
    {
        document.cookie = "cname=; expires=Thu, 01 Jan 1970 00:00:00 UTC"; 
    }
}

function checkCookie() {    
         var user = getCookie("user_email");
         var pass = getCookie("user_pass");
    if (user != "" && user != null && pass != "" && pass != null)
    {
        document.getElementById("user_email").value = user;
        document.getElementById("user_pass").value = pass;
        document.getElementById("remember_me").checked = true;
    }       
}

function toggle() { 
if(document.getElementById("remember_me").checked == true){
        var fieldValue1 = document.getElementById("user_email").value;
        var fieldValue2 = document.getElementById("user_pass").value; 
        setCookie("user_email",fieldValue1,365);
        setCookie("user_pass",fieldValue2,365);  
    }
    else{
        delCookie("user_email");
        delCookie("user_pass");    
    } 
}


/*
 * ping and get ip status
 * 
 */

function pingIp(basePath, ID) {
    var ip = $('#' + ID).val();
    $.post(basePath + "/lib/ajax/ping_check.php", {'ip': ip}, function (data) {
     alert(data);
        
    });
}


/*
 * same address 
 * 
 */

function sameAddress() {
    document.getElementById('SAddress').innerHTML = document.getElementById('Address').value;
    document.getElementById('SCity').value = document.getElementById('City').value;
    document.getElementById('SPincode').value = document.getElementById('Pincode').value;
    document.getElementById('SState').value = document.getElementById('State').value;
    document.getElementById('SCountry').value = document.getElementById('Country').value;
}

/*
 * ID - refers column name
 * 
 */
function ManageQueryFilter(refTable, basePath, ID, DT) {
    var svalue = $('#' + ID).val();
    $.post(basePath + "/ajax_fd.php", {'table_name': refTable, 'column_name': ID, 'seach_value': svalue, 'dtype': DT}, function (data) {
	//alert(data);
        location.reload(true);
    });
}

function ManageDateQueryFilter(refTable, basePath, ColName, DT) {

    var df = $('#date_from').val();
    var dt = $('#date_to').val();

    var svalue = '`' + ColName + '` BETWEEN "' + df + '" AND "' + dt + '"';
	
    //alert(svalue);
    $.post(basePath + "/ajax_fd.php", {'table_name': refTable, 'column_name': ColName, 'seach_value': svalue, 'dtype': DT}, function (data) {
        //alert(data);    
        location.reload(true);
    });
}


//Global id count
var count = 2;
function addRow() {

    //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
    var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + count});

    //x.find('#Invoice_data_entry_1').attr({id: "Invoice_data_entry_"+ count}); 
    x.find('#ItemNo_1').val('');
    if ($('#ItemNo_1').length) {
        x.find('#ItemNo_1').attr({id: "ItemNo_" + count, name: "ItemNo_" + count});
    }
    x.find('#RMName_1').val('');
    x.find('#RMName_1').attr({id: "RMName_" + count, name: "RMName_" + count});
    
    x.find('#Amount_1').val('');
    x.find('#Amount_1').attr({id: "Amount_" + count, name: "Amount_" + count});
    x.find('#Quantity_1').val('');
    x.find('#Quantity_1').attr({id: "Quantity_" + count, name: "Quantity_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Quantity_" + count + "').val() * $('#Rate_" + count + "').val()).toFixed(2))"});
    x.find('#Rate_1').val('');
    x.find('#Rate_1').attr({id: "Rate_" + count, name: "Rate_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Quantity_" + count + "').val() * $('#Rate_" + count + "').val()).toFixed(2))"});
    
    //Note_1
    x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove()"});

    x.appendTo('#invoice_listing_table');
    count++;
}

// document.getElementById('Note_1').addEventListener('input', function() {
//     this.style.height = 'auto'; // Reset the height to auto to calculate the actual height needed
//     this.style.height = this.scrollHeight + 'px'; // Set the height to match the scroll height
//   });

/////////////////////////////////////////////////////////////////////////////

function subtotal() {
    var subTotal = 0;

    for (i = 1; i < count; i++) {
        if ($('#Amount_' + i).length) {
            subTotal += parseFloat($('#Amount_' + i).val());
        }
    }

    $('#subTotal').html(subTotal);

    //var rebate = parseFloat($('#Rebate').val());
    
    //var subTotal = subTotal - rebate;

    //var tp = parseFloat($('#taxPercent').val());

    //var tax_amount = ((subTotal * tp) / 100);

    //$('#tax').html(tax_amount.toFixed(2));

    //var BillAmount = Math.round((subTotal + tax_amount)-rebate);
    var BillAmount = Math.round(subTotal);

    $('#Total').html(BillAmount.toFixed(2));
    $('#BillAmount').val(BillAmount.toFixed(2));
    $('#maxCount').val(count);
    
}

//Global id count
var counter = 2;
function addRow_pac() {

    //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
    var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + counter});

   console.log(x);
    if ($('#PackageId_1').length) {
        x.find('#PackageId_1').attr({id: "PackageId_" + counter, name: "PackageId_" + counter, onchange :"$('#Amount_" + counter + "').val($('#PackageId_"+ counter +"').find(':selected').data('id'))"});
    }
    
    //StartDate_1
    if ($('#StartDate_1').length) {
        x.find('#StartDate_1').attr({id: "StartDate_" + counter, name: "StartDate_" + counter});
    }
    //EndDate_1
    if ($('#EndDate_1').length) {
        x.find('#EndDate_1').attr({id: "EndDate_" + counter, name: "EndDate_" + counter});
    }
    
    //Note_1
    x.find('#Note_1').attr({id: "Note_" + counter, name: "Note_" + counter});
    x.find('#Amount_1').attr({id: "Amount_" + counter, name: "Amount_" + counter});
    x.find('#REM_1').attr({id: "REM_" + counter, name: "REM_" + counter, onclick: "$('#Invoice_data_entry_" + counter + "').remove()"});

    x.appendTo('#invoice_listing_table');
    counter++;
}

function subtotal_pac() {
    var subTotal = 0;

    for (i = 1; i < counter; i++) {
        if ($('#Amount_' + i).length) {
            subTotal += parseFloat($('#Amount_' + i).val());
        }
    }

    $('#subTotal').html(subTotal);

    var rebate = parseFloat($('#Rebate').val());

    //var subTotal = subTotal - rebate;

    var cgstTp = parseFloat($('#cgstTaxPercent').val());

    var cgst_amount = ((subTotal * cgstTp) / 100);
    
    var sgstTp = parseFloat($('#sgstTaxPercent').val());

    var sgst_amount = ((subTotal * sgstTp) / 100);

    $('#cgstTax').html(cgst_amount.toFixed(2));
    
    $('#sgstTax').html(sgst_amount.toFixed(2));

    var BillAmount = Math.round((subTotal + cgst_amount + sgst_amount ) - rebate);
      
    $('#Total').html(BillAmount.toFixed(2));
    $('#BillAmount').val(BillAmount.toFixed(2));
    
    $('#maxCount').val(counter);

}

////////////////////////////////////////////////////
function hideFormElem() {
    var cstTypeStr = $('#customertype_ID :selected').val();

    if (cstTypeStr == 1 || cstTypeStr == 2) {
        document.getElementById("MDate").disabled = true;
        $('#MTime').prop("readonly", true);
        $('#Remark').prop("readonly", true);

    }

    if (cstTypeStr == 3) {
        document.getElementById("MDate").disabled = false;
        $('#MTime').prop("readonly", false);
        $('#Remark').prop("readonly", false);
    }
}
///////////////////////////////////////////////////

function subtotal_pe() {
    var subTotal = 0;

    for (i = 1; i < count; i++) {
        if ($('#Amount_' + i).length) {
            subTotal += parseFloat($('#Amount_' + i).val());
        }
    }

    $('#subTotal').html(subTotal);

    var rebate = parseFloat($('#rebate').val());
    
    var FreightAmount = parseFloat($('#FreightAmount').val());	
	
    //var subTotal = subTotal - rebate;

    var tp = parseFloat($('#taxPercent').val());

    var tax_amount = ((subTotal * tp) / 100);

    $('#tax').html(tax_amount.toFixed(2));

    var BillAmount = Math.round(((subTotal + tax_amount) + FreightAmount));

    $('#Total').html(BillAmount.toFixed(2));
    $('#BillAmount').val(BillAmount.toFixed(2));
     $('#maxCount').val(count);

}


function subtotal_po() {
    var subTotal = 0;
    if( $("#invoice_listing_table  tr").length=='1'){
     var countingz  = $("#invoice_listing_table  tr").attr("id");    
     }else{
     var countingz  = $("#invoice_listing_table  tr:last").attr("id");
     }
     var result = countingz.split("_")[3];
     console.log(result);

    for (i = 1; i <= result; i++) {
        if ($('#Amount_' + i).length) {
            subTotal += parseFloat($('#Amount_' + i).val());
        }
    }
    $('#subTotal').html(subTotal);
     var gst = parseFloat($('#gst').val());
     var tax_amount = ((subTotal * gst) / 100);
     
      $('#tax').html(tax_amount.toFixed(2));
      
      $('#gst').html(tax_amount.toFixed(2));

    //var BillAmount = Math.round(subTotal + tax_amount);
    var BillAmount =(subTotal + tax_amount);
    
    // count= $('#maxCount').val();
    // for (i = 1; i < count; i++) {
    //     if ($('#Amount_' + i).length) {
    //         subTotal += parseFloat($('#Amount_' + i).val());
    //     }
    // }
    $('#tax').val(tax_amount.toFixed(2));
    $('#Total').html(BillAmount.toFixed(2));
    $('#BillAmount').val(BillAmount.toFixed(2));
    $('#maxCount').val(result);

}
///////////////////////////////////////////////////


//Global id count
var counting = 2;
function addRow_lbr() {

    //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
    var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + counting });
    
    //Note_1
    x.find('#Note_1').attr({id: "Note_" + counting , name: "Note_" + counting});
    x.find('#Amount_1').attr({id: "Amount_" + counting , name: "Amount_" + counting});
    x.find('#REM_1').attr({id: "REM_" + counting , name: "REM_" + counting , onclick: "$('#Invoice_data_entry_" + counting + "').remove()"});

    x.appendTo('#invoice_listing_table');
    counting++;
}

function subtotal_lbr() {
    var subTotal = 0;

    for (i = 1; i < counting; i++) {
        if ($('#Amount_' + i).length) {
            subTotal += parseFloat($('#Amount_' + i).val());
        }
    }

    $('#subTotal').html(subTotal);

    var rebate = parseFloat($('#rebate').val());

    //var subTotal = subTotal - rebate;

    var tp = parseFloat($('#taxPercent').val());

    var tax_amount = ((subTotal * tp) / 100);

    $('#tax').html(tax_amount.toFixed(2));

    var BillAmount = Math.round((subTotal + tax_amount) - rebate);
    

    
    $('#Total').html(BillAmount.toFixed(2));
    $('#BillAmount').val(BillAmount.toFixed(2));
    
    $('#maxCount').val(counting);

}

///////////////////////////////////////////////////////////////////////////////////

function ycsdate(id){
//$('#'+id).datetimepicker({ 
//    useCurrent: false,
//   format: 'YYYY-MM-DD',
//});
$('#'+id).datetimepicker({});
$('#'+id).datetimepicker().on('dp.show', function() {
  $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
}).on('dp.hide', function() {
  $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
});
}

/////////////////////////////////////////////////////////////////////////////////
function ycstime() {
$('#timepicker').datetimepicker({
   useCurrent: false,
   format: 'HH:mm'              
});
}

/////////////////////////////////////////////////////////////////////////////////

function ycsdatetime() {
$('#datetimepicker').datetimepicker({
   useCurrent: false,
   format: 'YYYY-MM-DD HH:mm'              
});
}

function ycsdates(id) {
$('#'+id).datetimepicker({
//   useCurrent: false,
  format: 'YYYY-MM-DD HH:mm',
  maxDate:new Date(),
   
});

}

//////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////

function hideFormElemStat() {
    var cstTypeStr = $('#CurrentStatus  :selected').val();
        
    if (cstTypeStr == 'Open' || cstTypeStr == 'InProgress') {     
		$('#SrCloseDate').prop("disabled", true );			
		$('#timepicker1').prop("disabled", true);
		$('#Remark').prop("disabled", true);
    }
    if (cstTypeStr == 'Closed') {
		$('#SrCloseDate').prop("disabled", false);		
		$('#timepicker1').prop("disabled", false);
        	$('#Remark').prop("disabled", false);
    }
    
}

function hidemyFormEleStat() {
var cstTypeStr = $('#CurrentStatus :selected').val();
	if (cstTypeStr != 'Closed') {
		$('#SrCloseDate').prop("disabled", true);		
		$('#timepicker1').prop("disabled", true);
                $('#Remark').prop("disabled", true);
        } else {
        	$('#SrCloseDate').prop("disabled", false);		
		$('#timepicker1').prop("disabled", false);
                $('#Remark').prop("disabled", false);
        }
}


function tothrs(){
    var DGontime= document.getElementById("DGontime").value;
    var DGofftime=document.getElementById("DGofftime").value;

    var start = moment.duration(DGontime,"hh:mm");
    var end = moment.duration(DGofftime,"hh:mm");
     var diff = end.subtract(start);
    
    //var diff=moment(DGofftime)-moment(DGontime)
    console.log(diff);
    // return hours
   
    
   
    if(DGofftime > DGontime){
        
      document.getElementById("TotRunninghrs").value= diff.hours().toString() + '.'+ diff.minutes().toString(); 
   
    }
    else{
        alert('Off time should be greater than On time');
         document.getElementById("TotRunninghrs").value= '';
    }
}


  function tohrs(){
    var DGontime= document.getElementById("DGontime").value;
    var DGofftime=document.getElementById("DGofftime").value;
    var tot=Math.abs(new Date(DGofftime)-new Date(DGontime));
    
    console.log(DGontime);
    console.log(DGofftime);
    if(DGofftime > DGontime){
        
       document.getElementById("TotRunninghrs").value=tot;
    console.log(tot);
    }
    else{
        alert('enter start and end time');
    }
}



 

/////////////////////////////////////////////////////////////////////////////////

function dis() {
        
        var marSta = $('#MStatus :selected').val();
        if (marSta == 1 || marSta == 3) {
        var x = document.getElementById("customertype_ID").options[1].disabled = true;
        var y = document.getElementById("customertype_ID").options[2].disabled = true;
        var z = document.getElementById("customertype_ID").options[3].disabled = false;
            } 

        if (marSta == 2) {
        var a = document.getElementById("customertype_ID").options[3].disabled = true;  
        var b = document.getElementById("customertype_ID").options[1].disabled = false;
        var c = document.getElementById("customertype_ID").options[2].disabled = false;

            }     
    }
    
////////////////////////////////////////////////////////////////////////////////

function ycssel()
{
$(document).ready(function() {
  $(".js-example-basic-single").select2({
    placeholder: "Select"
});
});
}

////////////////////////////////////////////////////////////////////////////////

function apLoc(basePath, ID) {
    var loc = $('#' + ID).val(); 

    $.post(basePath + "/lib/ajax/ap_location.php", {'loc': loc}, function (data) {

$('#ApSSID').empty();

$.each(data, function() {
   $("#ApSSID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
   $('#ApSSID').append($('<option></option>').val(this.ApSSID).text(this.ApSSID))
   });

    }, "json");    
}

////////////////////////////////////////////////////////////////////////////////

function apSSID(basePath, ID) {
   var ssid = $('#' + ID).val();
  
$.post(basePath + "/lib/ajax/ap_ssid.php", {'ssid': ssid}, function (data) { 

$('#ApIp').empty();

$.each(data, function() {
   $('#ApIp').append($('<option></option>').val(this.ApIp).text(this.ApIp))
   });

    }, "json");   
}
////////////////////////////////////////////////////////////////////////////////

function custChg(basePath, ID) {
   var cid = $('#' + ID).val();

$('#ApIp').val('');
$('#EquipIp').val('');
  
$.post(basePath + "/lib/ajax/equip_ip.php", {'cid': cid}, function (data) { 

$('#ApIp').val(data["0"].ApIp);
$('#EquipIp').val(data["0"].EquipmentIp);

    }, "json");   
}

////////////////////////////////////////////////////////////////////////////////


function packageSel(basePath, ID) {
    var pln = $('#' + ID).val(); 

    $.post(basePath + "/lib/ajax/pac_select.php", {'pln': pln}, function (data) {
$('#package_ID').empty();

$.each(data, function() {
   $('#package_ID').append($('<option></option>').val(this.ID).text(this.SMPackName))
   });

    }, "json");    
}

////////////////////////////////////////////////////////////////////////////////

function hideEmp() {
    var payTypeStr = $('#PaymentType  :selected').val();
    
    if (payTypeStr == 'E') {       
        document.getElementById("employee_ID").disabled = false;
        document.getElementById("NonEmployee").disabled = true; 
    }
    if (payTypeStr == 'NE') {        
        document.getElementById("employee_ID").disabled = true;
        document.getElementById("NonEmployee").disabled = false; 
    }
}

//////////////////////////////////////////////////////////////////////////////////

// $(function () {
//   $('[data-toggle="popover"]').popover()
// })

//////////////////////////////////////////////////////////////////////////////////
//avoid dropdown  
function avoiddrop(){
    $('#PackageId_1').attr('data-toggle','');  
}
/////////////////////////////////////////////////////////////////////////////////
function entitySel() { 
 var entityId = $('#EntityID  :selected').val();
 if(entityId === "AllEntity"){
      document.getElementById("customer_type").disabled = true;
      document.getElementById("customer_status").disabled = true;	
 } else {
      document.getElementById("customer_type").disabled = false;
      document.getElementById("customer_status").disabled = false;
 }
}

function statusSel(basePath, customer_type) {
 var customerType = $('#' + customer_type).val();
    $.post(basePath + "/lib/ajax/cust_status.php", {'customerType': customerType}, function (data) {
$('#customer_status').empty();
$("#customer_status").prepend('<option value="" disabled selected style="display:none;">Select</option>');
$.each(data, function() {
   $('#customer_status').append($('<option></option>').val(this.ID).text(this.Status))
   });
    }, "json");
}

function checkSmsFields(){
  var entityId = $('#EntityID  :selected').val();
  var custType = $('#customer_type  :selected').val();
  var custStatus = $('#customer_status  :selected').val();  

   if(entityId!=="AllEntity" && !custType){
	alert("Please select Customer Type");  
   }else if(custType && !custStatus){
   	alert("Please select Customer Status");
   }
}

function checkCheckBoxes(theForm) {
	if (theForm.confirm_send.checked == false){
	    alert ('Please check Confirm Send');
	    return false;
	} else { 	
	    return true;
	}
}

function getRMName(id){
    var RMName = $("#"+id+" option:selected").text();
    var result = id.split("_")[1];
    $('input[name=RMName_'+result+']').val(RMName);
}


function getPODetails(basePath, ID){
    
    var poid = ID; 

    $.post(basePath + "/lib/ajax/ppc_podet.php", {'poid': poid}, function (data) {
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function getPODetails(basePath, ID){
    
    var woid = ID; 

    $.post(basePath + "/lib/ajax/pp_masterdet.php", {'woid': woid}, function (data) {
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }t
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function getPPCDetails(basePath, ID){
    
    var poid = ID; 

    $.post(basePath + "/lib/ajax/store_ppcdet.php", {'poid': poid}, function (data) {
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function getparamDetails(basePath, ID){
   
    var woid = ID; 

    $.post(basePath + "/lib/ajax/pp_masterdet.php", {'woid': woid}, function (data) {
        
        // console.log(data);
        console.log(data[0]['LotNo']);

          // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data[0].length; i++) {

                var parname=data[0][i]['ParameterName'].toString();
              
            //    console.log(parname);
                 if ( document.getElementById(parname.replace(/\s/g,'')) != null)
                {
                    document.getElementById(parname.replace(/\s/g,'')).value=data[0][i]['SOPValue'];
                }
                
                 if(data[0][i]['ParameterName'] =='Barrel Temp-Z1' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
                {
                     document.getElementById('EXBZ1').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Barrel Temp-Z2' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
                {
                     document.getElementById('EXBZ2').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Barrel Temp-Z3' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
                {
                     document.getElementById('EXBZ3').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Barrel Temp-Z1' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
                {
                     document.getElementById('COEXBZ1').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Barrel Temp-Z2' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
                {
                     document.getElementById('COEXBZ2').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Barrel Temp-Z3' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
                {
                    document.getElementById('BZ3').value=data[0][i]['SOPValue'];
                }
                  else if(data[0][i]['ParameterName'] =='Head 1 DZ' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
                {
                     document.getElementById('EXDZ1').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Head 2 DZ' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
                {
                     document.getElementById('EXDZ2').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Head 3 DZ' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
                {
                    document.getElementById('EXDZ3').value=data[0][i]['SOPValue'];
                }
                    else if(data[0][i]['ParameterName'] =='Head 1 DZ' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
                {
                     document.getElementById('COEXDZ1').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Head 2 DZ' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
                {
                     document.getElementById('COEXDZ2').value=data[0][i]['SOPValue'];
                }
                else if(data[0][i]['ParameterName'] =='Head 3 DZ' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
                {
                    document.getElementById('COEXDZ3').value=data[0][i]['SOPValue'];
                }
        }

        
        document.getElementById('MouldQty').value=data['bom'][0]['MouldQty'];
        document.getElementById('MachineName').value=data['bom'][0]['MachineName'];
        document.getElementById('CustomerName').value=data['bom'][0]['FirstName'];
        document.getElementById('PartName').value=data['bom'][0]['ItemName'];
        document.getElementById('CPoutput').value=data[0][0]['outputpermin'];
         document.getElementById('CPweight').value=data['bom'][0]['weight'];
         document.getElementById('ProductID').value=data['bom'][0]['ProductID'];
        // document.getElementById('').value(data[0]['FirstName']);
        // document.getElementById('').value(data[0]['FirstName']);
        // document.getElementById('').value(data[0]['FirstName']);
        
        
        
        
        
        
        
        $('#rawshowData').empty();
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
       
        for (var i = 0; i < data['bom'].length; i++) {
            
            for (var key in data['bom'][i]) {
               
                if (key=='RawMaterial' || key == 'Grade' || key =='RMQuantity' || key=='InwardQty' || key=='ConsumedQty' || key=='RejectedQty' || key=='ClosingBalance' || key=='LotNo' || key=='OpeningBalance' || key=='UnitOfMeasurement'){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         table.setAttribute('id', 'showData');
         table.setAttribute('name', 'showData');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data['bom'].length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data['bom'][i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("rawshowData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function NotgrtThnOpenBal(id)
{
    console.log(id);
    var idvalue = id.split('_')[1];
    var opnbal = document.getElementById('OpeningBalance_'+idvalue).value;
    var consumeqty = document.getElementById(id).value;
    
    if(parseFloat(consumeqty) > parseFloat(opnbal))
    {
        alert("ConsumedQty can't be more than ");
        document.getElementById(id).value=""; 
        document.getElementById('ClosingBalance_'+idvalue).value = "";
    }

}


function getinspDetails(basePath, ID){
   
    var woid = ID; 

    $.post(basePath + "/lib/ajax/part_spec_det.php", {'woid': woid}, function (data) {
        
        
      
          // ADD JSON DATA TO THE TABLE AS ROWS.
       
        
         //document.getElementById('MouldQty').value=data['bom'][0]['MouldQty'];
        document.getElementById('MachineName').value=data['bom'][0]['MachineName'];
       // document.getElementById('CustomerName').value=data['bom'][0]['FirstName'];
        document.getElementById('productid').value=data['bom'][0]['ProductID'];
        document.getElementById('PartName').value=data['bom'][0]['ItemName'];
        document.getElementById('partSpecmaxCount').value=data['bom'].length;
      
         $('#rawmaterialshowData').empty();
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
       
        for (var i = 0; i < data['bom'].length; i++) {
            
            for (var key in data['bom'][i]) {
               
                if (key=='Inspection Parameter' || key=='Dimension/Specification' || key=='Equipment Name' || key=='Ins 1'|| key=='Ins 2'|| key=='Ins 3'|| key=='Ins 4'|| key=='Ins 5'|| key=='Ins 6'|| key=='Ins 7' || key=='Ins 8' || key=='Result'  ){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         table.setAttribute('id', 'RawMaterialTable');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data['bom'].length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data['bom'][i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("rawmaterialshowData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}


function getBatchRMDetails(basePath, ID){
   
    var woid = ID; 

    $.post(basePath + "/lib/ajax/batchrm_det.php", {'woid': woid}, function (data) {
        
    console.log(data);
        if(data){
        $('#showData').empty();
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
        
 var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               
                if (key=='RawMaterial' || key =='Grade' || key=='Requested Quantity' || key=='Issued Quantity' || key=='Unit Of Measurement' ){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
                }
            }
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         //table.setAttribute('id', 'showData1');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);
}
else{
     $('#showData').empty();
    alert('out of stock');
     $("#BatchNo").val("");
    $("#BatchNo").select2().select2("val", "", "placeholder", "--select--");
     //$("#"+('BatchNo')).prepend('<option value="" disabled selected style="display:none;">Select</option>');
}
    }, "json");  
}

function getBatchDetails(basePath, ID){
   
    var woid = ID; 

    $.post(basePath + "/lib/ajax/pp_masterdet.php", {'woid': woid}, function (data) {
        
        
          // ADD JSON DATA TO THE TABLE AS ROWS.
        
         document.getElementById('MouldQty').value=data['bom'][0]['MouldQty'];
        document.getElementById('MachineName').value=data['bom'][0]['MachineName'];
        document.getElementById('CustomerName').value=data['bom'][0]['FirstName'];
        document.getElementById('PartName').value=data['bom'][0]['ItemName'];
        
        
        // document.getElementById('').value(data[0]['FirstName']);
        // document.getElementById('').value(data[0]['FirstName']);
        // document.getElementById('').value(data[0]['FirstName']);
        
        
     
        $('#rawmaterialshowData').empty();
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
       
        for (var i = 0; i < data['bom'].length; i++) {
            
            for (var key in data['bom'][i]) {
               
                if (key=='RawMaterial' || key == 'Grade' || key =='RMQuantity' || key=='InwardQty' || key=='ConsumedQty' || key=='RejectedQty' || key=='ClosingBalance' || key=='LotNo' || key=='OpeningBalance' ){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         table.setAttribute('id', 'RawMaterialTable');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data['bom'].length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data['bom'][i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("rawmaterialshowData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}


function Prodfilter(basepath,prodtypeval,prodID)
{

        $.post(basepath + "/lib/ajax/get_product.php", {'woID': prodtypeval}, function (data) {
     console.log(data);
    $('#'+prodID).empty();
    $("#"+prodID).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+prodID).append($('<option></option>').val(this.ID).text(this.ItemName))
    });
   
     });
     
    
    
}

function getppDetails(basepath,woID,ppID)
{
        $.post(basepath + "/lib/ajax/get_ppdetails.php", {'woID': woID}, function (data) {
     console.log(data);
       console.log(ppID);
     //
      
    $('#'+ppID).empty();
    $("#"+ppID).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+ppID).append($('<option></option>').val(this.ID).text(this.ShiftName))
    });
   
     });
     
}

function equaltotoalinspec(){

    var TotInsp = document.getElementById('TotInspQty').value; 

   var Accepted = document.getElementById('AcceptedQty').value;
   var Rework = document.getElementById('ReworkQty').value;
   var Rejected = document.getElementById('RejectedQty').value;

   if(parseFloat(Accepted) == parseFloat(TotInsp)){
    document.getElementById('ReworkQty').value =0;
    document.getElementById('RejectedQty').value =0;
} 

 if(parseFloat(Rework) == parseFloat(TotInsp)){
   
    document.getElementById('AcceptedQty').value =0;
    document.getElementById('RejectedQty').value =0;
}
 if(parseFloat(Rejected) == parseFloat(TotInsp)){ 
   
    document.getElementById('AcceptedQty').value =0;
    document.getElementById('ReworkQty').value =0;
}

if(parseFloat(Rejected)< parseFloat(TotInsp) && parseFloat(Accepted) == 0 && parseFloat(Accepted) == 0){
   
    document.getElementById('AcceptedQty').value ='';
    document.getElementById('ReworkQty').value ="";
}

   if(Accepted == "" || Rework == "" || Rejected == "" ) {

   if(parseFloat(Accepted) > parseFloat(TotInsp)){
       alert("Acccepted Mtrs/Qty can't be more thann Total Inspection Mtrs/Qty ");
       document.getElementById('AcceptedQty').value ="";
   }

   if(parseFloat(Rework) > parseFloat(TotInsp)){
    alert("Rework Mtr/Qty can't be more thann Total Inspection Mtrs/Qty ");
    document.getElementById('ReworkQty').value ="";
    }

    if(parseFloat(Rejected) > parseFloat(TotInsp)){
        alert("Rejected Mtr/Qty can't be more thann Total Inspection Mtrs/Qty ");
        document.getElementById('RejectedQty').value ="";
    }

    var accRew = parseFloat(Accepted) + parseFloat(Rework);

   if(parseFloat(accRew) > parseFloat(TotInsp)){
   
    alert("Acccepted Mtrs/Qty and Rework Mtr/Qty together can't be more thann Total Inspection Mtrs/Qty ");

    document.getElementById('ReworkQty').value ="";
    }

    if(parseFloat(accRew) == parseFloat(TotInsp))
    {
        document.getElementById('RejectedQty').value =0;
    }

    var RewRej = parseFloat(Rework) + parseFloat(Rejected);

    if(parseFloat(RewRej) > parseFloat(TotInsp)){

    alert("Rejected Mtr/Qty and Rework Mtr/Qty together can't be more thann Total Inspection Mtrs/Qty");

    document.getElementById('RejectedQty').value ="";
    }

    if(parseFloat(RewRej) == parseFloat(TotInsp)){
        document.getElementById('AcceptedQty').value =0;
    }


    var accRej = parseFloat(Accepted) + parseFloat(Rejected);

    if(parseFloat(accRej) > parseFloat(TotInsp)){

    alert("Acccepted Mtrs/Qty and Rework Mtr/Qty together can't be more thann Total Inspection Mtrs/Qty");

    document.getElementById('RejectedQty').value ="";
    }
   
    if(parseFloat(accRej) == parseFloat(TotInsp)){
    
        document.getElementById('ReworkQty').value =0;
        }

    

      }  else{

    var accRewRej = parseFloat(Accepted) + parseFloat(Rework)+parseFloat(Rejected);
    
    if(parseFloat(accRewRej) > parseFloat(TotInsp)){

        alert("Quantity together can't be more thann Total Inspection Mtrs/Qty ");
        document.getElementById('RejectedQty').value ="";
            }
    
            if(parseFloat(accRewRej) < parseFloat(TotInsp)){

                alert("Quantity together can't be less thann Total Inspection Mtrs/Qty ");
                document.getElementById('RejectedQty').value ="";
                    }

}

}


function getppqtyDetails(basepath,woID,prodQtyID)
{
    
      $.post(basepath + "/lib/ajax/get_ppqtydetails.php", {'woID': woID}, function (data) {
     console.log(data);
     //
      
    $('#'+prodQtyID).empty();
    $("#"+prodQtyID).val(data[0]['TotProdMtr']);
  
   
     });
}

function CalcColsingBal(ConsumedQty,OpeningBalance,InwardQty,RejectedQty,ClosingBalance)
{
    console.log(ConsumedQty);
    console.log(OpeningBalance);
    console.log(InwardQty);
    console.log(RejectedQty);
    console.log(ClosingBalance);
    var tbl=document.getElementById('RawMaterialTable');
    
var ConsQty=tbl.rows[0].cells[0].getElementById(ConsumedQty).value;
     console.log(ConsQty);
    var OpenBal=$('#' + ConsumedQty).val();
    var InwQty=$('#' + ConsumedQty).val();
    var RejQty=$('#' + ConsumedQty).val();
    
    var ClosBal=OpenBal+InwQty-RejQty;
   $('#' + ConsumedQty).val(ClosBal);
    
    
    
}


function CalcHrs(StartTime,EndTime,TotHrs)
{
    
    var DGontime= document.getElementById(StartTime).value;
    var DGofftime=document.getElementById(EndTime).value;
    
  
    var start = moment.duration(DGontime,"hh:mm");
    var end = moment.duration(DGofftime,"hh:mm");
    console.log(start.minutes());
    console.log(end.minutes());
    
    if(parseInt(start.minutes()) > 0 && parseInt(end.minutes()) > 0)
    {
     var diff = end.subtract(start);
    
    //var diff=moment(DGofftime)-moment(DGontime)
    console.log(start.minutes());
    console.log(end.minutes());
    // return hours
    
    if( diff.hours() >=0 &&  diff.minutes() >=0){
      document.getElementById(TotHrs).value= diff.hours().toString() + '.'+  diff.minutes().toString(); 
       }
    else{
        alert('Off time should be greater than On time');
         document.getElementById(TotHrs).value= '';
    }
    }
}


 

function getPODetailsManuf(basePath, ID){
    
    var poid = ID; 

    $.post(basePath + "/lib/ajax/manuf_podet.php", {'poid': poid}, function (data) {
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function getManufDetailsQA(basePath, ID){
    
    var poid = ID; 

    $.post(basePath + "/lib/ajax/qa_manufdet.php", {'poid': poid}, function (data) {
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function getManufDetailsDes(basePath, ID){
    
    var poid = ID; 

    $.post(basePath + "/lib/ajax/des_manufdet.php", {'poid': poid}, function (data) {
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
        table.setAttribute('id', 'DespatchTable');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function calcAmountDes(rate,quantity,amount){
        var rate = $('#' + rate).val(); 
            var qty = $('#' + quantity).val(); 
                var amt = $('#' + amount); 
    $(amt).val((rate*qty).toFixed(2));
}

function subtotal_desp(){
    
     var subTotal = 0;
 
     var counting  = $('#DespatchTable tr').length;
     
    for (i = 1; i < counting; i++) {
        if ($('#Amount_' + i).length) {
            subTotal += parseFloat($('#Amount_' + i).val());
        }
    }

    $('#subTotal').html(subTotal);

    //var rebate = parseFloat($('#rebate').val());

    //var subTotal = subTotal - rebate;

    var tp = parseFloat($('#taxPercent').val());

    var tax_amount = ((subTotal * tp) / 100);

    $('#tax').html(tax_amount.toFixed(2));

    var BillAmount = Math.round((subTotal + tax_amount));
    

    $('#STotal').val(subTotal.toFixed(2));
    $('#Total').html(BillAmount.toFixed(2));
    $('#BillAmount').val(BillAmount.toFixed(2));
    
}

function get_state_agianst_country(basePath,countryVal,IdToReflect){  /// populating state name agianst country value
   
     $.post(basePath + "/lib/ajax/get_state_agianst_country.php", {'countryVal': countryVal}, function (data) {
     
    $('#'+IdToReflect).empty();
    $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+IdToReflect).append($('<option></option>').val(this.ID).text(this.StateName))
    });
   
     });
}
function minstock(evt){
    var charCode=(evt.which) ? evt.which:event.keyCode;
    if(charCode<48 || charCode>57){
        alert("Enter only numbers");
        return false;
       }
       else{
           return true;
       }
}
function maxstock(evt){
    var charCode=(evt.which) ? evt.which:event.keyCode;
    if(charCode<48 || charCode>57){
        alert("Enter only numbers");
        return false;
       }
       else{
           return true;
       }
}
function currentstock(evt){
    var charCode=(evt.which) ? evt.which:event.keyCode;
    if(charCode<48 || charCode>57){
        alert("Enter only numbers");
        return false;
       }
       else{
           return true;
       }
}
function production(){
    var min=document.getElementById("Outputpermin").value;
    var hr=document.getElementById("Outputperhrs").value=(min*60).toFixed(2);
    var day=document.getElementById("Outputperday").value=(hr*24).toFixed(2);
    var qty=document.getElementById("PlanQuantity").value;
    var trm=document.getElementById("TotReqMnts").value=((1/min)*qty).toFixed(2);
    var trh=document.getElementById("TotReqhrs").value=(trm/60).toFixed(2);
    var trd=document.getElementById("NoofdaysReq").value=Math.ceil(trh/24).toFixed(2);
    document.getElementById("NoofshiftReq").value=Math.ceil(trh/12);
  
}

 

function addRowWOcalc(editcount) {
    
     var count =$('#invoice_listing_table tr').length;
     // var count = $('#maxCount').val();  
           
     count++;
 
  
 /*   if(editcount){
              count = editcount;        
    } */


    //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
    var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + count});

    //x.find('#Invoice_data_entry_1').attr({id: "Invoice_data_entry_"+ count}); 
    x.find('#BatchNo_1').val('');
    if ($('#BatchNo_1').length) {
        x.find('#BatchNo_1').attr({id: "BatchNo_" + count, name: "BatchNo_" + count});
    }
	
	// Proforma invoice start
	x.find('#Quantitys_1').val('');
    x.find('#Quantitys_1').attr({id: "Quantitys_" + count, name: "Quantitys_" + count, onkeyup: "$('#Value_" + count + "').val(($('#Quantitys_" + count + "').val() * $('#price_unit_" + count + "').val()).toFixed(2));total_pro()"});
    x.find('#price_unit_1').val('');
    x.find('#price_unit_1').attr({id: "price_unit_" + count, name: "price_unit_" + count, onkeyup: "$('#Value_" + count + "').val(($('#Quantitys_" + count + "').val() * $('#price_unit_" + count + "').val()).toFixed(2));total_pro();$('#Value_" + count + "').val(($('#Field3_" + count + "').val() * $('#price_unit_" + count + "').val()).toFixed(2));total_pro()"});
	
	  x.find('#Value_1').val('');
    if ($('#Value_1').length) {
        x.find('#Value_1').attr({id: "Value_" + count, name: "Value_" + count});
    }
	   x.find('#Material_1').val('');
    if ($('#Material_1').length) {
        x.find('#Material_1').attr({id: "Material_" + count, name: "Material_" + count});
    }
	    x.find('#Uom_1').val('');
    if ($('#Uom_1').length) {
        x.find('#Uom_1').attr({id: "Uom_" + count, name: "Uom_" + count});
    }
	//proforma invoice end
	
	// materia inward start
x.find('#Iterm_description_1').val('');
    x.find('#Iterm_description_1').attr({id: "Iterm_description_" + count, name: "Iterm_description_" + count});

    x.find('#item_id_1').val('');
    x.find('#item_id_1').attr({id: "item_id_" + count, name: "item_id_" + count});

    x.find('#po_qty_1').val('');
    x.find('#po_qty_1').attr({id: "po_qty_" + count, name: "po_qty_" + count});
	
	  x.find('#pending_qty_1').val('');
    if ($('#pending_qty_1').length) {
        x.find('#pending_qty_1').attr({id: "pending_qty_" + count, name: "pending_qty_" + count});
    }
	   x.find('#received_qty_1').val('');
    if ($('#received_qty_1').length) {
        x.find('#received_qty_1').attr({id: "received_qty_" + count, name: "received_qty_" + count, onkeyup: "$('#total_" + count + "').val(($('#received_qty_" + count + "').val() * $('#cost_unit_" + count + "').val()).toFixed(2));total_pro();  nozero(this.id);material_Validationnn(this.id);" });
    }
	    x.find('#received_qt_in_kg_1').val('');
    if ($('#received_qt_in_kg_1').length) {
        x.find('#received_qt_in_kg_1').attr({id: "received_qt_in_kg_" + count, name: "received_qt_in_kg_" + count});
    }

    x.find('#unit_1').val('');
    if ($('#unit_1').length) {
        x.find('#unit_1').attr({id: "unit_" + count, name: "unit_" + count});
    }
    x.find('#unitname_1').val('');
    if ($('#unitname_1').length) {
        x.find('#unitname_1').attr({id: "unitname_" + count, name: "unitname_" + count});
    }

    x.find('#batch_no_1').val('');
    if ($('#batch_no_1').length) {
        x.find('#batch_no_1').attr({id: "batch_no_" + count, name: "batch_no_" + count});
    }
    x.find('#cost_unit_1').val('');
    if ($('#cost_unit_1').length) {
        x.find('#cost_unit_1').attr({id: "cost_unit_" + count, name: "cost_unit_" + count, onkeyup: "$('#total_" + count + "').val(($('#received_qty_" + count + "').val() * $('#cost_unit_" + count + "').val()).toFixed(2));total_pro();nozero(this.id);"});
    }
    x.find('#total_1').val('');
    if ($('#total_1').length) {
        x.find('#total_1').attr({id: "total_" + count, name: "total_" + count});
    }
    x.find('#supplier_invoice_no_1').val('');
    if ($('#supplier_invoice_no_1').length) {
        x.find('#supplier_invoice_no_1').attr({id: "supplier_invoice_no_" + count, name: "supplier_invoice_no_" + count});
    }
    x.find('#invoice_date_1').val('');
    if ($('#invoice_date_1').length) {
        x.find('#invoice_date_1').attr({id: "invoice_date_" + count, name: "invoice_date_" + count});
    }
   
	//material inward end
	
	//Qc Material Inwards start

//Qc Material Inwards start

x.find('#RMName_1').val('');
    x.find('#RMName_1').attr({id: "RMName_" + count, name: "RMName_" + count});

    x.find('#item_id_1').val('');
    x.find('#item_id_1').attr({id: "item_id_" + count, name: "item_id_" + count});
	
	  x.find('#received_qty_1').val('');
    if ($('#received_qty_1').length) {
        x.find('#received_qty_1').attr({id: "received_qty_" + count, name: "received_qty_" + count});
    }
	   x.find('#unit_1').val('');
    if ($('#unit_1').length) {
        x.find('#unit_1').attr({id: "unit_" + count, name: "unit_" + count});
    }

    x.find('#UnitName_1').val('');
    if ($('#UnitName_1').length) {
        x.find('#UnitName_1').attr({id: "UnitName_" + count, name: "UnitName_" + count});
    }

	    x.find('#received_qt_in_kg_1').val('');
    if ($('#received_qt_in_kg_1').length) {
        x.find('#received_qt_in_kg_1').attr({id: "received_qt_in_kg_" + count, name: "received_qt_in_kg_" + count});
    }
    x.find('#batch_no_1').val('');
    if ($('#batch_no_1').length) {
        x.find('#batch_no_1').attr({id: "batch_no_" + count, name: "batch_no_" + count});
    }
    x.find('#supplier_invoice_no_1').val('');
    if ($('#supplier_invoice_no_1').length) {
        x.find('#supplier_invoice_no_1').attr({id: "supplier_invoice_no_" + count, name: "supplier_invoice_no_" + count});
    }
    x.find('#invoice_date_1').val('');
    if ($('#invoice_date_1').length) {
        x.find('#invoice_date_1').attr({id: "invoice_date_" + count, name: "invoice_date_" + count});
    }
    
        x.find('#material_quantity_stat_1').val('');
    if ($('#material_quantity_stat_1').length) {
        x.find('#material_quantity_stat_1').attr({id: "material_quantity_stat_" + count, name: "material_quantity_stat_" + count});
    }
    
    x.find('#accepted_qty_1').val('');
    if ($('#accepted_qty_1').length) {
        x.find('#accepted_qty_1').attr({id: "accepted_qty_" + count, name: "accepted_qty_" + count, onkeyup: "nozero(this.id);accepted_val_qc(this.id);$('rejected_qty_" +count+"').val(($('received_qty_"+count+"').val() - $('accepted_qty_"+count+"').val()).toFixed(2));", required});
    }    
     x.find('#acceptedqty_1').val('');
   if ($('#acceptedqty_1').length) {
       x.find('#acceptedqty_1').attr({id: "acceptedqty_" + count,  onkeypress : "return onlyNumbernodecimal(event);", name: "acceptedqty_" + count, required});
   }  
    x.find('#rejected_qty_1').val('');
    if ($('#rejected_qty_1').length) {
        x.find('#rejected_qty_1').attr({id: "rejected_qty_" + count, name: "rejected_qty_" + count});
    }
    x.find('#rejection_reason_1').val('');
    if ($('#rejection_reason_1').length) {
        x.find('#rejection_reason_1').attr({id: "rejection_reason_" + count, name: "rejection_reason_" + count});
    }
   
   
	//Qc Material Inwards end
	
	
	    // raw Material issue start


 x.find('#rawmaterial_ID_1').val('');
        x.find('#rawmaterial_ID_1').attr({id: "rawmaterial_ID_" + count, name: "rawmaterial_ID_" + count});

    x.find('#RMName_1').val('');
        x.find('#RMName_1').attr({id: "RMName_" + count, name: "RMName_" + count});

    x.find('#Quantity2_1').val('');
        x.find('#Quantity2_1').attr({id: "Quantity2_" + count, name: "Quantity2_" + count});

	 x.find('#unit_ID_1').val('');
    if ($('#unit_ID_1').length) {
        x.find('#unit_ID_1').attr({id: "unit_ID_" + count, name: "unit_ID_" + count});
    }

	  x.find('#uom_1').val('');
    if ($('#uom_1').length) {
        x.find('#uom_1').attr({id: "uom_" + count, name: "uom_" + count});
    }
    // 
      x.find('#available_qty_1').val('');
    if ($('#available_qty_1').length) {
        x.find('#available_qty_1').attr({id: "available_qty_" + count, name: "available_qty_" + count});
    }
      x.find('#rmt_qty_1').val('');
    if ($('#rmt_qty_1').length) {
        x.find('#rmt_qty_1').attr({id: "rmt_qty_" + count, name: "rmt_qty_" + count});
    }
    // 
	   x.find('#issued_qty_1').val('');
    if ($('#issued_qty_1').length) {
        x.find('#issued_qty_1').attr({id: "issued_qty_" + count, onkeypress: "return onlyNumbernodecimal(event);", name: "issued_qty_" + count, onkeyup : "nozero(this.id);accepted_val_issue_raw(this.id);"});
    }
    x.find('#excess_qty_1').val('');
    if ($('#excess_qty_1').length) {
        x.find('#excess_qty_1').attr({id: "excess_qty_" + count, onkeypress: "return onlyNumbernodecimal(event);", name: "excess_qty_" + count});
    }
	//     x.find('#Uom_1').val('');
    // if ($('#Uom_1').length) {
    //     x.find('#Uom_1').attr({id: "Uom_" + count, name: "Uom_" + count});
    // }
	//raw material issue end
	
	//Inventory Transfer start
    x.find('#item_name_1').val('');
    x.find('#item_name_1').attr({id: "item_name_" + count, name: "item_name_" + count});

    x.find('#batch_1').val('');
    x.find('#batch_1').attr({id: "batch_" + count, name: "batch_" + count});
	
	  x.find('#availabel_stock_1').val('');
    if ($('#availabel_stock_1').length) {
        x.find('#availabel_stock_1').attr({id: "availabel_stock_" + count, name: "availabel_stock_" + count});
    }
	   x.find('#transfer_quantity_1').val('');
    if ($('#transfer_quantity_1').length) {
        x.find('#transfer_quantity_1').attr({id: "transfer_quantity_" + count, name: "transfer_quantity_" + count, onkeyup : "nozero(this.id);accepted_val_in(this.id);"});
    }
	    x.find('#unit_1').val('');
    if ($('#unit_1').length) {
        x.find('#unit_1').attr({id: "unit_" + count, name: "unit_" + count});
    }

    x.find('#unit_id_1').val('');
    if ($('#unit_id_1').length) {
        x.find('#unit_id_1').attr({id: "unit_id_" + count, name: "unit_id_" + count});
    }
    
    // Inventory Transfer End
    
    // QC Inventory Transfer start
    x.find('#item_name_1').val('');
    x.find('#item_name_1').attr({id: "item_name_" + count, name: "item_name_" + count});

    x.find('#RMName_1').val('');
    x.find('#RMName_1').attr({id: "RMName_" + count, name: "RMName_" + count});

    x.find('#batch_no_1').val('');
    x.find('#batch_no_1').attr({id: "batch_no_" + count, name: "batch_no_" + count});
	
	  x.find('#availabel_stock_1').val('');
    if ($('#availabel_stock_1').length) {
        x.find('#availabel_stock_1').attr({id: "availabel_stock_" + count, name: "availabel_stock_" + count});
    }
	   x.find('#transfer_quantity_1').val('');
    if ($('#transfer_quantity_1').length) {
        x.find('#transfer_quantity_1').attr({id: "transfer_quantity_" + count, name: "transfer_quantity_" + count});
    }
	    x.find('#accepted_qty_1').val('');
    if ($('#accepted_qty_1').length) {
        x.find('#accepted_qty_1').attr({id: "accepted_qty_" + count,  onkeypress : "return onlyNumbernodecimal(event);", name: "accepted_qty_" + count, onkeyup : "nozero(this.id);accepted_val(this.id);", required});
    }

    x.find('#unit_id_1').val('');
    if ($('#unit_id_1').length) {
        x.find('#unit_id_1').attr({id: "unit_id_" + count, name: "unit_id_" + count});
    }

    x.find('#UnitName_1').val('');
    if ($('#UnitName_1').length) {
        x.find('#UnitName_1').attr({id: "UnitName_" + count, name: "UnitName_" + count});
    }
    
    // Qc Inventory Transfer End
    
         //material issue consumable start
     x.find('#RMName_1').val('');
     x.find('#RMName_1').attr({id: "RMName_" + count, name: "RMName_" + count});

     x.find('#Rawmaterial_ID_1').val('');
     x.find('#Rawmaterial_ID_1').attr({id: "Rawmaterial_ID_" + count, name: "Rawmaterial_ID_" + count});
  
     x.find('#Quantity_1').val('');
     x.find('#Quantity_1').attr({id: "Quantity_" + count, name: "Quantity_" + count, onkeyup : "$(pending_qty_'+count+').val(($(Quantity_'+count+').val() - $(issued_qty_'+count+').val()).toFixed(2));nozero(this.id);rawmt_issue(this.id);", onkeypress :"return onlynumbers(event);"});
     
       x.find('#issued_qty_1').val('');
     if ($('#issued_qty_1').length) {
         x.find('#issued_qty_1').attr({id: "issued_qty_" + count, name: "issued_qty_" + count});
     }
    // 
           x.find('#available_qty_1').val('');
     if ($('#available_qty_1').length) {
         x.find('#available_qty_1').attr({id: "available_qty_" + count, name: "available_qty_" + count});
     }
            x.find('#issue_qty_1').val('');
     if ($('#issue_qty_1').length) {
         x.find('#issue_qty_1').attr({id: "issue_qty_" + count, name: "issue_qty_" + count});
     }
    // 
        x.find('#pending_qty_1').val('');
     if ($('#pending_qty_1').length) {
         x.find('#pending_qty_1').attr({id: "pending_qty_" + count, name: "pending_qty_" + count});
     }
         x.find('#UnitName_1').val('');
     if ($('#UnitName_1').length) {
         x.find('#UnitName_1').attr({id: "UnitName_" + count, name: "UnitName_" + count});
     }
     // material issue consumable End
	
	/*
	x.find('#ItemDescription_1').val('');
    if ($('#ItemDescription_1').length) {
        x.find('#ItemDescription_1').attr({id: "ItemDescription_" + count, name: "ItemDescription_" + count});
    }
	
	x.find('#UOM_1').val('');
    if ($('#UOM_1').length) {
        x.find('#UOM_1').attr({id: "UOM_" + count, name: "UOM_" + count});
    }
	
	x.find('#Amount_1').val('');
    if ($('#Amount_1').length) {
        x.find('#Amount_1').attr({id: "Amount_" + count, name: "Amount_" + count});
    }*/
	
	
	/*
	x.find('#Unit_1').val('');
    if ($('#Unit_1').length) {
		//x.find('#Unit_1').attr('onkeyup', 'Amount(' + count+');');
        x.find('#Unit_1').attr({id: "Unit_" + count, name: "Unit_" + count});
    }
								  
									 
																																																									  
	 
	
	
	
	x.find('#UnitPrice_1').val('');
    if ($('#UnitPrice_1').length) {
		//x.find('#UnitPrice_1').attr('onkeyup', 'Amount(' + count+');');
        x.find('#UnitPrice_1').attr({id: "UnitPrice_" + count, name: "UnitPrice_" + count});
    }*/
	
	
	x.find('#unitmeasure_1').val('');
    if ($('#unitmeasure_1').length) {
        x.find('#unitmeasure_1').attr({id: "unitmeasure_" + count, name: "unitmeasure_" + count});
    }
	
    x.find('#MaterialType_1').val('');
    if ($('#MaterialType_1').length) {
        x.find('#MaterialType_1').attr({id: "MaterialType_" + count, name: "MaterialType_" + count});
    } 
    
     x.find('#MaterialTypeid_1').val('');
    if ($('#MaterialTypeid_1').length) {
        x.find('#MaterialTypeid_1').attr({id: "MaterialTypeid_" + count, name: "MaterialTypeid_" + count});
    } 
    
      x.find('#unit_1').val('');
    if ($('#unit_1').length) {
        x.find('#unit_1').attr({id: "unit_" + count, name: "unit_" + count});
    } 
    
     x.find('#rawmaterial_1').val('');
    if ($('#rawmaterial_1').length) {
        x.find('#rawmaterial_1').attr({id: "rawmaterial_" + count, name: "rawmaterial_" + count});
    } 
    
    x.find('#supplier_1').val('');
    if ($('#supplier_1').length) {
        x.find('#supplier_1').attr({id: "supplier_" + count, name: "supplier_" + count});
    } 
    
     x.find('#payment_1').val('');
    if ($('#payment_1').length) {
        x.find('#payment_1').attr({id: "payment_" + count, name: "payment_" + count});
    } 
    
    x.find('#ItemNo_1').val('');
    if ($('#ItemNo_1').length) {
        x.find('#ItemNo_1').attr({id: "ItemNo_" + count, name: "ItemNo_" + count});
    }

    x.find('#Grade_1').val('');
    if ($('#Grade_1').length) {
        x.find('#Grade_1').attr({id: "Grade_" + count, name: "Grade_" + count});
    }

    
    x.find('#ItemName_1').val('');
    x.find('#ItemName_1').attr({id: "ItemName_" + count, name: "ItemName_" + count});
    
    x.find('#EmpName_1').val('');
    x.find('#EmpName_1').attr({id: "EmpName_" + count, name: "EmpName_" + count});
    x.find('#Water_1').val('');
    x.find('#Water_1').attr({id: "Water_" + count, name: "Water_" + count});
    
    x.find('#Note_1').val('');
    if ($('#Note_1').length) {
        x.find('#Note_1').attr({id: "Note_" + count, name: "Note_" + count});
    }
    x.find('#Amount_1').val('');
    x.find('#Amount_1').attr({id: "Amount_" + count, name: "Amount_" + count});
	
   x.find('#Quantity_1').val('');
   x.find('#Quantity_1').attr({id: "Quantity_" + count, name: "Quantity_" + count});
     x.find('#Rat_1').val('');
    x.find('#Rat_1').attr({id: "Rat_" + count, name: "Rat_" + count});
    x.find('#Rate_1').val('');
    x.find('#Rate_1').attr({id: "Rate_" + count, name: "Rate_" + count});
    x.find('#Rawstock_1').val('');
    x.find('#Rawstock_1').attr({id: "Rawstock_" + count, name: "Rawstock_" + count});
 
    
     x.find('#Field2_1').val('');
    x.find('#Field2_1').attr({id: "Field2_" + count, name: "Field2_" + count});
    x.find('#Field3_1').val('');
	 //x.find('#Field3_1').attr('onkeyup', 'Amount(' + count+');');
    x.find('#Field3_1').attr({id: "Field3_" + count, name: "Field3_" + count, onkeyup: "$('#Value_" + count + "').val(($('#Field3_" + count + "').val() * $('#price_unit_" + count + "').val()).toFixed(2));total_pro()"});
     x.find('#Field4_1').val('');
    x.find('#Field4_1').attr({id: "Field4_" + count, name: "Field4_" + count});
    x.find('#Field5_1').val('');
	// x.find('#Field5_1').attr('onkeyup', 'Amount(' + count+');');
    x.find('#Field5_1').attr({id: "Field5_" + count, name: "Field5_" + count});
    x.find('#Field6_1').val('');
    x.find('#Field6_1').attr({id: "Field6_" + count, name: "Field6_" + count});
    
     x.find('#Field7_1').val('');
    x.find('#Field7_1').attr({id: "Field7_" + count, name: "Field7_" + count});
    x.find('#Field8_1').val('');
    x.find('#Field8_1').attr({id: "Field8_" + count, name: "Field8_" + count});
     x.find('#Field9_1').val('');
    x.find('#Field9_1').attr({id: "Field9_" + count, name: "Field9_" + count});
    x.find('#Field10_1').val('');
    x.find('#Field10_1').attr({id: "Field10_" + count, name: "Field10_" + count});
    x.find('#Field11_1').val('');
    x.find('#Field11_1').attr({id: "Field11_" + count, name: "Field11_" + count});
    x.find('#Field12_1').val('');
    x.find('#Field12_1').attr({id: "Field12_" + count, name: "Field12_" + count});
	
  //newlyadded
    x.find('#Qty_1').val('');
    x.find('#Qty_1').attr({id: "Qty_" + count, name: "Qty_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2));tax_amount_calc();"});
    x.find('#Emp_1').val('');
    x.find('#Emp_1').attr({id: "Emp_" + count, name: "Emp_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2));tax_amount_calc();"});
    
	//newly added for Enquiry Quotation
	x.find('#Unit_1').val('');
    x.find('#Unit_1').attr({id: "Unit_" + count, name: "Unit_" + count, onkeyup: "$('#Field6_" + count + "').val(($('#Unit_" + count + "').val() * $('#UnitPrice_" + count + "').val()).toFixed(2))"});
    x.find('#UnitPrice_1').val('');
    x.find('#UnitPrice_1').attr({id: "UnitPrice_" + count, name: "UnitPrice_" + count, onkeyup: "$('#Field6_" + count + "').val(($('#Unit_" + count + "').val() * $('#UnitPrice_" + count + "').val()).toFixed(2))"});
	x.find('#ItemDescription_1').val('');
    if ($('#ItemDescription_1').length) {
        x.find('#ItemDescription_1').attr({id: "ItemDescription_" + count, name: "ItemDescription_" + count});
    }
    
 console.log(count);
    //Note_1
	if($('#proformainvoice').length){
    x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove();total_pro()"});
	}else if($('#taxamount_customerorder').length){
		x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove();tax_amount_calc()"});
	}else{
		x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove();"});
	}

    x.appendTo('#invoice_listing_table');
    
     $('#Rate_'+ count).datetimepicker();
     
      $('#Rate_'+ count).datetimepicker().on('dp.show', function() {   
  $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
}).on('dp.hide', function() {
  $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
});

     $('#maxCount').val(count);
    // count++;
}

// function Amount(id)
// {
// 	var Unit =parseFloat($('#Unit_'+id).val());
// 	var UnitPrice =parseFloat($('#UnitPrice_'+id).val());
// 	if(isNaN(UnitPrice))
// 	{
// 		var Total=0;
// 		$('#Field6_'+id).val(Total.toFixed(2));
// 	}else if(isNaN(Unit)){
// 		var Total=0;
// 		$('#Field6_'+id).val(Total.toFixed(2));
// 	}else{
// 	var Amount=Unit*UnitPrice;
//     $('#Field6_'+id).val(Amount.toFixed(2));
// 	}
// }
function Fetch_enquiry_quotation_Data(columnvalue,tablename1,selectcolumn1,selectcolumn2,selectcolumn3,selectcolumn4,selectcolumn5,selectcolumn6,field_id1,field_id2,field_id3,field_id4,field_id5,field_id6)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
	$('#'+field_id3).val('');
    $('#'+field_id4).val('');
	$('#'+field_id5).val('');
	$('#'+field_id6).val('');
	
    $.post(basePath + "/lib/ajax/enquiry_quotation.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2,'selectcolumn3':selectcolumn3,'selectcolumn4':selectcolumn4,'selectcolumn5':selectcolumn5,'selectcolumn6':selectcolumn6}, function (data) {
	
		if(data.length){
			$.each(data, function(key, value) {
				$('#'+field_id1).val(this.CompanyName);
				$('#'+field_id2).val(this.PersonName);
				$('#'+field_id3).val(this.PermntAddress1);
                $('#'+field_id4).val(this.MobileNo);
				$('#'+field_id5).val(this.PermntCity);
				$('#'+field_id6).val(this.PermntZip);				
				
			});
		}
	
 }, "json");   
    
}
function Fetch_feasibility_review_Data(columnvalue,tablename1,tablename2,selectcolumn1,selectcolumn2,selectcolumn3,selectcolumn4,field_id1,field_id2,field_id3,field_id4)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
	$('#'+field_id3).val('');
	$('#'+field_id4).val('');
	 
	
    $.post(basePath + "/lib/ajax/feasibility_review.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2,'tablename2':tablename2,'selectcolumn3':selectcolumn3}, function (data) {
	  $("#tenderdetail tbody").empty();
		if(data.length){
			$.each(data, function(key, value) {
				var count=0;
                if(count >=0 ) {	
                $('#'+field_id3).val(this.user_nicename);	
				$('#'+field_id4).val(this.user_nicename);	
             
                var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12">  <input class="form-control" type="text" id="Title'+count+'" name="Title'+count+'" value="'+this.Title+'" readonly=""> </div></div></td> ';
newRowContent += '  <td>   <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Qty'+count+'" name="Qty'+count+'" value="'+this.Qty+'" readonly=""> </div>   </div>   </td> </tr>';
                     //console.log('hi',newRowContent);
					
					$("#tenderdetail tbody").append(newRowContent);		
				}					
count++	
			});
			
		}
				
 }, "json");   
    
}

function addRowcalc(editcount) {
    console.log(editcount);
      if(editcount){
          count = editcount;
      }
  
      //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
      var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + count});
  
      //x.find('#Invoice_data_entry_1').attr({id: "Invoice_data_entry_"+ count}); 
      x.find('#BatchNo_1').val('');
      if ($('#BatchNo_1').length) {
          x.find('#BatchNo_1').attr({id: "BatchNo_" + count, name: "BatchNo_" + count});
      }
      
      x.find('#ItemNo_1').val('');
      if ($('#ItemNo_1').length) {
          x.find('#ItemNo_1').attr({id: "ItemNo_" + count, name: "ItemNo_" + count});
      }
      x.find('#Grade_1').val('');
      x.find('#Grade_1').attr({id: "Grade_" + count, name: "Grade_" + count});
      
      x.find('#Unit_1').val('');
      x.find('#Unit_1').attr({id: "Unit_" + count, name: "Unit_" + count});
      x.find('#ReturnQuantity_1').val('');
      x.find('#ReturnQuantity_1').attr({id: "ReturnQuantity_" + count, name: "ReturnQuantity_" + count});
      
      x.find('#Note_1').val('');
      if ($('#Note_1').length) {
          x.find('#Note_1').attr({id: "Note_" + count, name: "Note_" + count});
      }
      x.find('#IssuedQuantity_1').val('');
      x.find('#IssuedQuantity_1').attr({id: "IssuedQuantity_" + count, name: "IssuedQuantity_" + count});
     x.find('#Quantity_1').val('');
     x.find('#Quantity_1').attr({id: "Quantity_" + count, name: "Quantity_" + count});
       x.find('#Rat_1').val('');
      x.find('#Rat_1').attr({id: "Rat_" + count, name: "Rat_" + count});
      x.find('#Rate_1').val('');
      x.find('#Rate_1').attr({id: "Rate_" + count, name: "Rate_" + count});
   
      
       x.find('#Field2_1').val('');
      x.find('#Field2_1').attr({id: "Field2_" + count, name: "Field2_" + count});
      x.find('#Field3_1').val('');
      x.find('#Field3_1').attr({id: "Field3_" + count, name: "Field3_" + count});
       x.find('#Field4_1').val('');
      x.find('#Field4_1').attr({id: "Field4_" + count, name: "Field4_" + count});
      x.find('#Field5_1').val('');
      x.find('#Field5_1').attr({id: "Field5_" + count, name: "Field5_" + count});
      x.find('#Field6_1').val('');
      x.find('#Field6_1').attr({id: "Field6_" + count, name: "Field6_" + count});
      
       x.find('#Field7_1').val('');
      x.find('#Field7_1').attr({id: "Field7_" + count, name: "Field7_" + count});
      x.find('#Field8_1').val('');
      x.find('#Field8_1').attr({id: "Field8_" + count, name: "Field8_" + count});
       x.find('#Field9_1').val('');
      x.find('#Field9_1').attr({id: "Field9_" + count, name: "Field9_" + count});
      x.find('#Field10_1').val('');
      x.find('#Field10_1').attr({id: "Field10_" + count, name: "Field10_" + count});
      x.find('#Field11_1').val('');
      x.find('#Field11_1').attr({id: "Field11_" + count, name: "Field11_" + count});
      x.find('#Field12_1').val('');
      x.find('#Field12_1').attr({id: "Field12_" + count, name: "Field12_" + count});
     
    //newlyadded
      x.find('#Qty_1').val('');
      x.find('#Qty_1').attr({id: "Qty_" + count, name: "Qty_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2))"});
      x.find('#Emp_1').val('');
      x.find('#Emp_1').attr({id: "Emp_" + count, name: "Emp_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2))"});
      
  
      //Note_1
      x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove();"});
  
      x.appendTo('#invoice_listing_table');
      
       $('#Rate_'+ count).datetimepicker();
       
        $('#Rate_'+ count).datetimepicker().on('dp.show', function() {   
    $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
  }).on('dp.hide', function() {
    $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
  });
  
       $('#maxCount').val(count);
      //count++;
  }
  


// newly added
function getPMChecklistDetail(basePath, ID){
    
    var pmchkid = ID; 
// console.log(ID);
    $.post(basePath + "/lib/ajax/pm_observationdetail.php", {'pmchkid': pmchkid}, function (data) {
        console.log(data);
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}
//end


   

   
function getBatchDetails(basePath){

    var woid =  document.getElementById('workorder_ID').value;
   
    

    $.post(basePath + "/lib/ajax/batchmi_det.php", {'woid': woid}, function (data) {

     
        $('#showData').empty();
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               
                if (col.indexOf(key) === -1) {
                    col.push(key);
                
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         //table.setAttribute('id', 'showData1');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");


        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
    
    
}


function getRawMaterialFromBatchNo(basePath) {

 
    var poid1 =  document.getElementById('workorder_ID').value;

    $.post(basePath + "/lib/ajax/get_rawFromBatchNo.php", {'poid': poid1}, function (data) {

        $('[id^=ItemNo_]').empty();
        $('[id^=ItemNo_]').prepend('<option value=""  >Select</option>');
        $.each(data, function() {
            $('[id^=ItemNo_]').append($('<option ></option>').val(this.rawmaterial_ID).text(this.RawMaterial));
           });
    }, "json");
}

function downloadpdf(val,pdff){

    if(document.getElementById('checkbox_'+val).checked )
    {
        var poid1 = val;

        document.getElementById(pdff).href = '#';
       
        $('#PDF').attr("disabled", true);

    
        $.post(basePath + "/lib/ajax/get_poNo.php", {'poid': poid1}, function (data) {
            
            var pono=data[0]['PurchaseOrderNo'].toString();
            
             var regExpr = /[^a-zA-Z0-9-. ]/g;
            
            var puo=pono.replace(regExpr, "");

            var file = basePath+'/resource/documents/Invoice'+puo+'.pdf';
            document.getElementById(pdff).href = file;
            $('#PDF').attr("disabled", false);
            document.getElementById(pdff).style.background = 'green';
            document.getElementById(pdff).style.border = 'green';
            document.getElementById(pdff).setAttribute('download',file);

            
        }, "json");
          }
        else{
            $('#PDF').attr("disabled", true);
            document.getElementById(pdff).href = '#';
            document.getElementById(pdff).style.background = 'red';
            document.getElementById(pdff).style.border = 'grredeen';
            document.getElementById(pdff).removeAttribute('download');
         }

}

/*
function dcdownloadpdf(val,pdff){

    if(document.getElementById('checkbox_'+val).checked )
    {
        var poid1 = val;

        document.getElementById(pdff).href = '#';
       
        $('#PDF').attr("disabled", true);

            var file = basePath+'/resource/deliveryChallan/Invoice'+val+'.pdf';
            document.getElementById(pdff).href = file;
            $('#PDF').attr("disabled", false);
            document.getElementById(pdff).style.background = 'green';
            document.getElementById(pdff).style.border = 'green';
            document.getElementById(pdff).setAttribute('download',file);

          }
        else{
            $('#PDF').attr("disabled", true);
            document.getElementById(pdff).href = '#';
            document.getElementById(pdff).style.background = 'red';
            document.getElementById(pdff).style.border = 'grredeen';
            document.getElementById(pdff).removeAttribute('download');
         }

}*/

function dcdownloadpdf(val,pdff){
    if(document.getElementById('checkbox_'+val).checked )
    {
        var poid1 = val;

        document.getElementById(pdff).href = '#';
       
        $('#PDF').attr("disabled", true);

            var file = basePath+'/resource/quatationpdf/Invoice'+val+'.pdf';
            document.getElementById(pdff).href = file;
            $('#PDF').attr("disabled", false);
            document.getElementById(pdff).style.background = 'green';
            document.getElementById(pdff).style.border = 'green';
            document.getElementById(pdff).setAttribute('download',file);

          }
        else{
            $('#PDF').attr("disabled", true);
            document.getElementById(pdff).href = '#';
            document.getElementById(pdff).style.background = 'red';
            document.getElementById(pdff).style.border = 'grredeen';
            document.getElementById(pdff).removeAttribute('download');
         }
}

function dcdownloadpdf2(val,pdff){
    if(document.getElementById('checkbox_'+val).checked )
    {
        var poid1 = val;

        document.getElementById(pdff).href = '#';
       
        $('#PDF').attr("disabled", true);

            var file = basePath+'/resource/proformapdf/Invoice'+val+'.pdf';
            document.getElementById(pdff).href = file;
            $('#PDF').attr("disabled", false);
            document.getElementById(pdff).style.background = 'green';
            document.getElementById(pdff).style.border = 'green';
            document.getElementById(pdff).setAttribute('download',file);

          }
        else{
            $('#PDF').attr("disabled", true);
            document.getElementById(pdff).href = '#';
            document.getElementById(pdff).style.background = 'red';
            document.getElementById(pdff).style.border = 'grredeen';
            document.getElementById(pdff).removeAttribute('download');
         }
}

function dcdownloadpdf3(val,pdff){
    if(document.getElementById('checkbox_'+val).checked )
    {
        var poid1 = val;

        document.getElementById(pdff).href = '#';
       
        $('#PDF').attr("disabled", true);

            var file = basePath+'/resource/workorderpdf/Invoice'+val+'.pdf';
            document.getElementById(pdff).href = file;
            $('#PDF').attr("disabled", false);
            document.getElementById(pdff).style.background = 'green';
            document.getElementById(pdff).style.border = 'green';
            document.getElementById(pdff).setAttribute('download',file);

          }
        else{
            $('#PDF').attr("disabled", true);
            document.getElementById(pdff).href = '#';
            document.getElementById(pdff).style.background = 'red';
            document.getElementById(pdff).style.border = 'grredeen';
            document.getElementById(pdff).removeAttribute('download');
         }
}

function emptydataalert(id)
{
    // console.log( document.getElementById(id).style.background.value  );
   
    if( document.getElementById(id).style.background.value == "red" ){

        alert('Select a row to download the PDF');

    }
}

function getfieldvalue(basePath,ID,Field)
{

        var poid = ID;
        
        var idid = Field.split('_')[1];

        console.log(idid);
        console.log(poid);


    $.post(basePath + "/lib/ajax/get_fieldValue.php", {'poid': poid}, function (data) {

        $('#Grade_'+idid).val(data[0]['Grade']);
        $('#Unit_'+idid).val(data[0]['UnitName']);
        $('#IssuedQuantity_'+idid).val(data[0]['IssQty']);

    }, "json");   
} 



function getBatchMIDetails(basePath){

    var woid =  document.getElementById('workorder_ID').value;
   
    

    $.post(basePath + "/lib/ajax/batchmi_det.php", {'woid': woid}, function (data) {
        

     
        $('#showData').empty();
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               
                if (col.indexOf(key) === -1) {
                    col.push(key);
                
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         //table.setAttribute('id', 'showData1');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");


        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
    
    
}
//end
function getparameterdetail(basePath, ID){
   
    var woid = ID; 
    console.log(basePath);

    $.post(basePath + "/lib/ajax/batchrawmaterialmixing_det.php", {'woid': woid}, function (data) {
        

        
        document.getElementById('machinename').value=data[0]['MachineName'];
        document.getElementById('customername').value=data[0]['FirstName'];
        document.getElementById('productname').value=data[0]['ItemName'];
        
        document.getElementById('machine_ID').value=data[0]['machine_ID'];
        document.getElementById('customer_ID').value=data[0]['customer_ID'];
        document.getElementById('product_ID').value=data[0]['product_ID'];
        
        
        // document.getElementById('').value(data[0]['FirstName']);
        // document.getElementById('').value(data[0]['FirstName']);
        // document.getElementById('').value(data[0]['FirstName']);
             $('#showData').empty();
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               
                if (key=='RawMaterial' || key == 'Grade'|| key=='RMMixing Time' || key=='Mixing Percentage' || key=='Total Consumption'|| key=='UnitOfMeasurement'){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         table.setAttribute('id', 'RawMaterialTable');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);
        ajaxdatetime();

    }, "json");  
}


function playSound()
{
    var audio = new Audio('http://www.rangde.org/static/bell-ring-01.mp3');
    audio.play();
}


function ajaxdatetime()
{
    
      $('input[data-provide="datetimepicker"]').datetimepicker();
      var currentdate = new Date();
    $('input[data-provide="datetimepicker"]').datetimepicker().on('dp.show', function() {
  $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
  

}).on('dp.hide', function() {
  $(this).closest('.temp').addClass('table-responsive').removeClass('temp');
});
}

// used in mysite1.js function outputpermin(prodid)
// {
   
//     $.post(basePath + "/lib/ajax/sopoutput.php", {'prodid': prodid}, function (data) {
        
//         document.getElementById('Outputpermin').value=data[0]['outputpermin'];
        
//     }, "json");  
    
// }

function RMMixingCalc(TotMix,prodid)
{
      var prodval=document.getElementById(prodid).value;
      
      var table = document.getElementById("RawMaterialTable");

      $.post(basePath + "/lib/ajax/rm_mixing_calc.php", {'prodval': prodval}, function (data) {
        
        for (var i = 0; i < data.length; i++) {
           
            var datarmid=data[i]['rawmaterial_ID'];
            console.log(datarmid);
            console.log(data);
           
            for (var j = 0; j <table.rows.length-1; j++) {
                
            var itemid='ItemNo_' + (j+1);
          
            var rmid=document.getElementById (itemid).value;
            
            if(rmid == datarmid)
            {
               
                 document.getElementById ('Quantity_' + (j+1)).value=data[i]['RMPerc'];
                document.getElementById ('EmpName_' + (j+1)).value=Number((data[i]['RMPerc'])*Number(TotMix)/100);
                
            }
  
        }
            
            
        }
        
    }, "json");  
    
    
}

function RMRejectCalc(totid)
{
    
    var Totval=  document.getElementById (totid).value;
    
    var prodval= document.getElementById('ProductID').value;
    
    var table = document.getElementById("showData");
    $.post(basePath + "/lib/ajax/rm_mixing_calc.php", {'prodval': prodval}, function (data) {
            
            
            for (var i = 0; i < data.length; i++) {
               
                var datarmid=data[i]['rawmaterial_ID'];
               
                for (var j = 0; j <table.rows.length-1; j++) {
                    
                var itemid='RMID_' + (j+1);
              
                var rmid=document.getElementById (itemid).value;
                
                if(rmid == datarmid)
                {
                   
                    var RejQty=parseFloat((parseFloat(Totval)*parseFloat(data[i]['RMPerc']))/100);

                    document.getElementById('RejectedQty_' + (j+1)).value=RejQty;
                    var OpeingBal=$('#OpeningBalance_'+(j+1)).val();
                    //var InwardQty=$('#InwardQty_'+(j+1)).val();
                    var ConsumedQty=$('#ConsumedQty_'+(j+1)).val();
                    
                    var Closingbal =parseFloat(OpeingBal)  -(parseFloat(RejQty)+parseFloat(ConsumedQty));
                   
                   console.log(RejQty);
                   console.log(OpeingBal);
                   console.log(ConsumedQty);
                   console.log(Closingbal);
                    document.getElementById('ClosingBalance_' + (j+1)).value=Closingbal.toFixed(2);
                    
                }
      
            }
                
                
            }
            
    }, "json"); 
}


//end

function wrkorderChg(woid) {
    
   
$.post(basePath + "/lib/ajax/fg_quantity.php", {'woid': woid}, function (data) { 

 document.getElementById('Quantity').value=data[0]['TotQty'];

    }, "json");   
}
//end

function getRawMaterial(basePath,ID,atemid) {

    var poid=ID; 
   
    $('[id^="Amount_"]').val("");
    
    var idvalue = atemid.split('_')[1];
    console.log($('#'+("ItemNo_"+ idvalue)));
  
    $.post(basePath+"/lib/ajax/get_raw.php", {'poid': poid}, function (data) {


        $("#ItemNo_"+ idvalue).empty();

        $("#ItemNo_"+ idvalue).prepend('<option value="">Select</option>');
       
        $.each(data, function() {
        
            // $('#ItemNo_'+idvalue).prepend('<option value=""  style="display:none;" required>Select</option>');

            $("#ItemNo_"+idvalue).append($('<option ></option>').val(this.ID).text(this.RMName));
           });
    


    }, "json");   
}  




// function getmaterial(basePath,val,selectid) {
    
 
//     var poid=val; 
    
//     var id= selectid.split("_")[1];
    
//     console.log(id);

//     $.post(basePath+"/lib/ajax/get_raw.php", {'poid': poid}, function (data) {

//   $('#'+("ItemNo_" + id)).empty();
   
   
    
//     $("#"+("ItemNo_" + id)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    
//     $.each(data, function() {
        
//         $('#'+("ItemNo_" + id)).append($('<option></option>').val(this.ID).text(this.RMName))
        
//     });
     

//     }, "json");  


// }  

function Gradedata(id)
{

        // console.log(id.split('_')[1]);

        // var ItemName = $("#"+id+" option:selected").text();

        // console.log(ItemName);
        // console.log(Date().split(' ')[4]);

}




function getRaw(basePath,ID) {

    var poid=ID; 
//   $('[id^="Amount_"]').val("");
console.log(ID);



    $.post(basePath+"/lib/ajax/get_raw.php", {'poid': poid}, function (data) {


        $('[id^=ItemNo_]').empty();
        $('[id^=ItemNo_]').prepend('<option value="">Select</option>');
        $.each(data, function() {
        
            // $('[id^=ItemNo_]').prepend('<option value=""  style="display:none;" required>Select</option>');
            $('[id^=ItemNo_]').append($('<option ></option>').val(this.ID).text(this.RMName));
           });
    


    }, "json");   
} 

function getActualQuantity(basePath,ID,RowId)
{
    var idid = RowId.split('_')[1];
    // document.getElementById('Amount_'+ idid).value = 0 ;
   
    var poid=ID; 
    $.post(basePath + "/lib/ajax/get_actualquantity.php", {'poid': poid}, function (data) {
        
        if(data == undefined || data == null  ){
            console.log('here the data is undefined');
            document.getElementById('Amount_'+ idid).value = 0 ;
        }
      
        var totalQty = 0 ;
       for(var i = 0 ; i< data.length;i++)
       {
            var totalQty = Number(totalQty) + Number(data[i]['TotalQty']);
       }


        document.getElementById('Amount_'+ idid).value = totalQty;


    }, "json"); 

}


function getpodetails(basePath,ID){
   
    var poid=ID; 
   // console.log('hello');
    $.post(basePath + "/lib/ajax/get_po.php", {'poid': poid}, function (data) {
        
        $('#showData').empty();
        

 var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               if (key=='Material Type' || key=='Material Name' || key=='LotNo' || key =='PO Quantity'  || key =='Actual Quantity' || key=='Unit' || key=='Remarks'){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                
                }
            }
        }
}

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         //table.setAttribute('id', 'showData1');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}


// used in mysite1.js function getbatchDetails(woid)
// {
    
//     var woid = woid; 

//     $.post(basePath + "/lib/ajax/reconciliation.php", {'woid': woid}, function (data) {
        

//         console.log(data);
//         $('#showData').empty();
        
       
//         document.getElementById('MachineName').value=data['bom'][0]['MachineName'];
//         document.getElementById('CustomerName').value=data['bom'][0]['FirstName'];
//         document.getElementById('PartName').value=data['bom'][0]['ItemName'];
        
        
      
      
        
//         // // EXTRACT VALUE FOR HTML HEADER. 
//         // // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
       
//         for (var i = 0; i < data['bom'].length; i++) {
            
//             for (var key in data['bom'][i]) {
               
//                 if (key=='RawMaterial' || key == 'Grade' ||  key =='RMQuantity' || key=='InwardQty' || key=='ConsumedQty' || key=='RejectedQty' || key=='Difference' || key=='LotNo' || key=='IssuedQty' || key=='UnitOfMeasurement'  ){
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          table.setAttribute('id', 'showData');
//          table.setAttribute('name', 'showData');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data['bom'].length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data['bom'][i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json"); } 
    
function getrmdata (rmid,selectid) {
   
    
    
    var rawmaterialid= selectid.split("_")[1];
    
$.post(basePath + "/lib/ajax/rm_data.php", {'rmid': rmid}, function (data) { 
      

  document.getElementById("ItemName_" + rawmaterialid).value=data[0]['RMName'];
  
  
    }, "json");   
}  





//end
// function ycssel()
// {
// $(document).ready(function() {
//   $(".js-example-basic-single").select2();
// });
// }
//end
function total() {
	
	var CgstTax = document.getElementById('CGSTTax').value ;
    var SgstTax = document.getElementById('SGSTTax').value ;

	
	   if(CgstTax != SgstTax )
   {
		document.getElementById('SGSTTax').readOnly = true ;
		
		 var SgstTax = document.getElementById('CGSTTax').value ;
		 document.getElementById('SGSTTax').value= SgstTax ;
		
   }
   
    var subtotal = 0;
    if( $("#invoice_listing_table  tr").length=='1'){
     var countingz  = $("#invoice_listing_table  tr").attr("id");    
     }else{
     var countingz  = $("#invoice_listing_table  tr:last").attr("id");
     }
     var result = countingz.split("_")[3];

    for (i = 1; i <= result; i++) {
        if ($('#Amount_' + i).length) {
            subtotal += parseFloat($('#Amount_' + i).val());
        }
    }  
   // document.getElementById("BillAmount").value=subtotal;
    $('#subtotal').html(subtotal);
    $('#BillAmount').val(subtotal.toFixed(2));
   
    var CGSTTax = parseFloat($('#CGSTTax').val());
    var tax_amount = ((subtotal * CGSTTax) / 100);
     
    $('#GSTAmount').html(tax_amount.toFixed(2));
      
    $('#CGSTTax').html(tax_amount.toFixed(2));

   
    var SGSTTax = parseFloat($('#SGSTTax').val());
    var tax_amount1 = ((subtotal * SGSTTax) / 100);
     
    $('#SGSTAmount').html(tax_amount1.toFixed(2));
      
    $('#SGSTTax').html(tax_amount1.toFixed(2));

    var IGSTTax = parseFloat($('#IGSTTax').val());
    var tax_amount2 = ((subtotal * IGSTTax) / 100);
     
    $('#IGSTAmount').html(tax_amount2.toFixed(2));
      
    $('#IGSTTax').html(tax_amount2.toFixed(2));

    
    
    var NetAmount =(subtotal + tax_amount + tax_amount1 + tax_amount2);
    
    // count= $('#maxCount').val();
    // for (i = 1; i < count; i++) {
    //     if ($('#Amount_' + i).length) {
    //         subTotal += parseFloat($('#Amount_' + i).val());
    //     }
    // }

     
    $('#SGSTAmount').val(tax_amount1.toFixed(2));  
    $('#IGSTAmount').val(tax_amount2.toFixed(2));
    $('#CGSTAmount').val(tax_amount.toFixed(2));
    
    $('#Total').html(NetAmount.toFixed(2));
    $('#NetAmount').val(NetAmount.toFixed(2));
    $('#maxCount').val(result);


}
// //end




function BomPartNo(val)

{
    var poid = val;
    // console.log(basePath);
    
    $.post(basePath+"/lib/ajax/get_bomdata.php", {'poid': poid}, function (data) {


        if(data == null)
        {
            $("#product_ID").select2("val", "");
            alert('Create BOM to select this Part No.');

        }

         }, "json");  

}

function quantity(selectid){

var poqty= selectid.split("_")[1];
var pqty=parseFloat(document.getElementById("Quantity_" + poqty).value);
console.log(pqty);
var accepqty=selectid.split("_")[1];
var aqty=parseFloat(document.getElementById("EmpName_" + accepqty).value);
var actualqty=selectid.split("_")[1];
//var acqty=parseFloat(document.getElementById("Water_"+ actualqty).value);
var acqty=document.getElementById("Water_"+ actualqty).value;
var rejected=acqty-aqty;
var rejqty=selectid.split("_")[1];
var reject=parseFloat(document.getElementById("Amount_"+ rejqty).value);
console.log(acqty);
  if(acqty>pqty){
      document.getElementById("Water_" + actualqty).value="";
      alert("Actual Quantity should not be greater than PO Quantity");
  }

   else if(acqty<=pqty){
       
      //document.getElementById("Water_" + actualqty).value=acqty;
        document.getElementById("Amount_"+ rejqty).value=rejected;
     // alert("Please Enter Actual Quantity which is not lesser than accepted quantity");
        document.getElementById("Water_" + actualqty).value=acqty;
      }
  else{
       document.getElementById("Water_" + actualqty).value="";
       
  }
}


function machineno(mid) {
    
      
  $('#machine_ID').val('');
  $('#machinename').val('');
  console.log(basePath);
   
   
$.post(basePath + "/lib/ajax/get_machine.php", {'mid': mid}, function (data) { 
  

//    console.log(data);
  document.getElementById('machine_ID').value=data[0]['ID'];
  document.getElementById('machinename').value=data[0]['MachineName'];


    }, "json");   
}


//end
//Jquery for showing and hidding a value;
// $(document).on('change','#MRType',function(e){
//      if($("#MRType option:selected").val() == "withbatch"){
//          $("#tblRawMaterial").hide();
//          $("#divBatch").show();
//      }else{
//          $("#tblRawMaterial").show();
//           $("#divBatch").hide();
//      }
// }); 
//end
//javascript for showing and hidding a value
function hidebatchno(e) {
   var matreqtype = $('#MRType :selected').val();
  // var matreqtype=document.getElementById("MRType");
   // var strUser = matreqtype.options[matreqtype.selectedIndex].value;
    
    if (matreqtype =="withbatch") {       
        // document.getElementById("tblRawMaterial").style.visibility='hidden';
        // document.getElementById("divBatch").style.visibility='visible'; 
       $('#BatchNo').prop('required',true);
       $('[id^=ItemNo_]').prop('required',false);
       $('[id^=ItemName_]').prop('required',false);
      
        //$('#MRType').prop('required',true);
        document.getElementById("tblRawMaterial").style.display='none';
        //  document.getElementById("Water_1").style.display='none';
        document.getElementById("divBatch").style.display='block'; 
    }
   else {    
        $('#BatchNo').prop('required',false);
        $('[id^=ItemNo_]').prop('required',true);
        $('[id^=ItemName_]').prop('required',true);
        $('[id^=Water_]').prop('required',true);
        document.getElementById("tblRawMaterial").style.display='block';
        //   document.getElementById("Water_1").style.display='block';
        document.getElementById("divBatch").style.display='none'; 
    }
    //console.log(strUser);
}
//end
function getCounts() {
     var matreqtype = $('#MRType :selected').val();
    if((matreqtype=='withbatch')){
       
    var counting  = $('#showData tr:last').find("td:first").find("input").attr('id');
     var result = counting.split("_")[1];
    }else{
    
    var counting  = $('#invoice_listing_table tr:last').attr('id');
    var result = counting.split("_")[3];

    }
    
    console.log(result);
    $('#maxCount').val(result);
}
//end
function getdate(peid,selectid) {
    // console.log("hello") ;
var rawmaterialid= selectid.split("_")[1];
    
$.post(basePath + "/lib/ajax/get_date.php", {'peid': peid}, function (data) { 
 

  document.getElementById("Rate_" + rawmaterialid).value=data[0]['PurchaseEntryDate'];
  
  
    }, "json");   
} 
//end
function qty(selectid){
    
var poqty= selectid.split("_")[1];
var pqty=parseFloat(document.getElementById("Quantity_" + poqty).value);
var actualqty=selectid.split("_")[1];
var acqty=parseFloat(document.getElementById("Water_"+ actualqty).value);
var accepqty=selectid.split("_")[1];
var aqty=parseFloat(document.getElementById("EmpName_" + accepqty).value);
console.log(aqty);
var rejected=acqty-aqty;
var rejqty=selectid.split("_")[1];
var reject=parseFloat(document.getElementById("Amount_"+ rejqty).value);
// if((aqty!=="")&&(!acqty)){
if((aqty!=="")&&(!acqty)){
    alert("please enter actual quantity");
    document.getElementById("EmpName_" + accepqty).value="";
   
}

if(aqty>acqty){
    alert("Accepted Quantity should not be greater than Actual Quantity");
     document.getElementById("EmpName_" + accepqty).value="";
     document.getElementById("Amount_"+ rejqty).value="";

}
 
else{
     document.getElementById("Amount_"+ rejqty).value=rejected;
}
}
//end
function Qty(selectid){

var poqty= selectid.split("_")[1];
var pqty=parseFloat(document.getElementById("Quantity_" + poqty).value);
console.log(pqty);
var accepqty=selectid.split("_")[1];
var aqty=parseFloat(document.getElementById("EmpName_" + accepqty).value);
var actualqty=selectid.split("_")[1];
//var acqty=parseFloat(document.getElementById("Water_"+ actualqty).value);
var acqty=document.getElementById("Water_"+ actualqty).value;
var rejected=acqty-aqty;
var rejqty=selectid.split("_")[1];
var reject=parseFloat(document.getElementById("Amount_"+ rejqty).value);
console.log(acqty);
  if((aqty!="")&&(aqty)){
      alert("please enter actual quantity");
      alert("you entered actual quantity");
  }
    
  if(acqty<aqty){
       
      //document.getElementById("Water_" + actualqty).value=acqty;
        document.getElementById("Amount_"+ rejqty).value="";
      alert("Please Enter Actual Quantity which is not lesser than accepted quantity");
        document.getElementById("Water_" + actualqty).value="";
      }

 if(acqty>pqty){
      document.getElementById("Water_" + actualqty).value="";
      alert("Actual Quantity should not be greater than PO Quantity");
  }

   else if(acqty<=pqty){
       
      //document.getElementById("Water_" + actualqty).value=acqty;
        document.getElementById("Amount_"+ rejqty).value=rejected;
     // alert("Please Enter Actual Quantity which is not lesser than accepted quantity");
        document.getElementById("Water_" + actualqty).value=acqty;
      }
  
  else{
        document.getElementById("Amount_"+ rejqty).value=rejected;
       
  }
}
  //end
    
function gradedata(rmid,selectid){

var ID=rmid;
 
var rawid=selectid.split("_")[1];
    
$.post(basePath + "/lib/ajax/grade.php", {'rmid': rmid}, function (data) { 
      

  
$('#'+("ItemName_" + rawid)).empty();
    $("#"+("ItemName_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+("ItemName_" + rawid)).append($('<option></option>').val(this.Grade).text(this.Grade))
    });

$('#'+("Amount_" + rawid)).empty();
    $("#"+("Amount_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+("Amount_" + rawid)).append($('<option></option>').val(this.LotNo).text(this.LotNo))
    });
}, "json");  
    
console.log("hello");
}  
//end


    
function GRADEDATA(rmid,selectid){

    // var ID=rmid;

    
    var rawid=selectid.split("_")[1];
    
    var ItemName = $("#MaterialType_"+rawid+" option:selected").val();
    
    console.log(ItemName);


    if(ItemName == 7){

    console.log(ItemName);
    
    $.post(basePath + "/lib/ajax/grade.php", {'rmid': rmid}, function (data) { 
          
    
      
    $('#'+("Grade_" + rawid)).empty();
        $("#"+("Grade_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
        $.each(data, function() {
            $('#'+("Grade_" + rawid)).append($('<option></option>').val(this.Grade).text(this.Grade))
        });
    


    }, "json");

}else{
    $('#'+("Grade_" + rawid)).empty();
}

    }  
    //end








function rawdata(rmid,selectid){
var ID=rmid;
 
var rawid=selectid.split("_")[1];
    
$.post(basePath + "/lib/ajax/rawdata.php", {'rmid': rmid}, function (data) { 
      
//  document.getElementById("ItemName_" + rawid).value=data[0]['Grade'];
//  document.getElementById("Amount_" + rawid).value=data[0]['LotNo'];
  
$('#'+("ItemName_" + rawid)).empty();
    $("#"+("ItemName_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+("ItemName_" + rawid)).append($('<option></option>').val(this.Grade).text(this.Grade))
    });
    console.log(val(this.id));
    
// $('#'+("Amount_" + rawid)).empty();
//     $("#"+("Amount_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+("Amount_" + rawid)).append($('<option></option>').val(this.ID).text(this.LotNo))
//     });
 }, "json");  
    

}  
//end
var subcount = 2;
function addRowSub(editcount,ftype=null) {
    //console.log(editcount);
    // if(editcount){
    //     subcount = editcount;
    // }
     var subcount =$('#Listing_table tr').length;
     subcount++;
    var x = $('#Data_entry_1').clone().attr({id: "Data_entry_" + subcount});
    
    if(ftype==''){
     x.find('#Spawning_1').val('');
    x.find('#Spawning_1').attr({id: "Spawning_" + subcount, name: "Spawning_" + subcount});
    }else{
    x.find('#Rate_1').val('');
    x.find('#Rate_1').attr({id: "Rate_" + subcount, name: "Rate_" + subcount});
    }
    
    x.find('#Note_1').val('');
    x.find('#Note_1').attr({id: "Note_" + subcount, name: "Note_" + subcount});
    
    x.find('#Rat_1').val('');
    x.find('#Rat_1').attr({id: "Rat_" + subcount, name: "Rat_" + subcount});
    
    x.find('#ItemName_1').val('');
    x.find('#ItemName_1').attr({id: "ItemName_" + subcount, name: "ItemName_" + subcount});
    
    x.find('#Water_1').val('');
    x.find('#Water_1').attr({id: "Water_" + subcount, name: "Water_" + subcount});
    x.find('#ItemNo_1').val('');
    x.find('#ItemNo_1').attr({id: "ItemNo_" + subcount, name: "ItemNo_" + subcount});
    x.find('#Field4_1').val('');
    x.find('#Field4_1').attr({id: "Field4_" + subcount, name: "Field4_" + subcount});
    x.find('#Field5_1').val('');
    x.find('#Field5_1').attr({id: "Field5_" + subcount, name: "Field5_" + subcount});
    x.find('#Field6_1').val('');
    x.find('#Field6_1').attr({id: "Field6_" + subcount, name: "Field6_" + subcount});
    x.find('#Field7_1').val('');
    x.find('#Field7_1').attr({id: "Field7_" + subcount, name: "Field7_" + subcount});
    x.find('#Field8_1').val('');
    x.find('#Field8_1').attr({id: "Field8_" + subcount, name: "Field8_" + subcount});

    //Note_1
    x.find('#SUBREM_1').attr({id: "SUBREM_" + subcount, name: "SUBREM_" + subcount, onclick: "$('#Data_entry_" + subcount + "').remove()"});

    x.appendTo('#Listing_table');
    

     $('#Rate_'+ subcount).datetimepicker();
     
      $('#Rate_'+ subcount).datetimepicker().on('dp.show', function() {
  $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
}).on('dp.hide', function() {
  $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
});

 $('#Note_'+ subcount).datetimepicker();
     
      $('#Note_'+ subcount).datetimepicker().on('dp.show', function() {
  $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
}).on('dp.hide', function() {
  $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
});
    $('#maxCountSub').val(subcount);
   
}

/////////////////////////////////////////////////////////////////////////////
function CalculateHrs(selectid)
{
 var dgontime= selectid.split("_")[1];

   var DGontime=document.getElementById("Rate_" + dgontime).value;
   var dgofftime= selectid.split("_")[1];
    
   // console.log(DGontime);
    var DGofftime=document.getElementById("Note_" + dgofftime).value;
    var tothrs= selectid.split("_")[1]; 
    
    // var start = moment.duration(DGontime,"HH:mm a");
    // var end = moment.duration(DGofftime,"HH:mm a");
    
var start = moment(DGontime,"hh:mm");
var end = moment(DGofftime,"hh:mm");
var duration = moment.duration(end.diff(start));
var hours = parseInt(duration.asHours());
var minutes = parseInt(duration.asMinutes())%60;
    
  document.getElementById("Rat_"+ tothrs).value=duration.hours().toString() + '.'+  duration.minutes().toString();
 

    
    // if(parseInt(start.minutes()) > 0 && parseInt(end.minutes()) > 0)
    // {
    //  var diff = end.subtract(start);
    
    // //var diff=moment(DGofftime)-moment(DGontime)
    // console.log(start.minutes());
    // console.log(end.minutes());
    
    // // return hours
    //  if( diff.hours() >=0 &&  diff.minutes() >=0){
    //   document.getElementById("Rat_"+ tothrs).value=Math.abs(diff.hours().toString() + '.'+  diff.minutes().toString()); 
    //   }
    //  else{
       
    //   //alert('Off time should be greater than On time');
    //      document.getElementById("Rat_"+ tothrs).value=Math.abs(diff.hours().toString() + '.'+  diff.minutes().toString());
    // }
    
  
    // }
}




function getCountSub() {
    var counting  = $('#Listing_table tr:last').attr('id');
    var result = counting.split("_")[2];
    $('#maxCountSub').val(result);
    
}

function getsubcounts(table_body_id,countset_id) {
    var counting  = $('#'+table_body_id+ ' tr:last').attr('id');
    var result = counting.split("_")[3];
    $('#'+countset_id).val(result);
    
}

function batchno(id) {
var weight= parseFloat(document.getElementById('Actweight').value);
var totpdnmtr=parseFloat(document.getElementById('TotProdMtr').value);
document.getElementById('TotProdKg').value=weight * totpdnmtr;
}

function Hrs(selectid)
{
 
 var dgontime= selectid.split("_")[1];
 var ontime=document.getElementById("Rate_" + dgontime).value;
 var DGontime=document.getElementById("Rate_" + dgontime).value.split(':');
 var dgofftime= selectid.split("_")[1];
 var DGofftime=document.getElementById("Note_" + dgofftime).value.split(':');
 var offtime=document.getElementById("Note_" + dgofftime).value;
 var tothrs= selectid.split("_")[1]; 
    
    
        var day = '1/1/1970 ', // 1st January 1970
        start = ontime, //eg "09:20 PM"
        end = offtime, //eg "10:00 PM"
        diff_in_min = ( Date.parse(day + end) - Date.parse(day + start) ) / 1000 / 60; 
        d = Number(diff_in_min * 60);
        var h = Math.floor(d / 3600);
        var m = Math.floor(d % 3600 / 60);
        var s = Math.floor(d % 3600 % 60); 
        console.log(Date.parse(day));
        console.log(Date.parse(day + start));

       // document.getElementById("Rat_"+ tothrs).value=""+h+" hr :" +m +" m";
         document.getElementById("Rat_"+ tothrs).value=""+h+"." +m +"";
}

          

// Convert H:M:S to seconds
// Seconds are optional (i.e. n:n is treated as h:s)
function hmsToSeconds(times) {
    console.log(times);
  var b = times.split(':');
  return b[0]*3600 + b[1]*60 + (+b[2] || 0);
}          

// Convert seconds to hh:mm:ss
// Allow for -ve time values
function secondsToHMS(secs) {
  function z(n){return (n<10?'0':'') + n;}
  var sign = secs < 0? '-':'';
  secs = Math.abs(secs);
  //return sign + z(secs/3600 |0) + ':' + z((secs%3600) / 60 |0) + ':' + z(secs%60);
  return sign + z(secs/3600 |0) + ':' + z((secs%3600) / 60 |0);
}

                          
// function timediff(currId,firstTime,secondTime,toDispId,typ){
//     if(typ=='clone'){
//     var clonCount= currId.split("_")[1];
//     var tF = $('#'+firstTime+'_'+clonCount).val();
//     var tS = $('#'+secondTime+'_'+clonCount).val();
//     }else{
//     var tF = $('#'+firstTime).val();
//     var tS = $('#'+secondTime).val();
//     }
    
//     var dF = new Date(2019,01,01,tF.split(":")[0],tF.split(":")[1],00);
    
//     if((tF.split(":")[0]>tS.split(":")[0])&& (tF.split(":")[1]>tS.split(":")[1])){
//     var dS= new Date(2019,01,02,tS.split(":")[0],tS.split(":")[1],00);    
//     }else if((tF.split(":")[0]==tS.split(":")[0]) && (tF.split(":")[1]>tS.split(":")[1])){
//     var dS = new Date(2019,01,02,tS.split(":")[0],tS.split(":")[1],00);        
//     }else{
//     var dS = new Date(2019,01,01,tS.split(":")[0],tS.split(":")[1],00);        
//     }

//     var diff = secondsToHMS((dF - dS) / 1000); 

//     if(diff.substring(0, 1)=='-'){
//       diff = secondsToHMS((dS - dF) / 1000); 
//     }
//     if(typ=='clone'){
//     $('#'+toDispId+'_'+clonCount).val(diff);
//     }else{
//     $('#'+toDispId).val(diff);    
//     }
// }
    
    
                              
function timediff(currId,firstTime,secondTime,toDispId,typ){
    if(typ=='clone'){
    var clonCount= currId.split("_")[1];
    var tF = $('#'+firstTime+'_'+clonCount).val();
    var tS = $('#'+secondTime+'_'+clonCount).val();
    }else{
    var tF = $('#'+firstTime).val();
    var tS = $('#'+secondTime).val();
    }
    
    var dF = new Date(2019,01,01,tF.split(":")[0],tF.split(":")[1],00);
    if((tS.split(":")[0]>tF.split(":")[0])){
       
     var dS = new Date(2019,01,01,tS.split(":")[0],tS.split(":")[1],00); 
       
    }
    else{
         var dS = new Date(2019,01,01,(parseInt(tS.split(":")[0])+parseInt(24)),tS.split(":")[1],00); 
         
    }
    
    // if((tF.split(":")[0]>tS.split(":")[0])&& (tF.split(":")[1]>tS.split(":")[1])){
    // var dS= new Date(2019,01,02,tS.split(":")[0],tS.split(":")[1],00);    
    // }else if((tF.split(":")[0]==tS.split(":")[0]) && (tF.split(":")[1]>tS.split(":")[1])){
    // var dS = new Date(2019,01,02,tS.split(":")[0],tS.split(":")[1],00);        
    // }else{
    // var dS = new Date(2019,01,01,tS.split(":")[0],tS.split(":")[1],00);        
    // }

    var diff = secondsToHMS((dF - dS) / 1000); 

    if(diff.substring(0, 1)=='-'){
       diff = secondsToHMS((dS - dF) / 1000); 
    }
    if(typ=='clone'){
    $('#'+toDispId+'_'+clonCount).val(diff);
    }else{
    $('#'+toDispId).val(diff);    
    }
}
    

function ppdate(date_ID,shift_ID){
  var pdate = document.getElementById(date_ID).value;
    var cid = document.getElementById(shift_ID).value; 

    $.post(basePath + "/lib/ajax/date.php", {'cid':cid,'pdate':pdate}, function (data) {
       
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}
////////////////////////////

function oee(sdate_ID,edate_ID,shift_ID){
  var sdate = document.getElementById(sdate_ID).value;
  var edate = document.getElementById(edate_ID).value; 
  var cid = document.getElementById(shift_ID).value; 

    $.post(basePath + "/lib/ajax/oee.php", {'sdate':sdate,'edate':edate,'cid':cid}, function (data) {
       
        $('#showData').empty();
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}
///////////////////////////////////////////////////  
// function oppermin(proid)
// {
   
//     $.post(basePath + "/lib/ajax/sopperminute.php", {'proid': proid}, function (data) {
        
//      document.getElementById('CycleTime').value=data[0]['CycleTime'];
      
        
//     }, "json");  
//      console.log('hi');  
    
// }
function sopoutput(pdt_id)
{
   
    $.post(basePath + "/lib/ajax/sopproduct.php", {'pdt_id': pdt_id}, function (data) {
        
     var out=data[0]['CycleTime'];
     
     document.getElementById('outputpermin').value=60/out;
     
     //console.log('hello');   
        
    }, "json");  
    
}
/////////////////////////////////////////

function Prodfil(basepath,prodtypeval,prodID)
{
    
   
      //$('#'+prodID).empty();
      
$.post(basepath + "/lib/ajax/work.php", {'woID': prodtypeval}, function (data) {
     

    $('#'+prodID).empty();
    
    
    $("#"+prodID).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    
    $.each(data, function() {
        
      
        $('#'+prodID).append($('<option></option>').val(this.ID).text(this.PlanCode))
        
    });
  
 }, "json");    
     
    
}
function plancode(ID) {
    
    //console.log("hello");
   
 var planID = $('#' + ID).val();
 
   $('#producttype_ID').empty();
   $('#product_ID').empty();
   $('#unit_ID').empty();
  // $('#Quantity').empty();

// $('#producttype_ID').val('');
// $('#product_ID').val('');
// $('#unit_ID').val('');
 $('#Quantity').val('');
 $('#RemainingQty').val('');
 
  
$.post(basePath + "/lib/ajax/plandata.php", {'planID': planID}, function (data) { 
    
    

$.each(data, function() {
  // $("#producttype_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
   $('#producttype_ID').append($('<option></option>').val(this.pdtID).text(this.item))
   // $("#product_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
   $('#product_ID').append($('<option></option>').val(this.pdtID).text(this.descp))
   // $("#unit_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
   $('#unit_ID').append($('<option></option>').val(this.unitID).text(this.unit))
  
   });
// console.log(ID);
// $.each(data, function() {
//   $("#ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
//   $('#product_ID').append($('<option></option>').val(this.ID).text(this.Description))
//   });
// $.each(data, function() {
//   $("#ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
//   $('#unit_ID').append($('<option></option>').val(this.ID).text(this.UnitName))
//   });
   

// $('#producttype_ID').val(data["0"].ItemName);
// $('#product_ID').val(data["0"].Description);
// $('#unit_ID').val(data["0"].UnitName);
//var pqty=$('#Quantity').val(data["0"].PlanQuantity);
var pqty=parseInt(document.getElementById("Quantity").value=data["0"].PlanQuantity);
//var pqty=parseFloat($('#Quantity').val(data["0"].PlanQuantity));
 var wqty=data["0"].WorkQuantity;
 
console.log(pqty);
console.log(wqty);
if(wqty == 0){
    
 $('#RemainingQty').val(data["0"].PlanQuantity);
}
else{
    document.getElementById("RemainingQty").value=pqty-wqty;
}
 }, "json");   
}

function oninspec(id){
    
var accepqty=$('#AcceptedQty').val();
var rejectqty=$('#RejectedQty').val();
var reworkqty=$('#ReworkQty').val();
document.getElementById("RejectionPPM").value=(rejectqty/accepqty)*1000000;
document.getElementById("ReworkPPM").value=(reworkqty/accepqty)*1000000;


}
function uom(uomid,selectid)
{
   var unitid= selectid.split("_")[1];
    $.post(basePath + "/lib/ajax/uomdata.php", {'uomid': uomid}, function (data) {
     document.getElementById("Amount_" + unitid).value=data[0]['UnitName'];  
    
    }, "json");  
    
}

function plan(){
    
    var planqty=document.getElementById("Quantity").value;
    var workqty=document.getElementById("WorkQuantity").value;
    var rqty=document.getElementById("RemainingQty").value=planqty;
   
    if(parseFloat(rqty)<=parseFloat(workqty)){
        alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
        document.getElementById("RemainingQty").value=planqty;
        document.getElementById("WorkQuantity").value='';
    }else{
    var remainqty=document.getElementById("RemainingQty").value=rqty-workqty;   
    }
}

function getpedetails(basePath,ID,typ){
   
    var peid=ID; 
    $.post(basePath + "/lib/ajax/get_pe.php", {'peid': peid,'typ':typ}, function (data) {
        
        $('#showData').empty();
        

 var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               if (key=='RawMaterial' || key=='LotNo' || key =='PO Quantity'  || key =='Actual Quantity' || key=='Unit' || key=='Accepted Quantity' || key=='Rejected Quantity'|| key=='Remarks'){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                
                }
            }
        }
}

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         //table.setAttribute('id', 'showData1');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function getGrnForQa(basePath,idd){
 
 
   $('#GRNNo').empty();
   $.post(basePath + "/lib/ajax/get_grn.php", {'poid': idd}, function (data) { 

   $.each(data, function() {
   $("#GRNNo").prepend('<option value="" disabled selected style="display:none;">Select</option>');
   $('#GRNNo').append($('<option></option>').val(this.ID).text(this.PurchaseEntryNo));
   }); 
 });
}

function matissue(selectid){
      
var id= selectid.split("_")[1];
var apqty=parseFloat(document.getElementById("approvedqty_" + id).value);
var issuqty=parseFloat(document.getElementById("Water_"+id).value);

if(apqty < issuqty || issuqty==0){
    document.getElementById("Water_"+id).value='';
    alert('Issued Quantity should not be greater than approved quantity');
}
else{
    document.getElementById("Water_"+id).value;
   
    
}
 
}

function unit(uomid,selectid)
{
   var unitid= selectid.split("_")[1];
    $.post(basePath + "/lib/ajax/unitofmeasurement.php", {'uomid': uomid}, function (data) {
    $('#showData').empty();
        

 var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               if (key=='RawMaterial' || key=='RawMaterial Mixing Precentage' || key =='Unit Of Measurement' ){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                
                }
            }
        }
}

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         //table.setAttribute('id', 'showData1');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
    
}

// Add two times in hh:mm format
function addTimes(t0, t1) {
  return secondsToHMS(hmsToSeconds(t0) + hmsToSeconds(t1));
}

// subtract two times in hh:mm format
function subTimes(t0, t1) {
  return secondsToHMS(hmsToSeconds(t0) - hmsToSeconds(t1));
}

function calcTotPrdHrs(fromTimeId,toTimeId,toDispId){
     var fromTime = $('#'+fromTimeId).val();
     console.log(fromTime);
     var totalToTime = '00:00';
     
     $('[id^='+toTimeId+'_]').each(function () {
        totalToTime = addTimes(totalToTime,this.value);
     });
     
     var actTotProHrs = subTimes(fromTime, totalToTime);
     
     var hrMin = actTotProHrs.split(':');

     // Hours are worth 60 minutes.
     var actMins = (+hrMin[0]) * 60 + (+hrMin[1]);
     
     $('#'+toDispId).val(actMins);
}

function getBatchforStkRtn(basePath, MatIssDate, toDispId){
    
   $('#'+toDispId).empty();
   $('#'+toDispId).val("");
   
   $.post(basePath + "/lib/ajax/get_batchno.php", {'midate': MatIssDate}, function (data) { 
   
   $("#"+toDispId).prepend('<option value="" >Select</option>');    
  
   $.each(data, function() {
   $('#'+toDispId).append($('<option></option>').val(this.ID).text(this.BatchNo));
   }); 
 });
 
}

function get(basePath,Batchid,toDispId){
    
   $('#'+toDispId).empty();
   $('#'+toDispId).val("");
   $.post(basePath + "/lib/ajax/get_misno.php", {'Batchid': Batchid}, function (data) { 
       
    $("#"+toDispId).prepend('<option value="" >Select</option>');

   $.each(data, function() {
   $('#'+toDispId).append($('<option></option>').val(this.ID).text(this.MaterialIssueNo));
   }); 
 });
 
}

function getarea(basePath,misID,toDispId, Area_idvalue){





$('#'+toDispId).val("");

  
$.post(basePath + "/lib/ajax/get_area.php", {'misID': misID}, function (data) { 

 $('#'+toDispId).val(data["0"]['AreaName']);
 $('#'+ Area_idvalue).val(data["0"]['ID']);

    }, "json");   

 
}

function validateExist(id,tableBodyId) {
    
    var Seee = id.split("_")[0];
    var idid = id.split("_")[1];
    
    var selectedvalue = document.getElementById(id).value; 
    
    var count = document.getElementById(tableBodyId).getElementsByTagName("tr").length;
    
        if(count>1)
        {
            for(i=1;i<=count;i++){
                var rowvalue = document.getElementById(Seee+"_"+i).value; 
                    
                if(selectedvalue==rowvalue && id != Seee+"_"+i)
                {
                    document.getElementById(id).value="";
                    alert("Already Selected");
                    document.getElementById('Note_' + idid).value="";
                    document.getElementById('RaisedPOQty_' + idid).value="";
                    document.getElementById('unitname_' + idid).value="";
                    document.getElementById('unit_' + idid).value="";
                    document.getElementById('unitname_' + idid).value="";
                    document.getElementById('Amount_' + idid).value="";
                                
                    break;
                }
            }
        }
    }



 function getItemName(id,iname){

    var ItemName = $("#"+id+" option:selected").text();

    var result = id.split("_")[1];
    $('input[name='+iname+result+']').val(ItemName);

}


function getItName(id){

    var ItemName = $("#"+id+" option:selected").text();
    console.log(ItemName);
    $('#materialissue_value').val(ItemName);
}





function getrawmaterial(basePath,rmid,id){

 
$.post(basePath + "/lib/ajax/get_rawname.php", {'rmid': rmid}, function (data) { 


    $('#'+("ItemNo_" + 1)).empty();
    
    $("#"+("ItemNo_" + 1)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+("ItemNo_" + 1)).append($('<option></option>').val(this.ID).text(this.RMName))
    });
     

}, "json");  

  
} 
function shift(mid){
 
  
// $.post(basePath + "/lib/ajax/get_plan.php", {'mid': mid}, function (data) { 

// var days=document.getElementById('PlanDate').value;
// var pdate = new Date(data[0]['PlanDate']);
// // console.log(pdate)
// var nodays=Math.round(data[0]['NoofdaysReq']);
// pdate.setDate(pdate.getDate() + nodays);

// var dd = pdate.getDate();
// var mm = pdate.getMonth() + 1;
// var y =  pdate.getFullYear();

// var someFormattedDate = y +'-0'+ mm +'-'+dd;
// console.log(someFormattedDate);

// if(days>=someFormattedDate){
//   document.getElementById('machine_ID').value;
// }
// else{
    
//     alert('This machine already added in plan');
//   document.getElementById('machine_ID').selectedIndex =0;
// }
  
//     }, "json");  
}
function work(woid){
    
    $.post(basePath + "/lib/ajax/wodata.php", {'woid': woid}, function (data) { 
      var rqty=document.getElementById("RemainingQty").value=data[0]["RemainingQty"];
    }, "json");  
}

function remain(ID) {

 var woid = $('#' + ID).val();
 console.log(woid);
 
   
   
    // var workqty=document.getElementById("WorkQuantity").value;
    
    // $.post(basePath + "/lib/ajax/wodata.php", {'woid': woid}, function (data) {
    //     var wkqty=data["0"].WorkQuantity;
    //      var planqty=data["0"].PlanQuantity;
    //     if(woid!==0){
    //         document.getElementById("RemainingQty").value=planqty;
        
    //     if(parseFloat(planqty)<=parseFloat(workqty)){
    //     alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
    //     document.getElementById("RemainingQty").value=planqty;
    //     document.getElementById("WorkQuantity").value='';
    //     }else{
    //     document.getElementById("RemainingQty").value=planqty-workqty;   
    // }
    // }
    //  else{
    //      var remainingqty=planqty-wkqty;
    //      console.log(remainingqty);
    //      document.getElementById("RemainingQty").value=remainingqty;
    //      if(parseFloat(planqty)<=parseFloat(remainingqty)){
    //     alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
    //     document.getElementById("RemainingQty").value=planqty;
    //     document.getElementById("WorkQuantity").value='';
    //     }else{
    //     document.getElementById("RemainingQty").value=planqty-remainingqty;   
    // }
    //  }   
    
    
//   document.getElementById("RemainingQty").value=planqty;
   
//     if(parseFloat(rqty)<=parseFloat(workqty)){
//         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
//         document.getElementById("RemainingQty").value=planqty;
//         document.getElementById("WorkQuantity").value='';
//     }else{
//     var remainqty=document.getElementById("RemainingQty").value=rqty-workqty;   
//     }
   
//  $('#Quantity').val('');
 //$('#RemainingQty').val('');
//  var prodplan=document.getElementById("productionplan_ID").value;
//  console.log(prodplan);
  
$.post(basePath + "/lib/ajax/wodata.php", {'woid': woid}, function (data) { 
 
 var planqty=document.getElementById("Quantity").value;
 console.log(planqty);
var workqty=document.getElementById("WorkQuantity").value;
var wqty=data["0"].WorkQuantity;
var pqty=data["0"].PlanQuantity;
console.log(pqty);
if(wqty == 0){
 document.getElementById("RemainingQty").value=planqty;    
  if(planqty<=workqty){
        alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
        document.getElementById("RemainingQty").value=planqty;
        document.getElementById("WorkQuantity").value='';
    }else{
    document.getElementById("RemainingQty").value=planqty-workqty;   
    }
}
else{
 
  console.log(wqty);
 
  console.log(pqty);
  var rqy=document.getElementById("RemainingQty").value=pqty-wqty;
  console.log(rqy);
  if(parseFloat(pqty)<=parseFloat(wqty)){
        alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
       document.getElementById("RemainingQty").value=pqty;
        document.getElementById("WorkQuantity").value='';
    }else{
    document.getElementById("RemainingQty").value=pqty-wqty;   
    }
  
 }
 
 }, "json");   

// var planqty=document.getElementById("Quantity").value;
//  console.log(planqty);
// //var workqty=document.getElementById("WorkQuantity").value;
// var wqty=data["0"].WorkQuantity;
// var pqty=data["0"].PlanQuantity;
// if(wqty == 0){
//  document.getElementById("RemainingQty").value=planqty;    
//   if(parseFloat(planqty)<=parseFloat(workqty)){
//         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
//         document.getElementById("RemainingQty").value=planqty;
//         document.getElementById("WorkQuantity").value='';
//     }else{
//     document.getElementById("RemainingQty").value=planqty-workqty;   
//     }
// }
// else{
 
//   console.log(wqty);
 
//   console.log(pqty);
//   document.getElementById("RemainingQty").value=pqty-wqty;
// //   if(parseFloat(qty)<=parseFloat(wqty)){
// //         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
// //       // document.getElementById("RemainingQty").value=qty;
// //         document.getElementById("WorkQuantity").value='';
// //     }else{
// //     document.getElementById("RemainingQty").value=planqty-wqty;   
// //     }
  
//  }
 
//  }, "json");   

}

function plans(){
    
    var rqty=parseFloat(document.getElementById("RemainingQty").value);
    var workqty=parseFloat(document.getElementById("WorkQuantity").value);
  
   if(workqty>rqty){
    // if(parseFloat(rqty)<=parseFloat(workqty)){
        // alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
        alert('Workorder Quantity should not be greater than Remaining Quantity');
        document.getElementById("RemainingQty").value=rqty;
        document.getElementById("WorkQuantity").value='';
    }
    else if(workqty<=0){
        alert('Workorder Quantity should not be zero or less than zero');
        document.getElementById("RemainingQty").value=rqty;
        document.getElementById("WorkQuantity").value='';
        }
        else{
        
    var remainqty=document.getElementById("RemainingQty").value=rqty-workqty;   
    
    }
  
    console.log('helo');
}



function bom(selectid)
{
    // console.log(selectid);

   var unitid= selectid.split("_")[1];
   
   var unit= selectid.split("_")[0];
//    console.log(unit);
  
   if(unit != 'REM')
   {
 var qty=document.getElementById("Quantity_" + unitid).value; 
 
   if(qty=='' || qty==0){
       alert("Please enter quantity which should not be zero");
       document.getElementById("Quantity_" + unitid).value='';
   }
   else{
       document.getElementById("Quantity_" + unitid).value;
   }

}

    var maxcount =  document.getElementById('maxCount').value;
    var totalQuantity = 0 ;

    for(var i = 1; i <= maxcount;i++)
    {
         
        var check = document.getElementById('Quantity_'+i) ;
        
        if(check == null ) 
        {
            // console.log('here the data is empty');

            continue ;
        }
        else
        {
        var firstRQuantity =  document.getElementById('Quantity_'+i).value;
        
        var totalQuantity = Number(totalQuantity) + Number(firstRQuantity);
        }

    }
        // console.log(totalQuantity);
        document.getElementById('totalQuantity').value =  totalQuantity ; 


}



function matreq(selectid,val)
{
   console.log(selectid);
   console.log(val);
   
   if(val<= 0){
       alert('Requested quantity can\'t zero or less than zero');
       document.getElementById(selectid).value = "";
   }

 
}

function datepicker(id)
{
  
    document.getElementById(id).className= "form-control datepicker";
    var today = new Date();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose:true,
        endDate: "today",
        maxDate: today
    }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });


    $('.datepicker').keyup(function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9^-]/g, '');
        }
    });
}


function getissue(basePath,rmid,id){

//   var id= selectid.split("_")[1];
var rmid=document.getElementById("workorder_ID").value;
console.log(rmid);
$.post(basePath + "/lib/ajax/get_matissu.php", {'rmid': rmid}, function (data) { 


    $('#'+("ItemNo_" + 1)).empty();
    
    $("#"+("ItemNo_" + 1)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+("ItemNo_" + 1)).append($('<option></option>').val(this.ID).text(this.RMName))
    });
     

}, "json");  

 
} 

function getdcproduct(basePath,id){

//   var id= selectid.split("_")[1];
var dcid=document.getElementById(id).value;


$.post(basePath + "/lib/ajax/get_dcproduct.php", {'dcid': dcid}, function (data) { 

        $('[id^=ItemName_]').empty();
        $('[id^=ItemName_]').prepend('<option value=""  >Select</option>');
        $.each(data, function() {
            $('[id^=ItemName_]').append($('<option ></option>').val(this.ID).text(this.RMName));
           });

}, "json");  

 
} 

function getdcproductdetail(basePath,val,id){
    
  var dcid=document.getElementById('dc_ID').value;

  var splitid= id.split("_")[1];

$.post(basePath + "/lib/ajax/get_dcdetail.php", {'pdtid': val,'dcid':dcid}, function (data) { 

    
     document.getElementById("Water_" + splitid).value=data[0]['HSNCode'];
     document.getElementById("Note_" + splitid).value=data[0]['Quantity'];
     document.getElementById("Quantity_" + splitid).value=data[0]['Quantity'];

      
}, "json");  

 
} 
function selectAll() {
        var checkboxes = new Array();
        checkboxes = document.getElementsByName('ycs_ID');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true) {
                checkboxes[i].checked = false;
            }else{
                checkboxes[i].checked = true;
            }
        }
}

function restrictCheck(Msgtxt) {
        var checkboxes = new Array();
        checkboxes = document.getElementsByName('ycs_ID');
        
        var myListSel = [];
        $.each($("input[name='ycs_ID']:checked"), function(){            
            myListSel.push($(this).val());
        });
        
        console.log(myListSel);
        
        if(myListSel.length>1){
            alert('Please select on row to '+Msgtxt);
            return false;
        }
}
function Quantity(selectid){

    var poqty= selectid.split("_")[1];
    
    
    var pqty=parseFloat(document.getElementById("Quantity_" + poqty).value);
    
    // var actualqty=selectid.split("_")[1];
    var acqty=document.getElementById("Water_"+ poqty).value;
    
    
     if(acqty>pqty){
          document.getElementById("Water_" + poqty).value="";
          document.getElementById("Water_" + poqty).focus();
          
          alert("Actual Quantity should not be greater than PO Quantity");
      }
    
     else if(acqty<=pqty){
    
            document.getElementById("Water_" + poqty).value=acqty;
          }
      
     
    }


function qty(id){
	
	var TotInspQty = document.getElementById('TotInspQty').value;
	var AcceptedQty = document.getElementById('AcceptedQty').value;
	var RejectedQty = document.getElementById('RejectedQty').value;
	var ReworkQty = document.getElementById('ReworkQty').value;

	
	if((RejectedQty.length == 0 && ReworkQty.length == 0) && AcceptedQty.length != 0){
	if(Number(AcceptedQty) > Number(TotInspQty))
	{
		console.log('hello accepted');
		var alrt = alert ('Acccepted Mtrs/Qty can\'t be greater than Total Inspection Mtrs/Qty ');		
		document.getElementById(id).value = '';	
		document.getElementById(id).focus();
	}
	}



	
	var acceptedReworkTotal = Number(AcceptedQty) + Number(ReworkQty);
	
	
	if( ReworkQty.length != 0 && AcceptedQty.length != 0){
	
	if(Number(acceptedReworkTotal) > Number(TotInspQty))
	{
	
			console.log('rework is focus');
			
		alert('Acccepted Mtrs/Qty + Rework Mtr/Qty = ' +acceptedReworkTotal+' - can\'t be more than Total Inspection Mtrs/Qty');
		
		document.getElementById(id).value = '';	
		document.getElementById(id).focus();	
		
	}
	}
	
	

	
	var acceptedReworkRejectTotal = Number(AcceptedQty) + Number(ReworkQty) + Number(RejectedQty);
	
	if( (RejectedQty.length != 0 && ReworkQty.length != 0 && AcceptedQty.length != 0)){
	if( Number(acceptedReworkRejectTotal) > Number(TotInspQty) || Number(acceptedReworkRejectTotal) < Number(TotInspQty) )
	{
		alert( 'Total of Acccepted Mtrs/Qty + Rework Mtr/Qty + Rejected Mtr/Qty = '+acceptedReworkRejectTotal+ ' - can\'t be greater or less than Total Inspection Mtrs/Qty' )
		
		document.getElementById(id).value = '';	
		document.getElementById(id).focus();
	}
	
	}
	
	var indivigualValue = document.getElementById(id).value;
	
	if (Number(indivigualValue) > Number(TotInspQty)  )
	{
		alert('Value can\'t be greater than Total Inspection Mtrs/Qty');
		document.getElementById(id).value = '';	
		document.getElementById(id).focus();
	}
	
	

}


function taxChoise()
{
       var CGST_SGST = document.getElementById('CGST_SGST').checked;
       var IGST = document.getElementById('IGST').checked;
   
   if(IGST == true)
   {
    document.getElementById('CGSTTax').readOnly = true ;
    document.getElementById('SGSTTax').readOnly = true ;
    document.getElementById('CGSTTax').value =0;
    document.getElementById('SGSTTax').value =0;
    document.getElementById('CGSTAmount').value =0;
    document.getElementById('SGSTAmount').value =0;

   }
   else{
  document.getElementById('CGSTTax').readOnly = false ;
    document.getElementById('SGSTTax').readOnly = true ;
    document.getElementById('CGSTTax').value =9; 
    document.getElementById('SGSTTax').value =9;
	
		
   }
   
   if(CGST_SGST==true)
   {
    document.getElementById('IGSTTax').readOnly = true ;
    document.getElementById('IGSTTax').value =0;
    document.getElementById('IGSTAmount').value =0;


   }
   else{
    document.getElementById('IGSTTax').readOnly = false ;
    document.getElementById('IGSTTax').value =18;

   }
  
 
}


function onlyNumberKey(evt) {

        // Only ASCII charactar in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        
       
        if (ASCIICode>44 && ASCIICode<58) {
            return true; 
        }
        if( (ASCIICode== 190) || (ASCIICode==08))
        {
            return true;
        }
        return false; 
    } 

    function onlyNumbernodecimal(evt) {  

        // Only ASCII charactar in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        // console.log(ASCIICode);
        
       
        if (ASCIICode>46 && ASCIICode<58) {
            return true; 
        }
  
        return false; 
    } 



 function NotMoreThanReq(id){
    var dataa = document.getElementById(id).value;

    // if(dataa == 0 && dataa != "") {
    //     alert('Quantity can\'t be zero or less than zero');
    //     document.getElementById(id).value="";
    //     }

        var val = id.split('_')[1];
       var ReqQty = document.getElementById('Water_'+val).value;
       
       console.log(ReqQty);

       if(dataa > ReqQty){
           alert('Issue Quantity can\'t be more than Requested quantity');
           document.getElementById(id).value="";
       }
 }

function nozero(id){
    var dataa = document.getElementById(id).value;

    if(dataa == 0 && dataa != "") {
        alert('Quantity can\'t be zero or less than zero');
        document.getElementById(id).value="";
        }
    // this code for copy paste the textbox error Start
    var x= document.getElementById(id).value;
    if(isNaN(x))
    {
     document.getElementById(id).value="";
    }
// End

    //     var val = id.split('_')[1];
    //    var ReqQty = document.getElementById('Water_'+val).value;
       
    //    console.log(ReqQty);

    //    if(dataa > ReqQty){
    //        alert('Issue Quantity can\'t be more than Requested quantity');
    //        document.getElementById(id).value="";
    //    }
}

function nocopy(id){
    // this code for copy paste the textbox error Start
    var x= document.getElementById(id).value;
    if(isNaN(x))
    {
     document.getElementById(id).value="";
    }

}

function quantityvalidation(id,value)
{
    // console.log(id);
    // console.log(value);
    var retquantity = id.split('_')[1];
   
    // console.log(retquantity);

    var issued = document.getElementById('IssuedQuantity_'+retquantity).value;
    console.log(issued);
   
    if(parseInt(value) > parseInt(issued))
    {
        alert('Return Quantity cant be more than Issued Quantity');
        document.getElementById('ReturnQuantity_'+retquantity).value="";
        document.getElementById('ReturnQuantity_'+retquantity).focus=true;
    } 
    if(parseInt(value) == 0 || parseInt(value) == "" )
    {
        alert('Invalid choise');
        document.getElementById('ReturnQuantity_'+retquantity).value="";
        document.getElementById('ReturnQuantity_'+retquantity).focus=true;
    }

}

function checkqty(selectid){


var id= selectid.split("_")[1];




var acceptqty=parseFloat(document.getElementById("EmpName_" + id).value);



var actualqty=document.getElementById("Water_"+ id).value;


var reject=document.getElementById("Amount_" + id).value;


var rejected=actualqty-acceptqty;

var pqty=parseFloat(document.getElementById("Quantity_" + id).value);

// var actualqty=selectid.split("_")[1];



 if(actualqty>pqty){
      document.getElementById("Water_" + id).value="";
      document.getElementById("Water_" + id).focus();
      
      alert("Actual Quantity should not be greater than PO Quantity");
  }

  if(actualqty<=pqty){

        document.getElementById("Water_" + id).value=actualqty;
        
    if(acceptqty>actualqty){
      document.getElementById("EmpName_" + id).value='';
       document.getElementById("Amount_" + id).value='';
      document.getElementById("EmpName_" + id).focus();
      
      alert("Accepted Quantity should not be greater than Actual Quantity");
  }

  else if(acceptqty<=actualqty){

         document.getElementById("Amount_" + id).value=actualqty-acceptqty;
      }
      
      
  }
  else{
      document.getElementById("Water_" + id).focus();
  }
}

function productvalue(val)
{

var dataa = val.trim();
// console.log(dataa);

    if(dataa== 0 || dataa == " " )
    {
        // document.getElementById('Rat_1').value = ' ';
        // document.getElementById('Water_1').value = ' ';
        document.getElementById('Rat_1').readOnly = true ;
        document.getElementById('Water_1').readOnly = true ;
    }

    if(dataa != 0 || dataa != '')
    {
        document.getElementById('Rat_1').readOnly = false ;
        document.getElementById('Water_1').readOnly = false ;
    }

}
function getdeliverychallandetails(basePath, ID){
   
    var dcid = ID; 

    $.post(basePath + "/lib/ajax/get_deliverychallan_details.php", {'dcid': dcid}, function (data) {
        
  
    
    
        document.getElementById('DeliveryDate').value=data[0]['DeliveryDate'];
        //document.getElementById('rawtype').value=data[0]['RawMaterialType'];
        
        if(data[0]['TaxChoice']=='CGST_SGST'){
        document.getElementById('CGST_SGST').checked=true;
        }
        else{
             document.getElementById('IGST').checked=true;
        }
        //document.getElementById('IGST').checked=data[0]['TaxChoice'];
        document.getElementById('DeliveryChoice').checked=data[0]['DeliveryChoice'];
       
        document.getElementById('customername').value=data[0]['FirstName'];
         document.getElementById('Remarks').value=data[0]['Remarks'];
        document.getElementById('subtotal').innerHTML =data[0]['BillAmount'];
        document.getElementById('CGSTTax').value=data[0]['CGSTTax'];
        document.getElementById('CGSTAmount').value=data[0]['CGSTAmount'];
        document.getElementById('SGSTTax').value=data[0]['SGSTTax'];
        document.getElementById('SGSTTax').value=data[0]['SGSTTax'];
        document.getElementById('SGSTAmount').value=data[0]['SGSTAmount'];
        document.getElementById('IGSTTax').value=data[0]['IGSTTax'];
        document.getElementById('IGSTAmount').value=data[0]['IGSTAmount'];
        document.getElementById('Total').innerHTML =data[0]['NetAmount'];
      
        
        $('#showData').empty();
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
  
  
       
 var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               
                if (key=='Material Type' || key=='Material Name' || key =='HSN' || key=='Unit' || key=='Quantity' ||  key=='Rate' || key=='Amount'){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
                }
            }
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
         //table.setAttribute('id', 'showData1');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json");  
}

function sopproductid(pid){
 
  
$.post(basePath + "/lib/ajax/get_sopproductid.php", {'pid': pid}, function (data) {    

var partnameid=document.getElementById('pdtid').value;

var soppdtid = data[0]['product_ID'];


if(data!='' && partnameid==soppdtid){
   alert('This partname already in sop');   
   
   $("#pdtid").val("");
   $("#pdtid").select2().select2("val", "", "placeholder", "--select--");
    $("#outputpermin").val("");
   
}

  
    }, "json");  
}

function confirm(){
   
    var batchno = document.getElementById('workorder_ID').value;  
    var matissueno = document.getElementById('MaterialIssueNo').value;
    var rawid=$('[id^=ItemNo_]').val();
    var returnqty=$('[id^=ReturnQuantity_]').val();
   
           // $('[id^=ItemName_]').empty();
        // $('[id^=ItemName_]').prepend('<option value=""  >Select</option>');
        // $.each(data, function() {
        //     $('[id^=ItemName_]').append($('<option ></option>').val(this.ID).text(this.ItemName));
        //   });document.getElementById('ReturnQuantity_1').value;
        
            if(batchno!='' && matissueno !='' && rawid!=='' && returnqty!=='')
           
            {
                
                
                alert("Are you sure you want to return item to stock?");
                
            }
      
            
    
}

function getCountnew(type=null) {
    if(type=='noclone'){
       
    var counting  = $('#showData tr:last').find("td:first").find("input").attr('id');
     var result = counting.split("_")[1];
    }else{
    
    var counting  = $('#invoice_listing_table tr').length;
    var result = counting;

    }
    
   // console.log(result);
    $('#maxCount').val(result);
}

function numbervalidation(evt,id){
    try{
        var charCode = (evt.which) ? evt.which : event.keyCode;
  
        if(charCode==46){
            var txt=document.getElementById(id).value;
            if(!(txt.indexOf(".") > -1)){
	
                return true;
            }
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57) )
            return false;

        return true;
	}catch(w){
		alert(w);
	}
}
function SqlbasedjoinSelect(columnvalue,selectid,firsttable,secondtable,selectcolumn,joincolumn,wheretable)
{
    
    $.post(basePath + "/lib/ajax/sqlbasedjoinselect.php", {'ColumnValue': columnvalue,'firsttable':firsttable,'secondtable':secondtable,'selectcolumn':selectcolumn,'selectid':joincolumn,'wheretable':wheretable}, function (data) {
        
    $('#'+selectid).empty();
    $('#'+selectid).select2("val", "");
    $("#"+selectid).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        
        $('#'+selectid).append($('<option></option>').val(this['ID']).text(this[selectcolumn]))
    });
   
 }, "json");   
    
}

function SqlbasedSelectdetail(columnvalue,idd,selectid,firsttable,secondtable,selectcolumn,joincolumn,wheretable)
{

 var splittedid=idd.split("_")[1];

 $.post(basePath + "/lib/ajax/sqlbasedjoinselectdetail.php", {'ColumnValue': columnvalue,'firsttable':firsttable,'secondtable':secondtable,'selectcolumn':selectcolumn,'selectid':joincolumn,'wheretable':wheretable}, function (data) {
   
     ($('#'+selectid +splittedid).empty());
     $('#'+selectid +splittedid).prepend('<option value="" disabled selected style="display:none;">Select</option>');
     $.each(data, function() {
       
        $('#'+selectid +splittedid).append($('<option></option>').val(this['ID']).text(this[selectcolumn]).attr('selected', true))
       
    });
   
 }, "json");   
    
}
function Multi_sqlbasedjoinselect(columnvalue,selectid,firsttable,secondtable,selectcolumn,joincolumn1,joincolumn2,wheretable)
{
    
    $.post(basePath + "/lib/ajax/multi_sqlbasedjoinselect.php", {'ColumnValue': columnvalue,'firsttable':firsttable,'secondtable':secondtable,'selectcolumn':selectcolumn,'selectid':joincolumn1,'joinid':joincolumn2,'wheretable':wheretable}, function (data) {
    $(selectid).empty();
    $(selectid).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        
        $(selectid).append($('<option></option>').val(this['ID']).text(this[selectcolumn]))
    });
   
 }, "json");   
    
}

function specialcharacters_restriction(id){              /////validation
    $('#'+id).keypress(function (e) {
        var regex = new RegExp("^[0-9a-zA-Z\]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    
  });
}

function checksameaddress(id) {

    if(document.getElementById(id).checked==true){
    document.getElementById('Address_type').value='same';    
    document.getElementById('PermntAddress1').value = document.getElementById('BillingAddress1').value;
    document.getElementById('PermntAddress2').value = document.getElementById('BillingAddress2').value;
    document.getElementById('PermntCity').value = document.getElementById('BillingCity').value;
    document.getElementById('PermntState_ID').value = document.getElementById('BillingState_ID').value;
    document.getElementById('PermntCountry_ID').value = document.getElementById('BillingCountry_ID').value;
    document.getElementById('PermntZip').value = document.getElementById('BillingZip').value;
    }else{
        document.getElementById(id).value='notsame';    
        $("#PermntAddress1").val();
        $("#PermntAddress2").val();
        $("#PermntCity").val();
        //$("#PermntState_ID").val();
        //$("#PermntCountry_ID").val();
        $("#PermntState_ID option:selected").text()!='Select'?$("#PermntState_ID option:selected").text():$("#PermntState_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
        $("#PermntCountry_ID option:selected").text()!='Select'?$("#PermntCountry_ID option:selected").text():$("#PermntCountry_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
        $("#PermntZip").val();
    }
}

function validateField(idd,fildfrmt){
        if(fildfrmt=='number'){
             var fieldVal= $('#'+idd).val();
             var phtext =  $('#'+idd).attr('placeholder');
             if(fieldVal==''){
             return true;
             }
             var isNumeric=fieldVal.match(/^[0-9]+\.?[0-9]*$/);
            if(isNumeric){
                return true;
            }else{
                alert("Please enter "+phtext+" in numbers only");
                $('#'+idd).val('');
                 $('#'+idd).focus(); 
                return false;
            } 
        }else if(fildfrmt=='confpwd'){
            var password = $('#'+idd).val();
            var confirmPassword = $('#re_'+idd).val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    }
    
function onlynumbers(evt){
    var charCode=(evt.which) ? evt.which:event.keyCode;
    if(charCode<48 || charCode>57){
        alert("Enter only numbers");
        return false;
       }
       else{
           return true;
       }
}

function customer_agianst_data(columnvalue)
{
    
    $.post(basePath + "/lib/ajax/customer_agianst.php", {'ColumnValue': columnvalue}, function (data) {
    
    $('#companyname').val('');
    $('#BillingAddress1').val('');
    $('#BillingAddress2').val('');
    $('#BillingCity').val('');
    $('#BillingState_ID').empty();
    $('#BillingCountry_ID').empty();
    $('#BillingZip').val('');
    $('#MobileNo').val('');
    $('#Email').val('');
    document.getElementById("Address_type").checked=false;
    //console.log(document.getElementById("Address_type").checked);
    //console.log(data.length);
    //$('#'+selectid).empty();
   // $('#'+selectid).select2("val", "");
   // $("#"+selectid).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    // $("#BillingState_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
    // $("#BillingCountry_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
    if(data){
    $.each(data, function() {
         $('#companyname').val(this['companyname']).prop({"readonly":true,"required":false}); 
         $('#BillingAddress1').val(this['address1']).prop({"readonly":true,"required":false});
         $('#BillingAddress2').val(this['address2']).prop({"readonly":true,"required":false});
         $('#BillingCity').val(this['city']).prop({"readonly":true,"required":false});
         $('#BillingState_ID').attr({"readonly":true,"required":false}).append($('<option></option>').val(this['state_id']).text(this['state']));
         $('#BillingCountry_ID').attr({"readonly":true,"required":false}).append($('<option></option>').val(this['country_id']).text(this['country']));
         $('#BillingZip').val(this['zip']).prop({"readonly":true,"required":false});
         $('#MobileNo').val(this['mobno']).prop({"readonly":true,"required":false});
         $('#Email').val(this['Email']).prop({"readonly":true,"required":false});
         if(this['type']=='same'){
             document.getElementById("Address_type").checked=true;
             $('#Address_type').prop("disabled", true);
         }
         $('#customer_ID').val(this['ID']);
    });
    }else{
    // $("#BillingState_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
    // $("#BillingCountry_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
     get_state('','BillingState_ID');  
     get_country('','BillingCountry_ID'); 
     $('#customer_ID').val('0');
     $('#companyname').prop({"readonly":false,"required":true}); 
     $('#BillingAddress1').prop({"readonly":false,"required":true}); 
     $('#BillingAddress2').prop({"readonly":false,"required":true}); 
     $('#BillingCity').prop({"readonly":false,"required":true}); 
     $('#BillingState_ID').attr({"readonly":false,"required":true}).append($('<option></option>').val(this['state_id']).text(this['state']));
     $('#BillingCountry_ID').attr({"readonly":false,"required":true}).append($('<option></option>').val(this['country_id']).text(this['country']));
     $('#BillingZip').val(this['zip']).prop({"readonly":false,"required":true}); 
     $('#MobileNo').val(this['mobno']).prop({"readonly":false,"required":true}); 
     $('#Email').val(this['Email']).prop({"readonly":false,"required":true}); 
     $('#Address_type').prop("disabled", false);
}
   
 }, "json");   
    
}

function get_state(StateVal,IdToReflect){  /// populating state id and name 
   
     $.post(basePath + "/lib/ajax/get_state.php", {'StateVal': StateVal}, function (data) {
     
    $('#'+IdToReflect).empty();
    $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+IdToReflect).append($('<option></option>').val(this.ID).text(this.StateName))
    });
   
     });
}

function get_country(CountryVal,IdToReflect){  /// populating country id and name 
   
     $.post(basePath + "/lib/ajax/get_country.php", {'CountryVal': CountryVal}, function (data) {
     
    $('#'+IdToReflect).empty();
    $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#'+IdToReflect).append($('<option></option>').val(this.ID).text(this.CountryName))
    });
   
     });
}

function hideblock(e) { 
   var type = $('#EnquiryType :selected').val();
    if (type =="1") {       
        document.getElementById("enquiryblock").style.display='block'; 
        $('#CostRequired').prop({"required":true});
        $('#EnquiryStatus').prop({"required":true});
        $('#OrderReceived').prop({"required":true});
        $('[id^=ItemName_]').prop({"required":true}); 
        $('[id^=Quantity_]').prop({"required":true}); 
        $('[id^=unit_]').prop({"required":true}); 
    }else {    
        document.getElementById("enquiryblock").style.display='none'; 
        $('#CostRequired').prop({"required":false});
        $('#EnquiryStatus').prop({"required":false});
        $('#OrderReceived').prop({"required":false});
        $('[id^=ItemName_]').prop({"required":false}); 
        $('[id^=Quantity_]').prop({"required":false}); 
        $('[id^=unit_]').prop({"required":false}); 
    }
    //console.log(strUser);
}

function enquiry_agianst_data(columnvalue)
{
    
    $.post(basePath + "/lib/ajax/enquiry_agianst.php", {'ColumnValue': columnvalue}, function (data) {
    
    $('#companyname').val('');
    $('#BillingAddress1').val('');
    $('#BillingAddress2').val('');
    $('#BillingCity').val('');
    $('#BillingState_ID').empty();
    $('#BillingCountry_ID').empty();
    $('#BillingZip').val('');
    $('#MobileNo').val('');
    $('#Email').val('');
    $('#employee_name').val('');
    $('#pdn_dept').val('');
    $('#contactperson').val('');
    
    document.getElementById("Address_type").checked=false;

    if(data.length>0){
    $.each(data, function() {
         $('#companyname').val(this['companyname']); 
         $('#BillingAddress1').val(this['address1']);
         $('#BillingAddress2').val(this['address2']);
         $('#BillingCity').val(this['city']);
         $('#BillingState').val(this['state']);
         $('#BillingCountry').val(this['country']);
         $('#BillingZip').val(this['zip']);
         $('#MobileNo').val(this['mobno']);
         $('#Email').val(this['Email']);
         if(this['type']=='same'){
             document.getElementById("Address_type").checked=true;
             $('#Address_type').prop("disabled", true);
         }
         $('#employee_name').val(this['EmpName']);
         $('#pdn_dept').val(this['pdndept']);
         $('#contactperson').val(this['contact_person']);
    });
    }else{
    alert(data.message); 
    $('#enquiry_ID').select2().select2("val", "", "placeholder", "Select");
    $('#companyname').val('');
    $('#BillingAddress1').val('');
    $('#BillingAddress2').val('');
    $('#BillingCity').val('');
    $('#BillingState_ID').empty();
    $('#BillingCountry_ID').empty();
    $('#BillingZip').val('');
    $('#MobileNo').val('');
    $('#Email').val('');
    $('#employee_name').val('');
    $('#pdn_dept').val('');
    $('#contactperson').val('');
    
    document.getElementById("Address_type").checked=false;
    }
   
 }, "json");   
    
}

function mandatory_add(value,conditionval,IdToReflect){  /// apply required in some condition to particular id attribute
   
    if(value==conditionval){ 
        $('#'+IdToReflect).prop({"required":true}); 
    }else{
        $('#'+IdToReflect).prop({"required":false}); 
    }
}

function add_disabled(value,conditionval,IdToReflect){  /// apply disabled in some condition to particular id attribute
   
    if(value==conditionval){ 
        $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
        $('#'+IdToReflect).prop({"disabled":true}); 
    }else{
        $('#'+IdToReflect).prop({"disabled":false}); 
    }
} 

function add_or_remove_option(fromvalue,conditionval,setkey,setval,IdToReflect) { /// set options to particular id attribute in some condition  
       
    if(fromvalue==conditionval){  
    $('#'+IdToReflect).append('<option value='+setkey+'>'+setval+'</option>');
    }else{
        $('#'+IdToReflect+' option[value='+setkey+']').remove(); 
    }
        
}

function removeuploadedfile(attachedid,table_name){ /// for removing uploaded file in a table
    
    $.post(basePath+"/lib/ajax/removeuploadedfile.php",{'columnid': attachedid,'tablename': table_name},function(data) {
         
        alert(data.message);
        
    });
} 

function getalreadyexist(basepath,columnname,elementval,tablename,formval,fieldname){ /// for checking data already exsist or not
             $.post(basepath + "/lib/ajax/already_exist.php", {'elementval': elementval,'columnname':columnname,'tablename':tablename,'formval':formval}, function (data) {
                console.log(data);
         
                    if(data>0){
                        $('#'+fieldname).val('');
                        $('#'+fieldname).select2().select2("val", "", "placeholder", "Select");
                        $('#'+columnname).focus();
                                alert('This '+fieldname +' Already Exists');
                                
                       }
                        }, "json"); 
    }
/////////////////////////////////////////////////////////////////////added on 26-12-2022 /////
function Fetch_duplicate_SupplierName_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
	var SupplierType =$('#SupplierType').val()
   $.post(basePath + "/lib/ajax/duplicate_supplier.php", {'ColumnValue': columnvalue,'Supplier_type': SupplierType,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Supplier Name');
					 $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_supplier_evaluation_Data(columnvalue,tablename1,selectcolumn1,selectcolumn2,selectcolumn3,field_id1,field_id2,field_id3)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
	$('#'+field_id3).val('');
	
    $.post(basePath + "/lib/ajax/supplier_evaluation.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2,'selectcolumn3':selectcolumn3}, function (data) {
	
		if(data.length){
			$.each(data, function(key, value) {
				$('#'+field_id1).val(this.ContactPerson);
				$('#'+field_id2).val(this.ContactNumber);
				$('#'+field_id3).val(this.AddressLine1);	 
				
			});
		}
	
 }, "json");   
    
}
/////////////////////////////////////////////////////////////////////////////////////////////

function addRows(editcount,tablebody_id,tbl_row_id,tbl_row_splitid,countsetid,remid,remsplit_id) {
    
     var count =$('#'+tablebody_id+' tr').length;
        
     count++;
 
    var x = $('#'+tbl_row_id).clone().attr({id: tbl_row_splitid + count});
   
    x.find('#field1_1').val('');
    if ($('#field1_1').length) {
        x.find('#field1_1').attr({id: "field1_" + count, name: "field1_" + count});
    }
    x.find('#field2_1').val('');
    if ($('#field2_1').length) {
        x.find('#field2_1').attr({id: "field2_" + count, name: "field2_" + count});
    } 
    x.find('#field3_1').val('');
    if ($('#field3_1').length) {
        x.find('#field3_1').attr({id: "field3_" + count, name: "field3_" + count});
    } 
    x.find('#field4_1').val('');
    if ($('#field4_1').length) {
        x.find('#field4_1').attr({id: "field4_" + count, name: "field4_" + count});
    } 
    x.find('#field5_1').val('');
    if ($('#field5_1').length) {
        x.find('#field5_1').attr({id: "field5_" + count, name: "field5_" + count});
    } 
    
    x.find('#field6_1').val('');
    if ($('#field6_1').length) {
        x.find('#field6_1').attr({id: "field6_" + count, name: "field6_" + count});
    } 
    
    x.find('#field7_1').val('');
    if ($('#field7_1').length) {
        x.find('#field7_1').attr({id: "field7_" + count, name: "field7_" + count});
    } 
    
    x.find('#field8_1').val('');
    if ($('#field8_1').length) {
        x.find('#field8_1').attr({id: "field8_" + count, name: "field8_" + count});
    } 

    x.find('#field9_1').val('');
    if ($('#field9_1').length) {
        x.find('#field9_1').attr({id: "field9_" + count, name: "field9_" + count});
    } 

    
    x.find('#field10_1').val('');
    if ($('#field10_1').length) {
        x.find('#field10_1').attr({id: "field10_" + count, name: "field10_" + count});
    } 
    
     x.find('#field11_1').val('');
    if ($('#field11_1').length) {
        x.find('#field11_1').attr({id: "field11_" + count, name: "field11_" + count});
    } 
     x.find('#field12_1').val('');
    if ($('#field12_1').length) {
        x.find('#field12_1').attr({id: "field12_" + count, name: "field12_" + count});
    } 
    
     x.find('#field13_1').val('');
    if ($('#field13_1').length) {
        x.find('#field13_1').attr({id: "field13_" + count, name: "field13_" + count});
    } 
   

    x.find('#'+remid).attr({id: remsplit_id + count, name: remsplit_id + count, onclick: "$('#" + tbl_row_splitid + count + "').remove();"});

    x.appendTo('#'+tablebody_id);
    
//      $('#Rate_'+ count).datetimepicker();
     
//       $('#Rate_'+ count).datetimepicker().on('dp.show', function() {   
//   $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
// }).on('dp.hide', function() {
//   $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
// });

     $('#'+countsetid).val(count);
    // count++;
}
function copytext(elementid){
     copyToClipboard(document.getElementById(elementid));
}
// document.getElementById("copyButton").addEventListener("click", function() {
//     copyToClipboard(document.getElementById("copyTarget"));
// });
function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }

         target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        elem.select(); // added by me
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

function hideupload() {
   var file = $('#files1').length;
   if(document.getElementById("uploaded_block")){
        if (file>0) {       
      
        document.getElementById("uploaded_block").style.display='block';
      
    }
   else {    
       document.getElementById("uploaded_block").style.display='none';
    }
   }
}
function show_or_hide_option(fromvalue,conditionval,div_id,field_id,) { /// show_or_hide_option to particular id attribute in some condition  
       
    if(fromvalue==conditionval){  
     document.getElementById(div_id).style.display='block';
    }else{
    document.getElementById(div_id).style.display='none';
    document.getElementById(field_id).value='';
    }
        
}

function customer_agianst_enquiry(columnvalue)
{
    
    $.post(basePath + "/lib/ajax/custom_enquiry_agianst.php", {'ColumnValue': columnvalue}, function (data) {
    
    $('#TenderNo').val('');
    $('#BillingAddress1').val('');
    $('#BillingAddress2').val('');
    $('#BillingCity').val('');
    $('#BillingState').val('');
    $('#BillingZip').val('');
    $('#DeliveryAddress1').val('');
    $('#DeliveryAddress2').val('');
    $('#DeliveryCity').val('');
    $('#DeliveryState').empty();
    $('#DeliveryZip').empty();
    $('#MobileNo').val('');
    $('#pdn_dept').val('');
    $('#contactperson').val('');
    
   // document.getElementById("Address_type").checked=false;

    if(data.length>0){
    $.each(data, function() {
         console.log(this['TenderNo']);
         $('#BillingAddress1').val(this['address1']);
         $('#BillingAddress2').val(this['address2']);
         $('#BillingCity').val(this['city']);
         $('#BillingState').val(this['state']);
         $('#BillingZip').val(this['zip']);
         $('#DeliveryAddress1').val(this['permentddress1']);
         $('#DeliveryAddress2').val(this['permentaddress2']);
         $('#DeliveryCity').val(this['permentcity']);
         ((this['permentstate'])!=0)?$('#DeliveryState').val(this['permentstate']):$('#DeliveryState').val('');
         ((this['PermntZip'])!=0)?$('#DeliveryZip').val(this['PermntZip']):$('#DeliveryZip').val('');
         $('#MobileNo').val(this['mobno']);
         $('#TenderNo').val(this['TenderNo']);
         $('#pdn_dept').val(this['pdndept']);
         $('#contactperson').val(this['contact_person']);
    });
    }else{
    alert(data.message); 
    $('#enquiry_ID').select2().select2("val", "", "placeholder", "Select");
    $('#TenderNo').val('');
    $('#BillingAddress1').val('');
    $('#BillingAddress2').val('');
    $('#BillingCity').val('');
    $('#BillingState').val('');
    $('#BillingZip').val('');
    $('#DeliveryAddress1').val('');
    $('#DeliveryAddress2').val('');
    $('#DeliveryCity').val('');
    $('#DeliveryState').val('');
    $('#DeliveryZip').val('');
    $('#MobileNo').val('');
    $('#pdn_dept').val('');
    $('#contactperson').val('');
    }
   
 }, "json");   
    
}

function select_tax()
{
       var CGST_SGST = document.getElementById('CGST_SGST').checked;
       var IGST = document.getElementById('IGST').checked;
       var gst= document.getElementById('GSTTax').value;
   if(IGST == true || CGST_SGST==true ){
        if(IGST == true)
   {
    document.getElementById('CGSTTax').readOnly = true ;
    document.getElementById('SGSTTax').readOnly = true ;
    document.getElementById('CGSTTax').value =0;
    document.getElementById('SGSTTax').value =0;
    document.getElementById('CGSTAmount').value =0;
    document.getElementById('SGSTAmount').value =0;

   }
   else{
  document.getElementById('CGSTTax').readOnly = true ;
   // document.getElementById('SGSTTax').readOnly = true ;
     document.getElementById('SGSTTax').readOnly = true ;
    // document.getElementById('CGSTTax').value =9; 
    // document.getElementById('SGSTTax').value =9;
	 document.getElementById('CGSTTax').value =(gst/2); 
    document.getElementById('SGSTTax').value =(gst/2);
   }
   
   if(CGST_SGST==true)
   {
    document.getElementById('IGSTTax').readOnly = true ;
    document.getElementById('IGSTTax').value =0;
    document.getElementById('IGSTAmount').value =0;


   }
   else{
    // document.getElementById('IGSTTax').readOnly = false ;
    // document.getElementById('IGSTTax').value =18;
     document.getElementById('IGSTTax').readOnly = true;
    document.getElementById('IGSTTax').value =gst;
   }
   }else{
       alert('Please select CGST&SGST or IGST');
       document.getElementById('GSTTax').value='';
   }
  
  
 
}

function tax_amount_calc() {
	
	var CgstTax = document.getElementById('CGSTTax').value ;
    var SgstTax = document.getElementById('SGSTTax').value ; 

	
	   if(CgstTax != SgstTax )
   {
		document.getElementById('SGSTTax').readOnly = true ;
		
		 var SgstTax = document.getElementById('CGSTTax').value ;
		 document.getElementById('SGSTTax').value= SgstTax ;
		
   }
   
    var subtotal = 0;
    if( $("#invoice_listing_table  tr").length=='1'){
     var countingz  = $("#invoice_listing_table  tr").attr("id");    
     }else{
     var countingz  = $("#invoice_listing_table  tr:last").attr("id");
     }
     var result = countingz.split("_")[3];

    for (i = 1; i <= result; i++) {
        if ($('#Amount_' + i).length) {
            subtotal += parseFloat($('#Amount_' + i).val());
        }
    }  
   // document.getElementById("BillAmount").value=subtotal;
    $('#subtotal').html(subtotal);
    $('#BillAmount').val(subtotal.toFixed(2));
   
    var CGSTTax = parseFloat($('#CGSTTax').val());
    var tax_amount = ((subtotal * CGSTTax) / 100);
     
    // $('#GSTAmount').html(tax_amount.toFixed(2));
      
    // $('#CGSTTax').html(tax_amount.toFixed(2));

   
    var SGSTTax = parseFloat($('#SGSTTax').val());
    var tax_amount1 = ((subtotal * SGSTTax) / 100);
     
   // $('#SGSTAmount').html(tax_amount1.toFixed(2));
      
    //$('#SGSTTax').html(tax_amount1.toFixed(2));

    var IGSTTax = parseFloat($('#IGSTTax').val());
    var tax_amount2 = ((subtotal * IGSTTax) / 100);
     
   // $('#IGSTAmount').html(tax_amount2.toFixed(2));
      
   // $('#IGSTTax').html(tax_amount2.toFixed(2));

    
    
    var NetAmount =(subtotal + tax_amount + tax_amount1 + tax_amount2);
    
    // count= $('#maxCount').val();
    // for (i = 1; i < count; i++) {
    //     if ($('#Amount_' + i).length) {
    //         subTotal += parseFloat($('#Amount_' + i).val());
    //     }
    // }

     
    $('#SGSTAmount').val(tax_amount1.toFixed(2));  
    $('#IGSTAmount').val(tax_amount2.toFixed(2));
    $('#CGSTAmount').val(tax_amount.toFixed(2));
    
    $('#Total').html(NetAmount.toFixed(2));
    $('#NetAmount').val(NetAmount.toFixed(2));
    $('#maxCount').val(result);


}

function tax_calc1()
{
	  var GSTTax = parseFloat($('#GSTTax').val());
	 if(!GSTTax)
	 {
		  $('#IGSTTax').val(0);  
	 }
}

////////////////////////////////////////////////////////////////////////

function production_agianst_enquiry(columnvalue)
{
  
    $.post(basePath + "/lib/ajax/pdnorder_enquiry_agianst.php", {'ColumnValue': columnvalue}, function (data) {
    
    $('#cust_order_no').val('');
    $('#pdn_dept').val('');
    $('#cust_pono').val('');
    $('#Drawing_Path').val('');
    $('#Packing_Instn').val('');
    $('#Thirdparty_Inspn').val('');
    if(data==undefined){
    getscheduledata('');  
    getcustorderdetdata('');
    }else{
    if(data.length>0){
    getscheduledata(columnvalue);  
    getcustorderdetdata(columnvalue);
    $.each(data, function() {
         $('#cust_order_no').val(this['CustOrderNo']);
         $('#pdn_dept').val(this['pdndept']);
        // $('#cust_pono').val('');
         $('#Drawing_Path').val(this['Drawing_Path']);
         $('#Packing_Instn').val(this['Packing_Instn']);
         $('#Thirdparty_Inspn').val(this['Thirdparty_Inspn']);

    });
     
    var result = data.map(function(val) {  ////////// for showing value as comma seperated
                 return val.PurchaseorderNo;
    }).join(',');
        
    $('#cust_pono').val(result);
    
    }else{
    alert(data.message);
    getscheduledata('');  
    getcustorderdetdata('');
    $('#enquiry_ID').select2().select2("val", "", "placeholder", "Select");
    $('#cust_order_no').val('');
    $('#pdn_dept').val('');
    $('#cust_pono').val('');
    $('#Drawing_Path').val('');
    $('#Packing_Instn').val('');
    $('#Thirdparty_Inspn').val('');
    
    }
    }
 }, "json");   
    
}

function getscheduledata(columnvalue){  /// getting schedule data agianst enquiry
    
    $('#ScheduleData').empty();
  
    $.post(basePath + "/lib/ajax/enquiry_agianst_schedule.php", {'ColumnValue': columnvalue}, function (data) {
      
     if(data.length>0){
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               if (key=='Quantity' || key=='Start Date' || key =='End Date' ){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                
                }
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("ScheduleData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);
     }

    }, "json");  
}

function getcustorderdetdata(columnvalue){  /// getting customerorder product detail data agianst enquiry
    
    $('#CustorderdetData').empty();
  
    $.post(basePath + "/lib/ajax/enquiry_agianst_custorderdet.php", {'ColumnValue': columnvalue}, function (data) {
      
    if(data.length>0){
        
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < data.length; i++) {
            for (var key in data[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }


        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
        var divContainer = document.getElementById("CustorderdetData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);
    }

    }, "json");  
}
function show_imagelabel(){
        
        //console.log('cllicked');
	    $("#Description_Proof").css("color", "black");
		$("#FileUpload").css("color", "black");
	
}
function Fetch_tender_evaluation_Data(columnvalue,tablename1,tablename2,selectcolumn1,selectcolumn2,selectcolumn3,selectcolumn4,selectcolumn5,selectcolumn6,field_id1,field_id2,field_id3,field_id4,field_id5,field_id6)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
	
    $.post(basePath + "/lib/ajax/tender_evaluation.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2,'tablename2':tablename2,'selectcolumn2':selectcolumn2,'selectcolumn3':selectcolumn3,'selectcolumn4':selectcolumn4,'selectcolumn5':selectcolumn5,'selectcolumn6':selectcolumn6}, function (data) {
	   $("#tenderdetail tbody").empty();
		if(data.length){
			$.each(data, function(key, value) {
			   var count=0;
				if(count >= 0 ){
					$('#'+field_id1).val(this.TenderNo);
				    $('#'+field_id2).val(this.ClosingDateTime);
					
					var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12">  <input class="form-control" type="text" id="Title'+count+'" name="Title'+count+'" value="'+this.Title+'" readonly=""> </div></div></td> ';
newRowContent += '  <td>   <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="PLCod'+count+'" name="PLCod'+count+'" value="'+this.PLCod+'" readonly=""> </div>   </div>   </td>';
newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Description'+count+'" name="Description'+count+'" value="'+this.Description+'" readonly=""> </div> </div> </td>'; 
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Qty'+count+'" name="Qty'+count+'" value="'+this.Qty+'" readonly=""> </div>  </div> </td> </tr>';
                     //console.log('hi',newRowContent);
					$("#tenderdetail tbody").append(newRowContent);
				}
count++				
			});
		}
	
 }, "json");   
    
}
function getRowCount() {
    var counting  = $('#invoice_listing_table tr:last').attr('id');
    var result = counting.split("_")[3];
    //console.log(result);
    $('#maxCount').val(result);
}


// program to validate an email address

function validateEmail(email_id,field_id) {
    const regex_pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    if(email_id!=''){
        if (regex_pattern.test(email_id)) {
        return true;
    }
    else {
       alert('The email address is not valid');
       $('#'+field_id).val('');
       return false;
    } 
    }
   
}

function valid_tendigit_number(id)    // mobile no validation
{

    var mobile = document.getElementById(id);
  
    if(mobile.value.length!=10){
       alert("please enter 10 digit mobile number!");
       $('#'+id).val('');
       return false;
    }
    
}

function Fetch_customer_complaint_Data(columnvalue,tablename1,tablename2,selectcolumn1,selectcolumn2,field_id1,field_id2)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
	
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
	
    $.post(basePath + "/lib/ajax/customer_complaint.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'tablename2':tablename2,'selectcolumn2':selectcolumn2}, function (data) {
	  $('#'+field_id2).find('option').remove()
		if(data.length){
			$('#'+field_id2).find('option').remove();
			 $('#'+field_id2).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');
			$.each(data, function(key, value) {
				$('#'+field_id1).val(this.PermntAddress1);	
         
				 $('#'+field_id2).find('option')
				.end()
				.append('<option value="'+ value.ID +'">'+ value.ProductName +'</option>');				
				
			});
		}
	
 }, "json");   
    
}

function customersubmit(thisForm){
     
var formdata = $('#' + thisForm).serialize();
$('#customer_ID').empty();     
$.post(basePath +"/lib/ajax/add_customer.php",
formdata,

function(data) {
    
 if(data.message){
     alert(data.message);
     return false;
 }
if(data){
    
    $(".modal-backdrop").remove(); 
    $('#' + thisForm)[0].reset();
    $("#myModal").hide(); 
    $('body').removeClass('modal-open');
    $('#customer_ID').trigger('change'); // to reset select2
    $('#customer_ID').prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        $('#customer_ID').append($('<option></option>').val(this.ID).text(this.CompanyName));
    });

// console.log(data);
 
}
// document.getElementById('customer_id').value=data[0]['Firstname'];
// location.reload();
},"json"
);
}

function company_agianst_customer_data(columnvalue)
{
    
    $.post(basePath + "/lib/ajax/comp_agianst_customer.php", {'ColumnValue': columnvalue}, function (data) {
    
    $('#contactperson').val('');
    $('#BillingAddress1').val('');
    $('#BillingAddress2').val('');
    $('#BillingCity').val('');
    $('#BillingState_ID').empty();
    $('#BillingCountry_ID').empty();
    $('#BillingZip').val('');
    $('#MobileNo').val('');
    $('#Email').val('');
    document.getElementById("Address_type").checked=false;
    if(data){
    $.each(data, function() {
         $('#contactperson').val(this['PersonName']); 
         $('#BillingAddress1').val(this['address1']);
         $('#BillingAddress2').val(this['address2']);
         $('#BillingCity').val(this['city']);
         $('#BillingState_ID').append($('<option></option>').val(this['state_id']).text(this['state']));
         $('#BillingCountry_ID').append($('<option></option>').val(this['country_id']).text(this['country']));
         ((this['zip'])!=0)?$('#BillingZip').val(this['zip']):$('#BillingZip').val('');
         $('#MobileNo').val(this['mobno']);
		 $('#Email').val(this['Email']);
    });
    }
   
 }, "json");   
    
}

function suppliermax()
{
	 if(isNaN(parseFloat($('#ActualRated').val()))){ ActualRated =0 }else {ActualRated =parseFloat($('#ActualRated').val()) }
	if(isNaN(parseFloat($('#ActualRated1').val()))){ ActualRated1 =0 }else {ActualRated1 =parseFloat($('#ActualRated1').val()) }
	if(isNaN(parseFloat($('#ActualRated2').val()))){ ActualRated2 =0 }else {ActualRated2 =parseFloat($('#ActualRated2').val()) }
	if(isNaN(parseFloat($('#ActualRated3').val()))){ ActualRated3 =0 }else {ActualRated3 =parseFloat($('#ActualRated3').val()) }
	if(isNaN(parseFloat($('#ActualRated4').val()))){ ActualRated4 =0 }else {ActualRated4 =parseFloat($('#ActualRated4').val()) }
	if(isNaN(parseFloat($('#ActualRated5').val()))){ ActualRated5 =0 }else {ActualRated5 =parseFloat($('#ActualRated5').val()) }
	if(isNaN(parseFloat($('#ActualRated6').val()))){ ActualRated6 =0 }else {ActualRated6 =parseFloat($('#ActualRated6').val()) }
	if(isNaN(parseFloat($('#ActualRated7').val()))){ ActualRated7 =0 }else {ActualRated7 =parseFloat($('#ActualRated7').val()) }
	if(isNaN(parseFloat($('#ActualRated8').val()))){ ActualRated8 =0 }else {ActualRated8 =parseFloat($('#ActualRated8').val()) }
	if(isNaN(parseFloat($('#ActualRated9').val()))){ ActualRated9 =0 }else {ActualRated9 =parseFloat($('#ActualRated9').val()) }
	if(isNaN(parseFloat($('#ActualRated10').val()))){ ActualRated10 =0 }else {ActualRated10 =parseFloat($('#ActualRated10').val()) }
	if(isNaN(parseFloat($('#ActualRated11').val()))){ ActualRated11 =0 }else {ActualRated11 =parseFloat($('#ActualRated11').val()) }
	if(isNaN(parseFloat($('#ActualRated12').val()))){ ActualRated12 =0 }else {ActualRated12 =parseFloat($('#ActualRated12').val()) }
	if(isNaN(parseFloat($('#ActualRated13').val()))){ ActualRated13 =0 }else {ActualRated13 =parseFloat($('#ActualRated13').val()) }
	if(isNaN(parseFloat($('#ActualRated14').val()))){ ActualRated14 =0 }else {ActualRated14 =parseFloat($('#ActualRated14').val()) }
	if(isNaN(parseFloat($('#ActualRated15').val()))){ ActualRated15 =0 }else {ActualRated15 =parseFloat($('#ActualRated15').val()) }
	if(isNaN(parseFloat($('#ActualRated16').val()))){ ActualRated16 =0 }else {ActualRated16 =parseFloat($('#ActualRated16').val()) }
	if(isNaN(parseFloat($('#ActualRated17').val()))){ ActualRated17 =0 }else {ActualRated17 =parseFloat($('#ActualRated17').val()) }
	if(isNaN(parseFloat($('#ActualRated18').val()))){ ActualRated18 =0 }else {ActualRated18 =parseFloat($('#ActualRated18').val()) }
	if(isNaN(parseFloat($('#ActualRated19').val()))){ ActualRated19 =0 }else {ActualRated19 =parseFloat($('#ActualRated19').val()) }
	if(isNaN(parseFloat($('#ActualRated20').val()))){ ActualRated20 =0 }else {ActualRated20 =parseFloat($('#ActualRated20').val()) }
	if(isNaN(parseFloat($('#ActualRated21').val()))){ ActualRated21 =0 }else {ActualRated21 =parseFloat($('#ActualRated21').val()) }
	if(isNaN(parseFloat($('#ActualRated22').val()))){ ActualRated22 =0 }else {ActualRated22 =parseFloat($('#ActualRated22').val()) }
	if(isNaN(parseFloat($('#ActualRated23').val()))){ ActualRated23 =0 }else {ActualRated23 =parseFloat($('#ActualRated23').val()) }
	if(isNaN(parseFloat($('#ActualRated24').val()))){ ActualRated24 =0 }else {ActualRated24 =parseFloat($('#ActualRated24').val()) }

	var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	           
    if(ActualRated>25){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated').val('');
		//console.log('ii');
		var Total=(ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total); 
		
	}else if(ActualRated1>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated1').val('');
		var Total=(ActualRated+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated2>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated2').val('');
		var Total=(ActualRated+ActualRated1+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated3>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated3').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated4>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated4').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated5>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated5').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated6>35){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated6').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated7>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated7').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated8>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated8').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated9>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated9').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated10>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated10').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated11>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated11').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated12>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated12').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated13>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated13').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated14>20){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated14').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated15>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated15').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated16>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated16').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated17>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated17').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated18>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated18').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated19>10){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated19').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated20>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated20').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated21>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated21').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated22>10){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated22').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated23+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated23>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated23').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated24);
		$('#ActualRated25').val(Total);   
	}else if(ActualRated24>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated24').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23);
		$('#ActualRated25').val(Total);   
	}
}

function subcontractormax()
{
	  if(isNaN(parseFloat($('#ActualRated').val()))){ ActualRated =0 }else {ActualRated =parseFloat($('#ActualRated').val()) }
	if(isNaN(parseFloat($('#ActualRated1').val()))){ ActualRated1 =0 }else {ActualRated1 =parseFloat($('#ActualRated1').val()) }
	if(isNaN(parseFloat($('#ActualRated2').val()))){ ActualRated2 =0 }else {ActualRated2 =parseFloat($('#ActualRated2').val()) }
	if(isNaN(parseFloat($('#ActualRated3').val()))){ ActualRated3 =0 }else {ActualRated3 =parseFloat($('#ActualRated3').val()) }
	if(isNaN(parseFloat($('#ActualRated4').val()))){ ActualRated4 =0 }else {ActualRated4 =parseFloat($('#ActualRated4').val()) }
	if(isNaN(parseFloat($('#ActualRated5').val()))){ ActualRated5 =0 }else {ActualRated5 =parseFloat($('#ActualRated5').val()) }
	if(isNaN(parseFloat($('#ActualRated6').val()))){ ActualRated6 =0 }else {ActualRated6 =parseFloat($('#ActualRated6').val()) }
	if(isNaN(parseFloat($('#ActualRated7').val()))){ ActualRated7 =0 }else {ActualRated7 =parseFloat($('#ActualRated7').val()) }
	if(isNaN(parseFloat($('#ActualRated8').val()))){ ActualRated8 =0 }else {ActualRated8 =parseFloat($('#ActualRated8').val()) }
	if(isNaN(parseFloat($('#ActualRated9').val()))){ ActualRated9 =0 }else {ActualRated9 =parseFloat($('#ActualRated9').val()) }
	 if(isNaN(parseFloat($('#ActualRated10').val()))){ ActualRated10 =0 }else {ActualRated10 =parseFloat($('#ActualRated10').val()) }
	if(isNaN(parseFloat($('#ActualRated11').val()))){ ActualRated11 =0 }else {ActualRated11 =parseFloat($('#ActualRated11').val()) }
	if(isNaN(parseFloat($('#ActualRated12').val()))){ ActualRated12 =0 }else {ActualRated12 =parseFloat($('#ActualRated12').val()) }
	if(isNaN(parseFloat($('#ActualRated13').val()))){ ActualRated13 =0 }else {ActualRated13 =parseFloat($('#ActualRated13').val()) }
	if(isNaN(parseFloat($('#ActualRated14').val()))){ ActualRated14 =0 }else {ActualRated14 =parseFloat($('#ActualRated14').val()) }
	if(isNaN(parseFloat($('#ActualRated15').val()))){ ActualRated15 =0 }else {ActualRated15 =parseFloat($('#ActualRated15').val()) }
	if(isNaN(parseFloat($('#ActualRated16').val()))){ ActualRated16 =0 }else {ActualRated16 =parseFloat($('#ActualRated16').val()) }
	if(isNaN(parseFloat($('#ActualRated17').val()))){ ActualRated17 =0 }else {ActualRated17 =parseFloat($('#ActualRated17').val()) }
	if(isNaN(parseFloat($('#ActualRated18').val()))){ ActualRated18 =0 }else {ActualRated18 =parseFloat($('#ActualRated18').val()) }
	if(isNaN(parseFloat($('#ActualRated19').val()))){ ActualRated19 =0 }else {ActualRated19 =parseFloat($('#ActualRated19').val()) }
	if(isNaN(parseFloat($('#ActualRated20').val()))){ ActualRated20 =0 }else {ActualRated20 =parseFloat($('#ActualRated20').val()) }
	if(isNaN(parseFloat($('#ActualRated21').val()))){ ActualRated21 =0 }else {ActualRated21 =parseFloat($('#ActualRated21').val()) }
	
	var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	           
    if(ActualRated>25){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated').val('');
		var Total=(ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total); 
	}else if(ActualRated1>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated1').val('');
		var Total=(ActualRated+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated2>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated2').val('');
		var Total=(ActualRated+ActualRated1+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated3>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated3').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated4>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated4').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated5>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated5').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21+ActualRated22+ActualRated23+ActualRated24);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated6>35){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated6').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated7>10){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated7').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated8>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated8').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated9>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated9').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated10>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated10').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated11>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated11').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated12>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated12').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated13>20){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated13').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated14>10){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated14').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated15>10){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated15').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated16>10){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated16').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated17+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated17>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated17').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated18+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated18>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated18').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated19+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated19>10){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated19').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated20
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated20>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated20').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19
			   +ActualRated21);
		$('#ActualRated22').val(Total);   
	}else if(ActualRated21>5){
		alert('ActualRated is greater than maxpoint');
		$('#ActualRated21').val('');
		var Total=(ActualRated+ActualRated1+ActualRated2+ActualRated3+ActualRated4+ActualRated5+ActualRated6+ActualRated7+ActualRated8+ActualRated9+ActualRated10
	           +ActualRated11+ActualRated12+ActualRated13+ActualRated14+ActualRated15+ActualRated16+ActualRated17+ActualRated18+ActualRated19+ActualRated20);
		$('#ActualRated22').val(Total);   
	}
}

//to hide past date
$(function () {
     $('.dp').datetimepicker({  
         minDate:new Date()
      });
 });
 
 // cgst and igst calculation 
	
var x=document.querySelector("#cgst");
 x.addEventListener("click", function(){
	 var gst=0;
	var total = document.querySelector("#gTotal").value;
	gst =  parseFloat(document.querySelector("#GST").value);
	//console.log('gst',gst);
	Advance =  parseFloat(document.querySelector("#Advance").value);
//	console.log('try');
	if(gst == 0)
	{
		alert("Please Enter The Gst");
	}else if((isNaN(gst)) && (isNaN(Advance)))
	{
		$('#CGST').val(0);
		$('#CGSTtotal').val(0.00);
		$('#IGST').val(0);
		$('#IGSTtotal').val(0.00);
		$('#SGST').val(0);
		$('#SGSTtotal').val(0.00);
		$('#SGSTtotal').val(0.00);
		$('#Balance').val(total);
	}else if((isNaN(gst)) && (Advance))
	{
		$('#CGST').val(0);
		$('#CGSTtotal').val(0.00);
		$('#IGST').val(0);
		$('#IGSTtotal').val(0.00);
		$('#SGST').val(0);
		$('#SGSTtotal').val(0.00);
		$('#SGSTtotal').val(0.00);
		total1=total-Advance;
		$('#Balance').val(total1);
	}
	else if((gst != 0) && (!Advance))
	{
		 div=gst/2;
		var y =(div * total)/100;
		var n =(gst * total)/100;
		var z = parseFloat(total) + parseFloat(n);
		//console.log("cgst",y);
	
		document.querySelector("#SGST").value=div+"%";
		document.querySelector("#CGST").value=div+"%";
		document.querySelector("#IGST").value="";
		document.querySelector("#IGSTtotal").value="";
		document.querySelector("#SGSTtotal").value=y;
		document.querySelector("#CGSTtotal").value=y;
		document.querySelector("#Balance").value=z;
		document.querySelector("#ghdtotal").value=z;
	}else if((gst != 0) && (Advance))
	{
		 div=gst/2;
		var y =(div * total)/100;
		var n =(gst * total)/100;
		var z = parseFloat(total) + parseFloat(n);
		//console.log("cgst",y);
	   var zz=((z-(Advance)).toFixed(2));
		document.querySelector("#SGST").value=div+"%";
		document.querySelector("#CGST").value=div+"%";
		document.querySelector("#IGST").value="";
		document.querySelector("#IGSTtotal").value="";
		document.querySelector("#SGSTtotal").value=y;
		document.querySelector("#CGSTtotal").value=y;
		document.querySelector("#Balance").value=zz;
		document.querySelector("#ghdtotal").value=zz;
	}
 })

function cal()
{
	
	var gst=document.querySelector("#GST").value;
	var Advance=document.querySelector("#Advance").value;

	 if((gst != "") && (Advance=="" || Advance==0.00))
	{
		
			var total = document.querySelector("#gTotal").value;
			var y=(gst*total)/100;
			var z = parseFloat(total) + parseFloat(y);
			//console.log("total",z);
		document.querySelector("#SGST").value="";
		document.querySelector("#CGST").value="";
		document.querySelector("#SGSTtotal").value="";
		document.querySelector("#CGSTtotal").value="";
		document.querySelector("#IGST").value=gst+"%";
		document.querySelector("#IGSTtotal").value=y;
		document.querySelector("#Balance").value=z;
		document.querySelector("#ghdtotal").value=z;
	}else if((gst != "") && (Advance))
	{
		var total = document.querySelector("#gTotal").value;
			var y=(gst*total)/100;
			var z = parseFloat(total) + parseFloat(y);
			var zz=((z-parseFloat(Advance)).toFixed(2));
		document.querySelector("#SGST").value="";
		document.querySelector("#CGST").value="";
		document.querySelector("#SGSTtotal").value="";
		document.querySelector("#CGSTtotal").value="";
		document.querySelector("#IGST").value=gst+"%";
		document.querySelector("#IGSTtotal").value=y;
		document.querySelector("#Balance").value=zz;
		document.querySelector("#ghdtotal").value=zz;
	}
}
	
function myFunction() {
	
	{
  var total = document.querySelector("#gTotal").value;
	var gst=document.querySelector("#GST").value;
	var Advance=document.querySelector("#Advance").value;
	var cgst=document.querySelector("#cgst").checked;
	var igst=document.querySelector("#igst").checked;
	
	 if((gst != "") && (Advance=="" || Advance==0.00) && (cgst))
	{
	  var div = gst/2;
		var y = parseFloat((div * total)/100);
		var n = (gst * total)/100 ;
		var z = parseFloat(total) + parseFloat(n);
	//	console.log("total",z);
	
		document.querySelector("#SGST").value=div+"%";
		document.querySelector("#CGST").value=div+"%";
		document.querySelector("#IGST").value="";
		document.querySelector("#IGSTtotal").value="";
		document.querySelector("#SGSTtotal").value=y;
		document.querySelector("#CGSTtotal").value=y;
		document.querySelector("#Balance").value=z;
		document.querySelector("#ghdtotal").value=z;
	}else if((gst != "") && (Advance) && (cgst))
	{
		 var div = gst/2;
		var y = parseFloat((div * total)/100);
		var n = (gst * total)/100 ;
		var z = parseFloat(total) + parseFloat(n);
		var zz=(z-parseFloat(Advance));
	//	console.log("total",z);
	
		document.querySelector("#SGST").value=div+"%";
		document.querySelector("#CGST").value=div+"%";
		document.querySelector("#IGST").value="";
		document.querySelector("#IGSTtotal").value="";
		document.querySelector("#SGSTtotal").value=y;
		document.querySelector("#CGSTtotal").value=y;
		document.querySelector("#Balance").value=zz;
		document.querySelector("#ghdtotal").value=zz;
	}else if((gst != "") && (Advance=="" || Advance==0.00) && (igst))
	{
	  var div = gst;
		var y = parseFloat((div * total)/100);
		var n = (gst * total)/100 ;
		var z = parseFloat(total) + parseFloat(n);
	//	console.log("total",z);
	
		document.querySelector("#SGST").value="";
		document.querySelector("#CGST").value="";
		document.querySelector("#IGST").value=div+"%";
		document.querySelector("#IGSTtotal").value=y;
		document.querySelector("#SGSTtotal").value="";
		document.querySelector("#CGSTtotal").value="";
		document.querySelector("#Balance").value=z;
		document.querySelector("#ghdtotal").value=z;
	}else if((gst != "") && (Advance) && (igst))
	{
		 var div = gst;
		var y = parseFloat((div * total)/100);
		var n = (gst * total)/100 ;
		var z = parseFloat(total) + parseFloat(n);
		var zz=(z-parseFloat(Advance));
	//	console.log("total",z);
	
		document.querySelector("#SGST").value="";
		document.querySelector("#CGST").value="";
		document.querySelector("#IGST").value=div+"%";
		document.querySelector("#IGSTtotal").value=y;
		document.querySelector("#SGSTtotal").value="";
		document.querySelector("#CGSTtotal").value="";
		document.querySelector("#Balance").value=zz;
		document.querySelector("#ghdtotal").value=zz;
	}else if((gst=="") && (igst) && (Advance==""))
	{
		//console.log('hii');
		$('#IGST').val(0);
		$('#IGSTtotal').val(0.00);
		$('#Balance').val(total);
	}else if((gst=="") && (cgst) && (Advance==""))
	{
		//console.log('hii');
		$('#CGST').val(0);
		$('#CGSTtotal').val(0.00);
		$('#SGST').val(0);
		$('#SGSTtotal').val(0.00);
		$('#Balance').val(total);
	}else if(gst=="" && (igst) && (Advance))
	{
		$('#IGST').val(0);
		$('#IGSTtotal').val(0.00);
		total1=total-Advance;
		$('#Balance').val(total1);
	}else if(gst=="" && (cgst) && (Advance))
	{
		$('#CGST').val(0);
		$('#CGSTtotal').val(0.00);
		$('#SGST').val(0);
		$('#SGSTtotal').val(0.00);
		total1=total-Advance;
		$('#Balance').val(total1);
	}
		
	
	
} 
}

function advance() {
	
	
	advanceamount = parseFloat(document.querySelector("#Advance").value);
	
	var Balance= parseFloat(document.querySelector("#Balance").value);
	
	var total= parseFloat(document.querySelector("#gTotal").value);
	var CGSTtotal= parseFloat(document.querySelector("#CGSTtotal").value);
	var SGSTtotal= parseFloat(document.querySelector("#SGSTtotal").value);
	var IGST= parseFloat(document.querySelector("#IGST").value);
	var IGSTtotal= parseFloat(document.querySelector("#IGSTtotal").value);
		
	if((advanceamount<=Balance) && (advanceamount))
	{
		var z = (parseFloat(Balance) - parseFloat(advanceamount)).toFixed(2);
		document.querySelector("#Balance").value = z;
		
	}else if(advanceamount>Balance){
		     alert('Advance is greater than Net Amount');
	         document.querySelector("#Advance").value='';
	}else if((!(advanceamount)) && (!IGSTtotal) ){
		     Total=((total+CGSTtotal+SGSTtotal).toFixed(2));
			 document.querySelector("#Balance").value=Total;
	}else if((!(advanceamount)) && (!CGSTtotal)){
		     Total=(total+IGSTtotal);
			 document.querySelector("#Balance").value=Total;
	}
} 

function total_pro()
{
	/* var subTotal = 0;
	 var maxCount = $('#maxCount').val();
	console.log('maxcount',maxCount);
	 for (i = 1; i <= maxCount; i++) {
        if ($('#Value_' + i).length) {
            subTotal += parseFloat($('#Value_' + i).val());
			
			//console.log('val',$('#Value_' + i));
			
        }
	 }
	 console.log('subtotal',subTotal);
	$('#gTotal').val(subTotal);
	$('#hdtotal').val(subTotal);*/
	
	 var subTotal = 0;
    if( $("#invoice_listing_table  tr").length=='1'){
     var countingz  = $("#invoice_listing_table  tr").attr("id");    
     }else{
     var countingz  = $("#invoice_listing_table  tr:last").attr("id");
     }
     var result = countingz.split("_")[3];

    for (i = 1; i <= result; i++) {
        if ($('#Value_' + i).length) {
            subTotal += parseFloat($('#Value_' + i).val());
        }
    }  
   // document.getElementById("BillAmount").value=subtotal;
    //$('#subtotal').html(subtotal);
    $('#gTotal').val(subTotal.toFixed(2));
	$('#hdtotal').val(subTotal.toFixed(2));
	
	var CGST =parseFloat($('#CGST').val());
	var IGST =parseFloat($('#IGST').val());
	if(isNaN(CGST))
	{
		var Advance =parseFloat($('#Advance').val());
		if(!Advance || Advance==0.00)
		{
			var GST =parseFloat($('#GST').val());
			if(!GST){
				$('#IGSTtotal').val('');
		        $('#Balance').val(subTotal.toFixed(2));
			}else{
		var Total4=((subTotal*IGST)/100);
		$('#IGSTtotal').val(Total4);
		var Total5=(subTotal+Total4);
	    $('#Balance').val(Total5.toFixed(2));
			}
		}else{
		var Total4=((subTotal*IGST)/100);
		$('#IGSTtotal').val(Total4);
		var Total5=((subTotal+Total4)-Advance);
	    $('#Balance').val(Total5.toFixed(2));
		}
	}else{	
	var Advance =parseFloat($('#Advance').val());
	if(!Advance || Advance==0.00)
		{
	var SGST =parseFloat($('#SGST').val());
	var Total1=((subTotal*CGST)/100);
	var Total2=((subTotal*SGST)/100);
	$('#CGSTtotal').val(Total1);
	$('#SGSTtotal').val(Total2);
	var Total3=(subTotal+Total1+Total2);
	$('#Balance').val(Total3.toFixed(2));
		}else{
	var SGST =parseFloat($('#SGST').val());
	var Total1=((subTotal*CGST)/100);
	var Total2=((subTotal*SGST)/100);
	$('#CGSTtotal').val(Total1);
	$('#SGSTtotal').val(Total2);
	var Total3=((subTotal+Total1+Total2)-Advance);
	$('#Balance').val(Total3.toFixed(2));
		}
	}
}
	
function proforma_Data(columnvalue,tablename1,tablename2,selectcolumn1,selectcolumn2,selectcolumn3,selectcolumn4,selectcolumn5,selectcolumn6,selectcolumn7,selectcolumn8,selectcolumn9,selectcolumn10,field_id1,field_id2,field_id3,field_id4,field_id5,field_id6,field_id7,field_id8,field_id9,field_id10)
{

    $('#'+field_id1).val('');
		$('#'+field_id2).val('');
		$('#'+field_id3).val('');
		$('#'+field_id4).val('');
		$('#'+field_id5).val('');
		$('#'+field_id6).val('');
		$('#'+field_id7).val('');
		$('#'+field_id8).val('');
		$('#'+field_id9).val('');
		$('#'+field_id10).val('');
    $.post(basePath + "/lib/ajax/proforma_no.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'tablename2':tablename2,'selectcolumn2':selectcolumn2,'selectcolumn3':selectcolumn3,'selectcolumn4':selectcolumn4,'selectcolumn5':selectcolumn5,'selectcolumn6':selectcolumn6,'selectcolumn7':selectcolumn7,'selectcolumn8':selectcolumn8,'selectcolumn9':selectcolumn9,'selectcolumn10':selectcolumn10}, function (data) {
	
		if(data.length){
			$.each(data, function(key, value) {
				$('#'+field_id1).val(this.PONo);
					$('#'+field_id2).val(this.PersonName);
					$('#'+field_id3).val(this.CompanyName);
					$('#'+field_id4).val(this.GSTNo);
					$('#'+field_id5).val(this.BillingAddress1);
					$('#'+field_id6).val(this.BillingAddress2);
					$('#'+field_id7).val(this.BillingCity);
					$('#'+field_id8).val(this.StateName);
					$('#'+field_id9).val(this.CountryName);
					$('#'+field_id10).val(this.BillingZip);
			});
		}
	
 }, "json");   
    
}

function rawmtrl_agianst_grade_unit(columnvalue,idd,selectid1,selectid2)
{

 var splittedid=idd.split("_")[1];

 $.post(basePath + "/lib/ajax/rawmtrl_agianst_unit_and_grade.php", {'ColumnValue': columnvalue}, function (data) {
     ($('#'+selectid1 +splittedid).empty());
     ($('#'+selectid2 +splittedid).empty());
     $('#'+selectid2 +splittedid).prepend('<option value="" disabled selected style="display:none;">Select</option>');
     $.each(data, function() {
        $('#'+selectid1 +splittedid).val(this['Grade']);
        $('#'+selectid2 +splittedid).append($('<option></option>').val(this['unit_ID']).text(this['UnitName']).prop('selected', true));
       
    });
   
 }, "json");   
    
}

function tax()
{
	var GSTTax =parseFloat($('#GSTTax').val());
	if(!GSTTax){
		$('#IGSTTax').val(0);
		var igst_amt=0;
		$('#IGSTAmount').val(igst_amt.toFixed(2));
		var Bill_Amount =parseFloat($('#BillAmount').val());
		//console.log('bill',BillAmount);
		$('#NetAmount').val(Bill_Amount.toFixed(2));
		
	}
}

function tax_amount_calc() {
	
	var CgstTax = document.getElementById('CGSTTax').value ;
    var SgstTax = document.getElementById('SGSTTax').value ; 

	
	   if(CgstTax != SgstTax )
   {
		document.getElementById('SGSTTax').readOnly = true ;
		
		 var SgstTax = document.getElementById('CGSTTax').value ;
		 document.getElementById('SGSTTax').value= SgstTax ;
		
   }
   
    var subtotal = 0;
    if( $("#invoice_listing_table  tr").length=='1'){
     var countingz  = $("#invoice_listing_table  tr").attr("id");    
     }else{
     var countingz  = $("#invoice_listing_table  tr:last").attr("id");
     }
     var result = countingz.split("_")[3];

    for (i = 1; i <= result; i++) {
        if ($('#Amount_' + i).length) {
            subtotal += parseFloat($('#Amount_' + i).val());
        }
    }  
   // document.getElementById("BillAmount").value=subtotal;
    $('#subtotal').html(subtotal);
    $('#BillAmount').val(subtotal.toFixed(2));
   
    var CGSTTax = parseFloat($('#CGSTTax').val());
    var tax_amount = ((subtotal * CGSTTax) / 100);
     
    // $('#GSTAmount').html(tax_amount.toFixed(2));
      
    // $('#CGSTTax').html(tax_amount.toFixed(2));

   
    var SGSTTax = parseFloat($('#SGSTTax').val());
    var tax_amount1 = ((subtotal * SGSTTax) / 100);
     
   // $('#SGSTAmount').html(tax_amount1.toFixed(2));
      
    //$('#SGSTTax').html(tax_amount1.toFixed(2));

    var IGSTTax = parseFloat($('#IGSTTax').val());
    var tax_amount2 = ((subtotal * IGSTTax) / 100);
     
   // $('#IGSTAmount').html(tax_amount2.toFixed(2));
      
   // $('#IGSTTax').html(tax_amount2.toFixed(2));

    
    
    var NetAmount =(subtotal + tax_amount + tax_amount1 + tax_amount2);
    
    // count= $('#maxCount').val();
    // for (i = 1; i < count; i++) {
    //     if ($('#Amount_' + i).length) {
    //         subTotal += parseFloat($('#Amount_' + i).val());
    //     }
    // }

     
    $('#SGSTAmount').val(tax_amount1.toFixed(2));  
    $('#IGSTAmount').val(tax_amount2.toFixed(2));
    $('#CGSTAmount').val(tax_amount.toFixed(2));
    
    $('#Total').html(NetAmount.toFixed(2));
    $('#NetAmount').val(NetAmount.toFixed(2));
    $('#maxCount').val(result);


}

function Fetch_costing_Data(columnvalue,tablename1,tablename2,tablename3,selectcolumn1,selectcolumn2,selectcolumn3,selectcolumn4,selectcolumn5,selectcolumn6,selectcolumn7
    ,selectcolumn8,selectcolumn9,selectcolumn10,selectcolumn11,field_id1,field_id2,field_id3,field_id4,field_id5,field_id6,field_id7,field_id8,field_id9,field_id10,field_id11)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
	
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
    $('#'+field_id3).val('');
	$('#'+field_id4).val('');
    $('#'+field_id5).val('');
	$('#'+field_id6).val('');
    $('#'+field_id7).val('');
	$('#'+field_id8).val('');
    $('#'+field_id9).val('');
	$('#'+field_id10).val('');
    $('#'+field_id11).val('');
	
    $.post(basePath + "/lib/ajax/costing_pdn.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2,'tablename2':tablename2,'selectcolumn3':selectcolumn3,'selectcolumn4':selectcolumn4,'selectcolumn5':selectcolumn5,'selectcolumn6':selectcolumn6,'selectcolumn7':selectcolumn7,'selectcolumn8':selectcolumn8,'selectcolumn9':selectcolumn9,'selectcolumn11':selectcolumn11,'tablename3':tablename3,'selectcolumn10':selectcolumn10}, function (data) {
        $('#'+field_id10).find('option').remove()
		if(data.length){
			$('#'+field_id10).find('option').remove();
			 $('#'+field_id10).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');
			$.each(data, function(key, value) {
				$('#'+field_id1).val(this.DeptName);	
                $('#'+field_id2).val(this.PersonName);	
                $('#'+field_id3).val(this.TenderSection);	
                $('#'+field_id4).val(this.ClosingDateTime);	
                $('#'+field_id5).val(this.InspectionAgency);	
                $('#'+field_id6).val(this.ApproveAgency);	
                $('#'+field_id7).val(this.RAEnabledYN);	
                $('#'+field_id8).val(this.RegularOrDev);	
                $('#'+field_id9).val(this.ValidityOfferDays);	
                $('#'+field_id11).val(this.ProcureApproveYN);	
         
				 $('#'+field_id10).find('option')
				.end()
				.append('<option value="'+ value.ID +'">'+ value.Title +'</option>');				
				
			});
		}
	
 }, "json");   
    
}

function Fetch_costing_title_Data(columnvalue,tablename1,selectcolumn1,selectcolumn2,selectcolumn3,selectcolumn4,selectcolumn5,selectcolumn6,selectcolumn7
    ,field_id1,field_id2,field_id3,field_id4,field_id5,field_id6,field_id7)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
	
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
    $('#'+field_id3).val('');
	$('#'+field_id4).val('');
    $('#'+field_id5).val('');
	$('#'+field_id6).val('');
    $('#'+field_id7).val('');
	
    $.post(basePath + "/lib/ajax/costingTitle_pdn.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2,'selectcolumn3':selectcolumn3,'selectcolumn4':selectcolumn4,'selectcolumn5':selectcolumn5,'selectcolumn6':selectcolumn6,'selectcolumn7':selectcolumn7}, function (data) {

		if(data.length){
			$.each(data, function(key, value) {
				$('#'+field_id1).val(this.PLCod);	
                $('#'+field_id2).val(this.Description);	
                $('#'+field_id3).val(this.Consigne);	
                $('#'+field_id4).val(this.DeliveryLocation);	
                $('#'+field_id5).val(this.Qty);	
                $('#'+field_id6).val(this.UnitName);	
                $('#'+field_id7).val(this.RequestPriceYN);	
				
			});
		}
	
 }, "json");   
    
}

function Fetch_duplicate_dept_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_dept.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Department Name');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_des_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
	//console.log(columnvalue);
	
	var Department_ID =$('#Department_ID').val()
   $.post(basePath + "/lib/ajax/duplicate_des.php", {'ColumnValue': columnvalue,'Department_id': Department_ID,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Designation Name'); 
		             $('#'+field_id1).val('');
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_unit_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_unit.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Unit Name');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_unit1_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_unit1.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Description');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_rawmaterial_category_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_rawmaterial_category.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Rawmaterial Category');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_rawmaterial_category1_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_rawmaterial_category1.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Description');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_rawmaterial_subcategory_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
	//console.log(columnvalue);
	
	var rawmaterialtype_ID =$('#rawmaterialtype_ID').val()
   $.post(basePath + "/lib/ajax/duplicate_rawmaterial_subcategory.php", {'ColumnValue': columnvalue,'rawmaterialtype_id': rawmaterialtype_ID,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Designation Name'); 
		             $('#'+field_id1).val('');
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_rawmaterial_subcategory1_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
	//console.log(columnvalue);
	
	var rawmaterialtype_ID =$('#rawmaterialtype_ID').val()
   $.post(basePath + "/lib/ajax/duplicate_rawmaterial_subcategory.php", {'ColumnValue': columnvalue,'rawmaterialtype_id': rawmaterialtype_ID,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Description'); 
		             $('#'+field_id1).val('');
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_productcategory_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_product_category.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Product Category');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_productcategory1_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_product_category1.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Description');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_product_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
	//console.log(columnvalue);
	
	var producttype_ID =$('#producttype_ID').val()
   $.post(basePath + "/lib/ajax/duplicate_product.php", {'ColumnValue': columnvalue,'producttype_id': producttype_ID,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Product Name'); 
		             $('#'+field_id1).val('');
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_product1_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
	//console.log(columnvalue);
	
	var producttype_ID =$('#producttype_ID').val()
   $.post(basePath + "/lib/ajax/duplicate_product1.php", {'ColumnValue': columnvalue,'producttype_id': producttype_ID,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Product Description'); 
		             $('#'+field_id1).val('');
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_production_department_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_production_department.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Production Department');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_production_department1_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_production_department1.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Description');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_customer_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_customer.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Contact Person Name');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_employee_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_employee.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Employee Name');
		             $('#'+field_id1).val('');
                     					 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function Fetch_duplicate_process_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
   $.post(basePath + "/lib/ajax/duplicate_process.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data){
		             alert('already exist Process Name');
                     $('#'+field_id1).val('');
							 
		}
		//console.log('hi',data);
 }, "json");   
    
}

function ycsdate_hidepast(id) {
$('#'+id).datetimepicker({
//   useCurrent: false,
  format: 'DD-MM-YYYY',
  minDate:new Date(),
   
});

}

function add_enable(value,IdToReflect){  /// apply disabled in some condition to particular id attribute
   //console.log('value',value);
    if(value){
    //console.log('hi',value);		
        //$("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
        //$('#'+IdToReflect).prop({"enable":true}); 
		$('#'+IdToReflect).removeAttr('disabled');
    }
}

function getpurchasedetails(ID){
   
    var indent_id=ID; 
   // console.log('hello');
    $.post(basePath + "/lib/ajax/get_purchasedet.php", {'indent_id': indent_id}, function (data) {
        
        $('#showData').empty();
        

 var col = [];
       
        for (var i = 0; i < data.length; i++) {
            
            for (var key in data[i]) {
               if (key=='Item Name' || key=='Pack Details' || key=='Approved Qty' || key =='Raised PO Quantity'  || key =='PO Quantity' || key=='Unit' || key=='Price' || key=='Amount'){
                if (col.indexOf(key) === -1) {
                    col.push(key);
                
                }
            }
        }
}

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        
        table.setAttribute('class', 'table table-bordered');
        //table.setAttribute('id', 'showData1');
        
        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.
        
        

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
           
        }
       
        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {
         var k=i+1;
            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = data[i][col[j]];
                 tr.setAttribute('id', 'Invoice_data_entry_'+k);
            }
        }
        
        

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
       
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);
        document.querySelector('tbody').setAttribute('id', 'invoice_listing_table');
        
 
    
    }, "json");  
}

function getsupplier(val,IdToReflect1,IdToReflect2,IdToReflect3,IdToReflect4)  /// for populating suppier name agianst addresses
{   
    $('#'+IdToReflect1).empty();
    $('#'+IdToReflect2).empty();
    $('#'+IdToReflect3).empty();
    $('#'+IdToReflect4).empty();
    var supid = val;
     
    $.post(basePath + "/lib/ajax/get_supplier.php", {'supid': supid}, function (data) {
        
        if(data !=null){

          document.getElementById(IdToReflect1).value = data[0]['AddressLine1'];
          document.getElementById(IdToReflect2).value = data[0]['AddressLine2'];
          document.getElementById(IdToReflect3).value = data[0]['City'];
          document.getElementById(IdToReflect4).value = data[0]['StateName'];
        } else{
              document.getElementById(IdToReflect1).value ="";
              document.getElementById(IdToReflect2).value ="";
              document.getElementById(IdToReflect3).value ="";
              document.getElementById(IdToReflect4).value ="";
        }


    }, "json"); 
}

function ajaxtax_amount_calc() {
   
    var CgstTax = document.getElementById('CGSTTax').value ;
    var SgstTax = document.getElementById('SGSTTax').value ; 

    if(CgstTax != SgstTax ){
	 document.getElementById('SGSTTax').readOnly = true ;
	 var SgstTax = document.getElementById('CGSTTax').value ;
	 document.getElementById('SGSTTax').value= SgstTax ;
		
   }
   
    var subtotal = 0;
    if( $("#invoice_listing_table  tr").length=='1'){
     var countingz  = $("#invoice_listing_table  tr").attr("id");    
    }else{
     var countingz  = $("#invoice_listing_table  tr:last").attr("id");
    }
    var result = countingz.split("_")[3];

    for (i = 1; i <= result; i++) {
        if ($('#Amount_' + i).length) {
            subtotal += parseFloat($('#Amount_' + i).val());
        }
    }  
   
    $('#subtotal').html(subtotal);
    $('#BillAmount').val(subtotal.toFixed(2));
    
    var discnt_percent1 = $('#DiscountPercent').val();
    //console.log('dp',discnt_percent1);
    var dis_per_Amt=(discnt_percent1/100)*subtotal;
   // console.log('disper',disper);
   
    var CGSTTax = parseFloat($('#CGSTTax').val());
    var tax_amount = (((subtotal-dis_per_Amt) * CGSTTax) / 100);

    var SGSTTax = parseFloat($('#SGSTTax').val());
    var tax_amount1 = (((subtotal-dis_per_Amt) * SGSTTax) / 100);

    var IGSTTax = parseFloat($('#IGSTTax').val());
    // 
       if(isNaN(IGSTTax))
    {
        // IGSTTax =+ 0;
        $('#IGSTTax').val(0);
    }
    var igstTax = parseFloat($('#IGSTTax').val());
    var tax_amount2 = (((subtotal-dis_per_Amt) * igstTax) / 100);
     //  var tax_amount2 = (((subtotal-dis_per_Amt) * IGSTTax) / 100);
 
    var NetAmount =(subtotal + tax_amount + tax_amount1 + tax_amount2);
     
    $('#SGSTAmount').val(tax_amount1.toFixed(2));  
    $('#IGSTAmount').val(tax_amount2.toFixed(2));
    $('#CGSTAmount').val(tax_amount.toFixed(2));
    var discnt_percent = $('#DiscountPercent').val();
    var discountamt = $('#DiscountAmount').val();
    if($('#subtotal').html()!='' && $('#subtotal').html()!='0' && discnt_percent!=''){
          var discntamt=$('#DiscountAmount').val((discnt_percent/100)*subtotal);
          $('#Total').html(NetAmount.toFixed(2)-$('#DiscountAmount').val());
          $('#NetAmount').val(NetAmount.toFixed(2)-$('#DiscountAmount').val());
    }else if($('#subtotal').html()!='' && $('#subtotal').html()!='0' && discnt_percent=='' && discountamt!=''){
          $('#Total').html(NetAmount.toFixed(2)-$('#DiscountAmount').val());
          $('#NetAmount').val(NetAmount.toFixed(2)-$('#DiscountAmount').val());
        //  $('#DiscountPercent').val(((discountamt/subtotal)*100).toFixed(2));
    }else{
          $('#DiscountPercent').val('');
          $('#Total').html(NetAmount.toFixed(2));
          $('#NetAmount').val(NetAmount.toFixed(2));
     }
   
    $('#maxCount').val(result);

}

function get_ajaxtable_count(div_id) {
      
    var counting  = $('#'+div_id+' tr:last').find("td:first").find("input").attr('id');
    var result = counting.split("_")[1];
    
    console.log(result);
    $('#maxCount').val(result);
}

function discount_calc(id,id_to_reflect,tot_id) {
    var tot=$('#'+tot_id).html();
    var discnt_percent = $('#'+id).val();
    if(!isNaN(tot) && tot!='' && discnt_percent!=''){
         $('#'+id_to_reflect).val((discnt_percent/100)*100);
    }else{
         $('#'+id_to_reflect).val('');
          $('#'+id).val('');
     }
}

function gstvalidation()
{
		var GSTNo =($('#GSTNo').val());
var reggst = /^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([0-9]){1}([a-zA-Z]){1}([0-9]){1}?$/;
if(!reggst.test(GSTNo) && GSTNo!=''){
        alert('GST Identification Number is not valid. It should be in this "11AAAAA1111Z1A1" format');
		$('#GSTNo').val('');
}
}

function POQty_Validation(selectid){

    var poqty_rowid= selectid.split("_")[1];

    var poqty=parseFloat(document.getElementById("Qty_" + poqty_rowid).value);
    var approvedqty=document.getElementById("Note_"+ poqty_rowid).value;
    var raisedqty=document.getElementById("RaisedPOQty_"+ poqty_rowid).value;
    var sumofqty=parseInt(raisedqty) + parseInt(poqty);
    if(!(isNaN(poqty)) && poqty!='' && poqty!=0 && approvedqty!=''){
      if(sumofqty<=approvedqty){
         document.getElementById("Qty_" + poqty_rowid).value=poqty;
      }else {
          document.getElementById("Qty_" + poqty_rowid).value="";
          document.getElementById("Qty_" + poqty_rowid).focus();
          alert("PO Quantity should not be greater than Approved Qty as per the sum of Raised and PO Qty");
          }
    }else{
        document.getElementById("Qty_" + poqty_rowid).value='';
        document.getElementById("ItemNo_" + poqty_rowid).focus();
    }
    }
    
    function Indet_Rawmaterial(columnvalue,selectid1,selectid2,selectid3,selectid4,selectid5)
    {
    
    $.post(basePath + "/lib/ajax/get_indent_agianst_rawmat.php", {'indent_id': columnvalue}, function (data) {
    $(selectid1).empty();
    $(selectid2).val('');
    $(selectid3).val('');
    $(selectid4).val('');
    $(selectid5).val('');
    $(selectid1).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        
        $(selectid1).append($('<option></option>').val(this['ID']).text(this['RMName']))
    });
   
 }, "json");   
    
}
    
     function Rawmaterial_Agianst_Indentdet(columnvalue,dispid1,dispid2,dispid3,dispid4,dispid5)
    {
    
    var rowid= dispid1.split("_")[1];
      
    $.post(basePath + "/lib/ajax/get_rawmtrl_agianst_indentdet.php", {'rawid': columnvalue}, function (data) {
    $('#'+dispid2+rowid).empty();
    $('#'+dispid3+rowid).empty();
    $('#'+dispid4+rowid).empty();
    $('#'+dispid5+rowid).empty();
    
    $.each(data, function() {
        
        $('#'+dispid2+rowid).val(this['ApprovedQty']);
        $('#'+dispid3+rowid).val(this['RaisedPOQty']);
        $('#'+dispid4+rowid).val(this['UnitName']);
        $('#'+dispid5+rowid).val(this['unit_ID']);
    });
   
    }, "json");   
    
    }
    
     function addRowwithcalc(editcount) {
    
     var count =$('#invoice_listing_table tr').length;
           
     count++;
 
    var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + count});

    x.find('#ItemNo_1').val('');
    if ($('#ItemNo_1').length) {
        x.find('#ItemNo_1').attr({id: "ItemNo_" + count, name: "ItemNo_" + count});
    }

    x.find('#ItemName_1').val('');
    x.find('#ItemName_1').attr({id: "ItemName_" + count, name: "ItemName_" + count});
    
    x.find('#Packdet_1').val('');
    if ($('#Packdet_1').length) {
        x.find('#Packdet_1').attr({id: "Packdet_" + count, name: "Packdet_" + count});
     }
    
    x.find('#Note_1').val('');
    if ($('#Note_1').length) {
        x.find('#Note_1').attr({id: "Note_" + count, name: "Note_" + count});
    }
     x.find('#RaisedPOQty_1').val('');
    if ($('#RaisedPOQty_1').length) {
        x.find('#RaisedPOQty_1').attr({id: "RaisedPOQty_" + count, name: "RaisedPOQty_" + count});
    }
    x.find('#Amount_1').val('');
    x.find('#Amount_1').attr({id: "Amount_" + count, name: "Amount_" + count});
    
    x.find('#Qty_1').val('');
    x.find('#Qty_1').attr({id: "Qty_" + count, name: "Qty_" + count, onkeypress: "return onlyNumbernodecimal(event);" , onkeyup: "nozero(this.id);POQty_Validation(this.id);$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2));ajaxtax_amount_calc();"});
   
    x.find('#Emp_1').val('');
    x.find('#Emp_1').attr({id: "Emp_" + count, name: "Emp_" + count, onkeyup: "nozero(this.id);$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2));ajaxtax_amount_calc();"});

    x.find('#unit_1').val('');
    if ($('#unit_1').length) {
        x.find('#unit_1').attr({id: "unit_" + count, name: "unit_" + count});
    } 
    
    x.find('#unitname_1').val('');
    x.find('#unitname_1').attr({id: "unitname_" + count, name: "unitname_" + count});

	x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove();ajaxtax_amount_calc()"});
	
    x.appendTo('#invoice_listing_table');
    
     $('#maxCount').val(count);
    // count++;
}

function workorder_quantity() 
	{
	var NoofQuantity =parseFloat($('#NoofQuantity').val());
    var StartingProductionNo =parseFloat($('#StartingProductionNo').val());
    var EndProdNo =parseFloat($('#EndProdNo').val());
   if(isNaN(NoofQuantity)){
        $('#StartingProductionNo').val(0);
	    $('#EndProdNo').val(0);
    }else if(NoofQuantity){
        $('#StartingProductionNo').val(1);
	    $('#EndProdNo').val(NoofQuantity);
    }
	}
	
function workorder_quantity_Data(columnvalue,tablename1,selectcolumn1,selectcolumn2,field_id1,field_id2)
    {
    
            $('#'+field_id1).val('');
            $('#'+field_id2).val('');
            var ProcessID =$('#ProcessID').val()
            var product_ID =$('#product_ID').val()
        $.post(basePath + "/lib/ajax/workorder_quantity_pdn.php", {'ColumnValue': columnvalue,'Processid': ProcessID,'productID': product_ID,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2}, function (data) {
        
            if(data.length){
                $.each(data, function(key, value) {
                        $('#'+field_id1).val(this.StartingProductionNo);
                        $('#'+field_id2).val(this.EndProdNo);
                          if(!this.EndProdNo){
                            workorder_quantity();
                          }else{
                            workorder1_quantity();
                          }
                });
            }
        
     }, "json");   
        
    }
    
 function workorder1_quantity() 
	{
	var NoofQuantity =parseFloat($('#NoofQuantity').val());
    var StartingProductionNo =parseFloat($('#StartingProductionNo').val());
    var EndProdNo =parseFloat($('#EndProdNo').val());
    if(NoofQuantity){
        var st=(EndProdNo+1);
        var end=(EndProdNo+NoofQuantity);
        $('#StartingProductionNo').val(st);
	    $('#EndProdNo').val(end);
    }
	}
	
function qualitycontrol_Data(columnvalue,field_id1,field_id2)
{
        $('#'+field_id1).val('');
		$('#'+field_id2).val('');
    $.post(basePath + "/lib/ajax/qualitycontrol_pdn.php", {'WorkorderID': columnvalue}, function (data) {
	
		if(data.length){
			$.each(data, function(key, value) {
			    	$('#'+field_id1).val(this.CompletedDate);
					$('#'+field_id2).val(this.EmpName);
                    if(!this.EmpName){
                    $('#'+field_id2).val(this.SupplierName);
                    }
			});
		}
	
 }, "json");   
    
}

// material inward start

function material_Validationnn(selectid){

    // console.log('doood');
    var poqty_rowid= selectid.split("_")[2];
    // console.log('poqty_rowid', poqty_rowid);
    var recqty=parseFloat(document.getElementById("received_qty_" + poqty_rowid).value);
    // console.log('value', recqty);
    var poqty=document.getElementById("po_qty_"+ poqty_rowid).value;
    var pendingqty=document.getElementById("pending_qty_"+ poqty_rowid).value;
    // var sumofqty=parseInt(pendingqty) + parseInt(recqty);
    if(!(isNaN(recqty)) && recqty!='' && recqty!=0){
         if(recqty<=pendingqty){
         document.getElementById("received_qyt_" + poqty_rowid).value=recqty;
      }else {
          document.getElementById("received_qty_" + poqty_rowid).value="";
          document.getElementById("received_qty_" + poqty_rowid).focus();
          alert("Recived  Quantity should  be greater than PO Qty");
          }
    }
    else{
        document.getElementById("received_qty_" + poqty_rowid).value="";
        document.getElementById("total_" + poqty_rowid).value="";
        document.getElementById("item_id_" + poqty_rowid).focus();
    }
    }

    function material_inward_data(columnvalue,selectid1,selectid2,selectid3,selectid4,selectid5,field_id6,field_id7)
    {
        console.log("columnvalue "+columnvalue);
        $('#'+field_id6).val('');
    $.post(basePath + "/lib/ajax/get_material_inward_agianst_rawmat.php", {'indent_id': columnvalue}, function (data) {
    $(selectid1).empty();
    $(selectid2).val('');
    $(selectid3).val('');
    $(selectid4).val('');
    $(selectid5).val('');
    $('#'+field_id6).val('');
    $('#'+field_id7).val('');
    $(selectid1).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {
        
        $(selectid1).append($('<option></option>').val(this['ID']).text(this['RMName']))
        $('#'+field_id6).val(this.SupplierName);
        $('#'+field_id7).val(this.supplier_ID);
    });
   
 }, "json");   
    
}



function validateExistmaterialinward(id,tableBodyId) {
        
        var Seee = id.split("_")[0];
        var spid = id.split("_")[1];
        var joinid = Seee + "_" + spid;
        var idid = id.split("_")[2];
    
        
        var selectedvalue = document.getElementById(id).value; 
      
        var count = document.getElementById(tableBodyId).getElementsByTagName("tr").length;
     
     
            if(count>=1)
            {
               
                for(i=1;i<=count;i++){

                    var rowvalue = document.getElementById(joinid+"_"+i).value; 
                  
                    if(selectedvalue == rowvalue && id != joinid+"_"+i)
                    {
                        document.getElementById(id).value="";
                        alert("Already Selected ");
                        document.getElementById('Note_' + idid).value="";
                        // document.getElementById('RaisedPOQty_' + idid).value="";
                         document.getElementById('RaisedPOQty_' + idid).value="";
                        document.getElementById('unitname_' + idid).value="";
                        document.getElementById('unit_' + idid).value="";
                        document.getElementById('unitname_' + idid).value="";
                        document.getElementById('Amount_' + idid).value="";
                                    
                        break;
                    }
                }
            }
        }

function material_inward_fetch_data_child(columnvalue,dispid1,dispid2,dispid3,dispid4,dispid5,dispid6)
    {
        console.log('dispid1'+" "+dispid1);
    var rowid= dispid1.split("_")[2];

    console.log('rowid'+" "+rowid);
      
    $.post(basePath + "/lib/ajax/get_rawmtrl_agianst_material_inward.php", {'rawid': columnvalue,'purid' : dispid6}, function (data) {
 $('#'+dispid2+rowid).empty();
 $('#'+dispid3+rowid).empty();
  $('#'+dispid4+rowid).empty();
  $('#'+dispid5+rowid).empty();
  console.log('data'+" "+data);
    $.each(data, function() {
        console.log("data " +data);
        $('#'+dispid2+rowid).val(this['POQuantity']);
        //  $('#'+dispid3+rowid).val(this['poquantity_stat']);
        $('#'+dispid3+rowid).val(this['extra_clm']);
       $('#'+dispid4+rowid).val(this['UnitName']);
       $('#'+dispid5+rowid).val(this['unit_ID']);
    });
   
    }, "json");   
    
    }
        

// material inward end

// qc material Inward Start

  function Fetch_qc_materialiwt_Data(columnvalue,field_id1,field_id2,field_id3)
    {
        console.log("DATA Required "+columnvalue);

        $('#'+field_id1).empty();
        $('#'+field_id1).val(null).trigger('change'); // clear the Select2 select box
        $('#'+field_id2).val('');
        $('#'+field_id3).val('');
    
        $.post(basePath + "/lib/ajax/fetch_qc_data.php", {'ColumnValue': columnvalue}, function (data) {
    
            if(data.length){
    
                console.log(data);
    
                // add the 'Select' option to the Select2 select box
                var select2field = $('#'+field_id1);
                select2field.append('<option value="" disabled selected style="display:none;">Select</option>');
                select2field.trigger('change');
    
                $.each(data, function(key, value) { 
    
                    // add each option to the Select2 select box
                    var newOption = new Option(value.MaterialNo, value.MIN, false, false);
                    select2field.append(newOption).trigger('change');
    
                    $('#'+field_id2).val(this.SupplierName);           
                    $('#'+field_id3).val(this.supplier_ID); 
                });
            }
    
        }, "json");   
    }

function add_enable_qc(value,IdToReflect,IdToReflect2){  /// apply disabled in some condition to particular id attribute
    //console.log('value',value);
     if(value){
     //console.log('hi',value);		
         //$("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
         //$('#'+IdToReflect).prop({"enable":true}); 
         $('#'+IdToReflect).removeAttr('disabled');
         $('#'+IdToReflect2).removeAttr('disabled');
     }
 }
 
function Fetch_qcmaterial_Data(columnvalue)
{
var count = 1; // initialize count variable outside the loop



$.post(basePath + "/lib/ajax/fetch_qc_material_data.php", {'ColumnValue': columnvalue}, function (data) {
    $("#qcmaterialinward tbody").empty();
   
    if(data.length){
        $.each(data, function(key, value) {
            console.log('count'+ count);
            if(count >= 0 ){
                
                // count =count+1;
                var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12"> <input type="hidden" id="item_id_'+count+'" name="item_id_'+count+'" value="'+this.item_id+'"/> <input class="form-control" type="text" id="RMName_'+count+'" name="RMName_'+count+'" value="'+this.RMName+'" readonly=""> </div></div></td> ';
                newRowContent += '  <td>   <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="received_qty_'+count+'" name="received_qty_'+count+'" value="'+this.received_qty+'" readonly=""> </div>   </div>   </td>';
                newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12"> <input type="hidden" id="unit_'+count+'" name="unit_'+count+'" value="'+this.unit+'"/> <input class="form-control" type="text" id="UnitName_'+count+'" name="UnitName_'+count+'" value="'+this.UnitName+'" readonly=""> </div> </div> </td>'; 
                newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="received_qt_in_kg_'+count+'" name="received_qt_in_kg_'+count+'" value="'+this.received_qt_in_kg+'" readonly=""> </div> </div> </td>';
                newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="batch_no_'+count+'" name="batch_no_'+count+'" value="'+this.batch_no+'" readonly=""> </div> </div> </td>'; 
                newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="supplier_invoice_no_'+count+'" name="supplier_invoice_no_'+count+'" value="'+this.supplier_invoice_no+'" readonly=""> </div> </div> </td>'; 
                newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="invoice_date_'+count+'" name="invoice_date_'+count+'" value="'+this.invoice_date+'" readonly=""> </div> </div> </td>'; 

                newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="material_quantity_stat_'+count+'" name="material_quantity_stat_'+count+'" value="'+this.material_quantity_stat+'" readonly=""> </div> </div> </td>'; 
                newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="accepted_qty_'+count+'" name="accepted_qty_'+count+'" value="'+(this.accepted_qty !== undefined ? this.accepted_qty : '')+'" ="" onkeyup= "accepted_val_qc(this.id);" onkeypress="return onlynumbers(event);" required> </div>  </div> </td>';
                newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="rejected_qty_'+count+'" name="rejected_qty_'+count+'" value="'+(this.rejected_qty !== undefined ? this.rejected_qty : '')+'" ="" readonly> </div>  </div> </td>';
                newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="rejection_reason_'+count+'" name="rejection_reason_'+count+'" value="'+(this.rejection_reason !== undefined ? this.rejection_reason : '')+'" ="" > </div>  </div> </td> </tr>';
                //console.log('hi',newRowContent);
                $("#qcmaterialinward tbody").append(newRowContent);
                document.getElementById("maxCount").value= count;
                
            }
            count++;
        });
    }

}, "json");   

// console.log('count FInall'+ count);

}

function accepted_val_qc(selectid){


console.log("Enter The Accpted Qty");
console.log("Accpted Qty ID "+ selectid);

var poqty_rowid= selectid.split("_")[2];

console.log('poqty_rowid', poqty_rowid);


var acceptedqty=parseFloat(document.getElementById("accepted_qty_" + poqty_rowid).value);
console.log('acceptedqty', acceptedqty);
var receivedqty=document.getElementById("received_qty_"+ poqty_rowid).value;
console.log('receivedqty', receivedqty);
var total_acceptedqty=parseFloat(document.getElementById("material_quantity_stat_" + poqty_rowid).value);
var total = total_acceptedqty + acceptedqty;
var ftotal = receivedqty - total;
if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
     if(total<=receivedqty){
     document.getElementById("accepted_qty_" + poqty_rowid).value=acceptedqty;
      document.getElementById("rejected_qty_" + poqty_rowid).value=ftotal;
  }else {
      document.getElementById("accepted_qty_" + poqty_rowid).value="";
      document.getElementById("accepted_qty_" + poqty_rowid).focus();
      alert("Accepted Quantity should not be greater than Transfer Qty");
      }
}
}

// Qc Material Inward End

function ChangeEntity()
{
    
    document.getElementById("entity_ID").disabled=false;
    
}

function ChangeentityID(basePath,entityval)
{
    var entityid=entityval;
     document.getElementById("entity_ID").disabled=true;

  $.post(basePath + "/lib/ajax/change_entityID.php", {'entityID': entityid}, function (data) {

    alert(data);
    location.reload("true");
    }, "json");    

            
}

function dispatchreturnable_address_Data(columnvalue,tablename1,tablename2,selectcolumn1,selectcolumn2,field_id1,field_id2)
{
    //console.log('hi');
    $('#'+field_id1).val('');
    $('#'+field_id2).val('');
    $.post(basePath + "/lib/ajax/dispatchreturnable_address.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'tablename2':tablename2,'selectcolumn2':selectcolumn2}, function (data) {
		$('#'+field_id1).find('option').remove()
		if(data.length){
			$('#'+field_id1).find('option').remove();
			 $('#'+field_id1).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');

			$.each(data, function(key, value) {
				 $('#'+field_id1).find('option')
				.end()
				.append('<option value="'+ value.ID +'">'+ value.PdnOrderNo +'</option>');
				
                $('#'+field_id2).val(this.AddressLine1);
			});
		}

 }, "json");  
    
}	

function Fetch_subcontractor_materialinward_Data(columnvalue,tablename1,tablename2,selectcolumn1,selectcolumn2,selectcolumn3,field_id1,field_id2,field_id3)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
    $('#'+field_id3).val('');
    
    	var DispatchID=$('#DispatchID').val();
	
    $.post(basePath + "/lib/ajax/subcontract_materialinward.php", {'ColumnValue': columnvalue,'DispatchID': DispatchID,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2,'tablename2':tablename2,'selectcolumn3':selectcolumn3}, function (data) {
	   $("#tenderdetail tbody").empty();
		if(data.length){
			$.each(data, function(key, value) {
			   var count=0;
				if(count >= 0 ){
					$('#'+field_id1).val(this.RMName);
				    $('#'+field_id2).val(this.Quantity);
                    $('#'+field_id3).val(this.ProductName);
					
					var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12">  <input class="form-control" type="text" id="RawmaterialName'+count+'" name="RawmaterialName'+count+'" value="'+this.RMName+'" readonly=""> </div></div></td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Quantity'+count+'" name="Quantity'+count+'" value="'+this.Quantity+'" readonly=""> </div>  </div> </td> </tr>';
                     //console.log('hi',newRowContent);
					$("#tenderdetail tbody").append(newRowContent);
				}
count++				
			});
		}
	
 }, "json");  

}

function Fetch_subcontractor_materialinward1_Data(columnvalue,field_id1,field_id2,field_id3,field_id4)
{
    var count=0;
	//console.log('ih');
	//console.log('hlo',columnvalue);
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
	$('#'+field_id3).val('');
	$('#'+field_id4).val('');
	
	var DispatchID=$('#DispatchID').val();
	
    $.post(basePath + "/lib/ajax/subcontract_materialinward1.php", {'ColumnValue': columnvalue,'DispatchID': DispatchID}, function (data) {
	   $("#tenderdetail2 tbody").empty();
	 //  console.log('dd',data);
		if(data.length){
			$.each(data, function(key, value) {
			  
				if(count >= 0 ){
					$('#'+field_id1).val(this.RMName);
				    $('#'+field_id2).val(this.Quantity1);
				    $('#'+field_id3).val(this.item_id);
				    // $('#'+field_id4).val(this.pending_qty);
				    // if(!this.pending_qty){
				    //     $('#'+field_id4).val(this.Quantity1);
				    // }
				    var z=0;
				    var x=this.pending_qty;
				    //console.log("x "+x);
				    var y=this.Quantity1;
				 //  console.log("y "+y);
				    if(x==null){
				        z =+y;
				    }else{
				        z =+x;
				    }
					
					var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12"> <input type="hidden" id="item_id_'+count+'" name="item_id_'+count+'" value="'+this.item_id+'"/>  <input class="form-control" type="text" id="RawMaterial'+count+'" name="RawMaterial'+count+'" value="'+this.RMName+'" readonly=""> </div></div></td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Quantity1'+count+'" name="Quantity1'+count+'" value="'+this.Quantity1+'" readonly=""> </div>  </div> </td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="pending_qty'+count+'" name="pending_qty'+count+'" value="'+z+'" readonly=""> </div>  </div> </td> '; 
newRowContent += '<td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Field2_'+count+'" name="Field2_'+count+'" value="'+(this.Field2 !== undefined ? this.Field2 : '')+'" ="" ; onkeypress="return onlynumbers(event)" onkeyup="accepted_value(this.id)" required> </div>  </div> </td> </tr>';
                     //console.log('hi',newRowContent);
					$("#tenderdetail2 tbody").append(newRowContent);
                    document.getElementById("maxCount").value= count;
				}
				count+=1;
			
			});
		}
	
 }, "json");  

}

function subcontract_matinward_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
    console.log('cv',columnvalue);
    $('#'+field_id1).val('');
    $.post(basePath + "/lib/ajax/subcontract_matinward.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		if(data.length){
			$.each(data, function(key, value) {
				
                $('#'+field_id1).val(this.AddressLine1);
			});
		}

 }, "json");  
    
}

function subcontract_address_Data(columnvalue,tablename1,selectcolumn1,selectcolumn2,field_id1,field_id2)
{
    //console.log('hi');
    $('#'+field_id1).val('');
    $('#'+field_id2).val('');
    $.post(basePath + "/lib/ajax/subcontract_address.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2}, function (data) {
		$('#'+field_id1).find('option').remove()
        $('#'+field_id2).find('option').remove()
		if(data.length){
			$('#'+field_id1).find('option').remove();
			 $('#'+field_id1).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');

                $('#'+field_id2).find('option').remove();
			 $('#'+field_id2).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');
			$.each(data, function(key, value) {
				 $('#'+field_id1).find('option')
				.end()
				.append('<option value="'+ value.pdnid +'">'+ value.PdnOrderNo +'</option>');

                $('#'+field_id2).find('option')
				.end()
				.append('<option value="'+ value.supplierid +'">'+ value.SupplierName +'</option>');
				
			});
		}

 }, "json");  
    
}	

function Fetch_dispatchsupply_child_Data(columnvalue,field_id1,field_id2,field_id3)
{
	var count=1;
	
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
	$('#'+field_id3).val('');
	//var ProductionID =$('#ProductionID').val()
    $.post(basePath + "/lib/ajax/dispatchsupply_child.php", {'ColumnValue': columnvalue}, function (data) {
	   $("#tenderdetail2 tbody").empty();
		if(data.length){
			$.each(data, function(key, value) {
			   
				if(count >= 1 ){
				    
				    var z=0;
				    var x=this.pending_qty;
				    //console.log("x "+x);
				    var y=this.Quantity;
				 //  console.log("y "+y);
				    if(x==null){
				        z =+y;
				    }else{
				        z =+x;
				    }

					var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12"> <input type="hidden" id="product_ID'+count+'" name="product_ID'+count+'" value="'+this.product_ID+'"/>  <input class="form-control" type="text" id="ProductName_'+count+'" name="ProductName_'+count+'" value="'+this.ProductName+'" readonly=""> </div></div></td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Quantity_'+count+'" name="Quantity_'+count+'" value="'+this.Quantity+'" readonly=""> </div>  </div> </td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="pending_qty'+count+'" name="pending_qty'+count+'" value="'+z+'" readonly=""> </div>  </div> </td> '; 
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="availablestock_'+count+'" name="availablestock_'+count+'" value="'+this.available_qty+'" readonly=""> </div>  </div> </td> '; 
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Field2_'+count+'" name="Field2_'+count+'" value="'+(this.Field2 !== undefined ? this.Field2 : '')+'" ="" ; onkeypress="return onlynumbers(event)" onkeyup="dispatchsupply_accepted_value(this.id);" required> </div>  </div> </td> </tr>';
                     //console.log('hi',newRowContent);
                     
					$("#tenderdetail2 tbody").append(newRowContent);
					 document.getElementById("maxCount").value= count;
				}
count +=1;				
			});
		}
	
 }, "json");  
 
 console.log("count intilaiz "+count)

}


// stock Adjustment start

    function add_disabled_ex(value,conditionval,subconditionval,IdToReflect){  /// apply disabled in some condition to particular id attribute
    
    if(value==conditionval){ 
       
        $('#'+IdToReflect).empty();
        $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
        $.post(basePath + "/lib/ajax/stock_adjustmenttempty_fetch.php", {'ColumnValue': conditionval}, function (data) {

		if(data.length){
			$.each(data, function(key, value) {

             

console.log("value", value['ID']);
console.log("value", value['EmpName']); // $('#mySelect').append("<option>BMW</option>")
                 $('#'+IdToReflect).append($('<option></option>').val(value['ID']).text(value['EmpName']))
				
			});
		}
	
 }, "json");   
    
// }
    }
    else
    {
        $('#'+IdToReflect).empty();
        $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');  

        $.post(basePath + "/lib/ajax/stock_adjustmenttempty_fetch.php", {'ColumnValue': subconditionval}, function (data) {

		if(data.length){
			$.each(data, function(key, value) {
				
                
                // $(IdToReflect).append($('<option></option>').val(this['ID']).text(this['EmpName']))

                $('#'+IdToReflect).append($('<option></option>').val(value['ID']).text(value['SupplierName']))
				
			});
		}
	
 }, "json");  


    }
} 

// 

function rawmaterialcat_Data(columnvalue,selectid1)
{
    console.log("run run");
    $('#'+selectid1).empty();
    $('#'+selectid1).val(null).trigger('change');

 $.post(basePath + "/lib/ajax/fetch_subcategory_data.php", {'ColumnValue': columnvalue}, function (data) {
    console.log("ajax output",data);
     ($('#'+selectid1).empty());
   
     $('#'+selectid1).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    $.each(data, function() {

        $('#'+selectid1).append($('<option></option>').val(this['ID']).text(this['RawMaterialSubType']))
    });
    
    // });
   
 }, "json");   
    
}

function rawmaterial_Data(columnvalue,selectid1)
{
    $('#'+selectid1).empty();
    $('#'+selectid1).val(null).trigger('change');
    console.log("run run");
 $.post(basePath + "/lib/ajax/fetch_rawmaterial_data.php", {'ColumnValue': columnvalue}, function (data) {  
     $('#'+selectid1).prepend('<option value="" disabled selected style="display:none;">Select</option>'); 
    $.each(data, function() {

        $('#'+selectid1).append($('<option></option>').val(this['ID']).text(this['RMName']))
    });
    
    // });
   
 }, "json");   
    
}

// 

// stock adjustment end

function Fetch_workorder_child_Data(columnvalue,tablename1,tablename2,selectcolumn1,selectcolumn2,selectcolumn3,selectcolumn4,selectcolumn5,field_id1,field_id2,field_id3,field_id4,field_id5)
{
	//console.log('hi');
	//console.log('hlo',tablename2);
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
    $('#'+field_id3).val('');
    $('#'+field_id4).val('');
    $('#'+field_id5).val('');
	
    $.post(basePath + "/lib/ajax/workorder_child.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2,'selectcolumn3':selectcolumn3,'selectcolumn5':selectcolumn5,'tablename2':tablename2,'selectcolumn4':selectcolumn4}, function (data) {
	   $("#tenderdetail tbody").empty();
		if(data.length){
			$.each(data, function(key, value) {
			   var count=0;
				if(count >= 0 ){
					$('#'+field_id1).val(this.RMName);
				    $('#'+field_id2).val(this.Quantity);
                    $('#'+field_id3).val(this.UnitName);
                    $('#'+field_id4).val(this.ProductName);
                    $('#'+field_id5).val(this.ProcessName);
					
					var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12">  <input class="form-control" type="text" id="RMName'+count+'" name="RMName'+count+'" value="'+this.RMName+'" readonly=""> </div></div></td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Quantity1'+count+'" name="Quantity1'+count+'" value="'+this.Quantity+'" readonly=""> </div>  </div> </td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="UnitName'+count+'" name="UnitName'+count+'" value="'+this.UnitName+'" readonly=""> </div>  </div> </td> </tr>';
                     //console.log('hi',newRowContent);
					$("#tenderdetail tbody").append(newRowContent);
				}
count++				
			});
		}
	
 }, "json");  

}

function add_emp_sub(value,conditionval,subconditionval,IdToReflect){  /// apply disabled in some condition to particular id attribute
   // console.log('val',value);
   // console.log('conv',conditionval);
    if(value==conditionval){ 
       //console.log('hi');
       
        $('#'+IdToReflect).empty();
        $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
        $.post(basePath + "/lib/ajax/employee_subcontractor_fetch.php", {'ColumnValue': conditionval}, function (data) {

		if(data.length){
			$.each(data, function(key, value) {

             

//console.log("value", value['ID']);
//console.log("value", value['EmpName']); // $('#mySelect').append("<option>BMW</option>")
                 $('#'+IdToReflect).append($('<option></option>').val(value['ID']).text(value['EmpName']))
				
			});
		}
	
 }, "json");   
    
// }
    }
    else
    {
       // console.log('hii');
        $('#'+IdToReflect).empty();
        $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');  

        $.post(basePath + "/lib/ajax/employee_subcontractor_fetch.php", {'ColumnValue': subconditionval}, function (data) {

		if(data.length){
			$.each(data, function(key, value) {
				
                
                // $(IdToReflect).append($('<option></option>').val(this['ID']).text(this['EmpName']))

                $('#'+IdToReflect).append($('<option></option>').val(value['ID']).text(value['SupplierName']))
				
			});
		}
	
 }, "json");  


    }
}

function workorder_product_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
    //console.log('hi',selectcolumn1);
    $('#'+field_id1).val('');
    $.post(basePath + "/lib/ajax/workorder_product.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		$('#'+field_id1).find('option').remove()
		if(data.length){
			$('#'+field_id1).find('option').remove();
			 $('#'+field_id1).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');

			$.each(data, function(key, value) {
				 $('#'+field_id1).find('option')
				.end()
				.append('<option value="'+ value.ID +'">'+ value.ProductName +'</option>');
				
			});
		}

 }, "json");  
    
}	

function workorder_process_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
    //console.log('sc1',selectcolumn1);
    $('#'+field_id1).val('');
    $.post(basePath + "/lib/ajax/workorder_process.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
		$('#'+field_id1).find('option').remove()
		if(data.length){
			$('#'+field_id1).find('option').remove();
			 $('#'+field_id1).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');

			$.each(data, function(key, value) {
				 $('#'+field_id1).find('option')
				.end()
				.append('<option value="'+ value.ID +'">'+ value.ProcessName +'</option>');
				
			});
		}

 }, "json");  
    
}	

function Fetch_workorder_raw_Data(columnvalue,field_id1,field_id2,field_id3,field_id4,field_id5)
{
    var count=1;
	//console.log('hi');
	//console.log('hlo',tablename2);
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
    $('#'+field_id3).val('');
    $('#'+field_id4).val('');
    $('#'+field_id5).val('');
	
    var product_ID =$('#product_ID').val();
    var NoofQuantity =$('#NoofQuantity').val();
    $.post(basePath + "/lib/ajax/workorder_raw.php", {'ColumnValue': columnvalue,'product_ID': product_ID}, function (data) {
	   $("#tenderdetail tbody").empty();
		if(data.length){
			$.each(data, function(key, value) {
			   
				if(count >= 0 ){
					$('#'+field_id1).val(this.RMName);
				    $('#'+field_id2).val(this.Quantity);
                    $('#'+field_id3).val(this.UnitName);
                    $('#'+field_id4).val(this.rawmaterial_ID);
                    $('#'+field_id5).val(this.unit_ID);
                   

                    
                 //   console.log('qua',NoofQuantity);
                    var Quantity2=(NoofQuantity*(this.Quantity));
                 //   console.log('qua1',Quantity2);
					
					var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12"> <input type="hidden" id="rawmaterial_ID'+count+'" name="rawmaterial_ID'+count+'" value="'+this.rawmaterial_ID+'"/>  <input class="form-control" type="text" id="RMName'+count+'" name="RMName'+count+'" value="'+this.RMName+'" readonly=""> </div></div></td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Quantity1'+count+'" name="Quantity1'+count+'" value="'+this.Quantity+'" readonly=""> </div>  </div> </td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Workorder_qty'+count+'" name="Workorder_qty'+count+'" value="'+ Quantity2 +'" readonly=""> </div>  </div> </td> ';
newRowContent += '<td> 	<div class="form-group"> <div class="col-sm-12"> <input type="hidden" id="unit_ID'+count+'" name="unit_ID'+count+'" value="'+this.unit_ID+'"/>  <input class="form-control" type="text" id="UnitName'+count+'" name="UnitName'+count+'" value="'+this.UnitName+'" readonly=""> </div>  </div> </td> </tr>';
                     //console.log('hi',newRowContent);
					$("#tenderdetail tbody").append(newRowContent);
			    	 document.getElementById("maxCount").value= count;
				}
count+=1;				
			});
		}
	
 }, "json");  

}

function dispatchsupply_address_Data(columnvalue,tablename1,selectcolumn1,field_id1)
{
        $('#'+field_id1).val('');
    $.post(basePath + "/lib/ajax/dispatchsupply_address.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1}, function (data) {
	
		if(data.length){
			$.each(data, function(key, value) {
				    $('#'+field_id1).val(this.BillingAddress1);
			});
		}
	
 }, "json");   
    
}	

function add_enable_workorder(value,conditionval,IdToReflect){ 
    //console.log('value',value);
     if(value==conditionval){
     //console.log('hi',value);		
         //$("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
         //$('#'+IdToReflect).prop({"enable":true}); 
         $('#'+IdToReflect).removeAttr('disabled');
     }else{
        $('#'+IdToReflect).prop({"disabled":true}).val(''); 
    }
 }

 function add_enable_workorder1(value,conditionval,IdToReflect){ 
    //console.log('value',value);
     if(value==conditionval){
     //console.log('hi',value);		
         //$("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
         //$('#'+IdToReflect).prop({"enable":true}); 
         $('#'+IdToReflect).removeAttr('disabled');
     }else{
        $('#'+IdToReflect).prop({"disabled":true}).val(''); 
    }
 }
 
 // raw material issue start
 
 function po_against_workorder(columnvalue,field_id1)
{
    console.log(columnvalue);
    $('#'+field_id1).empty();
    $('#'+field_id1).val(null).trigger('change'); // clear the Select2 select box

    $.post(basePath + "/lib/ajax/fetch_material_issue_workorder.php", {'ColumnValue': columnvalue}, function (data) {

        if(data.length){

            console.log(data);

            // add the 'Select' option to the Select2 select box
            var select2field = $('#'+field_id1);
            select2field.append('<option value="" disabled selected style="display:none;">Select</option>');
            select2field.trigger('change');

            $.each(data, function(key, value) { 

                // add each option to the Select2 select box
                var newOption = new Option(value.WorkOrderNo, value.ID, false, false);
                select2field.append(newOption).trigger('change');
            });
        }

    }, "json");   
}


function add_disabled_det(value,IdToReflect){  /// apply disabled in some condition to particular id attribute
    console.log('value',value);
     if(value){
     //console.log('hi',value);		
         //$("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
         //$('#'+IdToReflect).prop({"enable":true}); 
         $('#'+IdToReflect).removeAttr('disabled');
     }
 }
 
  function rawmaterial_issue_sub(columnvalue,tablename1,tablename2,tablename3,selectcolumn1,selectcolumn2,selectcolumn3,selectcolumn4,selectcolumn5,selectcolumn6,selectcolumn7,selectcolumn8,selectcolumn9,selectcolumn10,selectcolumn11,field_id1,field_id2,field_id3,field_id4,field_id5,field_id6,field_id7,field_id8,field_id9,field_id10,field_id11,field_id12,field_id13,field_id14,field_id15,field_id16)
{
    var count = 1;

    console.log("Works");
    $('#'+field_id1).val('');
		$('#'+field_id2).val('');
		$('#'+field_id3).val('');
		$('#'+field_id4).val('');
		$('#'+field_id5).val('');
		$('#'+field_id6).val('');
		$('#'+field_id7).val('');
		$('#'+field_id8).val('');
		$('#'+field_id9).val('');
		$('#'+field_id10).val('');
        $('#'+field_id11).val('');
        $('#'+field_id12).val('');
        $('#'+field_id13).val('');
        $('#'+field_id14).val('');
        $('#'+field_id15).val('');
        $('#'+field_id16).val('');
    $.post(basePath + "/lib/ajax/rawmaterial_issue_sub_fetch.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'tablename2':tablename2,'selectcolumn2':selectcolumn2,'selectcolumn3':selectcolumn3,'selectcolumn4':selectcolumn4,'selectcolumn5':selectcolumn5,'selectcolumn6':selectcolumn6,'selectcolumn7':selectcolumn7,'selectcolumn8':selectcolumn8,'selectcolumn9':selectcolumn9,'selectcolumn10':selectcolumn10,'tablename1':tablename1,'selectcolumn11':selectcolumn11}, function (data) {
        $("#rawmaterialissue_fetch tbody").empty();
		if(data.length){
			$.each(data, function(key, value) {
                console.log('count'+ count);
                if(count >= 0 ){
				$('#'+field_id1).val(this.ProcessName);
                $('#'+field_id13).val(this.ProcessID);
					$('#'+field_id2).val(this.ProductSize);
					$('#'+field_id3).val(this.Thickness);
					$('#'+field_id4).val(this.Colour);
					$('#'+field_id5).val(this.Design);
					$('#'+field_id6).val(this.NoofQuantity);
					$('#'+field_id7).val(this.CompletedDate);
					$('#'+field_id8).val(this.SequenceMaterialIssued);
					$('#'+field_id9).val(this.Details);
					$('#'+field_id10).val(this.Remarks);
                    $('#'+field_id11).val(this.EmpName);
                    $('#'+field_id15).val(this.EmployeeID);
                    if(!this.EmpName)
                    {
                        $('#'+field_id11).val(this.SupplierName);
                        $('#'+field_id15).val(this.Subcontractor_ID);
                    }
                    $('#'+field_id12).val(this.ProductName);
                    $('#'+field_id14).val(this.product_ID);
                    $('#'+field_id16).val(this.Status);
                   

                    // Auto Populate Reords Start

                    var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12"> <input type="hidden" id="rawmaterial_ID_'+count+'" name="rawmaterial_ID_'+count+'" value="'+this.rawmaterial_ID+'"/> <input class="form-control" type="text" id="RMName_'+count+'" name="RMName_'+count+'" value="'+this.RMName+'" readonly=""> </div></div></td> ';
                    newRowContent += '  <td>   <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Quantity2_'+count+'" name="Quantity2_'+count+'" value="'+this.Quantity2+'" readonly=""> </div>   </div>   </td>';
                    newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input type="hidden" id="unit_ID_'+count+'" name="unit_ID_'+count+'" value="'+this.unit_ID+'"/>  <input class="form-control" type="text" id="UnitName_'+count+'" name="UnitName_'+count+'" value="'+this.UnitName+'"  readonly=""> </div>  </div> </td>';
                    // 
                     newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="available_qty_'+count+'" name="available_qty_'+count+'" value="'+(this.available_qty !== undefined ? this.available_qty : '')+'" ="" readonly> </div>  </div> </td>';
                    newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="rmt_qty_'+count+'" name="rmt_qty_'+count+'" value="'+(this.rmt_qty !== undefined ? this.rmt_qty : '')+'" ="" readonly> </div>  </div> </td>';
                    // 
                    newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="issued_qty_'+count+'" name="issued_qty_'+count+'" value="'+(this.issued_qty !== undefined ? this.issued_qty : '')+'" ="" onkeyup= "nocopy(this.id);accepted_val_issue_raw(this.id);" onkeypress="return onlynumbers(event);" Required> </div>  </div> </td>';
                    newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="excess_qty_'+count+'" name="excess_qty_'+count+'" value="'+(this.excess_qty !== undefined ? this.excess_qty : '')+'" ="" readonly> </div>  </div> </td> </tr>';
                    // auto populate Records End
                     //console.log('hi',newRowContent);
                     $("#rawmaterialissue_fetch tbody").append(newRowContent);
                     document.getElementById("maxCount").value= count;
                    console.log("print value "+this.EmpName);

                }
                count++;
			});
		}
	
 }, "json");   
    
}

function accepted_val_issue_raw(selectid){
    // accepted_val_qc
  

    var poqty_rowid= selectid.split("_")[2];available_qty_1

    var acceptedqty=parseFloat(document.getElementById("issued_qty_" + poqty_rowid).value);

    var Quantity=document.getElementById("Quantity2_"+ poqty_rowid).value;
    var available_qty=document.getElementById("available_qty_"+ poqty_rowid).value;
    var rmtqty=parseFloat(document.getElementById("rmt_qty_"+ poqty_rowid).value);
    var addqty = acceptedqty + rmtqty;
    console.log("addqty "+addqty);
   var dtotoal= Quantity - addqty;
   console.log("dtotoal "+dtotoal);
    if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
         if(addqty<=Quantity){
            
                if(acceptedqty<=available_qty)
                {
                    document.getElementById("issued_qty_" + poqty_rowid).value=acceptedqty;
                    document.getElementById("excess_qty_" + poqty_rowid).value=dtotoal;
                }
                else{
                    document.getElementById("issued_qty_" + poqty_rowid).value="";
                    document.getElementById("issued_qty_" + poqty_rowid).focus();
                    document.getElementById("excess_qty_" + poqty_rowid).value="";
                    alert("Accepted Quantity should not be greater than Stock Qty");
                }
            

        //  document.getElementById("issued_qty_" + poqty_rowid).value=acceptedqty;
      }
      else 
      {
          document.getElementById("issued_qty_" + poqty_rowid).value="";
          document.getElementById("issued_qty_" + poqty_rowid).focus();
          alert("Accepted Quantity should not be greater than Transfer Qty");
          }
    }
    }
 // raw material issue end
 
 // Stock Adjustment Start
 
 function Fetch_stockadjust_Data(columnvalue,field_id1,field_id2)
{
   // console.log('columnvalue',columnvalue);

  //console.log('val');
    $('#'+field_id1).val('');
    $('#'+field_id2).val('');
		
 $.post(basePath + "/lib/ajax/stock_adjustment_fetch.php", {'ColumnValue': columnvalue}, function (data) {
	
		if(data.length){
			$.each(data, function(key, value) {
				$('#'+field_id1).val(this.batch_no);
                $('#'+field_id2).val(this.available_qty);
					
					
			});
		}
	
 }, "json");   
    
}


function stockadjustment_wrd(columnvalue,selectid1)
{
    console.log("run run");
 $.post(basePath + "/lib/ajax/stockadjust_wrds.php", {'ColumnValue': columnvalue}, function (data) {
    console.log("ajax output",data);
     ($('#'+selectid1).empty());
   
     $('#'+selectid1).prepend('<option value="" disabled selected style="display:none;">Select</option>');

    //  $.each(data, function(key, value) {

    //     console.log("run run "+ value[WorkOrderNo]);

    //     // $('#'+selectid1).append($('<option></option>').val(this['ID']).text(this['WorkOrderNo']));    
    //     $('#'+selectid1).append($('<option></option>').val(value['ID']).text(value['WorkOrderNo']))  
    $.each(data, function() {

        $('#'+selectid1).append($('<option></option>').val(this['ID']).text(this['WorkOrderNo']))
    });
    
    // });
   
 }, "json");   
    
}

function add_disabled_dett(value,IdToReflect){  /// apply disabled in some condition to particular id attribute
    //console.log('value',value);
     if(value){
     //console.log('hi',value);		
         //$("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
         //$('#'+IdToReflect).prop({"enable":true}); 
         $('#'+IdToReflect).removeAttr('disabled');
          document.getElementById("quantity_to_be_adjust").value="";
     }
}

function add_disabled_val(){

    var x= document.getElementById("adjustment_type").value;
    console.log("adjust"+ x);
    

      var quantity_to_be_adjust=parseFloat(document.getElementById("quantity_to_be_adjust").value);

      var availabel_qty=document.getElementById("availabel_qty").value;
      if(x == "2")
      {
      if(!(isNaN(quantity_to_be_adjust)) && quantity_to_be_adjust!='' && quantity_to_be_adjust!=0){
           if(quantity_to_be_adjust<=availabel_qty){
           document.getElementById("quantity_to_be_adjust").value=quantity_to_be_adjust;
        }else {
            document.getElementById("quantity_to_be_adjust").value="";
            document.getElementById("quantity_to_be_adjust").focus();
            // document.getElementById("pending_qty").value="";
            alert("Adjusted Quantity Greater Than Available Quantity ");
            }
      }
    }
   }
  
//stock adjustment End

//Inventory Transfer Start

function rawmtrl_agianst_batch_unit(columnvalue,idd,selectid1,selectid2,selectid3,selectid4)
{
    
console.log('columnvalue '+columnvalue);
console.log('idd '+idd);
console.log('selectid1  '+selectid1);
console.log('selectid2  '+selectid2);
console.log('selectid3  '+selectid2);
console.log('selectid4  '+selectid2);
 var splittedid=idd.split("_")[2];
 console.log('splittedid '+splittedid);
//  splittedid = 1;

 $.post(basePath + "/lib/ajax/rawmtrl_agianst_branch_and_unit.php", {'ColumnValue': columnvalue}, function (data) {

    console.log("ajax output",data);
     ($('#'+selectid1 +splittedid).empty());
     ($('#'+selectid2 +splittedid).empty());
     ($('#'+selectid3 +splittedid).empty());
      ($('#'+selectid4 +splittedid).empty());
    //  $('#'+field_id2).val('');
    //  $('#'+selectid1 +splittedid).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    //  $('#'+selectid2 +splittedid).prepend('<option value="" disabled selected style="display:none;">Select</option>');

     $.each(data, function(key, value) {

        // $('#'+selectid1 +splittedid).val(this['Grade'])
        console.log("id", value['ID']);
        console.log("value", value['UnitName']);

        $('#'+selectid1 +splittedid).val(this['batch_no']);
        // $('#'+selectid1 +splittedid).append('<option value="'+value['ID']+'" selected>'+value['batch_no']+'</option>');
        // $('#'+selectid2 +splittedid).append('<option value="'+value['ID']+'" selected>'+value['UnitName']+'</option>');
        $('#'+selectid2 +splittedid).val(this['UnitName']);
        $('#'+selectid3 +splittedid).val(this['unit']);
         $('#'+selectid4 +splittedid).val(this['available_qty']);
      
       
    });
   
 }, "json");   
    
}

function work_order_qty(columnvalue,field_id1)
{
    //console.log('cv',columnvalue);
    $('#'+field_id1).val('');
    $.post(basePath + "/lib/ajax/work_order_qty.php", {'ColumnValue': columnvalue}, function (data) {
		if(data.length){
			$.each(data, function(key, value) {
				
                $('#'+field_id1).val(this.Quantity);
			});
		}

 }, "json");  
    
}

function accepted_val_in(selectid,accepted_qty_){
    
    console.log("Enter The Accpted Qty hai" +accepted_qty_);
    console.log("Enter The Accpted Qty");
    console.log("Accpted Qty ID "+ selectid);

    var poqty_rowid= selectid.split("_")[2];

    console.log('poqty_rowid', poqty_rowid);

   
    var acceptedqty=parseFloat(document.getElementById("transfer_quantity_" + poqty_rowid).value);
    console.log('acceptedqty', acceptedqty);
    var transferqty=document.getElementById("availabel_stock_"+ poqty_rowid).value;
    console.log('transferqty', transferqty);

    if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
         if(acceptedqty<=transferqty){
         document.getElementById("transfer_quantity_" + poqty_rowid).value=acceptedqty;
      }else {
          document.getElementById("transfer_quantity_" + poqty_rowid).value="";
          document.getElementById("transfer_quantity_" + poqty_rowid).focus();
          alert("Transfer Quantity should not be greater than available Quantity Qty");
          }
    }
    }
    
function validateExistinventory(id,tableBodyId) {
        
            var Seee = id.split("_")[0];
            var spid = id.split("_")[1];
            var joinid = Seee + "_" + spid;
            var idid = id.split("_")[2];
        
            
            var selectedvalue = document.getElementById(id).value; 
          
            var count = document.getElementById(tableBodyId).getElementsByTagName("tr").length;
         
         
                if(count>=1)
                {
                   
                    for(i=1;i<=count;i++){
    
                        var rowvalue = document.getElementById(joinid+"_"+i).value; 
                      
                        if(selectedvalue == rowvalue && id != joinid+"_"+i)
                        {
                            document.getElementById(id).value="";
                            alert("Already Selected ");
                            document.getElementById('batch_no_' + idid).value="";
                            document.getElementById('availabel_stock_' + idid).value="";
                            document.getElementById('transfer_quantity_' + idid).value="";
                            document.getElementById('unit_' + idid).value="";
                          
                                        
                            break;
                        }
                    }
                }
            }

//Inventory Transfer End

// Matreial issue Consumabel Start

function Fetch_material_issue_Data(columnvalue,field_id1,field_id2,field_id3)
{
    var count=1;
	console.log('hi');
	//console.log('hlo',columnvalue);
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
    $('#'+field_id3).val('');
	
    $.post(basePath + "/lib/ajax/material_issue_fetch.php", {'ColumnValue': columnvalue}, function (data) {
	   $("#materialIssuetools tbody").empty();
		if(data.length){
			$.each(data, function(key, value) {
			
				if(count >= 1 ){
                
					$('#'+field_id1).val(this.EmpName);
                    if(!this.EmpName)
                    {
                        $('#'+field_id1).val(this.SupplierName);
                    }
				    $('#'+field_id2).val(this.EmployeeType);
                    $('#'+field_id3).val(this.Remarks);
                                                                                                        // onkeyup="$('#Value_1').val(($('#Quantitys_1').val() * $('#price_unit_1').val()).toFixed(2));total_pro()"
					var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12"><input type="hidden" id="Rawmaterial_ID_'+count+'" name="Rawmaterial_ID_'+count+'" value="'+this.Rawmaterial_ID+'"/>  <input class="form-control" type="text" id="RMName_'+count+'" name="RMName_'+count+'" value="'+this.RMName+'" readonly=""> </div></div></td> ';
newRowContent += '  <td>   <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="Quantity_'+count+'" name="Quantity_'+count+'" value="'+this.Quantity+'" readonly=""> </div>   </div>   </td>';
// 
newRowContent += '  <td>   <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="available_qty_'+count+'" name="available_qty_'+count+'" value="'+this.available_qty+'" readonly=""> </div>   </div>   </td>';
newRowContent += '  <td>   <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="issue_qty_'+count+'" name="issue_qty_'+count+'" value="'+this.issue_qty+'" readonly=""> </div>   </div>   </td>';

// 
newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="issued_qty_'+count+'" name="issued_qty_'+count+'" value="'+(this.issued_qty !== undefined ? this.issued_qty : '')+'" =""  onkeyup="nocopy(this.id);rawmt_issue(this.id);" onkeypress="return onlynumbers(event);" Required> </div> </div> </td>'; 
// newRowContent += '  <td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="transfer_quantity'+count+'" name="transfer_quantity'+count+'" value="'+this.transfer_quantity+'" readonly=""> </div>  </div> </td>';
//pending newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="pending_qty_'+count+'" name="pending_qty_'+count+'" value="'+(this.pending_qty !== undefined ? this.pending_qty : '')+'" =""  readonly=""> </div>  </div> </td>';
// newRowContent += '  <td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="accepted_qty'+count+'" name="accepted_qty'+count+'" value="'+this.accepted_qty+'" =""> </div>  </div> </td>';
newRowContent += '  <td> 	<div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="UnitName_'+count+'" name="UnitName_'+count+'" value="'+this.UnitName+'" readonly=""> </div>  </div> </td> </tr>';
                     //console.log('hi',newRowContent);
					$("#materialIssuetools tbody").append(newRowContent);
                    document.getElementById("maxCount").value= count;
                    
				}
                count++;
// count++				
			});
		}
	
 }, "json");   
    
}


function rawmt_issue(selectid){

  console.log("Enter ISSue");

    var poqty_rowid= selectid.split("_")[2];

    console.log('poqty_rowid', poqty_rowid);

   
    var acceptedqty=parseFloat(document.getElementById("issued_qty_" + poqty_rowid).value);
    console.log('acceptedqty', acceptedqty);
     var issueqty=parseFloat(document.getElementById("issue_qty_" + poqty_rowid).value);
      var avilableqty=parseFloat(document.getElementById("available_qty_" + poqty_rowid).value);
    var transferqty=parseFloat(document.getElementById("Quantity_"+ poqty_rowid).value);
    console.log('transferqty', transferqty);
    var addqty = acceptedqty + issueqty;

    if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
         if(acceptedqty<=transferqty && acceptedqty<=issueqty){
             if(acceptedqty<=avilableqty)
             {
                 document.getElementById("issued_qty_" + poqty_rowid).value=acceptedqty;
             }
             else {
          document.getElementById("issued_qty_" + poqty_rowid).value="";
          document.getElementById("issued_qty_" + poqty_rowid).focus();
        //   document.getElementById("pending_qty_" + poqty_rowid).value="";
          alert("Issued Quantity should not be greater than Stock Available Qty");
          }
         
      }else {
          document.getElementById("issued_qty_" + poqty_rowid).value="";
          document.getElementById("issued_qty_" + poqty_rowid).focus();
        //   document.getElementById("pending_qty_" + poqty_rowid).value="";
          alert("Issued Quantity should be greater than Requested Qty");
          }
    }
 }

// Material Issue Cpnsumabel End

// Qc Inventory Transfer Start

function Fetch_qcinventory_transfer_Data(columnvalue,tablename1,selectcolumn1,selectcolumn2,field_id1,field_id2)
{
    var count = 1; // initialize count variable outside the loop
    $('#'+field_id1).val('');
    $('#'+field_id2).val('');

    
    $.post(basePath + "/lib/ajax/qcinventory_transfer.php", {'ColumnValue': columnvalue,'tablename1':tablename1,'selectcolumn1':selectcolumn1,'selectcolumn2':selectcolumn2}, function (data) {
        $("#qcinventorytransfer tbody").empty();
       
        if(data.length){
            $.each(data, function(key, value) {
                console.log('count'+ count);
                if(count >= 0 ){
                    // $('#'+field_id1).val(this.from_warehouse);
                    // $('#'+field_id2).val(this.to_warehouse);
                     $('#'+field_id1).val(this.from_title);
                    $('#'+field_id2).val(this.to_title);
                    // count =count+1;
                    var newRowContent = '<tr><td><div class="form-group"><div class="col-sm-12"> <input type="hidden" id="item_name_'+count+'" name="item_name_'+count+'" value="'+this.item_name+'"/> <input class="form-control" type="text" id="RMName_'+count+'" name="RMName_'+count+'" value="'+this.RMName+'" readonly=""> </div></div></td> ';
                    newRowContent += '  <td>   <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="batch_no_'+count+'" name="batch_no_'+count+'" value="'+this.batch_no+'" readonly=""> </div>   </div>   </td>';
                   newRowContent += '  <td> <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="available_qty_'+count+'" name="available_qty_'+count+'" value="'+this.available_qty+'" readonly=""> </div> </div> </td>'; 
                    newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="transfer_quantity_'+count+'" name="transfer_quantity_'+count+'" value="'+this.transfer_quantity+'" readonly=""> </div>  </div> </td>';
                    newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input class="form-control" type="text" id="accepted_qty_'+count+'" name="accepted_qty_'+count+'" value="'+(this.accepted_qty !== undefined ? this.accepted_qty : '')+'" ="" onkeyup= "nozero(this.id);accepted_val(this.id);" required> </div>  </div> </td>';
                    newRowContent += '  <td>  <div class="form-group"> <div class="col-sm-12">  <input type="hidden" id="unit_id_'+count+'" name="unit_id_'+count+'" value="'+this.unit_id+'"/><input class="form-control" type="text" id="UnitName_'+count+'" name="UnitName_'+count+'" value="'+this.UnitName+'" readonly=""> </div>  </div> </td> </tr>';
                    //console.log('hi',newRowContent);
                    $("#qcinventorytransfer tbody").append(newRowContent);
                    document.getElementById("maxCount").value= count;
                    
                }
                count++;
            });
        }
    
    }, "json");   

    // console.log('count FInall'+ count);
    
}

function accepted_val(selectid,accepted_qty_){
    
    console.log("Enter The Accpted Qty hai" +accepted_qty_);
    console.log("Enter The Accpted Qty");
    console.log("Accpted Qty ID "+ selectid);

    var poqty_rowid= selectid.split("_")[2];

    console.log('poqty_rowid', poqty_rowid);

   
    var acceptedqty=parseFloat(document.getElementById("accepted_qty_" + poqty_rowid).value);
    console.log('acceptedqty', acceptedqty);
    var transferqty=document.getElementById("transfer_quantity_"+ poqty_rowid).value;
    console.log('transferqty', transferqty);

    if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
         if(acceptedqty<=transferqty){
         document.getElementById("accepted_qty_" + poqty_rowid).value=acceptedqty;
      }else {
          document.getElementById("accepted_qty_" + poqty_rowid).value="";
          document.getElementById("accepted_qty_" + poqty_rowid).focus();
          alert("Accepted Quantity should not be greater than Transfer Qty");
          }
    }
    }
    
   function accepted_value(selectid){
       //console.log('hii');
    
    // console.log("Enter The Accpted Qty hai" +accepted_qty_);
    // console.log("Enter The Accpted Qty");
    // console.log("Accpted Qty ID "+ selectid);

    var poqty_rowid= selectid.split("_")[1];

   // console.log('poqty_rowid', poqty_rowid);

   
    var acceptedqty=parseFloat(document.getElementById("Field2_" + poqty_rowid).value);
    //console.log('acceptedqty', acceptedqty);
    var transferqty=document.getElementById("pending_qty"+ poqty_rowid).value;
   // console.log('transferqty', transferqty);

    if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
         if(acceptedqty<=transferqty){
         document.getElementById("Field2_" + poqty_rowid).value=acceptedqty;
      }else {
          document.getElementById("Field2_" + poqty_rowid).value="";
          document.getElementById("Field2_" + poqty_rowid).focus();
          alert("Delivered Quantity should not be greater than Pending Qty");
          }
    }
    }
    
     function dispatch_returnable_accepted_value(selectid){
       console.log('hiii');
    
    // console.log("Enter The Accpted Qty hai" +accepted_qty_);
    // console.log("Enter The Accpted Qty");
    // console.log("Accpted Qty ID "+ selectid);

    var poqty_rowid= selectid.split("_")[1];

   // console.log('poqty_rowid', poqty_rowid);

   
    var acceptedqty=parseFloat(document.getElementById("Field3_" + poqty_rowid).value);
    //console.log('acceptedqty', acceptedqty);
    var transferqty=document.getElementById("Field4_"+ poqty_rowid).value;
   // console.log('transferqty', transferqty);

    if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
         if(acceptedqty<=transferqty){
         document.getElementById("Field3_" + poqty_rowid).value=acceptedqty;
      }else {
          document.getElementById("Field3_" + poqty_rowid).value="";
          document.getElementById("Field3_" + poqty_rowid).focus();
          alert("Quantity should not greater than Available Stock");
          }
    }
    }
    
   function dispatchsupply_accepted_value(selectid){
       //console.log('hii');
    
    // console.log("Enter The Accpted Qty hai" +accepted_qty_);
    // console.log("Enter The Accpted Qty");
    // console.log("Accpted Qty ID "+ selectid);

    var poqty_rowid= selectid.split("_")[1];

   // console.log('poqty_rowid', poqty_rowid);

   
    var acceptedqty=parseFloat(document.getElementById("Field2_" + poqty_rowid).value);
    //console.log('acceptedqty', acceptedqty);
    var transferqty=document.getElementById("availablestock_"+ poqty_rowid).value;
     var transferqty1=document.getElementById("pending_qty"+ poqty_rowid).value;
   // console.log('transferqty', transferqty);

    if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
         if(acceptedqty<=transferqty){
              if(acceptedqty<=transferqty1){
         document.getElementById("Field2_" + poqty_rowid).value=acceptedqty;
              }
              else {
          document.getElementById("Field2_" + poqty_rowid).value="";
          document.getElementById("Field2_" + poqty_rowid).focus();
          alert("Issued Quantity should not be greater than  Pending Quantity");
          }
      }else {
          document.getElementById("Field2_" + poqty_rowid).value="";
          document.getElementById("Field2_" + poqty_rowid).focus();
          alert("Issued Quantity should not be greater than Available fgstock");
          }
          
    //       if(!(isNaN(acceptedqty)) && acceptedqty!='' && acceptedqty!=0){
    //      if(acceptedqty<=transferqty1){
    //      document.getElementById("accepted_qty_" + poqty_rowid).value=acceptedqty;
    //   }else {
    //       document.getElementById("Field2_" + poqty_rowid).value="";
    //       document.getElementById("Field2_" + poqty_rowid).focus();
    //       alert("Issued Quantity should not be greater than Quantity");
    //       }
    // }
    }
    
    }

// Qc Inventory Transfer Detail

function discount_percent()
{
    var DiscountPercent =parseFloat($('#DiscountPercent').val());
    if(DiscountPercent>100)
    {
        alert('Please Enter Discount Percent less than (or) Equal to 100');
        var Discount=0;
        $('#DiscountPercent').val(Discount);
        $('#DiscountAmount').val(Discount);
    }
}

function discount_percent1()
{
    var DiscountPercent =parseFloat($('#DiscountPercent').val());
    if(isNaN(DiscountPercent))
    {
        var Discount=0;
        $('#DiscountAmount').val(Discount);
    }
}

function Fetch_premium_freight_Data(columnvalue,field_id1,field_id2,field_id3)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);
	
    $('#'+field_id1).val('');
	$('#'+field_id2).val('');
    $('#'+field_id3).val('');
	
    $.post(basePath + "/lib/ajax/premium_freight.php", {'SupplierID': columnvalue}, function (data) {
	  $('#'+field_id2).find('option').remove()
		if(data.length){
			$('#'+field_id2).find('option').remove();
			 $('#'+field_id2).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');
			$.each(data, function(key, value) {
				$('#'+field_id1).val(this.PurchaseOrderNo);	
                $('#'+field_id3).val(this.DispatchDate);	
         
				 $('#'+field_id2).find('option')
				.end()
				.append('<option value="'+ value.rawmaterialid +'">'+ value.RMName +'</option>');				
				
			});
		}
	
 }, "json");   
    
}

function Fetch_rework_report_Data(columnvalue,field_id1)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);

	$('#'+field_id1).val('');
	
    $.post(basePath + "/lib/ajax/rework_report.php", {'product_ID': columnvalue}, function (data) {
	  $('#'+field_id1).find('option').remove()
		if(data.length){
			$('#'+field_id1).find('option').remove();
			 $('#'+field_id1).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');
			$.each(data, function(key, value) {
         
				 $('#'+field_id1).find('option')
				.end()
				.append('<option value="'+ value.ID +'">'+ value.SupplierName +'</option>');				
				
			});
		}
	
 }, "json");   
    
}

function Fetch_DisRet_report_Data(columnvalue,field_id1)
{
	//console.log('hi');
	//console.log('hlo',columnvalue);

	$('#'+field_id1).val('');
	
    $.post(basePath + "/lib/ajax/DisRet_report.php", {'ProductionID': columnvalue}, function (data) {
	  $('#'+field_id1).find('option').remove()
		if(data.length){
			$('#'+field_id1).find('option').remove();
			 $('#'+field_id1).find('option')
				.end()
				.append('<option value="" disabled selected style="display:none;">Select</option>');
			$.each(data, function(key, value) {
         
				 $('#'+field_id1).find('option')
				.end()
				.append('<option value="'+ value.ID +'">'+ value.ProductName +'</option>');				
				
			});
		}
	
 }, "json");   
    
}

// fieldfailure start and QDC
function raw_against_id(columnvalue,field_id1)
{
        $('#'+field_id1).val('');
    $.post(basePath + "/lib/ajax/field_failure_ajax.php", {'ColumnValue': columnvalue}, function (data) {
	
		if(data.length){
			$.each(data, function(key, value) {
				    $('#'+field_id1).val(this.ID);
			});
		}
	
 }, "json");   
    
}

function production_order_matdetails(columnvalue,field_id1,field_id2)
{
        $('#'+field_id1).val('');
        $('#'+field_id2).val('');
    $.post(basePath + "/lib/ajax/production_order_matdetails.php", {'ColumnValue': columnvalue}, function (data) {
	
		if(data.length){
			$.each(data, function(key, value) {
				    $('#'+field_id1).val(this.ResinType);
                    $('#'+field_id2).val(this.seq);
			});
		}
	
 }, "json");   
    
}

function toggleContent() {
    var contentDiv = document.getElementById("moreContent");
    var button = document.getElementById("moreButton");
  
    if (contentDiv.style.display === "none") {
      contentDiv.style.display = "block";
      button.innerHTML = "Show less";
    } else {
      contentDiv.style.display = "none";
      button.innerHTML = "Show more";
    }
  }

function supplier_against_po(columnvalue,field_id1)
{
    console.log(columnvalue);
    $('#'+field_id1).empty();
    // $('#'+field_id2).empty();
    $('#'+field_id1).val(null).trigger('change'); // clear the Select2 select box

    $.post(basePath + "/lib/ajax/supplier_pono_fetch.php", {'ColumnValue': columnvalue}, function (data) {

        if(data.length){

            console.log(data);

            // add the 'Select' option to the Select2 select box
            var select2field = $('#'+field_id1);
            select2field.append('<option value="" disabled selected style="display:none;">Select</option>');
            select2field.trigger('change');

            $.each(data, function(key, value) { 

                // add each option to the Select2 select box
                var newOption = new Option(value.PurchaseOrderNo, value.ID, false, false);
                select2field.append(newOption).trigger('change');
                // $('#'+field_id2).val(this.AuditDateTime);

            });
        }

    }, "json");   
}

function po_against_date(columnvalue,field_id1)
{
    // console.log('cv',columnvalue);
    $('#'+field_id1).val('');
    $.post(basePath + "/lib/ajax/po_against_date_fetch.php", {'ColumnValue': columnvalue}, function (data) {
		if(data.length){
			$.each(data, function(key, value) {
				
                $('#'+field_id1).val(this.AuditDateTime);
			});
		}

 }, "json");  
    
}
// fieldfailue end

 function Rawmaterial_Agianst_stock(columnvalue,dispid1,dispid2)
    {
  //  console.log('hiii',columnvalue);
    var rowid= dispid1.split("_")[1];
      
    $.post(basePath + "/lib/ajax/get_rawmtrl_agianst_stock.php", {'ColumnValue': columnvalue}, function (data) {
    $('#'+dispid2+rowid).empty();
    
    $.each(data, function() {
        
        $('#'+dispid2+rowid).val(this['available_qty']);
        
    });
   
    }, "json");   
    
    }
    
    
    // 
//      function disableSelect() {
//     var selectBox = document.getElementById("from_warehouse");
//     selectBox.disabled = true;
//   }

//   function makeSelectReadOnly() {
//     var selectBox = document.getElementById("from_warehouse");
//     selectBox.readOnly = true;
//   }
  
//       function disableSelectt() {
//     var selectBox = document.getElementById("to_warehouse");
//     selectBox.disabled = true;
//   }

//   function makeSelectReadOnlyy() {
//     var selectBox = document.getElementById("to_warehouse");
//     selectBox.readOnly = true;
//   }

function hideSelect() {
    var selectBox = document.getElementById("from_warehouse");
    selectBox.style.display = "none";
  }

  function showSelect() {
    var selectBox = document.getElementById("from_warehouse");
    selectBox.style.display = "block";
  }
  
  function hideSelectt() {
    var selectBox = document.getElementById("to_warehouse");
    selectBox.style.display = "none";
  }

  function showSelectt() {
    var selectBox = document.getElementById("to_warehouse");
    selectBox.style.display = "block";
  }
    // 
