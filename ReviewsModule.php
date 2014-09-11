<?php

namespace Modules\Reviews;

use Mindy\Base\Module;

class ReviewsModule extends Module
{
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
