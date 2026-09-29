@extends('admin.partials.master')
@section('admin_content')
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title">
                        <div class="d-flex justify-content-between">
                            <div>Package List</div>
                            <div>
                                <a href="{{ route('admin.package.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bx bx-plus"></i> Add New Item
                                </a>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Validity</th>
                                        <th>Commission</th>
                                        <th>VIP</th>
                                        <th>Min Limit</th>
                                        <th>Max Limit</th>
                                        <th>Category</th>
                                        <th>Sold Out</th>
                                        <th>Resale</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packages as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>
                                                <img src="{{ asset(view_image($row->photo)) }}" width="40" alt="Photo">
                                            </td>
                                            <td>{{ number_format($row->price, 2) }}</td>
                                            <td>{{ $row->validity }} days</td>
                                            <td>{{ number_format($row->commission_with_avg_amount, 2) }}</td>
                                            <td>VIP {{ $row->vip_level }}</td>
                                            <td>{{ $row->min_purchase_limit }}</td>
                                            <td>{{ $row->max_purchase_limit }}</td>
                                            <td>{{ ucfirst($row->category) }}</td>
                                            <td>
                                                @if($row->is_sold_out)
                                                    <span class="badge badge-danger">Sold Out</span>
                                                @else
                                                    <span class="badge badge-success">Available</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($row->is_resale)
                                                    <span class="badge badge-info">Resale</span>
                                                @else
                                                    <span class="badge badge-secondary">Normal</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($row->status == 'active')
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.package.view', $row->id) }}"
                                                   class="btn btn-info btn-sm" data-toggle="tooltip" title="View">
                                                    <i class="bx bx-show"></i>
                                                </a>

                                                <a href="{{ route('admin.package.create', $row->id) }}"
                                                   class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                @if($row->id != 1)
                                                    <form action="{{ route('admin.package.delete', $row->id) }}"
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm delete_confirm"
                                                                data-toggle="tooltip" title="Delete">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                        @include('admin.partials.delete-confirmation')
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(count($packages) == 0)
                                <div class="text-center py-2">No package found.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
