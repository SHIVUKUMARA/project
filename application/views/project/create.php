<main class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px); padding:20px; background:#f8f9fa;">
    <div class="card shadow-lg border-0 rounded-lg w-100" style="max-width:700px;background:#fff;">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0 p-2">Create Project</h3>
        </div>
        <div class="card-body p-4">

            <!-- Success/Error message container -->
            <div id="msg"></div>

            <?= form_open('project/store', ['id' => 'createProjectForm']); ?>

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

<!-- jQuery CDN (ensure included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function() {
        var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

        $('#createProjectForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serializeArray();
            formData.push({
                name: csrfName,
                value: csrfHash
            });

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $.param(formData),
                dataType: 'json',
                beforeSend: function() {
                    $('#msg').html('<div class="alert alert-info">Processing...</div>');
                },
                success: function(response) {
                    // Update CSRF token
                    csrfName = response.csrfName;
                    csrfHash = response.csrfHash;

                    if (response.success) {
                        $('#msg').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#createProjectForm')[0].reset();
                    } else {
                        $('#msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function() {
                    $('#msg').html('<div class="alert alert-danger">Something went wrong!</div>');
                }
            });
        });
    });
</script>