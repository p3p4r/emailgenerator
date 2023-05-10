@if(!isset($download))
    <title>Title & Text</title>             
@endif

@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.header_template_row')
<table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
    <tbody><tr><td width="580" valign="top" style="width:580px; padding-left: 30px; padding-right: 30px; padding-top: 75px;">
             <input type="text" name="content[{{$var}}][title]" class="font-picker{{$var}}" placeholder="Your text here." {!!(isset($title))? "value='$title'":''!!} {!!(isset($title_style))? "style='$title_style'":'style="max-width:580px;width: 580px;margin:0; padding:0;font-family:Calibri,Arial,sans-serif; mso-font-alt: Arial;text-align:left; color: #992A84; font-size: 40px; line-height:40px;font-weight:200;"'!!}>{{(isset($download))? $title.$download:''}}
          </td></tr>
          <tr><td width="580" valign="top" style="width:580px; padding-left: 30px; padding-right: 30px; padding-top: 24px;   text-align:left;">
           <textarea name="content[{{$var}}][content]" style="max-width:580px;width: 580px;margin:0; padding:0; font-family:'Calibri',Arial,Sans-serif;mso-font-alt: 'Arial';text-align:left;color: #333; font-size: 18px; font-weight:400;">{!!(isset($content))? $content:'Your text here.'!!}</textarea>
       </td></tr></tbody>
</table>
@include('dashboard.generatehtml.footer_template_row')
@endif
