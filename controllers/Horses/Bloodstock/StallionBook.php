<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 3/28/2016
 * Time: 4:40 PM
 */

namespace Controllers\Horses\Bloodstock;

class StallionBook extends \Controllers\Basic
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\StallionBook\Index $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetIndex(\Api\Input\Request\Horses\Bloodstock\StallionBook\Index $request)
    {
        $bo = new \Bo\Bloodstock\StallionBook($request);

        $result = (new \Api\Result\Bloodstock\StallionBook\SearchResult())
            ->setData(
                (Object)[
                    'stallion_book' => $bo->getSearchResult(),
                ]
            );
        $this->setResult($result);
    }

    public function actionGetNames(\Api\Input\Request\Horses\Bloodstock\StallionBook\Names $request)
    {
        $bo = new \Bo\Bloodstock\StallionBook($request);

        $names = $bo->getNames();

        $result = (new \Api\Result\Bloodstock\StallionBook\Names())
            ->setData(
                (Object)[
                    'names' => $names
                ]
            );
        $this->setResult($result);
    }
}
