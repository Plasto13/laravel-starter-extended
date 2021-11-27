<div class="checkbox {{ $moduleInfo['groupClass'] }}">
    <label for="{{ $settingName }}">
        <input id="{{ $settingName }}"
                name="{{ $settingName }}"
                type="checkbox"
                class="flat-blue"
                {{ isset($dbSettings[$settingName]) && (bool)$dbSettings[$settingName]->plainValue == true ? 'checked' : '' }}
                value="1" />
        {{ __($moduleInfo['label']) }}
    </label>
</div>
