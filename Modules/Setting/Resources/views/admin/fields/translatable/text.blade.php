<div class='form-group {{ $moduleInfo['groupClass'] }}'>
    <div class="card card-tabs">
      <nav class=" navbar navbar-expand navbar-light">
        <ul class="navbar-nav">
            <li class="pt-2 px-3"><a class="card-title">{{ __($moduleInfo['label']) }}</a>
            </li>
        </ul>
        <ul class="nav nav-tabs navbar-nav ml-auto" id="custom-tabs-two-tab" role="tablist">
        @foreach($langs as $lang => $name)
          <li class="nav-item">
            <a class="nav-link{{ ($loop->first)? ' active': '' }}"
                id="{{ Str::after(str_replace('_', '-',$moduleInfo['description']), '.') }}-tabs-{{ $lang }}-tab" data-toggle="pill"
                href="#{{ Str::after(str_replace('_', '-',$moduleInfo['description']), '.') }}-{{ $lang }}"
                role="tab"
                aria-controls="{{ Str::after(str_replace('_', '-',$moduleInfo['description']), '.') }}-tab-{{ $lang }}"
                aria-selected="{{ ($loop->first)? 'true': 'false' }}"

             > {{ $lang }}</a>
          </li>
        @endforeach
        </ul>
      </nav>
      <div class="card-body">
        <div class="tab-content" id="{{ Str::after(str_replace('_', '-',$moduleInfo['description']), '.') }}-tabs-tabContent">
        @foreach($langs as $lang => $name)
            <div class="tab-pane fade{{ ($loop->first)? ' active show': '' }}"
             id="{{ Str::after(str_replace('_', '-',$moduleInfo['description']), '.') }}-{{ $lang }}" role="tabpanel" aria-labelledby="{{ Str::after(str_replace('_', '-',$moduleInfo['description']), '.') }}-{{ $lang }}">
                <?php if (isset($dbSettings[$settingName])): ?>
                    <?php $value = $dbSettings[$settingName]->hasTranslation($lang) ? $dbSettings[$settingName]->translate($lang)->value : ''; ?>
                    {!! Form::text($settingName . "[$lang]", old($settingName . "[$lang]", $value), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
                <?php else: ?>
                    {!! Form::text($settingName . "[$lang]", old($settingName . "[$lang]"), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
                <?php endif; ?>
            </div>
          @endforeach
        </div>
      </div>
      <!-- /.card -->
    </div>
</div>
