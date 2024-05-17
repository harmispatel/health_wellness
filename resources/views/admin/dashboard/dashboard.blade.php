@extends('admin.layouts.admin-layout')

@section('title', 'D A S H B O A R D')

@section('content')

    <div class="pagetitle">
        <h1>{{ trans('label.dashboard') }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('label.dashboard') }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            @if (session()->has('errors'))
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('errors')  }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="col-md-12 mt-3 text-center" style="height: 360px;">
                <h3>{{ trans('label.welcome_to_admin_panel') }}</h3>
            </div>
        </div>
    </section>


@endsection
