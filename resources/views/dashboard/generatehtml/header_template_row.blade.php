@if(!isset($download))
    @if (!isset($id_ct))
              @php
                $id_ct = $rows[$row_key]['template_id']; 
                $var = $row_key;
              @endphp
    @endif
    <div id="cont{{$var}}" class="contentContainer">
      <span id="close_row_{{$var}}" class="close"><i class="fa fa-times-circle"></i></span>
      @if(!isset($left) && !isset($right)) <input id="align{{$var}}" type="hidden" name="counterContainer[{{$var}}]" value="0"> @endif
      @if(isset($imageName)) <input type="hidden" name="imageName[{{$var}}]" value="{{ $imageName }}"> @endif
      @if(isset($imageUrl)) <input type="hidden" name="imageUrl[{{$var}}]" value="{{ $imageUrl }}"> @endif
      <input id="rowId{{$var}}" type="hidden" name="rowId[{{$var}}]" @if(isset($rows)) value="{{$rows[$row_key]['id']}}" @else value="0{{$var}}" @endif >
      <input type="hidden" name="rowTemplate[{{$var}}]"  value="{{$id_ct}}">
      <table width="640" style="width:640px;margin-left: auto;margin-right: auto;"  cellpadding="0">
        <tbody>
          <tr>
            <td>
@endif