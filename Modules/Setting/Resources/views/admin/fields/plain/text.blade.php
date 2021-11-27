<div class='form-group {{ $moduleInfo['groupClass'] }}'>
    {!! Form::label($settingName, __($moduleInfo['label'])) !!}
    <?php if (isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue !== null): ?>
        {!! Form::text($settingName, old($settingName, $dbSettings[$settingName]->plainValue), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php else: ?>
        {!! Form::text($settingName, old($settingName), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php endif; ?>
</div>
