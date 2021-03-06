<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\User;
use App\Models\LessonCard;
use App\Models\CardUpvotes;
use App\Models\LessonUpvotes;
use App\Models\BoardUser;
use App\Models\CardPhotos;
use App\Models\Card;
use App\Models\Photo;
use App\Models\CardTags;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CardController extends Controller
{
    public function addACard($board_id)
    {
        $board = Board::where('id', $board_id)->get();
        $tags = Tags::where('board_id', $board_id)->get();
        return view('boardCrud.createCard', ['board'=>$board, 'board_id'=>$board_id, 'tags'=>$tags]);
    }

    public function storeCard(Request $request, $board_id)
    { 
        $this->validateCard();
        $user_id = Auth::user()->id;
        date_default_timezone_set('Europe/Amsterdam');
        
        $object = Card::updateOrCreate(
            [
                "name" => $request->name,
                "user_id" => $user_id,
                "board_id" => $board_id,
                "description" => $request->description,
                "created_at" => Carbon::now(),
                "status" => "in_progress"
            ]
            );

            $card_id = $object->id;

            

            $this->storeCardTag($request->tag_id, $card_id, $board_id);
            
        
        
        return redirect()->route('oneBoard', ['board_id'=>$board_id]);
    }

    public function storeCardTag($tag_id, $card_id, $board_id){
        for($i =0; $i < count($tag_id); $i++) {
             CardTags::updateOrCreate(
                 [
                    "tag_id" => $tag_id[$i],
                    "card_id" => $card_id,
                    "board_id" => $board_id, 
                 ]
                 );
                 }
    }

    protected function validateCard() 
    {
        return request()->validate([
            'name' => ['required', 'min:1', 'max:40'],
            'description' => ['required', 'min:1', 'max:100']
        ]);
    }

   


    public function getCardInfo($lesson_id)
    {
        $response = [];
         $userID = LessonUpvotes::where('card_id', $lesson_id)->get('user_id');
         // loop door alle userID's en zet ze in 
         for ($i=0; $i < count($userID) ; $i++) { 
            $users = User::where('id', $userID[$i]['user_id'])->get();
            array_push($response, $users[0]);
         }
        
          return response()->json($response);
    }

    public function updateCard(Request $request)
    { 
        
        Card::updateOrCreate(
            [
                "id" => $request['card_id']
            ],
            
            [
                "name" => $request['name'],
                "description" => $request['description'],
                "status" => $request['status'],
            ]
        );
        
        return response()->json();
    }
    
    public function getUsername($user_id, $helper_id)
    {
        $userID = User::where('id', $user_id)->get('name');
        if($helper_id != 'empty'){
            $helperID = User::where('id', $helper_id)->get();
            $response = [$userID[0], $helperID[0]];
        }
        else{
            $response = [$userID[0], 'empty'];
        }
        

          return response()->json($response);
    }

    public function getLessonOwner($user_id)
    {
        $response = User::where('id', $user_id)->get('name');

          return response()->json($response);
    }

    public function getUserInfo($user_id)
    {
        $response = User::where('id', $user_id)->get();

          return response()->json($response[0]);
    }

    public function updateCardImage($card_id, $image_id){
        $allCardPhotos = CardPhotos::where('card_id', $card_id)->get();
        $returnMessage = 'afbeelding opgeslagen';
        if(count($allCardPhotos) == 5){
            $allPhotos = Photo::where('id', $allCardPhotos[0]['photo_id'])->get();
            $returnMessage = 'maximum van 5 afbeeldingen bereikt. "' . $allPhotos[0]['name'] . '" verwijderd. nieuwe afbeelding opgeslagen.';
            $allCardPhotos[0]->delete();
            $allPhotos[0]->delete();
        }
        $cardPhotos = new CardPhotos ();
        $cardPhotos->card_id = $card_id;
        $cardPhotos->photo_id = $image_id;
        $cardPhotos->save();

        return response()->json($returnMessage);
    }

    public function getUpvoters($card_id)
    {
        $upvoters_ids = CardUpvotes::where('card_id', $card_id)->get('user_id');
        $upvoters = [];

        for ($i=0; $i < count($upvoters_ids); $i++) { 
           $upvoter = User::where('id', $upvoters_ids[$i]['user_id'])->get();
           array_push($upvoters, $upvoter[0]);
        }

        return response()->json($upvoters);
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
    
    public function saveCardUpvote($card_id)
    {

        $user_id = Auth::user()->id;

        CardUpvotes::updateOrCreate(
            [
                "card_id" => $card_id,
                "user_id" => $user_id
            ]
        );
          return response()->json();
    }

    public function saveLessonUpvote($card_id)
    {
        $user_id = Auth::user()->id;
        LessonUpvotes::updateOrCreate(
            [
                "card_id" => $card_id,
                "user_id" => $user_id
            ]
            );
          return response()->json();
    }

    public function deleteCardUpvote($card_id){
        $user_id = Auth::user()->id;

        $voter = CardUpvotes::where('card_id', $card_id)->where('user_id', $user_id);
        $voter->delete();

        return response()->json();
    }

    public function deleteLessonUpvote($card_id){
        $user_id = Auth::user()->id;

        $voter = LessonUpvotes::where('card_id', $card_id)->where('user_id', $user_id);
        $voter->delete();

        return response()->json();
    }

    public function GetCardAvatars($card_id)
    {
        $cardAvatars = [];
        $cardAvatarsId = CardUpvotes::where('card_id', $card_id)->get('user_id');
        for ($i=0; $i < count($cardAvatarsId); $i++) { 
            $cardAvatar = User::where('id', $cardAvatarsId[$i]['user_id'])->get();
            array_push($cardAvatars, $cardAvatar[0]);
        }
        
          return response()->json($cardAvatars);
    }

    function getQuestionCardInfo($card_id){
        $cardData = Card::where('id', $card_id)->get();

        $cardTags = [];
        $tags = CardTags::where('card_id', $card_id)->get();
        for ($i=0; $i < count($tags); $i++) { 
            $cardTag = Tags::where('id', $tags[$i]['tag_id'])->get();
            array_push($cardTags, $cardTag[0]);
        }

        $response = [$cardData, $cardTags];

        return response()->json($response);
    }

    function getLessonCardInfo($card_id){
        $response = LessonCard::where('id', $card_id)->get();

        return response()->json($response);
    }
}


