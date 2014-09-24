<?php

/**
 * All rights reserved.
 *
 * @author Falaleev Maxim
 * @email max@studio107.ru
 * @version 1.0
 * @company Studio107
 * @site http://studio107.ru
 * @date 03/07/14.07.2014 16:41
 */

namespace Modules\Reviews\Sitemap;

use Modules\Reviews\Models\Review;
use Modules\Reviews\ReviewsModule;
use Modules\Sitemap\Components\Sitemap;

class ReviewsSitemap extends Sitemap
{
    public function getModelClass()
    {
        return Review::className();
    }

    public function getQuerySet()
    {
        return $this->getModel()->objects()->published();
    }

    public function getLoc($data)
    {
        if(isset($data['reversed'])) {
            return $data['reversed'];
        }elseif(isset($data['id'])) {
            return $this->reverse('reviews.view', [$data['id']]);
        }
        return '';
    }

    public function generateHtml($data)
    {
        $level = 1;
        if (isset($data['root'])) {
            $level = 0;
        }
        return parent::generateHtml($data, $level);
    }

    public function getExtraItems()
    {
        return [
            [
                'root' => true,
                'name' => ReviewsModule::t('Reviews'),
                'reversed' => $this->reverse('reviews.send')
            ]
        ];
    }
}
