<nav class="navbar navbar-dark px-3 d-flex align-content-center" id="topNav" style="background-color: #343a40;">
    <button class="btn btn-outline-light me-3" id="sidebarToggle">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="dropdown p-3 profile-dropdown ms-auto">
        <a href="#" class="d-flex align-items-center text-white">
            <img src="https://github.com/mdo.png" class="rounded-circle me-2" width="32" height="32">
        </a>

        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end profile-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</nav>

<div class="sidebar bg-dark text-white" id="sidebar">
    <div class="sidebar-logo text-center py-3 border-bottom">
        <span class="logo-text fw-bold">CRM Tool</span>
    </div>

    <ul class="nav flex-column px-2 mt-1">
        <li class="nav-item">
            <a class="nav-link text-white d-flex align-items-center" href="<?= base_url('project/create') ?>">
                <i class="bi bi-speedometer2 me-2"></i>
                <span class="link-text">Dashboard</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link text-white d-flex align-items-center justify-content-between dropdown-toggle" href="#" id="projectsDropdown">
                <div>
                    <i class="bi bi-folder-fill me-2"></i>
                    <span class="link-text">Projects</span>
                </div>
                <i class="bi bi-chevron-right arrow-icon"></i>
            </a>
            <ul class="submenu flex-column ps-4">
                <li>
                    <a class="nav-link text-white dropdown-item" href="<?= base_url('project/create') ?>" data-submenu="create">
                        <i class="bi bi-plus me-2"></i> Create
                    </a>
                </li>
                <li>
                    <a class="nav-link text-white dropdown-item" href="<?= base_url('project/list') ?>" data-submenu="list">
                        <i class="bi bi-table me-2"></i> Project List
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</div>