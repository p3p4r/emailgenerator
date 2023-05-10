@if(!isset($download))
  	 <title>No header</title>
     <meta name="template" content="noheader">
@endif
@if (Request::ajax() || isset($download) || isset($edit))
@include('dashboard.generatehtml.assets.template_header_header')
<tr>
	 <input name="template" type="hidden" value="noheader">
    <input id="generalColor" name="colortmp" type="hidden" value="#000" >
</tr>
@include('dashboard.generatehtml.assets.template_header_footer')
@endif
