@extends("layouts.adminboard")
@section("TabTitle", "Gerar Html")
@section("style")
@parent
<style type="text/css" media="screen">
th,td {
  text-align:center;
}
.fst_upper:first-letter{text-transform:uppercase;}
.btn-custom-b{padding: 10px 15px;font-size: 15px;margin-left: 30px;margin-bottom: 20px;}
</style>
@endsection("style")
@section("content")
@if(Session::has('flash_message'))
<div class="alert alert-success">
    {{ Session::get('flash_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif
<table class="table table-hover table-striped custab">
   <h3>{{ __("generator.index_title") }}</h3>
   <hr>
   <a class="btn btn-info btn-xs btn-custom-b" href="{{ route('generatehtml.create') }}"><span class="fa fa-edit"></span>{{ __("generator.create_new") }}</a>
    <!-- <button style="float:right;margin-right:70px;" class="btn btn-default dropdown-toggle " type="button" data-toggle="dropdown"><i style="margin:5px;"class="fa fa-cog"></i>
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="{{ Route('header.create') }}">Custom Header</a></li>
    </ul> -->
   <thead>
    <tr>
       <th>{{ __("generator.template")}}</th>
       <th>{{ __("generator.id")}}</th>
       <th>{{ __("generator.name")}}</th>
       <th>{{ __("generator.created_at")}}</th>
       <th>{{ __("generator.updated_at")}}</th>
       <th class="text-center">{{ __("generator.action")}}</th>
   </tr>
</thead>
@forelse ($htmls as $key => $html)
<?php
$name      = $html->name;
$html_id   = $rows[$key]['html_id'];
$row_id    = $rows[$key]['html_id'];
$row_color = unserialize($rows[$key]['content'])['color'];
?>
<tr>
   <td>
    @if($html->created_at->format('d-m-Y') == $currentDate)
    <p class="new">{{__('generator.new')}}</p>
    @endif
     <div class="fst_upper" style="background: @if( $html_id == $row_id ) {{ $row_color }} @endif; padding:10px 5px;text-align:center;color:#fff;margin-right: auto;margin-left:auto;">{{ $name }}</div>
</td>
<td>{{ $html->id }}</td>
<td class="fst_upper">{{ $name }}</td>
<td>{{ $html->created_at }}</td>
<td>{{ $html->updated_at }}</td>
<td class="text-center">
  <a class='btn btn-xs btn-copy'><span class="fa fa-copy"></span>{{ __("generator.copy")}}</a>
 <a class='btn btn-info btn-xs' href="{{ route('html.edit', $html->id) }}"><span class="fa fa-edit"></span>{{ __("generator.edit")}}</a>
 <form onSubmit="if(!confirm('Prentende Eliminar?')){return false;}" style="display: inline">
    <input type="hidden" name="_method" value="DELETE" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <button type="submit" class="btn btn-danger">
     <span class="icon"><i class="fa fa-times"></i></span>
 </button>
</form>
</td>
</tr>
@empty
<tr><td colspan="10"><p>{{ __("generator.no_data")}}</p></td></tr>
@endforelse
</table>
<div style="text-align:center;">
  {!! $htmls->render() !!}
</div>
@endsection
