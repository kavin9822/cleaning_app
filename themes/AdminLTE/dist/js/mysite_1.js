/*
 * remember email,password after clicking check box
 * 
 */
// function setCookie(cname,cvalue,exdays) {
//     var d = new Date();
//     d.setTime(d.getTime() + (exdays*24*60*60*1000));
//     var expires = "expires=" + d.toGMTString();
//     document.cookie = cname+"="+cvalue+"; "+expires;
// }

// function getCount(type=null) {
//     if(type=='noclone'){
       
//     var counting  = $('#showData tr:last').find("td:first").find("input").attr('id');
//      var result = counting.split("_")[1];
//     }else{
    
//     var counting  = $('#invoice_listing_table tr:last').attr('id');
//     var result = counting.split("_")[3];

//     }
    
//   // console.log(result);
//     $('#maxCount').val(result);
// }

// function getCookie(cname) {
//     var name = cname + "=";
//     var ca = document.cookie.split(';');
//     for(var i=0; i<ca.length; i++) {
//         var c = ca[i];
//         while (c.charAt(0)==' ') {
//             c = c.substring(1);
//         }
//         if (c.indexOf(name) == 0) {
//             return c.substring(name.length, c.length);
//         }
//     }
//     return "";
// }

// function delCookie(cname)
// {
//     if(getCookie(cname))
//     {
//         document.cookie = "cname=; expires=Thu, 01 Jan 1970 00:00:00 UTC"; 
//     }
// }

// function checkCookie() {    
//          var user = getCookie("user_email");
//          var pass = getCookie("user_pass");
//     if (user != "" && user != null && pass != "" && pass != null)
//     {
//         document.getElementById("user_email").value = user;
//         document.getElementById("user_pass").value = pass;
//         document.getElementById("remember_me").checked = true;
//     }       
// }

// function toggle() { 
// if(document.getElementById("remember_me").checked == true){
//         var fieldValue1 = document.getElementById("user_email").value;
//         var fieldValue2 = document.getElementById("user_pass").value; 
//         setCookie("user_email",fieldValue1,365);
//         setCookie("user_pass",fieldValue2,365);  
//     }
//     else{
//         delCookie("user_email");
//         delCookie("user_pass");    
//     } 
// }


// /*
//  * ping and get ip status
//  * 
//  */

// function pingIp(basePath, ID) {
//     var ip = $('#' + ID).val();
//     $.post(basePath + "/lib/ajax/ping_check.php", {'ip': ip}, function (data) {
//      alert(data);
        
//     });
// }


// /*
//  * same address 
//  * 
//  */

// function sameAddress() {
//     document.getElementById('SAddress').innerHTML = document.getElementById('Address').value;
//     document.getElementById('SCity').value = document.getElementById('City').value;
//     document.getElementById('SPincode').value = document.getElementById('Pincode').value;
//     document.getElementById('SState').value = document.getElementById('State').value;
//     document.getElementById('SCountry').value = document.getElementById('Country').value;
// }

// /*
//  * ID - refers column name
//  * 
//  */
// function ManageQueryFilter(refTable, basePath, ID, DT) {
//     var svalue = $('#' + ID).val();
//     $.post(basePath + "/ajax_fd.php", {'table_name': refTable, 'column_name': ID, 'seach_value': svalue, 'dtype': DT}, function (data) {
// 	//alert(data);
//         location.reload(true);
//     });
// }




// function ManageDateQueryFilter(refTable, basePath, ColName, DT) {

//     var df = $('#date_from').val();
//     var dt = $('#date_to').val();

//     var svalue = '`' + ColName + '` BETWEEN "' + df + '" AND "' + dt + '"';
	
//     //alert(svalue);
//     $.post(basePath + "/ajax_fd.php", {'table_name': refTable, 'column_name': ColName, 'seach_value': svalue, 'dtype': DT}, function (data) {
//         //alert(data);    
//         location.reload(true);
//     });
// }


// //Global id count
// var count = 2;
// function addRow() {

//     //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
//     var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + count});

//     //x.find('#Invoice_data_entry_1').attr({id: "Invoice_data_entry_"+ count}); 
//     x.find('#ItemNo_1').val('');
//     if ($('#ItemNo_1').length) {
//         x.find('#ItemNo_1').attr({id: "ItemNo_" + count, name: "ItemNo_" + count});
//     }
//     x.find('#RMName_1').val('');
//     x.find('#RMName_1').attr({id: "RMName_" + count, name: "RMName_" + count});
    
//     x.find('#Amount_1').val('');
//     x.find('#Amount_1').attr({id: "Amount_" + count, name: "Amount_" + count});
//     x.find('#Quantity_1').val('');
//     x.find('#Quantity_1').attr({id: "Quantity_" + count, name: "Quantity_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Quantity_" + count + "').val() * $('#Rate_" + count + "').val()).toFixed(2))"});
//     x.find('#Rate_1').val('');
//     x.find('#Rate_1').attr({id: "Rate_" + count, name: "Rate_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Quantity_" + count + "').val() * $('#Rate_" + count + "').val()).toFixed(2))"});
    
//     //Note_1
//     x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove()"});

//     x.appendTo('#invoice_listing_table');
//     count++;
// }

// /////////////////////////////////////////////////////////////////////////////

// function subtotal() {
//     var subTotal = 0;

//     for (i = 1; i < count; i++) {
//         if ($('#Amount_' + i).length) {
//             subTotal += parseFloat($('#Amount_' + i).val());
//         }
//     }

//     $('#subTotal').html(subTotal);

//     //var rebate = parseFloat($('#Rebate').val());
    
//     //var subTotal = subTotal - rebate;

//     //var tp = parseFloat($('#taxPercent').val());

//     //var tax_amount = ((subTotal * tp) / 100);

//     //$('#tax').html(tax_amount.toFixed(2));

//     //var BillAmount = Math.round((subTotal + tax_amount)-rebate);
//     var BillAmount = Math.round(subTotal);

//     $('#Total').html(BillAmount.toFixed(2));
//     $('#BillAmount').val(BillAmount.toFixed(2));
//     $('#maxCount').val(count);
    
// }

// //Global id count
// var counter = 2;
// function addRow_pac() {

//     //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
//     var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + counter});

//   console.log(x);
//     if ($('#PackageId_1').length) {
//         x.find('#PackageId_1').attr({id: "PackageId_" + counter, name: "PackageId_" + counter, onchange :"$('#Amount_" + counter + "').val($('#PackageId_"+ counter +"').find(':selected').data('id'))"});
//     }
    
//     //StartDate_1
//     if ($('#StartDate_1').length) {
//         x.find('#StartDate_1').attr({id: "StartDate_" + counter, name: "StartDate_" + counter});
//     }
//     //EndDate_1
//     if ($('#EndDate_1').length) {
//         x.find('#EndDate_1').attr({id: "EndDate_" + counter, name: "EndDate_" + counter});
//     }
    
//     //Note_1
//     x.find('#Note_1').attr({id: "Note_" + counter, name: "Note_" + counter});
//     x.find('#Amount_1').attr({id: "Amount_" + counter, name: "Amount_" + counter});
//     x.find('#REM_1').attr({id: "REM_" + counter, name: "REM_" + counter, onclick: "$('#Invoice_data_entry_" + counter + "').remove()"});

//     x.appendTo('#invoice_listing_table');
//     counter++;
// }

// function subtotal_pac() {
//     var subTotal = 0;

//     for (i = 1; i < counter; i++) {
//         if ($('#Amount_' + i).length) {
//             subTotal += parseFloat($('#Amount_' + i).val());
//         }
//     }

//     $('#subTotal').html(subTotal);

//     var rebate = parseFloat($('#Rebate').val());

//     //var subTotal = subTotal - rebate;

//     var cgstTp = parseFloat($('#cgstTaxPercent').val());

//     var cgst_amount = ((subTotal * cgstTp) / 100);
    
//     var sgstTp = parseFloat($('#sgstTaxPercent').val());

//     var sgst_amount = ((subTotal * sgstTp) / 100);

//     $('#cgstTax').html(cgst_amount.toFixed(2));
    
//     $('#sgstTax').html(sgst_amount.toFixed(2));

//     var BillAmount = Math.round((subTotal + cgst_amount + sgst_amount ) - rebate);
      
//     $('#Total').html(BillAmount.toFixed(2));
//     $('#BillAmount').val(BillAmount.toFixed(2));
    
//     $('#maxCount').val(counter);

// }

// ////////////////////////////////////////////////////
// function hideFormElem() {
//     var cstTypeStr = $('#customertype_ID :selected').val();

//     if (cstTypeStr == 1 || cstTypeStr == 2) {
//         document.getElementById("MDate").disabled = true;
//         $('#MTime').prop("readonly", true);
//         $('#Remark').prop("readonly", true);

//     }

//     if (cstTypeStr == 3) {
//         document.getElementById("MDate").disabled = false;
//         $('#MTime').prop("readonly", false);
//         $('#Remark').prop("readonly", false);
//     }
// }
// ///////////////////////////////////////////////////

// function subtotal_pe() {
//     var subTotal = 0;

//     for (i = 1; i < count; i++) {
//         if ($('#Amount_' + i).length) {
//             subTotal += parseFloat($('#Amount_' + i).val());
//         }
//     }

//     $('#subTotal').html(subTotal);

//     var rebate = parseFloat($('#rebate').val());
    
//     var FreightAmount = parseFloat($('#FreightAmount').val());	
	
//     //var subTotal = subTotal - rebate;

//     var tp = parseFloat($('#taxPercent').val());

//     var tax_amount = ((subTotal * tp) / 100);

//     $('#tax').html(tax_amount.toFixed(2));

//     var BillAmount = Math.round(((subTotal + tax_amount) + FreightAmount));

//     $('#Total').html(BillAmount.toFixed(2));
//     $('#BillAmount').val(BillAmount.toFixed(2));
//      $('#maxCount').val(count);

// }


// function subtotal_po() {
//     var subTotal = 0;
//     if( $("#invoice_listing_table  tr").length=='1'){
//      var countingz  = $("#invoice_listing_table  tr").attr("id");    
//      }else{
//      var countingz  = $("#invoice_listing_table  tr:last").attr("id");
//      }
//      var result = countingz.split("_")[3];
//      console.log(result);

//     for (i = 1; i <= result; i++) {
//         if ($('#Amount_' + i).length) {
//             subTotal += parseFloat($('#Amount_' + i).val());
//         }
//     }
//     $('#subTotal').html(subTotal);
//      var gst = parseFloat($('#gst').val());
//      var tax_amount = ((subTotal * gst) / 100);
     
//       $('#tax').html(tax_amount.toFixed(2));
      
//       $('#gst').html(tax_amount.toFixed(2));

//     //var BillAmount = Math.round(subTotal + tax_amount);
//     var BillAmount =(subTotal + tax_amount);
    
//     // count= $('#maxCount').val();
//     // for (i = 1; i < count; i++) {
//     //     if ($('#Amount_' + i).length) {
//     //         subTotal += parseFloat($('#Amount_' + i).val());
//     //     }
//     // }
//     $('#tax').val(tax_amount.toFixed(2));
//     $('#Total').html(BillAmount.toFixed(2));
//     $('#BillAmount').val(BillAmount.toFixed(2));
//     $('#maxCount').val(result);

// }
// ///////////////////////////////////////////////////


// //Global id count
// var counting = 2;
// function addRow_lbr() {

//     //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
//     var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + counting });
    
//     //Note_1
//     x.find('#Note_1').attr({id: "Note_" + counting , name: "Note_" + counting});
//     x.find('#Amount_1').attr({id: "Amount_" + counting , name: "Amount_" + counting});
//     x.find('#REM_1').attr({id: "REM_" + counting , name: "REM_" + counting , onclick: "$('#Invoice_data_entry_" + counting + "').remove()"});

//     x.appendTo('#invoice_listing_table');
//     counting++;
// }

// function subtotal_lbr() {
//     var subTotal = 0;

//     for (i = 1; i < counting; i++) {
//         if ($('#Amount_' + i).length) {
//             subTotal += parseFloat($('#Amount_' + i).val());
//         }
//     }

//     $('#subTotal').html(subTotal);

//     var rebate = parseFloat($('#rebate').val());

//     //var subTotal = subTotal - rebate;

//     var tp = parseFloat($('#taxPercent').val());

//     var tax_amount = ((subTotal * tp) / 100);

//     $('#tax').html(tax_amount.toFixed(2));

//     var BillAmount = Math.round((subTotal + tax_amount) - rebate);
    

    
//     $('#Total').html(BillAmount.toFixed(2));
//     $('#BillAmount').val(BillAmount.toFixed(2));
    
//     $('#maxCount').val(counting);

// }

// ///////////////////////////////////////////////////////////////////////////////////

// function ycsdate(id){
// //$('#'+id).datetimepicker({ 
// //    useCurrent: false,
// //   format: 'YYYY-MM-DD',
// //});
// $('#'+id).datetimepicker({});
// $('#'+id).datetimepicker().on('dp.show', function() {
//   $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
// }).on('dp.hide', function() {
//   $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
// });
// }

// /////////////////////////////////////////////////////////////////////////////////
// function ycstime() {
// $('#timepicker').datetimepicker({
//   useCurrent: false,
//   format: 'HH:mm'              
// });
// }

// /////////////////////////////////////////////////////////////////////////////////

// function ycsdatetime() {
// $('#datetimepicker').datetimepicker({
//   useCurrent: false,
//   format: 'YYYY-MM-DD HH:mm'              
// });
// }

// //////////////////////////////////////////////////////////////////////////////////

// //////////////////////////////////////////////////////////////////////////////////

// function hideFormElemStat() {
//     var cstTypeStr = $('#CurrentStatus  :selected').val();
        
//     if (cstTypeStr == 'Open' || cstTypeStr == 'InProgress') {     
// 		$('#SrCloseDate').prop("disabled", true );			
// 		$('#timepicker1').prop("disabled", true);
// 		$('#Remark').prop("disabled", true);
//     }
//     if (cstTypeStr == 'Closed') {
// 		$('#SrCloseDate').prop("disabled", false);		
// 		$('#timepicker1').prop("disabled", false);
//         	$('#Remark').prop("disabled", false);
//     }
    
// }

// function hidemyFormEleStat() {
// var cstTypeStr = $('#CurrentStatus :selected').val();
// 	if (cstTypeStr != 'Closed') {
// 		$('#SrCloseDate').prop("disabled", true);		
// 		$('#timepicker1').prop("disabled", true);
//                 $('#Remark').prop("disabled", true);
//         } else {
//         	$('#SrCloseDate').prop("disabled", false);		
// 		$('#timepicker1').prop("disabled", false);
//                 $('#Remark').prop("disabled", false);
//         }
// }


// function tothrs(){
//     var DGontime= document.getElementById("DGontime").value;
//     var DGofftime=document.getElementById("DGofftime").value;

//     var start = moment.duration(DGontime,"hh:mm");
//     var end = moment.duration(DGofftime,"hh:mm");
//      var diff = end.subtract(start);
    
