@props(["small"=>""])
<button type="button" onclick="window.history.back();" class="btn btn-tool {{($small=='true')? 'btn-sm' : ''}}" title="{{__('Return Back')}}" data-widget="chat-pane-toggle">
<i class="fas fa-arrow-left"></i></button>