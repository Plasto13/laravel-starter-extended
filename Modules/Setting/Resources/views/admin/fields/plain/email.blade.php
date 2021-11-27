<div class='form-group {{ $moduleInfo['groupClass'] }}'>
    {!! Form::label($settingName, __($moduleInfo['label'])) !!}
    <?php if (isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue !== null): ?>
        {!! Form::input('email', $settingName, old($settingName, $dbSettings[$settingName]->plainValue), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php else: ?>
        {!! Form::input('email', $settingName, old($settingName), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php endif; ?>
</div>

