<?php
namespace App\Managers;

use App\Exceptions\NoveoEmptyDataException;
use App\Exceptions\NoveoException;
use App\Models\Group;
use App\Models\User;

class GroupManager
{


    /**
     * @param Group|null $group
     * @param array $groupData
     *
     * @throws NoveoException
     */
    public function storeGroup($group, array $groupData): void
    {
        try {
            if (is_null($group)) {
                $group = new Group();
            }

            $group->fill($groupData);
            $group->save();
        } catch (\Exception $e) {
            throw new NoveoException($e->getMessage());
        }
    }

    /**
     * @param Group $group
     * @param array $usersData
     *
     * @throws NoveoException
     */
    public function storeGroupUsers(Group $group, array $usersData): void
    {
        try {
            $group->users()->sync($usersData);
        } catch (\Exception $e) {
            throw new NoveoException($e->getMessage());
        }
    }

}
