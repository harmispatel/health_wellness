<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\QuestionOptionResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->plan_type == 0){
            $plan_type = "Diet Plan";
        }elseif($this->plan_type == 1){
            $plan_type = "Workout Plan";
        }else{
            $plan_type = "--";
        }
        return [
            'id' => $this->id,
            'question_name' => $this->question_name,
            'plan_type' => $plan_type,
            'Question_Options' => QuestionOptionResource::collection($this->questionOptions),
        ];
    }
}
