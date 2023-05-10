@if(!isset($download))
   <title>Become Champion Footer</title>
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.header_template_row')
<table width="640" style="width:640px; padding-top: 30px; padding-left:30px;padding-right:30px;padding-bottom:0px;" cellpadding="0">
    <tbody><tr height="40" style="height:24pt;">
        <td valign="top" style="height:24pt;padding:0;">
            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;">&nbsp;</span></font></div>
        </td>
    </tr>
    <tr>
        <td valign="top" style="padding:0 0 0 22.5pt;">
            <div style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><img src="https://www.blue-infinity.com/newsletter/process-champion/2018/may/footer_title.jpg" border="0"></span></font></div>
        </td>
    </tr>
</tbody></table>
@include('dashboard.generatehtml.footer_template_row')
@endif
