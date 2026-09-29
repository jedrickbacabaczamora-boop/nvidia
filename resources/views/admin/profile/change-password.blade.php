@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            @if(session()->has('success'))
                                                <div class="alert alert-success" style="padding: 10px 1.267rem">{{session()->get('success')}}</div>
                                            @endif
                                            @if(session()->has('error'))
                                                <div class="alert alert-danger" style="padding: 10px 1.267rem">{{session()->get('error')}}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <form action="{{route('admin.changepasswordsubmit')}}" method="post" enctype="multipart/form-data">@csrf
                                        <div class="form-group">
                                            <label for="old_password">Admin Current Password</label>
                                            <input type="password" oninput="checkPassword(this.value)" name="old_password" class="form-control is-valid" id="old_password" required value="">
                                            <div class="valid-feedback" id="pointer" style="display: none">
                                                <i class="bx bx-radio-circle"></i>
                                                <span id="show_status"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password">Admin New Password</label>
                                            <input type="password" name="new_password" class="form-control is-valid" id="new_password" required value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm_password">Admin Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control is-valid" id="confirm_password" required value="">
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-success" type="submit">Update Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function checkPassword(value)
        {
            var URL = '{{route('admin.check.password')}}'
            fetch(URL, {
                method: 'post',
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": csrf()
                },
                body: JSON.stringify({password: value})
            }).then(function(response){
                return response.json();
            })  .then(function(res){
                document.getElementById('pointer').style.display = 'block'
                var statusViewer = document.getElementById('show_status');
                if (res.status===false) {
                    statusViewer.innerHTML = `<span class="danger">${res.message}</span>`
                }else {
                    statusViewer.innerHTML = `<span class="success">${res.message}</span>`
                }
            })
            .catch(function(error){

            });
        }
    </script>
@endsection


