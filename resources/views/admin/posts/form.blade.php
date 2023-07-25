<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {{ Form::label('title', 'Post title*') }}
    {{ Form::text("title", null, array("class"=>"form-control","id"=>"title", "placeholder"=>"Judul artikel")) }}
    @if ($errors->has('title'))
			<span class="help-block text-danger">
				<strong>{{ $errors->first('title') }}</strong>
			</span>
    @endif
</div>
<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
	{{ Form::label('content', 'Content*') }}

	{{ Form::textarea("content", null, array("class"=>"form-control","id"=>"content", "placeholder"=>"isi artikel")) }}
	@if ($errors->has('content'))
		<span class="help-block text-danger">
			<strong>{{ $errors->first('content') }}</strong>
		</span>
	@endif
</div>
<div class="form-group {{ $errors->has('featured_image') ? ' has-error ':''}}">
	{{ Form::label('featured_image','Featured Image* ') }}
	<div class="input-group">
		<div class="custom-file">
			{{ Form::file('featured_image', ["class"=>"form-control btn custom-file-input","id"=>"featured_image"])}}
			<label
				class="custom-file-label"
				id="file-label"
				>Choose file</label
			>
		</div>
	</div>
	<img id="preview_featured_image" class="inputImgPreview w-25 mt-2" src="@if(isset($post)){{ $post->featured_image->thumb }} @endif" class="img-thumbnail"/>

	@if ($errors->has('featured_image'))
		<span class="help-block text-danger">
			<strong>{{ $errors->first('featured_image') }}</strong>
		</span>
	@endif
</div>

<div class="form-group clearfix">
	<label>Buka Komentar : </label>
	<div class="icheck-primary d-inline">
		<input type="radio" id="radioYes" name="allowed_comment" value="1" {{ $post->allowed_comment == 1 ? 'checked' : '' }}>
		<label for="radioYes">Ya</label>
	</div>
	<div class="icheck-danger d-inline">
		<input type="radio" id="radioNo" name="allowed_comment" value="0" {{ $post->allowed_comment == 0 ? 'checked' : '' }}>
		<label for="radioNo">Tidak</label>
	</div>
</div>

@section('page_scripts')

	<script type="text/javascript" src="{{URL::asset('back/js/ckeditor/ckeditor.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('back/js/select2.min.js')}}"></script>

	<script type="text/javascript">
		document.getElementById('featured_image').addEventListener('change', function(e) {
			var fileName = e.target.files[0].name;
			document.getElementById('file-label').textContent = fileName;
		});

		CKEDITOR.replace( 'content' );

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				var targetPreview = 'preview_'+$(input).attr('id');
				reader.onload = function(e) {
						$('#'+targetPreview).attr('src', e.target.result).show();
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#featured_image").change(function() {
				readURL(this);
		});
	</script>
@endsection

