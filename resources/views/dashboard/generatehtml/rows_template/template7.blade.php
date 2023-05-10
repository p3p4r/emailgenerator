@if(!isset($download))
  <title>Title</title>            
@endif
@if (Request::ajax() || isset($download) || isset($edit))     
@include('dashboard.generatehtml.header_template_row')                              
<table width="640" style="width:640px; padding-top: 30px; padding-left:30px;padding-right:30px;padding-bottom:0px;" cellpadding="0">
	<tbody><tr><td width="640" valign="top" style="width:640px;padding-left: 30px;;padding-top:75px; padding-right: 30px; text-align:left;background:#ffffff;font-weight:320;color:#333333;font-family:' Calibri',Arial;mso-font-alt: 'Arial';font-size:18px;">
            	  <input type="text" name="content[{{$var}}][title]" class="font-picker{{$var}}" placeholder="Your text here." {!!(isset($title))? "value='$title'":''!!} {!!(isset($title_style))? "style='$title_style'":'style="width:580px; max-width:580px; padding:0; margin:0;color: #cb6123; font-size: 24px; line-height:45px; font-family:Calibri Light,Calibri,Sans-serif;mso-font-alt: Arial;text-align:left;"'!!}>{{(isset($download))? $title.$download:''}}
            </td></tr></tbody>
</table>
@include('dashboard.generatehtml.footer_template_row')
@endif