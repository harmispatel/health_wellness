<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\QuestionOption;
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

            return $this->sendResponse(null,'Question Answer Saved SuccessFully!',true);
           
        } catch (\Throwable $th) {
            return $this->sendResponse(null,'Something went wrong!',false);
        }
    }
public function UserWorkoutPlan(){
    try {
        $questionAnswers = QuestionAnswer::with(['question', 'questionOption'])->get();

        $results = [];

        foreach ($questionAnswers as $qa) {
            $questionId = $qa->question_id;
            $optionId = $qa->option_id;

            $questionName = isset($qa->question->question_name) ? $qa->question->question_name : null;
            $optionName = isset($qa->questionOption->option_name) ? $qa->questionOption->option_name : null;
            
            

            $workoutPlan = $qa->questionOption->workout_plan;
            $dietPlan = $qa->questionOption->diet_plan;

            if (is_string($workoutPlan)) {
                $workoutPlan = json_decode($workoutPlan, true);
            }

            if (is_string($dietPlan)) {
                $dietPlan = json_decode($dietPlan, true);
            }

            // Ensure there are plans for all 7 days
            $defaultPlan = array_fill(0, 7, '');

            // Replace empty plans with default
            $workoutPlan = is_array($workoutPlan) ? array_replace($defaultPlan, $workoutPlan) : $defaultPlan;
            $dietPlan = is_array($dietPlan) ? array_replace($defaultPlan, $dietPlan) : $defaultPlan;



            // Add to the results array
            $results[] = [
                'question_id' => $questionId,
                'question_name' => $questionName,
                'option_id' => $optionId,
                'option_name' => $optionName,
                'workout_plan' => $workoutPlan,
                'diet_plan' => $dietPlan,
                'user_id' => auth()->user()->id,
            ];
        }

        return $this->sendResponse($results, 'User workout plan retrieved successfully!', true);
    } catch (\Throwable $th) {
        
        return $this->sendResponse(null, 'Something went wrong!', false);
    }
}

}
   
