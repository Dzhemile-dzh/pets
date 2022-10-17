<?php

declare(strict_types=1);

namespace Controllers\Horses;

use Api\Result\NapsTableForm\RecentForm;
use Controllers\Basic;
use Bo\NapsTable\RecentForm as Bo;
use Api\Input\Request\Horses\NapsTableForm\RecentForm as Request;
use Exception;

/**
 * Class NapsTableForm
 *
 * @package Controllers\Horses
 */
class NapsTableForm extends Basic
{
    /**
     * @param Request $request
     *
     * @throws Exception
     */
    public function actionGetNapsTableForm(Request $request)
    {
        $recentForm = new Bo($request);
        $recentForm->resetRequest($request);

        $result = (new RecentForm())
            ->setData(
                (Object)[
                    'naps_table_form' => $recentForm->getNapsTableForm()
                ]
            );

        $this->setResult($result);
    }
}
