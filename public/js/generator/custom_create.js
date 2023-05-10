 var count = 0;
 var limit = [50]; // 7
 var color_tmp = '7e297c';

// Click Add
$('.Rowtemplate').each(function(){
    $(this).click(function(){
        var templateId = $(this).data('id');
        if(count < limit){
            $('#contentContainer').last().append( defaultContainer(templateId) );
            $('#closeTmp').trigger('click');
            inputUploud(count);
            inputImageLink(count);
            textArea();
            colorValue = $('#generalColor').val();
            $('html,body').animate({scrollTop: $("#cont"+ count).offset().top-150},'slow');
            closeBtn(count);
            count++;
            if(count > 0){
                $('#placehoderContainer').addClass('hidden');
            }
        }
        if(count == limit){
            $('#addContainer').attr('disabled', 'disabled');
        }
          // Popup template with image
          $('#uplouadImagePopup' + count).click(function(){
              $.modal.defaults = {
                  clickClose: false,     // Allows the user to close the modal by clicking the overlay
                  showClose: false,      // Shows a (X) icon/link in the top-right corner
                  fadeDuration: 100,     // Number of milliseconds the fade transition takes (null means no transition)
                  fadeDelay: 2.0         // Point during the overlay's fade-in that the modal begins to fade in (.5 = 50%, 1.5 = 150%, etc.)
              };
          });
      });
});
//  ------ single Close Button ------  //
function closeBtn (i) {
    $("#close_row_" + i).unbind('click');
    $("#close_row_" + i).click(function(){
      
      var current_div = $(this).attr("id");
      var  row_id = current_div.replace('close_row_','');

        if ($('#rowId'+ row_id).val() != '0'+ row_id){
            $('#rowId'+ row_id).appendTo('#generateForm');
            $('#rowId'+ row_id).removeAttr('name','rowId[]');
            $('#rowId'+ row_id).attr('name','deleteId[]');
        }

        $('#cont'+ row_id).slideUp(300, function () {
            $('#cont'+ row_id).remove();   
        });

            var last_div = Number(row_id) + 1; // this is needed because count start at 0 (ex.: Row_id =  2 count = 3) 
            if (last_div != count){
              for (var u = 0; u < count; u++) {
                  var b = u;

                  if ( u >= row_id){
                   b = u + 1;
                  }

                    $("#cont" + b + " :input").each(function(){
                        var names_in_div = $(this).attr('name');
                        var ids_in_div = $(this).attr('id');

                        // Change the [number] in Name input. 
                      if ( typeof names_in_div != 'undefined' ){
                         $(this).attr('name', $(this).attr('name').replace(/\[\d+\]/,'[' + u + ']'));
                      }
                      // Change the number in ID input
                      if ( typeof ids_in_div != 'undefined' ){
                         $(this).attr('id', $(this).attr('id').replace(/\d+/, u));
                      }
                      $("#cont" + b).attr('id',"cont" + u);
                      $("#close_row_" + b).attr('id',"close_row_" + u); 
                   });
                    var iframe_textarea_iframe = $('iframe')[b];
                    var iframe_textarea_body = $('iframe').contents().find('body')[b];
                    t = u - 1;
                    $(iframe_textarea_iframe).attr('id','content['+ t +']_ifr');
                    $(iframe_textarea_body).attr('data-id','content['+ t +']');
              }
            }
           count--;
         
        if( count == 0 ){
            $('#placehoderContainer').removeClass('hidden');
              $('#cont'+ row_id).remove();   
        }else{
            $('#cont'+ row_id).slideUp(300, function () {
              $('#cont'+ row_id).remove();   
            });
        }
    });
 return false; 
}

