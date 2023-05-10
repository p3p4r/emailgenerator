@if(!isset($download))
  <title> Subtitle, Title & Text</title>            
@endif
@if (Request::ajax() || isset($download) || isset($edit))     
@include('dashboard.generatehtml.header_template_row')                              
<table width="640" style="width:640px" cellpadding="0" cellspacing="0">
	<tbody><tr><td width="640" valign="top" style="width:640px;padding-left: 30px;;padding-top:75px; padding-right: 30px; text-align:left;background:#ffffff;font-weight:320;color:#333333;font-family:' Calibri',Arial;mso-font-alt: 'Arial';font-size:18px;">
            	 <input type="text" name="content[{{$var}}][subtitle]" placeholder="Your text here." {!!(isset($subtitle))? "value='$subtitle'":''!!} style="width: 580px; max-width: 580px;margin:0; padding:0; margin:0;  font-family:'Calibri',Arial,Sans-serif;mso-font-alt: 'Arial';text-align:left;color: #666666; font-size: 16px;font-weight:600;line-height: 24px">{{(isset($download))? $subtitle.$download:''}}
            	  <input type="text" name="content[{{$var}}][title]" class="font-picker{{$var}}" placeholder="Your text here." {!!(isset($title))? "value='$title'":''!!} {!!(isset($title_style))? "style='$title_style'":'style="width:580px; max-width:580px; padding:0; margin:0; font-family:Calibri Light,Calibri,Sans-serif;mso-font-alt: Arial;text-align:left;color: #FA4800; font-size: 24px; line-height:24px; font-weight:400;"'!!}>{{(isset($download))? $title.$download:''}}
            	  <textarea name="content[{{$var}}][content]" style="width:580px; max-width:580px; padding:0; margin:0; color: #333; font-size: 18px;  line-height:18px; font-family:'Calibri',Arial,Sans-serif;mso-font-alt: 'Arial'; text-align:left; font-weight: 400;">{!!(isset($content))? $content:'Your text here.'!!}</textarea>
            </td></tr></tbody>
</table>
@include('dashboard.generatehtml.footer_template_row')
@endif
