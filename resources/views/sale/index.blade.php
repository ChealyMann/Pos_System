@extends('layout.master')
@section('title', 'Sale Management')

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
                            <th>Sale By</th>
                            <th>Sale Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sale->sale_id }}</td>
                            <td>${{ number_format($sale->total_amount, 2) }}</td>
                            <td>{{ $sale->payment_method }}</td>
                            <td>
                                <span class="badge {{ $sale->status == 'Paid' ? 'bg-warningbg-success' : 'bg-success' }}">
                                    {{ $sale->status }}
                                </span>
                            </td>
                            <td>{{$sale->user_name}}</td>
                            <td>{{ Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('sale.show', $sale->sale_id) }}" class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-eye"></i> View Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No sales found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
