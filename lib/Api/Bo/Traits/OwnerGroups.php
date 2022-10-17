<?php

namespace Api\Bo\Traits;

use \Api\Constants\Horses as Constants;

trait OwnerGroups
{
    /**
     * This trait has the intent to loop an array and add owner_group_uid to a horse.
     * The result will be displayed as an array with integers.
     *
     * @param $runners
     * @param $ownerGroups
     * @return array|null
     */
    public function addOwnerGroupsUids(&$runners, $ownerGroups)
    {
        $coolmoreOwnerGroupMap = array_flip(Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS);

        foreach ($runners as $runner) {
            $groups = [];

            if (isset($ownerGroups[$runner->horse_uid])) {
                foreach ($ownerGroups[$runner->horse_uid] as $horse) {
                    // According to business logic we need to set owner_group_uid to a value dependant on to_follow_uid
                    if (isset($horse->to_follow_uid) && is_null($horse->owner_group_uid)) {
                        $groups[] = $coolmoreOwnerGroupMap[$horse->to_follow_uid];
                    } else {
                        $groups[] = $horse->owner_group_uid;
                    }
                }
            }
            $runner->owner_group_uid = !empty($groups) ? $groups : null;
        }
    }
}
