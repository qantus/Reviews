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
 * @date 27/08/14.08.2014 14:50
 */

namespace Modules\Reviews\Controllers;

use Mindy\Base\Mindy;
use Mindy\Helper\Json;
use Modules\Reviews\Helpers\ReviewsHelper;
use Modules\Core\Controllers\CoreController;

class ReviewController extends CoreController
{
    public function getForm()
    {
        return $this->getModule()->formClass;
    }

    public function actionIndex()
    {
        $formClass = $this->getForm();
        $form = new $formClass;
        $request = Mindy::app()->request;
        $this->addBreadcrumb('Отзывы');

        $this->ajaxValidation($form);
        if($request->isPost && $form->setAttributes($_POST)->isValid() && $form->save() && $form->send()) {
            if ($request->isAjax) {
                echo $this->render('reviews/success.html');
                Mindy::app()->end();
            }else{
                Mindy::app()->flash->success("Отзыв успешно отправлен");
                $this->refresh();
            }
        }

        $reviews = ReviewsHelper::getReviews(true, $form);
        echo $this->render('reviews/index.html', [
            'reviews' => $reviews
        ]);
    }

    public function actionView($pk = null)
    {
        $modelClass = $this->getModule()->modelClass;
        $model = $modelClass::objects()->filter(['pk' => $pk])->get();
        if (!$model) {
            $this->error(404);
        }
        echo $this->render('reviews/view.html', [
            'model' => $model
        ]);
    }

    public function ajaxValidation($form)
    {
        if($this->r->isPost && isset($_POST['ajax_validation'])) {
            $form->setAttributes($_POST)->isValid();
            echo Json::encode($form->getErrors());
            Mindy::app()->end();
        }
    }
}
