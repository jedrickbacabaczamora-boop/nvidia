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
                                    <div class="text-center">
                                        <img src="@if(admin()->user()->photo) {{asset(admin()->user()->photo)}} @else {{asset(not_found_img())}} @endif" class="rounded" id="file-ip-1-preview" alt="group image" height="120" width="120">
                                    </div>
                                    <form action="{{route('admin.profile.update-submit')}}" method="post" enctype="multipart/form-data">@csrf
                                        <div class="form-group">
                                            <fieldset class="form-group">
                                                <label for="basicInputFile">Admin Profile Photo</label>
                                                <div class="custom-file">
                                                    <input type="file" name="photo" class="custom-file-input is-valid" id="inputGroupFile01" onchange="showPreview(event)">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Admin Name</label>
                                            <input type="text" name="name" class="form-control is-valid" id="name" required value="{{admin()->user()->name ?? ''}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Admin Email <small>(This email for login to your admin panel)</small></label>
                                            <input type="email" name="email" class="form-control is-valid" required id="email" value="{{admin()->user()->email ?? ''}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Admin Phone</label>
                                            <input type="text" name="phone" class="form-control is-valid" required id="phone" value="{{admin()->user()->phone ?? ''}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Admin Address</label>
                                            <input type="text" name="address" class="form-control is-valid" id="address" value="{{admin()->user()->address ?? ''}}">
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-success" type="submit">Update Information</button>
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
@endsection


