@extends('admin.layouts.admin-layout')

@section('title', 'Advertisement')

@section('content')

    {{-- Page Title --}}
    <div class="pagetitle">
        <h1>{{ trans('label.advertisement')}}</h1>
        <div class="row">
            <div class="col-md-8">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ trans('label.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{ trans('label.advertisement')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    {{-- New Category add Section --}}
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('advertisement.index') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form_box">                 
                                <div class="form_box_inr">
                                    <div class="box_title">
                                        <h2>{{ trans('label.advertisement_detail')}}</h2>
                                    </div>
                                    <div class="form_box_info">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form_group">
                                                    <label for="advertise_image" class="form-label">{{ trans('label.image')}}<span class="text-danger">*</span></label>
                                                    <input type="file" name="advertise_image" class="form-control @error('advertise_image') is-invalid @enderror">
                                                    <div class="mt-2">
                                                       @if($advertiseMent)
                                                        <img src="{{ asset('public/images/uploads/advertise_image/' .$advertiseMent->advertise_image ) }}"
                                                            alt="" width="100" height="100">
                                                       @else  
                                                            <img src="{{asset('public/images/uploads/user_images/no-image.png')}}" alt="" width="100" height="100">
                                                        @endif
                                                    </div>
                                                    @if ($errors->has('advertise_image'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('advertise_image') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn form_button">{{ trans('label.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
