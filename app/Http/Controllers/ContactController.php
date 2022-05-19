<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LessonUpvotes;
use App\Models\LessonCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveReview;

class ContactController extends Controller
{
    //

    public function sendReviewLinks(){

        $lessonCard_id = request('lessonCard_id');
        $lesson = LessonCard::where('id', $lessonCard_id)->get();

        $user_ids = LessonUpvotes::where('card_id', $lessonCard_id)->get();
        $users = [];
        for ($i=0; $i < count($user_ids); $i++) { 
            $user = User::where('id' , $user_ids[$i]['user_id'])->get();
            array_push($users, $user[0]);
        }
        
        // Mail::raw('it works! http://127.0.0.1:8000/giveReview/1/1', function ($message){
        //     $message->to('99057187@mydavinci.nl')
        //         ->subject('hello there.');
        // });

        Mail::to($users[0]['email'])
        ->send(new LeaveReview($users[0], $lesson[0]));

        return response()->json('succes ( i think )');
    }
}
