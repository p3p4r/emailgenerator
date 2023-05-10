 @if(!isset($download))
     <title>People PT</title>
     <meta name="template" content="peoplept">
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.assets.template_header_header')
<table style="width:100%;" cellpadding="0" cellspacing="0">
        <tbody>
	<input name="template" type="hidden" value="peoplept">
</tr>

<tr id="cp">
	<td colspan="2" width="100%" valign="top" style="width: 100%;font-size:0;display:  table;height:140px;margin-bottom:35px;margin-top:35px;">
		<input id="generalColor" name="colortmp" type="hidden" class="input-group-addon" >
<h1 id="peoplept" class="input-group-addon themeBackground" @if(isset($color)) style="text-align:left;padding-left:35px;padding-right:35px;padding-top:0px;color: white;font-size: 42px;line-height:42px;font-weight:100;font-family:Open Sans Light,Open Sans,Arial;mso-font-alt:Arial;border:0;width:100%;height: 100px;vertical-align:  middle;display: table-cell;background:{{$color}};" @else style="text-align:left;padding-left:35px;padding-right:35px;padding-top:0px;color: white;font-size: 42px;line-height:42px;font-weight:100;font-family:Open Sans Light,Open Sans,Arial;mso-font-alt:Arial;border:0;width:100%;height: 100px;vertical-align:  middle;display: table-cell;background:#b91b1b;" @endif >#People PT</h1>
	</td>
</tr>
  </tbody>
</table>
@include('dashboard.generatehtml.assets.template_header_footer')
@endif

