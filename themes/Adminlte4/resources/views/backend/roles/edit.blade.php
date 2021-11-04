@extends ("backend.layouts.app")

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

@section("content")
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="{{$module_icon}}"></i>{{ __($module_action) }} {{ Str::singular($module_title) }} </h3>

        <div class="card-tools">
           <x-buttons.return-back />
           <x-buttons.show smal="true" route='{!!route("backend.$module_name.show", $$module_name_singular)!!}' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" class="ml-1"/>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-4">
            <div class="col">
                {{ html()->modelForm($$module_name_singular, 'PATCH', route("backend.$module_name.update", $$module_name_singular->id))->class('form-horizontal')->open() }}

                    <div class="form-group row">
                        {{ html()->label(__("labels.backend.$module_name.fields.name"))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.roles.fields.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            Permissions by module
                        </div>
                        <div class="col-md-10">
                            @if ($permissions->count())
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    @foreach($permissions->groupBy('module_name') as $m_n => $perms)
                                        <li class="nav-item">
                                            <a class="nav-link {{$loop->first ? 'active': ''}}" id="pills-{{$m_n}}-tab" data-toggle="pill" href="#pills-{{$m_n}}" role="tab" aria-controls="pills-{{$m_n}}" aria-selected="{{$loop->first ? 'true': 'false'}}">{{ $m_n }}</a>
                                        </li>   
                                    @endforeach
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    @foreach($permissions->groupBy('module_name') as $m_n => $perms)
                                        <div class="tab-pane fade{{$loop->first ? ' show active':''}} " id="pills-{{$m_n}}" role="tabpanel" aria-labelledby="pills-{{$m_n}}-tab">
                                            @foreach($perms as $permission)
                                                <div class="row">
                                                    <div class="col-3">
                                                        @php
                                                        $label = (!$permission->display_name) ? __($permission->name) : __($permission->display_name);
                                                        @endphp

                                                        {{ html()->label(
                                                                html()
                                                                    ->checkbox('permissions[]', in_array($permission->name, $$module_name_singular->permissions->pluck('name')->all()), $permission->name)
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

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                {{ html()->submit($text = icon('fas fa-save')." Save")->class('btn btn-success') }}
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="float-right">
                                <a href="{{route("backend.$module_name.destroy", $$module_name_singular)}}" class="btn btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.delete')}}"><i class="fas fa-trash-alt"></i></a>
                                <a href="{{ route("backend.$module_name.index") }}" class="btn btn-warning" data-toggle="tooltip" title="{{__('labels.backend.cancel')}}"><i class="fas fa-reply"></i> Cancel</a>
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
                    Updated: {{$$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$$module_name_singular->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>

@endsection
