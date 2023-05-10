@if(!isset($download))
   <title>Social Media</title>             
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.header_template_row')
<table width="640" style="width:640px; padding-left:60px; padding-right:60px;padding-bottom:0px;" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td cellmargin="0" valign="top" style="text-align:center;  padding:0px; margin:0;color: #7e297c;  font-weight:200; font-size: 40px; line-height:40px; font-family:'Calibri',Sans-serif;">
                <input type="text" name="content[{{$var}}][subtitle]" placeholder="Like what you are reading?" {!!(isset($subtitle))? "value='$subtitle'":''!!} style="text-align:center;width:580px;max-width:580px;padding:0; margin:0;color: #cb6123; font-size: 24px; line-height:45px; font-family:Calibri Light,Calibri,Sans-serif;mso-font-alt: Arial;">{{(isset($download))? $subtitle.$download:''}}
                <input type="text" name="content[{{$var}}][title]" placeholder="Follow us for more" {!!(isset($title))? "value='$title'":''!!} style="text-align:center;  padding:0px; margin:0;color: #7e297c;  font-weight:200; font-size: 40px; line-height:40px; font-family:'Calibri',Sans-serif; width: 510px;">{{(isset($download))? $title.$download:''}}
            </tr>
            <tr>
                <td cellmargin="0" cellpadding="0" align="center" style="text-align:center;  padding:0; padding-top:35px;  margin:0; color: #7e297c;  font-weight:200; font-size: 40px; line-height:40px; font-family:'Calibri Light','Calibri',Sans-serif;mso-font-alt: 'Arial';" >
                    <a href="http://links.salesconquest.mkt4184.com/ctt?kn=14&amp;ms=MTk1Mzk5NTES1&amp;r=NDY2MDA0Nzg1MzA4S0&amp;b=0&amp;j=MTI2MDY0MDMxNAS2&amp;mt=1&amp;rt=0" target="_blank"><img src="{{$image_url}}/social_twitter.png" style="width: 48px; margin:0; padding:0; " cellpadding="0"  cellmargin="0" align="center" width="48" height="48"></a><a href="http://links.salesconquest.mkt4184.com/ctt?kn=6&amp;ms=MTk1Mzk5NTES1&amp;r=NDY2MDA0Nzg1MzA4S0&amp;b=0&amp;j=MTI2MDY0MDMxNAS2&amp;mt=1&amp;rt=0" target="_blank"><img src="{{$image_url}}/social_linkedin.png" style="width: 48px; margin:0; padding:0;" cellpadding="0"  cellmargin="0" align="center" width="48" height="48"></a><a href="http://links.salesconquest.mkt4184.com/ctt?kn=13&amp;ms=MTk1Mzk5NTES1&amp;r=NDY2MDA0Nzg1MzA4S0&amp;b=0&amp;j=MTI2MDY0MDMxNAS2&amp;mt=1&amp;rt=0" target="_blank"><img src="{{$image_url}}/social_facebook.png" style="width: 48px; margin:0; padding:0;" cellpadding="0" cellmargin="0" align="center" width="48" height="48"></a><a href="http://links.salesconquest.mkt4184.com/ctt?kn=15&amp;ms=MTk1Mzk5NTES1&amp;r=NDY2MDA0Nzg1MzA4S0&amp;b=0&amp;j=MTI2MDY0MDMxNAS2&amp;mt=1&amp;rt=0" target="_blank"><img src="{{$image_url}}/social_youtube.png" style="width: 48px; margin:0; padding:0; " cellpadding="0"  cellmargin="0" align="center" width="48" height="48"></a>   
                </td>
            </tr>
            <tr>
                <td style="padding-top:25px;">
                    <input type="text" name="content[{{$var}}][signature]" placeholder="#PassionatelyDigital" {!!(isset($signature))? "value='$signature'":''!!} style="text-align:center;font-weight:400; font-size: 16px; line-height:20px; font-family:'Calibri Regular','Calibri',Sans-serif;mso-font-alt: 'Arial';">{{(isset($download))? $signature.$download:''}}
                </td>
            </tr>
        </tbody>
    </table>
@include('dashboard.generatehtml.footer_template_row')
@endif
