<?php

namespace Controllers\Horses\RaceCards;

use Bo\RaceCards as Bo;
use Controllers\Horses\RaceCards;
use Api\Result\RaceCards\PostPointerVerdict as Result;
use Api\Input\Request\Horses\RaceCards\PostPointerVerdict as Request;

/**
 * Class PostPointerVerdict
 *
 * @package Controllers\Horses\RaceCards
 */
class PostPointerVerdict extends RaceCards
{
    /**
     * @param Request $request
     */
    public function actionGetPostPointerVerdict(Request $request)
    {
        $raceCards = new Bo($request);
        $spotlightVerdictSelection = $raceCards->getSpotlightVerdictSelection($request->getRaceId());

        $result = new Result();
        $result->setData(
            [
                'post_pointer_verdict' => $raceCards->retrievePostPointerVerdict(),
                'spotlight_verdict_selection' => empty($spotlightVerdictSelection) ? null : $spotlightVerdictSelection,
            ]
        );

        $this->setResult($result);
    }
}
