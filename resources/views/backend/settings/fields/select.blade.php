<div class="form-group">
    <label for="{{ $settingName }}">{{ trans($moduleInfo['description']) }}</label>
    <select multiple class="select2" name="{{ $settingName }}[]" id="{{ $settingName }}">
        @foreach ($values as $id => $value)
        <option value="{{ $id }}" {{ isset($dbSettings[$settingName]) && isset(array_flip(json_decode($dbSettings[$settingName]->plainValue))[$id]) ? 'selected' : '' }}>
            {{ array_get($value, 'name') }}
        </option>
        @endforeach
    </select>
</div>

