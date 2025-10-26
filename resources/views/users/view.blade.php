@extends('layout.master')
@section('title', 'User Details')

@section('content')
    <div class="col-lg-10 col-md-10 px-5 py-4" style="background:#f5f5f5; min-height:100vh;">

        <!-- Header -->
        <div class="d-flex align-items-center mb-4">
            <a href="{{ url('/user') }}" class="btn btn-light shadow-sm me-3">
                <i class="bi bi-arrow-left-circle fs-3"></i>
            </a>
            <h2 class="fw-bold mb-0">User Details</h2>
        </div>

        <!-- User Card -->
        <div class="bg-white rounded-4 shadow-sm p-4">
            <div class="row align-items-center">

                <!-- Profile Image -->
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <img src="{{ $user->image ? asset('assets/image/'.$user->image) : asset('assets/image/noprofile.png') }}"
                         alt="{{ $user->user_name }}"
                         class="rounded-circle shadow"
                         style="width:160px; height:160px; object-fit:cover; border:3px solid #e0e0e0;">
                </div>

                <!-- User Details -->
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold">User Code</label>
                            <p class="form-control bg-light rounded-pill">{{ $user->usercode }}</p>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold">Name</label>
                            <p class="form-control bg-light rounded-pill">{{ $user->user_name }}</p>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold">Email</label>
                            <p class="form-control bg-light rounded-pill">{{ $user->email }}</p>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold">Phone</label>
                            <p class="form-control bg-light rounded-pill">{{ $user->phone_number ?? '-' }}</p>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold">Gender</label>
                            <p class="form-control bg-light rounded-pill">{{ ucfirst($user->gender) ?? '-' }}</p>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold">Role</label>
                            <p class="form-control bg-light rounded-pill">{{ $user->role->role_name ?? '-' }}</p>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold">Status</label>
                            <p class="form-control bg-light rounded-pill">{{ ucfirst($user->status) }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
