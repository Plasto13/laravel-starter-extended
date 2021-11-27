<div class="form-group {{ $moduleInfo['groupClass'] }}">
    <label for="{{ $settingName }}">{{ __($moduleInfo['label']) }}</label>
    <select class="form-control {{ $moduleInfo['class'] }}" name="{{ $settingName }}" id="{{ $settingName }}">
        @foreach ($themes['frontend'] as $name => $theme)
            <option value="{{ $name }}" {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == $name ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
