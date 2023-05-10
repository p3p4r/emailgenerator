@if(!isset($download))
  	 <title>Friday 5</title>
     <meta name="template" content="friday5">
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.assets.template_header_header')
	<input name="template" type="hidden" value="friday5">
	<input id="generalColor" name="colortmp" type="hidden" value="#00bbc3">
    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
        <tbody><tr valign="top">
                <td  width="482" valign="bottom" style="width:482px; padding-left:30px;">
                    <p style="margin:0; padding:0; font-weight:600; font-size: 18px; font-family:' Calibri',Arial;mso-font-alt: 'Arial';"><span style="font-weight:600; font-size: 18px; font-family:' Calibri',Arial;mso-font-alt: 'Arial'; color:#822f80;">blue Trinity</span>
                        <span style="font-family:'Calibri',sans-serif; mso-font-alt:'Arial';color: #333333; "> presents</span></p>

                    </td>
                    <td width="128" style="width:128px;">
                        <img alt="bt Gif" src="../../images/btrinity.gif" style="width: 128px; height:auto;">
                    </td>       
                </tr>
                <tr valign="top" width="640px" height="40" style="padding-left:30px;">
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2" valign="top" width="640" style="padding-left:30px; padding-right:30px;width: 640px; ">

                        <img src="../../images/mail_generator_newsletter/header_friday5.jpg" alt="Friday 5" width="580">
                    </td>
                </tr></tbody>
        </table>
@include('dashboard.generatehtml.assets.template_header_footer')
@endif

