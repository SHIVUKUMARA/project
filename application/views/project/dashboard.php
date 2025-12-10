<main id="mainContent" class="py-4 bg-body">
    <div class="container">

        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 text-center py-3">
                    <h6 class="text-muted mb-2">Total Projects</h6>
                    <h3 class="display-6 text-primary mb-2"><?= html_escape($total_projects); ?></h3>
                    <i class="bi bi-kanban display-5 text-primary"></i>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 text-center py-3">
                    <h6 class="text-muted mb-2">Pending</h6>
                    <h3 class="display-6 text-warning mb-2"><?= html_escape($status_counts['Pending']); ?></h3>
                    <i class="bi bi-hourglass-split display-5 text-warning"></i>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 text-center py-3">
                    <h6 class="text-muted mb-2">Ongoing</h6>
                    <h3 class="display-6 text-primary mb-2"><?= html_escape($status_counts['Ongoing']); ?></h3>
                    <i class="bi bi-arrow-repeat display-5 text-primary"></i>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 text-center py-3">
                    <h6 class="text-muted mb-2">Completed</h6>
                    <h3 class="display-6 text-success mb-2"><?= html_escape($status_counts['Completed']); ?></h3>
                    <i class="bi bi-check-circle display-5 text-success"></i>
                </div>
            </div>
        </div>

        <div class="card mt-5 shadow-sm border-0" style="max-width:600px; margin:auto;">
            <div class="card-header bg-white text-center">
                <h5 class="mb-0">Projects Status Chart</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart" height="300"></canvas>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Ongoing', 'Completed'],
            datasets: [{
                label: 'Projects Status',
                data: [
                    <?= $status_counts['Pending']; ?>,
                    <?= $status_counts['Ongoing']; ?>,
                    <?= $status_counts['Completed']; ?>
                ],
                backgroundColor: ['#ffc107', '#0d6efd', '#198754'],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        padding: 15
                    }
                }
            }
        }
    });
</script>