//     //var diff=moment(DGofftime)-moment(DGontime)
//     console.log(diff);
//     // return hours
   
    
   
//     if(DGofftime > DGontime){
        
//       document.getElementById("TotRunninghrs").value= diff.hours().toString() + '.'+ diff.minutes().toString(); 
   
//     }
//     else{
//         alert('Off time should be greater than On time');
//          document.getElementById("TotRunninghrs").value= '';
//     }
// }


//   function tohrs(){
//     var DGontime= document.getElementById("DGontime").value;
//     var DGofftime=document.getElementById("DGofftime").value;
//     var tot=Math.abs(new Date(DGofftime)-new Date(DGontime));
    
//     console.log(DGontime);
//     console.log(DGofftime);
//     if(DGofftime > DGontime){
        
//       document.getElementById("TotRunninghrs").value=tot;
//     console.log(tot);
//     }
//     else{
//         alert('enter start and end time');
//     }
// }



 

// /////////////////////////////////////////////////////////////////////////////////

// function dis() {
        
//         var marSta = $('#MStatus :selected').val();
//         if (marSta == 1 || marSta == 3) {
//         var x = document.getElementById("customertype_ID").options[1].disabled = true;
//         var y = document.getElementById("customertype_ID").options[2].disabled = true;
//         var z = document.getElementById("customertype_ID").options[3].disabled = false;
//             } 

//         if (marSta == 2) {
//         var a = document.getElementById("customertype_ID").options[3].disabled = true;  
//         var b = document.getElementById("customertype_ID").options[1].disabled = false;
//         var c = document.getElementById("customertype_ID").options[2].disabled = false;

//             }     
//     }
    
// ////////////////////////////////////////////////////////////////////////////////

// function ycssel()
// {
// $(document).ready(function() {
//   $(".js-example-basic-single").select2();
// });
// }

// ////////////////////////////////////////////////////////////////////////////////

// function apLoc(basePath, ID) {
//     var loc = $('#' + ID).val(); 

//     $.post(basePath + "/lib/ajax/ap_location.php", {'loc': loc}, function (data) {

// $('#ApSSID').empty();

// $.each(data, function() {
//   $("#ApSSID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
//   $('#ApSSID').append($('<option></option>').val(this.ApSSID).text(this.ApSSID))
//   });

//     }, "json");    
// }

// ////////////////////////////////////////////////////////////////////////////////

// function apSSID(basePath, ID) {
//   var ssid = $('#' + ID).val();
  
// $.post(basePath + "/lib/ajax/ap_ssid.php", {'ssid': ssid}, function (data) { 

// $('#ApIp').empty();

// $.each(data, function() {
//   $('#ApIp').append($('<option></option>').val(this.ApIp).text(this.ApIp))
//   });

//     }, "json");   
// }
// ////////////////////////////////////////////////////////////////////////////////

// function custChg(basePath, ID) {
//   var cid = $('#' + ID).val();

// $('#ApIp').val('');
// $('#EquipIp').val('');
  
// $.post(basePath + "/lib/ajax/equip_ip.php", {'cid': cid}, function (data) { 

// $('#ApIp').val(data["0"].ApIp);
// $('#EquipIp').val(data["0"].EquipmentIp);

//     }, "json");   
// }

// ////////////////////////////////////////////////////////////////////////////////


// function packageSel(basePath, ID) {
//     var pln = $('#' + ID).val(); 

//     $.post(basePath + "/lib/ajax/pac_select.php", {'pln': pln}, function (data) {
// $('#package_ID').empty();

// $.each(data, function() {
//   $('#package_ID').append($('<option></option>').val(this.ID).text(this.SMPackName))
//   });

//     }, "json");    
// }

// ////////////////////////////////////////////////////////////////////////////////

// function hideEmp() {
//     var payTypeStr = $('#PaymentType  :selected').val();
    
//     if (payTypeStr == 'E') {       
//         document.getElementById("employee_ID").disabled = false;
//         document.getElementById("NonEmployee").disabled = true; 
//     }
//     if (payTypeStr == 'NE') {        
//         document.getElementById("employee_ID").disabled = true;
//         document.getElementById("NonEmployee").disabled = false; 
//     }
// }

// //////////////////////////////////////////////////////////////////////////////////

// $(function () {
//   $('[data-toggle="popover"]').popover()
// })

// //////////////////////////////////////////////////////////////////////////////////
// //avoid dropdown  
// function avoiddrop(){
//     $('#PackageId_1').attr('data-toggle','');  
// }
// /////////////////////////////////////////////////////////////////////////////////
// function entitySel() { 
//  var entityId = $('#EntityID  :selected').val();
//  if(entityId === "AllEntity"){
//       document.getElementById("customer_type").disabled = true;
//       document.getElementById("customer_status").disabled = true;	
//  } else {
//       document.getElementById("customer_type").disabled = false;
//       document.getElementById("customer_status").disabled = false;
//  }
// }

// function statusSel(basePath, customer_type) {
//  var customerType = $('#' + customer_type).val();
//     $.post(basePath + "/lib/ajax/cust_status.php", {'customerType': customerType}, function (data) {
// $('#customer_status').empty();
// $("#customer_status").prepend('<option value="" disabled selected style="display:none;">Select</option>');
// $.each(data, function() {
//   $('#customer_status').append($('<option></option>').val(this.ID).text(this.Status))
//   });
//     }, "json");
// }

// function checkSmsFields(){
//   var entityId = $('#EntityID  :selected').val();
//   var custType = $('#customer_type  :selected').val();
//   var custStatus = $('#customer_status  :selected').val();  

//   if(entityId!=="AllEntity" && !custType){
// 	alert("Please select Customer Type");  
//   }else if(custType && !custStatus){
//   	alert("Please select Customer Status");
//   }
// }

// function checkCheckBoxes(theForm) {
// 	if (theForm.confirm_send.checked == false){
// 	    alert ('Please check Confirm Send');
// 	    return false;
// 	} else { 	
// 	    return true;
// 	}
// }

// function getRMName(id){
//     var RMName = $("#"+id+" option:selected").text();
//     var result = id.split("_")[1];
//     $('input[name=RMName_'+result+']').val(RMName);
// }


// function getPODetails(basePath, ID){
    
//     var poid = ID; 

//     $.post(basePath + "/lib/ajax/ppc_podet.php", {'poid': poid}, function (data) {
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }
//         }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }

// function getPODetails(basePath, ID){
    
//     var woid = ID; 

//     $.post(basePath + "/lib/ajax/pp_masterdet.php", {'woid': woid}, function (data) {
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }t
//         }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }

// function getPPCDetails(basePath, ID){
    
//     var poid = ID; 

//     $.post(basePath + "/lib/ajax/store_ppcdet.php", {'poid': poid}, function (data) {
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }

// function getparamDetails(basePath, ID){
   
//     var woid = ID; 

//     $.post(basePath + "/lib/ajax/pp_masterdet.php", {'woid': woid}, function (data) {
        
        
//           // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data[0].length; i++) {

//                 var parname=data[0][i]['ParameterName'].toString();
              
//               console.log(parname);
//                  if ( document.getElementById(parname.replace(/\s/g,'')) != null)
//                 {
//                     document.getElementById(parname.replace(/\s/g,'')).value=data[0][i]['SOPValue'];
//                 }
                
//                  if(data[0][i]['ParameterName'] =='Barrel Temp-Z1' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
//                 {
//                      document.getElementById('EXBZ1').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Barrel Temp-Z2' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
//                 {
//                      document.getElementById('EXBZ2').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Barrel Temp-Z3' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
//                 {
//                      document.getElementById('EXBZ3').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Barrel Temp-Z1' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
//                 {
//                      document.getElementById('COEXBZ1').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Barrel Temp-Z2' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
//                 {
//                      document.getElementById('COEXBZ2').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Barrel Temp-Z3' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
//                 {
//                     document.getElementById('BZ3').value=data[0][i]['SOPValue'];
//                 }
//                   else if(data[0][i]['ParameterName'] =='Head 1 DZ' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
//                 {
//                      document.getElementById('EXDZ1').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Head 2 DZ' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
//                 {
//                      document.getElementById('EXDZ2').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Head 3 DZ' && data[0][i]['GroupName'] =='Extruder Process Parameters' )
//                 {
//                     document.getElementById('EXDZ3').value=data[0][i]['SOPValue'];
//                 }
//                     else if(data[0][i]['ParameterName'] =='Head 1 DZ' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
//                 {
//                      document.getElementById('COEXDZ1').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Head 2 DZ' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
//                 {
//                      document.getElementById('COEXDZ2').value=data[0][i]['SOPValue'];
//                 }
//                 else if(data[0][i]['ParameterName'] =='Head 3 DZ' && data[0][i]['GroupName'] =='Co Extruder Process Parameters' )
//                 {
//                     document.getElementById('COEXDZ3').value=data[0][i]['SOPValue'];
//                 }
//         }

        
//          document.getElementById('MouldQty').value=data['bom'][0]['MouldQty'];
//         document.getElementById('MachineName').value=data['bom'][0]['MachineName'];
//         document.getElementById('CustomerName').value=data['bom'][0]['FirstName'];
//         document.getElementById('PartName').value=data['bom'][0]['ItemName'];
//         document.getElementById('CPoutput').value=data[0][0]['outputpermin'];
//          document.getElementById('CPweight').value=data['bom'][0]['weight'];
//          document.getElementById('ProductID').value=data['bom'][0]['ProductID'];
//         // document.getElementById('').value(data[0]['FirstName']);
//         // document.getElementById('').value(data[0]['FirstName']);
//         // document.getElementById('').value(data[0]['FirstName']);
        
        
        
        
        
        
        
//         $('#rawshowData').empty();
        
//         // // EXTRACT VALUE FOR HTML HEADER. 
//         // // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
       
//         for (var i = 0; i < data['bom'].length; i++) {
            
//             for (var key in data['bom'][i]) {
               
//                 if (key=='RawMaterial' || key == 'Grade' || key =='RMQuantity' || key=='InwardQty' || key=='ConsumedQty' || key=='RejectedQty' || key=='ClosingBalance' || key=='LotNo' || key=='OpeningBalance' || key=='UnitOfMeasurement'){
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
        
//         var divContainer = document.getElementById("rawshowData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }


// function getinspDetails(basePath, ID){
   
//     var woid = ID; 

//     $.post(basePath + "/lib/ajax/part_spec_det.php", {'woid': woid}, function (data) {
        
        
      
//           // ADD JSON DATA TO THE TABLE AS ROWS.
       
        
//          //document.getElementById('MouldQty').value=data['bom'][0]['MouldQty'];
//         document.getElementById('MachineName').value=data['bom'][0]['MachineName'];
//       // document.getElementById('CustomerName').value=data['bom'][0]['FirstName'];
//         document.getElementById('PartName').value=data['bom'][0]['ItemName'];
//          document.getElementById('partSpecmaxCount').value=data['bom'].length;
//         $('#rawmaterialshowData').empty();
        
//         // // EXTRACT VALUE FOR HTML HEADER. 
//         // // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
       
//         for (var i = 0; i < data['bom'].length; i++) {
            
//             for (var key in data['bom'][i]) {
               
//                 if (key=='Inspection Parameter' || key=='Dimension/Specification' || key=='Equipment Name' || key=='Ins 1'|| key=='Ins 2'|| key=='Ins 3'|| key=='Ins 4'|| key=='Ins 5'|| key=='Ins 6'|| key=='Ins 7' || key=='Ins 8' || key=='Result'  ){
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          table.setAttribute('id', 'RawMaterialTable');

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
        
//         var divContainer = document.getElementById("rawmaterialshowData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }


// function getBatchRMDetails(basePath, ID){
   
//     var woid = ID; 

//     $.post(basePath + "/lib/ajax/batchrm_det.php", {'woid': woid}, function (data) {
        
//     console.log(data);
        
//         $('#showData').empty();
        
//         // // EXTRACT VALUE FOR HTML HEADER. 
//         // // ('Book ID', 'Book Name', 'Category' and 'Price')
        
//  var col = [];
       
//         for (var i = 0; i < data.length; i++) {
            
//             for (var key in data[i]) {
               
//                 if (key=='RawMaterial' || key =='Grade' || key=='Requested Quantity' || key=='Issued Quantity' || key=='Unit Of Measurement' ){
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//                 }
//             }
//         }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          //table.setAttribute('id', 'showData1');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }

// function getBatchDetails(basePath, ID){
   
//     var woid = ID; 

//     $.post(basePath + "/lib/ajax/pp_masterdet.php", {'woid': woid}, function (data) {
        
        
//           // ADD JSON DATA TO THE TABLE AS ROWS.
        
//          document.getElementById('MouldQty').value=data['bom'][0]['MouldQty'];
//         document.getElementById('MachineName').value=data['bom'][0]['MachineName'];
//         document.getElementById('CustomerName').value=data['bom'][0]['FirstName'];
//         document.getElementById('PartName').value=data['bom'][0]['ItemName'];
        
        
//         // document.getElementById('').value(data[0]['FirstName']);
//         // document.getElementById('').value(data[0]['FirstName']);
//         // document.getElementById('').value(data[0]['FirstName']);
        
        
     
//         $('#rawmaterialshowData').empty();
        
//         // // EXTRACT VALUE FOR HTML HEADER. 
//         // // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
       
//         for (var i = 0; i < data['bom'].length; i++) {
            
//             for (var key in data['bom'][i]) {
               
//                 if (key=='RawMaterial' || key == 'Grade' || key =='RMQuantity' || key=='InwardQty' || key=='ConsumedQty' || key=='RejectedQty' || key=='ClosingBalance' || key=='LotNo' || key=='OpeningBalance' ){
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          table.setAttribute('id', 'RawMaterialTable');

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
        
//         var divContainer = document.getElementById("rawmaterialshowData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }


// function Prodfilter(basepath,prodtypeval,prodID)
// {

//         $.post(basepath + "/lib/ajax/get_product.php", {'woID': prodtypeval}, function (data) {
//      console.log(data);
//     $('#'+prodID).empty();
//     $("#"+prodID).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+prodID).append($('<option></option>').val(this.ID).text(this.ItemName))
//     });
   
//      });
     
    
    
// }

// function getppDetails(basepath,woID,ppID)
// {
//         $.post(basepath + "/lib/ajax/get_ppdetails.php", {'woID': woID}, function (data) {
//      console.log(data);
//       console.log(ppID);
//      //
      
//     $('#'+ppID).empty();
//     $("#"+ppID).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+ppID).append($('<option></option>').val(this.ID).text(this.ShiftName))
//     });
   
//      });
     
// }

// function getppqtyDetails(basepath,woID,prodQtyID)
// {
    
//       $.post(basepath + "/lib/ajax/get_ppqtydetails.php", {'woID': woID}, function (data) {
//      console.log(data);
//      //
      
//     $('#'+prodQtyID).empty();
//     $("#"+prodQtyID).val(data[0]['TotProdMtr']);
  
   
//      });
// }

