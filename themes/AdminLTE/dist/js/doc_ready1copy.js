$.fn.fileUploader = function (filesToUpload) {
    this.closest(".files").change(function (evt) {

        for (var i = 0; i < evt.target.files.length; i++) {
            filesToUpload.push(evt.target.files[i]);
           
        };
        var output = [];

        for (var i = 0, f; f = evt.target.files[i]; i++) {
            var removeLink = "<a class=\"removeFile\" href=\"#\" data-fileid=\"" + i + "\">Remove</a>";

             output.push("<p style='border-bottom:1px solid #ccc;'><strong>", escape(f.name), "</strong> - ",
                f.size, " bytes. &nbsp; &nbsp; ", removeLink, "</p>");
        }

        $(this).children(".fileList")
            .append(output.join(""));
            
            
    });
};

var filesToUpload = [];



$(document).on("click",".removeFile", function(e){
    e.preventDefault();
    var fileName = $(this).parent().children("strong").text();
     // loop through the files array and check if the name of that file matches FileName
    // and get the index of the match
    
    	// var a=[];
    	 
    for(i = 0; i < filesToUpload.length; ++ i){
        
       
        
        if(filesToUpload[i].name == fileName){
            //console.log("match at: " + i);
            // remove the one element at the index where we get a match
            
            filesToUpload.splice(i, 1);
           
           
          //document.getElementsByClassName('.attach').value = filesToUpload[i].name; 
           
        }
        
      
     
	}
	
     // $("input[name=files2]").val(a);
    
    //console.log(filesToUpload);
    // remove the <li> element of the removed file from the page DOM
   // $("#files2").val(filesToUpload);
   
    $(this).parent().remove(); 
    
    
     
});


   // $("#files1").fileUploader(filesToUpload);
    $("#files2").fileUploader(filesToUpload);

    $("#uploadBtn").click(function (e) {
        e.preventDefault();
    });
