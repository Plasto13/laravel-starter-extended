@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

@section('content_header')
    {{ __('labels.backend.roles.index.sub-title') }}
@endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ $module_title }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="{{$module_icon}}"></i> {{ $module_title }}</h3>

        <div class="card-tools">
           <x-buttons.return-back />
           <x-buttons.create small="true" route='{{ route("backend.$module_name.create") }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}"/>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-4">
            <div class="col">
                <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>{{ __("labels.backend.$module_name.fields.name") }}</th>
                            <th>{{ __("labels.backend.$module_name.fields.permissions") }}</th>
                            <th class="text-right" style="width: 250px;">{{ __("labels.backend.action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($$module_name as $module_name_singular)
                        <tr>
                            <td>
                                <strong>
                                    {{ $module_name_singular->name }}
                                </strong>
                            </td>
                            <td>
                                @foreach ($module_name_singular->permissions as $permission)
                                <i class="far fa-check-circle mr-1"></i>{{ (!$permission->display_name) ? __($permission->name) : __($permission->display_name) }}
                                @endforeach
                            </td>
                            <td class="text-right">
                                @can('edit_'.$module_name)
                                <x-buttons.edit route='{!!route("backend.$module_name.edit", $module_name_singular)!!}' title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
                                @endcan
                                <x-buttons.show route='{!!route("backend.$module_name.show", $module_name_singular)!!}' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $$module_name->total() !!} {{ __('labels.backend.total') }}
                </div>
            </div>
            <div class="col-5">
                <div class="float-right">
                    {!! $$module_name->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
