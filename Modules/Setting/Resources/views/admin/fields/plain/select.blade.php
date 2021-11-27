<div class="form-group {{ $moduleInfo['groupClass'] }}">
    <label for="{{ $settingName }}">{{ __($moduleInfo['label']) }}</label>
    <select class="form-control" name="{{ $settingName }}" id="{{ $settingName }}">
        @foreach ($themes as $name => $theme)
            <option value="{{ $name }}" {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == $name ? 'selected' : '' }}>
                {{ $theme->getName() }}
            </option>
        @endforeach
    </select>
</div>
