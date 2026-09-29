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
                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-user font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Users</div>
                                            <h3 class="mb-0">{{\App\Models\User::get()->count()}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-12 dashboard-users-success">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                <i class="bx bx-briefcase-alt font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Total Purchase</div>
                                            <h3 class="mb-0">{{\App\Models\Purchase::get()->count()}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-12 dashboard-users-success">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                <i class="bx bx-briefcase-alt font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Total Checkin</div>
                                            <h3 class="mb-0">{{\App\Models\Checkin::get()->count()}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-shopping-bag font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Active Bonus</div>
                                            <?php
                                            $b = \App\Models\Bonus::where('status', 'active')->first();
                                            ?>
                                            <h3 class="mb-0"
                                                style="font-size: 13px !important;">{{$b ? $b->bonus_name : 'Bonus not Available'}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-shopping-bag font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Already Use Bonus</div>
                                            <?php
                                            $b_c = \App\Models\Bonus::where('status', 'active')->first();
                                            ?>
                                            <h3 class="mb-0" style="font-size: 13px !important;">{{$b_c ? $b_c->counter : 'N/A'}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-circle font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Approved Withdraw</div>
                                            <h3 class="mb-0">{{price(\App\Models\Withdrawal::where('status', 'approved')->get()->sum('amount'))}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-circle font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Pending Withdraw</div>
                                            <h3 class="mb-0">{{price(\App\Models\Withdrawal::where('status', 'pending')->get()->sum('amount'))}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-circle font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Rejected Withdraw</div>
                                            <h3 class="mb-0">{{price(\App\Models\Withdrawal::where('status', 'rejected')->get()->sum('amount'))}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-circle font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Approved Deposit</div>
                                            <h3 class="mb-0">{{price(\App\Models\Deposit::where('status', 'approved')->get()->sum('amount'))}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-circle font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Pending Deposit</div>
                                            <h3 class="mb-0">{{price(\App\Models\Deposit::where('status', 'pending')->get()->sum('amount'))}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12 dashboard-users-danger">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div
                                                class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-circle font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Rejected Deposit</div>
                                            <h3 class="mb-0">{{price(\App\Models\Deposit::where('status', 'rejected')->get()->sum('amount'))}}</h3>
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
