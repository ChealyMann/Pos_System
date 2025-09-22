    @extends('layout.master')
    @section('title', 'Add User Management')

    @section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
        <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="fw-bold mb-0">Stock</h4>
            </div>
        </div>
        <div class="bg-light rounded-3 p-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Purchase ID</th>
                            <th>Product Name</th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>Expire Date</th>
                            <th>Create By</th>
                            <th>Add Date</th>
                            <th>In Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stock_ins as $stock_in)
                        <tr>
                            <td>{{ $stock_in->purchase_id }}</td>
                            <td>{{ $stock_in->product_id }}</td>
                            <td>{{ $stock_in->cost_per_item }}</td>
                            <td>{{ $stock_in->qty }}</td>
                            <td>{{ $stock_in->expire_date }}</td>
                            <td>{{ $stock_in->created_by }}</td>
                            <td>{{ $stock_in->stock_in_date }}</td>
                            <td>{{ $stock_in->qty_in_stock }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
    </body>

    </html>
    @endsection
