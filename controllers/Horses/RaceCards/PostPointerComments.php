<?php

namespace Controllers\Horses\RaceCards;

use Bo\RaceCards as Bo;
use Controllers\Horses\RaceCards;
use \Api\Exception\NotFound as NotFoundException;
use Api\Result\RaceCards\PostPointerComments as Result;
use Api\Input\Request\Horses\RaceCards\PostPointerComments as Request;

/**
 * Class PostPointerComments
 *
 * @package Controllers\Horses\RaceCards
 */
class PostPointerComments extends RaceCards
{
    /**
     * @param Request $request
     *
     * @throws NotFoundException
     */
    public function actionGetPostPointerComments(Request $request)
    {
        $raceCards = new Bo($request);
        $result = new Result();
        $results = $raceCards->getComments();

        if (empty($results->comments) && !$results->isCommentsAvailable) {
            throw new NotFoundException(26);
        } else {
            $result->setEmptyResultException(new NotFoundException(5));
        }

        $result->setData(['post_pointer_comments' => $results->comments]);

        $this->setResult($result);
    }
}
