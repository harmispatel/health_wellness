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
                        <li class="breadcrumb-item active">{{ trans('label.create') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{-- Clients Card --}}
    <div class="col-md-12">
        <div class="card">
            <form class="form" action="{{ route('question.store') }} " method="POST" enctype="multipart/form-data" id="questionForm" novalidate>
                <div class="card-body">
                    @csrf
                    <div class="form_box">
                        <div class="form_box_inr">
                            <div class="box_title">
                                <h2>{{ trans('label.question') }}</h2>
                            </div>
                            <div class="form_box_info csm_que">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="question_name"
                                                class="form-label"><strong>{{ trans('label.question_name') }}</strong>
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="question_name" id="question_name"
                                                value="{{ old('question_name') }}" class="form-control">
                                            <div id="question_name_error" class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="plan_type"
                                                class="form-label"><strong>{{ trans('label.plan_type') }}</strong>
                                                <span class="text-danger">*</span></label>
                                                <select type="text" name="plan_type" id="plan_type"
                                                class="form-control">
                                                <option value="">-- Select Plan Type --</option>
                                                <option value="0">{{ trans('Diet Plan')}}    </option>
                                                <option value="1">{{ trans('Workout Plan')}}    </option>
      
                                            </select>
                                            <div id="plan_type_error" class="invalid-feedback"></div>
                                        </div>
                                    </div> --}}

                                    <div class="col-md-12 additional-info text-end pt-2">
                                        <a href="" class="btn btn-sm new-category custom-btn" id="addOption"><i
                                                class="bi bi-plus-lg"></i></a>
                                    </div>
                                    <div class="col-md-6 additional-info">
                                        <div class="form-group">
                                            <label for="option_name" class="form-label"><strong> -----
                                                    {{ trans('label.option_name') }} ----- <span
                                                        class="text-danger">*</span></strong></strong></label>
                                            <input type="text" name="option_name[]" id="option_name1"
                                                class="form-control" />
                                            <div id="option_name1_error" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 additional-info">
                                        <div class="form-group">
                                            <label for="description" class="form-label"><strong> -----
                                                    {{ trans('label.description') }} ----- </strong></label>
                                            <input type="text" name="description[]" id="description"
                                                class="form-control" />

                                        </div>
                                    </div>
                                    <div class="col-md-6 additional-info mt-2">
                                        <label for="Workput" class="form-label"><strong>*
                                            </strong><strong>{{ trans('label.workout_plan') }} </strong></label>
                                    </div>
                                    <div class="col-md-6 additional-info mt-2">
                                        <label for="Workput" class="form-label"><strong>*
                                            </strong><strong>{{ trans('label.diet_plan') }} </strong></label>
                                    </div>

                                    @php
                                        $days = [
                                            'day_1' => trans('label.day_1'),
                                            'day_2' => trans('label.day_2'),
                                            'day_3' => trans('label.day_3'),
                                            'day_4' => trans('label.day_4'),
                                            'day_5' => trans('label.day_5'),
                                            'day_6' => trans('label.day_6'),
                                            'day_7' => trans('label.day_7'),
                                        ];
                                    @endphp

                                @foreach ($days as $day_key => $day_label)
                                    <div class="col-md-6 additional-info mt-2">
                                        <div class="form-group">
                                            <label for="workout_plan" class="form-label"><strong>{{ $day_label }}</strong></label>
                                            <input type="text" name="workout_plan[0][{{ $day_key }}]" id="workout_plan" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 additional-info mt-2">
                                        <div class="form-group">
                                            <label for="diet_plan" class="form-label"><strong>{{ $day_label }}</strong></label>
                                            <input type="text" name="diet_plan[0][{{ $day_key }}]" id="diet_plan" class="form-control" />
                                        </div>
                                    </div>
                                @endforeach

                                    <div class="row appending_div">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn form_button">{{ trans('label.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('page-js')

    <script>
        // **  multiple option_name  **

        $(document).ready(function() {
            var optionIndex = 1; // Start index from 1

            $('#addOption').on('click', function(e) {
                e.preventDefault();

                var field = '<div class="col-md-12 added-option" >' +
                    '<div class="row">' +
                    '<div class="col-md-6  align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="option_name" class="form-label">' +
                    '<strong> ----- {{ trans('label.option_name') }} ----- </strong>' +
                    '</label>' +
                    '<input type="text" name="option_name[' + optionIndex + ']" class="form-control" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="description" class="form-label">' +
                    '<strong> ----- {{ trans('label.description') }} -----</strong>' +
                    '</label>' +
                    '<input name="description[' + optionIndex + ']" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>* </strong><strong>{{ trans('label.workout_plan') }}</strong>' +
                    '</label>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>* </strong><strong>{{ trans('label.diet_plan') }}</strong>' +
                    '</label>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_1') }}</strong>' +
                    '</label>' +
                    '<input name="workout_plan[' + optionIndex + '][day_1]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="diet_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_1') }}</strong>' +
                    '</label>' +
                    '<input name="diet_plan[' + optionIndex + '][day_1]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_2') }}</strong>' +
                    '</label>' +
                    '<input name="workout_plan[' + optionIndex + '][day_2]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="diet_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_2') }}</strong>' +
                    '</label>' +
                    '<input name="diet_plan[' + optionIndex + '][day_2]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_3') }}</strong>' +
                    '</label>' +
                    '<input name="workout_plan[' + optionIndex + '][day_3]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="diet_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_3') }}</strong>' +
                    '</label>' +
                    '<input name="diet_plan[' + optionIndex + '][day_3]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_4') }}</strong>' +
                    '</label>' +
                    '<input name="workout_plan[' + optionIndex + '][day_4]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="diet_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_4') }}</strong>' +
                    '</label>' +
                    '<input name="diet_plan[' + optionIndex + '][day_4]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_5') }}</strong>' +
                    '</label>' +
                    '<input name="workout_plan[' + optionIndex + '][day_5]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="diet_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_5') }}</strong>' +
                    '</label>' +
                    '<input name="diet_plan[' + optionIndex + '][day_5]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_6') }}</strong>' +
                    '</label>' +
                    '<input name="workout_plan[' + optionIndex + '][day_6]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="diet_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_6') }}</strong>' +
                    '</label>' +
                    '<input name="diet_plan[' + optionIndex + '][day_6]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="workout_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_7') }}</strong>' +
                    '</label>' +
                    '<input name="workout_plan[' + optionIndex + '][day_7]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info pt-2">' +
                    '<div class="form-group">' +
                    '<label for="diet_plan" class="form-label">' +
                    '<strong>{{ trans('label.day_7') }}</strong>' +
                    '</label>' +
                    '<input name="diet_plan[' + optionIndex + '][day_7]" class="form-control"></input>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1 align-content-center">' +
                    '<div class="row align-items-end">' +
                    '<div class="additional-info mt-5">' +
                    '<div class="form-group">' +
                    '<button class="btn btn-sm  btn-danger cancel-option"><i class="bi bi-x" aria-hidden="true"></i></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $('.appending_div').append(field);


                optionIndex++; // Increment insdex for the next option
            });

            // Event delegation for the cancel button
            $('.appending_div').on('click', '.cancel-option', function(e) {
                e.preventDefault();

                // Hide only the specific row containing fields
                $(this).closest('.added-option').remove();
            });


        });


        // question_id and question_name required

        $(document).ready(function() {

            $('#questionForm').on('submit', function(event) {
                let allFieldsFilled = true;
                const requiredFields = $('#questionForm .form-control').not('[name^="description"]');

                requiredFields.each(function() {
                    if ($(this).val().trim() === '') {
                        allFieldsFilled = false;
                        $(this).addClass('is-invalid'); // Add invalid class to show error
                    } else {
                        $(this).removeClass('is-invalid'); // Remove invalid class if field is filled
                    }
                });

                if (!allFieldsFilled) {
                    event.preventDefault(); // Prevent form submission
                    alert('All fields are required');
                }
           });

            $('form').submit(function(e) {


                var questionName = $('#question_name').val().trim();
                // var description = $('#description').val().trim();
                var optionName1 = $('#option_name1').val().trim();


                //questionName
                if (questionName === '') {
                    $('#question_name').addClass('is-invalid');
                    $('#question_name_error').text('Question Name is required.');
                    e.preventDefault();
                } else {
                    $('#question_name').removeClass('is-invalid');
                    $('#question_name_error').text('');
                }

             
                if (optionName1 === '') {
                    $('#option_name1').addClass('is-invalid');
                    $('#option_name1_error').text('Option Name is required.');
                    e.preventDefault();
                } else {
                    $('#option_name1').removeClass('is-invalid');
                    $('#option_name1_error').text('');
                }


            });
        });
    </script>

@endsection
