<td id="imageContainer{{$var}}" width="288" height="288" valign="top" style="width:288px;height:288px;font-size:0;padding-left:32px;">
               @if(isset($imageName))
               <a @if(isset($imageUrl)) href="{{ $imageUrl }}" @endif target="_blank">
                <img id="img{{$var}}" width="288" height="288" style="display:block !important;" border="0" src="{{url('/')}}/{{ $imagePath.$imageName }}"alt="image">
              </a>
              @else 
              <a>
                <input id="default{{$var}}" type="hidden" name="default_img" value="0">
                <img id="img{{$var}}" width="288" height="288" style="display:block !important;" border="0" src="{{ URL::asset('newsletter/default.png') }}" alt="image">
              </a>
              @endif 
</td>