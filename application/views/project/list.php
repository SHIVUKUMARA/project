<main id="mainContent" class="py-4">
    <div class="container">
        <!-- Toast container -->
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
            <div id="toastContainer"></div>
        </div>

        <div class="card shadow-lg border-0 rounded-lg w-100" style="max-width:1200px; background:#fff;">
            <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center flex-wrap">
                <!-- Records per page dropdown -->
                <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                    <label for="recordsPerPage" class="mb-0  text-muted">Show:</label>
                    <select id="recordsPerPage" class="form-select form-select-sm">
                        <option value="25">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ms-1 text-muted">entries</span>

                </div>

                <!-- Search box -->
                <div class="d-flex align-items-center gap-2">
                    <label for="projectSearch" class="mb-0  text-muted">Search:</label>
                    <input type="text" id="projectSearch" class="form-control form-control-sm" placeholder="Search by Project Name">
                </div>
            </div>

            <div class="card-body p-0">
                <?php if (empty($projects)): ?>
                    <div class="alert alert-info m-3">No projects found.</div>
                <?php else: ?>
                    <div style="overflow:auto; max-height:500px;">
                        <table class="table table-striped table-hover table-bordered text-center mb-0" style="min-width:1000px;">
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
                            <tbody id="projectTableBody">
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
    </div>
</main>

<!-- Optional JS for search and records limit -->
<script>
    const searchInput = document.getElementById('projectSearch');
    const projectRows = document.querySelectorAll('#projectTableBody tr');
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        projectRows.forEach(row => {
            const projectName = row.children[1].textContent.toLowerCase();
            row.style.display = projectName.includes(filter) ? '' : 'none';
        });
    });

    const recordsSelect = document.getElementById('recordsPerPage');
    recordsSelect.addEventListener('change', function() {
        const limit = parseInt(this.value);
        projectRows.forEach((row, index) => {
            row.style.display = index < limit ? '' : 'none';
        });
    });
    recordsSelect.dispatchEvent(new Event('change'));
</script>