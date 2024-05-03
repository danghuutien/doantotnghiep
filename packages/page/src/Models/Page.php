<?php

namespace Sudo\Page\Models;

use Sudo\Base\Models\BaseModel;

class Page extends BaseModel {
	/**
     * 
     */
    public function getUrl() {
        // return route('app.pages.show', $this->slug);
        return route('app.handle', $this->slug);
    }
}
