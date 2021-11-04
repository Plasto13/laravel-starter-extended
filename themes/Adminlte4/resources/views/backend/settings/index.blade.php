@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

@section('content_header')
    {{ ucwords(Str::singular($module_name)) }}
@endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ $module_title }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="{{$module_icon}}"></i>  @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])</h3>
        <div class="card-tools">
           <x-buttons.return-back />
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-4">
            <div class="col">
                <form method="post" action="{{ route('backend.settings.store') }}" class="form-horizontal" role="form">
                    {!! csrf_field() !!}

                    @if(count(config('setting_fields', [])) )

                        @foreach(config('setting_fields') as $section => $fields)
                        <div class="card card-accent-primary">
                            <div class="card-header">
                                <i class="{{ Arr::get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
                                {{ $fields['title'] }}
                            </div>
                            <div class="card-body">
                                <p class="text-muted">{{ $fields['desc'] }}</p>

                                <div class="row">
                                    <div class="col">
                                        @foreach($fields['elements'] as $field)
                                            @includeIf('backend.settings.fields.' . $field['type'] )
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="card card-accent-primary">
                            <div class="card-header">
                                <i class="icon glyphicon glyphicon-flash"></i>
                                Templates
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Templates settings</p>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group {{ $errors->has('frontend_theme') ? ' has-error' : '' }}">
                                            <label for="frontend_theme"> <strong>{{ __('Frontend template') }}</strong> (frontend_theme)</label> <span class="text-danger"> <strong>*</strong> </span>
                                            <select name="frontend_theme" class="form-control select2 {{ $errors->has('frontend_theme') ? ' is-invalid' : '' }}" id="frontend_theme" required>
                                                @foreach(get_list_of_frontend_themes() as $val => $label)
                                                    <option @if( old('frontend_theme', setting('frontend_theme')) == $val ) selected  @endif value="{{ $val }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('frontend_theme')) <small class="invalid-feedback">{{ $errors->first('frontend_theme') }}</small> @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('frontend_theme') ? ' has-error' : '' }}">
                                            <label for="backend_theme"> <strong>{{ __('Backend template') }}</strong> (backend_theme)</label> <span class="text-danger"> <strong>*</strong> </span>
                                            <select name="backend_theme" class="form-control select2 {{ $errors->has('backend_theme') ? ' is-invalid' : '' }}" id="backend_theme" required>
                                                @foreach(get_list_of_backend_themes() as $val => $label)
                                                    <option @if( old('backend_theme', setting('backend_theme')) == $val ) selected  @endif value="{{ $val }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('backend_theme')) <small class="invalid-feedback">{{ $errors->first('backend_theme') }}</small> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif

                    <div class="row m-b-md">
                        <div class="col-md-12">
                            <button class="btn-primary btn">
                                <i class='fas fa-save'></i> @lang('Save')
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">

        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
   $(".select2").select2({
    placeholder: "Select",
   });
</script>
@endpush