// function CalcColsingBal(ConsumedQty,OpeningBalance,InwardQty,RejectedQty,ClosingBalance)
// {
//     console.log(ConsumedQty);
//     console.log(OpeningBalance);
//     console.log(InwardQty);
//     console.log(RejectedQty);
//     console.log(ClosingBalance);
//     var tbl=document.getElementById('RawMaterialTable');
    
// var ConsQty=tbl.rows[0].cells[0].getElementById(ConsumedQty).value;
//      console.log(ConsQty);
//     var OpenBal=$('#' + ConsumedQty).val();
//     var InwQty=$('#' + ConsumedQty).val();
//     var RejQty=$('#' + ConsumedQty).val();
    
//     var ClosBal=OpenBal+InwQty-RejQty;
//   $('#' + ConsumedQty).val(ClosBal);
    
    
    
// }


// function CalcHrs(StartTime,EndTime,TotHrs)
// {
    
//     var DGontime= document.getElementById(StartTime).value;
//     var DGofftime=document.getElementById(EndTime).value;
    
  
//     var start = moment.duration(DGontime,"hh:mm");
//     var end = moment.duration(DGofftime,"hh:mm");
//     console.log(start.minutes());
//     console.log(end.minutes());
    
//     if(parseInt(start.minutes()) > 0 && parseInt(end.minutes()) > 0)
//     {
//      var diff = end.subtract(start);
    
//     //var diff=moment(DGofftime)-moment(DGontime)
//     console.log(start.minutes());
//     console.log(end.minutes());
//     // return hours
    
//     if( diff.hours() >=0 &&  diff.minutes() >=0){
//       document.getElementById(TotHrs).value= diff.hours().toString() + '.'+  diff.minutes().toString(); 
//       }
//     else{
//         alert('Off time should be greater than On time');
//          document.getElementById(TotHrs).value= '';
//     }
//     }
// }


 

// function getPODetailsManuf(basePath, ID){
    
//     var poid = ID; 

//     $.post(basePath + "/lib/ajax/manuf_podet.php", {'poid': poid}, function (data) {
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }
//         }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }

// function getManufDetailsQA(basePath, ID){
    
//     var poid = ID; 

//     $.post(basePath + "/lib/ajax/qa_manufdet.php", {'poid': poid}, function (data) {
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }
//         }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }

// function getManufDetailsDes(basePath, ID){
    
//     var poid = ID; 

//     $.post(basePath + "/lib/ajax/des_manufdet.php", {'poid': poid}, function (data) {
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }
//         }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//         table.setAttribute('id', 'DespatchTable');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }

// function calcAmountDes(rate,quantity,amount){
//         var rate = $('#' + rate).val(); 
//             var qty = $('#' + quantity).val(); 
//                 var amt = $('#' + amount); 
//     $(amt).val((rate*qty).toFixed(2));
// }

// function subtotal_desp(){
    
//      var subTotal = 0;
 
//      var counting  = $('#DespatchTable tr').length;
     
//     for (i = 1; i < counting; i++) {
//         if ($('#Amount_' + i).length) {
//             subTotal += parseFloat($('#Amount_' + i).val());
//         }
//     }

//     $('#subTotal').html(subTotal);

//     //var rebate = parseFloat($('#rebate').val());

//     //var subTotal = subTotal - rebate;

//     var tp = parseFloat($('#taxPercent').val());

//     var tax_amount = ((subTotal * tp) / 100);

//     $('#tax').html(tax_amount.toFixed(2));

//     var BillAmount = Math.round((subTotal + tax_amount));
    

//     $('#STotal').val(subTotal.toFixed(2));
//     $('#Total').html(BillAmount.toFixed(2));
//     $('#BillAmount').val(BillAmount.toFixed(2));
    
// }

// function getState(basePath,countryVal,IdToReflect){
   
//      $.post(basePath + "/lib/ajax/get_state.php", {'countryVal': countryVal}, function (data) {
     
//     $('#'+IdToReflect).empty();
//     $("#"+IdToReflect).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+IdToReflect).append($('<option></option>').val(this.ID).text(this.StateName))
//     });
   
//      });
// }
// function minstock(evt){
//     var charCode=(evt.which) ? evt.which:event.keyCode;
//     if(charCode<48 || charCode>57){
//         alert("Enter only numbers");
//         return false;
//       }
//       else{
//           return true;
//       }
// }
// function maxstock(evt){
//     var charCode=(evt.which) ? evt.which:event.keyCode;
//     if(charCode<48 || charCode>57){
//         alert("Enter only numbers");
//         return false;
//       }
//       else{
//           return true;
//       }
// }
// function currentstock(evt){
//     var charCode=(evt.which) ? evt.which:event.keyCode;
//     if(charCode<48 || charCode>57){
//         alert("Enter only numbers");
//         return false;
//       }
//       else{
//           return true;
//       }
// }
// function production(){
//     var min=document.getElementById("Outputpermin").value;
//     var hr=document.getElementById("Outputperhrs").value=(min*60).toFixed(2);
//     var day=document.getElementById("Outputperday").value=(hr*24).toFixed(2);
//     var qty=document.getElementById("PlanQuantity").value;
//     var trm=document.getElementById("TotReqMnts").value=((1/min)*qty).toFixed(2);
//     var trh=document.getElementById("TotReqhrs").value=(trm/60).toFixed(2);
//     var trd=document.getElementById("NoofdaysReq").value=Math.ceil(trh/24).toFixed(2);
//     document.getElementById("NoofshiftReq").value=Math.ceil(trh/12);
  
// }

// function addRowWOcalc(editcount) {
//   console.log(editcount);
//     if(editcount){
//         count = editcount;
//     }

//     //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
//     var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + count});

//     //x.find('#Invoice_data_entry_1').attr({id: "Invoice_data_entry_"+ count}); 
//     x.find('#BatchNo_1').val('');
//     if ($('#BatchNo_1').length) {
//         x.find('#BatchNo_1').attr({id: "BatchNo_" + count, name: "BatchNo_" + count});
//     }
    
//     x.find('#ItemNo_1').val('');
//     if ($('#ItemNo_1').length) {
//         x.find('#ItemNo_1').attr({id: "ItemNo_" + count, name: "ItemNo_" + count});
//     }
//     x.find('#ItemName_1').val('');
//     x.find('#ItemName_1').attr({id: "ItemName_" + count, name: "ItemName_" + count});
    
//     x.find('#EmpName_1').val('');
//     x.find('#EmpName_1').attr({id: "EmpName_" + count, name: "EmpName_" + count});
//     x.find('#Water_1').val('');
//     x.find('#Water_1').attr({id: "Water_" + count, name: "Water_" + count});
    
//     x.find('#Note_1').val('');
//     if ($('#Note_1').length) {
//         x.find('#Note_1').attr({id: "Note_" + count, name: "Note_" + count});
//     }
//     x.find('#Amount_1').val('');
//     x.find('#Amount_1').attr({id: "Amount_" + count, name: "Amount_" + count});
//   x.find('#Quantity_1').val('');
//   x.find('#Quantity_1').attr({id: "Quantity_" + count, name: "Quantity_" + count});
//      x.find('#Rat_1').val('');
//     x.find('#Rat_1').attr({id: "Rat_" + count, name: "Rat_" + count});
//     x.find('#Rate_1').val('');
//     x.find('#Rate_1').attr({id: "Rate_" + count, name: "Rate_" + count});
 
    
//      x.find('#Field2_1').val('');
//     x.find('#Field2_1').attr({id: "Field2_" + count, name: "Field2_" + count});
//     x.find('#Field3_1').val('');
//     x.find('#Field3_1').attr({id: "Field3_" + count, name: "Field3_" + count});
//      x.find('#Field4_1').val('');
//     x.find('#Field4_1').attr({id: "Field4_" + count, name: "Field4_" + count});
//     x.find('#Field5_1').val('');
//     x.find('#Field5_1').attr({id: "Field5_" + count, name: "Field5_" + count});
//     x.find('#Field6_1').val('');
//     x.find('#Field6_1').attr({id: "Field6_" + count, name: "Field6_" + count});
    
//      x.find('#Field7_1').val('');
//     x.find('#Field7_1').attr({id: "Field7_" + count, name: "Field7_" + count});
//     x.find('#Field8_1').val('');
//     x.find('#Field8_1').attr({id: "Field8_" + count, name: "Field8_" + count});
//      x.find('#Field9_1').val('');
//     x.find('#Field9_1').attr({id: "Field9_" + count, name: "Field9_" + count});
//     x.find('#Field10_1').val('');
//     x.find('#Field10_1').attr({id: "Field10_" + count, name: "Field10_" + count});
//     x.find('#Field11_1').val('');
//     x.find('#Field11_1').attr({id: "Field11_" + count, name: "Field11_" + count});
//     x.find('#Field12_1').val('');
//     x.find('#Field12_1').attr({id: "Field12_" + count, name: "Field12_" + count});
   
//   //newlyadded
//     x.find('#Qty_1').val('');
//     x.find('#Qty_1').attr({id: "Qty_" + count, name: "Qty_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2))"});
//     x.find('#Emp_1').val('');
//     x.find('#Emp_1').attr({id: "Emp_" + count, name: "Emp_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2))"});
    

//     //Note_1
//     x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove();bom(this.id)"});

//     x.appendTo('#invoice_listing_table');
    
//      $('#Rate_'+ count).datetimepicker();
     
//       $('#Rate_'+ count).datetimepicker().on('dp.show', function() {   
//   $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
// }).on('dp.hide', function() {
//   $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
// });

//      $('#maxCount').val(count);
//     count++;
// }



// function addRowcalc(editcount) {
//     console.log(editcount);
//       if(editcount){
//           count = editcount;
//       }
  
//       //$('#Invoice_data_entry').clone().appendTo('#invoice_listing_table');
//       var x = $('#Invoice_data_entry_1').clone().attr({id: "Invoice_data_entry_" + count});
  
//       //x.find('#Invoice_data_entry_1').attr({id: "Invoice_data_entry_"+ count}); 
//       x.find('#BatchNo_1').val('');
//       if ($('#BatchNo_1').length) {
//           x.find('#BatchNo_1').attr({id: "BatchNo_" + count, name: "BatchNo_" + count});
//       }
      
//       x.find('#ItemNo_1').val('');
//       if ($('#ItemNo_1').length) {
//           x.find('#ItemNo_1').attr({id: "ItemNo_" + count, name: "ItemNo_" + count});
//       }
//       x.find('#Grade_1').val('');
//       x.find('#Grade_1').attr({id: "Grade_" + count, name: "Grade_" + count});
      
//       x.find('#Unit_1').val('');
//       x.find('#Unit_1').attr({id: "Unit_" + count, name: "Unit_" + count});
//       x.find('#ReturnQuantity_1').val('');
//       x.find('#ReturnQuantity_1').attr({id: "ReturnQuantity_" + count, name: "ReturnQuantity_" + count});
      
//       x.find('#Note_1').val('');
//       if ($('#Note_1').length) {
//           x.find('#Note_1').attr({id: "Note_" + count, name: "Note_" + count});
//       }
//       x.find('#IssuedQuantity_1').val('');
//       x.find('#IssuedQuantity_1').attr({id: "IssuedQuantity_" + count, name: "IssuedQuantity_" + count});
//      x.find('#Quantity_1').val('');
//      x.find('#Quantity_1').attr({id: "Quantity_" + count, name: "Quantity_" + count});
//       x.find('#Rat_1').val('');
//       x.find('#Rat_1').attr({id: "Rat_" + count, name: "Rat_" + count});
//       x.find('#Rate_1').val('');
//       x.find('#Rate_1').attr({id: "Rate_" + count, name: "Rate_" + count});
   
      
//       x.find('#Field2_1').val('');
//       x.find('#Field2_1').attr({id: "Field2_" + count, name: "Field2_" + count});
//       x.find('#Field3_1').val('');
//       x.find('#Field3_1').attr({id: "Field3_" + count, name: "Field3_" + count});
//       x.find('#Field4_1').val('');
//       x.find('#Field4_1').attr({id: "Field4_" + count, name: "Field4_" + count});
//       x.find('#Field5_1').val('');
//       x.find('#Field5_1').attr({id: "Field5_" + count, name: "Field5_" + count});
//       x.find('#Field6_1').val('');
//       x.find('#Field6_1').attr({id: "Field6_" + count, name: "Field6_" + count});
      
//       x.find('#Field7_1').val('');
//       x.find('#Field7_1').attr({id: "Field7_" + count, name: "Field7_" + count});
//       x.find('#Field8_1').val('');
//       x.find('#Field8_1').attr({id: "Field8_" + count, name: "Field8_" + count});
//       x.find('#Field9_1').val('');
//       x.find('#Field9_1').attr({id: "Field9_" + count, name: "Field9_" + count});
//       x.find('#Field10_1').val('');
//       x.find('#Field10_1').attr({id: "Field10_" + count, name: "Field10_" + count});
//       x.find('#Field11_1').val('');
//       x.find('#Field11_1').attr({id: "Field11_" + count, name: "Field11_" + count});
//       x.find('#Field12_1').val('');
//       x.find('#Field12_1').attr({id: "Field12_" + count, name: "Field12_" + count});
     
//     //newlyadded
//       x.find('#Qty_1').val('');
//       x.find('#Qty_1').attr({id: "Qty_" + count, name: "Qty_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2))"});
//       x.find('#Emp_1').val('');
//       x.find('#Emp_1').attr({id: "Emp_" + count, name: "Emp_" + count, onkeyup: "$('#Amount_" + count + "').val(($('#Qty_" + count + "').val() * $('#Emp_" + count + "').val()).toFixed(2))"});
      
  
//       //Note_1
//       x.find('#REM_1').attr({id: "REM_" + count, name: "REM_" + count, onclick: "$('#Invoice_data_entry_" + count + "').remove();bom(this.id)"});
  
//       x.appendTo('#invoice_listing_table');
      
//       $('#Rate_'+ count).datetimepicker();
       
//         $('#Rate_'+ count).datetimepicker().on('dp.show', function() {   
//     $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
//   }).on('dp.hide', function() {
//     $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
//   });
  
//       $('#maxCount').val(count);
//       count++;
//   }
  


// // newly added
// function getPMChecklistDetail(basePath, ID){
    
//     var pmchkid = ID; 
// // console.log(ID);
//     $.post(basePath + "/lib/ajax/pm_observationdetail.php", {'pmchkid': pmchkid}, function (data) {
//         console.log(data);
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }
// //end


   

   
// function getBatchDetails(basePath){

//     var woid =  document.getElementById('workorder_ID').value;
   
    

//     $.post(basePath + "/lib/ajax/batchmi_det.php", {'woid': woid}, function (data) {

     
//         $('#showData').empty();
        
//         // // EXTRACT VALUE FOR HTML HEADER. 
//         // // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
       
//         for (var i = 0; i < data.length; i++) {
            
//             for (var key in data[i]) {
               
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
                
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          //table.setAttribute('id', 'showData1');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");


