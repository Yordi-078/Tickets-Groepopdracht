<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Card;
use App\Models\User;
use App\Models\Board_users;
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
      $boardUsers = new Board_users ();
      $boardUsers->board_id = $board_id;
      $boardUsers->user_id = $user_id;
      $boardUsers->save();
    }

    public function oneBoard(Board $board_id)
    {
      $cards = $board_id->cards;
      $lessonCards = $board_id->lessoncards;
      return view('boardCrud.oneBoard', ['cards'=>$cards, 'thisBoard'=>$board_id, 'lessonCards'=>$lessonCards]);
    }

    public function addStudentsToBoard($board_id)
    {
      return view('boardCrud.addStudentsToBoard' , ['board_id'=>$board_id]);
    }

    public function search($board_id)
    {
      $search_text = $_GET['query'];
      $search = User::where('name','LIKE', '%' .$search_text.'%')->get();
      return view('boardCrud.zoeken', ['search'=>$search, 'board_id'=>$board_id]);     
    }

  public function addToBoard($board_id, $user_id)
  {  
    {
      Board_users::updateOrCreate(
        [
            "board_id" => $board_id,
            "user_id" => $user_id
        ]
        );
    }

    return redirect('/home');        
  }
}