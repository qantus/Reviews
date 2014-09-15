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
        $request = Mindy::app()->request;
        if($request->getIsPostRequest()) {
            $form = new $formClass;

            if($form->setAttributes($_POST)->isValid() && $form->save()) {
                $form->send();
                $success = true;
            } else {
                $success = false;
            }

            $this->redirectNext();

            echo $this->json([
                'success' => $success
            ]);
        } else {
            $this->redirectNext();

            $this->error(400);
        }
    }
}
