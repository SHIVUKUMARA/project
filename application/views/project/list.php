<main id="mainContent">
    <div class="card shadow-lg border-0 rounded-lg w-100" style="max-width:1200px; background:#fff;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0 p-2">All Projects</h3>
            <a href="<?= site_url('project/create'); ?>" class="btn btn-success btn-sm">Add New Project</a>
        </div>
        <div class="card-body">
            <?php if (empty($projects)): ?>
                <div class="alert alert-info">No projects found.</div>
            <?php else: ?>
                <div style="overflow:auto; max-height:500px;">
                    <table class="table table-striped table-bordered table-hover text-center" style="min-width:1000px;">
                        <thead class="table-dark">
                            <tr style="position: sticky; top: 0; z-index: 10;">
                                <th>ID</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>Status</th>
                                <th>Developer</th>
                                <th>Helping Hand</th>
                                <th>Project Manager</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $project): ?>
                                <tr>
                                    <td><?= html_escape($project['id']); ?></td>
                                    <td><?= html_escape($project['project_name']); ?></td>
                                    <td><?= html_escape($project['description']); ?></td>
                                    <td><?= html_escape($project['start_date']); ?></td>
                                    <td>
                                        <?php if ($project['status'] === 'Pending'): ?>
                                            <span class="badge bg-warning text-dark p-2"><?= html_escape($project['status']); ?></span>
                                        <?php elseif ($project['status'] === 'Ongoing'): ?>
                                            <span class="badge bg-primary p-2"><?= html_escape($project['status']); ?></span>
                                        <?php elseif ($project['status'] === 'Completed'): ?>
                                            <span class="badge bg-success p-2"><?= html_escape($project['status']); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary p-2"><?= html_escape($project['status']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= html_escape($project['developer_name']); ?></td>
                                    <td><?= html_escape($project['helping_hand']); ?></td>
                                    <td><?= html_escape($project['project_manager']); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="<?= site_url('project/view/' . $project['id']); ?>" class="btn btn-info btn-sm">View</a>
                                            <a href="<?= site_url('project/edit/' . $project['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <?= $pagination ?? ''; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>