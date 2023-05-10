@if( isset($align))
    @if($align == '1')
      @php $left = true; @endphp
    @endif

    @if($align == '2')
      @php $right = true; @endphp
    @endif

    @else
     @php $left = true; @endphp
@endif
@if(!isset($download))
    <title>Small Title, Text & Image</title>   
@endif

@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.header_template_row')

@include('dashboard.generatehtml.assets.row_orientation_switch_btn')
@include('dashboard.generatehtml.assets.row_image_upload')

<table width="640" style="width:640px;" cellpadding="0" cellspacing="0">  <tbody>
    <tr>
     @if (isset($right)) 
          @include('dashboard.generatehtml.assets.image_container')
     @endif
    <td width="352" valign="top" style="width:352px;padding-left:32px;word-break: break-all;">
                <input type="text" name="content[{{$var}}][title]" placeholder="Your text here." {!!(isset($title))? "value='$title'":''!!}rows="1"style="max-width:290px;width: 290px; padding:0; margin:0;color: #FA4800; font-size: 24px; line-height:40px; font-weight:400; font-family:'Calibri',Sans-serif;mso-font-alt: 'Arial';text-align:left;" >{{(isset($download))? $title.$download:''}}
                  <textarea name="content[{{$var}}][content]" rows="10" cols="40" align="left" style="max-width:290px;width: 290px; padding:0px; margin:0;color: #FA4800; font-size: 24px; line-height:40px; font-weight:400; font-family:Calibri,Sans-serif;height:100px;text-align:left;">{!!(isset($content))? $content:'Your text here.'!!}</textarea>
    </td>
    @if (isset($left)) 
        @include('dashboard.generatehtml.assets.image_container')
    @endif
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
</div>
@include('dashboard.generatehtml.footer_template_row')
@endif
