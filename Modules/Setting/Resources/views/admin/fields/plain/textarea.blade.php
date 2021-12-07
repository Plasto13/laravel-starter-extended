<div class='form-group {{ $moduleInfo['groupClass'] }}'>
    <div class="card card-tabs">
        <div class="navbar navbar-light">{!! Form::label($settingName, __($moduleInfo['label'])) !!}
        </div>
    <?php if (isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue !== null): ?>
        {!! Form::textarea($settingName, old($settingName, $dbSettings[$settingName]->plainValue), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php else: ?>
        {!! Form::textarea($settingName, old($settingName), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php endif; ?>
    </div>
</div>
