@extends('layout.master')
@section('title', 'Product Management')

@section('content')
            <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
                <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="fw-bold mb-0">Sale List</h4>
                    </div>
                </div>
                <div class="bg-light rounded-3 p-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Sale ID</th>
                                    <th>Total Amount</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>User Name</th>
                                    <th>Sale Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example row, repeat as needed -->
                                <tr>
                                    <td>231</td>
                                    <td>20.00</td>
                                    <td>Cash</td>
                                    <td>Paid</td>
                                    <td>Bory</td>
                                    <td>09/09/2025</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-success btn-sm me-2"><i class="bi bi bi-eye"></i> View Detail</a>
                                    </td>
                                </tr>
                                <!-- Repeat above <tr> for more products -->
                                <tr>
                                    <td>231</td>
                                    <td>20.00</td>
                                    <td>Cash</td>
                                    <td>Paid</td>
                                    <td>Bory</td>
                                    <td>09/09/2025</td>
                                    <td>
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
