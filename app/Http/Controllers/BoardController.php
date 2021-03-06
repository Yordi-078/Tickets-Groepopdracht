<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Card;
use App\Models\User;
use App\Models\Tags;
use App\Models\CardTags;
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
        'name' => ['required', 'min:1', 'max:40'],
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
      $allCardTags = [];
      foreach ($cards as $card) {
        $cardTags = [];
        $tags = CardTags::where('card_id', $card['id'])->get();
        for ($i=0; $i < count($tags); $i++) { 
            $cardTag = Tags::where('id', $tags[$i]['tag_id'])->get();
            array_push($cardTags, $cardTag[0]);
        }
        array_push($allCardTags, $cardTags);
      }
      // dd($allCardTags);
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

    

      return view('boardCrud.oneBoard', ['cards'=>$cards, 'cardTags' =>$allCardTags, 'thisBoard'=>$board_id, 'lessonCards'=>$lessonCards]);
    }

    public function addStudentsToBoard($board_id)
    {
      return view('boardCrud.addStudentsToBoard' , ['board_id'=>$board_id]);
    }

    public function searchStudents($input, $board_id)
    {
      $search = User::where('name','LIKE', '%' .$input.'%')->where('user_role_id', '!=' , 3)->get();
      
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
      if($user[0]['user_role_id'] != 3){
        array_push($users, $user[0]);
      }
    }
    return response()->json($users);
  }

  public function allBoardUsers($board_id){
    
    return view('boardCrud.allUsersFromBoard');
  }

  public function viewUserPage($user_id){
      $userProfile = User::where('id', $user_id)->get();
      return view('boardCrud.userProfilePage', ['profileInfo' => $userProfile]);
  }

  public function addTagsForm($board_id){
    return view('boardCrud.createTags' , ['board_id'=>$board_id]);
  }

  public function storeTag(Request $request, Board $board_id){
    $cards = $board_id->cards;
    $lessonCards = $board_id->lessoncards;

    Tags::updateOrCreate(
      [
          "name" => $request->name,
          "board_id" => $board_id->id
      ]
      );

      $allCardTags = [];
      foreach ($cards as $card) {
        $cardTags = [];
        $tags = CardTags::where('card_id', $card['id'])->get();
        for ($i=0; $i < count($tags); $i++) { 
            $cardTag = Tags::where('id', $tags[$i]['tag_id'])->get();
            array_push($cardTags, $cardTag[0]);
        }
        array_push($allCardTags, $cardTags);
      }
      return view('boardCrud.oneBoard', ['cards'=>$cards, 'cardTags' =>$allCardTags, 'thisBoard'=>$board_id, 'lessonCards'=>$lessonCards]);

  }

}