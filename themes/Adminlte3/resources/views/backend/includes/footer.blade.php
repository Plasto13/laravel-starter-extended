<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
     {!! setting('core::footer_text') !!}
    </div>
    <strong>
        @if(setting('core::show_copyright'))
            @lang('Copyright') &copy; {{ date('Y') }}
        @endif
        <a href="/">{{ setting('core::app_name') }}</a>. Pavol Duroska P&M Soft</strong>

</footer>
