@if(!isset($download))
  <p><a href="#templatePopup" id="modal" class="btn btn-primary"  style="width:60px;" rel="modal:open"><i class="fa fa-plus"></i></a></p>
            <div id="templatePopup" class="modal" style="text-align: center;">
              <div>
                  <h2>{{ __("generator.choose_template") }}</h2>
                  <hr>
              </div>
              <div class="tabbable tabs-left left-tab-process" style="background: #eaeaea;">
                <ul class="nav nav-tabs modules-tab text-center">
                  <li><a href="#templates_hd" data-toggle="tab" class="active">Header</a></li>
                  <li><a href="#templates_ct" data-toggle="tab">Content</a></li>
                  <li><a href="#templates_ft" data-toggle="tab">Footer</a></li>
                </ul>         
                <div class="tab-content">
              <div id="templates_hd" class="col-lg-12 tab-pane active">
                  <h3>{{ __("generator.header") }}</h3>
              </div>
              <div id="templates_ct" class="col-lg-12 tab-pane">
                  <h3>{{ __("generator.content") }}</h3>
              </div>
              <div id="templates_ft"  class="col-lg-12 tab-pane">
                  <h3>{{ __("generator.footer") }}</h3>
              </div>
              <a id="closeTmp" rel="modal:close"></a>
     </div>
   </div>
  </div> 
  @section('script')
  @parent
  <script type="text/javascript">
     var colorValue;
     headerPicker();
     contentPicker();
     footerPicker();
  if (colorValue != null){
     colorValue = $('#generalColor').val();
  }else{
     colorValue = '#006b96';
  }
