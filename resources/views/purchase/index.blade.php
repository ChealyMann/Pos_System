@extends('layout.master')
@section('title', 'Purchase Management')

@section('content')
            <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
                <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="fw-bold mb-0">Purchase List</h4>
                        <a href="{{url('purchase/create')}}" class="btn btn-success px-4 py-2" style="border-radius:8px;font-weight:500;">
                            <i class="bi bi-plus-lg me-2"></i>New Purchase
                        </a>
                    </div>
                </div>
                <div class="bg-light rounded-3 p-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example row, repeat as needed -->
                                <tr>
                                    <td>884123244231</td>
                                    <td>Freppe Coffee</td>
                                    <td>2.50</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-danger" style="font-size:1rem; border-radius:8px;">cancle</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i> Edit</button>

                                        <a href="#" class="btn btn-outline-success btn-sm me-2"><i class="bi bi bi-eye"></i> View Detail</a>
                                    </td>
                                </tr>
                                <!-- Repeat above <tr> for more products -->
                                <tr>
                                    <td>884123244231</td>
                                    <td>Freppe Coffee</td>
                                    <td>2.50</td>
                                    <td>100</td>
                                    <td>
                                        <span class="badge bg-success"
                                            style="font-size:1rem; border-radius:8px;">paid</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i> Edit</button>

                                        <a href="#" class="btn btn-outline-success btn-sm me-2"><i class="bi bi bi-eye"></i> View Detail</a>
                                    </td>
                                </tr>

                                <!-- ...more rows as needed -->
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
