<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/2/2016
 * Time: 5:54 PM
 */

namespace Controllers\Horses\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\SalesStatistics as Request;
use Bo\Bloodstock\SalesStatistics as Bo;
use Api\Result\Bloodstock\SalesStatistics as Result;
use RP\ContentAttributes\Element\Tags;

class SalesStatistics extends \Controllers\Basic
{
    public function actionGetSales(Request\Sales $request)
    {
        $bo = new \Bo\Bloodstock\SalesStatistics\Sales($request);

        $result = (new \Api\Result\Bloodstock\SalesStatistics\Sales())
            ->setData(
                (Object)[
                    'sales' => $bo->prepareRows($bo->getRows()),
                ]
            );

        $this->setResult($result);
    }

    public function actionGetSires(Request\Sires $request)
    {
        $bo = new Bo\Sires($request);

        $result = (new Result\Sires())->setData($bo->prepareRows($bo->getRows()));
        $this->setResult($result);
    }

    public function actionGetBuyers(Request\Buyers $request)
    {
        $bo = new Bo\Buyers($request);

        $result = (new Result\Buyers())
            ->setData(
                (Object)[
                    'buyers' => $bo->prepareRows($bo->getRows()),
                ]
            );
        $this->setResult($result);
    }

    public function actionGetVendors(Request\Vendors $request)
    {
        $bo = new Bo\Vendors($request);

        $result = (new Result\Vendors())
            ->setData(
                (Object)[
                    'vendors' => $bo->prepareRows($bo->getRows()),
                ]
            );
        $this->setResult($result);
    }

    public function initialize()
    {
        parent::initialize();
        $ca = $this->getContentAttributes();
        /** @var Tags $tags */
        $tags = $ca->tags();
        $tags->addSaleGroup();
        $tags->addStatisticsGroup();
    }
}
