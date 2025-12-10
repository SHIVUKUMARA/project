<main id="mainContent">
    <!-- Toast container -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
        <div id="toastContainer"></div>
    </div>

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
                                <tr id="projectRow<?= $project['id']; ?>">
                                    <td><?= html_escape($project['id']); ?></td>
                                    <td><?= html_escape($project['project_name']); ?></td>
                                    <td><?= html_escape($project['description']); ?></td>
                                    <td><?= html_escape($project['start_date']); ?></td>
                                    <td>
                                        <?php
                                        $statusClass = [
                                            'Pending' => 'bg-warning text-dark',
                                            'Ongoing' => 'bg-primary',
                                            'Completed' => 'bg-success'
                                        ];
                                        $class = $statusClass[$project['status']] ?? 'bg-secondary';
                                        ?>
                                        <span class="badge <?= $class ?> p-2"><?= html_escape($project['status']); ?></span>
                                    </td>
                                    <td><?= html_escape($project['developer_name']); ?></td>
                                    <td><?= html_escape($project['helping_hand']); ?></td>
                                    <td><?= html_escape($project['project_manager']); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?= site_url('project/view/' . $project['id']); ?>" class="btn btn-sm btn-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?= site_url('project/edit/' . $project['id']); ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- delete -->
                                            <form class="deleteProjectForm" method="post" action="<?= site_url('project/delete/' . $project['id']); ?>" style="display:none;">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            </form>

                                            <button class="btn btn-sm btn-danger btn-delete" data-id="<?= $project['id']; ?>" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
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