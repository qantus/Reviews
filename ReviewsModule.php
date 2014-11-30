<?php

namespace Modules\Reviews;

use Mindy\Base\Module;

class ReviewsModule extends Module
{
    public $enableForm = true;
    public $modelClass = '\Modules\Reviews\Models\Review';
    public $formClass = '\Modules\Reviews\Forms\ReviewUserForm';
    public $formAdminClass = '\Modules\Reviews\Forms\ReviewAdminForm';

    public function getVersion()
    {
        return '1.0';
    }

    public function getMenu()
    {
        return [
            'name' => $this->getName(),
            'items' => [
                [
                    'name' => self::t('Reviews'),
                    'adminClass' => 'ReviewsAdmin'
                ]
            ]
        ];
    }
}