//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
    
    
// }


// function getRawMaterialFromBatchNo(basePath) {

 
//     var poid1 =  document.getElementById('workorder_ID').value;

//     $.post(basePath + "/lib/ajax/get_rawFromBatchNo.php", {'poid': poid1}, function (data) {

//         $('[id^=ItemNo_]').empty();
//         $('[id^=ItemNo_]').prepend('<option value=""  >Select</option>');
//         $.each(data, function() {
//             $('[id^=ItemNo_]').append($('<option ></option>').val(this.rawmaterial_ID).text(this.RawMaterial));
//           });
//     }, "json");   
// } 


// function getfieldvalue(basePath,ID,Field)
// {

//         var poid = ID;
        
//         var idid = Field.split('_')[1];

//         console.log(idid);
//         console.log(poid);


//     $.post(basePath + "/lib/ajax/get_fieldValue.php", {'poid': poid}, function (data) {

//         $('#Grade_'+idid).val(data[0]['Grade']);
//         $('#Unit_'+idid).val(data[0]['UnitName']);
//         $('#IssuedQuantity_'+idid).val(data[0]['IssQty']);

//     }, "json");   
// } 



// function getBatchMIDetails(basePath){

//     var woid =  document.getElementById('workorder_ID').value;
   
    

//     $.post(basePath + "/lib/ajax/batchmi_det.php", {'woid': woid}, function (data) {
        

     
//         $('#showData').empty();
        
//         // // EXTRACT VALUE FOR HTML HEADER. 
//         // // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
       
//         for (var i = 0; i < data.length; i++) {
            
//             for (var key in data[i]) {
               
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
                
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          //table.setAttribute('id', 'showData1');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");


//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
    
    
// }
// //end
// function getparameterdetail(basePath, ID){
   
//     var woid = ID; 
//     console.log(basePath);

//     $.post(basePath + "/lib/ajax/batchrawmaterialmixing_det.php", {'woid': woid}, function (data) {
        

        
//         document.getElementById('machinename').value=data[0]['MachineName'];
//         document.getElementById('customername').value=data[0]['FirstName'];
//         document.getElementById('productname').value=data[0]['ItemName'];
        
//         document.getElementById('machine_ID').value=data[0]['machine_ID'];
//         document.getElementById('customer_ID').value=data[0]['customer_ID'];
//         document.getElementById('product_ID').value=data[0]['product_ID'];
        
        
//         // document.getElementById('').value(data[0]['FirstName']);
//         // document.getElementById('').value(data[0]['FirstName']);
//         // document.getElementById('').value(data[0]['FirstName']);
//              $('#showData').empty();
        
//         // // EXTRACT VALUE FOR HTML HEADER. 
//         // // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
       
//         for (var i = 0; i < data.length; i++) {
            
//             for (var key in data[i]) {
               
//                 if (key=='RawMaterial' || key == 'Grade'|| key=='RMMixing Time' || key=='Mixing Percentage' || key=='Total Consumption'|| key=='UnitOfMeasurement'){
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          table.setAttribute('id', 'RawMaterialTable');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);
//         ajaxdatetime();

//     }, "json");  
// }


// function playSound()
// {
//     var audio = new Audio('http://www.rangde.org/static/bell-ring-01.mp3');
//     audio.play();
// }


// function ajaxdatetime()
// {
    
//       $('input[data-provide="datetimepicker"]').datetimepicker();
//       var currentdate = new Date();
//     $('input[data-provide="datetimepicker"]').datetimepicker().on('dp.show', function() {
//   $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
  

// }).on('dp.hide', function() {
//   $(this).closest('.temp').addClass('table-responsive').removeClass('temp');
// });
// }

// function outputpermin(prodid)
// {
   
//     $.post(basePath + "/lib/ajax/sopoutput.php", {'prodid': prodid}, function (data) {
        
//         document.getElementById('Outputpermin').value=data[0]['outputpermin'];
        
//     }, "json");  
    
// }

// function RMMixingCalc(TotMix,prodid)
// {
//       var prodval=document.getElementById(prodid).value;
      
//       var table = document.getElementById("RawMaterialTable");

//       $.post(basePath + "/lib/ajax/rm_mixing_calc.php", {'prodval': prodval}, function (data) {
        
//         for (var i = 0; i < data.length; i++) {
           
//             var datarmid=data[i]['rawmaterial_ID'];
           
//             for (var j = 0; j <table.rows.length-1; j++) {
                
//             var itemid='ItemNo_' + (j+1);
          
//             var rmid=document.getElementById (itemid).value;
            
//             if(rmid == datarmid)
//             {
               
//                  document.getElementById ('Quantity_' + (j+1)).value=data[i]['RMPerc'];
//                 document.getElementById ('EmpName_' + (j+1)).value=Number((data[i]['RMPerc'])*Number(TotMix)/100);
                
//             }
  
//         }
            
            
//         }
        
//     }, "json");  
    
    
// }

// function RMRejectCalc(totid)
// {
    
//     var Totval=  document.getElementById (totid).value;
    
//     var prodval= document.getElementById('ProductID').value;
    
//     var table = document.getElementById("showData");
//     $.post(basePath + "/lib/ajax/rm_mixing_calc.php", {'prodval': prodval}, function (data) {
            
            
//             for (var i = 0; i < data.length; i++) {
               
//                 var datarmid=data[i]['rawmaterial_ID'];
               
//                 for (var j = 0; j <table.rows.length-1; j++) {
                    
//                 var itemid='RMID_' + (j+1);
              
//                 var rmid=document.getElementById (itemid).value;
                
//                 if(rmid == datarmid)
//                 {
                   
//                     var RejQty=parseFloat((parseFloat(Totval)*parseFloat(data[i]['RMPerc']))/100);

//                     document.getElementById('RejectedQty_' + (j+1)).value=RejQty;
//                     var OpeingBal=$('#OpeningBalance_'+(j+1)).val();
//                     //var InwardQty=$('#InwardQty_'+(j+1)).val();
//                     var ConsumedQty=$('#ConsumedQty_'+(j+1)).val();
                    
//                     var Closingbal =parseFloat(OpeingBal)  -(parseFloat(RejQty)+parseFloat(ConsumedQty));
                   
//                   console.log(RejQty);
//                   console.log(OpeingBal);
//                   console.log(ConsumedQty);
//                   console.log(Closingbal);
//                     document.getElementById('ClosingBalance_' + (j+1)).value=Closingbal.toFixed(2);
                    
//                 }
      
//             }
                
                
//             }
            
//     }, "json"); 
// }


// //end

// function wrkorderChg(woid) {
    
   
// $.post(basePath + "/lib/ajax/fg_quantity.php", {'woid': woid}, function (data) { 

//  document.getElementById('Quantity').value=data[0]['TotQty'];

//     }, "json");   
// }
// //end

// function getRawMaterial(basePath,ID) {

//     var poid=ID; 
//   $('[id^="Amount_"]').val("");

//     $.post(basePath+"/lib/ajax/get_raw.php", {'poid': poid}, function (data) {


//         $('[id^=ItemNo_]').empty();
//         $('[id^=ItemNo_]').prepend('<option value="">Select</option>');
//         $.each(data, function() {
        
//             // $('[id^=ItemNo_]').prepend('<option value=""  style="display:none;" required>Select</option>');
//             $('[id^=ItemNo_]').append($('<option ></option>').val(this.ID).text(this.RMName));
//           });
    


//     }, "json");   
// }  

// function getRaw(basePath,ID) {

//     var poid=ID; 
// //   $('[id^="Amount_"]').val("");
// console.log(ID);


//     $.post(basePath+"/lib/ajax/get_raw.php", {'poid': poid}, function (data) {


//         $('[id^=ItemNo_]').empty();
//         $('[id^=ItemNo_]').prepend('<option value="">Select</option>');
//         $.each(data, function() {
        
//             // $('[id^=ItemNo_]').prepend('<option value=""  style="display:none;" required>Select</option>');
//             $('[id^=ItemNo_]').append($('<option ></option>').val(this.ID).text(this.RMName));
//           });
    


//     }, "json");   
// } 

// function getActualQuantity(basePath,ID,RowId)
// {
//     var idid = RowId.split('_')[1];
//     // document.getElementById('Amount_'+ idid).value = 0 ;
   
//     var poid=ID; 
//     $.post(basePath + "/lib/ajax/get_actualquantity.php", {'poid': poid}, function (data) {
        
//         if(data == undefined || data == null  ){
//             console.log('here the data is undefined');
//             document.getElementById('Amount_'+ idid).value = 0 ;
//         }
      
//         var totalQty = 0 ;
//       for(var i = 0 ; i< data.length;i++)
//       {
//             var totalQty = Number(totalQty) + Number(data[i]['TotalQty']);
//       }


//         document.getElementById('Amount_'+ idid).value = totalQty;


//     }, "json"); 

// }



// function getpodetails(basePath,ID){
   
//     var poid=ID; 
//   // console.log('hello');
//     $.post(basePath + "/lib/ajax/get_po.php", {'poid': poid}, function (data) {
        
//         $('#showData').empty();
        

//  var col = [];
       
//         for (var i = 0; i < data.length; i++) {
            
//             for (var key in data[i]) {
//               if (key=='RawMaterial' || key=='LotNo' || key =='PO Quantity'  || key =='Actual Quantity' || key=='Unit' || key=='Remarks'){
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
                
//                 }
//             }
//         }
// }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          //table.setAttribute('id', 'showData1');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }


// function getbatchDetails(woid)
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
    
// function getrmdata (rmid,selectid) {
   
    
    
//     var rawmaterialid= selectid.split("_")[1];
    
// $.post(basePath + "/lib/ajax/rm_data.php", {'rmid': rmid}, function (data) { 
      

//   document.getElementById("ItemName_" + rawmaterialid).value=data[0]['RMName'];
  
  
//     }, "json");   
// }  





// //end
// // function ycssel()
// // {
// // $(document).ready(function() {
// //   $(".js-example-basic-single").select2();
// // });
// // }
// //end
// function total() {
	
// 	var CgstTax = document.getElementById('CGSTTax').value ;
//     var SgstTax = document.getElementById('SGSTTax').value ;

	
// 	   if(CgstTax != SgstTax )
//   {
// 		document.getElementById('SGSTTax').readOnly = true ;
		
// 		 var SgstTax = document.getElementById('CGSTTax').value ;
// 		 document.getElementById('SGSTTax').value= SgstTax ;
		
//   }
   
//     var subtotal = 0;
//     if( $("#invoice_listing_table  tr").length=='1'){
//      var countingz  = $("#invoice_listing_table  tr").attr("id");    
//      }else{
//      var countingz  = $("#invoice_listing_table  tr:last").attr("id");
//      }
//      var result = countingz.split("_")[3];

//     for (i = 1; i <= result; i++) {
//         if ($('#Amount_' + i).length) {
//             subtotal += parseFloat($('#Amount_' + i).val());
//         }
//     }  
//   // document.getElementById("BillAmount").value=subtotal;
//     $('#subtotal').html(subtotal);
//     $('#BillAmount').val(subtotal.toFixed(2));
   
//     var CGSTTax = parseFloat($('#CGSTTax').val());
//     var tax_amount = ((subtotal * CGSTTax) / 100);
     
//     $('#GSTAmount').html(tax_amount.toFixed(2));
      
//     $('#CGSTTax').html(tax_amount.toFixed(2));

   
//     var SGSTTax = parseFloat($('#SGSTTax').val());
//     var tax_amount1 = ((subtotal * SGSTTax) / 100);
     
//     $('#SGSTAmount').html(tax_amount1.toFixed(2));
      
//     $('#SGSTTax').html(tax_amount1.toFixed(2));

//     var IGSTTax = parseFloat($('#IGSTTax').val());
//     var tax_amount2 = ((subtotal * IGSTTax) / 100);
     
//     $('#IGSTAmount').html(tax_amount2.toFixed(2));
      
//     $('#IGSTTax').html(tax_amount2.toFixed(2));

    
    
//     var NetAmount =(subtotal + tax_amount + tax_amount1 + tax_amount2);
    
//     // count= $('#maxCount').val();
//     // for (i = 1; i < count; i++) {
//     //     if ($('#Amount_' + i).length) {
//     //         subTotal += parseFloat($('#Amount_' + i).val());
//     //     }
//     // }

     
//     $('#SGSTAmount').val(tax_amount1.toFixed(2));
//     $('#IGSTAmount').val(tax_amount2.toFixed(2));
//     $('#CGSTAmount').val(tax_amount.toFixed(2));
    
//     $('#Total').html(NetAmount.toFixed(2));
//     $('#NetAmount').val(NetAmount.toFixed(2));
//     $('#maxCount').val(result);


// }
// // //end

// function quantity(selectid){

// var poqty= selectid.split("_")[1];
// var pqty=parseFloat(document.getElementById("Quantity_" + poqty).value);
// console.log(pqty);
// var accepqty=selectid.split("_")[1];
// var aqty=parseFloat(document.getElementById("EmpName_" + accepqty).value);
// var actualqty=selectid.split("_")[1];
// //var acqty=parseFloat(document.getElementById("Water_"+ actualqty).value);
// var acqty=document.getElementById("Water_"+ actualqty).value;
// var rejected=acqty-aqty;
// var rejqty=selectid.split("_")[1];
// var reject=parseFloat(document.getElementById("Amount_"+ rejqty).value);
// console.log(acqty);
//   if(acqty>pqty){
//       document.getElementById("Water_" + actualqty).value="";
//       alert("Actual Quantity should not be greater than PO Quantity");
//   }

//   else if(acqty<=pqty){
       
//       //document.getElementById("Water_" + actualqty).value=acqty;
//         document.getElementById("Amount_"+ rejqty).value=rejected;
//      // alert("Please Enter Actual Quantity which is not lesser than accepted quantity");
//         document.getElementById("Water_" + actualqty).value=acqty;
//       }
//   else{
//       document.getElementById("Water_" + actualqty).value="";
       
//   }
// }


// function machineno(mid) {
    
   
// $.post(basePath + "/lib/ajax/get_machine.php", {'mid': mid}, function (data) { 
    
//  $('#machine_ID').empty();

// $.each(data, function() {
//   $('#machine_ID').append($('<option></option>').val(this.ID).text(this.MachineName))
//   });
   

// //  document.getElementById('machine_ID').value=data[0]['MachineName'];
//  document.getElementById('machinecode').value=data[0]['MachineCode'];

//     }, "json");   
// }
// //end
// //Jquery for showing and hidding a value;
// // $(document).on('change','#MRType',function(e){
// //      if($("#MRType option:selected").val() == "withbatch"){
// //          $("#tblRawMaterial").hide();
// //          $("#divBatch").show();
// //      }else{
// //          $("#tblRawMaterial").show();
// //           $("#divBatch").hide();
// //      }
// // }); 
// //end
// //javascript for showing and hidding a value
// function hidebatchno(e) {
//   var matreqtype = $('#MRType :selected').val();
//   // var matreqtype=document.getElementById("MRType");
//   // var strUser = matreqtype.options[matreqtype.selectedIndex].value;
    
