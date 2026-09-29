@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Submit Withdrawal Proof</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('proof.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="comment" class="form-label fw-semibold">Comment <small class="text-muted">(max 80 words)</small></label>
                            <textarea name="comment" id="comment" rows="4" class="form-control" required>{{ old('comment') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Upload Screenshot</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control" required>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">Submit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
