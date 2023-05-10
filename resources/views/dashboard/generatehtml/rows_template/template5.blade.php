@if(!isset($download))
    <title>Title & Text</title>             
@endif

@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.header_template_row')
<table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
	<tbody><tr><td width="580" valign="top" style="padding-top: 40px; padding-left:30px;padding-right:30px;padding-bottom:0px;  width:580px;">
		<input type="text" name="content[{{$var}}][title]" class="font-picker{{$var}}" placeholder="Your text here." {!!(isset($title))? "value='$title'":''!!} {!!(isset($title_style))? "style='$title_style'":'style="width:580px; max-width:580px;margin:0; padding:0; font-family:Calibri,Arial,sans-serif; mso-font-alt:Arial; text-align:left; color:#FA4800; font-size: 24px; line-height:26px;font-weight:400;"'!!}>{{(isset($download))? $title.$download:''}}
		<textarea name="content[{{$var}}][content]" style="width: 580px; max-width:580px;margin:0; padding:0; color: #333333; font-size: 18px; line-height:18px; font-family:'Calibri',Arial,Sans-serif;mso-font-alt: 'Arial';text-align:left;font-weight:400;">{!!(isset($content))? $content:'Your text here.'!!}</textarea>
	</td></tr></tbody>
</table>
@include('dashboard.generatehtml.footer_template_row')
@endif
