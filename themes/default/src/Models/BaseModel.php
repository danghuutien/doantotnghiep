<?php

namespace Sudo\Theme\Models;

use Sudo\Base\Models\BaseModel as CoreModel;

class BaseModel extends CoreModel
{
    public function language_metas() {
    	$table_name = BaseModel::getTable();
		return $this->hasOne('Sudo\Base\Models\LanguageMeta', 'lang_table_id', 'id')->where('lang_table', $table_name);
	}
}