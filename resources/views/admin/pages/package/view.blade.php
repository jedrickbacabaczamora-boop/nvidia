@extends('admin.partials.master')

@section('admin_content')
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title d-flex justify-content-between">
                        <span>Package Details</span>
                        <a href="{{ route('admin.package.index') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-list-ul"></i> Package List
                        </a>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Package Name</th>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td>{{ $data->title }}</td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td>
                                        <img src="{{ asset(view_image($data->photo)) }}" width="80" class="rounded" alt="Package Image">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ price($data->price) }}</td>
                                </tr>
                                <tr>
                                    <th>Validity</th>
                                    <td>{{ $data->validity }} days</td>
                                </tr>
                                <tr>
                                    <th>Commission w/ Avg Amount</th>
                                    <td>{{ price($data->commission_with_avg_amount) }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ ucfirst($data->category) }}</td>
                                </tr>
                                <tr>
                                    <th>VIP Level</th>
                                    <td>VIP {{ $data->vip_level }}</td>
                                </tr>
                                <tr>
                                    <th>Min Purchase Limit</th>
                                    <td>{{ $data->min_purchase_limit }}</td>
                                </tr>
                                <tr>
                                    <th>Max Purchase Limit</th>
                                    <td>{{ $data->max_purchase_limit }}</td>
                                </tr>
                                <tr>
                                    <th>Is Default</th>
                                    <td>{{ $data->is_default == '1' ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Is Sold Out</th>
                                    <td>
                                        @if($data->is_sold_out)
                                            <span class="badge badge-danger">Sold Out</span>
                                        @else
                                            <span class="badge badge-success">Available</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Is Resale</th>
                                    <td>
                                        @if($data->is_resale)
                                            <span class="badge badge-info">Resale Package</span>
                                        @else
                                            <span class="badge badge-secondary">Normal</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($data->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{!! nl2br(e($data->desc)) !!}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $data->created_at ? $data->created_at->format('d M Y h:i A') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $data->updated_at ? $data->updated_at->format('d M Y h:i A') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
@endsection
