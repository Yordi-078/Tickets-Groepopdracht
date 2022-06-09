<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Card;
use App\Models\LessonCard;
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
    /**
     * search a user will a inputted string in the admin page
     */
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
     * teacher dashboard page shows the cards of the current date
     * 
     * @param [int] $board_id = id of current board
     */
    public function teacherDashboard(User $board_id )
    {
        $selectedDate = false;
        $cards = Card::where('status', 'finished')->where("helper_id", auth()->id())->get()->sortBy('updated_at');
        $lessonCards = LessonCard::where('status', 'finished')->where('user_id', auth()->id())->get();
        return view('teacherDashboard.index', compact('cards', 'board_id', 'selectedDate', 'lessonCards'));
    }

    /**
     * teacher dashboard page when a date is selected in the calendar
     *
     * @param [int] $board_id  = id of current board
     * @param [string] $selectedDate = the date selected in the calendar
     */
    public function dateSelected($board_id, $selectedDate)
    {
        $cards = Card::where('status', 'finished')->where("helper_id", auth()->id())->get()->sortBy('updated_at');
        $lessonCards = LessonCard::where('status', 'finished')->where('user_id', auth()->id())->get();
        return view('teacherDashboard.index', compact('cards', 'board_id', 'selectedDate', 'lessonCards'));
    }

    public function dateCreator(Request $request, $board_id){
        $par2 = $request->input('datepicker');
        return redirect()->route('dateSelected', [$board_id, $par2]);
    }

    public function editUserProfile(){
        $user = User::where('id', auth()->id())->get();
        return view('auth.edit', compact('user'));
    }

    public function updateUserImage($image_id){
        User::where('id', auth()->id())
            ->update([
                'image' => $image_id
            ]);
    }
    public function getUserImage(){
        $image = User::where('id', auth()->id())->get();
        return response()->json($image);
    }
}
