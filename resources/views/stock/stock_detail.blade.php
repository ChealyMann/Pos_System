    @extends('layout.master')
    @section('title', 'Add User Management')

    @section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
        <div class="bg-light rounded-3 p-4 mb-3 d-flex justify-content-between" style="position: sticky; top: 105px;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <a href="{{url('stock')}}" class="btn btn-link fs-2 p-0" style="color:#444; margin-right:20px;"><i class="bi bi-arrow-left-circle"></i></a>
                <h4 class="fw-bold mb-0">Stock</h4>
            </div>
            <div>
                <form method="GET" class="d-flex align-items-center">
                    <select name="filter" class="form-select me-3" style="max-width:180px;">
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                        <option value="in_stock" {{ request('filter') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="out_stock" {{ request('filter') == 'out_stock' ? 'selected' : '' }}>Out Stock</option>
                    </select>
                    <button type="submit" class="btn btn-success px-4" style="width:180px;">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </form>
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
                        @if (request('filter') == 'in_stock')
                            @foreach($stock_ins as $stock_in)
                                @if ($stock_in->qty_in_stock > 0)
                                    <tr>
                                        <td>{{ $stock_in->purchase_id }}</td>
                                        <td>{{ $stock_in->product->product_name}}</td>
                                        <td>{{ $stock_in->cost_per_item }}</td>
                                        <td>{{ $stock_in->qty }}</td>
                                        <td>{{ $stock_in->expire_date }}</td>
                                        <td>{{ $stock_in->created_by }}</td>
                                        <td>{{ $stock_in->stock_in_date }}</td>
                                        <td>{{ $stock_in->qty_in_stock }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @elseif (request('filter') == 'out_stock')
                            @foreach($stock_ins as $stock_in)
                                @if ($stock_in->qty_in_stock <= 0)
                                    <tr class="table-danger">
                                        <td>{{ $stock_in->purchase_id }}</td>
                                        <td>{{ $stock_in->product->product_name}}</td>
                                        <td>{{ $stock_in->cost_per_item }}</td>
                                        <td>{{ $stock_in->qty }}</td>
                                        <td>{{ $stock_in->expire_date }}</td>
                                        <td>{{ $stock_in->created_by }}</td>
                                        <td>{{ $stock_in->stock_in_date }}</td>
                                        <td>{{ $stock_in->qty_in_stock }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            @if ($stock_ins->isEmpty())
                                <td colspan="8" class="text-center text-danger">No Data Found!</td>
                            @else
                                @foreach($stock_ins as $stock_in)
                                    @if ($stock_in->qty_in_stock > 0)
                                        <tr>
                                    @else
                                        <tr class="table-danger">
                                    @endif
                                            <td>{{ $stock_in->purchase_id }}</td>
                                            <td>{{ $stock_in->product->product_name}}</td>
                                            <td>{{ $stock_in->cost_per_item }}</td>
                                            <td>{{ $stock_in->qty }}</td>
                                            <td>{{ $stock_in->expire_date }}</td>
                                            <td>{{ $stock_in->created_by }}</td>
                                            <td>{{ $stock_in->stock_in_date }}</td>
                                            <td>{{ $stock_in->qty_in_stock }}</td>
                                        </tr>
                                @endforeach
                            @endif
                        @endif
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
