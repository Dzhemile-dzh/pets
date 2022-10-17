<?php

namespace Api\DataProvider\Bo\RaceCards;

use Api\DataProvider\HorsesDataProvider;
use Phalcon\Db\Sql\Builder;
use Api\Input\Request\Horses\RaceCards\GlobalComments as Request;

/**
 * @package Api\DataProvider\Bo\RaceCards
 */
class GlobalComments extends HorsesDataProvider
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function getData(Request $request)
    {
        $builder = new Builder($request);
        $builder->setSqlTemplate(
            "
            SELECT 
                h.horse_uid,
                h.style_name horse_name,
                rhc.comment_language,
                rhc.comment_text
            FROM 
                rp_horse_race_comments rhrc 
            INNER JOIN rp_horse_comments rhc 
                ON rhc.comment_uid = rhrc.comment_uid
            INNER JOIN horse h 
                ON h.horse_uid = rhrc.horse_uid
            WHERE 
              rhrc.race_instance_uid = :raceId
              /*{WHERE}*/
            "
        );

        if ($request->isParameterProvided('commentLanguage')) {
            $builder->where(" rhc.comment_language = :commentLanguage");
        }

        if ($request->isParameterProvided('horseId')) {
            $builder->where("rhrc.horse_uid = :horseId");
        }

        $res = $this->queryBuilder($builder);
        $rtn = $res->getGroupedResult(
            [
                'horse_uid',
                'horse_name',
                'comments' => [
                    'comment_language',
                    'comment_text'
                ],
            ]
        );

        // We need to decode some comments due to the characters that the comment can contain, currently only (French Characters)
        if (!empty($rtn)) {
            foreach ($rtn as $item) {
                if (!empty($item->comments)) {
                    foreach ($item->comments as $comment) {
                        if ($comment->comment_language == 'FRA' || $comment->comment_language == 'GER') {
                            $comment->comment_text = utf8_decode($comment->comment_text);
                        }
                    }
                }
            }
        }
        return $rtn;
    }
}
