<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Card;
use App\Models\User;
use App\Models\BoardUser;
use App\Models\LessonUpvotes;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function createBoardForm()
    {
      return view('boardCrud.createBoard');
    }

    public function storeBoard()
    {
      $this->validateBoard();
      $board = new Board(request(['name','madeby_id','description']));
      $board->save();
      $this->addBoardUsers($board->id, $board->madeby_id);
      return redirect('/home');
    }

    protected function validateBoard(){
      return request()->validate([
        'name' => ['required', 'min:1', 'max:20'],
        'madeby_id' => ['required'],
        'description' => ['required', 'min:1', 'max:50']
                                 ]);
    }

    public function addBoardUsers($board_id, $user_id)
    {
      $boardUsers = new BoardUser ();
      $boardUsers->board_id = $board_id;
      $boardUsers->user_id = $user_id;
      $boardUsers->save();
    }

    public function oneBoard(Board $board_id)
    {
      $lessonCard = array();
      $upvotes = LessonUpvotes::all();
      $cards = $board_id->cards;
      $lesCard = $board_id->lessoncards;
      // $helperId = User::where("id", $cards["helper_id"])->get();

      for($i =0; $i < count($lesCard); $i++) {
        $lessonCard[$i]['id'] = $lesCard[$i]['id'];
        $lessonCard[$i]['name'] = $lesCard[$i]['name'];
        $lessonCard[$i]['user_id'] = $lesCard[$i]['user_id'];
        $lessonCard[$i]['board_id'] = $lesCard[$i]['board_id'];
        $lessonCard[$i]['description'] = $lesCard[$i]['description'];
        $lessonCard[$i]['status'] = $lesCard[$i]['status'];
        $lessonCard[$i]['start_time'] = $lesCard[$i]['start_time'];
        $lessonCard[$i]['finished_date'] = $lesCard[$i]['finished_date'];
        $upVotes = LessonUpvotes::where("card_id", $lesCard[$i]['id'])->get();
        $countUpVotes = count($upVotes);
        $lessonCard[$i]['upvotes'] = $countUpVotes;
      }
      
      $lessonCards = collect($lessonCard)->sortBy('upvotes')->reverse()->toArray();

    

      return view('boardCrud.oneBoard', ['cards'=>$cards, 'thisBoard'=>$board_id, 'lessonCards'=>$lessonCards]);
    }

    public function addStudentsToBoard($board_id)
    {
      return view('boardCrud.addStudentsToBoard' , ['board_id'=>$board_id]);
    }

    public function searchStudents($input, $board_id)
    {
      $search = User::where('name','LIKE', '%' .$input.'%')->get();
      
      return response()->json($search);
    }

  public function addToBoard($board_id, $user_id)
  {  
    {
      BoardUser::updateOrCreate(
        [
            "board_id" => $board_id,
            "user_id" => $user_id
        ]
        );
    }

    return redirect('/home');        
  }

  public function viewUsersFromBoard($board_id){
    $user_ids = BoardUser::where('board_id', $board_id)->get('user_id');
    $users = [];
    for ($i=0; $i < count($user_ids); $i++) { 
      $user = User::where('id', $user_ids[$i]['user_id'])->get();
      array_push($users, $user[0]);
    }
  
    return view('boardCrud.allUsersFromBoard', ['allUsers' => $users]);
  }

  public function viewUserPage($user_id){
      $userProfile = User::where('id', $user_id)->get();
      return view('boardCrud.userProfilePage', ['profileInfo' => $userProfile]);
  }

}