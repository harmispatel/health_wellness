<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option_name',
        'description',
        'workout_plan',
        'diet_plan',
    ];

    protected $casts = [
        'workout_plan' => 'array',
        'diet_plan' => 'array',
    ];
    
    public function question(){
        return $this->belongsTo(Question::class);
    }

   
}
