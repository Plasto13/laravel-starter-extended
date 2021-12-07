<div class='form-group {{ $moduleInfo['groupClass'] }}'>
    <div class="card card-tabs">
    {!! Form::label($settingName, __($moduleInfo['label'])) !!}
    <?php if (isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue !== null): ?>
        {!! Form::input('number', $settingName, old($settingName, $dbSettings[$settingName]->plainValue), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php else: ?>
        {!! Form::input('number', $settingName, old($settingName), ['class' => 'form-control'.$moduleInfo['groupClass'], 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php endif; ?>
    </div>
</div>