function headerPicker()
{
      var t_hd = {{$total_hd_templates}};
      for (var hd = 1; hd <= t_hd; hd++) {   
      var url_thumb = '{{route('header.template', ':id')}}';
          url_thumb = url_thumb.replace(':id',hd);
        var thumbs = $.ajax({
              type: 'GET',
              url: url_thumb,
              async: false,
              cache: true,
          }).responseText;
       var title = $(thumbs).eq(0).text();
       var valLower = title.toLowerCase();
       var dataName = valLower.replace(/\s/g, '');
        $('#templates_hd').append('<div class="col-xs-6 col-md-4 col-lg-4 "><a class="thumbnail header_template" data-name="'+dataName+'" data-id="'+hd+'"><div class="caption"><p>'+title+'</p></div></a></div>');
     }

      $("#templates_hd .header_template").click(function(){
          var id = $(this).data('id');
          var dName = $(this).data('name');
          var nameId = '{{route('header.template', ':id')}}';
          nameId = nameId.replace(':id', id);
          if ($('.headerContent').length) {
              $('.headerContent').remove();
           }
           var template = $.ajax({
            type: 'GET',
            url: nameId,
            async: false,
            cache: true,
          }).responseText.replace(/_count/g,count).replace(/_rowTemplate/g,hd);
         if (dName != 'peoplept'){
              $('.headerContent').remove();
              $('#header').prepend(template);
              $('.pickerColor').css('color', colorValue);
              $('.pickerColorimg').css('background', colorValue);
              $('.hd_clr a').css('color', colorValue);
          }else{
             $('#header').prepend(template);
             $('.pickerColor').css('color', '#b91b1b');
             $('#cp').mouseover(function () {
              var generalColorClass = $('#generalColor').val();
              $('.colorpicker').show();
              if (generalColorClass){
                  $('.pickerColor').css('color', generalColorClass);
                  $('.pickerColorimg').css('background', generalColorClass);
              } else{
                  $('.pickerColor').css('color', '#b91b1b');
                  $('.pickerColorimg').css('background', '#b91b1b');
              }
              $('#cp').colorpicker({
                inline: true,
                container: true,
                customClass: 'colorpicker-2x',
                   colorSelectors: {
                      'Grey': '#9fa4a4',
                      'Light Cyan' : '#3aa0b9',
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
                  },
                sliders: {
                  saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                  maxTop: 200
              },
              alpha: {
                  maxTop: 200
              },
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
         }
         $('#closeTmp').trigger('click');
         $('html,body').animate({scrollTop: $(".headerContent").offset().top-150},'slow');
     });
}

function defaultContainer(id){
    // get content 
    var ajaxurl = '{{route('html.template', ':id')}}';
    ajaxurl = ajaxurl.replace(':id', id);
    var template = $.ajax({
        type: 'GET',
        url: ajaxurl,
        async: false,
        cache: true,
    }).responseText.replace(/_count/g,count);
    return template;
}
function imgError(image) {
    image.onerror = "";
    image.src = "{{asset('images/rows_templates_thumbs/default.png')}}";
    return true;
}
  function contentPicker()
  {
    $("a[href$='#templates_ct']").one('click',function(){
    var total_ct = {{$total_ct_templates}};
    for (var ct = 1; ct <= total_ct; ct++) {   
      var ct_thumb = '{{route('html.template', ':id')}}';
      ct_thumb = ct_thumb.replace(':id',ct);
      var thumb = $.ajax({
        type: 'GET',
        url: ct_thumb,
        async: false,
        cache: true,
      }).responseText;
      var title = $(thumb).eq(0).text();
      var valLower = title.toLowerCase();
      var dataName = valLower.replace(/\s/g, '');
      var img = '{{asset('images/rows_templates_thumbs/thumb')}}'+ct+'.png';
      var defaultImg = '{{asset('images/rows_templates_thumbs/thumb')}}';

      $('#templates_ct').append('<div class="col-xs-6 col-md-4 col-lg-4 "><a class="thumbnail Rowtemplate" data-id="'+ct+'"><img src="'+img+'" onerror="imgError(this)" alt="'+title+'"><div class="caption"><p>'+title+'</p></div></a></div>');
    }

    $('.Rowtemplate').each(function(){
        $(this).unbind('click');
        $(this).click(function(){
            var templateId = $(this).data('id');
            if(count < limit){
                $('#contentContainer').last().append( defaultContainer(templateId) );
                $('#closeTmp').trigger('click');
                inputUploud(count);
                inputImageLink(count);
                textArea();
                if (typeof(crt) != "undefined"){
                    inputedit(count);
                }
                colorValue = $('#generalColor').val();
                $('html,body').animate({scrollTop: $("#cont"+ count).offset().top-150},'slow');
                closeBtn(count);
                count++;
                if (count > 0){
                    $('#placehoderContainer').addClass('hidden');
                }
                // if function existen the execute
                if (typeof rowsFunctions == 'function') { 
                  rowsFunctions();
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
  });
}
  function footerPicker()
  {
    $("a[href$='#templates_ft']").one('click',function(){
         var t_ft = {{$total_ft_templates}};
      for (var hd = 1; hd <= t_ft; hd++) {   
      var url_thumb = '{{route('footer.template', ':id')}}';
          url_thumb = url_thumb.replace(':id',hd);
        var thumbs = $.ajax({
              type: 'GET',
              url: url_thumb,
              async: false,
              cache: true,
          }).responseText;
       var title = $(thumbs).eq(0).text();
       var valLower = title.toLowerCase();
       var dataName = valLower.replace(/\s/g, '');
        $('#templates_ft').append('<div class="col-xs-6 col-md-4 col-lg-4 "><a class="thumbnail footer_template" data-name="'+dataName+'" data-id="'+hd+'"><div class="caption"><p>'+title+'</p></div></a></div>');
     }
   $("#templates_ft .footer_template").click(function(){
          var id = $(this).data('id');
          var ajaxurl_hd = '{{route('footer.template', ':id')}}';
          ajaxurl_hd = ajaxurl_hd.replace(':id', id);
          if ($('#footer').length) {
              $('#footer').remove();
           }
          var template = $.ajax({
              type: 'GET',
              url: ajaxurl_hd,
              async: false,
              cache: true,
          }).responseText.replace(/_count/g,count).replace(/_rowTemplate/g,id);
           $('#footerContainer').append(template);
           if ($(".pickerColorimg")[0]){
               $('.pickerColorimg').css('background-color', colorValue);
            }
            $('#closeTmp').trigger('click');
            $('html,body').animate({scrollTop: $("#footer").offset().top-150},'slow');
      });
   });
 }
  </script>
  @endsection('script')
@endif