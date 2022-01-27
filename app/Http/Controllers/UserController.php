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
        return view('admin/change-user-roles', compact('users'));
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
            'user_role' => 'required'
        ]);

        User::where('id', $id)
            ->update([
                'user_role' => $request->input('user_role')
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
    public function searchAdminPage()
    {
        $search_text = $_GET['query'];
        $search = User::where('name','LIKE', '%' .$search_text.'%')->get();
        return view('admin.search-user', ['search'=>$search]);   
    }
    /**
     * teacher dashboard page
     */
    public function teacherDashboard()
    {
        //$cards = Card::all();
        $cards = Card::all()->where('status', 'finished')->where("helper_id", auth()->id());
        return view('teacherDashboard.index', compact('cards'));
    }

}
