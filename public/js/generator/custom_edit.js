 var limit = [50];
 var color_tmp = 'b91b1b';
 $('#generalColor').val('{{ $color }}');
 $('.pickerColor').addClass('themeColor');

 function saveOrGenerate(){
    $('#savebtn').mousedown(function(){
        $("#generateForm").append('<input name="_method" type="hidden" value="PUT" id="updateInput">');
    });

    $('#savebtn').click(function(){
        $("#generatebtn").removeAttr('action', '{{ Route("redirect") }}');
        $("#generateForm").attr('action','{{ Route("html.update",$id) }}');
    });
    $('#generate').click(function(){
        $("#updateInput").remove();
        $("#generatebtn").attr('action', '{{ Route("redirect") }}');
    });
}

// Click Add
$('.Rowtemplate').each(function(){
    $(this).click(function(){
        var templateId = $(this).data('id');
        if (count < limit){
            var templateId = $(this).data('id');

            $('#contentContainer').last().append( defaultContainer(templateId) );
            $('#closeTmp').trigger('click');
            textArea();
            inputUploud(count);
            inputImageLink(count);
            $('html,body').animate({scrollTop: $("#cont"+ count).offset().top-100},'slow');
            count++;
            if (count > 0){
                $('#placehoderContainer').addClass('hidden');
            }
            rowsFunctions();
            //closeBtn(count);
        }
        if(count == limit){
            $('#addContainer').attr('disabled', 'disabled');
        }

          // Popup template with image
          $('#uplouadImagePopup' + count).click(function(){
               $.modal.defaults = {
                  showClose: false,      // Shows a (X) icon/link in the top-right corner
                  fadeDuration: 100,     // Number of milliseconds the fade transition takes (null means no transition)
                  fadeDelay: 2.0         // Point during the overlay's fade-in that the modal begins to fade in (.5 = 50%, 1.5 = 150%, etc.)
              };
          });
          // Allows the user to close the modal by clicking the overlay
          $('body').click(function(){
            $('#closeTmp').trigger('click');
            return false;
          });
    });
});

 

// ----- Existing  input Images Rows   -----
function rowsFunctions() {
        for (var i = 0; i < count; i++) {
         inputUploud(i);
         inputImageLink(i);
         sendData(i);
         closeBtn(i);
         inputedit(i);
     }
}

function toogleAlign(i){
  var imgC = $("#imageContainer" + i);
  console.log("#align"+ i +':'+ $("#align"+ i).val());
  if($('#switchOrientation'+i).hasClass('alignDefault')){
        imgC.insertBefore(imgC.prev());// move up:
        imgC.css('padding-left','25px');
        $('#switchOrientation'+ i).removeClass('alignDefault');
        $(".orientation_label span:last-child").css('font-weight','bold');
        $(".orientation_label span:first-child").css('font-weight','normal');
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

function inputUploud (i)
{
     // Multiples input Image
     $(".uploadSingle" + i).fileinput({
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
          $("#imageLink"+ i).attr('disabled','disabled'); // ennable field is in the plugin event
          $("#imageLink"+ i).keyup(function () {
            var val =  $("#imageLink"+ i).val();
            var validadeUrl = new RegExp('(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9]\.[^\s]{2,})');

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

// Allow sending Image Link and Other Data
function sendData(i) {
  $('form#generateForm').submit(function(){
    $("#imageLink"+ i).removeAttr('disabled','disabled');
  });
}

$(window).scroll(function() {
    var btc = $('#btsCont');
        if ($(this).scrollTop() < 100) { // this refers to window
            btc.css('display', 'none');
        }else{
            btc.css('position', 'fixed');
            btc.css('display', 'block');
            btc.css('right','5%');
        }
});
 
function peopleHeader ()
{
 $('#cp').mouseover(function () {
   var generalColoClass = $('#generalColor').val();
   $('.colorpicker').show();

   if (generalColoClass){
    $('.pickerColor').css('color', generalColoClass);
    $('.pickerColorimg').css('background', generalColoClass);
    $('#peoplept').removeClass('themeBackground');
    $('.pickerColorimg').removeClass('themeBackground');
    $('.pickerColor').removeClass('themeColor');

  }else{
    $('.pickerColor').css('color', '#b91b1b');
    $('.pickerColorimg').remove();
  }
  $('#cp').colorpicker({
    inline: true,
    container: true,
    customClass: 'colorpicker-2x',
    colorSelectors: {
      'Grey': '#9fa4a4',
      'Light Cyan': '#3aa0b9',
      'Dark Cyan': '#26acaf',
      'Dark Red': '#a81d2a',
      'Red': '#ec2227',
      'Dark Green': '#197941',
      'Green': '#239e47',
      'Dark Blue': '#133053',
      'Blue': '#0f5a9a',
      'Orange': '#f24c00',
      'Yellow': '#fcb301',
      'Brown': '#a88477',
      'Light Brown': '#d0c7bd',
      'Rose': '#fa439d',
      'Dark Rose': '#ad2a8b',
    }
  });
  $('#cp .colorpicker-saturation').remove();
  $('#cp .colorpicker-hue').remove();
});

 var offset = $("#cp").offset();

 $('#cp').on({
   mouseleave: function(e) {
     $('.colorpicker').hide();
     color_tmp = $('#generalColor').val();
     color_tmp = $('tr:first-child .mce-grid-cell:first-child div').removeAttr('data-mce-color').attr('data-mce-color',color_tmp).css('background',color_tmp);
     $('tr:first-child .mce-grid-cell:first-child').attr('colspan','2').attr('rowspan','2');
     $('tr:first-child .mce-grid-cell:first-child div').css('height','40px').css('width','40px');
     $('.mce-popover').css('width','auto');
   },
   mousemove: function(e) {
     leftM =  e.pageX - offset.left;
     topM =  e.pageY - offset.top;

     $('.colorpicker').css({
       'left': leftM +'px',
       'top': topM +'px',
     });
     $('.colorpicker').css('opacity','0.5');
   },
   click: function(e) {
    $(this).unbind("mousemove");
    $('.colorpicker').css('opacity','1');
  }
});
 return;
}

// User Pick Custom color
$(window).on('load', function() {
         $( '.mce-colorbutton .mce-open:last-child' ).each(function() {
         $('.mce-colorbutton .mce-open:last-child').trigger('mouseover').trigger('click');
         $("body").find("[aria-label='Text color']").removeClass('mce-opened');
         $('.mce-popover').css('display','none');
         $('#peoplept').trigger('mouseover').trigger('mouseout'); // Show default custom color
    });
});