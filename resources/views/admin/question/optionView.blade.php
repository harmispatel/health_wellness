@extends('admin.layouts.admin-layout')

@section('title', 'Question')

@section('content')

    {{-- Page Title --}}
    <div class="pagetitle">
        <h1>{{ trans('label.question') }}</h1>
        <div class="row">
            <div class="col-md-8">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"> <a
                                href="{{ route('dashboard') }}">{{ trans('label.dashboard') }}</a> </li>
                        <li class="breadcrumb-item active"> <a
                                href="{{ route('question.index') }}">{{ trans('label.question') }}</a> </li>
                        <li class="breadcrumb-item active">{{ trans('label.Question_option') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{-- Clients Card --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form_box">
                    <div class="form_box_inr">
                        <div class="box_title">
                            <h2>{{ trans('label.question') }}</h2>
                        </div>
                        <div class="form_box_info">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="option_name"
                                                class="form-label"><strong>*  {{ $question->question_name }} ?</strong></label>
                                  
                                </div>
                                @foreach ($questionOptions as $option)
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <!-- Populate option_name and icon if they exist in your Option model -->
                                            <label for="option_name"
                                                class="form-label"><strong> --- {{ trans('label.option_name') }} --- </strong></label>
                                            <input type="text" name="option_name[]" value="{{ $option->option_name }}"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <!-- Populate option_name and icon if they exist in your Option model -->
                                            <label for="option_name"
                                                class="form-label"><strong> --- {{ trans('label.description') }} --- </strong></label>
                                            <input type="text" name="description[]" value="{{ $option->description }}"
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="Workput" class="form-label"><strong>*
                                            </strong><strong>{{ trans('label.workout_plan') }}
                                            </strong></label>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="Workput" class="form-label"><strong>*
                                            </strong><strong>{{ trans('label.diet_plan') }}
                                            </strong></label>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                                
                                        @if ($option->workout_plan)
                                            @php $workout_plan = json_decode($option->workout_plan) @endphp
                                            @foreach ($workout_plan as $day => $workout)
                                                <div class="form-group mt-2">
                                                    <label for="workout_plan"
                                                        class="form-label"><strong>{{ trans('label.day_' . ($day + 1)) }}</strong></label>
                                                    <input type="text"
                                                        name="workout_plan[{{ $loop->parent->index }}][]"
                                                        id="workout_plan" class="form-control"
                                                        value="{{ $workout }}" readonly />
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        
                                        @if ($option->diet_plan)
                                            @php $diet_plan = json_decode($option->diet_plan) @endphp
                                            @foreach ($diet_plan as $day => $diet)
                                                <div class="form-group mt-2">
                                                    <label for="diet_plan"
                                                        class="form-label"><strong>{{ trans('label.day_' . ($day + 1)) }}</strong></label>
                                                    <input type="text"
                                                        name="diet_plan[{{ $loop->parent->index }}][]"
                                                        id="diet_plan" class="form-control"
                                                        value="{{ $diet }}" readonly />
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('question.index') }}" class="btn form_button">{{ trans('label.back') }}</a>
            </div>            
        </div>
    </div>

@endsection
