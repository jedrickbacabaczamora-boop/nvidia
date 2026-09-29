@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>{{$title}} Payment Lists</div>
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
                                        <th>User</th>
                                        <th>OPTR</th>
                                        <th>TRX</th>
                                        <th>Amounts</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Active</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $key => $row)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <form action="{{route('admin.search.submit')}}" method="get">
                                                    @csrf
                                                    <input type="hidden" id="search" name="search" class="form-control is-valid" value="{{$row->user->phone}}">
                                                    <input type="submit" value="{{$row->user->phone}}">
                                                </form>
                                            </td>
                                            <td>
                                                {{$row->method_name}}
                                            </td>
                                            <td>
                                                {{$row->transaction_id}}
                                            </td>
                                            <td>
                                                {{price($row->final_amount)}}
                                            </td>
                                            <td>
                                                <a href="{{asset($row->photo)}}" target="_blank">
                                                    <img src="{{asset($row->photo)}}" style="width: 150px;height: 150px;" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge @if($row->status == 'pending') badge-warning @elseif($row->status == 'approved') badge-success  @elseif($row->status == 'rejected') badge-danger @endif" style="font-size: 8px">{{$row->status}}</span>
                                            </td>
                                            <td>
                                                @if($row->status == 'pending')
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal{{$row->id}}" class="btn btn-success">Action</a>
                                                    <form action="{{route('payment.status.change', $row->id)}}" method="POST">@csrf
                                                        <div class="modal fade" id="myModal{{$row->id}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Action for payment</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="status">Status <small class="text-info">When you select approved. balance will be added in user balance</small> </label>
                                                                            <select name="status" required id="status" class="form-control">
                                                                                <option value="approved" @if($row->status == 'approved') selected @endif>Approved</option>
                                                                                <option value="rejected" @if($row->status == 'rejected') selected @endif>Rejected</option>
                                                                                <option value="pending" @if($row->status == 'pending') selected @endif>Pending</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <input type="submit" value="Submit" class="btn btn-primary">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                    <div class="text-info">Already push a action</div>
                                                @endif
                                                    <a href="{{route('admin.customer.login', $row->id)}}"
                                                       target="_blank"
                                                       class="btn btn-info"
                                                       style="padding: 3px 7px;font-size: 20px"
                                                       data-toggle="tooltip" title='Login Into User Account'>
                                                        <i class="bx bx-user"></i></a>
                                            </td>
                                        </tr>
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