//     if (matreqtype =="withbatch") {       
//         // document.getElementById("tblRawMaterial").style.visibility='hidden';
//         // document.getElementById("divBatch").style.visibility='visible'; 
//         document.getElementById("tblRawMaterial").style.display='none';
//         //  document.getElementById("Water_1").style.display='none';
//         document.getElementById("divBatch").style.display='block'; 
//     }
//   else {        
//         document.getElementById("tblRawMaterial").style.display='block';
//         //   document.getElementById("Water_1").style.display='block';
//         document.getElementById("divBatch").style.display='none'; 
//     }
//     //console.log(strUser);
// }
// //end
// function getCounts() {
//      var matreqtype = $('#MRType :selected').val();
//     if((matreqtype=='withbatch')){
       
//     var counting  = $('#showData tr:last').find("td:first").find("input").attr('id');
//      var result = counting.split("_")[1];
//     }else{
    
//     var counting  = $('#invoice_listing_table tr:last').attr('id');
//     var result = counting.split("_")[3];

//     }
    
//     console.log(result);
//     $('#maxCount').val(result);
// }
// //end
// function getdate(peid,selectid) {
//     // console.log("hello") ;
// var rawmaterialid= selectid.split("_")[1];
    
// $.post(basePath + "/lib/ajax/get_date.php", {'peid': peid}, function (data) { 
 

//   document.getElementById("Rate_" + rawmaterialid).value=data[0]['PurchaseEntryDate'];
  
  
//     }, "json");   
// } 
// //end
// function qty(selectid){
    
// var poqty= selectid.split("_")[1];
// var pqty=parseFloat(document.getElementById("Quantity_" + poqty).value);
// var actualqty=selectid.split("_")[1];
// var acqty=parseFloat(document.getElementById("Water_"+ actualqty).value);
// var accepqty=selectid.split("_")[1];
// var aqty=parseFloat(document.getElementById("EmpName_" + accepqty).value);
// console.log(aqty);
// var rejected=acqty-aqty;
// var rejqty=selectid.split("_")[1];
// var reject=parseFloat(document.getElementById("Amount_"+ rejqty).value);
// // if((aqty!=="")&&(!acqty)){
// if((aqty!=="")&&(!acqty)){
//     alert("please enter actual quantity");
//     document.getElementById("EmpName_" + accepqty).value="";
   
// }

// if(aqty>acqty){
//     alert("Accepted Quantity should not be greater than Actual Quantity");
//      document.getElementById("EmpName_" + accepqty).value="";
//      document.getElementById("Amount_"+ rejqty).value="";

// }
 
// else{
//      document.getElementById("Amount_"+ rejqty).value=rejected;
// }
// }
// //end
// function Qty(selectid){

// var poqty= selectid.split("_")[1];
// var pqty=parseFloat(document.getElementById("Quantity_" + poqty).value);
// console.log(pqty);
// var accepqty=selectid.split("_")[1];
// var aqty=parseFloat(document.getElementById("EmpName_" + accepqty).value);
// var actualqty=selectid.split("_")[1];
// //var acqty=parseFloat(document.getElementById("Water_"+ actualqty).value);
// var acqty=document.getElementById("Water_"+ actualqty).value;
// var rejected=acqty-aqty;
// var rejqty=selectid.split("_")[1];
// var reject=parseFloat(document.getElementById("Amount_"+ rejqty).value);
// console.log(acqty);
//   if((aqty!="")&&(aqty)){
//       alert("please enter actual quantity");
//       alert("you entered actual quantity");
//   }
    
//   if(acqty<aqty){
       
//       //document.getElementById("Water_" + actualqty).value=acqty;
//         document.getElementById("Amount_"+ rejqty).value="";
//       alert("Please Enter Actual Quantity which is not lesser than accepted quantity");
//         document.getElementById("Water_" + actualqty).value="";
//       }

//  if(acqty>pqty){
//       document.getElementById("Water_" + actualqty).value="";
//       alert("Actual Quantity should not be greater than PO Quantity");
//   }

//   else if(acqty<=pqty){
       
//       //document.getElementById("Water_" + actualqty).value=acqty;
//         document.getElementById("Amount_"+ rejqty).value=rejected;
//      // alert("Please Enter Actual Quantity which is not lesser than accepted quantity");
//         document.getElementById("Water_" + actualqty).value=acqty;
//       }
  
//   else{
//         document.getElementById("Amount_"+ rejqty).value=rejected;
       
//   }
// }
//   //end
    
// function gradedata(rmid,selectid){
// var ID=rmid;
 
// var rawid=selectid.split("_")[1];
    
// $.post(basePath + "/lib/ajax/grade.php", {'rmid': rmid}, function (data) { 
      
// //  document.getElementById("ItemName_" + rawid).value=data[0]['Grade'];
// //  document.getElementById("Amount_" + rawid).value=data[0]['LotNo'];
  
// $('#'+("ItemName_" + rawid)).empty();
//     $("#"+("ItemName_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+("ItemName_" + rawid)).append($('<option></option>').val(this.Grade).text(this.Grade))
//     });
// $('#'+("Amount_" + rawid)).empty();
//     $("#"+("Amount_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+("Amount_" + rawid)).append($('<option></option>').val(this.LotNo).text(this.LotNo))
//     });
// }, "json");  
    
// console.log("hello");
// }  
// //end
// function rawdata(rmid,selectid){
// var ID=rmid;
 
// var rawid=selectid.split("_")[1];
    
// $.post(basePath + "/lib/ajax/rawdata.php", {'rmid': rmid}, function (data) { 
      
// //  document.getElementById("ItemName_" + rawid).value=data[0]['Grade'];
// //  document.getElementById("Amount_" + rawid).value=data[0]['LotNo'];
  
// $('#'+("ItemName_" + rawid)).empty();
//     $("#"+("ItemName_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+("ItemName_" + rawid)).append($('<option></option>').val(this.Grade).text(this.Grade))
//     });
//     console.log(val(this.id));
    
// // $('#'+("Amount_" + rawid)).empty();
// //     $("#"+("Amount_" + rawid)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
// //     $.each(data, function() {
// //         $('#'+("Amount_" + rawid)).append($('<option></option>').val(this.ID).text(this.LotNo))
// //     });
//  }, "json");  
    

// }  
// //end
// var subcount = 2;
// function addRowSub(editcount,ftype=null) {
//     //console.log(editcount);
//     if(editcount){
//         subcount = editcount;
//     }
    
//     var x = $('#Data_entry_1').clone().attr({id: "Data_entry_" + subcount});
    
//     if(ftype==''){
//      x.find('#Spawning_1').val('');
//     x.find('#Spawning_1').attr({id: "Spawning_" + subcount, name: "Spawning_" + subcount});
//     }else{
//     x.find('#Rate_1').val('');
//     x.find('#Rate_1').attr({id: "Rate_" + subcount, name: "Rate_" + subcount});
//     }
    
//     x.find('#Note_1').val('');
//     x.find('#Note_1').attr({id: "Note_" + subcount, name: "Note_" + subcount});
    
//     x.find('#Rat_1').val('');
//     x.find('#Rat_1').attr({id: "Rat_" + subcount, name: "Rat_" + subcount});
    
//     x.find('#ItemName_1').val('');
//     x.find('#ItemName_1').attr({id: "ItemName_" + subcount, name: "ItemName_" + subcount});
    
//     x.find('#Water_1').val('');
//     x.find('#Water_1').attr({id: "Water_" + subcount, name: "Water_" + subcount});
//     x.find('#ItemNo_1').val('');
//     x.find('#ItemNo_1').attr({id: "ItemNo_" + subcount, name: "ItemNo_" + subcount});
//     x.find('#Field4_1').val('');
//     x.find('#Field4_1').attr({id: "Field4_" + subcount, name: "Field4_" + subcount});
//     x.find('#Field5_1').val('');
//     x.find('#Field5_1').attr({id: "Field5_" + subcount, name: "Field5_" + subcount});
//     x.find('#Field6_1').val('');
//     x.find('#Field6_1').attr({id: "Field6_" + subcount, name: "Field6_" + subcount});

//     //Note_1
//     x.find('#SUBREM_1').attr({id: "SUBREM_" + subcount, name: "SUBREM_" + subcount, onclick: "$('#Data_entry_" + subcount + "').remove()"});

//     x.appendTo('#Listing_table');
    
//      $('#Rate_'+ subcount).datetimepicker();
     
//       $('#Rate_'+ subcount).datetimepicker().on('dp.show', function() {
//   $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
// }).on('dp.hide', function() {
//   $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
// });

//  $('#Note_'+ subcount).datetimepicker();
     
//       $('#Note_'+ subcount).datetimepicker().on('dp.show', function() {
//   $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
// }).on('dp.hide', function() {
//   $(this).closest('.temp').addClass('table-responsive').removeClass('temp')
// });
//     $('#maxCountSub').val(subcount);
//     subcount++;
// }

// /////////////////////////////////////////////////////////////////////////////
// function CalculateHrs(selectid)
// {
//  var dgontime= selectid.split("_")[1];

//   var DGontime=document.getElementById("Rate_" + dgontime).value;
//   var dgofftime= selectid.split("_")[1];
    
//   // console.log(DGontime);
//     var DGofftime=document.getElementById("Note_" + dgofftime).value;
//     var tothrs= selectid.split("_")[1]; 
    
//     // var start = moment.duration(DGontime,"HH:mm a");
//     // var end = moment.duration(DGofftime,"HH:mm a");
    
// var start = moment(DGontime,"hh:mm");
// var end = moment(DGofftime,"hh:mm");
// var duration = moment.duration(end.diff(start));
// var hours = parseInt(duration.asHours());
// var minutes = parseInt(duration.asMinutes())%60;
    
//   document.getElementById("Rat_"+ tothrs).value=duration.hours().toString() + '.'+  duration.minutes().toString();
 

    
//     // if(parseInt(start.minutes()) > 0 && parseInt(end.minutes()) > 0)
//     // {
//     //  var diff = end.subtract(start);
    
//     // //var diff=moment(DGofftime)-moment(DGontime)
//     // console.log(start.minutes());
//     // console.log(end.minutes());
    
//     // // return hours
//     //  if( diff.hours() >=0 &&  diff.minutes() >=0){
//     //   document.getElementById("Rat_"+ tothrs).value=Math.abs(diff.hours().toString() + '.'+  diff.minutes().toString()); 
//     //   }
//     //  else{
       
//     //   //alert('Off time should be greater than On time');
//     //      document.getElementById("Rat_"+ tothrs).value=Math.abs(diff.hours().toString() + '.'+  diff.minutes().toString());
//     // }
    
  
//     // }
// }




// function getCountSub() {
//     var counting  = $('#Listing_table tr:last').attr('id');
//     var result = counting.split("_")[2];
//     $('#maxCountSub').val(result);
// }


// function batchno(id) {
// var weight= parseFloat(document.getElementById('Actweight').value);
// var totpdnmtr=parseFloat(document.getElementById('TotProdMtr').value);
// document.getElementById('TotProdKg').value=weight * totpdnmtr;
// }

// function Hrs(selectid)
// {
 
//  var dgontime= selectid.split("_")[1];
//  var ontime=document.getElementById("Rate_" + dgontime).value;
//  var DGontime=document.getElementById("Rate_" + dgontime).value.split(':');
//  var dgofftime= selectid.split("_")[1];
//  var DGofftime=document.getElementById("Note_" + dgofftime).value.split(':');
//  var offtime=document.getElementById("Note_" + dgofftime).value;
//  var tothrs= selectid.split("_")[1]; 
    
    
//         var day = '1/1/1970 ', // 1st January 1970
//         start = ontime, //eg "09:20 PM"
//         end = offtime, //eg "10:00 PM"
//         diff_in_min = ( Date.parse(day + end) - Date.parse(day + start) ) / 1000 / 60; 
//         d = Number(diff_in_min * 60);
//         var h = Math.floor(d / 3600);
//         var m = Math.floor(d % 3600 / 60);
//         var s = Math.floor(d % 3600 % 60); 
//         console.log(Date.parse(day));
//         console.log(Date.parse(day + start));

//       // document.getElementById("Rat_"+ tothrs).value=""+h+" hr :" +m +" m";
//          document.getElementById("Rat_"+ tothrs).value=""+h+"." +m +"";
// }

          

// // Convert H:M:S to seconds
// // Seconds are optional (i.e. n:n is treated as h:s)
// function hmsToSeconds(times) {
//     console.log(times);
//   var b = times.split(':');
//   return b[0]*3600 + b[1]*60 + (+b[2] || 0);
// }          

// // Convert seconds to hh:mm:ss
// // Allow for -ve time values
// function secondsToHMS(secs) {
//   function z(n){return (n<10?'0':'') + n;}
//   var sign = secs < 0? '-':'';
//   secs = Math.abs(secs);
//   //return sign + z(secs/3600 |0) + ':' + z((secs%3600) / 60 |0) + ':' + z(secs%60);
//   return sign + z(secs/3600 |0) + ':' + z((secs%3600) / 60 |0);
// }

                          
// // function timediff(currId,firstTime,secondTime,toDispId,typ){
// //     if(typ=='clone'){
// //     var clonCount= currId.split("_")[1];
// //     var tF = $('#'+firstTime+'_'+clonCount).val();
// //     var tS = $('#'+secondTime+'_'+clonCount).val();
// //     }else{
// //     var tF = $('#'+firstTime).val();
// //     var tS = $('#'+secondTime).val();
// //     }
    
// //     var dF = new Date(2019,01,01,tF.split(":")[0],tF.split(":")[1],00);
    
// //     if((tF.split(":")[0]>tS.split(":")[0])&& (tF.split(":")[1]>tS.split(":")[1])){
// //     var dS= new Date(2019,01,02,tS.split(":")[0],tS.split(":")[1],00);    
// //     }else if((tF.split(":")[0]==tS.split(":")[0]) && (tF.split(":")[1]>tS.split(":")[1])){
// //     var dS = new Date(2019,01,02,tS.split(":")[0],tS.split(":")[1],00);        
// //     }else{
// //     var dS = new Date(2019,01,01,tS.split(":")[0],tS.split(":")[1],00);        
// //     }

// //     var diff = secondsToHMS((dF - dS) / 1000); 

// //     if(diff.substring(0, 1)=='-'){
// //       diff = secondsToHMS((dS - dF) / 1000); 
// //     }
// //     if(typ=='clone'){
// //     $('#'+toDispId+'_'+clonCount).val(diff);
// //     }else{
// //     $('#'+toDispId).val(diff);    
// //     }
// // }
    
    
                              
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
//     if((tS.split(":")[0]>tF.split(":")[0])){
       
//      var dS = new Date(2019,01,01,tS.split(":")[0],tS.split(":")[1],00); 
       
//     }
//     else{
//          var dS = new Date(2019,01,01,(parseInt(tS.split(":")[0])+parseInt(24)),tS.split(":")[1],00); 
         
