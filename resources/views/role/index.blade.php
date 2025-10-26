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
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="modal-body" style="padding-top:0;">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="role_name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name" required
                                    style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
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
                                        <input class="form-check-input" type="radio" name="status" value="active" checked>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="inactive">
                                        <label class="form-check-label">Inactive</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn"
                                style="background:#176c46; color:#fff; min-width:220px; border-radius:6px; font-weight:500; font-size:1.1rem; padding:10px 0; box-shadow:0 2px 8px rgba(23,108,70,0.08);">Crete
                                Role</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background:#e4e4e4; border-radius:32px; min-width:900px; padding:20px;">
                <div class="modal-header justify-content-between" style="border:none; padding-bottom:0;">
                    <h5 class="modal-title fw-bold" id="editStockModalLabel">Edit Role</h5>
                    <button type="button"
                        style="background:#fff; border:none; font-size:1.5rem; border-radius:50%; width:36px; height:36px; display:flex; align-items:center; justify-content:center; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:background 0.2s;"
                        data-bs-dismiss="modal" aria-label="Close" onmouseover="this.style.background='#eee'"
                        onmouseout="this.style.background='#fff'">&#10006;</button>
                </div>
                <form id="editRoleForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editRoleId" name="role_id">

                    <div class="modal-body" style="padding-top:0;">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="role_name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="editRoleName" name="role_name" required
                                    style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="editRoleDescription" name="description"
                                    required style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="d-flex align-items-center gap-4 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusActive"
                                            value="active">
                                        <label class="form-check-label" for="statusActive">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusInactive"
                                            value="inactive">
                                        <label class="form-check-label" for="statusInactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn"
                                style="background:#176c46; color:#fff; min-width:220px; border-radius:6px; font-weight:500; font-size:1.1rem; padding:10px 0; box-shadow:0 2px 8px rgba(23,108,70,0.08);">
                                Update Role
                            </button>
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
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row, repeat as needed -->
                    @if ($roles->isEmpty())
                    <td colspan="5" class="text-center text-danger">No Data Found!</td>
                    @else
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->role_id }}</td>
                        <td>{{ $role->role_name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>{{ $role->updated_at }}</td>
                        <td>
                            @if ($role->status == 'active')
                            <span class="badge bg-success" style="font-size:1rem; border-radius:8px;">Active</span>
                            @else
                            <span class="badge bg-danger" style="font-size:1rem; border-radius:8px;">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-success btn-sm me-2" data-bs-toggle="modal"
                                data-bs-target="#editStockModal" data-id="{{ $role->role_id }}"
                                data-name="{{ $role->role_name }}" data-description="{{ $role->description }}"
                                data-status="{{ $role->status }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            {{-- <a href="{{ url('role/edit/'.$role->role_id) }}"
                            class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i> Edit</a>
                            --}}
                            <form action="{{ url('role/delete/'.$role->role_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this role?');">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editModal = document.getElementById('editStockModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var description = button.getAttribute('data-description');
            var status = button.getAttribute('data-status');

            // Fill modal inputs
            document.getElementById('editRoleId').value = id;
            document.getElementById('editRoleName').value = name;
            document.getElementById('editRoleDescription').value = description;

            if (status === 'active') {
                document.getElementById('statusActive').checked = true;
            } else {
                document.getElementById('statusInactive').checked = true;
            }

            // ✅ Update the form action dynamically
            var form = document.getElementById('editRoleForm');
            form.action = "role/update/" + id; // same as route('role.update', $id)
        });
    });

</script>
</body>

</html>
@endsection
