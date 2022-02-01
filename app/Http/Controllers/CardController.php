<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\User;
use App\Models\LessonCard;
use App\Models\CardUpvotes;
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
        $response = [];
         $userID = LessonUpvotes::where('card_id', substr($lesson_id, -1))->get('user_id');
         // loop door alle userID's en zet ze in 
         for ($i=0; $i < count($userID) ; $i++) { 
            $users = User::where('id', $userID[$i]['user_id'])->get('name');
            array_push($response, $users[0]['name']);
         }
        
          return response()->json($response);
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
                "status" => $request["status"],
            ]
        );
        
        return redirect()->route('oneBoard', ['board_id'=>$board_id]);
    }
    
    public function getUsername($user_id, $helper_id)
    {
        $userID = user::where('id', $user_id)->get('name');
        if($helper_id != 'empty'){
            $helperID = user::where('id', $helper_id)->get();
            $response = [$userID[0], $helperID[0]];
        }
        else{
            $response = [$userID[0], 'empty'];
        }
        

          return response()->json($response);
    }
    
    public function saveHelper($card_id, $helperId)
    {
        Card::updateOrCreate(
            [
                "id" => $card_id
            ],[
                "helper_id" => $helperId,
            ]
        );

          return response()->json();
    }
    
    public function removeHelper($card_id)
    {
        Card::updateOrCreate(
            [
                "id" => $card_id
            ],[
                "helper_id" => NULL,
            ]
        );

          return response()->json();
    }

    public function storeCardUpVote($card_id, $board_id)
    {
        $user_id = Auth::user()->id;

        CardUpvotes::updateOrCreate(
            [
                "card_id" => $card_id,
                "user_id" => $user_id
            ]
            );
            return redirect()->route('oneBoard', ['board_id'=>$board_id]); 
    }
}

