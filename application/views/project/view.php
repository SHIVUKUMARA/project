<main class="container my-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-info text-white">
            <h3 class="mb-0">Project Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Project Name</th>
                    <td><?= html_escape($project['project_name']); ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?= html_escape($project['description']); ?></td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td><?= html_escape($project['start_date']); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= html_escape($project['status']); ?></td>
                </tr>
                <tr>
                    <th>Developer Name</th>
                    <td><?= html_escape($project['developer_name']); ?></td>
                </tr>
                <tr>
                    <th>Helping Hand</th>
                    <td><?= html_escape($project['helping_hand']); ?></td>
                </tr>
                <tr>
                    <th>Project Manager</th>
                    <td><?= html_escape($project['project_manager']); ?></td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td><?= html_escape($project['created_at']); ?></td>
                </tr>
            </table>
            <a href="<?= site_url('project/list'); ?>" class="btn btn-secondary mt-3">Back to List</a>
            <a href="<?= site_url('project/edit/' . $project['id']); ?>" class="btn btn-warning mt-3">Edit Project</a>
        </div>
    </div>
</main>