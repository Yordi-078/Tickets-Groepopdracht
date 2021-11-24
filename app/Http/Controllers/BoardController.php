<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Board;
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

    public function oneBoard($board_id){

        $board = Board::where('id', $board_id)->get();
        return view('boardCrud.oneBoard', ['board'=>$board]);
    }
}
