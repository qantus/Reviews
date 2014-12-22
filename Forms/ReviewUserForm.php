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
use Mindy\Form\Fields\CharField;
use Mindy\Form\Fields\EmailField;
use Mindy\Form\Fields\TextField;
use Mindy\Form\ModelForm;
use Modules\Core\Components\ParamsHelper;
use Modules\Reviews\ReviewsModule;

class ReviewUserForm extends ModelForm
{
    public $exclude = [
        'is_published',
        'published_at',
        'user'
    ];

    public function getModel()
    {
        $cls = Mindy::app()->getModule('Reviews')->modelClass;
        return new $cls;
    }

    public function getFields()
    {
        return [
            'email' => [
                'class' => EmailField::className(),
                'label' => ReviewsModule::t('Email'),
                'required' => true,
                'html' => [
                    'placeholder' => ReviewsModule::t('Email')
                ]
            ],
            'name' => [
                'class' => CharField::className(),
                'label' => ReviewsModule::t('Name'),
                'required' => true,
                'html' => [
                    'placeholder' => ReviewsModule::t('Name')
                ]
            ],
            'content' => [
                'class' => TextField::className(),
                'html' => [
                    'placeholder' => ReviewsModule::t('Content')
                ]
            ]
        ];
    }

    public function save()
    {
        $status = parent::save();
        if ($status) {
            Mindy::app()->mail->fromCode('reviews.new_review', Mindy::app()->managers, [
                'model' => $this->getInstance()
            ]);
        }
        return $status;
    }
}
