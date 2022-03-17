<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    /**
     * Shows the change user role page
     *
     */
    public function changeUserRolesPage()
    {
        $users = User::all();
        return view('admin/change-user-roles',  ['users'=>$users]);
    }


    /**
     * shows the change user role form page, where you can change user roles
     *
     * @param [int] $id = id of user which the role is going to be changed
     */
    public function changeUserFormPage($id)
    {
        return view('admin/change-user-form')->with('user', User::where('id', $id)->first());
    }

    /**
     * Function to change user roles in database
     *
     * @param Request $request
     * @param [int] $id = id of user which the role will be changed
     */
    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'user_role_id' => 'required'
        ]);

        User::where('id', $id)
            ->update([
                'user_role_id' => $request->input('user_role_id')
            ]);
        return redirect()->route('changeUserRoles');
    }

    /**
     * Destroy's user confirmation page
     *
     * @param [int] $id = id of user which that will be deleted
     */
    public function destroyUserPage($id)
    {
        return view('admin/destroy-user-page')->with('user', User::where('id', $id)->first());
    }


    /**
     * Destroy's user from database with id
     *
     * @param Request $request
     * @param [int] $id = id of user which will be deleted
     */  
    public function destroyUser(Request $request, $id)
    {
        $user = User::where('id', $id);
        $user->delete();

        if ($id == auth()->id())
        {
            return redirect()->route('home');
        }
        else
        {
            return redirect()->route('changeUserRoles');
        }
    }

    /**
     * page where you see the search result
     *
     */
    public function fetchAllUsers()
    {
        $users = User::where('user_role_id', '!=' , 3)->get();

        return response()->json($users);
    }

    public function searchAdminPage()
    {
        $search_text = $_GET['query'];
        $search = User::where('name','LIKE', '%' .$search_text.'%')->get();
        return view('admin.search-user', ['search'=>$search]);   
    }

    public function searchUser($input)
    {
        $search = User::where('name','LIKE', '%' .$input.'%')->get();
        
        return response()->json($search);   
    }
    /**
     * teacher dashboard page
     */
    public function teacherDashboard(User $board_id)
    {
        $cards = Card::all()->where('status', 'finished')->where("helper_id", auth()->id())->sortBy('updated_at');
        return view('teacherDashboard.index', compact('cards', 'board_id'));
    }

}