function toogleAlign(i){
  var imgC = $("#imageContainer" + i);
  if($('#switchOrientation'+i).hasClass('alignDefault')){
        imgC.insertBefore(imgC.prev());// move up:
        imgC.css('padding-left','25px');
        $('#switchOrientation'+ i).removeClass('alignDefault');
        $( ".orientation_label span:last-child" ).css('font-weight','bold');
        $( ".orientation_label span:first-child" ).css('font-weight','normal');
        $("#align"+ i).val("2");
    }else{
        imgC.insertAfter(imgC.next());// put it back wherever it was before
        $( ".orientation_label span:last-child" ).css('font-weight','normal');
        $( ".orientation_label span:first-child" ).css('font-weight','bold');
        $('#switchOrientation'+ i).addClass('alignDefault');
        $("#align"+ i).val("1");
  }
}

// ------ Textarea  ------
function textArea (){
    tinymce.init({
      selector: 'textarea',
      plugins: 'link textcolor colorpicker',
      content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css'
      ],
      toolbar: 'undo redo | formatselect | bold italic strikethrough | forecolor link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent',
      textcolor_map: [
      color_tmp, "Blue Infinity",
      "993300", "Burnt orange",
      "333300", "Dark olive",
      "003300", "Dark green",
      "003366", "Dark azure",
      "000080", "Navy Blue",
      "333399", "Indigo",
      "333333", "Very dark gray",
      "800000", "Maroon",
      "FF6600", "Orange",
      "808000", "Olive",
      "008000", "Green",
      "008080", "Teal",
      "0000FF", "Blue",
      "666699", "Grayish blue",
      ],
      menubar: false,
      visualblocks_default_state: false,
      end_container_on_empty_block: false
  });
}

function inputUploud (i){
     // Multiples input Image
     $(".uploadSingle" + i + "").fileinput({
        'theme': 'explorer',
        'uploadUrl': '#',
        showUpload: false,
        dropZoneEnabled: false,
        showRemove: false,
    });
 }

 /* Back to top */
 $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('#back-to-top').fadeIn();
    } else {
        $('#back-to-top').fadeOut();
    }
});
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

  // Add Template PopUp
  $('#templatePopup').click(function(){
      $.modal.defaults = {
          clickClose: false,     // Allows the user to close the modal by clicking the overlay
          showClose: true,      // Shows a (X) icon/link in the top-right corner
          fadeDuration: 100,     // Number of milliseconds the fade transition takes (null means no transition)
          fadeDelay: 2.0         // Point during the overlay's fade-in that the modal begins to fade in (.5 = 50%, 1.5 = 150%, etc.)
      };
  });
    function inputImageLink(i)
    {
       var val =  $("#imageLink"+ i).val();
       var validadeUrl = new RegExp('(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9]\.[^\s]{2,})');
  $("#imageLink"+ i).attr('disabled','disabled');
  $("#imageLink"+ i).keyup(function () {
      var val =  $("#imageLink"+ i).val();
      if ( val.match(validadeUrl) ) {
       $('.btn-modal'+ i).attr('rel','modal:close');
       $('.btn-modal'+ i).removeAttr('disabled');
       if (event.keyCode === 13) {
          $(".btn-modal"+ i).click();
      }
      $('#alertLink'+ i).addClass('hidden');
  }else {
     $('.btn-modal'+ i).removeAttr('rel','modal:close');
     $('.btn-modal'+ i).attr('disabled','disabled');
     $('#alertLink'+ i).removeClass('hidden');
 }
});
}

/* ----- Preview Button ----- */
$('#preview').click(function () {
    $('input[type="text"],input,textarea,.mce-panel').toggleClass('preview');
    $('#mceu_11').css('box-shadow','0 0 transparent');
    $('#mceu_12,.list-group-item').toggleClass('hidden');
    $('.panel-headline').toggleClass('preview_mode');
    $('#preview').toggleClass('btn_preview');
    $('.mce-container').toggleClass('no_shadow');
    $('.mce-flow-layout').toggleClass('hidden');
});

$(window).scroll(function() {
    var btc = $('#btsCont');
        if ($(this).scrollTop() < 100) { // this refers to window
            btc.css('display', 'none');
        }
        else
        {
            btc.css('position', 'fixed');
            btc.css('display', 'block');
            btc.css('right','5%');
        }
    });


