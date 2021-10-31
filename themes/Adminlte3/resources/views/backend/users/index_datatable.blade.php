@extends ('backend.layouts.app')

@section('title') {{ $module_action }} {{ $module_title }} @endsection

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
        <h3 class="card-title"><i class="{{$module_icon}}"></i> {{ $module_action }}</h3>

        <div class="card-tools">
           <x-buttons.return-back />
           <div class="btn-group">
                <button id="btnGroupToolbar" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown">
                    <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item btn-sm" href="{{ route("backend.$module_name.trashed") }}">
                        {{__("View trash")}}
                    </a>
                </div> 
            </div>
            <x-buttons.create small="true" route='{{ route("backend.$module_name.create") }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}"/>
        </div>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-6 col-sm-4">
                <div class="float-right">
                    
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('labels.backend.users.fields.name') }}</th>
                                <th>{{ __('labels.backend.users.fields.email') }}</th>
                                <th>{{ __('labels.backend.users.fields.status') }}</th>
                                <th>{{ __('labels.backend.users.fields.roles') }}</th>
                                <th class="text-right">{{ __('labels.backend.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">

                </div>
            </div>
            <div class="col-5">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">

@endpush

@push ('after-scripts')
<!-- DataTables Core and Extensions -->
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

<script type="text/javascript">

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,
        responsive: true,
        ajax: '{{ route("backend.$module_name.index_data") }}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
            {data: 'user_roles', name: 'user_roles'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $('#datatable').on( 'draw.dt', function () {
        $('.msg').click(function() {
            var route = $(this).attr('href');
            var question = $(this).attr('data-confirm');
            var type = $(this).attr('data-type');
            var method = $(this).attr('data-method');
            var token = $(this).attr('data-token');

            var n = new Noty({
              text: question,
              type: type,
              buttons: [
                Noty.button('YES', 'btn btn-success', function () {
                    n.close();
                    var form = document.createElement("form");
                        form.setAttribute("method", "POST");
                        form.setAttribute("action", route);
                        var MT = document.createElement("input");
                        MT.setAttribute("type", 'hidden');
                        MT.setAttribute("value", method);
                        MT.setAttribute("name", "_method");
                        form.appendChild(MT);
                        var TK = document.createElement("input");
                        TK.setAttribute("type", 'hidden');
                        TK.setAttribute("value", token);
                        TK.setAttribute("name", "_token");
                        form.appendChild(TK);
                        $(document.body).append(form);
                        console.log(form);
                        form.submit();
                }, {id: 'button1', 'data-status': 'ok'}),

                Noty.button('NO', 'btn btn-error', function () {
                    console.log('button 2 clicked');
                    n.close();
                })
              ]
            });
            n.show();
           
            console.log(type)
                    
        });
    }).dataTable(); 
</script>
@endpush
