<?php

namespace Modules\Reviews\Helpers;

class ReviewsHelper
{
    public static function getReviews($pager = true, $form = null)
    {
        if (!$form){
            $form = new \Modules\Reviews\Forms\ReviewUserForm();
        }
        if(!empty($_POST)) {
            $form->setAttributes($_POST);
        }
        $qs = \Modules\Reviews\Models\Review::objects()->published()->order(['-published_at']);
        if($pager) {
            $pager = new \Mindy\Pagination\Pagination($qs);
            return [
                'reviews' => $pager->paginate(),
                'pager' => $pager,
                'form' => $form
            ];
        } else {
            return [
                'reviews' => $qs->all(),
                'form' => $form
            ];
        }
    }
} 
