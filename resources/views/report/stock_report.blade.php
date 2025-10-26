@extends('layout.master')
@section('title', 'Stock Report')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#dbdbdb; min-height:100vh;">
        <div class="bg-light rounded-3 p-4 mb-4">
            <h3 class="fw-bold mb-0">Stock Report</h3>
        </div>

        <!-- Filter Form -->
        <div class="bg-light rounded-3 p-4 mb-4">
            <form id="filterForm" class="row align-items-end g-3" action="{{ route('report.generateStockReport') }}" method="POST">
                @csrf
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Report Name
                        @error('report_name')
                        <span class="text-danger ms-2">{{ $message }}</span>
                        @enderror
                    </label>
                    <input type="text" name="report_name" class="form-control bg-white"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="report_type" class="form-label fw-bold">
                        Report Type
                        @error('report_type')
                        <span class="text-danger ms-2">{{ $message }}</span>
                        @enderror
                    </label>
                    <select name="report_type" id="report_type" class="form-control bg-white">
                        <option value="">-- Select Type --</option>
                        <option value="Stock In">Stock In</option>
                        <option value="Stock Out">Stock Out</option>
                        <option value="Expired Stock">Expired Stock</option>
                        <option value="Current Stock">Current Stock</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Monthly
                        @error('date')
                        <span class="text-danger ms-2">{{ $message }}</span>
                        @enderror
                    </label>
                    <input type="month" name="date" class="form-control bg-white" value="{{ date('Y-m') }}"/>
                </div>
                <div class="col-md-6 mb-3 d-flex gap-3">
                    <button type="submit" class="btn" style="background:#18a05e; color:#fff; min-width:150px;">
                        Generate Report
                    </button>
                </div>
            </form>
        </div>

        <!-- Reports Table -->
        <div class="bg-light rounded-3 p-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0" style="border-collapse:separate;">
                    <thead>
                    <tr style="border-bottom:2px solid #aaa;">
                        <th>Report ID</th>
                        <th>Report Name</th>
                        <th>Type</th>
                        <th>Generate Date</th>
                        <th>Monthly</th>
                        <th>User Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td>{{ $report->report_id }}</td>
                            <td>{{ $report->report_name }}</td>
                            <td>{{ $report->report_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($report->create_at)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($report->date)->format('F, Y') }}</td>
                            <td>{{ $report->generate_by }}</td>
                            <td>
                                <a href="{{ route('report.stockDetail', $report->report_id) }}" class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-eye"></i> View Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No reports found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
