@extends('layout.master')

@section('title','create')

@section('content')
<div class="col-lg-10 col-md-10 px-5 py-4" style="background:#e0e0e0; min-height:100vh;">
    <div class="bg-light rounded-3 p-5" style="min-height:80vh;">
        <div class="mb-4 d-flex align-items-center">
            <a href="{{url('/role')}}" class="btn btn-link fs-2 me-3" style="color:#444;"><i
                    class="bi bi-arrow-left-circle"></i>
            </a>
            <h3 class="fw-bold mb-0">Add Role</h3>
        </div>
        <form>
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Role Name</label>
                    <input type="text" class="form-control bg-white" />
                </div>

                <div class="col mb">
                    <label class="form-label fw-bold">Description</label>
                    <input type="textarea" class="form-control bg-white" />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <div class="d-flex align-items-center gap-4 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Status" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Status">
                            <label class="form-check-label">Inactive</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn"
                    style="background:#137844; color:#fff; font-size:1.3rem; border-radius:8px; min-width:300px; font-weight:500;">
                    Create User
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
