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
        <form method="post" action="{{ route('backend.setting.store') }}" class="form-horizontal" role="form">
                {!! csrf_field() !!}
        <div class="row">
            <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  @foreach ($modulesWithSettings as $module => $settings)
                        <a href="#{{ $module }}" id="{{ $module }}" class="nav-link {{ $loop->first ? 'active' : ''  }}" aria-controls="{{ $module }}-tab" data-toggle="pill" role="tab">
                            {{ ucfirst($module) }}
                            <small class="badge pull-right bg-blue">{{ count($settings) }}</small>
                        </a>
                  @endforeach
                </div>
            </div>
            <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                    @foreach ($modulesWithSettings as $module => $settings)
                        @include('setting::admin.fields.fields',compact('settings', 'module', 'locales'))
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row m-b-md">
            <div class="col-md-12">
                <button class="btn-primary btn">
                    <i class='fas fa-save'></i> @lang('Save')
                </button>
            </div>
        </div>

        </form>
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
