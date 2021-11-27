<div class="form-group {{ $moduleInfo['groupClass'] }}">
    <label for="{{ $settingName }}">{{ __($moduleInfo['label']) }}</label>
    <select multiple class="locales {{ $moduleInfo['groupClass'] }} select2" name="{{ $settingName }}[]" id="locales">
        @foreach ($locales as $id => $locale)
        <option value="{{ $id }}" {{ isset($dbSettings[$settingName]) && isset(array_flip(json_decode($dbSettings[$settingName]->plainValue))[$id]) ? 'selected' : '' }}>
            {{ Arr::get($locale, 'name') }}
        </option>
        @endforeach
    </select>
</div>
