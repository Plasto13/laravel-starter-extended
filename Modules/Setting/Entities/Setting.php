<?php
namespace Modules\Setting\Entities;

use Modules\Core\Entities\BaseModel;

class Setting extends BaseModel
{
    protected $table = 'setting__settings';

    public $translatedAttributes = ['value', 'description'];
    protected $fillable = ['name', 'value', 'description', 'isTranslatable', 'plainValue'];

    public function isMedia(): bool
    {
        $value = json_decode($this->plainValue, true);
        return is_array($value) && isset($value['medias_single']);
    }
}
