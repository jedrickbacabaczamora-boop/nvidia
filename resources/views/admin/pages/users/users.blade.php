@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>Customers Lists</div>
                                <div>
                                    <a href="{{route('admin.search.user')}}" class="btn btn-success"><i class="bx bx-user"></i> Search A User</a>
                                </div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="mes">

                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped dataex-html5-selectors">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Photo</th>
                                        <th>Referred by</th>
                                        <th>Referral id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Active VIPs</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Ban/UnBan</th>
                                        <th>Active</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $row)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <a href="{{asset($row->photo ? view_image($row->photo) : not_found_img())}}"
                                                   target="_blank">
                                                    <img width="40"
                                                         src="{{asset($row->photo ? view_image($row->photo) : not_found_img())}}"
                                                         alt="Package Photo">
                                                </a>
                                            </td>
                                            <td>{{$row->ref_by ?? 'Not Use'}}</td>
                                            <td>{{$row->ref_id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->phone}}</td>
                                            <td>
                                                @foreach(my_vips() as $id)
                                                    <div class="badge badge-secondary">
                                                        {{\App\Models\Package::find($id)->name ?? '---'}}
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>{{number_format($row->balance, 2)}}</td>
                                            <td>{{$row->status}}</td>
                                            <td>
                                                @if($row->ban_unban == 'unban')
                                                    <a href="{{route('admin.user.ban', $row->id)}}"
                                                       class="btn btn-danger"
                                                       style="padding: 3px 7px;font-size: 20px" title='Account Ban'>
                                                        <i class="bx bx-user-minus"></i></a>
                                                        <span style="color: green">UnBan <i class="bx bx-check"></i> </span>
                                                @else
                                                    <a href="{{route('admin.user.unban', $row->id)}}"
                                                       class="btn btn-success"
                                                       style="padding: 3px 7px;font-size: 20px"
                                                       title='Account UnBan'>
                                                        <i class="bx bx-user-plus"></i></a>
                                                        <span style="color: red">Ban <i class="bx bx-closet"></i> </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-danger"
                                                   style="padding: 3px 7px;font-size: 20px"
                                                   data-target="#bonusModal{{$row->id}}"
                                                   data-toggle="modal" title='Bonus Gift'>
                                                    <i class="bx bx-gift"></i></a>

                                                <a href="{{route('admin.customer.login', $row->id)}}"
                                                   target="_blank"
                                                   class="btn btn-info"
                                                   style="padding: 3px 7px;font-size: 20px"
                                                   data-toggle="tooltip" title='Login Into User Account'>
                                                    <i class="bx bx-user"></i></a>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-primary"
                                                   data-target="#myModal{{$row->id}}"
                                                   style="padding: 3px 7px;font-size: 20px"
                                                   data-toggle="modal" title='Change Password'>
                                                    <i class="bx bx-lock"></i></a>

                                                <a href="{{route('admin.customer.status', $row->id)}}"
                                                   class="btn @if($row->status == 'active') btn-success @else btn-danger @endif"
                                                   style="padding: 3px 7px;font-size: 20px"
                                                   data-toggle="tooltip"
                                                   title='@if($row->status == 'active') User status inactive after click @else User status active after click @endif'>
                                                    <i class="bx @if($row->status == 'active') bx-up-arrow @else bx-down-arrow @endif"></i></a>
                                            </td>
                                        </tr>

                                        <form action="javascript:void(0)" method="POST">@csrf
                                            <div class="modal fade" id="myModal{{$row->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Set New Password</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="password">Password </label>
                                                                <input name="password" id="password" class="form-control is-valid" placeholder="Set User Password Again">
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <input type="submit" value="Submit" onclick="resetPassword('{{$row->id}}')" class="btn btn-primary">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                        <form action="javascript:void(0)" method="POST">@csrf
                                            <div class="modal fade" id="bonusModal{{$row->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Gift a bonus</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="bonus">Enter bonus code </label>
                                                                <input type="text" name="bonus" id="bonus" required class="form-control is-valid" placeholder="Bonus code">
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <input type="submit" value="Submit" onclick="submitBonus('{{$row->id}}')" class="btn btn-primary">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endforeach
                                </table>
                                {{$users->links("pagination::bootstrap-4")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
        function submitBonus(id)
        {
            var bonus = document.getElementById('bonus').value;
            console.log(bonus)
            var data = {
                id: id,
                bonus: bonus
            }
            fetch('{{route('admin.customer.bonus')}}',
                {
                    method:"POST",
                    body:JSON.stringify(data),
                    headers: {'Content-type': 'application/json; charset=UTF-8', 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
                .then(response => response.json())
                .then(data => {
                    if (data.status === true){
                        document.querySelector('.mes').innerHTML = `<div class="alert alert-success">${data.message}</div>`
                        document.querySelector('#bonusModal'+id).style.display = 'none'
                        document.querySelector('.modal-backdrop.show').style.display = 'none'
                    }else {
                        document.querySelector('.mes').innerHTML = `<div class="alert alert-success">Something went wrong</div>`
                    }
                }).catch();
        }
    </script>


    <script>
        function resetPassword(id)
        {
            var password = document.querySelector('input[name="password"]').value;
            var data = {
                id: id,
                password: password
            }
            fetch('{{route('admin.customer.change-password')}}',
                {
                    method:"POST",
                    body:JSON.stringify(data),
                    headers: {'Content-type': 'application/json; charset=UTF-8', 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
                .then(response => response.json())
                .then(data => {
                    if (data.status === true){
                        document.querySelector('.mes').innerHTML = `<div class="alert alert-success">${data.message}</div>`
                        window.location.reload();
                    }else {
                        document.querySelector('.mes').innerHTML = `<div class="alert alert-success">Something went wrong</div>`
                    }
                });
        }
    </script>
@endsection





