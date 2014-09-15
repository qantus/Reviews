<?php

namespace Modules\Reviews\Admin;

use Mindy\Base\Mindy;
use Modules\Admin\Components\ModelAdmin;
use Modules\Reviews\Forms\ReviewAdminForm;
use Modules\Reviews\Models\Review;

class ReviewsAdmin extends ModelAdmin
{
    public function getColumns()
    {
        return ['id', 'name', 'email', 'published_at'];
    }

    public function getCreateForm()
    {
        return $this->getModule()->formAdminClass;
    }

    public function getModel()
    {
        $modelClass = $this->getModule()->modelClass;
        return new $modelClass();
    }

    public function getModule()
    {
        return Mindy::app()->getModule('reviews');
    }
}

