<?php
namespace App\Managers;

use App\Exceptions\NoveoEmptyDataException;
use App\Exceptions\NoveoException;
use App\Models\User;

/**
 * Пользователи.
 *
 * @property $id             Id
 * @property $name           Name
 * @property $last_name      Last name
 * @property $email          Email
 * @property $status         Status
 * @property $created_at     Created at
 * @property $updated_at     Updated at
 */
class UserManager
{


    /**
     * @param User|null $user
     * @param array $userData
     *
     * @throws NoveoException
     */
    public function storeUser($user, array $userData): void
    {
        try {
            if (is_null($user)) {
                $user = new User();
            }

            $user->fill($userData);

            if ($user->save()) {
                $user->groups()->sync($userData['groups']);
            }
        } catch (\Exception $e) {
            throw new NoveoException($e->getMessage());
        }
    }

    /**
     * @param int $userId
     *
     * @return bool
     *
     * @throws NoveoException
     */
    public function checkUserStatus(int $userId): bool
    {
        try {
            $user = User::findOrFail($userId);

            return $user->status;
        } catch (\Exception $e) {
            throw new NoveoException($e->getMessage());
        }
    }
}
