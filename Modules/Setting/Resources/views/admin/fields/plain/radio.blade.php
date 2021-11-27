<div class="checkbox {{ $moduleInfo['groupClass'] }}">
    <?php foreach ($moduleInfo['options'] as $value => $optionName): ?>
        <label for="{{ $optionName }}">
                <input id="{{ $optionName }}"
                        name="{{ $settingName }}"
                        type="radio"
                        class="flat-blue {{ $moduleInfo['groupClass'] }}"
                        {{ isset($dbSettings[$settingName]) && (bool)$dbSettings[$settingName]->plainValue == $value ? 'checked' : '' }}
                        value="{{ $value }}" />
                {{ trans($optionName) }}
        </label>
    <?php endforeach; ?>
</div>
