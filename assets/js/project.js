// Add or create Project
$(function () {
	function ajaxFormHandler(formSelector, msgSelector) {
		$(formSelector).on("submit", function (e) {
			e.preventDefault();

			let form = $(this);
			let msgDiv = $(msgSelector);

			$.ajax({
				url: form.attr("action"),
				type: "POST",
				data: form.serialize(),
				dataType: "json",
				beforeSend: function () {
					msgDiv.html('<div class="alert alert-info">Processing...</div>');
				},
				success: function (res) {
					if (res.csrfName && res.csrfHash) {
						$("input[name='" + res.csrfName + "']").val(res.csrfHash);
					}

					if (res.success || res.status === "success") {
						msgDiv.html(
							'<div class="alert alert-success">' + res.message + "</div>"
						);
						if (res.resetForm) form[0].reset();
					} else {
						msgDiv.html(
							'<div class="alert alert-danger">' +
								(res.message || res.errors) +
								"</div>"
						);
					}
				},
				error: function (xhr) {
					msgDiv.html(
						'<div class="alert alert-danger">Server error. Try again.<br>' +
							xhr.responseText +
							"</div>"
					);
				},
			});
		});
	}

	ajaxFormHandler("#createProjectForm", "#msg");

	ajaxFormHandler("#editProjectForm", "#response");
});

// Edit or Update Project details
$(function () {
	$("#editProjectForm").on("submit", function (e) {
		e.preventDefault();

		let form = $(this);
		let submitBtn = $("#submitBtn");

		submitBtn.prop("disabled", true).text("Updating...");

		$.ajax({
			url: form.attr("action"),
			type: "POST",
			data: form.serialize(),
			dataType: "json",
			success: function (res) {
				$("input[name='" + res.csrfName + "']").val(res.csrfHash);

				if (res.status === "error") {
					$("#response").html(
						`<div class="alert alert-danger">${res.errors}</div>`
					);
					submitBtn.prop("disabled", false).text("Update Project");
				}

				if (res.status === "success") {
					$("#response").html(
						`<div class="alert alert-success">${res.message}</div>`
					);
					submitBtn.prop("disabled", false).text("Update Project");
				}
			},
			error: function () {
				$("#response").html(
					`<div class="alert alert-danger">Server error. Try again.</div>`
				);
				submitBtn.prop("disabled", false).text("Update Project");
			},
		});
	});
});

// delete Project
$(document).ready(function () {
	$(document).on("click", ".btn-delete", function () {
		let projectId = $(this).data("id");
		if (!confirm("Are you sure you want to delete this project?")) return;

		let form = $(this).closest("td").find(".deleteProjectForm");

		$.ajax({
			url: form.attr("action"),
			type: "POST",
			data: form.serialize(),
			dataType: "json",
			success: function (res) {
				// Update CSRF token in the form
				form
					.find("input[name='<?= $this->security->get_csrf_token_name(); ?>']")
					.val(res.csrfHash);

				if (res.status === "success") {
					$("#projectRow" + projectId).remove();
					showToast(res.message, "success");
				} else {
					showToast(res.message, "danger");
				}
			},
			error: function () {
				showToast("Server error. Try again.", "danger");
			},
		});
	});

	// toast function
	function showToast(message, type = "info") {
		let toastId = "toast" + Date.now();
		let toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`;
		$("#toastContainer").append(toastHtml);
		let toastEl = document.getElementById(toastId);
		let toast = new bootstrap.Toast(toastEl, { delay: 5000 });
		toast.show();

		toastEl.addEventListener("hidden.bs.toast", function () {
			$(this).remove();
		});
	}
});
