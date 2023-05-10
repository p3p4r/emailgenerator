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
        <h1 style="margin-left:20px;"><i class="fa fa-code" style="margin-right:5px;"></i>{{ __("generator.generate_html") }}</h1>
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
    <form action="/" method="post" name="generateform" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
        <button class="btn btn-warning sbt-btn-save"><i class="fa fa-save" style="margin-right: 10px;"></i>Save</button>
        <div id="btsCont" style="width: 60px;z-index:9;display: none;">
          @include('dashboard.generatehtml.assets.popup_module')
        <a id="preview" class="btn btn-info" style="width:60px;"><i class="fa fa-eye" style="margin-right: 10px;"></i></a>
    </div>
    <table width="100%" cellpadding="0">
        <tbody><tr>
            <td align="center">
                <table width="640" style=" position:relative;width:640px;box-shadow: 0 0 20px 0px #77777738;background:#fff;" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
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
                                               <span class="col-lg-3 centerHorizontal">{{ __("generator.image_folder") }}</span>
                                               <div class="col-lg-9">
                                                 {!! $imgPath !!}
                                             </div>
                                         </div>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                         <table style="width:100%;" cellpadding="0" cellspacing="0">
                          <tbody id="header">
                            <tr class="headerContent">
                              <input id="generalColor" name="colortmp" type="hidden" class="input-group-addon" value="#000" >
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
                        <div id="placehoderContainer" style="width:  100%;height:  350px;text-align:  center;background: #f3f3f3;display: table;position:  relative;">
                            <span style="vertical-align: middle;color: #d2d2d2;border: 4px dashed #d2d2d2;display: table-cell;font-weight:  bold;font-size:  22px;">Click <a href="#templatePopup" id="modal" class="btn btn-primary" style="width:60px;margin:0 5px;" rel="modal:open"><i class="fa fa-plus"></i></a> to add a row</span>
                        </div>
                    </div>
                    <!-- FOOTER -->
                    <div id="footerContainer">
                        <div id="footer">
                             <input  name="footer" type="hidden"> 
                        </div>           
                    </div>
                    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="top" width="640" height="45" style="height:45px;font-size:0;">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    </td>
</tr>
<br>
</tbody>
</table>
</form>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><i class="fa fa-arrow-up"></i></a>
@section('script')
@parent
<script src="{{ asset('/js/generator/texteditor/tinymce.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/generator/imageuploud/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/generator/imageuploud/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/generator/popup/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/generator/colorpicker/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/generator/fontpicker/fontpicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/generator/custom_create.js') }}" type="text/javascript"></script>
<script type="text/javascript">
 textArea();
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
        }else{
            $('#cont'+ row_id).slideUp(300, function () {
            });
        }
    });
 return false; 
}

// User Pick Custom color
$(window).on('load', function() {
    $( '.mce-colorbutton .mce-open:last-child' ).each(function() {
       $('.mce-colorbutton .mce-open:last-child').trigger('mouseover').trigger('click');
       $("body").find("[aria-label='Text color']").removeClass('mce-opened');
       $('.mce-popover').css('display','none');
   });
});
</script>
@endsection

@endsection
