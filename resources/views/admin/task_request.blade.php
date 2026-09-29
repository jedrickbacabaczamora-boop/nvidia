@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>Task Request Lists</div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped dataex-html5-selectors">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>User Info</th>
                                        <th>Team Invest</th>
                                        <th>Bonus</th>
                                        <th>Team size</th>
                                        <th>Status</th>
                                        <th>Active</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tasks as $key => $row)
                                        <?php
                                            $user = \App\Models\User::where('id', $row->user_id)->first();
                                            $task = \App\Models\Task::where('id', $row->task_id)->first();
                                        ?>
                                        @if($user && $task)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>
                                                    Ref: {{$user->ref_id}}<br />
                                                    Phone: {{$user->phone}}<br />
                                                    <a target="_blank" href="{{route('admin.customer.login', $user->id)}}" class="btn btn-sm btn-success">Login</a>
                                                </td>
                                                <td>{{price($row->team_invest)}}</td>
                                                <td>{{price($task->bonus)}}</td>
                                                <td>{{$row->team_size}}</td>
                                                <td>
                                                    @if($row->status == 'approved')
                                                        <span class="text-success">{{$row->status}}</span>
                                                    @elseif($row->status == 'rejected')
                                                        <span class="text-danger">{{$row->status}}</span>
                                                    @else
                                                        <span style="color: #ee9a0b">{{$row->status}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('admin.task.request.status', [$row->id,'approved'])}}" class="btn btn-success">Approved</a>
                                                    <a href="{{route('admin.request.status', [$row->id,'rejected'])}}" class="btn btn-danger">Rejected</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


