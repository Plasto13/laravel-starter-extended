<div class="dropdown dropdown-hover">
    <a href="javascript:;">{{ trans('core::table.general.bulk_export') }}
        <i class="fa fa-angle-right"></i>
    </a>
    <div class="dropdown-content">
        @foreach ($bulk_changes as $key => $bulk_change)
            <a href="#" data-key="{{ $key }}" data-class-item="{{ $class }}" data-value="{{ $bulk_change['value'] }}" data-save-url="{{ $url }}"
               class="bulk-export-item">{{ $bulk_change['title'] }}</a>
        @endforeach
    </div>
</div>