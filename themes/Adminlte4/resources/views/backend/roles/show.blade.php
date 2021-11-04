@extends ('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

@section('content_header')
    {{ __('labels.backend.roles.index.sub-title') }}
@endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}' >
        {{ $module_title }}
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">{{ __($module_action) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="{{$module_icon}}"></i> {{ $module_title }}</h3>

        <div class="card-tools">
           <x-buttons.return-back />
           <x-buttons.edit small="true" route='{!!route("backend.$module_name.edit", $$module_name_singular)!!}' title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" class="ml-1" />
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __("labels.backend.$module_name.fields.name") }}</th>
                            <td>{{ $$module_name_singular->name }}</td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.$module_name.fields.permissions") }}</th>
                            <td>
                                @if($$module_name_singular->permissions()->count() > 0)
                                    <ul>
                                        @foreach ($$module_name_singular->permissions as $permission)
                                        <i class="far fa-check-circle mr-1"></i>{{ (!$permission->display_name) ? __($permission->name) : __($permission->display_name) }}
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.$module_name.fields.created_at") }}</th>
                            <td>{{ $$module_name_singular->created_at }}<br><small>({{ $$module_name_singular->created_at->diffForHumans() }})</small></td>
                        </tr>

                        <tr>
                            <th>{{ __("labels.backend.$module_name.fields.updated_at") }}</th>
                            <td>{{ $$module_name_singular->updated_at }}<br/><small>({{ $$module_name_singular->updated_at->diffForHumans() }})</small></td>
                        </tr>

                    </table>
                </div><!--table-responsive-->
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    Updated: {{$$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$$module_name_singular->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>
@endsection