
@push('css')
<link href="{!! Module::asset('core:css/nestable.css') !!}" rel="stylesheet" type="text/css" />
<style type="text/css">
	.drag_disabled{
	    pointer-events: none;
	}

	.drag_enabled{
	    pointer-events: all;
	}
	.detail{
		pointer-events: all;
	}
</style>
@endpush

@push('js')
<script src="{!! Module::asset('core:js/jquery.nestable.js') !!}"></script>
<script>
function toggleText(item, text1, text2) {
  var x = document.getElementById(item);
  if (x.innerHTML === text1) {
    x.innerHTML = text2;
  } else {
    x.innerHTML = text1;
  }
}

$( document ).ready(function() {
	let nested;
    $('.dd').nestable({maxDepth: 7});
    $('.dd').on('change', function() {
    	if (!nested) {
    		 $('#save-btn').toggle();
    	}
        nested = $('.dd').nestable('serialize');
        console.log(nested);       
    });

    $('#save-btn').click(function () {
    	$.ajax({
        	type: "POST",
		  	url: "{{route('api.admin.structure.equipment.update.child')}}",
		  	data: {'nested' :nested},
		}).done(function(response) {
			console.log('response');
			$('#save-btn').toggle();
			growl('Order saved', 'success')
		});
    	// body...
    })

    $('#permission').click(function(){
         $('#nestable').toggleClass('drag_disabled drag_enabled');
         $('#permission').toggleClass('btn-primary btn-warning');
         toggleText('permission', 'Enable Edit', 'Disable Edit');
     });
    $('.detail').click(function(){
    	let _self = $(event.currentTarget);
    	console.log(_self.closest('.dd-item')[0].dataset.id);
    })
});
</script>
@endpush

@if((Auth::user()->isAbleTo($acces.'_update')))
		<button id="permission" class="btn btn-primary">Enable Edit</button>
		<button id="save-btn" class="btn btn-primary" style="display: none;">Save Order</button>
@endif


	<div class="col-md-6">
		<div class="dd drag_disabled" id="nestable" >
			{!! $items !!}
		</div>
	</div>



