$(document).ready(function () {
	const $sidebar = $("#sidebar");
	const $mainContent = $("#mainContent");
	const $topNav = $("#topNav");

	// Function to update mainContent position (keeps content centered)
	function adjustMainContent() {
		const sidebarWidth = $sidebar.hasClass("collapsed") ? 75 : 260;
		$mainContent.css("left", sidebarWidth + "px");
	}

	// Initial adjustment on page load
	adjustMainContent();

	// Sidebar toggle
	$("#sidebarToggle").on("click", function () {
		$sidebar.toggleClass("collapsed");
		$topNav.toggleClass("sidebar-collapsed");
		adjustMainContent();
	});

	// Dropdown toggle (only if sidebar not collapsed)
	$(".nav-item.dropdown > .dropdown-toggle").on("click", function (e) {
		e.preventDefault();
		if (!$sidebar.hasClass("collapsed")) {
			$(this).closest(".nav-item.dropdown").toggleClass("open");
		}
	});

	// Highlight active menu/submenu based on URL
	const currentURL = window.location.href.split(/[?#]/)[0]; // Remove query/hash

	// Check all submenu items
	$(".submenu .dropdown-item").each(function () {
		const linkURL = this.href.split(/[?#]/)[0];
		if (linkURL === currentURL) {
			$(this).addClass("active");

			// Open parent dropdown if a submenu is active
			const $parentDropdown = $(this).closest(".nav-item.dropdown");
			if ($parentDropdown.length) {
				$parentDropdown.addClass("open");
				$parentDropdown.find("> .dropdown-toggle").addClass("active");
			}
		}
	});

	// Check all top-level menu items (not dropdown toggles)
	$(".nav-item > a:not(.dropdown-toggle)").each(function () {
		const linkURL = this.href.split(/[?#]/)[0];
		if (linkURL === currentURL) {
			$(this).addClass("active");
		}
	});
});
