<div class="form-group {{ $moduleInfo['groupClass'] }}">
    <div class="card card-tabs">
        <div class="navbar navbar-light">{!! Form::label($settingName, __($moduleInfo['label'])) !!}
        </div>
        <select class="form-control" name="{{ $settingName }}" id="{{ $settingName }}">
            @foreach ($themes as $name => $theme)
                <option value="{{ $name }}" {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == $name ? 'selected' : '' }}>
                    {{ $theme->getName() }}
                </option>
            @endforeach
        </select>
    </div>
</div>
