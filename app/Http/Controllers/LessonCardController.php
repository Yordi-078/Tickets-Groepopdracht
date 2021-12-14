<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\LessonCards;
use Illuminate\Support\Facades\Auth;

class LessonCardController extends Controller
{
    

    public function createLessCard($board_id)
    {
        $board = Board::where('id', $board_id)->get();
        return view('boardCrud.createLessCard', ['board'=>$board, 'board_id'=>$board_id]);
    }

    public function storeLessonCard(Request $request, $board_id)
    {
        $this->validateLessonCard();
        $name = $request->input('name');
        $description = $request->input('description');
        $start_time = $request->input('start_time');
        $status = "in_progress";
        $user_id = Auth::user()->id;

        LessonCards::updateOrCreate(
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
            'description' => ['required', 'min:1', 'max:100']
        ]);
    }
    
    public function storeLessonUpVote($lesson_id, $board_id)
    {
        $user_id = Auth::user()->id;

        LessonUpvotes::updateOrCreate(
            [
                "card_id" => $lesson_id,
                "user_id" => $user_id
            ]
            );
            return redirect()->route('oneBoard', ['board_id'=>$board_id]); 
    }
}