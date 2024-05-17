<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\QuestionAnswer;

class QuestionController extends BaseController
{
    public function getQuestionList()
    {
        try {
            $questions = Question::with('questionOptions')->get();

            if ($questions->isEmpty()) {
                return $this->sendResponse(null, 'No questions found', false);
            }

            $allQuestion = QuestionResource::collection($questions);

            return $this->sendResponse($allQuestion, 'Question list retrieved successfully', true);
        } catch (\Throwable $th) {

            return $this->sendResponse(null, 'Something went wrong', false);
        }
    }

    public function QuestionAndOptionStore(Request $request){
      
        try {

            $requestData = $request->input('data');
            $responses = [];

            foreach ($requestData as $data) {
                $questionAnswers = new QuestionAnswer;
                $questionAnswers->plan_type = $data['planType'];
                $questionAnswers->question_id = $data['questionId'];
                $questionAnswers->option_id = $data['optionId'];
                $questionAnswers->user_id = auth()->user()->id;
                $questionAnswers->save();

                // Add saved question answer to responses array
                $responses[] = $questionAnswers;
            }

            return $this->sendResponse($responses,'Question Answer Saved SuccessFully!',true);
           
        } catch (\Throwable $th) {

            dd($th);
            return $this->sendResponse(null,'Something went wrong!',false);
        }
    }
}
