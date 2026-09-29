@extends('admin.partials.master')
@section('admin_content')
    <style>
        label {
            text-transform: unset;
        }
    </style>
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.rebate.insert')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input type="hidden" name="id" value="{{$data ? $data->id : ''}}">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div>{{$data ? 'Update' : 'Create New'}} rebate Commission</div>
                                </div>
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="team_commission1">team_commission 1 (%)</label>
                                                <input type="text" class="form-control is-valid"
                                                       name="team_commission1" id="team_commission1"
                                                       placeholder="team_commission1"
                                                       value="{{$data ? $data->team_commission1 : old('team_commission1')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="team_commission2">team_commission 2 (%)</label>
                                                <input type="text" class="form-control is-valid"
                                                       name="team_commission2" id="team_commission2"
                                                       placeholder="team_commission2"
                                                       value="{{$data ? $data->team_commission2 : old('team_commission2')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="team_commission3">team_commission 3 (%)</label>
                                                <input type="text" class="form-control is-valid"
                                                       name="team_commission3" id="team_commission3"
                                                       placeholder="team_commission3"
                                                       value="{{$data ? $data->team_commission3 : old('team_commission3')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="interest_commission1">interest_commission 1 (%)</label>
                                                <input type="text" class="form-control is-valid"
                                                       name="interest_commission1" id="interest_commission1"
                                                       placeholder="interest_commission1"
                                                       value="{{$data ? $data->interest_commission1 : old('interest_commission1')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="interest_commission2">interest_commission 2 (%)</label>
                                                <input type="text" class="form-control is-valid"
                                                       name="interest_commission2" id="interest_commission2"
                                                       placeholder="interest_commission2"
                                                       value="{{$data ? $data->interest_commission2 : old('interest_commission2')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="interest_commission3">interest_commission 3 (%)</label>
                                                <input type="text" class="form-control is-valid"
                                                       name="interest_commission3" id="interest_commission3"
                                                       placeholder="interest_commission3"
                                                       value="{{$data ? $data->interest_commission3 : old('interest_commission3')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Form Submit Button -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div style="margin-top: .7rem !important">
                                        Submit Your Rebate Information
                                    </div>
                                    <div>
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bx bx-plus"></i>{{$data ? 'Update' : 'Submit'}} </button>
                                        </div>
                                    </div>
                                </div>
                            </h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreviewFavicon(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("favicon");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
