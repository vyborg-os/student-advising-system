<!-- Vertical Navbar -->
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
            <img src="<?php echo LOGO ?>" alt="Site Logo">
        </a>
        <!-- User menu (mobile) -->
        <div class="navbar-user d-lg-none">
            <!-- Dropdown -->
            <div class="dropdown">
                <!-- Toggle -->
                <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar-parent-child">
                        <img alt="Image Placeholder" src="<?php echo ADMIN_AVATAR ?>" class="avatar avatar- rounded-circle">
                        <span class="avatar-child avatar-badge bg-success"></span>
                    </div>
                </a>
                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                    <hr class="dropdown-divider">
                    <a href="./logout" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./home">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./appointment">
                        <i class="bi bi-bar-chart"></i> Appointments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./students">
                        <i class="bi bi-chat"></i> Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./messages">
                        <i class="bi bi-broadcast"></i> Communication
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./notes">
                        <i class="bi bi-pen"></i> Advising Notes
                    </a>
                </li>
            </ul>
            
            <!-- Push content down -->
            <div class="mt-auto"></div>
            <!-- User (md) -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./logout">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>