@if(!isset($download))   
        @if(isset($left))
          <input id="align{{$var}}" type="hidden" name="counterContainer[{{$var}}]"  value="1">
        @elseif (isset($right))
          <input id="align{{$var}}" type="hidden" name="counterContainer[{{$var}}]"  value="2">
        @else (!isset($left) && !isset($right))
          <input id="align{{$var}}" type="hidden" name="counterContainer[{{$var}}]" value="0">
        @endif
        <li class="col-lg-7 list-group-item" style="padding-left: 35px;">                      
          <span class="orientation_label">
            @if( isset($left) )
            <span class="alignment">{{ __("generator.left") }}</span> | <span>{{ __("generator.right") }}</span></span>
            @elseif ( isset($right) ) 
            <span>{{ __("generator.left") }}</span> | <span class="alignment">{{ __("generator.right") }}</span></span>  
            @endif            

            <div class="Orientation-Switch pull-left">    
              @if( isset($left) )           
              <input onclick="toogleAlign({{$var}})" class="alignDefault"  id="switchOrientation{{$var}}" type="checkbox">    
              @elseif( isset($right) )
              <input onclick="toogleAlign({{$var}})" id="switchOrientation{{$var}}" checked type="checkbox">
              @endif
              <label for="switchOrientation{{$var}}" class="label-success"></label>                      
            </div>             
         </li>
@endif          