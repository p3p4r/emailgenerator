@if(!isset($download))
   <title>Custom User</title>
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.header_template_row')
<table width="640" style="width:640px; padding-top: 30px; padding-left:30px;padding-right:30px;padding-bottom:0px;" cellpadding="0">
    <tbody>
        <tr style="width:640px;text-align:left;background:#ffffff;font-weight:400;color:#333333;font-family:' Calibri','Open Sans',Sans-serif; font-size:18px;">
          <td width="580" valign="top" style="padding:0; margin:0; width:580px;text-align:left;background:#ffffff;font-weight:400;color:#333333;font-family: Calibri Regular,Open Sans,Arial;mso-font-alt: Arial;font-size:18px;">
            <input type="text" name="content[{{$var}}][subtitle]" placeholder="Your text here." {!!(isset($subtitle))? "value='$subtitle'":''!!} style="width: 192px; max-width: 192px; padding:0px;margin:0; color: #666666; font-size: 16px; font-family:Calibri Bold,Calibri,Arial,Sans-serif;mso-font-alt: Arial;text-align:left;font-weight:600;line-height: 19.2px">{{(isset($download))? $subtitle.$download:''}}
            <input type="text" name="content[{{$var}}][title]" class="font-picker{{$var}}" placeholder="Your text here." {!!(isset($title))? "value='$title'":''!!} {!!(isset($title_style))? "style='$title_style'":'style="width:580px; max-width:580px; padding:0; margin:0;color: #cb6123; font-size: 24px; line-height:45px; font-family:Calibri Light,Calibri,Sans-serif;mso-font-alt: Arial;text-align:left;"'!!}>{{(isset($download))? $title.$download:''}}
            <textarea name="content[{{$var}}][content]" style="width:580px; max-width:580px; padding:0; margin:0; color: #333; font-size: 18px;  line-height:21.6px; font-family:Calibri,Open Sans,Arial,Sans-serif; text-align:left; font-weight: 400;">{!!(isset($content))? $content:'Your text here.'!!}</textarea>
            </td>
        </tr>
    </tbody>
</table>
@include('dashboard.generatehtml.footer_template_row')
@endif
