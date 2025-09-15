@extends('layout.master')
@section('title', 'Product Management')

@section('content')
<div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
    <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h4 class="fw-bold mb-0">Role List</h4>
            <button type="button" class="btn btn-success px-4 py-2" style="border-radius:8px;font-weight:500;"
                data-bs-toggle="modal" data-bs-target="#addStockModal">
                <i class="bi bi-plus-lg me-2"></i>New Role
            </button>
        </div>
    </div>

    <div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background:#e4e4e4; border-radius:32px; min-width:900px; padding:20px;">
                <div class="modal-header justify-content-between" style="border:none; padding-bottom:0;">
                    <h5 class="modal-title fw-bold" id="addStockModalLabel">New Role</h5>
                    <button type="button"
                        style="background:#fff; border:none; font-size:1.5rem; border-radius:50%; width:36px; height:36px; display:flex; align-items:center; justify-content:center; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:background 0.2s;"
                        data-bs-dismiss="modal" aria-label="Close" onmouseover="this.style.background='#eee'"
                        onmouseout="this.style.background='#fff'">&#10006;</button>
                </div>
                <form action="{{ url('role/store') }}" method="POST">
                    @csrf
                    <div class="modal-body" style="padding-top:0;">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="role_name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name" value="#"
                                    required style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required
                                    style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
                            </div>
                            <div class="col-md-6">
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
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn"
                                style="background:#176c46; color:#fff; min-width:220px; border-radius:6px; font-weight:500; font-size:1.1rem; padding:10px 0; box-shadow:0 2px 8px rgba(23,108,70,0.08);">Crete Role</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-light rounded-3 p-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Role ID</th>
                        <th>Role Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row, repeat as needed -->
                    <tr>
                        <td>231</td>
                        <td>Freppe Coffee</td>
                        <td>Freppe Coffee</td>
                        <td>
                            <span class="badge bg-danger" style="font-size:1rem; border-radius:8px;">Inactive</span>
                        </td>
                        <td>
                            <button class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i>
                                Edit</button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                                Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat above <tr> for more products -->
                    <tr>
                        <td>233</td>
                        <td>Freppe Coffee</td>
                        <td>Freppe Coffee</td>
                        <td>
                            <span class="badge bg-success" style="font-size:1rem; border-radius:8px;">Active</span>
                        </td>
                        <td>
                            <button class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i>
                                Edit</button>
                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                                Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>
@endsection
