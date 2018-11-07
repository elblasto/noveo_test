<?php

namespace App\Http\Controllers;

use App\Exceptions\NoveoException;
use App\Http\Requests\StoreUser;
use App\Managers\UserManager;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

/**
 * Class GroupController
 **/
class UserController extends Controller
{

    private $userManager;

    /**
     * UserController constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return View
     */
    public function listAction(): View
    {
        $list = User::all();

        return view('user.list', [
            'list' => $list,
        ]);
    }

    /**
     *
     * @return View
     */
    public function createAction(): View
    {
        return view('user.create');
    }

    /**
     * @param User $user
     *
     * @return View
     */
    public function editAction(User $user): View
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * @param StoreUser $request
     * @param null      $user
     *
     * @return RedirectResponse
     */
    public function storeAction(StoreUser $request, $user = null): RedirectResponse
    {
        $validData = $request->validated();

        try {
            $this->userManager->storeUser($user, $validData);

            return redirect()->route('users::list');
        } catch (NoveoException $e) {
            return redirect()->back()->withErrors(['message' => 'Server error']);
        }
    }
}
