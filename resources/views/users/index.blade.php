@extends('layout.master')
@section('title', 'User Management')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">

        {{-- Header bar --}}
        <div class="bg-light rounded-3 p-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0">User</h4>
                <a href="{{ url('user/create') }}" class="btn btn-success px-4 py-2"
                   style="border-radius:8px;font-weight:500;">
                    <i class="bi bi-plus-lg me-2"></i>Add New User
                </a>
            </div>
        </div>

        {{-- User cards --}}
        <div class="row g-3">
            @foreach($users as $user)
{{--                @if(Auth::id() != $user->user_id)--}}
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">

                            {{-- user image --}}
                            <a href="{{ route('user.show', $user->user_id) }}">
                                <img src="{{ $user->image
                                ? asset('assets/image/'.$user->image)
                                : asset('assets/image/default-user.jpg') }}"
                                     alt="{{ $user->user_name }}"
                                     class="rounded-circle img-fluid"
                                     style="width:100px; height:100px; object-fit:cover;">
                            </a>

                            {{-- user info --}}
                            <div class="flex-grow-1">
                                <div class="small text-muted mb-1">#{{ $user->usercode }}</div>
                                <div class="fw-bold" style="font-size:1.15rem;">{{ $user->user_name }}</div>
                                <div class="text-muted" style="font-size:0.97rem;">{{ $user->email }}</div>
                                <div class="text-muted" style="font-size:0.97rem;">{{ $user->phone_number }}</div>
                                <div class="mt-2">
                                    <a href="{{ url('user/'.$user->user_id.'/edit') }}" class="btn btn-outline-success btn-sm me-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $user->user_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-outline-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                @endif--}}
            @endforeach
        </div>

    </div>
@endsection

