<html xmlns="http://www.w3.org/1999/xhtml">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic);
        </style>
    </head>
<?php
    ob_start();
?>
<body>
    <table width="100%" cellpadding="0" style="word-break: break-all;">
        <tr>
            <td align="center">

                <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="left">
                            <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                                <tbody><tr><td valign="top" style="height:20px;">&nbsp;</td></tr></tbody>
                             </table>

                            <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td valign="top" style="height:20px;color:#16354f;font-weight:300;font-size:12px;text-align:right;font-family:'Open Sans Light','Open Sans',Arial;mso-font-alt: 'Arial';">
                                            If you are unable to see the message below, <a style="color:#5dbac0;text-decoration:none;" target="_blank" href="{{ $blueLink  }}">click here to view</a>.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                             <table width="640" style="width:640px;" cellpadding="0" cellspacing="0">
                                <tbody><tr><td valign="top" style="height:20px;">&nbsp;</td></tr></tbody>
                             </table>

                            <table width="640" style="width:640px;" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td>
                                           @foreach( $header_templates as $hd_key => $hd_tmp)
                                              @foreach ($hd_row as $hd_rw => $hd_val)
                                                @foreach ($hd_val as $name => $val)
                                                     @php extract($hd_row[$hd_rw]); @endphp
                                                @endforeach
                                              @endforeach 

                                              @php
                                                 $hd_tmp_id = $hd_key + 1;
                                                 $header_id = $header[0]->template_id;
                                              @endphp

                                              @if( $header_id == $hd_tmp_id)
                                                  @php $id_hd = $header[0]['template_id']; @endphp
                                                  @include($hd_path.$hd_tmp_id)
                                              @endif
                                           @endforeach      
                                       </td>
                                   </tr>
                               </tbody>
                           </table>


   @foreach ($cnt_row as $row_key => $values)
            @php 
              extract($cnt_row[$row_key]); 
              if (isset($styles[$row_key])){
                extract($styles[$row_key]);
              }
            @endphp
 
    @foreach( $rows_templates as $row => $row_tmp )
     @php
       $template_id = $rows[$row_key]['template_id'];
       $var = $row_key;
       $tmp_id   = $row + 1;
     @endphp

     @if( $template_id == $tmp_id)
       @include($ct_path.$tmp_id)
     @endif
    @endforeach
 @endforeach

                           @foreach($footer_templates as $ft_key => $ft_tmp)
                              @foreach ($ft_row as $ft_rw => $ft_val)
                                  @foreach ($ft_val as $name => $val)
                                       @php extract($ft_row[$ft_rw]); @endphp
                                  @endforeach
                              @endforeach 
                              @php
                                 $ft_tmp_id = $ft_key + 1;
                                 $footer_id = $footer[0]->template_id;
                              @endphp

                             @if( $footer_id == $ft_tmp_id)
                                @php $id_ft = $footer[0]['template_id']; @endphp
                                @include($ft_path.$ft_tmp_id)
                             @endif
                          @endforeach  
                  </td>
                </tr>
                <table width="800" border="0" cellspacing="0" cellpadding="0" style="width:480pt;">
                  <tbody><tr>
                    <td valign="top" style="padding: 21px 0px 0px 0px;">
                      <div align="right" style="margin:0;"><font face="Calibri,sans-serif" size="2"><span style="font-size:11pt;"><font face="Open Sans,sans-serif" size="2" color="#999999"><span style="font-size:9pt;">We would dislike to see you go, but if you wish to do so, please
                      </span></font><a name="opt_out_1"><font face="Open Sans,sans-serif" size="2" color="#999999"><span style="font-size:9pt;"></span></font></a><a href="http://links.salesconquest.mkt4184.com/ui/modules/display/optOut.jsp?&amp;m=19557505&amp;r=NDY3MzMzNDkzOTM2S0&amp;j=MTI2MDg3NDI1NwS2&amp;mt=1&amp;rt=0" target="_blank"><font face="Open Sans,sans-serif" size="2"><span style="font-size:9pt;"><font color="#409BC9">unsubscribe
                      here. </font></span></font></a></span></font></div>
                    </td>
                  </tr>
                </tbody></table>
              </table>
</td>
</tr>
</table>
</body>
<?php // Remove all Input Hidden
$myvar = ob_get_clean();
$html_no_input_hiden = preg_replace('#<input[^>]*type="hidden"[^>]*>#','', $myvar);
?>
{!! $html_no_input_hiden !!}
</html>
