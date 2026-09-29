@extends('admin.partials.master')
@section('admin_content')
    <style>
        .card-body {
            background: #425c49;
        }

        .text-muted {
            color: #fff !important;
        }

        h3 {
            color: #fff;
        }
    </style>
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-xl-12 col-12 dashboard-users">
                <div class="row  ">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-6 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <input type="text" value="curl -s {{url('commission-interest')}}" class="form-control">
                                        </div>
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
