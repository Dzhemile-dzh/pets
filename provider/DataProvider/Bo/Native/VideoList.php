<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native;

use Api\DataProvider\HorsesDataProvider;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Row;

/**
 * @package Api\DataProvider\Bo\Native
 */
class VideoList extends HorsesDataProvider
{
    /**
     *
     * @return array
     */
    public function getVideo(): array
    {

        $storiesDB = $this->getDI()->get('selectors')->getDb()->getStoriesDb();
        $builder = new Builder();

        $builder->setSqlTemplate("
                SELECT DISTINCT top 15
                    md.headline,
                    md.description,
                    md.thumbnail_location,
                    ml.media_link_url,
                    ml.media_link_url as guid,
                    md.release_on
                FROM {$storiesDB}..media md
                LEFT JOIN {$storiesDB}..media_link ml ON md.media_uid = ml.media_uid
                LEFT JOIN {$storiesDB}..media_publications mp ON mp.media_uid = md.media_uid
                LEFT JOIN {$storiesDB}..publication p ON mp.publication_uid = p.publication_uid
                    WHERE md.release_on <= getdate()
                     AND md.expire_on >= getdate()
                    AND media_link_url IS NOT NULL
                    AND md.media_category_uid = 2
                    AND md.media_subcategory_uid NOT IN (43, 3, 30)
                    AND (p.publication_uid NOT IN (7, 8, 10, 31) OR p.publication_uid IS NULL)
                    AND (p.is_active = 'Y' OR p.is_active IS NULL) 
                    ORDER BY md.release_on DESC
        ");

        $rtn =  $this->queryBuilder($builder);

        return $rtn->toArrayWithRows();
    }

    public function getDate(): Row
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                SELECT GETDATE() AS last_build_date
        ");

        $rtn =  $this->queryBuilder($builder);

        return $rtn->getFirst();
    }
}
