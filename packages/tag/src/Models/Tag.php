<?php

namespace Sudo\Tag\Models;

use Sudo\Base\Models\BaseModel;

class Tag extends BaseModel
{
	public function getUrl()
    {
        return route('app.tags.show', $this->slug);
    }
    public function tagMap() {
		return $this->hasMany('Sudo\Tag\Models\TagMap', 'tag_id', 'id');
	}
}
