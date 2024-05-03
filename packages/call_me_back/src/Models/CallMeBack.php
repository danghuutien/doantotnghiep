<?php

namespace Sudo\CallMeBack\Models;

use Sudo\Base\Models\BaseModel;

class CallMeBack extends BaseModel
{
    protected $fillable = ['phone', 'name', 'current_page', 'active_status'];
}
