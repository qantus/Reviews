<?php

namespace Modules\Reviews\Admin;

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
        return ReviewAdminForm::className();
    }

    public function getModel()
    {
        return new Review;
    }
}

