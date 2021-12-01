<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    /**
     * Shows the change user role page
     *
     */
    public function changeUserRolesPage()
    {
        $users = User::all();
        return view('admin/changeuserroles', compact('users'));
    }


    /**
     * shows the change user role form page, where you can change user roles
     *
     * @param [int] $id = id of user which the role is going to be changed
     */
    public function changeUserFormPage($id)
    {
        return view('admin/changeuserform')->with('user', User::where('id', $id)->first());
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
        return view('admin/destroyuserpage')->with('user', User::where('id', $id)->first());
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


}
