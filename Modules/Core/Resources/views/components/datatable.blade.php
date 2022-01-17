@push('css')
<style type="text/css">
    .dropdown-menu {z-index: 2002;}
</style>
<link media="all" type="text/css" rel="stylesheet" href="{!! Module::asset('core:css/filter.css') !!}">
<link media="all" type="text/css" rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/colvis/1.1.2/css/dataTables.colvis.jqueryui.css">
<link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.bootstrap.min.css">

@endpush
<div class="table-wrapper">
    @if ($table->isHasFilter())
    	<div class="table-configuration-wrap" @if (request()->has('filter_table_id')) style="display: block;" @endif>
        <span class="configuration-close-btn btn-show-table-options"><i class="fa fa-times"></i></span>
        {!! $table->renderFilter() !!}
    	</div>
    @endif
    <div class="portlet light bordered portlet-no-padding">
        <div class="portlet-title">
            <div class="caption">
                <div class="wrapper-action">
                    @if ($actions = $table->bulkActions())
                        <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle" href="#" data-toggle="dropdown">{{ trans('core::table.general.bulk_actions') }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($actions as $action)
                                    <li>
                                        {!! $action !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($table->isHasFilter())
                        <button class="btn btn-primary btn-show-table-options">{{ trans('core::table.general.filters') }}</button>
                    @endif
                </div>
            </div>
        <div class="table-responsive">
            {!! $table->builder()->table(['class' => 'table table-hover responsive nowrap dataTable dtr-inline', 'width'=>'100%']) !!}
            <!-- /.box-body -->
        </div>
    </div>
</div>
</div>
<!-- /.box -->

@push('js')
{{-- <script src="{!! mix('/js/datatables/datatables.min.js', '/assets/vendor/boilerplate') !!}"></script> --}}
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="{!! Module::asset('core:js/filter.js') !!}"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.1/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js" type="text/javascript"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js" type="text/javascript"></script>
{{-- <script src="https://cdn.datatables.net/plug-ins/1.10.24/dataRender/datetime.js" type="text/javascript"></script> --}}
<script src="//cdn.datatables.net/plug-ins/1.10.24/sorting/datetime-moment.js" type="text/javascript"></script>
{{-- <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js" type="text/javascript"></script> --}}
@endpush

@push('scripts')
{!! $table->builder()->scripts() !!}

<script src="{!! Module::asset('core:js/table.js') !!}"></script> 
@endpush