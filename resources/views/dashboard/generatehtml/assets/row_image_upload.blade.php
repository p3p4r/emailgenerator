@if(!isset($download))
	<li class="col-lg-5 list-group-item pull-right">
		<p style="text-align: right;"><a href="#uplouadImagePopup{{$var}}" class="btn btn-primary"  rel="modal:open"><i class="fa fa-image"></i>{{__("generator.upload") }}</a></p>
		<div id="uplouadImagePopup{{$var}}" class="modal" style="text-align: center;">
			<span><i class="fa fa-image" style="font-size: 35px;margin: 10px 0px 0px 0px;"></i>
				<h2 style="display: inline-table;margin-left:  15px;">
					{{__("generator.upload_image") }}
				</h2></span><hr>
			<input type="file" name="imageuploud[{{$var}}]" class="uploadSingle{{$var}}">
			<br>
			<label for="imageLink{{$var}}" style="text-align: left;width: 100%;">{{ __("generator.imagelink") }}</label>
			<div id="alertLink{{$var}}" class="alert alert-danger hidden" role="alert">{{ __("generator.wrong_url") }}</div>
			<input id="imageLink{{$var}}" type="text" name="imagelink[{{$var}}]" @if(isset($imageUrl)) value="{{ $imageUrl }}" @endif placeholder="{{ __('generator.url_placeholder') }}">
			<a class="btn btn-info btn-modal{{$var}}" disabled="disabled" style="margin: 20px 0px 10px 0;float: right;">{{__("generator.save") }}</a>
		</div>
	</li> <!-- End Popup -->
@endif