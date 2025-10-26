@php use Illuminate\Support\Facades\Auth; @endphp
<body>
<div class="container-fluid p-0">
    <div class="topbar">
        <a class="text-decoration-none text-success" href={{url('/')}}>
            <div class="fw-bold fs-3" style="font-family: 'Arial Black', Arial, sans-serif; margin: 0 30px;">POS System
            </div>
        </a>

        <div class="d-flex align-items-center">
            <form method="POST" action="{{ route('logout') }}" class="me-3">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

            @if(Auth::check())
                @php $user = Auth::user(); @endphp

                <img src="{{ asset('assets/image/' . ($user->image ?? 'default.jpg')) }}"
                     style="width: 50px; height: 50px"
                     class="rounded-circle me-2"
                     alt="{{ $user->name }}">

                <strong>{{ $user->user_name }}</strong>
            @endif
        </div>
    </div>
