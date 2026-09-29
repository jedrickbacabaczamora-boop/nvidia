@extends('admin.partials.master')
@section('admin_content')
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title d-flex justify-content-between">
                        <div>{{ $title }} Lists</div>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>User Info</th>
                                        <th>Comment & Photo</th>
                                        <th>Reward</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proofs as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <small>
                                                    Username: {{ $row->user->username ?? '--' }} <br>
                                                    Ref ID: {{ $row->user->ref_id ?? '--' }}
                                                </small>
                                            </td>
                                            <td>
                                                <small>{{ $row->comment }}</small><br>
                                                @if($row->photo)
                                                    <img src="{{ asset('storage/' . $row->photo) }}" width="80" class="mt-1" />
                                                @endif
                                            </td>
                                            <td>₦{{ $row->reward_amount }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($row->status == 'approved') badge-success 
                                                    @elseif($row->status == 'rejected') badge-danger 
                                                    @else badge-warning 
                                                    @endif" style="font-size: 10px">
                                                    {{ ucfirst($row->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($row->status == 'pending')
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#actionModal{{ $row->id }}" class="btn btn-success btn-sm">Action</a>

                                                    <!-- Modal -->
                                                    <form action="{{ route('admin.withdraw.proofs.status', $row->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal fade" id="actionModal{{ $row->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Change Proof Status</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Status</label>
                                                                            <select name="status" class="form-control" required>
                                                                                <option value="approved">Approved</option>
                                                                                <option value="rejected">Rejected</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                    <div class="text-muted">Action Taken</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Pagination (if you use paginate() in controller) --}}
                            {{-- {{ $proofs->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
