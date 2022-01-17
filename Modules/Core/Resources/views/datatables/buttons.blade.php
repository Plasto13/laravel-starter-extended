<div class="btn-group btn-xs" style="width: 100px">
	@if($extra)
		@if(is_array($extra))
			@foreach($extra as $btn)
				{!! $btn !!}
			@endforeach
		@endif
	@endif

	@if($edit)
		{!!$edit!!}
	@endif

	@if($delete)
		{!!$delete!!}
	@endif
</div>