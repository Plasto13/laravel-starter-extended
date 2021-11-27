<?php
namespace Modules\Setting\Entities;

use Modules\Core\Entities\BaseModel;

class Setting extends BaseModel
{
    protected $table = 'setting_settings';

    public $translatedAttributes = ['value', 'description'];
    protected $fillable = ['name', 'value', 'description', 'isTranslatable', 'plainValue'];
}
