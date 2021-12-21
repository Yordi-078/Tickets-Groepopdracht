<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\User;
use App\Models\LessonCard;
use App\Models\LessonUpvotes;
use App\Models\BoardUser;
use App\Models\Card; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CardController extends Controller
{
    public function addACard($board_id)
    {
        $board = Board::where('id', $board_id)->get();
        return view('boardCrud.createCard', ['board'=>$board, 'board_id'=>$board_id]);
    }

    public function storeCard(Request $request, $board_id)
    { 
        $this->validateCard();

        $name = $request->input('name');
        $description = $request->input('description');
        $user_id = Auth::user()->id;

        date_default_timezone_set('Europe/Amsterdam');
        // $date = date('y-m-d h:i:s');
        
        $card = new Card();
        $card->name = $name;
        $card->description = $description;
        $card->user_id = $user_id;
        $card->board_id = $board_id;
        $card->created_at = Carbon::now();
        $card->status = 'in_progress';
        $card->save();

        return redirect()->route('oneBoard', ['board_id'=>$board_id]);
    }

    protected function validateCard() 
    {
        return request()->validate([
            'name' => ['required', 'min:1', 'max:40'],
            'description' => ['required', 'min:1', 'max:100']
        ]);
    }

   


    public function getCardInfo($lesson_id, $board_id)
    {
        $userID = LessonUpvotes::where('card_id', $lesson_id)->get('user_id');
        $users = User::find($userID);
        
        return redirect()->route('oneBoard', ['board_id'=>$board_id, 'users'=>$users]);
    }

    public function updateCard(Request $request, $card_id ,$board_id)
    { 
        $this->validateCard();
        $user_id = Auth::user()->id;
        Card::updateOrCreate(
            [
                "id" => $card_id
            ],
            [
                "name" => $request["name"],
                "description" => $request["description"],
                "status" => $request["status"]
            ]
        );

        return redirect()->route('oneBoard', ['board_id'=>$board_id]);
    }
}

