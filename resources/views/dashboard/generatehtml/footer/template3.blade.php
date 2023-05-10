@if(!isset($download))
    <title>People PT Logo</title>
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.assets.template_footer_header')
    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="top" width="640" height="95" style="height:95px;font-size:0;">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        <tbody>
                             <tr>
                                <td valign="top" width="320" style="width:320px;font-size:0;text-align:right;padding-right:32px;">
                                    <a href="#" target="_blank">
                                        <img width="50" border="0" src="../../images/mail_generator_newsletter/social_linkedin.png" alt="Linkedin">
                                    </a>
                                    <a href="#" target="_blank">
                                        <img width="50" border="0" src="../../images/mail_generator_newsletter/social_facebook.png" alt="Facebook">
                                    </a>
                                    <a href="#" target="_blank">
                                        <img width="50" border="0" src="../../images/mail_generator_newsletter/social_twitter.png" alt="Twitter">
                                    </a>
                                    <a href="#" target="_blank">
                                        <img width="50" border="0" src="../../images/mail_generator_newsletter/social_youtube.png" alt="Youtube">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        
                    </table>
                    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="top" style="width:300px;padding-left:32px;">
                                    <div style="text-align:left;font-family:'Open Sans',Arial;mso-font-alt: 'Arial';font-size:16px;color:#333333;margin-top:0px;">
                                        <strong>Geneva Headquarters</strong><br>
                                        <span style="font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';font-weight:300;">
                                            12 Route de chateux<br>
                                            1234 Geneva<br>
                                            Switzerland
                                        </span>
                                    </div>
                                </td>
                                <td valign="top" style="width:340px;padding-left:0px;padding-top:22px;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tbody><tr>
                                            <td style="width:175px;color:#999999;font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';font-weight:300;font-size:16px;">
                                                Phone (local)
                                            </td>
                                            <td style="color:#333333;font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';font-weight:300;font-size:16px;">
                                                +99 25 458 1000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:175px;color:#999999;font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';font-weight:300;font-size:16px;">
                                                Phone (international)
                                            </td>
                                            <td style="color:#333333;font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';font-weight:300;font-size:16px;">
                                                +100 157 50000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:175px;color:#999999;font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';font-weight:300;font-size:16px;">
                                                Email
                                            </td>
                                            <td style="color:#333333;font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';font-weight:300;font-size:16px;">
                                                <a href="mailto:info@b-i.com" style="text-decoration:none;color:#333333;">info@b-i.com</a>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="top" style="height:45px;font-size:0;">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="top" style="width:640px;font-size:0;">
                                    <a id="footer" # target="_blank">
                                        <img class="delImg pickerColorimg" style="margin-left: 30px;@if(isset($bgStyle)){{$bgStyle}}@endif" width="100" border="0" src="../../images/blueinfinity.png" alt="Blue Trinity">
                                        
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="top" style="height:45px;font-size:0;">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="top" style="color:#999999;text-align:right;font-family:'Open Sans',Arial;mso-font-alt: 'Arial';font-size:12px;padding-right:28px;">
                                    We would dislike to see you go, but if you wish to do so, please
                                    <a name="opt out_1" style="color:#409bc9;text-decoration:none;" xt="SPCUSTOMOPTOUT" href="#SPCUSTOMOPTOUT" target="_blank">
                                        unsubscribe here.
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
@include('dashboard.generatehtml.assets.template_footer_footer')
@endif
