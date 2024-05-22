<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionOption;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    public function index(Request $request){
       try {
             if($request->ajax()){
                 $allQuestion = Question::get();

                return DataTables::of($allQuestion)
                        ->addIndexColumn()
                        ->addColumn('actions',function($question){
                            $action_html = '<div class="btn-group">';
                            $action_html .= '<a href=' . route("question.edit", ["id" => encrypt($question->id)]) . ' class="btn btn-sm custom-btn me-1"> <i class="bi bi-pencil" aria-hidden="true"></i></a>';
                            $action_html .= '<a onclick="deleteUsers(\'' . $question->id . '\')" class="btn btn-sm btn-danger me-1"><i class="bi bi-trash" aria-hidden="true"></i></a>'; 
                            $action_html .= '<a href=' . route("question.optionView", ["id" => encrypt($question->id)]) . ' class="btn btn-sm btn-info me-1"><i class="bi bi-eye" aria-hidden="true"></i></a>';
                            $action_html .= '</div>';
                            return $action_html;
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
             }
             return view('admin.question.index');
       } catch (\Throwable $th) {
        dd($th);
        return redirect()->back()->with('error', 'Internal Server Error');
       }
    }

    public function create()
    {
        return view('admin.question.create');
    }

    public function store(Request $request){
     
        try {
            $input = $request->except('_token','option_name','description','workout_plan','diet_plan');

            $question = Question::create($input);
           
            if ($request->has('option_name') && $request->has('description') && $request->has('workout_plan') && $request->has('diet_plan')) {
                $optionNames = $request->option_name;
                $descriptions = $request->description;
                $workoutPlans = $request->workout_plan; // Corrected variable name
                $dietPlans = $request->diet_plan; // Corrected variable name
    
                foreach ($optionNames as $index => $optionName) {
                    if ($optionName !== null && $optionName !== '') {
                        $description = isset($descriptions[$index]) ? $descriptions[$index] : '';
                        $workoutPlan = isset($workoutPlans[$index]) ? json_encode($workoutPlans[$index]) : [];
                        $dietPlan = isset($dietPlans[$index]) ? json_encode($dietPlans[$index]) : [];
                
                        $questionOption = new QuestionOption;
                        $questionOption->question_id = $question->id;
                        $questionOption->option_name = $optionName;
                        $questionOption->description = $description;
                        $questionOption->workout_plan = $workoutPlan;
                        $questionOption->diet_plan = $dietPlan;
                        $questionOption->save();
                    }
                }                
                
            }
            return redirect()->route('question.index')->with('message', 'Question Saved Successfully');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('question.index')->with('error', 'Internal Server Error');
        }
    }
    
    

    public function edit($id){
        
        $id = decrypt($id);
        try {
            $question = Question::find($id);
            $questionOptions = QuestionOption::where('question_id',$id)->get();

            return view('admin.question.edit',compact('question','questionOptions'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Internal Server Error');
        }
        
    }

    public function update(Request $request)
{
    $id = decrypt($request->id);

    try {
        $question = Question::find($id);

        if ($question) {
            $question->update([
                'question_name' => $request->question_name,
                'plan_type' => $request->plan_type,
            ]);

            // Fetch existing question options
            $existingQuestionOptions = QuestionOption::where('question_id', $id)->get();

            // Keep track of existing option IDs
            $existingOptionIds = $existingQuestionOptions->pluck('id')->toArray();

            // Iterate through the submitted option data
            if ($request->has('option_name')) {
                $optionNames = $request->option_name;
                $descriptions = $request->description;
                $workoutPlans = $request->workout_plan;
                $dietPlans = $request->diet_plan;

                foreach ($optionNames as $index => $optionName) {
                    $description = isset($descriptions[$index]) ? $descriptions[$index] : '';
                    $workoutPlan = isset($workoutPlans[$index]) ? json_encode($workoutPlans[$index]) : '';
                    $dietPlan = isset($dietPlans[$index]) ? json_encode($dietPlans[$index]) : '';

                    // Check if the submitted option ID exists in the existing options
                    if (isset($request->option_id[$index]) && in_array($request->option_id[$index], $existingOptionIds)) {
                        // Update the existing option
                        $existingOption = QuestionOption::find($request->option_id[$index]);
                        $existingOption->update([
                            'option_name' => $optionName,
                            'description' => $description,
                            'workout_plan' => $workoutPlan,
                            'diet_plan' => $dietPlan,
                        ]);

                        // Remove the ID from the existing IDs array to track which IDs were not updated
                        unset($existingOptionIds[array_search($request->option_id[$index], $existingOptionIds)]);
                    } else {
                        // Create a new option if the ID is not found or not provided
                        $questionOption = new QuestionOption;
                        $questionOption->question_id = $question->id;
                        $questionOption->option_name = $optionName;
                        $questionOption->description = $description;
                        $questionOption->workout_plan = $workoutPlan;
                        $questionOption->diet_plan = $dietPlan;
                        $questionOption->save();
                    }
                }

                // Delete options that were not updated
                QuestionOption::whereIn('id', $existingOptionIds)->delete();
            }

            return redirect()->route('question.index')->with('message', 'Question Updated Successfully');
        }
    } catch (\Throwable $th) {
        return redirect()->route('question.index')->with('error', 'Internal Server Error!');
    }
}

   public function questionOptionView($id){
    try {
        $id = decrypt($id);

        $questionOptions = QuestionOption::where('question_id',$id)->get();

        $question = Question::where('id',$id)->first();

        return view('admin.question.optionView', compact('questionOptions','question'));
    } catch (\Throwable $th) {
        
        return redirect()->back()->with('error', 'Internal Server Error');
    }
   }

   public function delete(Request $request){
        try {
            $id = $request->id;
            $question = Question::find($id);
            $question->delete();

            return response()->json([
                'success' => 1,
                'message' => "QuestionType deleted Successfully..",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 0,
                'message' => "Something with wrong",
            ]);
        }
    }
}