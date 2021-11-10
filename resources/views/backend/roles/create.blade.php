@extends ('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

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
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> {{ __('labels.backend.roles.index.title') }}
                    <small class="text-muted">{{ __('labels.backend.roles.show.action') }} </small>
                </h4>
                <div class="small text-muted">
                    {{ __('labels.backend.roles.index.sub-title') }}
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <x-buttons.return-back />
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">

                {{ html()->form('POST', route('backend.roles.store'))->class('form-horizontal')->open() }}
                    {{ csrf_field() }}

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.roles.fields.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.roles.fields.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}

                        <div class="col-12 col-sm-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td>
                                               @if ($permissions->count())
                                                   @if ($permissions->count())
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    @foreach($permissions->groupBy('module_name') as $module_name => $perms)
                                        <li class="nav-item">
                                            <a class="nav-link {{$loop->first ? 'active': ''}}" id="pills-{{$module_name}}-tab" data-toggle="pill" href="#pills-{{$module_name}}" role="tab" aria-controls="pills-{{$module_name}}" aria-selected="{{$loop->first ? 'true': 'false'}}">{{ $module_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    @foreach($permissions->groupBy('module_name') as $module_name => $perms)
                                        <div class="tab-pane fade{{$loop->first ? ' show active':''}} " id="pills-{{$module_name}}" role="tabpanel" aria-labelledby="pills-{{$module_name}}-tab">
                                            @foreach($perms as $permission)
                                                <div class="form-check row">
                                                    <div class="col-3">
                                                        @php
                                                        $label = (!$permission->display_name) ? __($permission->name) : __($permission->display_name);
                                                        @endphp

                                                        {{ html()->label(
                                                                html()
                                                                    ->checkbox('permissions[]', false, $permission->name)
                                                                    ->id('permission-'.$permission->id)
                                                                     . ' ' . $label)
                                                                ->for('permission-'.$permission->id) }}

                                                    </div>
                                                    <div class="col">
                                                        @if($permission->description)
                                                            {{ __($permission->description) }}
                                                        @endif

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                                               @endif
                                           </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--form-group-->

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <x-buttons.create title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}">
                                    {{__('Create')}}
                                </x-buttons.create>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <div class="form-group">
                                    <x-buttons.cancel />
                                </div>
                            </div>
                        </div>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">

                </small>
            </div>
        </div>
    </div>
</div>

@endsection
