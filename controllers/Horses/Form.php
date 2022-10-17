<?php

declare(strict_types=1);

namespace Controllers\Horses;
use Controllers\Basic;
use Api\Input\Request\Horses\Form as Request;

/**
 * Class Form
 * @package Controllers\Horses
 */
class Form extends Basic
{


    /**
     * @param Request $request
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $racesLimit = $request->getNumberOfRaces();
        $bo = new \Bo\Form($request);

        $form = $bo->getForm($racesLimit);

        $result = new \Api\Result\Form();

        $result->setData(
            [
                'results' => $form
            ]
        );

        $this->setResult($result);
    }
}
