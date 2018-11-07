<?php

namespace App\Http\Controllers;

use App\Exceptions\NoveoException;
use App\Http\Requests\StoreGroup;
use App\Managers\GroupManager;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

/**
 * Class GroupController
 **/
class GroupController extends Controller
{

    private $groupManager;

    /**
     * GroupController constructor.
     * @param GroupManager $groupManager
     */
    public function __construct(GroupManager $groupManager)
    {
        $this->groupManager = $groupManager;
    }

    /**
     * @return View
     */
    public function listAction(): View
    {
        $list = Group::all();

        return view('group.list', [
            'list' => $list,
        ]);
    }


    /**
     * @param Group $group
     *
     * @return View
     */
    public function usersListAction(Group $group): View
    {
        $usersList = $group->users();

        return view('group.users_list', [
            'usersList' => $usersList,
        ]);
    }

    /**
     * @param Group $group
     *
     * @return View
     */
    public function usersListStoreAction(Request $request, Group $group): View
    {
        try {
            $userData = $request->get('users', []);
            $this->groupManager->storeGroupUsers($group, $userData);

            return redirect()->route('groups::list');
        } catch (NoveoException $e) {
            return redirect()->back()->withErrors(['message' => 'Server error']);
        }
    }


    /**
     *
     * @return View
     */
    public function createAction(): View
    {
        return view('group.create');
    }

    /**
     * @param Group $group
     *
     * @return View
     */
    public function editAction(Group $group): View
    {
        return view('group.edit', [
            'group' => $group,
        ]);
    }

    /**
     * @param StoreGroup $request
     * @param Group|null $group
     *
     * @return RedirectResponse
     */
    public function storeAction(StoreGroup $request, Group $group = null): RedirectResponse
    {
        $validData = $request->validated();

        try {
            $this->groupManager->storeGroup($group, $validData);

            return redirect()->route('groups::list');
        } catch (NoveoException $e) {
            return redirect()->back()->withErrors(['message' => 'Server error']);
        }
    }
}
