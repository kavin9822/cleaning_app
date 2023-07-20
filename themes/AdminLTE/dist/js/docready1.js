
$(document).ready(function() {
    
function fileupload(id,removecls,appendcls){

 var fileArr = [];
 
 $("#"+id).change(function(){
      // check if fileArr length is greater than 0
       if (fileArr.length > 0) fileArr = [];
     
        $('#image_preview').html("");
        var total_file = document.getElementById(id).files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
          if (total_file[i].size > 1048576) {
            return false;
          } else {
            fileArr.push(total_file[i]);
           
           var removeLink = "<a class='"+removecls+" removeFile' href=\"#\" class='btn btn-danger' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></a>";
            
           var ptag="<div class='middle'><p style='border-bottom:1px solid #ccc;'><strong> "+escape(total_file[i].name)+" </strong> - "+total_file[i].size+" bytes. &nbsp; &nbsp;"+removeLink+"</div></p>";
          
           $('.'+appendcls).append("<div class='img-div' id='img-div"+i+"'>"+ptag+"</div>");
    
          }
        }
   });
  
 $('body').on('click', '.'+removecls, function(evt){
      var divName = $(this).parent().parent();
      console.log(divName);
      var fileName = $(this).attr('role');
    //   $(`#${divName}`).remove();
    divName.remove();
    
      for (var i = 0; i < fileArr.length; i++) {
        if (fileArr[i].name === fileName) {
          fileArr.splice(i, 1);
        }
      }
    document.getElementById(id).files = FileListItem(fileArr);
    
    if(document.getElementById("uploaded_block")){  //// upload_block_show_or_hide start
        if (document.getElementById(id).files.length>0) {       
            document.getElementById("uploaded_block").style.display='block';
        }else {    
            document.getElementById("uploaded_block").style.display='none';
        }
    } //// upload_block_show_or_hide end
      evt.preventDefault();
  });
    }
  
 fileupload('files1','removeFile1','fileList1');
 fileupload('files2','removeFile2','fileList2');
 fileupload('files3','removeFile3','fileList3');
  
   function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
        
});