//     }
    
//     // if((tF.split(":")[0]>tS.split(":")[0])&& (tF.split(":")[1]>tS.split(":")[1])){
//     // var dS= new Date(2019,01,02,tS.split(":")[0],tS.split(":")[1],00);    
//     // }else if((tF.split(":")[0]==tS.split(":")[0]) && (tF.split(":")[1]>tS.split(":")[1])){
//     // var dS = new Date(2019,01,02,tS.split(":")[0],tS.split(":")[1],00);        
//     // }else{
//     // var dS = new Date(2019,01,01,tS.split(":")[0],tS.split(":")[1],00);        
//     // }

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
    

// function ppdate(date_ID,shift_ID){
//   var pdate = document.getElementById(date_ID).value;
//     var cid = document.getElementById(shift_ID).value; 

//     $.post(basePath + "/lib/ajax/date.php", {'cid':cid,'pdate':pdate}, function (data) {
       
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }
// ////////////////////////////

// function oee(sdate_ID,edate_ID,shift_ID){
//   var sdate = document.getElementById(sdate_ID).value;
//   var edate = document.getElementById(edate_ID).value; 
//   var cid = document.getElementById(shift_ID).value; 

//     $.post(basePath + "/lib/ajax/oee.php", {'sdate':sdate,'edate':edate,'cid':cid}, function (data) {
       
//         $('#showData').empty();
        
//         // EXTRACT VALUE FOR HTML HEADER. 
//         // ('Book ID', 'Book Name', 'Category' and 'Price')
//         var col = [];
//         for (var i = 0; i < data.length; i++) {
//             for (var key in data[i]) {
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
//                 }
//             }
//         }


//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }
// ///////////////////////////////////////////////////  
// function oppermin(proid)
// {
   
//     $.post(basePath + "/lib/ajax/sopperminute.php", {'proid': proid}, function (data) {
        
//      document.getElementById('CycleTime').value=data[0]['CycleTime'];
      
        
//     }, "json");  
//      console.log('hi');  
    
// }
// function sopoutput(pdt_id)
// {
   
//     $.post(basePath + "/lib/ajax/sopproduct.php", {'pdt_id': pdt_id}, function (data) {
        
//      var out=data[0]['CycleTime'];
     
//      document.getElementById('outputpermin').value=60/out;
     
//      //console.log('hello');   
        
//     }, "json");  
    
// }
// /////////////////////////////////////////

// function Prodfil(basepath,prodtypeval,prodID)
// {
    
//     console.log(prodtypeval);
//      console.log(prodID);
//      console.log(basepath);
//         $.post(basepath + "/lib/ajax/work.php", {'woID': prodtypeval}, function (data) {
//      console.log(data);
//     $('#'+prodID).empty();
//     $("#"+prodID).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+prodID).append($('<option></option>').val(this.ID).text(this.PlanCode))
//     });
   
//  }, "json");    
     
    
// }
// function plancode(ID) {
    
//     //console.log("hello");
   
//  var planID = $('#' + ID).val();
 
//   $('#producttype_ID').empty();
//   $('#product_ID').empty();
//   $('#unit_ID').empty();
//   // $('#Quantity').empty();

// // $('#producttype_ID').val('');
// // $('#product_ID').val('');
// // $('#unit_ID').val('');
//  $('#Quantity').val('');
//  $('#RemainingQty').val('');
 
  
// $.post(basePath + "/lib/ajax/plandata.php", {'planID': planID}, function (data) { 
    
    

// $.each(data, function() {
//   // $("#producttype_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
//   $('#producttype_ID').append($('<option></option>').val(this.pdtID).text(this.item))
//   // $("#product_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
//   $('#product_ID').append($('<option></option>').val(this.pdtID).text(this.descp))
//   // $("#unit_ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
//   $('#unit_ID').append($('<option></option>').val(this.unitID).text(this.unit))
  
//   });
// // console.log(ID);
// // $.each(data, function() {
// //   $("#ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
// //   $('#product_ID').append($('<option></option>').val(this.ID).text(this.Description))
// //   });
// // $.each(data, function() {
// //   $("#ID").prepend('<option value="" disabled selected style="display:none;">Select</option>');
// //   $('#unit_ID').append($('<option></option>').val(this.ID).text(this.UnitName))
// //   });
   

// // $('#producttype_ID').val(data["0"].ItemName);
// // $('#product_ID').val(data["0"].Description);
// // $('#unit_ID').val(data["0"].UnitName);
// //var pqty=$('#Quantity').val(data["0"].PlanQuantity);
// var pqty=parseInt(document.getElementById("Quantity").value=data["0"].PlanQuantity);
// //var pqty=parseFloat($('#Quantity').val(data["0"].PlanQuantity));
//  var wqty=data["0"].WorkQuantity;
 
// console.log(pqty);
// console.log(wqty);
// if(wqty == 0){
    
//  $('#RemainingQty').val(data["0"].PlanQuantity);
// }
// else{
//     document.getElementById("RemainingQty").value=pqty-wqty;
// }
//  }, "json");   
// }

// function oninspec(id){
    
// var accepqty=$('#AcceptedQty').val();
// var rejectqty=$('#RejectedQty').val();
// var reworkqty=$('#ReworkQty').val();
// document.getElementById("RejectionPPM").value=(rejectqty/accepqty)*1000000;
// document.getElementById("ReworkPPM").value=(reworkqty/accepqty)*1000000;


// }
// function uom(uomid,selectid)
// {
//   var unitid= selectid.split("_")[1];
//     $.post(basePath + "/lib/ajax/uomdata.php", {'uomid': uomid}, function (data) {
//      document.getElementById("Amount_" + unitid).value=data[0]['UnitName'];  
    
//     }, "json");  
    
// }

// function plan(){
    
//     var planqty=document.getElementById("Quantity").value;
//     var workqty=document.getElementById("WorkQuantity").value;
//     var rqty=document.getElementById("RemainingQty").value=planqty;
   
//     if(parseFloat(rqty)<=parseFloat(workqty)){
//         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
//         document.getElementById("RemainingQty").value=planqty;
//         document.getElementById("WorkQuantity").value='';
//     }else{
//     var remainqty=document.getElementById("RemainingQty").value=rqty-workqty;   
//     }
// }

// function getpedetails(basePath,ID,typ){
   
//     var peid=ID; 
//     $.post(basePath + "/lib/ajax/get_pe.php", {'peid': peid,'typ':typ}, function (data) {
        
//         $('#showData').empty();
        

//  var col = [];
       
//         for (var i = 0; i < data.length; i++) {
            
//             for (var key in data[i]) {
//               if (key=='RawMaterial' || key=='LotNo' || key =='PO Quantity'  || key =='Actual Quantity' || key=='Unit' || key=='Accepted Quantity' || key=='Rejected Quantity'|| key=='Remarks'){
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
                
//                 }
//             }
//         }
// }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          //table.setAttribute('id', 'showData1');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
// }

// function getGrnForQa(basePath,idd){
 
 
//   $('#GRNNo').empty();
//   $.post(basePath + "/lib/ajax/get_grn.php", {'poid': idd}, function (data) { 

//   $.each(data, function() {
//   $("#GRNNo").prepend('<option value="" disabled selected style="display:none;">Select</option>');
//   $('#GRNNo').append($('<option></option>').val(this.ID).text(this.PurchaseEntryNo));
//   }); 
//  });
// }

// function matissue(selectid){
      
// var id= selectid.split("_")[1];
// var apqty=parseFloat(document.getElementById("approvedqty_" + id).value);
// var issuqty=parseFloat(document.getElementById("Water_"+id).value);

// if(apqty < issuqty || issuqty==0){
//     document.getElementById("Water_"+id).value='';
//     alert('Issued Quantity should not be greater than approved quantity');
// }
// else{
//     document.getElementById("Water_"+id).value;
   
    
// }
 
// }

// function unit(uomid,selectid)
// {
//   var unitid= selectid.split("_")[1];
//     $.post(basePath + "/lib/ajax/unitofmeasurement.php", {'uomid': uomid}, function (data) {
//     $('#showData').empty();
        

//  var col = [];
       
//         for (var i = 0; i < data.length; i++) {
            
//             for (var key in data[i]) {
//               if (key=='RawMaterial' || key=='RawMaterial Mixing Precentage' || key =='Unit Of Measurement' ){
//                 if (col.indexOf(key) === -1) {
//                     col.push(key);
                
//                 }
//             }
//         }
// }

//         // CREATE DYNAMIC TABLE.
//         var table = document.createElement("table");
        
//         table.setAttribute('class', 'table table-bordered');
//          //table.setAttribute('id', 'showData1');

//         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

//         var tr = table.insertRow(-1);                   // TABLE ROW.

//         for (var i = 0; i < col.length; i++) {
//             var th = document.createElement("th");      // TABLE HEADER.
//             th.innerHTML = col[i];
//             tr.appendChild(th);
//         }

//         // ADD JSON DATA TO THE TABLE AS ROWS.
//         for (var i = 0; i < data.length; i++) {

//             tr = table.insertRow(-1);

//             for (var j = 0; j < col.length; j++) {
//                 var tabCell = tr.insertCell(-1);
//                 tabCell.innerHTML = data[i][col[j]];
//             }
//         }

//         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
//         var divContainer = document.getElementById("showData");
//         divContainer.innerHTML = "";
//         divContainer.appendChild(table);

//     }, "json");  
    
// }

// // Add two times in hh:mm format
// function addTimes(t0, t1) {
//   return secondsToHMS(hmsToSeconds(t0) + hmsToSeconds(t1));
// }

// // subtract two times in hh:mm format
// function subTimes(t0, t1) {
//   return secondsToHMS(hmsToSeconds(t0) - hmsToSeconds(t1));
// }

// function calcTotPrdHrs(fromTimeId,toTimeId,toDispId){
//      var fromTime = $('#'+fromTimeId).val();
//      console.log(fromTime);
//      var totalToTime = '00:00';
     
//      $('[id^='+toTimeId+'_]').each(function () {
//         totalToTime = addTimes(totalToTime,this.value);
//      });
     
//      var actTotProHrs = subTimes(fromTime, totalToTime);
     
//      var hrMin = actTotProHrs.split(':');

//      // Hours are worth 60 minutes.
//      var actMins = (+hrMin[0]) * 60 + (+hrMin[1]);
     
//      $('#'+toDispId).val(actMins);
// }

// function getBatchforStkRtn(basePath, MatIssDate, toDispId){
    
//   $('#'+toDispId).empty();
//   $('#'+toDispId).val("");
   
//   $.post(basePath + "/lib/ajax/get_batchno.php", {'midate': MatIssDate}, function (data) { 
   
//   $("#"+toDispId).prepend('<option value="" >Select</option>');    
  
//   $.each(data, function() {
//   $('#'+toDispId).append($('<option></option>').val(this.ID).text(this.BatchNo));
//   }); 
//  });
 
// }

// function get(basePath,Batchid,toDispId){
    
//   $('#'+toDispId).empty();
//   $('#'+toDispId).val("");
//   $.post(basePath + "/lib/ajax/get_misno.php", {'Batchid': Batchid}, function (data) { 
       
//     $("#"+toDispId).prepend('<option value="" >Select</option>');

//   $.each(data, function() {
//   $('#'+toDispId).append($('<option></option>').val(this.ID).text(this.MaterialIssueNo));
//   }); 
//  });
 
// }

// function getarea(basePath,misID,toDispId, Area_idvalue){





// $('#'+toDispId).val("");

  
// $.post(basePath + "/lib/ajax/get_area.php", {'misID': misID}, function (data) { 

//  $('#'+toDispId).val(data["0"]['AreaName']);
//  $('#'+ Area_idvalue).val(data["0"]['ID']);

//     }, "json");   

 
// }

// function validateExist(id,tableBodyId) {
    
//     var Seee = id.split("_")[0];
//     var idid = id.split("_")[1];
    
//     var selectedvalue = document.getElementById(id).value; 
    
//     var count = document.getElementById(tableBodyId).getElementsByTagName("tr").length;
    
//         if(count>1)
//         {
//             for(i=1;i<=count;i++){
//                 var rowvalue = document.getElementById(Seee+"_"+i).value; 
                    
//                 if(selectedvalue==rowvalue && id != Seee+"_"+i)
//                 {
//                     document.getElementById(id).value="";
//                     alert("Already Selected");
//                     document.getElementById('Grade_' + idid).value="";
//                     document.getElementById('Unit_' + idid).value="";
//                     document.getElementById('IssuedQuantity_' + idid).value="";
//                     // $('#Grade_'+idid).val("");
                                    
//                     break;
//                 }
//             }
//         }
//     }



//  function getItemName(id,iname){

//     var ItemName = $("#"+id+" option:selected").text();

//     var result = id.split("_")[1];
//     $('input[name='+iname+result+']').val(ItemName);

// }


// function getItName(id){

//     var ItemName = $("#"+id+" option:selected").text();
//     console.log(ItemName);
//     $('#materialissue_value').val(ItemName);
// }





// function getrawmaterial(basePath,rmid,id){

 
// $.post(basePath + "/lib/ajax/get_rawname.php", {'rmid': rmid}, function (data) { 


//     $('#'+("ItemNo_" + 1)).empty();
    
//     $("#"+("ItemNo_" + 1)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+("ItemNo_" + 1)).append($('<option></option>').val(this.ID).text(this.RMName))
//     });
     

// }, "json");  

  
// } 
// function shift(mid){
 
  
// // $.post(basePath + "/lib/ajax/get_plan.php", {'mid': mid}, function (data) { 

// // var days=document.getElementById('PlanDate').value;
// // var pdate = new Date(data[0]['PlanDate']);
// // // console.log(pdate)
// // var nodays=Math.round(data[0]['NoofdaysReq']);
// // pdate.setDate(pdate.getDate() + nodays);

// // var dd = pdate.getDate();
// // var mm = pdate.getMonth() + 1;
// // var y =  pdate.getFullYear();

// // var someFormattedDate = y +'-0'+ mm +'-'+dd;
// // console.log(someFormattedDate);

// // if(days>=someFormattedDate){
// //   document.getElementById('machine_ID').value;
// // }
// // else{
    
// //     alert('This machine already added in plan');
// //   document.getElementById('machine_ID').selectedIndex =0;
// // }
  
// //     }, "json");  
// }
// function work(woid){
    
//     $.post(basePath + "/lib/ajax/wodata.php", {'woid': woid}, function (data) { 
//       var rqty=document.getElementById("RemainingQty").value=data[0]["RemainingQty"];
//     }, "json");  
// }

// function remain(ID) {

//  var woid = $('#' + ID).val();
//  console.log(woid);
 
   
   
//     // var workqty=document.getElementById("WorkQuantity").value;
    
//     // $.post(basePath + "/lib/ajax/wodata.php", {'woid': woid}, function (data) {
//     //     var wkqty=data["0"].WorkQuantity;
//     //      var planqty=data["0"].PlanQuantity;
//     //     if(woid!==0){
//     //         document.getElementById("RemainingQty").value=planqty;
        
