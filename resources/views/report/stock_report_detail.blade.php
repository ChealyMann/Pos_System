@extends('layout.master')
@section('title', 'Stock Report Detail')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#dbdbdb; min-height:100vh;">
        <div class="bg-light rounded-3 p-4 mb-4">
            <h3 class="fw-bold mb-0">Stock Report Detail</h3>
            <p>Report: <strong>{{ $report->report_name }}</strong> | Month: <strong>{{ \Carbon\Carbon::parse($report->date)->format('F, Y') }}</strong></p>
        </div>
        <div class="bg-light rounded-3 p-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Stock In ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Qty Received</th>
                        <th>Cost Per Item</th>
                        <th>Created By</th>
                        <th>Stock In Date</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($stocks as $stock)
                        <tr>
                            <td>{{ $stock->stock_in_id }}</td>
                            <td>{{ $stock->product_id }}</td>
                            <td>{{ $stock->product_name }}</td>
                            <td>{{ $stock->qty }}</td>
                            <td>{{ $stock->cost_per_item }}</td>
                            <td>{{ $stock->created_by }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->stock_in_date)->format('F d, Y, H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->created_at)->format('F d, Y ,H:i') }}</td>
                            <td>
                                <a href="{{ route('report.stockDetail', $report->report_id) }}" class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-eye"></i> View Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No stock records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
