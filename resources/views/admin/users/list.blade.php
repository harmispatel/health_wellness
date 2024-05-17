@extends('admin.layouts.admin-layout')

@section('title', 'Users')

@section('content')

    <div class="pagetitle">
        <h1>{{ trans('label.users') }}</h1>
        <div class="row">
            <div class="col-md-8">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"> <a
                                href="{{ route('dashboard') }}">{{ trans('label.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('label.users') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4" style="text-align: right;">
                <a href="{{ route('users.create') }}" class="btn btn-sm new-category custom-btn">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
        </div>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            {{-- Clients Card --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                        </div>
                        <div class="table-responsive custom_dt_table">
                            <div class="form_box">
                                <div class="form_box_inr">
                                    <div class="box_title">
                                        <h2>{{ trans('label.users') }}</h2>
                                    </div>
                                    <div class="form_box_info">
                                        <div class="table-responsive">
                                            <table class="table w-100 dataTable no-footer" id="UsersTable"
                                                aria-describedby="RolesTable_info" style="width: 948px;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ trans('label.id') }}</th>
                                                        <th>{{ trans('label.name') }}</th>
                                                        <th>{{ trans('label.image') }}</th>
                                                        <th>{{ trans('label.user_type') }}</th>
                                                        <th>{{ trans('label.status') }}</th>
                                                        <th>{{ trans('label.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection

{{-- Custom Script --}}
@section('page-js')

    <script type="text/javascript">
        $(function() {
            var table = $('#UsersTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: {
                    url: "{{ route('users') }}",

                },
                columns: [{
                        data: 'id',
                        name: 'id',

                    },
                    {
                        data: 'name',
                        name: 'name',

                    },
                    {
                        data: 'image',
                        name: 'image',

                    },
                    {
                        data: 'usertype',
                        name: 'usertype',

                    },
                    {
                        data: 'status',
                        name: 'status',

                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        'searchable': false,
                        'orderable': false,
                    },

                ]
            });


        });

        // Function for Delete Table
        function changeStatus(status, id) {
            $.ajax({
                type: "POST",
                url: '{{ route('users.status') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "status": status,
                    "id": id
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            })
        }
        // Function for Delete Table
        function deleteUsers(userId) {
            swal({
                    title: "Are you sure You want to Delete It ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDeleteUsers) => {
                    if (willDeleteUsers) {
                        $.ajax({
                            type: "POST",
                            url: '{{ route('users.destroy') }}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': userId,
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.success == 1) {
                                    toastr.success(response.message);
                                    $('#UsersTable').DataTable().ajax.reload();
                                } else {
                                    swal(response.message, "", "error");
                                }
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        }
    </script>
    </script>
@endsection
