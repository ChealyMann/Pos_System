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
                <label class="form-label fw-bold">From Date</label>
                <input type="date" class="form-control bg-white" value="2025-11-08">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">To Date</label>
                <input type="date" class="form-control bg-white" value="2025-11-09">
            </div>
            <div class="col-md-6 mb-3 d-flex gap-3">
                <button type="button" class="btn" style="background:#18a05e; color:#fff; min-width:150px;">Export Report</button>
                <button type="submit" class="btn" style="background:#137844; color:#fff; min-width:150px;">Filter Report</button>
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
                        <th>Add Date</th>
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
                        <td>07/07/2025</td>
                    </tr>
                    <!-- More rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
