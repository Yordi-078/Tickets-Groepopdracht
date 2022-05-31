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

    public function sendReviewLinks(Request $request){

        $lesson = LessonCard::where('id', $request['lessonCard_id'])->get();

        $user_ids = LessonUpvotes::where('card_id', $request['lessonCard_id'])->get();
        for ($i=0; $i < count($user_ids); $i++) { 
            $user = User::where('id' , $user_ids[$i]['user_id'])->get();
            Mail::to($user[0]['email'])
                ->send(new LeaveReview($user[0], $lesson[0]));
        }

        return response()->json('hello world!!');
    }
}
