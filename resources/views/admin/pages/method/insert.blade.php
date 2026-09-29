@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.method.insert')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input type="hidden" name="id" value="{{$data ? $data->id : ''}}">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div>{{$data ? 'Update' : 'Create New'}} Payment-method</div>
                                    <div>
                                        <a href="{{route('admin.method.index')}}" class="btn btn-primary btn-sm"> <i
                                                class="bx bx-left-arrow"></i> Method List</a>
                                    </div>
                                </div>
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <div class="row">
                                            <div class="col-sm-12 mt-2">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="basicInputFile">Upload photo <small>{Suggestion:
                                                                    size 80X80(px)}</small> </label>
                                                            <div class="custom-file">
                                                                <input type="file" name="photo"
                                                                       class="custom-file-input is-valid"
                                                                       id="inputGroupFile01"
                                                                       @if(!$data) required
                                                                       @else @endif onchange="showPreview(event)">
                                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                                    file</label>
                                                                <div class="valid-feedback">
                                                                    <i class="bx bx-radio-circle"></i>
                                                                    Note: photo image mandatory
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="image_preview">
                                                            <img
                                                                src="{{$data ? asset(view_image($data->photo)) :  asset(not_found_img())}}"
                                                                id="file-ip-1-preview" class="rounded"
                                                                alt="Preview Image"
                                                                style="width: 100px;height: 100px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="name">Method Name</label>
                                        <input type="text" class="form-control is-valid"
                                               name="name" id="name"
                                               placeholder="Name" value="{{$data ? $data->name : old('name')}}" required>
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is required
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="address">Method address</label>
                                        <input type="text" class="form-control is-valid"
                                               name="address" id="address"
                                               placeholder="address" value="{{$data ? $data->address : old('address')}}" required>
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is required
                                        </div>
                                    </div>
                                    @if($parameters && $parameters->count()  != 0 )
                                        @foreach($parameters as $key => $param)
                                            <div class="col-sm-6">
                                                <label for="global[{{ $key }}]">{{ __($param->title) }}</label>
                                                <input type="text" class="form-control is-valid"
                                                    name="global[{{ $key }}]" id="global[{{ $key }}]"
                                                    placeholder="Enter" value="{{$param ? $param->value : old($param->value)}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is required
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif



                                    @if($data)
                                        <div class="col-sm-12">
                                            <label for="recharge_charge">Status</label>
                                            <select name="status" id="status" class="form-control is_valid">
                                                <option value="">Select status</option>
                                                <option value="active" @if($data->status == 'active') selected @endif>Active</option>
                                                <option value="inactive" @if($data->status == 'inactive') selected @endif>In-Active</option>
                                            </select>
                                        </div>
                                    @endif 

                                </div>
                               <!-- @if($data)
                                        <div class="col-sm-12">
                                            <label for="recharge_charge">Status</label>
                                            <select name="status" id="status" class="form-control is_valid">
                                                <option value="">Select status</option>
                                                <option value="active" @if($data->status == 'active') selected @endif>Active</option>
                                                <option value="inactive" @if($data->status == 'inactive') selected @endif>In-Active</option>
                                            </select>
                                        </div>
                                    @endif-->
                            </div>
                        </div>
                    </div>

                    <!-- Form Submit Button -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div style="margin-top: .7rem !important">
                                        Submit Your Payment-method Information
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
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
