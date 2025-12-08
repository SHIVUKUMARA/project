<main class="d-flex justify-content-center align-items-center my-5">
    <div class="card shadow-lg border-0 rounded-lg w-100" style="max-width:700px;">
        <div class="card-header bg-warning text-white text-center">
            <h3 class="mb-0 p-2">Edit Project</h3>
        </div>
        <div class="card-body p-4">

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <?= form_open('project/edit/' . $project['id']); ?>

            <div class="form-floating mb-3">
                <input type="text" name="project_name" class="form-control" value="<?= html_escape(set_value('project_name', $project['project_name'])); ?>" required>
                <label>Project Name</label>
            </div>

            <div class="form-floating mb-3">
                <textarea name="description" class="form-control" style="height:100px;" required><?= html_escape(set_value('description', $project['description'])); ?></textarea>
                <label>Description</label>
            </div>

            <div class="row g-3 mb-3">
                <div class="form-floating col-md-6">
                    <input type="date" name="start_date" class="form-control" value="<?= html_escape(set_value('start_date', $project['start_date'])); ?>" required>
                    <label>Start Date</label>
                </div>
                <div class="form-floating col-md-6">
                    <select name="status" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="Pending" <?= set_select('status', 'Pending', $project['status'] == 'Pending'); ?>>Pending</option>
                        <option value="Ongoing" <?= set_select('status', 'Ongoing', $project['status'] == 'Ongoing'); ?>>Ongoing</option>
                        <option value="Completed" <?= set_select('status', 'Completed', $project['status'] == 'Completed'); ?>>Completed</option>
                    </select>
                    <label>Status</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="developer_name" class="form-control" value="<?= html_escape(set_value('developer_name', $project['developer_name'])); ?>" required>
                <label>Developer Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="helping_hand" class="form-control" value="<?= html_escape(set_value('helping_hand', $project['helping_hand'])); ?>">
                <label>Helping Hand (Optional)</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" name="project_manager" class="form-control" value="<?= html_escape(set_value('project_manager', $project['project_manager'])); ?>" required>
                <label>Project Manager</label>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-4">
                <button type="submit" class="btn btn-warning">Update Project</button>
                <a href="<?= site_url('project/list'); ?>" class="btn btn-secondary">Cancel</a>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</main>