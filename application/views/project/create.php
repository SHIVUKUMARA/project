<main id="mainContent">
    <div class="card shadow-lg border-0 rounded-lg w-100" style="max-width:700px;background:#fff;">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0 p-2">Create Project</h3>
        </div>
        <div class="card-body p-4">
            <div id="msg"></div>

            <?= form_open('project/add', ['id' => 'createProjectForm']); ?>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

            <div class="form-floating mb-3">
                <input type="text" name="project_name" class="form-control" required>
                <label>Project Name</label>
            </div>

            <div class="form-floating mb-3">
                <textarea name="description" class="form-control" style="height:100px;" required></textarea>
                <label>Description</label>
            </div>

            <div class="row g-3 mb-3">
                <div class="form-floating col-md-6">
                    <input type="date" name="start_date" class="form-control" required>
                    <label>Start Date</label>
                </div>
                <div class="form-floating col-md-6">
                    <select name="status" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <label>Status</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="developer_name" class="form-control" required>
                <label>Developer Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="helping_hand" class="form-control">
                <label>Helping Hand (Optional)</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" name="project_manager" class="form-control" required>
                <label>Project Manager</label>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-4">
                <button type="submit" class="btn btn-success">Add Project</button>
                <a href="<?= site_url('project/list'); ?>" class="btn btn-secondary">Cancel</a>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</main>