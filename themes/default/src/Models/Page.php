<?php

namespace Sudo\Theme\Models;

class Page extends BaseModel
{

    public function getUrl() {
    	return route('app.pages.show', $this->slug);
    }

}