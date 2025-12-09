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
