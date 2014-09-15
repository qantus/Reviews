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
 * @date 27/08/14.08.2014 14:47
 */

namespace Modules\Reviews\Models;


use Mindy\Orm\Fields\BooleanField;
use Mindy\Orm\Fields\CharField;
use Mindy\Orm\Fields\DateTimeField;
use Mindy\Orm\Fields\EmailField;
use Mindy\Orm\Fields\ForeignField;
use Mindy\Orm\Fields\TextField;
use Mindy\Orm\Model;
use Modules\Reviews\ReviewsModule;
use Modules\User\Models\User;
use Mindy\Base\Mindy;

/**
 * Class Review
 * @package Modules\Reviews
 * @method static \Modules\Reviews\Models\ReviewManager objects($instance = null)
 */
class Review extends Model
{
    public static function getFields()
    {
        return [
            'name' => [
                'class' => CharField::className(),
                'null' => true,
                'verboseName' => ReviewsModule::t('Name')
            ],
            'email' => [
                'class' => EmailField::className(),
                'null' => true,
                'verboseName' => ReviewsModule::t('Email')
            ],
            'content' => [
                'class' => TextField::className(),
                'verboseName' => ReviewsModule::t('Content')
            ],
            'user' => [
                'class' => ForeignField::className(),
                'modelClass' => User::className(),
                'null' => true,
                'verboseName' => ReviewsModule::t('User')
            ],
            'is_published' => [
                'class' => BooleanField::className(),
                'default' => false,
                'verboseName' => ReviewsModule::t('Is published')
            ],
            'created_at' => [
                'class' => DateTimeField::className(),
                'autoNowAdd' => true,
                'verboseName' => ReviewsModule::t('Created time')
            ],
            'updated_at' => [
                'class' => DateTimeField::className(),
                'autoNow' => true,
                'verboseName' => ReviewsModule::t('Updated time')
            ],
            'published_at' => [
                'class' => DateTimeField::className(),
                'null' => true,
                'verboseName' => ReviewsModule::t('Published time')
            ],
        ];
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    public static function objectsManager($instance = null)
    {
        $className = get_called_class();
        return new ReviewManager($instance ? $instance : new $className);
    }
}
