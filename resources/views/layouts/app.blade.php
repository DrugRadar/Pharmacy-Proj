<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        {{-- <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="../assets/img/apple-icon.png"
        /> --}}
        {{-- <link rel="icon" type="image/png" href="../assets/img/icons/logoImg.png" /> --}}
        <title>Material Dashboard 2 by Creative Tim</title>
        <!--     Fonts and icons     -->
        <link
            rel="stylesheet"
            type="text/css"
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"
        />
        <!-- Nucleo Icons -->
        {{-- <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="assets/css/nucleo-svg.css" rel="stylesheet" /> --}}
        <!-- Font Awesome Icons -->
        <script
            src="https://kit.fontawesome.com/42d5adcbca.js"
            crossorigin="anonymous"
        ></script>
        <!-- Material Icons -->
        <link
            href="https://fonts.googleapis.com/icon?family=Material+Icons+Round"
            rel="stylesheet"
        />
        <!-- CSS Files -->
        <link
            id="pagestyle"

            href="{{URL::asset('css/material-dashboard.css?v=3.0.0') }}"
            rel="stylesheet"
        />
        <link
            href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
            rel='stylesheet'
        />
        {{-- <link rel="stylesheet" href="css/material-dashboard.css"> --}}
        <link rel="stylesheet" href="css/DarkToggleStyle.css">
    </head>

    <body class="g-sidenav-show bg-gray-200">
        <aside
            class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
            id="sidenav-main"
        >
            <div class="sidenav-header">
                <i
                    class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                    aria-hidden="true"
                    id="iconSidenav"
                ></i>
                <a
                    class="navbar-brand m-0"
                    href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
                    target="_blank"
                >
                    <div class="logo-container" style="display:flex;">
                        <div class="spinner">
                            <div class="spinner1"></div>
                        </div>
                        <div style="margin-left:30px; margin-top:10px; font-size:20px; color:whitesmoke;"> Brand</div>
                    </div>
                </a>
            </div>
            <hr class="horizontal light mt-2 mb-2" />
            <div
                class="collapse navbar-collapse w-auto max-height-vh-100"
                id="sidenav-collapse-main"
            >
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/dashboard.html">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                            <i class='bx bx-user-pin' style="font-size: 25px;"></i>
                            </div>
                            <span class="nav-link-text ms-1">Admin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/tables.html">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                            <i class='bx bx-user' style="font-size: 25px;" ></i>
                            </div>
                            <span class="nav-link-text ms-1">Pharmacy Owner</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/tables.html">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                            <i class='bx bx-group' style="font-size: 25px;" ></i>
                            </div>
                            <span class="nav-link-text ms-1">Pharmacists</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/tables.html">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                            <i class='bx bxs-group' style="font-size: 25px;"></i>
                            </div>
                            <span class="nav-link-text ms-1">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('areas.index')}}">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                            <i class='bx bx-map-pin' style="font-size: 25px;"></i>
                            </div>
                            <span class="nav-link-text ms-1">Areas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/tables.html">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                            <i class='bx bxs-capsule' style="font-size: 25px;"></i>
                            </div>
                            <span class="nav-link-text ms-1">Medicines</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/tables.html">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                            <i class='bx bx-cycling' style="font-size: 25px;"></i>
                            </div>
                            <span class="nav-link-text ms-1">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/tables.html">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                            <i class='bx bx-dollar' style="font-size: 25px;"></i>
                            </div>
                            <span class="nav-link-text ms-1">Revenue</span>
                        </a>
                    </li>
                </ul>
            </div>
            {{-- <div class="sidenav-footer position-absolute w-100 bottom-0">
                <div class="mx-3">
                    <a
                        class="btn bg-gradient-primary mt-4 w-100"
                        href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree"
                        type="button"
                        >New Article <i class='bx bx-plus'></i></a
                    >
                </div>

            </div> --}}
        </aside>

        {{-- nav --}}

        <main
            class="main-content position-relative max-height-vh-100 h-100 border-radius-lg"
        >
            <nav
                class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
                id="navbarBlur"
                navbar-scroll="true"
            >
                <div class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol
                            class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5"
                        >
                            <li class="breadcrumb-item text-sm">
                                <a
                                    class="opacity-5 text-dark"
                                    href="javascript:;"
                                    >Pages</a
                                >
                            </li>
                            <li
                                class="breadcrumb-item text-sm text-dark active"
                                aria-current="page"
                            >
                                Template
                            </li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Template</h6>
                    </nav>
                    <div
                        class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4"
                        id="navbar"
                    >
                        <!-- <div
                            class="ms-md-auto pe-md-3 d-flex align-items-center"
                        >
                            <div class="input-group input-group-outline">
                                <label class="form-label">Type here...</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div> -->
                        <div class="DarkbtnContainer ms-md-auto pe-md-3 d-flex align-items-center">
                            <input type="checkbox" id="dark-mode">
                            <label for="dark-mode" class="Dark-btn"></label>
                        </div>
                    </div>
                </div>
            </nav>


<div class="container" style="min-height: 59vh">
    @yield('content')
</div>

        {{-- footer --}}
            <footer class="text-center text-white mt-auto me-3 bg-gradient-dark footer">
                <!-- Grid container -->
                <div class="container p-4 pb-0">
                <!-- Section: CTA -->
                <section class="">
                    <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3">Register for free</span>
                    <button type="button" class="btn btn-outline-light btn-rounded">
                        Sign up!
                    </button>
                    </p>
                </section>
                <!-- Section: CTA -->
                </div>
                <!-- Grid container -->

                <!-- Copyright -->
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
                </div>
                <!-- Copyright -->
            </footer>
        </main>

        <!--   Core JS Files   -->
        <script src="assets/js/core/bootstrap.bundle.min.js"></script>
        <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    </body>
</html>

