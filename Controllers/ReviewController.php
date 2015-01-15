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
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Reviews\ReviewsModule;

class ReviewController extends CoreController
{
    public function actionIndex()
    {
        $module = Mindy::app()->getModule('Reviews');

        $formClass = $module->formClass;
        $form = new $formClass;
        $request = $this->getRequest();
        $this->addBreadcrumb(ReviewsModule::t('Reviews'));

        $this->ajaxValidation($form);

        if ($request->isPost && $form->populate($_POST)->isValid() && $form->save()) {
            if ($request->isAjax) {
                echo $this->render('reviews/success.html');
                Mindy::app()->end();
            } else {
                $request->flash->success(ReviewsModule::t('Review sucessfully sended'));
                $request->refresh();
            }
        }

        $modelClass = $module->modelClass;
        $model = new $modelClass;
        $pager = new Pagination($model->objects()->published()->order(['-published_at']));
        echo $this->render('reviews/index.html', [
            'pager' => $pager,
            'reviews' => $pager->paginate(),
            'form' => $form,
            'enableForm' => $this->getModule()->enableForm
        ]);
    }

    public function actionView($pk)
    {
        $modelClass = $this->getModule()->modelClass;
        $model = $modelClass::objects()->filter(['pk' => $pk])->get();
        if (!$model) {
            $this->error(404);
        }

        $this->addBreadcrumb(ReviewsModule::t('Reviews'), Mindy::app()->urlManager->reverse('reviews.send'));
        $this->addBreadcrumb($model->name);

        echo $this->render('reviews/view.html', [
            'model' => $model
        ]);
    }

    public function ajaxValidation($form)
    {
        if ($this->r->isPost && isset($_POST['ajax_validation'])) {
            $form->populate($_POST)->isValid();
            echo Json::encode($form->getErrors());
            Mindy::app()->end();
        }
    }
}
