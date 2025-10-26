@extends('layout.master')
@section('title', 'Sale Report Detail')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#dbdbdb; min-height:100vh;">
        <div class="bg-light rounded-3 p-4 mb-4">
            <h3 class="fw-bold mb-0">Sale Report Detail</h3>
            <p>Report: <strong>{{ $report->report_name }}</strong> | Month: <strong>{{ \Carbon\Carbon::parse($report->date)->format('F, Y') }}</strong></p>
        </div>
        <div class="bg-light rounded-3 p-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Sale Date</th>
                        <th>Sold By</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($saleItems as $item)
                        <tr>
                            <td>{{ $item->sale_id }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->sale_date)->format('F d, Y') }}</td>
                            <td>{{ $item->sale_by }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>${{ number_format($item->total_price, 2) }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td>
                                <a href="{{ route('report.saleDetail', $report->report_id) }}" class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-eye"></i> View Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No sale records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
