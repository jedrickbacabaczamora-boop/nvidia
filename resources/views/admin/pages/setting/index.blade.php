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
                <form action="{{route('admin.setting.insert')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input type="hidden" name="id" value="{{$data ? $data->id : ''}}">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div>{{$data ? 'Update' : 'Create New'}} Settings</div>
                                </div>
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-12 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <fieldset class="form-group">
                                                    <label for="basicInputFile">Upload Photo <small>{Suggestion:
                                                            size 200X200(px)}</small> </label>
                                                    <div class="custom-file">
                                                        <input type="file" name="logo"
                                                               class="custom-file-input is-valid" id="inputGroupFile01"
                                                               @if(!$data) required
                                                               @else @endif onchange="showPreview(event)">
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose
                                                            file</label>
                                                        <div class="valid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            Note: Logo image mandatory
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="image_preview">
                                                    <img
                                                        src="{{$data ? asset(view_image($data->logo)) :  asset(not_found_img())}}"
                                                        id="file-ip-1-preview" class="rounded" alt="Preview Image"
                                                        style="width: 100px;height: 100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="withdraw_notes">Withdraw charge%</label>
                                                <input type="number" class="form-control is-valid"
                                                       name="withdraw_charge" id="withdraw_charge"
                                                       placeholder="Withdraw charge"
                                                       value="{{$data ? $data->withdraw_charge : old('withdraw_charge')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="minimum_recharge">Minimum Recharge</label>
                                                <input type="number" class="form-control is-valid"
                                                       name="minimum_recharge" id="minimum_recharge"
                                                       placeholder="Minimum Recharge"
                                                       value="{{$data ? $data->minimum_recharge : old('minimum_recharge')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="maximum_recharge">Maximum Recharge</label>
                                                <input type="number" class="form-control is-valid"
                                                       name="maximum_recharge" id="maximum_recharge"
                                                       placeholder="Maximum Recharge"
                                                       value="{{$data ? $data->maximum_recharge : old('maximum_recharge')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="minimum_withdraw">Minimum Withdraw</label>
                                                <input type="number" class="form-control is-valid"
                                                       name="minimum_withdraw" id="minimum_withdraw"
                                                       placeholder="Minimum Withdraw"
                                                       value="{{$data ? $data->minimum_withdraw : old('minimum_withdraw')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="maximum_withdraw">Maximum Withdraw</label>
                                                <input type="number" class="form-control is-valid"
                                                       name="maximum_withdraw" id="maximum_withdraw"
                                                       placeholder="Maximum Withdraw"
                                                       value="{{$data ? $data->maximum_withdraw : old('maximum_withdraw')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="site_title">Withdraw Switch</label>
                                                <select class="form-control" name="w_time_status">
                                                    <option value="active" @if($data->w_time_status == 'active') selected @endif>START</option>
                                                    <option value="inactive" @if($data->w_time_status == 'inactive') selected @endif>OFF</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is required
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="checkin">Daily Checkin Amount</label>
                                                <input type="number" class="form-control is-valid"
                                                       name="checkin" id="checkin"
                                                       placeholder="Daily Checkin"
                                                       value="{{$data ? $data->checkin : old('checkin')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="registration_bonus">registration_bonus</label>
                                                <input type="number" class="form-control is-valid"
                                                       name="registration_bonus" id="registration_bonus"
                                                       placeholder="registration_bonus"
                                                       value="{{$data ? $data->registration_bonus : old('registration_bonus')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="telegram">telegram</label>
                                                <input type="text" class="form-control is-valid"
                                                       name="telegram" id="telegram"
                                                       placeholder="telegram"
                                                       value="{{$data ? $data->telegram : old('telegram')}}">
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    Note: This is filed is optional
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="channel">channel</label>
                                                <input type="text" class="form-control is-valid"
                                                       name="channel" id="channel"
                                                       placeholder="channel"
                                                       value="{{$data ? $data->channel : old('channel')}}">
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

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="total_member_register_reword">Total Member Register Reword</label>
                                    <input type="number" class="form-control is-valid"
                                           name="total_member_register_reword" id="total_member_register_reword"
                                           placeholder="Total Member Register Reword"
                                           value="{{$data ? $data->total_member_register_reword : old('total_member_register_reword')}}">
                                    <div class="valid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        Note: This is filed is optional
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="total_member_register_reword_amount">Total Member Register Reword Amount</label>
                                    <input type="number" class="form-control is-valid"
                                           name="total_member_register_reword_amount" id="total_member_register_reword_amount"
                                           placeholder="Total Member Register Reword Amount"
                                           value="{{$data ? $data->total_member_register_reword_amount : old('total_member_register_reword_amount')}}">
                                    <div class="valid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        Note: This is filed is optional
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>               
                                     <div class="form-group col-sm-6 mt-2">
                                    <label for="">Open Deposit</label>
                                    <select name="open_deposit"  class="form-control form-control-lg">
                                        <option value="1" @if($data->open_deposit == 1) selected @endif>Yes</option>
                                        <option value="0" @if($data->open_deposit == 0) selected @endif>No</option>

                                    </select>
                                </div>

                                <div class="form-group col-sm-6 mt-2">
                                    <label for="">Open Payout</label>
                                    <select name="open_transfer"  class="form-control form-control-lg">
                                        <option value="1" @if($data->open_transfer == 1) selected @endif>Yes</option>
                                        <option value="0" @if($data->open_transfer == 0) selected @endif>No</option>

                                    </select>
                                </div>

                                <div class="form-group col-sm-6 mt-2">
                                    <label for="">Auto Deposit</label>
                                    <select name="auto_deposit"  class="form-control form-control-lg">
                                        <option value="1" @if($data->auto_deposit == 1) selected @endif>Enabled</option>
                                        <option value="0" @if($data->auto_deposit == 0) selected @endif>Disabled</option>

                                    </select>
                                </div>

                                <div class="form-group col-sm-6 mt-2">
                                    <label for="">Auto Payout</label>
                                    <select name="auto_transfer"  class="form-control form-control-lg">
                                        <option value="1" @if($data->auto_transfer == 1) selected @endif>Enabled</option>
                                        <option value="0" @if($data->auto_transfer == 0) selected @endif>Disabled</option>

                                    </select>
                                </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Auto Default Payout Method</label>
                                        <select name="auto_transfer_default"  class="form-control is-valid" require>
                                            @foreach($paymentMethod as $method)
                                                <option value="{{ $method['tag'] }}" @if($data->auto_transfer_default ==$method['tag']) selected @endif>{{ $method['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div style="margin-top: .7rem !important">
                                        Submit Your Setting Information
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
        function calculateHour(_this){
            document.getElementById('hours').value = _this.value * 24
        }
    </script>
@endsection
