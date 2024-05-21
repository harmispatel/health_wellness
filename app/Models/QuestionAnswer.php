<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function question(){
        return $this->hasOne(Question::class,'id','question_id');
    }

    public function questionOption(){
        return $this->hasOne(QuestionOption::class,'id','option_id');
    }
}
