<div class="form-group {{ $moduleInfo['groupClass'] }}">
    <div class="card card-tabs">
        <div class="navbar navbar-light">
            {!! Form::label($settingName, __($moduleInfo['label'])) !!}
        </div>
        <div class="card-body">
            <select class="form-control {{ $moduleInfo['class'] }}" name="{{ $settingName }}" id="{{ $settingName }}">
                @foreach ($themes['frontend'] as $name => $theme)
                    <option value="{{ $name }}" {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == $name ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