//     //     if(parseFloat(planqty)<=parseFloat(workqty)){
//     //     alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
//     //     document.getElementById("RemainingQty").value=planqty;
//     //     document.getElementById("WorkQuantity").value='';
//     //     }else{
//     //     document.getElementById("RemainingQty").value=planqty-workqty;   
//     // }
//     // }
//     //  else{
//     //      var remainingqty=planqty-wkqty;
//     //      console.log(remainingqty);
//     //      document.getElementById("RemainingQty").value=remainingqty;
//     //      if(parseFloat(planqty)<=parseFloat(remainingqty)){
//     //     alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
//     //     document.getElementById("RemainingQty").value=planqty;
//     //     document.getElementById("WorkQuantity").value='';
//     //     }else{
//     //     document.getElementById("RemainingQty").value=planqty-remainingqty;   
//     // }
//     //  }   
    
    
// //   document.getElementById("RemainingQty").value=planqty;
   
// //     if(parseFloat(rqty)<=parseFloat(workqty)){
// //         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
// //         document.getElementById("RemainingQty").value=planqty;
// //         document.getElementById("WorkQuantity").value='';
// //     }else{
// //     var remainqty=document.getElementById("RemainingQty").value=rqty-workqty;   
// //     }
   
// //  $('#Quantity').val('');
//  //$('#RemainingQty').val('');
// //  var prodplan=document.getElementById("productionplan_ID").value;
// //  console.log(prodplan);
  
// $.post(basePath + "/lib/ajax/wodata.php", {'woid': woid}, function (data) { 
 
//  var planqty=document.getElementById("Quantity").value;
//  console.log(planqty);
// var workqty=document.getElementById("WorkQuantity").value;
// var wqty=data["0"].WorkQuantity;
// var pqty=data["0"].PlanQuantity;
// console.log(pqty);
// if(wqty == 0){
//  document.getElementById("RemainingQty").value=planqty;    
//   if(planqty<=workqty){
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
//   var rqy=document.getElementById("RemainingQty").value=pqty-wqty;
//   console.log(rqy);
//   if(parseFloat(pqty)<=parseFloat(wqty)){
//         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
//       document.getElementById("RemainingQty").value=pqty;
//         document.getElementById("WorkQuantity").value='';
//     }else{
//     document.getElementById("RemainingQty").value=pqty-wqty;   
//     }
  
//  }
 
//  }, "json");   

// // var planqty=document.getElementById("Quantity").value;
// //  console.log(planqty);
// // //var workqty=document.getElementById("WorkQuantity").value;
// // var wqty=data["0"].WorkQuantity;
// // var pqty=data["0"].PlanQuantity;
// // if(wqty == 0){
// //  document.getElementById("RemainingQty").value=planqty;    
// //   if(parseFloat(planqty)<=parseFloat(workqty)){
// //         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
// //         document.getElementById("RemainingQty").value=planqty;
// //         document.getElementById("WorkQuantity").value='';
// //     }else{
// //     document.getElementById("RemainingQty").value=planqty-workqty;   
// //     }
// // }
// // else{
 
// //   console.log(wqty);
 
// //   console.log(pqty);
// //   document.getElementById("RemainingQty").value=pqty-wqty;
// // //   if(parseFloat(qty)<=parseFloat(wqty)){
// // //         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
// // //       // document.getElementById("RemainingQty").value=qty;
// // //         document.getElementById("WorkQuantity").value='';
// // //     }else{
// // //     document.getElementById("RemainingQty").value=planqty-wqty;   
// // //     }
  
// //  }
 
// //  }, "json");   

// }

// function plans(){
    
//     var rqty=parseFloat(document.getElementById("RemainingQty").value);
//     var workqty=parseFloat(document.getElementById("WorkQuantity").value);
  
//   if(workqty>rqty ){
//     // if(parseFloat(rqty)<=parseFloat(workqty)){
//         alert('Plan is Exceed,Workorder Quantity should not be greater than planQuantity');
//         document.getElementById("RemainingQty").value=rqty;
//         document.getElementById("WorkQuantity").value='';
//     }else{
        
//     var remainqty=document.getElementById("RemainingQty").value=rqty-workqty;   
    
//     }
  
//     console.log('helo');
// }



// function bom(selectid)
// {
//     // console.log(selectid);

//   var unitid= selectid.split("_")[1];
   
//   var unit= selectid.split("_")[0];
// //    console.log(unit);
  
//   if(unit != 'REM')
//   {
//  var qty=document.getElementById("Quantity_" + unitid).value; 
 
//   if(qty=='' || qty==0){
//       alert("Please enter quantity which should not be zero");
//       document.getElementById("Quantity_" + unitid).value='';
//   }
//   else{
//       document.getElementById("Quantity_" + unitid).value;
//   }

// }

//     var maxcount =  document.getElementById('maxCount').value;
//     var totalQuantity = 0 ;

//     for(var i = 1; i <= maxcount;i++)
//     {
         
//         var check = document.getElementById('Quantity_'+i) ;
        
//         if(check == null ) 
//         {
//             // console.log('here the data is empty');

//             continue ;
//         }
//         else
//         {
//         var firstRQuantity =  document.getElementById('Quantity_'+i).value;
        
//         var totalQuantity = Number(totalQuantity) + Number(firstRQuantity);
//         }

//     }
//         // console.log(totalQuantity);
//         document.getElementById('totalQuantity').value =  totalQuantity ; 


// }



// function matreq(selectid)
// {
//   var unitid= selectid.split("_")[1];
//  var qty=document.getElementById("Water_" + unitid).value;
 
//   if(qty=='' || qty==0){
//       alert("Please enter quantity which should not be zero");
//       document.getElementById("Water_" + unitid).value='';
//   }
//   else{
//       document.getElementById("Water_" + unitid).value;
//   }
//   console.log("hello");
// }

// function getissue(basePath,rmid,id){

// //   var id= selectid.split("_")[1];
// var rmid=document.getElementById("workorder_ID").value;
// console.log(rmid);
// $.post(basePath + "/lib/ajax/get_matissu.php", {'rmid': rmid}, function (data) { 


//     $('#'+("ItemNo_" + 1)).empty();
    
//     $("#"+("ItemNo_" + 1)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
//     $.each(data, function() {
//         $('#'+("ItemNo_" + 1)).append($('<option></option>').val(this.ID).text(this.RMName))
//     });
     

// }, "json");  

 
// } 

// // function getdcproduct(basePath,id){

// // //   var id= selectid.split("_")[1];
// // var dcid=document.getElementById(id).value;


// // $.post(basePath + "/lib/ajax/get_dcproduct.php", {'dcid': dcid}, function (data) { 

// //         $('[id^=ItemName_]').empty();
// //         $('[id^=ItemName_]').prepend('<option value=""  >Select</option>');
// //         $.each(data, function() {
// //             $('[id^=ItemName_]').append($('<option ></option>').val(this.ID).text(this.ItemName));
// //           });

// // }, "json");  

 
// // } 

// // function getdcproductdetail(basePath,val,id){

// //   var splitid= id.split("_")[1];

// // $.post(basePath + "/lib/ajax/get_dcdetail.php", {'pdtid': val}, function (data) { 
    
// //      document.getElementById("Note_" + splitid).value=data[0]['Quantity'];
// //      document.getElementById("Emp_" + splitid).value=data[0]['Quantity'];

      
// // }, "json");  

 
// // } 
// function selectAll() {
//         var checkboxes = new Array();
//         checkboxes = document.getElementsByName('ycs_ID');
//         for (var i = 0; i < checkboxes.length; i++) {
//             if (checkboxes[i].checked == true) {
//                 checkboxes[i].checked = false;
//             }else{
//                 checkboxes[i].checked = true;
//             }
//         }
// }

// function restrictCheck(Msgtxt) {
//         var checkboxes = new Array();
//         checkboxes = document.getElementsByName('ycs_ID');
        
//         var myListSel = [];
//         $.each($("input[name='ycs_ID']:checked"), function(){            
//             myListSel.push($(this).val());
//         });
        
//         console.log(myListSel);
        
//         if(myListSel.length>1){
//             alert('Please select on row to '+Msgtxt);
//             return false;
//         }
// }
// function Quantity(selectid){

//     var poqty= selectid.split("_")[1];
    
    
//     var pqty=parseFloat(document.getElementById("Quantity_" + poqty).value);
    
//     // var actualqty=selectid.split("_")[1];
//     var acqty=document.getElementById("Water_"+ poqty).value;
    
    
//      if(acqty>pqty){
//           document.getElementById("Water_" + poqty).value="";
//           document.getElementById("Water_" + poqty).focus();
          
//           alert("Actual Quantity should not be greater than PO Quantity");
//       }
    
//      else if(acqty<=pqty){
    
//             document.getElementById("Water_" + poqty).value=acqty;
//           }
      
     
//     }


// function qty(id){
	
// 	var TotInspQty = document.getElementById('TotInspQty').value;
// 	var AcceptedQty = document.getElementById('AcceptedQty').value;
// 	var RejectedQty = document.getElementById('RejectedQty').value;
// 	var ReworkQty = document.getElementById('ReworkQty').value;

	
// 	if((RejectedQty.length == 0 && ReworkQty.length == 0) && AcceptedQty.length != 0){
// 	if(Number(AcceptedQty) > Number(TotInspQty))
// 	{
// 		console.log('hello accepted');
// 		var alrt = alert ('Acccepted Mtrs/Qty can\'t be greater than Total Inspection Mtrs/Qty ');		
// 		document.getElementById(id).value = '';	
// 		document.getElementById(id).focus();
// 	}
// 	}



	
// 	var acceptedReworkTotal = Number(AcceptedQty) + Number(ReworkQty);
	
	
// 	if( ReworkQty.length != 0 && AcceptedQty.length != 0){
	
// 	if(Number(acceptedReworkTotal) > Number(TotInspQty))
// 	{
	
// 			console.log('rework is focus');
			
// 		alert('Acccepted Mtrs/Qty + Rework Mtr/Qty = ' +acceptedReworkTotal+' - can\'t be more than Total Inspection Mtrs/Qty');
		
// 		document.getElementById(id).value = '';	
// 		document.getElementById(id).focus();	
		
// 	}
// 	}
	
	

	
// 	var acceptedReworkRejectTotal = Number(AcceptedQty) + Number(ReworkQty) + Number(RejectedQty);
	
// 	if( (RejectedQty.length != 0 && ReworkQty.length != 0 && AcceptedQty.length != 0)){
// 	if( Number(acceptedReworkRejectTotal) > Number(TotInspQty) || Number(acceptedReworkRejectTotal) < Number(TotInspQty) )
// 	{
// 		alert( 'Total of Acccepted Mtrs/Qty + Rework Mtr/Qty + Rejected Mtr/Qty = '+acceptedReworkRejectTotal+ ' - can\'t be greater or less than Total Inspection Mtrs/Qty' )
		
// 		document.getElementById(id).value = '';	
// 		document.getElementById(id).focus();
// 	}
	
// 	}
	
// 	var indivigualValue = document.getElementById(id).value;
	
// 	if (Number(indivigualValue) > Number(TotInspQty)  )
// 	{
// 		alert('Value can\'t be greater than Total Inspection Mtrs/Qty');
// 		document.getElementById(id).value = '';	
// 		document.getElementById(id).focus();
// 	}
	
	

// }


// function taxChoise()
// {
//       var CGST_SGST = document.getElementById('CGST_SGST').checked;
//       var IGST = document.getElementById('IGST').checked;
   
//   if(IGST == true)
//   {
//     document.getElementById('CGSTTax').readOnly = true ;
//     document.getElementById('SGSTTax').readOnly = true ;
//     document.getElementById('CGSTTax').value =0;
//     document.getElementById('SGSTTax').value =0;
//     document.getElementById('CGSTAmount').value =0;
//     document.getElementById('SGSTAmount').value =0;

//   }
//   else{
//   document.getElementById('CGSTTax').readOnly = false ;
//     document.getElementById('SGSTTax').readOnly = true ;
//     document.getElementById('CGSTTax').value =9; 
//     document.getElementById('SGSTTax').value =9;
	
		
//   }
   
//   if(CGST_SGST==true)
//   {
//     document.getElementById('IGSTTax').readOnly = true ;
//     document.getElementById('IGSTTax').value =0;
//     document.getElementById('IGSTAmount').value =0;


//   }
//   else{
//     document.getElementById('IGSTTax').readOnly = false ;
//     document.getElementById('IGSTTax').value =18;

//   }
  
 
// }


// function onlyNumberKey(evt) {

//         // Only ASCII charactar in that range allowed
//         var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        
       
//         if (ASCIICode>44 && ASCIICode<58) {
//             return true; 
//         }
//         if( (ASCIICode== 190) || (ASCIICode==08))
//         {
//             return true;
//         }
//         return false; 
//     } 

// function onlyNumber(evt,id) {

//     var valuee = document.getElementById(id).value;

    
//     if(valuee == 0 && valuee != "") {
//         alert('Quantity can\'t be zero or less than zero');
//         document.getElementById(id).value = "";
//     }
//         // Only ASCII charactar in that range allowed
//         var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        
       
//         if (ASCIICode>44 && ASCIICode<58) {
//             return true; 
//         }
//         if( (ASCIICode== 190) || (ASCIICode==08))
//         {
//             return true;
//         }
        
//         return false; 
// } 

// function quantityvalidation(id,value)
// {
//     // console.log(id);
//     // console.log(value);
//     var retquantity = id.split('_')[1];
   
//     // console.log(retquantity);

//     var issued = document.getElementById('IssuedQuantity_'+retquantity).value;
//     console.log(issued);
   
//     if(parseInt(value) > parseInt(issued))
//     {
//         alert('Return Quantity cant be more than Issued Quantity');
//         document.getElementById('ReturnQuantity_'+retquantity).value="";
//         document.getElementById('ReturnQuantity_'+retquantity).focus=true;
//     } 
//     if(parseInt(value) == 0 || parseInt(value) == "" )
//     {
//         alert('Invalid choise');
//         document.getElementById('ReturnQuantity_'+retquantity).value="";
//         document.getElementById('ReturnQuantity_'+retquantity).focus=true;
//     }

// }

// function checkqty(selectid){


// var id= selectid.split("_")[1];




// var acceptqty=parseFloat(document.getElementById("EmpName_" + id).value);



// var actualqty=document.getElementById("Water_"+ id).value;


// var reject=document.getElementById("Amount_" + id).value;


// var rejected=actualqty-acceptqty;

// var pqty=parseFloat(document.getElementById("Quantity_" + id).value);

// // var actualqty=selectid.split("_")[1];



//  if(actualqty>pqty){
//       document.getElementById("Water_" + id).value="";
//       document.getElementById("Water_" + id).focus();
      
//       alert("Actual Quantity should not be greater than PO Quantity");
//   }

//   if(actualqty<=pqty){

