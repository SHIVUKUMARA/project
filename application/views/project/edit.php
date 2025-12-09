<main id="mainContent" class="d-flex justify-content-center align-items-start p-4" style="min-height: calc(100vh - 56px); background:#f8f9fa;">
    <div class="card shadow-lg border-0 rounded-lg w-100" style="max-width:700px;">
        <div class="card-header bg-warning text-white text-center">
            <h3 class="mb-0 p-2">Edit Project</h3>
        </div>
        <div class="card-body p-4">

            <div id="response"></div>

            <form id="editProjectForm" action="<?= site_url('project/edit/' . $project['id']); ?>" method="post">
                <input type="hidden"
                    name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="form-floating mb-3">
                    <input type="text" name="project_name" class="form-control"
                        value="<?= html_escape($project['project_name']); ?>" required>
                    <label>Project Name</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" style="height:100px;" required><?= html_escape($project['description']); ?></textarea>
                    <label>Description</label>
                </div>

                <div class="row g-3 mb-3">
                    <div class="form-floating col-md-6">
                        <input type="date" name="start_date" class="form-control"
                            value="<?= html_escape($project['start_date']); ?>" required>
                        <label>Start Date</label>
                    </div>

                    <div class="form-floating col-md-6">
                        <select name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="Pending" <?= $project['status'] == "Pending" ? "selected" : ""; ?>>Pending</option>
                            <option value="Ongoing" <?= $project['status'] == "Ongoing" ? "selected" : ""; ?>>Ongoing</option>
                            <option value="Completed" <?= $project['status'] == "Completed" ? "selected" : ""; ?>>Completed</option>
                        </select>
                        <label>Status</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="developer_name" class="form-control"
                        value="<?= html_escape($project['developer_name']); ?>" required>
                    <label>Developer Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="helping_hand" class="form-control"
                        value="<?= html_escape($project['helping_hand']); ?>">
                    <label>Helping Hand (Optional)</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" name="project_manager" class="form-control"
                        value="<?= html_escape($project['project_manager']); ?>" required>
                    <label>Project Manager</label>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button type="submit" class="btn btn-warning" id="submitBtn">Update Project</button>
                    <a href="<?= site_url('project/list'); ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

        </div>
    </div>
</main>