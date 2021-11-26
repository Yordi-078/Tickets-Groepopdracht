<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function changeUserRolesPage()
    {
        $users = User::all();
        return view('admin/changeuserroles', compact('users'));
    }
    public function changeUserFormPage($id)
    {
        return view('admin/changeuserform')->with('user', User::where('id', $id)->first());
    }
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
    public function destroyUserPage($id)
    {
        return view('admin/destroyuserpage')->with('user', User::where('id', $id)->first());
    }
    
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
