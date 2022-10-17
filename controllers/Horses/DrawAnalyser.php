<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 25.09.2014
 * Time: 12:01
 */

namespace Controllers\Horses;

class DrawAnalyser extends \Controllers\Basic
{
    /**
     * @param \Api\Input\Request\Horses\DrawAnalyser\Index $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetIndex(\Api\Input\Request\Horses\DrawAnalyser\Index $request)
    {
        $da = new \Bo\DrawAnalyser($request->getRaceId());

        if (empty($da->getRace())) {
            throw new \Api\Exception\NotFound(2102, $request->getRaceId());
        }
        if (empty($da->getRunners())) {
            throw new \Api\Exception\NotFound(2103, $request->getRaceId());
        }

        $result = (new \Api\Result\DrawAnalyser())
            ->setData(
                (Object)[
                    'race' => $da->getRace(),
                    'runners' => $da->getRunners()
                ]
            );

        $this->setResult($result);
    }
}
