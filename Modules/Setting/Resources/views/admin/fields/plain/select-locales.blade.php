<div class="form-group {{ $moduleInfo['groupClass'] }}">
    <div class="card card-tabs">
        <div class="navbar navbar-light">
            {!! Form::label($settingName, __($moduleInfo['label'])) !!}
        </div>
        <div class="card-body">
            <select multiple="multiple" class="locales {{ $moduleInfo['groupClass'] }} select2" name="{{ $settingName }}[]" id="locales">
                @foreach (config('portal.core.available-locales') as $id => $locale)
                <option value="{{ $id }}" {{ isset($dbSettings[$settingName]) && isset(array_flip(json_decode($dbSettings[$settingName]->plainValue))[$id]) ? 'selected' : '' }}>
                    {{ Arr::get($locale, 'name') }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
