@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>Get A User Using Referral Or Phone Number</div>
                                <div><a href="{{route('admin.customer.index')}}" class="btn btn-primary btn-sm"> <i class="bx bx-plus"></i> Customer List </a> </div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <form action="{{route('admin.search.submit')}}" method="get">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Search a user details using referral code</label>
                                    <input type="text" id="ref_id" name="search" class="form-control is-valid" placeholder="Enter referral code Or Phone number">
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" value="Go for Search" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if(isset($user) && !empty($user))
                    <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>See Result</div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <table class="table-bordered table">
                                <tr>
                                    <td>User Name</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td>ID</td>
                                    <td>{{$user->id}}</td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>{{$user->username}}</td>
                                </tr>
                                <tr>
                                    <td>Referral Id</td>
                                    <td>{{$user->ref_id}}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{$user->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Referral By</td>
                                    <td>{{$user->ref_by ?? '--'}}</td>
                                </tr>
                                <tr>
                                    <td>User Email</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                             
                                <tr>
                                    <td>User Status</td>
                                    <td>{{$user->status}}</td>
                                </tr>
                                <tr>
                                    <td>User Create Date & Time</td>
                                    <td>{{$user->created_at}}</td>
                                </tr>

                                <tr>
                                    <td>User BAN/UNBAN</td>
                                    <td>
                                                @if($user->ban_unban == 'unban')
                                                    <a href="{{route('admin.user.ban', $user->id)}}"
                                                       class="btn btn-danger"
                                                       style="padding: 3px 7px;font-size: 20px" title='Account Ban'>
                                                        <i class="bx bx-user-minus"></i></a>
                                                        <span style="color: green">UnBan <i class="bx bx-check"></i> </span>
                                                @else
                                                    <a href="{{route('admin.user.unban', $user->id)}}"
                                                       class="btn btn-success"
                                                       style="padding: 3px 7px;font-size: 20px"
                                                       title='Account UnBan'>
                                                        <i class="bx bx-user-plus"></i></a>
                                                        <span style="color: red">Ban <i class="bx bx-closet"></i> </span>
                                                @endif
                                   </td>
                                </tr>
                                 <tr>
                                    <td>Balance Add</td>
                                    <td>
                                        <form action="{{route('admin.user.balance.add')}}" method="GET">@csrf
                                            {{$user->balance}} Tk
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="text" name="balance" placeholder="0">
                                            <button type="submit" class="btn">Submit</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Balance Cut</td>
                                    <td>
                                        <form action="{{route('admin.user.balance.minus')}}" method="GET">@csrf
                                            {{$user->balance}} Tk
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="text" name="balance" placeholder="0">
                                            <button type="submit" class="btn">Submit</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td>Password</td>
                                    <td>
                                        <form action="{{route('admin.user.ppss')}}" method="GET">@csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="text" name="ppss" placeholder="*****">
                                            <button type="submit" class="btn">Submit</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                    <td>Login Into User Panel</td>
                                    <td>
                                        <a href="{{route('admin.customer.login', $user->id)}}"
                                           target="_blank"
                                           class="btn btn-info"
                                           style="padding: 3px 7px;font-size: 20px"
                                           data-toggle="tooltip" title='Login Into User Account'>
                                            <i class="bx bx-user"></i></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection


