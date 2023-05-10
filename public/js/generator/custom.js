

// ----- Default  input Image   -----
/* $(".uploadSingle0").fileinput({
        'theme': 'explorer',
        'uploadUrl': '#',
        showUpload: false,
        dropZoneEnabled: false,
         showRemove: false,
     });*/

// Click Remove Last Inserted
/*$('#removeContainer').click(function(){
   if(count > 0){
        $('.contentContainer').last().remove();
         count--;
    }
    if(count != limit){
       $('#addContainer').removeAttr('disabled', 'disabled');
   }
});*/



  /* ----- For default [0] ----- */
/* $("#imageLink0").attr('disabled','disabled'); // ennable field is in the plugin event

    $("#imageLink0").keyup(function () {
        var val =  $("#imageLink0").val();
        var validadeUrl = new RegExp('(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9]\.[^\s]{2,})');

        if ( val.match(validadeUrl) ) {
           $('.btn-modal0').attr('rel','modal:close');
           $('.btn-modal0').removeAttr('disabled','disabled');
           if (event.keyCode === 13) {
              $(".btn-modal0").click();
            }
            $('#alertLink0').addClass('hidden');
        }else{
          $('.btn-modal0').removeAttr('rel','modal:close');
          $('.btn-modal0').attr('disabled','disabled');
           $('#alertLink0').removeClass('hidden');
        }
    });*/