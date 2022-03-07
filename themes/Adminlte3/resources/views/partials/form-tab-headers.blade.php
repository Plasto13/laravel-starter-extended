@push('after-styles')
<style>
    .error {
        border-top-color: #dd4b39 !important;
    }
</style>
@endpush

<?php if (count(LaravelLocalization::getSupportedLocales()) > 1): ?>
<nav class=" navbar navbar-expand navbar-light">
<ul class="nav nav-tabs navbar-nav">
    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
        <?php $class = ''; ?>
        <?php foreach ($errors->getMessages() as $field => $messages): ?>
            <?php if (substr($field, 0, strpos($field, ".")) == $locale) $class = 'error' ?>
        <?php endforeach ?>
        <li class="nav-item">
            <a class="nav-link {{ locale() == $locale ? 'active' : '' }} {{ $class }}"
                role="tab"
                href="#tab_{{ $locale }}"
                aria-controls="#tab_{{ $locale }}"
                data-toggle="tab"
                {{-- parameter="{{$locale}}" --}}
                aria-selected="{{ locale() == $locale ? 'true': 'false' }}"
                >{{ $language['name'] }}
            </a>
        </li>
    @endforeach
</ul>
</nav>
<?php endif; ?>
