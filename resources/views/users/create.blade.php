@extends('layout.master')
@section('title', 'Add User')

@section('content')
    <div class="col-lg-10 col-md-10 px-5 py-4" style="background:#e0e0e0; min-height:100vh;">
        <div class="bg-light rounded-3 p-5" style="min-height:80vh;">
            <div class="mb-4 d-flex align-items-center">
                <a href="{{ url('/user') }}" class="btn btn-link fs-2 me-3" style="color:#444;">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                <h3 class="fw-bold mb-0">Add User</h3>
            </div>

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">

                    <!-- User Code -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">User Code</label>
                        <input type="text" name="usercode" value="{{ old('usercode') }}" class="form-control bg-white" required>
                    </div>

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="user_name" value="{{ old('user_name') }}" class="form-control bg-white" required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control bg-white" required>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control bg-white">
                    </div>

                    <!-- Password -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control bg-white" required>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Gender</label>
                        <div class="d-flex align-items-center gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <select name="role_id" class="form-select" required>
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                                    {{ $role->role_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Image</label>
                        <div class="d-flex align-items-center mt-2">
                            <img id="preview-image"
                                 src="{{ asset('assets/image/noprofile.png') }}"
                                 alt="User" class="rounded-circle"
                                 style="width:70px; height:70px; object-fit:cover; border:2px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,0.08);">

                            <input type="file" name="image" id="image-input"
                                   class="form-control ms-3" style="max-width:220px;">
                        </div>
                    </div>

                </div>

                <!-- Submit -->
                <div class="text-center mt-5">
                    <button type="submit" class="btn"
                            style="background:#137844; color:#fff; font-size:1.3rem; border-radius:8px; min-width:300px; font-weight:500;">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('image-input');
            if (imageInput) {
                imageInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        const previewURL = URL.createObjectURL(file);
                        document.getElementById('preview-image').src = previewURL;
                    }
                });
            }
        });
    </script>
@endsection
