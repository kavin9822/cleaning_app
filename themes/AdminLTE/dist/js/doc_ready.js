$(document).ready(function() {
    
$('#pagenogo').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});      
    
  // updating the view with notifications using ajax
function load_unseen_notification(view='notify') {
    if(basePath!='')
    {
$.post(basePath + "/lib/ajax/mailbox_count.php", {'view':view}, function (data) {
      if(data.unseen_notification > 0) {
        $('#mailcount').html(data.unseen_notification);
         $('#mailcount1').html(data.unseen_notification);
        if(localStorage.getItem("notificount")==null){
        // Store
        localStorage.setItem("notificount", data.unseen_notification);
        }
        //console.log(data.unseen_notification);
        //console.log(localStorage.getItem("notificount"));
        // Retrieve
        if(data.unseen_notification>localStorage.getItem("notificount")){
        // buffers automatically when created    
        //var snd = new Audio(basePath + "/lib/notification_sound.mp3"); 
        //snd.play();
        }
      }
    }, "json");
    }
}

load_unseen_notification('notify');

//load new notifications
$(document).on('click', '#notify-toggle', function(){
 $('#mailcount').html('');
 $('#mailcount1').html('');
 load_unseen_notification('yes');
});

setInterval(function(){
 load_unseen_notification();
}, 35000); 
    
    try
    {
        $('input,select,textarea').each(function(i){ 
    
             var age = document.getElementById($(this)[0]['id']);
             age.addEventListener('keypress', function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
               
            }
        });
           
        });
  
    
    $('[data-toggle="popover"]').popover() ;
    
   $('input[data-provide="datetimepicker"]').datetimepicker();
   var currentdate = new Date();
   
//   var currmo=currentdate.getMonth()+1
//  if(currmo.length=1)
//  var currentmonth='0'+(currmo)
//  else
//  currentmonth=(currmo)
 //console.log($('input[data-date-format="DD-MM-YYYY"]').val())
 
    // $('input[data-date-format="DD-MM-YYYY"]').val( currentdate.getDate() + '-' + currentmonth +'-' + currentdate.getFullYear());
  
  //$(":input").find(`[data-provide='${datetimepicker}']`).datetimepicker();
    $('input[data-provide="datetimepicker"]').datetimepicker();
  $('input[data-provide="datetimepicker"]').datetimepicker().on('dp.show', function() {
  $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
  

}).on('dp.hide', function() {
  $(this).closest('.temp').addClass('table-responsive').removeClass('temp');
});



}
catch(err)
{
    
}

 if(!$('#multCheckON').length) {
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });
}

if(callmodal == 'yes' ) 
{
      $('#myModal').modal({show:true,keyboard: false,backdrop:'static'});
      console.log('hello layout');
      var pathvalue=document.getElementById("path").value;
      document.getElementById('pdffile').src = pathvalue; 
}

    

//  /*execute a function when someone clicks in the document:*/
//   document.addEventListener("click", function (e) {
//       closeAllLists(e.target);
//   });
  
   var customersearch = new Array();  
   if(document.getElementById("CustomerMob")) {
    $.post("http://ycias.goldenmarine.in/lib/ajax/customer_search.php", function (data) {
     
    $.each(data, function() {
   customersearch.push({label:this.FirstName,value:this.MobileNo,id:this.ID});
  });

// $('#BatchNo_'+batchId).empty();
// $('#EmpName_'+batchId).empty();
//  $("#BatchNo_"+batchId).prepend('<option value="" disabled selected style="display:none;">Select</option>');
// $.each(data, function() {
//   $('#BatchNo_'+batchId).append($('<option></option>').val(this.BatchNo).text(this.Batch));
//   $('#EmpName_'+batchId).append($('<option></option>').val(this.StageID).text(this.StageName));
//   });

    }, "json");   
   }else{

         /*An array containing all the country names in the world:*/
 customersearch = ["Select or Type"]; 

}
//console.log(customersearch);
/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
//autocomplete(document.getElementById("CustomerSearch"), customersearch);

if(document.getElementById("CustomerMob")){
    $('#CustomerName').autocomplete({
    source: customersearch,
    select: function (event, ui) {
        $("#CustomerName").val(ui.item.label); // display the selected text
        $("#CustomerMob").val(ui.item.value); // save selected id to hidden input
        $("#customer_ID").val(ui.item.id);
        return false;
    },
     change: function( event, ui ) {
        $( "#CustomerMob" ).val( ui.item? ui.item.value : '' );
        $( "#customer_ID" ).val( ui.item? ui.item.id : '0' );
    } 
});
}    
    // $( "#customer_ID" ).autocomplete({
    //   source: customersearch
    // });

if(document.getElementById("SearchStage")){
$(document).ready(function() {
  $(".js-example-basic-multiple").select2({
    placeholder: "Select"
});
});
}
 
 $('.datetimepicker').datetimepicker({
   useCurrent: false,
   format: 'DD-MM-YYYY'              
});



$(document).ready(function () {
        var today = new Date();
        console.log(today)
        $('.datepicker').datepicker({
           // format: 'dd-mm-yyyy',
            // format: 'M-yyyy',
            // autoclose:true,
            // endDate: "-1m",
            // maxDate: "-1m",
            // startView: "months", 
            // minViewMode: "months" changeMonth
            format: 'dd-mm-yyyy',
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
    });
    
//$("#date_from, #date_to").datepicker();

$("#date_from,#date_to").change(function () {
    var startDate = document.getElementById("date_from").value;
    var endDate = document.getElementById("date_to").value;
 
    if ((Date.parse(endDate) <= Date.parse(startDate))) {
        alert("End date should be greater than Start date");
        document.getElementById("date_to").value = "";
    }
});
// $('.month').datepicker({
//             format: 'dd-mm-yyyy',
//             endDate: '+0d'
//   });

    
});