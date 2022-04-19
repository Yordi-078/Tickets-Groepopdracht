<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\LessonCard;
use App\Models\LessonUpvotes;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LessonCardController extends Controller
{
    

    public function createLessonCard($board_id)
    {
        $board = Board::where('id', $board_id)->get();
        return view('boardCrud.createLessonCard', ['board'=>$board, 'board_id'=>$board_id]);
    }

    public function storeLessonCard(Request $request, $board_id)
    {
        $this->validateLessonCard();
        $name = $request->input('name');
        $description = $request->input('description');
        $start_time = $request->input('start_time');
        $status = "in_progress";
        $user_id = Auth::user()->id;

        LessonCard::updateOrCreate(
            [
                "name" => $name,
                "user_id" => $user_id,
                "board_id" => $board_id,
                "description" => $description,
                "status" => $status,
                "start_time" => $start_time   
            ]
            );
            return redirect()->route('oneBoard', ['board_id'=>$board_id]);
    }


    protected function validateLessonCard() 
    {
        return request()->validate([
            'name' => ['required', 'min:1', 'max:40'],
            'description' => ['required', 'min:1', 'max:100'],
            'start_time' => ['required']
        ]);
    }
    


    public function storeLessonUpVote($card_id)
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

    public function getLessonCardInfo(LessonCard $card){
        return response()->json($card);
    }

    //weergeef giveReview page
    //stuur 2 variabelen mee
    function giveReview($lessonCard_id, $board_id){
        return view('review.giveReview', ['board_id'=>$board_id , 'lessonCard_id'=>$lessonCard_id]);
    }

    //weergeef AllReviews page
    //stuur 2 variabelen mee
    function allReviews($lessonCard_id){
        $review = Review::where('lessonCard_id', $lessonCard_id)->get();
        $lessonCard = LessonCard::find($lessonCard_id);
        // $user_id = Auth::user()->id;
        // $user = User::where('id', $user_id)->get();
        
        return view('review.allReviews', ['reviews' => $review, 'lessonCard' => $lessonCard_id, 'lessonsCard' => $lessonCard]);
    }

    // Functie voor het aanmaken van een nieuwe review
    function storeReview(Request $request, $board_id, $lessonCard_id){
        $user_id = Auth::user()->id;
        $this->validateReview();
        Review::updateOrCreate(
            [
                "lessonCard_id" => $lessonCard_id, 
                "text" => $request->input('text'),
                "rating" => $request->input('rating')
            ]
        );
        
        return redirect()->route('oneBoard', ['board_id'=>$board_id]);
    }

    //Valideren of het Review form wordt ingevuld
    protected function validateReview() 
    {
        return request()->validate([
            'text' => ['required', 'min:1', 'max:80']
        ]);
    }
}
