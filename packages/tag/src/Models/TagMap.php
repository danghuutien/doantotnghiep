<?php

namespace Sudo\Tag\Models;

use Sudo\Base\Models\BaseModel;

class TagMap extends BaseModel
{
	public function tag() {
		return $this->hasOne('Sudo\Tag\Models\Tag', 'id', 'tag_id');
	}
}
