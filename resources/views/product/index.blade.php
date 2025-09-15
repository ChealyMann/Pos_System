@extends('layout.master')
@section('title', 'Product Management')

@section('content')
            <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
                <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="fw-bold mb-0">Product List</h4>
                        <a href="{{url('product/create')}}" class="btn btn-success px-4 py-2" style="border-radius:8px;font-weight:500;">
                            <i class="bi bi-plus-lg me-2"></i>New Product
                        </a>
                    </div>
                </div>
                <div class="bg-light rounded-3 p-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Image</th>
                                    <th>Barcode</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>102</td>
                                    <td>
                                        <img src="../assets/image/image_2025-06-07_15-58-43.png" alt="Product"
                                            style="width:56px; height:56px; object-fit:cover; border-radius:12px;">
                                    </td>
                                    <td>884123244231</td>
                                    <td>Freppe Coffee</td>
                                    <td>2.50</td>
                                    <td>100</td>

                                    <td>
                                        <span class="badge bg-danger" style="font-size:1rem; border-radius:8px;">Inactive</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i> Edit</button>

                                        <button class="btn btn-outline-success btn-sm me-2"><i class="bi bi-eye"></i> View</button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>103</td>
                                    <td>
                                        <img src="../assets/image/image_2025-06-07_15-58-43.png" alt="Product"
                                            style="width:56px; height:56px; object-fit:cover; border-radius:12px;">
                                    </td>
                                    <td>884123244231</td>
                                    <td>Freppe Coffee</td>
                                    <td>2.50</td>
                                    <td>100</td>

                                    <td>
                                        <span class="badge bg-success"
                                            style="font-size:1rem; border-radius:8px;">Active</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i> Edit</button>

                                        <button class="btn btn-outline-success btn-sm me-2"><i class="bi bi-eye"></i> View</button>
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
