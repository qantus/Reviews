<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Falaleev Maxim
 * @email max@studio107.ru
 * @version 1.0
 * @company Studio107
 * @site http://studio107.ru
 * @date 27/08/14.08.2014 14:56
 */

namespace Modules\Reviews\Forms;

use Mindy\Base\Mindy;
use Mindy\Form\ModelForm;

class ReviewUserForm extends ModelForm
{
    public $exclude = [
        'is_published',
        'published_at',
        'user'
    ];

    public function getModel()
    {
        return Mindy::app()->getModule('reviews')->modelClass;
    }

    public function send()
    {
        return Mindy::app()->mail->fromCode('reviews.send', $this->cleanedData['email'], [
            'data' => $this->cleanedData
        ]);
    }
}
