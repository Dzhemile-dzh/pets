<?php

namespace Controllers\Horses\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\Sales as Request;
use Api\Result\Bloodstock\Sales as Result;
use Bo\Bloodstock as Bo;
use Api\Result\Bloodstock\Sales\SalesCompaniesList;
use Api\SharedConstants;
use RP\ContentAttributes\Element\Tags;

/**
 * Class Sales
 *
 * @package Controllers\Horses\Bloodstock
 */
class Sales extends \Controllers\Basic
{
    /**
     * @param Request\UpcomingSales $request
     *
     * @throws \Exception
     */
    public function actionGetUpcomingSales(Request\UpcomingSales $request)
    {
        $bo = new Bo\Sales($request);

        $result = (new Result\UpcomingSales())
            ->setData(
                (Object)[
                    'upcoming_sales' => $bo->getUpcomingSales($request),
                ]
            );
        $this->setResult($result);
        if ($request->isParameterSet('regId')) {
            $this->storeRedisKey($request->getRegId());
        }
    }

    /**
     * @param Request\SalesResults $request
     *
     * @throws \Exception
     */
    public function actionGetSalesResults(Request\SalesResults $request)
    {
        $bo = new Bo\Sales($request);

        $result = (new Result\SalesResults())
            ->setData(
                (Object)[
                    'sales_results' => $bo->getSalesResults($request)
                ]
            );
        $this->setResult($result);
        if ($request->isParameterSet('regId')) {
            $this->storeRedisKey($request->getRegId());
        }
    }

    /**
     * @param Request\Catalogue $request
     *
     * @throws \Exception
     */
    public function actionGetCatalogue(Request\Catalogue $request)
    {
        $bo = new Bo\Sales($request);

        $result = new Result\Catalogue();
        $result->setData((Object)[
            'catalogue' => $bo->getCatalogue()
        ]);

        $this->setResult($result);
    }

    /**
     * @param Request\CatalogueSires $request
     *
     * @throws \Exception
     */
    public function actionGetCatalogueSires(Request\CatalogueSires $request)
    {
        $bo = new Bo\Sales($request);

        $result = (new Result\Catalogue\Sires())
            ->setData(
                (Object)[
                    'catalogue' => $bo->getCatalogueSires($request)
                ]
            );
        $this->setResult($result);
    }

    /**
     * @param Request\CatalogueVendors $request
     *
     * @throws \Exception
     */
    public function actionGetCatalogueVendors(Request\CatalogueVendors $request)
    {
        $bo = new Bo\Sales($request);

        $result = (new Result\Catalogue\Vendors())
            ->setData((Object)[
                'vendors' => $bo->getVendors()
            ]);
        $this->setResult($result);
    }

    /**
     * @param Request\CataloguePreviouslySold $request
     */
    public function actionGetCataloguePreviouslySold(Request\CataloguePreviouslySold $request)
    {
        $bo = new Bo\Sales($request);

        $result = new Result\PreviouslySold();
        $result->setData((Object)[
            'previously-sold' => $bo->getPreviouslySold()
        ]);

        $this->setResult($result);
    }

    /**
     * @param Request\UpcomingNames $request
     *
     * @throws \Exception
     */
    public function actionGetUpcomingNames(Request\UpcomingNames $request)
    {
        $bo = new Bo\Sales($request);

        $result = new Result\UpcomingNames();
        $result->setData((Object)[
            'upcoming_names' => $bo->getUpcomingNames($request)
        ]);

        $this->setResult($result);
    }

    /**
     * @param Request\CompanyNames $request
     *
     * @throws \Exception
     */
    public function actionGetCompanyNames(Request\CompanyNames $request)
    {
        $bo = new \Bo\Bloodstock\Sales($request);

        $result = new SalesCompaniesList();
        $result->setData((Object)[
            'company_names' => $bo->getSalesCompaniesList($request)
        ]);

        $this->setResult($result);
    }

    /**
     * @param $regId
     */
    private function storeRedisKey($regId)
    {
        $contentAttributes = $this->getDI()->getShared('contentAttributes');
        $key = $contentAttributes->tags()->getUniqueKey();

        if ($key && $this->getDI()->has('redis')) {
            /** @var \Redis $redis */
            $redis = $this->getDI()->getShared('redis');
            $redis->hSet(
                sprintf(SharedConstants::UGC_CLEAR_CACHE_TEMPLATE, $regId, 'bloodstock-sales'),
                $key,
                time()
            );
        } else {
            $this->getDI()->getShared('logger')->warning('Service \'redis\' wasn\'t
             found in the dependency injection container');
        }
    }

    /**
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();
        $ca = $this->getContentAttributes();
        /** @var Tags $tags */
        $tags = $ca->tags();
        $tags->addSaleGroup();
    }
}
