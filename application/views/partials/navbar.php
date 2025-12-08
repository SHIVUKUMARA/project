<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('project/create') ?>">CRM Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('project/create'); ?>">Create Project</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('project/list'); ?>">Project List</a>
                </li>
            </ul>
        </div>
    </div>
</nav>