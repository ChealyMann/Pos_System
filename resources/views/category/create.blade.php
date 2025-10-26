@extends('layout.master')

@section('title', 'create')

@section('content')
    <div class="col-lg-10 col-md-10 px-5 py-4" style="background:#e0e0e0; min-height:100vh;">
        <div class="bg-light rounded-3 p-5" style="min-height:80vh;">
            <div class="mb-4 d-flex align-items-center">
                <a href="{{ url('/category') }}" class="btn btn-link fs-2 me-3" style="color:#444;"><i
                        class="bi bi-arrow-left-circle"></i>
                </a>
                <h3 class="fw-bold mb-0">Add Category</h3>
            </div>
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Category Name</label>
                        <input type="text" name="name" class="form-control bg-white" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <div class="d-flex align-items-center gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="active" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="inactive">
                                <label class="form-check-label">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <div class="col mb">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control bg-white"></textarea>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn"
                            style="background:#137844; color:#fff; font-size:1.3rem; border-radius:8px; min-width:300px; font-weight:500;">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </body>

    </html>
@endsection
