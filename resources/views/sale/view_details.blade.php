@extends('layout.master')

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
                                    <th>Barcode</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>Sub Total</th>
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
                                    <td>25.00</td>
                                    <td>
                                        <a href="{{url('supplier/')}}" class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i> View Detail</a>
                                    </td>
                                </tr>
                                <!-- Repeat above <tr> for more products -->
                                <tr>
                                    <td>884123244231</td>
                                    <td>Freppe Coffee</td>
                                    <td>2.50</td>
                                    <td>100</td>
                                    <td>25.00</td>
                                    <td>
                                        <a href="{{url('supplier/')}}" class="btn btn-outline-success btn-sm me-2"><i class="bi bi-pencil-square"></i> View Detail</a>
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
