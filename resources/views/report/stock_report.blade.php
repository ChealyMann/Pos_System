@extends('layout.master')
@section('title', 'Report')

@section('content')
<div class="col-lg-10 col-md-10 px-4 py-3" style="background:#dbdbdb; min-height:100vh;">
    <div class="bg-light rounded-3 p-4 mb-4">
        <h3 class="fw-bold mb-0">Stock Report</h3>
    </div>
    <div class="bg-light rounded-3 p-4 mb-4">
        <form class="row align-items-end g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Report Name</label>
                <input type="text" name="report_name" class="form-control bg-white" />
            </div>
            <div class="col-md-6 mb-3">
                <label for="product_id" class="form-label">Report Type</label>
                <select name="product_id" id="product_id" class="form-control bg-white">
                    <option value="">-- Select Type --</option>
                    <option value="">Stock In Report</option>
                    <option value="">Stock Out Report</option>
                    <option value="">Expired Stock Report</option>
                    <option value="">Current Stock Report</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">From Date</label>
                <input type="date" class="form-control bg-white" value="2025-11-08">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">To Date</label>
                <input type="date" class="form-control bg-white" value="2025-11-09">
            </div>
            <div class="col-md-6 mb-3 d-flex gap-3">
                <button type="button" id="generateReport" class="btn" style="background:#18a05e; color:#fff; min-width:150px;">
                    Generate Report
                </button>
            </div>
        </form>
    </div>
    <div class="bg-light rounded-3 p-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0" style="border-collapse:separate;">
                <thead>
                    <tr style="border-bottom:2px solid #aaa;">
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Cost</th>
                        <th>Quantity</th>
                        <th>Reason</th>
                        <th>Expire Date</th>
                        <th>User Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Freppe Coffee</td>
                        <td>2.50</td>
                        <td>100</td>
                        <td>80</td>
                        <td>07/07/2025</td>
                        <td>Bora</td>
                        <td>
                            <a href="" class="btn btn-outline-success btn-sm me-2">
                                <i class="bi bi-eye"></i> View Detail
                            </a>
                        </td>
                    </tr>
                    <!-- More rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
