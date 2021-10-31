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
        <h3 class="card-title"><i class="{{$module_icon}}"></i> {{ $module_action }}</h3> <small> (@lang(":count unread", ['count'=>$unread_notifications_count]))</small>

        <div class="card-tools">
           <x-buttons.return-back />
           <a href="{{ route("backend.$module_name.markAllAsRead") }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="@lang('Mark All As Read')"><i class="fas fa-check-square"></i> @lang('Mark All As Read')</a>
                    <a href="{{route("backend.$module_name.deleteAll")}}" class="btn btn-danger btn-sm" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="@lang('Delete All Notifications')"><i class="fas fa-trash-alt"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-4">
            <div class="col">
                <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>
                                @lang('Text')
                            </th>
                            <th>
                                @lang('Module')
                            </th>
                            <th>
                                @lang('Updated At')
                            </th>
                            <th class="text-right">
                                @lang('Action')
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($$module_name as $module_name_singular)
                        <?php
                        $row_class = '';
                        $span_class = '';
                        if ($module_name_singular->read_at == ''){
                            $row_class = 'table-info';
                            $span_class = 'font-weight-bold';
                        }
                        ?>
                        <tr class="{{$row_class}}">
                            <td>
                                <a href="{{ route("backend.$module_name.show", $module_name_singular->id) }}">
                                    <span class="{{$span_class}}">
                                        {{ $module_name_singular->data['title'] }}
                                    </span>
                                </a>
                            </td>
                            <td>
                                {{ $module_name_singular->data['module'] }}
                            </td>
                            <td>
                                {{ $module_name_singular->updated_at->diffForHumans() }}
                            </td>
                            <td class="text-right">
                                <a href='{!!route("backend.$module_name.show", $module_name_singular)!!}' class='btn btn-sm btn-success mt-1' data-toggle="tooltip" title="@lang('Show') {{ ucwords(Str::singular($module_name)) }}"><i class="fas fa-tv"></i></a>
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
                    @lang('Total') {{ $$module_name->total() }} {{ ucwords($module_name) }}
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
