@if(!isset($download))
    <title>Default</title>
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.assets.template_footer_header')
<table width="640" style="width:640px; padding-left:30px; padding-right:30px;padding-bottom:30px;padding-top:0;" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td>
                <a href="#"><img src="../../images/mail_generator_newsletter/logo_default.gif" alt="blue-infinity" style="display:block;" align="left" width="98" height="auto"></a>
            </td>
            <td align="right" valign="bottom" style=" font-weight:400; font-size: 16px; line-height:18px; font-family:'Calibri Regular','Calibri',Sans-serif;mso-font-alt: 'Arial';">
                <a href="#" style="text-decoration: none;"><span style="color:#822f80">bluetrinity.com</span></a><br>
                <a href="mailto:info@btinfinity.com" style="text-decoration: none;"><span style="color:#333333">info@btinfinity.com</span></a>
            </td>

        </tr>
    </tbody>
</table>
@include('dashboard.generatehtml.assets.template_footer_footer')
@endif
