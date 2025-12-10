<main id="mainContent" class="d-flex justify-content-center align-items-start p-4" style="min-height: calc(100vh - 56px);">
    <div class="card shadow-lg border-0 rounded-4 w-100" style="max-width:900px;">
        <div class="card-header bg-info text-white d-flex align-items-center justify-content-between">
            <h3 class="mb-0"><i class="bi bi-folder-fill me-2"></i>Project Details</h3>
            <span class="badge 
                <?php
                $status = $project['status'];
                if ($status === 'Pending') echo 'bg-warning text-dark';
                elseif ($status === 'Ongoing') echo 'bg-primary';
                elseif ($status === 'Completed') echo 'bg-success';
                else echo 'bg-secondary';
                ?> p-2">
                <?= html_escape($status); ?>
            </span>
        </div>

        <div class="card-body">
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100 shadow-sm">
                        <h6 class="text-muted"><i class="bi bi-pencil-square me-1"></i>Project Name</h6>
                        <p class="fw-bold mb-0"><?= html_escape($project['project_name']); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100 shadow-sm">
                        <h6 class="text-muted"><i class="bi bi-person-fill me-1"></i>Developer</h6>
                        <p class="fw-bold mb-0"><?= html_escape($project['developer_name']); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100 shadow-sm">
                        <h6 class="text-muted"><i class="bi bi-people-fill me-1"></i>Helping Hand</h6>
                        <p class="fw-bold mb-0"><?= html_escape($project['helping_hand']); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100 shadow-sm">
                        <h6 class="text-muted"><i class="bi bi-person-badge-fill me-1"></i>Project Manager</h6>
                        <p class="fw-bold mb-0"><?= html_escape($project['project_manager']); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100 shadow-sm">
                        <h6 class="text-muted"><i class="bi bi-calendar-event-fill me-1"></i>Start Date</h6>
                        <p class="fw-bold mb-0"><?= html_escape($project['start_date']); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100 shadow-sm">
                        <h6 class="text-muted"><i class="bi bi-clock-fill me-1"></i>Created At</h6>
                        <p class="fw-bold mb-0"><?= html_escape($project['created_at']); ?></p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="border rounded p-3 shadow-sm">
                        <h6 class="text-muted"><i class="bi bi-card-text me-1"></i>Description</h6>
                        <p class="mb-0"><?= html_escape($project['description']); ?></p>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="<?= site_url('project/list'); ?>" class="btn btn-secondary flex-fill d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-arrow-left-circle"></i> Back to List
                </a>
                <a href="<?= site_url('project/edit/' . $project['id']); ?>" class="btn btn-warning flex-fill d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-pencil-square"></i> Edit Project
                </a>
            </div>
        </div>
    </div>
</main>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">