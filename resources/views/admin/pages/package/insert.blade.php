@extends('admin.partials.master')
@section('admin_content')
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.package.insert') }}" method="POST" enctype="multipart/form-data">@csrf
                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">{{ $data ? 'Update' : 'Create New' }} Package</h4>
                        <a href="{{ route('admin.package.index') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-left-arrow"></i> Package List
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-6 mb-2">
                                <label>Package Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $data->name ?? '') }}" required>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title', $data->title ?? '') }}" required>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" value="{{ old('price', $data->price ?? '') }}" step="0.01" required>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>Validity (Days)</label>
                                <input type="number" class="form-control" name="validity" value="{{ old('validity', $data->validity ?? '') }}" required>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>Commission (Average)</label>
                                <input type="number" class="form-control" name="commission_with_avg_amount" value="{{ old('commission_with_avg_amount', $data->commission_with_avg_amount ?? '') }}" step="0.01" required>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>VIP Level (1 - 10)</label>
                                <input type="number" class="form-control" name="vip_level" min="1" max="10" value="{{ old('vip_level', $data->vip_level ?? 1) }}" required>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>Min Purchase Limit</label>
                                <input type="number" class="form-control" name="min_purchase_limit" value="{{ old('min_purchase_limit', $data->min_purchase_limit ?? 1) }}" required>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>Max Purchase Limit</label>
                                <input type="number" class="form-control" name="max_purchase_limit" value="{{ old('max_purchase_limit', $data->max_purchase_limit ?? 10) }}" required>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>Category</label>
                                <select class="form-control" name="category" required>
                                    <option value="fixed" {{ old('category', $data->category ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    <option value="welfare" {{ old('category', $data->category ?? '') == 'welfare' ? 'selected' : '' }}>Welfare</option>
                                    <option value="activity" {{ old('category', $data->category ?? '') == 'activity' ? 'selected' : '' }}>Activity</option>
                                </select>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label>Photo (200x200px)</label>
                                <input type="file" class="form-control" name="photo" onchange="showPreview(event)">
                                <small>Required if new</small>
                                <div class="mt-2">
                                    <img id="file-ip-1-preview" src="{{ $data ? asset(view_image($data->photo)) : asset(not_found_img()) }}" width="100" height="100" class="rounded" />
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <label>Description</label>
                                <textarea class="form-control" name="desc" rows="4">{{ old('desc', $data->desc ?? '') }}</textarea>
                            </div>

                            @if($data)
                            <div class="col-sm-4 mb-2">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <label>Sold Out</label>
                                <select name="is_sold_out" class="form-control">
                                    <option value="0" {{ $data->is_sold_out == 0 ? 'selected' : '' }}>Available</option>
                                    <option value="1" {{ $data->is_sold_out == 1 ? 'selected' : '' }}>Sold Out</option>
                                </select>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <label>Is Resale</label>
                                <select name="is_resale" class="form-control">
                                    <option value="0" {{ $data->is_resale == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $data->is_resale == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="card mt-2">
                    <div class="card-body d-flex justify-content-between">
                        <h6>Submit Package</h6>
                        <button type="submit" class="btn btn-success">
                            <i class="bx bx-save"></i> {{ $data ? 'Update' : 'Submit' }}
                        </button>
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
