@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-12 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="fw-bold">Adhesive Management</h2>
                    <a class="btn btn-primary px-3" href="/adhesive"><i class="fas fa-plus"></i> Add New Adhesive</a>
                </div>

                <!-- Search & Filter -->
                <div class="card p-3 border-0 shadow-sm" style="width:1200px">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Search -->
                        <div class="input-group" style="max-width: 300px;">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Search">
                        </div>

                        <!-- Filter Button -->
                        <!-- <button class="btn btn-light border"><i class="fa-solid fa-filter"></i> Filter</button>
                        <button class="btn btn-light border" type="button"><i class="fa-regular fa-trash fa-2xs" style="color: #ec1313;"></i></button> -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-light border" id="filterBtn">
                                <i class="fa-solid fa-filter"></i> Filter
                            </button>
                            <button class="btn btn" id="deleteToggle">
                                <i class="fa-solid fa-trash fa-lg" style="color: #ec1313;"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Table -->
                <div class="card mt-3 border-0 shadow-sm" style="width:1200px">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                <th>Company</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Purchase Cost</th>
                <th>Selling Price</th>
                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($adhesives as $adhesive)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $adhesive->company->name }}</td>
                                <td>{{ $adhesive->name }}</td>
                                <td>{{ $adhesive->quantity }}</td>
                                <td>₹{{ $adhesive->purchase_cost }}</td>
                                <td>₹{{ $adhesive->selling_price }}</td>
                                <td>
                                    <a href="{{ route('adhesive.edit', $adhesive->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('adhesive.destroy', $adhesive->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach                        </tbody>
                    </table>
                </div>






            </div>
        </div>
    </div>


    <div id="filterSidebar" class="position-fixed bg-white shadow-lg p-4"
        style="right: -300px; top: 0; height: 100vh; width: 300px; transition: 0.3s;">
        <h5>Filter Options</h5>
        <hr>
        <div>
            <h6>zone</h6>
            <input type="checkbox"> Zone A<br>
            <input type="checkbox"> Zone B<br>
        </div>

        <div>
            <h6>Company Type</h6>
            <input type="checkbox"> Category X<br>
            <input type="checkbox"> Category Y<br>
        </div>
        <button class="btn btn-primary mt-3 w-100">Apply</button>
        <button class="btn btn-light mt-2 w-100" id="closeFilter">Close</button>
    </div>

    <script>
        document.getElementById('filterBtn').addEventListener('click', function() {
            document.getElementById('filterSidebar').style.right = '0';
        });
        document.getElementById('closeFilter').addEventListener('click', function() {
            document.getElementById('filterSidebar').style.right = '-300px';
        });
        document.getElementById('deleteToggle').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('.selectItem, #selectAll');
            checkboxes.forEach(cb => cb.style.display = cb.style.display === 'none' ? 'block' : 'none');
        });
    </script>
@endsection
