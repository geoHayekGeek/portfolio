<?php
include_once "./backend/admin.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link rel="stylesheet" href=".\assets\css\style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="./assets/js/functions.js"></script>
    <script>
        const page_location = window.location.href.split('/').pop();
    </script>

</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="./index" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">Admin</span>
                </a>
                <div class="nav_list">
                    <a href="./index" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <!-- Projects Section -->
                    <div class="nav_link" data-bs-toggle="collapse" href="#projects" role="button" aria-expanded="false"
                        aria-controls="projects" onclick="toggleArrow(this)">
                        <i class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Projects</span>
                        <i class="bx bx-chevron-down arrow"></i>
                    </div>
                    <div class="collapse" id="projects">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">All Projects</a>
                            <a href="./add-project" class="list-group-item list-group-item-action">Add Project</a>
                        </div>
                    </div>

                    <!-- Services Section -->
                    <div class="nav_link" data-bs-toggle="collapse" href="#services" role="button" aria-expanded="false"
                        aria-controls="services" onclick="toggleArrow(this)">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Services</span>
                        <i class="bx bx-chevron-down arrow"></i>
                    </div>
                    <div class="collapse" id="services">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">All Services</a>
                            <a href="#" class="list-group-item list-group-item-action">Add Service</a>
                        </div>
                    </div>

                    <!-- Users Section -->
                    <div class="nav_link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false"
                        aria-controls="users" onclick="toggleArrow(this)">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Users</span>
                        <i class="bx bx-chevron-down arrow"></i>
                    </div>
                    <div class="collapse" id="users">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">All Users</a>
                            <a href="#" class="list-group-item list-group-item-action">Add User</a>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <a href="./backend/logout.php" class="nav_link" id="logout_btn">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100">