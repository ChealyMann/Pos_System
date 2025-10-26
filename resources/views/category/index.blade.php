@extends('layout.master')
@section('title', 'Product Management')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
        <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="fw-bold mb-0">Category List</h4>
                <button type="button" class="btn btn-success px-4 py-2" style="border-radius:8px;font-weight:500;"
                        data-bs-toggle="modal" data-bs-target="#addStockModal">
                    <i class="bi bi-plus-lg me-2"></i>New Category
                </button>
            </div>
        </div>

        <div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background:#e4e4e4; border-radius:32px; min-width:900px; padding:20px;">
                    <div class="modal-header justify-content-between" style="border:none; padding-bottom:0;">
                        <h5 class="modal-title fw-bold" id="addStockModalLabel">Create Category</h5>
                        <button type="button"
                                style="background:#fff; border:none; font-size:1.5rem; border-radius:50%; width:36px; height:36px; display:flex; align-items:center; justify-content:center; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:background 0.2s;"
                                data-bs-dismiss="modal" aria-label="Close" onmouseover="this.style.background='#eee'"
                                onmouseout="this.style.background='#fff'">&#10006;</button>
                    </div>
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="modal-body" style="padding-top:0;">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="name" required
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
                                            <input class="form-check-input" type="radio" name="status" value="active"
                                                   checked>
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
                                        style="background:#176c46; color:#fff; min-width:220px; border-radius:6px; font-weight:500; font-size:1.1rem; padding:10px 0; box-shadow:0 2px 8px rgba(23,108,70,0.08);">Create
                                    Category</button>
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
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->category_id }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                    <span class="badge {{ $category->status == 'active' ? 'bg-success' : 'bg-danger' }}"
                                          style="font-size:1rem; border-radius:8px;">
                                        {{ ucfirst($category->status) }}
                                    </span>
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $category->category_id) }}"
                                   class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('category.destroy', $category->category_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm delete-btn"><i class="bi bi-trash"></i>
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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


