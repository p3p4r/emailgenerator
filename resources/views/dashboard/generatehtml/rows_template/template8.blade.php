@if(!isset($download))
    <title>Text</title>             
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.header_template_row')

<table width="640" style="width:640px; padding-top: 45px;" cellpadding="0" cellspacing="0">
<tbody><tr><td width="640" valign="top" style="width:640px;padding-left: 30px;  padding-right: 30px;">
            <textarea name="content[{{$var}}][content]" style="max-width:580px;width: 580px;margin:0; padding:0; font-family:'Calibri',Arial,Sans-serif;mso-font-alt: 'Arial';text-align:left;color: #333; font-size: 18px; font-weight:400;">{!!(isset($content))? $content:'Your text here.'!!}</textarea>
        
            </td></tr></tbody>
</table>
@include('dashboard.generatehtml.footer_template_row')
@endif
