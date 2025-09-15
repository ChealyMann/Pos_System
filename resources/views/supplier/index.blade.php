@extends('layout.master')
@section('title', 'Supplier Management')

@section('content')
<div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
    <div class="row g-3">
        <div class="col">
            <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="fw-bold mb-0">Supplier</h4>
                    <a href="{{url('supplier/create')}}" class="btn btn-success px-4 py-2"
                        style="border-radius:8px;font-weight:500;">
                        <i class="bi bi-plus-lg me-2"></i>Add New Supplier
                    </a>
                </div>
            </div>
            <div class="row g-3" style="overflow: scroll; height: 83vh;">
                <!-- User Card Example (repeat for each user) -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <a href="{{url('Supplier/edit')}}" class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Highlighted/Selected Card Example -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat user cards as needed -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Copy the above .col-xl-4 ... block for more users -->
                <!-- User Card Example (repeat for each user) -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Highlighted/Selected Card Example -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat user cards as needed -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Card Example (repeat for each user) -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Highlighted/Selected Card Example -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat user cards as needed -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Card Example (repeat for each user) -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Highlighted/Selected Card Example -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat user cards as needed -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Card Example (repeat for each user) -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Highlighted/Selected Card Example -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat user cards as needed -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Card Example (repeat for each user) -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Highlighted/Selected Card Example -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat user cards as needed -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                        <img src="../assets/image/rtn.jpg" alt="User" class="rounded-3"
                            style="width:90px; height:90px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="small text-muted mb-1">#C4530321</div>
                            <div class="fw-bold" style="font-size:1.15rem;">Tem Chanrothana</div>
                            <div class="text-muted" style="font-size:0.97rem;">chanrathana123@gmail.com</div>
                            <div class="text-muted" style="font-size:0.97rem;">+855 96 554 74 51</div>
                            <div class="mt-2">
                                <button class="btn btn-outline-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>
@endsection
