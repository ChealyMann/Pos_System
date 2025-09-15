
@extends('layout.master')
@section('title', 'Product Detail')

@section('content')
<div class="col-lg-10 col-md-10 px-5 py-4" style="background:#dbdbdb; min-height:100vh;">
    <div class="bg-light rounded-3 p-5" style="min-height:80vh;">
        <h2 class="fw-bold mb-4">Product Detail</h2>
        <div class="row mb-4 align-items-center">
            <div class="col-md-4 text-center">
                <img src="{{ asset('assets/image/image_2025-06-07_15-58-43.png') }}" alt="Product" class="rounded"
                    style="width:320px; height:320px; object-fit:cover; border:2px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
            </div>
            <div class="col-md-8">
                <div class="mb-2 text-muted" style="font-size:1.1rem;">#C4530321</div>
                <h3 class="fw-bold mb-2" style="font-size:2rem;">Coca Cola 330ml</h3>
                <div class="mb-1" style="font-size:1.15rem;">Price: <span class="fw-bold">$1.50</span></div>
                <div class="mb-1" style="font-size:1.15rem;">In Stock: <span class="fw-bold">1020</span></div>
                <div class="mb-1" style="font-size:1.15rem;">Minimum Stock Level: <span class="fw-bold">50</span></div>
                <div class="mb-3" style="font-size:1.15rem;">Country: <span class="fw-bold">Cambodia</span></div>
                <div class="mb-3">
                    <span class="badge"
                        style="background:#18a05e; color:#fff; font-size:1.1rem; border-radius:24px; padding:10px 40px;">Active</span>
                </div>
            </div>
        </div>
        <div class="mb-4" style="font-size:1.15rem; color:#444;">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Proin tortor purus platea sit eu id nisi litora libero. Neque vulputate consequat ac
            amet augue blandit maximus aliquet congue.
        </div>
        <div class="border-top border-bottom py-3 mb-2" style="border-style:dashed !important;">
            <div class="row text-center fw-bold" style="font-size:1.05rem;">
                <div class="col">Create By</div>
                <div class="col">Create At</div>
                <div class="col">Update By</div>
                <div class="col">Update At</div>
            </div>
            <div class="row text-center" style="font-size:1.05rem;">
                <div class="col">Bory</div>
                <div class="col">09 September 2025</div>
                <div class="col">Yury</div>
                <div class="col">30 September 2025</div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>
@endsection

