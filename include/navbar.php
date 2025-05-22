<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container">
        <!-- Navbar Brand -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="assets/img/properties/logo.png" class="w-100-px" alt="Logo">
        </a>

        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/img/profiles/default.jpg" class="user-image rounded-circle shadow" alt="User Image" style="height: 40px; width: 40px;">
                    <span class="d-none d-md-inline ms-2"><?= $data['nama_lengkap']; ?></span>
                </a>
                <ul class="dropdown-menu custom-dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a href="logout.php" class="dropdown-item py-2">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            <span class="mx-2">Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
