<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lived dream')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

     <!-- <link rel="stylesheet" href="resources/css/product.css"> -->
     <link rel="stylesheet" href="{{ asset('css/product.css') }}">


    <style>
        /* Custom Styles */
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        .navbar {
            background: #007bff;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#"><i class="fa-solid fa-th"></i> Dashboard</a>
    <a href="#"><i class="fa-light fa-memo"></i> Quotations</a>
    <a href="/show-products">Products</a>
    <a href="/companies">Companies</a>
    <a href="#">Categories</a>
    <a href="/zones">Zones</a>
    <a href="/adhesives">Adhesive</a>
    <a href="#">Samples</a>
    <a href="#">Users</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navigation Bar -->
        {{-- <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Company Management</a>
            </div>
        </nav> --}}

        <!-- Dynamic Content Section -->
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