//         document.getElementById("Water_" + id).value=actualqty;
        
//     if(acceptqty>actualqty){
//       document.getElementById("EmpName_" + id).value='';
//       document.getElementById("Amount_" + id).value='';
//       document.getElementById("EmpName_" + id).focus();
      
//       alert("Accepted Quantity should not be greater than Actual Quantity");
//   }

//   else if(acceptqty<=actualqty){

//          document.getElementById("Amount_" + id).value=actualqty-acceptqty;
//       }
      
      
//   }
//   else{
//       document.getElementById("Water_" + id).focus();
//   }
// }

// function productvalue(val)
// {

// var dataa = val.trim();
// // console.log(dataa);

//     if(dataa== 0 || dataa == " " )
//     {
//         // document.getElementById('Rat_1').value = ' ';
//         // document.getElementById('Water_1').value = ' ';
//         document.getElementById('Rat_1').readOnly = true ;
//         document.getElementById('Water_1').readOnly = true ;
//     }

//     if(dataa != 0 || dataa != '')
//     {
//         document.getElementById('Rat_1').readOnly = false ;
//         document.getElementById('Water_1').readOnly = false ;
//     }

// }
// // function getdeliverychallandetails(basePath, ID){
   
// //     var dcid = ID; 

// //     $.post(basePath + "/lib/ajax/get_deliverychallan_details.php", {'dcid': dcid}, function (data) {
        
// //     console.log(data);
    
    
// //         document.getElementById('DeliveryDate').value=data[0]['DeliveryDate'];
        
// //         if(data[0]['TaxChoice']=='CGST_SGST'){
// //         document.getElementById('CGST_SGST').checked=true;
// //         }
// //         else{
// //              document.getElementById('IGST').checked=true;
// //         }
// //         //document.getElementById('IGST').checked=data[0]['TaxChoice'];
// //         document.getElementById('DeliveryChoice').checked=data[0]['DeliveryChoice'];
// //         document.getElementById('customername').value=data[0]['FirstName'];
// //         document.getElementById('subtotal').innerHTML =data[0]['BillAmount'];
// //         document.getElementById('CGSTTax').value=data[0]['CGSTTax'];
// //         document.getElementById('CGSTAmount').value=data[0]['CGSTAmount'];
// //         document.getElementById('SGSTTax').value=data[0]['SGSTTax'];
// //         document.getElementById('SGSTTax').value=data[0]['SGSTTax'];
// //         document.getElementById('SGSTAmount').value=data[0]['SGSTAmount'];
// //         document.getElementById('IGSTTax').value=data[0]['IGSTTax'];
// //         document.getElementById('IGSTAmount').value=data[0]['IGSTAmount'];
// //         document.getElementById('Total').innerHTML =data[0]['NetAmount'];
      
        
// //         $('#showData').empty();
        
// //         // // EXTRACT VALUE FOR HTML HEADER. 
// //         // // ('Book ID', 'Book Name', 'Category' and 'Price')
        
// //  var col = [];
       
// //         for (var i = 0; i < data.length; i++) {
            
// //             for (var key in data[i]) {
               
// //                 if (key=='Part Name' || key =='HSN' || key=='Quantity' ||  key=='Rate' || key=='Amount'){
// //                 if (col.indexOf(key) === -1) {
// //                     col.push(key);
// //                 }
// //                 }
// //             }
// //         }

// //         // CREATE DYNAMIC TABLE.
// //         var table = document.createElement("table");
        
// //         table.setAttribute('class', 'table table-bordered');
// //          //table.setAttribute('id', 'showData1');

// //         // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

// //         var tr = table.insertRow(-1);                   // TABLE ROW.

// //         for (var i = 0; i < col.length; i++) {
// //             var th = document.createElement("th");      // TABLE HEADER.
// //             th.innerHTML = col[i];
// //             tr.appendChild(th);
// //         }

// //         // ADD JSON DATA TO THE TABLE AS ROWS.
// //         for (var i = 0; i < data.length; i++) {

// //             tr = table.insertRow(-1);

// //             for (var j = 0; j < col.length; j++) {
// //                 var tabCell = tr.insertCell(-1);
// //                 tabCell.innerHTML = data[i][col[j]];
// //             }
// //         }

// //         // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        
// //         var divContainer = document.getElementById("showData");
// //         divContainer.innerHTML = "";
// //         divContainer.appendChild(table);

// //     }, "json");  
// // }
////////newl added on 12.03.2020///////////////////

function tocheckqty(selectid, message){
   


    var id= selectid.split("_")[1];
    
    
    var pqty=parseFloat(document.getElementById("Water_" + id).value);
    
   
    var acqty=parseFloat(document.getElementById("BatchNo_"+ id).value);
    
    
     if(acqty>pqty){
          document.getElementById("BatchNo_" + id).value="";
          document.getElementById("BatchNo_" + id).focus();
          
          alert(message);
      }
    
     else if(acqty<=pqty){
    
            document.getElementById("BatchNo_" + id).value=acqty;
          }
      
     
    }
    
     function check(Msgtxt){
      
        if(document.getElementById("customer_ID").value===''){
             alert('please choose customer name');
             $('#customer_ID').focus();
             
             
        }
        else if(($('.check1').prop("checked") === false) && ($('.check2').prop("checked") === false)){
               
             $('#AlertModal').modal({show:true,keyboard: false,backdrop:'static'});               
              document.getElementById("alertbody").innerHTML = "please select Returnable or Non-Returnable";   
              $('#type0').focus();
              return false;
               
            }
        else if(document.getElementById("rawmaterialtype_ID").value===''){
             alert('please choose Material type');
             $('#rawmaterialtype_ID').focus();
        }
        
            else if(($('.check3').prop("checked") === false) && ($('.check4').prop("checked") === false)){
                
            $('#AlertModal').modal({show:true,keyboard: false,backdrop:'static'});               
            document.getElementById("alertbody").innerHTML = "please select CGST && SGST or IGST";   
            $('#type1').focus();
            return false;
            }
        
    }
    
    function pendingqty(selectid, message){
   


    var id= selectid.split("_")[1];
    
    var dqty=parseFloat(document.getElementById("Note_" + id).value);
    

    
    var rqty=parseFloat(document.getElementById("Amount_" + id).value);
    

   
    var pendqty=parseFloat(document.getElementById("Quantity_"+ id).value);
    

       
     if(rqty>dqty){
          document.getElementById("Amount_" + id).value="";
          document.getElementById("Quantity_" + id).value="";
          document.getElementById("Amount_" + id).focus();
          
          alert(message);
      }
    
     else if(rqty<=dqty){
    
            document.getElementById("Amount_" + id).value=rqty;
            document.getElementById("Quantity_" + id).value=dqty-rqty;
          }
      
     
    }
    
//     function getmaterial(basePath,val,selectid,todisplayid) {

//     var poid=val; 
    
//     var id= selectid.split("_")[1];
   

//     $.post(basePath+"/lib/ajax/get_raw.php", {'poid': poid}, function (data) {

//  console.log(data);
 
//   //$('#'+("ItemNo_" + id)).empty();
//   ($('#'+todisplayid +id).empty());
   
    
//     $("#"+todisplayid +id).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    
//     $.each(data, function() {
        
//       $("#"+todisplayid +id).append($('<option></option>').val(this.ID).text(this.RMName))
       
       
        
//     });
     

//     }, "json");   
// }  

function getmaterial(basePath,val,selectid) {
    
 
    var poid=val; 
    
    var id= selectid.split("_")[1];
    
    console.log(id);

    $.post(basePath+"/lib/ajax/get_raw.php", {'poid': poid}, function (data) {

  $('#'+("ItemNo_" + id)).empty();
   
   
    
    $("#"+("ItemNo_" + id)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
    
    $.each(data, function() {
        
        $('#'+("ItemNo_" + id)).append($('<option></option>').val(this.ID).text(this.RMName))
        
    });
     

    }, "json");  


}  

 function getunit(basePath,val,selectid) {

    var poid=val; 
    
    var id= selectid.split("_")[1];

    $.post(basePath+"/lib/ajax/get_unit.php", {'poid': poid}, function (data) {

    $('#'+("Rat_" + id)).empty();
    
    
     $("#"+("Rat_" + id)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
     
    $.each(data, function() {
       
        $('#'+("Rat_" + id)).append($('<option></option>').val(this.ID).text(this.UnitName))
  
    });
     

    }, "json");   
}  
function productremove(attachedid){
  
 
 $.post(basePath+"/lib/ajax/removeuploadedfile.php",{'purchaseentry_ID': attachedid},function(data) {
   
alert(data.message);
//location.reload(); 

 });
}

function stockmaterial(val,id){
 
 $.post(basePath+"/lib/ajax/stockmaterial.php",{'rawid': val},function(data) {
    
     if(data){
       
        var qty=data[0]['TotalQty'];

    if(qty<=0){
         alert('out of stock'); 
        // $('#'+(id)).empty();
         $("#"+(id)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
        //  $.each(data, function() {
        //  $('#'+(id)).append($('<option></option>').val(this.ID).text(this.RMName))
        //  });
    }
    
     }
     else{
         alert('no stock');
          $("#"+(id)).prepend('<option value="" disabled selected style="display:none;">Select</option>');
     }
     

 }, "json");  
}
 function addRequired(...restArgs){
        //console.log(restArgs.length); // Logs the number of arguments that do not have a corresponding parameter
       // console.log(restArgs[2]); // Logs the 3rd argument after the number of arguments that do not have a corresponding parameter
       var ii=0;
       for(ii;ii<=restArgs.length;ii++) {
           $("#"+restArgs[ii-1]).prop('required',true);
       }
    }
    
function machine(mid) {
    
 $('#machinecode').val('');  
$.post(basePath + "/lib/ajax/machineplan.php", {'woid': mid}, function (data) { 
    
 $('#machine_ID').empty();

$.each(data, function() {
   $('#machine_ID').append($('<option></option>').val(this.ID).text(this.MachineName))
   });
   

//  document.getElementById('machine_ID').value=data[0]['MachineName'];
 document.getElementById('machinecode').value=data[0]['MachineCode'];

    }, "json");   
}

function workquantity(){
    
    // var rqty=parseFloat(document.getElementById("RemainingQty").value);
    // var workqty=parseFloat(document.getElementById("WorkQuantity").value);
    var rqty=parseInt(document.getElementById("RemainingQty").value);
    var workqty=parseInt(document.getElementById("WorkQuantity").value);
     if(rqty!==''){
         
         if(workqty>0)
         {
             
             if(workqty<rqty){
             document.getElementById("RemainingQty").value=rqty-workqty;
             }
             else{
                 alert('Workorder Quantity should not be greater than Remaining Quantity');
                    document.getElementById("RemainingQty").value=rqty;
                    document.getElementById("WorkQuantity").value='';
             }
         }
        
         else {
                alert('Workorder Quantity should not be zero or less than zero');
                document.getElementById("RemainingQty").value=rqty;
                document.getElementById("WorkQuantity").value='';
         }
     }

  }
 /// same code as plancode n mysite.js
 function plandata(ID) {

 var planID = $('#' + ID).val();

$('#producttype_ID').val('');
$('#product_ID').val('');
$('#unit_ID').val('');
$('#ProductName').val('');
$('#ProductNo').val('');
$('#UnitName').val('');
$('#Quantity').val('');
$('#RemainingQty').val('');
 
$.post(basePath + "/lib/ajax/plandata.php", {'planID': planID}, function (data) { 

$('#producttype_ID').val(data["0"].pdtID);
$('#product_ID').val(data["0"].pdtID);
$('#unit_ID').val(data["0"].unitID);
$('#ProductName').val(data["0"].item);
$('#ProductNo').val(data["0"].descp);
$('#UnitName').val(data["0"].unit);

var pqty=parseInt(document.getElementById("Quantity").value=data["0"].PlanQuantity);
var wqty=data["0"].WorkQuantity;
if(wqty == 0){
    
 $('#RemainingQty').val(data["0"].PlanQuantity);
}
else{
    document.getElementById("RemainingQty").value=pqty-wqty;
}
 }, "json");   
}

function getbatchDetails(woid)
{
    
    var woid = woid; 
    
    $('#MachineName').val('');
    $('#CustomerName').val('');
    $('#PartName').val('');
    $('#PartNo').val('');


    $.post(basePath + "/lib/ajax/reconciliation.php", {'woid': woid}, function (data) {
        

       
        $('#showData').empty();
        
       
        document.getElementById('MachineName').value=data['bom'][0]['MachineName'];
        document.getElementById('CustomerName').value=data['bom'][0]['FirstName'];
        document.getElementById('PartName').value=data['bom'][0]['ItemName'];
        document.getElementById('PartNo').value=data['bom'][0]['Description'];
        
      
      
        
        // // EXTRACT VALUE FOR HTML HEADER. 
        // // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
       
        for (var i = 0; i < data['bom'].length; i++) {
            
            for (var key in data['bom'][i]) {
               
                if (key=='RawMaterial' || key == 'Grade' ||  key =='RMQuantity' || key=='InwardQty' || key=='ConsumedQty' || key=='RejectedQty' || key=='Difference' || key=='LotNo' || key=='IssuedQty' || key=='UnitOfMeasurement'  ){
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
        
        var divContainer = document.getElementById("showData");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

    }, "json"); } 
        

function outputpermin(prodid)
{
    $('#Outputpermin').val('');
    
    $.post(basePath + "/lib/ajax/sopoutput.php", {'prodid': prodid}, function (data) {
        
        document.getElementById('Outputpermin').value=data[0]['outputpermin'];
        
    }, "json");  
    
}

function oppermin(proid)
{
    
     $('#CycleTime').val('');
   
   
    $.post(basePath + "/lib/ajax/sopperminute.php", {'proid': proid}, function (data) {
        
     document.getElementById('CycleTime').value=data[0]['CycleTime'];
    
      
        
    }, "json");  
     
    
}

function soppartno(val)

{
    var pdtid = val;
    // console.log(basePath);
    
    $.post(basePath+"/lib/ajax/get_sopdata.php", {'pdtid': pdtid}, function (data) {


        if(data == null)
        {
            $("#product_ID").select2("val", "");
            alert('Create SOP to select this Part No.');

        }

         }, "json");  

}
function tocheckstock(id1,id2){
    
   
    
    var min=(document.getElementById(id1).value);

    var max=(document.getElementById(id2).value);
   
     if(max>0){
    
     if(max>min){
         document.getElementById(id2).value=max;
         
      }
      else {
          document.getElementById(id2).value="";
          document.getElementById(id2).focus();
          
          alert('Maximumstock should not be lesser than Minimumstock');
           
          }
     }
    else if(min<=0){
         alert('Minimumstock should not be zero or less than zero');
         document.getElementById(id1).value="";
          document.getElementById(id1).focus();
    }
  else{
            alert('Maxstock should not be zero or less than zero');
                document.getElementById(id1).value=min;
                document.getElementById(id2).value=''; 
                document.getElementById(id2).focus();
    }
    }
    
    
