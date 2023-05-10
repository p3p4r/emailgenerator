@extends("layouts.adminboard")
@section("TabTitle", "Gerar Html")
@section("style")
@parent
<link rel="stylesheet" href="{{ asset('css/generator/imageuploud/fileinput.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/generator/jquery.modal.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/generator/custom.css') }}" />
<link rel="stylesheet" href="{{ asset('css/generator/colorpicker/bootstrap-colorpicker.css') }}" />
@endsection
@section("content")
<div class="row">
    <div class="form-group">
        <h1 style="margin-left:20px;"><i class="fa fa-code" style="margin-right:5px;"></i> Edit Html: </h1>
    </div>
    <hr>
    <div class="col-lg-12">
        @if(Session::has('flash_error'))
        <div class="alert alert-danger">
            {{ Session::get('flash_error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @endif
    </div>
    <?php $template = $template[0]['name'];?>
    <form  id="generateForm" method="POST" action="{{ route('redirect') }}" name="generateform" onsubmit="sendData()" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <input name="id" type="hidden" value="{{$id}}">
        <input id="savebtn" class="btn btn-warning sbt-btn-save btn-edit disabled" name="save" type="submit" value="Save">
        <input id="generatebtn" class="btn btn-primary sbt-btn" name="generate" type="submit" value="Generate HTML">
        <div id="btsCont" style="width: 60px;z-index:9;display: none;">
           @include('dashboard.generatehtml.assets.popup_module')
</div>
<table width="100%" cellpadding="0" cellspacing="0">
    <tbody><tr>
        <td align="center">

            <table width="640" style="background:#fff;position:relative;width:640px;box-shadow: 0 0 20px 0px #77777738;" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td align="left">
                        <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td valign="top" style="height:20px;font-size:0;">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td valign="top" style="height:20px;color:#16354f;font-weight:300;font-size:12px;text-align:right;font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';">

                                        <div class="col-lg-12 pCenterHorizontal">
                                           <span class="col-lg-3 centerHorizontal">{{__("generator.image_folder")}}</span>
                                           <div class="col-lg-9">
                                              @foreach (array_slice($rows, 0, 1) as $row => $value)
                                              <?php
                                                 $imagePath = unserialize($value['content'])['imagePath']; // online use this variable
                                                 $cleanPath = str_replace('newsletter/' . $template . '/', '', $imagePath);
                                              ?>
                                             {!! GenerateHtmlController::createInput($cleanPath,$row,'img_path','img_pathID','100%','100%','0px','12px') !!}
                                             @endforeach
                                         </div>
                                     </div>

                                 </td>
                             </tr>
                         </tbody>
                     </table>
                     <table style="width:100%;" cellpadding="0" cellspacing="0">
                          <tbody id="header">
                            <tr>
                              <td>
                                    @foreach( $header_templates as $hd_key => $hd_tmp)
                                        @foreach ($hd_row as $hd_rw => $hd_val)
                                          @foreach ($hd_val as $name => $val)
                                               @php extract($hd_row[$hd_rw]); @endphp
                                          @endforeach
                                        @endforeach 
                                        @php
                                           $hd_tmp_id = $hd_key + 1;
                                           $header_id = $header[0]->template_id;
                                        @endphp
                                        @if( $header_id == $hd_tmp_id)
                                            @php $id_hd = $header[0]['template_id']; @endphp
                                            @include($hd_path.$hd_tmp_id)
                                        @endif
                                     @endforeach      
                        </td>
                      </tr>
                  </tbody>
              </table>
          <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td valign="top" width="640" height="45" style="height:45px;font-size:0;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
<div id="contentContainer">
   @foreach ($cnt_row as $row_key => $values)
        @foreach ($values as $name => $val)
            @php 
              extract($cnt_row[$row_key]); 
              if (isset($styles[$row_key])){
                extract($styles[$row_key]);
              }
            @endphp
        @endforeach
    @foreach( $rows_templates as $row => $row_tmp )
     @php
       $template_id = $rows[$row_key]['template_id'];
       $align = $rows[$row_key]['align'] ;
       $var = $row_key;
       $tmp_id   = $row + 1;
     @endphp
     @if( $template_id == $tmp_id)
       @include($ct_path.$tmp_id)
     @endif
    @endforeach
 @endforeach
</div>
<style type="text/css" media="screen">
.headerContent .hd_clr a{ color: {{ $color }} !important;}
.themeColor {
    color: {{ $color }} !important;
}
.themeBackground{
    background-color: {{ $color }} !important;
}
</style>
<div id="placehoderContainer" class="hidden" style="width:  100%;height:  350px;text-align:  center;background: #f3f3f3;display: table;position:  relative;">
    <span style="vertical-align: middle;color: #d2d2d2;border: 4px dashed #d2d2d2;display: table-cell;font-weight:  bold;font-size:  22px;">Click <a href="#templatePopup" id="modal" class="btn btn-primary" style="width:60px;margin:0 5px;" rel="modal:open"><i class="fa fa-plus"></i></a> to add a row</span>
</div>
<!-- FOOTER -->
<div id="footerContainer">
    <div id="footer">
       @foreach( $footer_templates as $ft_key => $ft_tmp)
           @foreach ($ft_row as $ft_rw => $ft_val)
              @foreach ($ft_val as $name => $val)
                @php extract($ft_row[$ft_rw]); @endphp
              @endforeach
           @endforeach 
           @php
              $ft_tmp_id = $ft_key + 1;
              $footer_id = $footer[0]->template_id;
           @endphp
           @if( $footer_id == $ft_tmp_id)
              @php  $id_ft = $footer[0]['template_id'];   @endphp
              @include($ft_path.$ft_tmp_id)
           @endif
       @endforeach                          
 </div>   
     <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td valign="top" width="640" height="45" style="height:45px;font-size:0;">&nbsp;</td>
            </tr>
        </tbody>
    </table>        
</div>
</td>
</tr>
</tbody></table>
</td>
</tr>
<br>
</tbody>
</table>
</form>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><i class="fa fa-arrow-up"></i></a>
@include('jsvar')
@section('script')
@parent
<script src="{{ asset('/js/generator/texteditor/tinymce.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/generator/imageuploud/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/generator/imageuploud/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/generator/popup/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/generator/colorpicker/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/generator/fontpicker/fontpicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/generator/custom_edit.js') }}" type="text/javascript"></script>
<script type="text/javascript">
 var count = <?php echo count($rows) ?>;
  //closeBtn();
 rowsFunctions();
 saveOrGenerate();
 textArea();
 peopleHeader();

 $('#generalColor').val('{{ $color }}');
 $('.pickerColor').addClass('themeColor');
$('.pickerColorimg').css('background-color','{{ $color }}');

 function saveOrGenerate(){

    $('#generate').click(function(){
        $("#updateInput").remove();
        $("#generatebtn").attr('action', '{{ Route("redirect") }}');
    });
}
 //  ------ Close Button ------  //
function closeBtn (i) {
    $("#close_row_" + i).unbind('click');
    $("#close_row_" + i).click(function(){
      
      var current_div = $(this).attr("id");
      var  row_id = current_div.replace('close_row_','');
      console.log('#rowId'+ row_id);
        if ($('#rowId'+ row_id).val() != '0'+ row_id){
            $('#rowId'+ row_id).appendTo('#generateForm');
            $('#rowId'+ row_id).removeAttr('name','rowId[]');
            $('#rowId'+ row_id).attr('name','deleteId[]');
            $('#rowId'+ row_id).removeAttr('id');
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

                      var iframe_textarea_iframe = $('iframe')[b];
                      var iframe_textarea_body = $('iframe').contents().find('body')[b];
                    
                      $(iframe_textarea_iframe).attr('id','content['+ u +']_ifr');
                      $(iframe_textarea_body).attr('data-id','content['+ u +']'); 
                   });    
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
// if user types anything
$('body').keydown(function(){
    $('#generatebtn').remove();

});
// User Pick Custom color
$(window).on('load', function() {
         $( '.mce-colorbutton .mce-open:last-child' ).each(function() {
         $('.mce-colorbutton .mce-open:last-child').trigger('mouseover').trigger('click');
         $("body").find("[aria-label='Text color']").removeClass('mce-opened');
         $('.mce-popover').css('display','none');
         $('#peoplept').trigger('mouseover').trigger('mouseout'); // Show default custom color
    });
});
</script>
@endsection
@endsection