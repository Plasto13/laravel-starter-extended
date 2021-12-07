<div class="row">
@foreach ($settings as $settingName => $moduleInfo)
    @php
    $type = Arr::get($moduleInfo, 'translatable', false) ? 'translatable' : 'plain';
    $fieldView = str_contains($moduleInfo['view'], '::') ? $moduleInfo['view'] : "setting::admin.fields.$type.{$moduleInfo['view']}";
    $locales = isset($locales) ? $locales : '';
    @endphp
    @include($fieldView, [
        'langs' => $locales,
        'settings' => $settings,
        'setting' => $settingName,
        'moduleInfo' => $moduleInfo,
        'settingName' => strtolower($module) . '::' . $settingName
    ])
@endforeach
</div>
