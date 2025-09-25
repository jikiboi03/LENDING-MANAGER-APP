let saveMethod;
let table;
let text;
let tableID = $("table").attr("id");
const today = new Date().toISOString().split("T")[0];

$(
	"#form_add_loan, #form_add_interest, #form_add_payment, #form_quick_payment"
).submit(function (event) {
	event.preventDefault();
});

$(document).ready(function () {
	const getTable = (selector, options) => {
		return $(selector).DataTable({
			processing: true,
			language: {
				processing:
					'<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span>',
			},
			serverSide: true,
			order: [],
			scrollX: true,
			...options,
		});
	};

	const getAjaxOption = (url) => ({
		ajax: {
			url,
			type: "POST",
		},
	});

	const tableMap = {
		"companies-table": () => {
			table = getTable("#companies-table", {
				...getAjaxOption("showlist-companies"),
				columnDefs: [
					{ targets: [-1], orderable: false },
					{ targets: 5, className: "text-center" },
				],
			});
		},

		"atm-table": () => {
			table = getTable("#atm-table", {
				...getAjaxOption("showlist-atm"),
				columnDefs: [
					{ targets: [-1], orderable: false },
					{ targets: 4, className: "text-center" },
				],
			});
		},

		"clients-table": () => {
			table = getTable("#clients-table", {
				...getAjaxOption("showlist-clients"),
				pageLength: 15,
				columnDefs: [
					{ targets: [-1, -3], orderable: false },
					{ targets: 2, className: "text-right large-font-col" },
					{ targets: 3, className: "text-center large-font-col" },
					{ targets: 7, className: "text-center" },
				],
				rowCallback(row, data, index) {
					const [, , col2, col3, col4, col5, col6, col7, sex, status] = data;
					const $api = this.api();

					$api
						.cells(row, 0)
						.nodes()
						.to$()
						.css("background-color", sex === "Male" ? "#d4d1ff" : "#f5c4d3");

					if (status === "active") {
						const color = isOdd(index) ? "#c0f1ee" : "#c8eaea";
						[
							$api.cells(row, 2),
							$api.cells(row, 3),
							$api.cells(row, 4),
							$api.cells(row, 5),
							$api.cells(row, 6),
							$api.cells(row, 7),
						].forEach((cell) =>
							cell.nodes().to$().css("background-color", color)
						);
					}
				},
			});
		},

		"loans-table": () => {
			const client_id = $('[name="client_id"]').val();
			table = getTable("#loans-table", {
				...getAjaxOption(
					`../Profiles/Profiles_controller/ajax_list/${client_id}`
				),
				ordering: false,
				columnDefs: [
					{ targets: [-1], orderable: false },
					{ targets: [1, 3, 5], className: "text-right" },
					{ targets: [2, 4], className: "text-right large-font-col" },
				],
				rowCallback(row, data) {
					const status = data[5];
					const $node = this.api().row(row).nodes().to$();
					const colors = { New: "#99ff99", Ongoing: "#ccff99" };
					$node.css("background-color", colors[status] || "#f5f5f5");
				},
			});
		},

		"client-portal-loans-table": () => {
			const client_id = $('[name="client_id"]').val();
			table = getTable("#client-portal-loans-table", {
				...getAjaxOption(
					`../Client_portal/Client_portal_controller/ajax_list/${client_id}`
				),
				ordering: false,
				searching: false,
				bPaginate: false,
				columnDefs: [
					{ targets: [-1], orderable: false },
					{ targets: 2, visible: false },
				],
				rowCallback(row, data) {
					const status = data[2];
					const $node = this.api().row(row).nodes().to$();
					const colors = { New: "#99ff99", Ongoing: "#ccff99" };
					$node.css("background-color", colors[status] || "#cccccc");
				},
			});
		},

		"transactions-table": () => {
			const loan_id = $('[name="loan_id"]').val();
			table = getTable("#transactions-table", {
				...getAjaxOption(
					`../../../Transactions/Transactions_controller/ajax_list/${loan_id}`
				),
				ordering: false,
				searching: false,
				bPaginate: false,
				columnDefs: [
					{ targets: [-1], orderable: false },
					{ targets: [1, 3, 4, 5], className: "text-right large-font-col" },
					{ targets: 7, className: "text-center" },
				],
				rowCallback(row, data) {
					const type = data[2];
					const $node = this.api().row(row).nodes().to$();
					const colors = {
						"Trans. Start": "#99ff99",
						"Paid Partial": "#ccff99",
						"Add Interest": "#99ffff",
						"Add Amount": "#99cccc",
						"Discount Amount": "#ffcc99",
					};
					if (colors[type]) $node.css("background-color", colors[type]);
				},
			});
		},

		"client-portal-transactions-table": () => {
			const loan_id = $('[name="loan_id"]').val();
			table = getTable("#client-portal-transactions-table", {
				...getAjaxOption(
					`../../../Trans_cp/Trans_cp_controller/ajax_list/${loan_id}`
				),
				ordering: false,
				searching: false,
				bPaginate: false,
				columnDefs: [
					{ targets: [-1], orderable: false },
					{ targets: [3, 4, 5], className: "text-right" },
					{ targets: 7, className: "text-center" },
				],
				rowCallback(row, data) {
					const type = data[2];
					const $node = this.api().row(row).nodes().to$();
					const colors = {
						"Trans. Start": "#99ff99",
						"Paid Partial": "#ccff99",
						"Paid Full": "#cccccc",
						"Add Interest": "#99ffff",
						"Add Amount": "#99cccc",
						"Discount Amount": "#ffcc99",
					};
					if (colors[type]) $node.css("background-color", colors[type]);
				},
			});
		},

		"capital-table": () => {
			table = getTable("#capital-table", {
				...getAjaxOption("showlist-capital"),
				columnDefs: [
					{ targets: [-1, -2, -3], orderable: false },
					{ targets: 1, className: "text-center" },
					{ targets: [2, 3], className: "text-right" },
					{ targets: [4, 5], className: "text-center" },
				],
				rowCallback(row, data, index) {
					const amount = parseFloat(data[2]);
					const $node = this.api().row(row).nodes().to$();
					const even = isOdd(index) === 1;
					const bgColor =
						amount >= 0
							? even
								? "#99cccc"
								: "#aad5d5"
							: even
							? "#ffcc99"
							: "#ffbf80";
					$node.css("background-color", bgColor);
				},
			});
		},

		"top-clients-list-table": () => {
			table = getTable("#top-clients-list-table", {
				...getAjaxOption("showlist-statistics"),
				ordering: false,
				searching: false,
				columnDefs: [
					{ targets: [-1], orderable: false },
					{ targets: [2, 3, 4, 5], className: "text-right" },
					{ targets: 6, className: "text-center" },
				],
				rowCallback(row, data, index) {
					const has_balance = parseFloat(data[4]);
					if (has_balance !== 0) {
						const $node = this.api().row(row).nodes().to$();
						$node.css("background-color", isOdd(index) ? "#ffffcc" : "#ffff99");
					}
				},
			});
		},

		"logs-table": () => {
			const logs_type = $('[name="logs_type"]').val();
			table = getTable("#logs-table", {
				...getAjaxOption(`showlist-logs-${logs_type}`),
				columnDefs: [{ targets: [-1], orderable: false }],
				rowCallback(row, data) {
					const log_type = data[1];
					const colors = {
						Add: "#99ff99",
						Update: "#99ffff",
						Delete: "#ffcc99",
						Logout: "#cccccc",
						Report: "#ccff99",
					};
					this.api()
						.row(row)
						.nodes()
						.to$()
						.css("background-color", colors[log_type]);
				},
			});
		},

		"schedules-table": () => {
			table = getTable("#schedules-table", {
				...getAjaxOption("showlist-schedules"),
				columnDefs: [{ targets: [-1], orderable: false }],
				rowCallback(row, data) {
					const type = data[6];
					const $node = this.api().row(row).nodes().to$();
					if (type === "Today") $node.css("background-color", "#99ff99");
					else if (type === "Ended") $node.css("background-color", "#cccccc");
				},
			});
		},

		"users-table": () => {
			table = getTable("#users-table", {
				...getAjaxOption("showlist-users"),
				columnDefs: [{ targets: [-1], orderable: false }],
				rowCallback(row, data) {
					const [user_id, user_type] = data;
					const $node = this.api().row(row).nodes().to$();
					if (user_type === "Administrator")
						$node.css("background-color", "#66ffff");
					if (user_id === "U101") $node.css("background-color", "#ffff66");
				},
			});
		},
	};

	if (tableMap.hasOwnProperty(tableID)) {
		tableMap[tableID]();
	}
});

function isOdd(num) {
	return num % 2;
}

// -------------------------------------------------

// reset file path everytime modal_form_view is closed - for image upload
$("#modal_form_view").on("hidden.bs.modal", function () {
	$("#userfile").val("");
});

// ============================================================ DASHBOARD BACKUP DB SECTION =======================================

function back_up_db() {
	$.confirm({
		title: "Confirm Backup",
		theme: "modern",
		type: "blue",
		icon: "fa fa-database",
		content: "Are you sure to backup the database?",
		buttons: {
			confirm: function () {
				window.location.href = "database-backup.php";
			},
			cancel: function () {
				// close
			},
		},
	});
}

// ================================================================== VIEW IMAGE SECTION ==========================================

function readURL(input, image) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$(image).attr("src", e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

$("#userfile1").change(function () {
	readURL(this, "#image1");
});

$("#userfile2").change(function () {
	readURL(this, "#image2");
});

$("#userfile3").change(function () {
	readURL(this, "#image3");
});

// ================================================== VIEW SECTION =================================================================

function view_profile(client_id) {
	window.location.href = "profiles-page/" + client_id;
}

function view_loan(client_id, loan_id) {
	window.location.href = "transactions-page/" + client_id + "/" + loan_id;
}

function view_cp_loan(client_id, loan_id) {
	window.location.href =
		"transactions-client-page/" + client_id + "/" + loan_id;
}

// Helper functions for modal operations
const resetForms = (forms = ["#form"]) => {
	forms.forEach((form) => document.querySelector(form)?.reset());
	$(".form-group").removeClass("has-error");
	$(".help-block").empty();
};

const showModal = (modalId, title) => {
	$(modalId).modal("show");
	$(".modal-title").text(title);
};

const handleAjaxError = () => {
	alert("Error get data from ajax");
};

const fetchData = (url, successCallback) => {
	$.ajax({
		url,
		type: "GET",
		dataType: "JSON",
		success: successCallback,
		error: handleAjaxError,
	});
};

// === Privileges ===
const edit_privileges = (id) => {
	saveMethod = "update-privileges";
	resetForms(["#form", "#form_privileges"]);

	fetchData(`Users/Users_controller/ajax_edit/${id}`, (data) => {
		$('[name="user_id"]').val(data.user_id);
		$('[name="administrator"]').val(data.administrator).prop("selected", true);
		$('[name="current_administrator"]').val(data.administrator);
		showModal("#modal_form_privileges", "EDIT PRIVILEGES");
	});
};

const view_edit_user = (id) => {
	saveMethod = "update-user";
	resetForms(["#form", "#form_privileges"]);

	fetchData(`Users/Users_controller/ajax_edit/${id}`, (data) => {
		$('[name="user_id"]').val(data.user_id);
		$('[name="username"]').val(data.username);
		$('[name="repassword"]').val(data.password);
		$('[name="current_username"]').val(data.username);
		$('[name="lastname"]').val(data.lastname);
		$('[name="firstname"]').val(data.firstname);
		$('[name="current_name"]').val(data.lastname + data.firstname);
		$('[name="contact"]').val(data.contact);
		$('[name="email"]').val(data.email);
		$('[name="address"]').val(data.address);
		showModal("#modal_form", "EDIT USER");
	});
};

// === Add Section ===
const add_company = () => {
	saveMethod = "add-company";
	resetForms();
	showModal("#modal_form", "ADD COMPANY");
};

const add_atm = () => {
	saveMethod = "add-atm";
	resetForms();
	showModal("#modal_form", "ADD ATM BANK");
};

const add_client = () => {
	saveMethod = "add-client";
	resetForms();
	showModal("#modal_form", "ADD CLIENT");
};

const add_loan = () => {
	saveMethod = "add-loan";
	resetForms(["#form_add_loan"]);
	$('[name="date_start"]').val(today);
	showModal("#modal_form", "ADD NEW LOAN");
};

const add_payment = () => {
	saveMethod = "add-payment";
	resetForms(["#form_add_payment"]);
	$('[name="date"]').val(today);
	showModal("#modal_form_add_payment", "ADD PAYMENT");
};

const quick_pay = (loan_id, total_balance) => {
	saveMethod = "quick-payment";
	resetForms(["#form_quick_payment", "#form_add_loan"]);
	$('[name="loan_id"]').val(loan_id);
	$('[name="total_balance"]').val(total_balance);
	$('[name="date"]').val(today);
	showModal("#modal_form_quick_payment", "QUICK PAY");
};

const add_interest = () => {
	saveMethod = "add-interest";
	resetForms(["#form_add_interest"]);
	showModal("#modal_form_add_interest", "ADD INTEREST");
};

const adjust_loan = () => {
	saveMethod = "adjust-loan";
	resetForms(["#form_adjust_loan"]);
	$('[name="date"]').val(today);
	showModal("#modal_form_adjust_loan", "ADJUST LOAN");
};

const adjust_capital = () => {
	saveMethod = "adjust-capital";
	resetForms();
	showModal("#modal_form", "ADJUST CAPITAL");
};

const add_schedule = () => {
	saveMethod = "add-schedule";
	resetForms();
	showModal("#modal_form", "ADD APPOINTMENT SCHEDULE");
};

const add_user = () => {
	saveMethod = "add-user";
	resetForms(["#form", "#form_privileges"]);
	showModal("#modal_form", "ADD USER");
};

// === Edit Section ===
const edit_company = (id) => {
	saveMethod = "update-company";
	resetForms();

	fetchData(`Companies/Companies_controller/ajax_edit/${id}`, (data) => {
		$('[name="comp_id"]').val(data.comp_id);
		$('[name="name"]').val(data.name);
		$('[name="address"]').val(data.address);
		$('[name="remarks"]').val(data.remarks);
		$('[name="current_name"]').val(data.name);
		showModal("#modal_form", "EDIT COMPANY");
	});
};

const edit_atm = (id) => {
	saveMethod = "update-atm";
	resetForms();

	fetchData(`Atm/Atm_controller/ajax_edit/${id}`, (data) => {
		$('[name="atm_id"]').val(data.atm_id);
		$('[name="name"]').val(data.name);
		$('[name="remarks"]').val(data.remarks);
		$('[name="current_name"]').val(data.name);
		showModal("#modal_form", "EDIT ATM BANK");
	});
};

const edit_client = (id) => {
	saveMethod = "update-client";
	resetForms();

	fetchData(`Clients/Clients_controller/ajax_edit/${id}`, (data) => {
		$('[name="client_id"]').val(data.client_id);
		$('[name="lname"]').val(data.lname);
		$('[name="fname"]').val(data.fname);
		$('[name="sex"]').val(data.sex).prop("selected", true);
		$('[name="contact"]').val(data.contact);
		$('[name="address"]').val(data.address);
		$('[name="comp_id"]').val(data.comp_id).prop("selected", true);
		$('[name="job"]').val(data.job);
		$('[name="salary"]').val(data.salary);
		$('[name="atm_id"]').val(data.atm_id).prop("selected", true);
		$('[name="atm_type"]').val(data.atm_type).prop("selected", true);
		$('[name="pin"]').val(data.pin);
		$('[name="remarks"]').val(data.remarks);
		$('[name="current_name"]').val(data.lname + data.fname);
		showModal("#modal_form", "EDIT CLIENT");
	});
};

const edit_loan = (id) => {
	saveMethod = "update-loan";
	resetForms(["#form_add_loan"]);

	fetchData(`../Profiles/Profiles_controller/ajax_edit/${id}`, (data) => {
		$('[name="loan_id"]').val(data.loan_id);
		$('[name="amount"]').val(data.amount);
		$('[name="interest"]').val(data.interest);
		$('[name="total"]').val(data.total);
		$('[name="date_start"]').val(data.date_start);
		$('[name="date_end"]').val(data.date_end);
		$('[name="remarks"]').val(data.remarks);
		showModal("#modal_form", "EDIT LOAN");
	});
};

const edit_loan_date_remarks = (id) => {
	saveMethod = "update-loan-date-remarks";
	resetForms(["#form_edit_date_remarks"]);

	fetchData(`../Profiles/Profiles_controller/ajax_edit/${id}`, (data) => {
		$('[name="loan_id"]').val(data.loan_id);
		$('[name="date_start"]').val(data.date_start);
		$('[name="remarks"]').val(data.remarks);
		showModal("#modal_form_edit_date_remarks", "EDIT LOAN DATE/REMARKS");
	});
};

const edit_trans_date_remarks = (id) => {
	saveMethod = "update-trans-date-remarks";
	resetForms(["#form_edit_date_remarks"]);

	fetchData(
		`../../../Transactions/Transactions_controller/ajax_edit/${id}`,
		(data) => {
			$('[name="trans_id"]').val(data.trans_id);
			$('[name="total"]').val(data.total);
			$('[name="date"]').val(data.date);
			$('[name="remarks"]').val(data.remarks);
			showModal(
				"#modal_form_edit_date_remarks",
				"EDIT TRANSACTION DATE/REMARKS"
			);
		}
	);
};

const edit_capital_date_remarks = (id) => {
	saveMethod = "update-capital-date-remarks";
	resetForms(["#form_edit_date_remarks"]);

	fetchData(`Capital/Capital_controller/ajax_edit/${id}`, (data) => {
		$('[name="capital_id"]').val(data.capital_id);
		$('[name="date"]').val(data.date);
		$('[name="remarks"]').val(data.remarks);
		showModal(
			"#modal_form_edit_date_remarks",
			"EDIT CAPITAL ADJUSTMENT DATE/REMARKS"
		);
	});
};

const edit_schedule = (id) => {
	saveMethod = "update-schedule";
	resetForms();

	fetchData(`Schedules/Schedules_controller/ajax_edit/${id}`, (data) => {
		$('[name="sched_id"]').val(data.sched_id);
		$('[name="title"]').val(data.title);
		$('[name="date"]').val(data.date);
		$('[name="time"]').val(data.time);
		$('[name="remarks"]').val(data.remarks);
		showModal("#modal_form", "EDIT APPOINTMENT SCHEDULE");
	});
};

function reload_table() {
	table.ajax.reload(null, false); //reload datatable ajax
}

// =================================================== SAVE SECTION =====================================================================

function cancel_trans() {
	window.location.href =
		"../../../profiles-page/" + $('[name="client_id"]').val();
}

function clients_page() {
	window.location.href = "../clients-page";
}

function cancel_cp_trans() {
	window.location.href =
		"../../../client-portal-page/" + $('[name="client_id"]').val();
}

// Utility to map save methods to URLs and form IDs
const saveConfig = {
	"add-client": { url: "Clients/Clients_controller/ajax_add" },
	"update-client": { url: "Clients/Clients_controller/ajax_update" },
	"add-company": { url: "Companies/Companies_controller/ajax_add" },
	"update-company": { url: "Companies/Companies_controller/ajax_update" },
	"add-atm": { url: "Atm/Atm_controller/ajax_add" },
	"update-atm": { url: "Atm/Atm_controller/ajax_update" },
	"add-loan": {
		url: "../Profiles/Profiles_controller/ajax_add",
		form: "#form_add_loan",
	},
	"update-loan": { url: "../Profiles/Profiles_controller/ajax_update" },
	"update-loan-date-remarks": {
		url: "../Profiles/Profiles_controller/ajax_update_date_remarks",
		form: "#form_edit_date_remarks",
	},
	"add-payment": {
		url: "../../../Transactions/Transactions_controller/ajax_paid",
		form: "#form_add_payment",
	},
	"quick-payment": {
		url: "../Profiles/Profiles_controller/ajax_paid",
		form: "#form_quick_payment",
	},
	"add-interest": {
		url: "../../../Transactions/Transactions_controller/ajax_add_interest",
		form: "#form_add_interest",
	},
	"adjust-loan": {
		url: "../../../Transactions/Transactions_controller/ajax_adjustment",
		form: "#form_adjust_loan",
	},
	"update-trans-date-remarks": {
		url: "../../../Transactions/Transactions_controller/ajax_update",
		form: "#form_edit_date_remarks",
	},
	"adjust-capital": { url: "Capital/Capital_controller/ajax_add" },
	"update-capital-date-remarks": {
		url: "Capital/Capital_controller/ajax_update",
		form: "#form_edit_date_remarks",
	},
	"add-schedule": { url: "Schedules/Schedules_controller/ajax_add" },
	"update-schedule": { url: "Schedules/Schedules_controller/ajax_update" },
	"add-user": { url: "Users/Users_controller/ajax_add" },
	"update-user": { url: "Users/Users_controller/ajax_update" },
	"update-privileges": {
		url: "Users/Users_controller/ajax_privileges_update",
		form: "#form_privileges",
	},
};

let isSaving = false;

function save() {
	if (isSaving) return;
	isSaving = true;

	// Reset validation errors
	$(".form-group").removeClass("has-error");
	$(".help-block").empty();

	// Disable save buttons
	$("#btnSave, .btnSave").prop("disabled", true);

	// Get configuration
	const config = saveConfig[saveMethod] || {};
	const form = config.form || "#form";
	const url = config.url;

	if (!url) {
		alert("Save method not configured.");
		isSaving = false;
		$("#btnSave, .btnSave").prop("disabled", false);
		return;
	}

	$.ajax({
		url,
		type: "POST",
		data: $(form).serialize(),
		dataType: "JSON",
		success: function (data) {
			if (data.status) {
				$(".modal").modal("hide");
				if ($(form).length) {
					$(form)[0].reset();
				}
				reload_table();
				handleLogging(saveMethod);
			} else {
				data.inputerror.forEach((input, i) => {
					const element = $('[name="' + input + '"]');
					element.parent().parent().addClass("has-error");
					element.next().text(data.error_string[i]);
				});
			}
			isSaving = false;
			$("#btnSave, .btnSave").prop("disabled", false);
		},
		error: function () {
			alert("Error adding / update data");
			isSaving = false;
			$("#btnSave, .btnSave").prop("disabled", false);
		},
	});
}

function handleLogging(method) {
	let log_type = "";
	let details = "";

	const getValue = (name) => $('[name="' + name + '"]').val();

	switch (method) {
		case "add-client":
			log_type = "Add";
			details = `New client record added: ${getValue("lname")}, ${getValue(
				"fname"
			)}`;
			break;
		case "update-client":
			log_type = "Update";
			details = `Client updated C${getValue("client_id")}: ${getValue(
				"lname"
			)}, ${getValue("fname")}`;
			break;
		case "add-company":
			log_type = "Add";
			details = `New company added: ${getValue("name")}`;
			break;
		case "update-company":
			log_type = "Update";
			details = `Company updated J${getValue("comp_id")}: ${getValue(
				"current_name"
			)} to ${getValue("name")}`;
			break;
		case "add-atm":
			log_type = "Add";
			details = `New ATM bank added: ${getValue("name")}`;
			break;
		case "update-atm":
			log_type = "Update";
			details = `ATM Bank updated A${getValue("atm_id")}: ${getValue(
				"current_name"
			)} to ${getValue("name")}`;
			break;
		case "add-payment":
		case "quick-payment":
		case "add-interest":
			log_type = "Add";
			details = `New ${
				method.includes("interest") ? "interest" : "payment"
			} added to Loan ID: L${getValue("loan_id")} of Client: ${getValue(
				"client_name"
			)}`;
			method === "quick-payment"
				? set_system_log_one(log_type, details)
				: set_system_log_three(log_type, details);
			location.reload();
			return;
		case "adjust-loan":
			log_type = "Update";
			details = `New loan adjustment to Loan ID: L${getValue(
				"loan_id"
			)} of Client: ${getValue("client_name")}`;
			set_system_log_three(log_type, details);
			location.reload();
			return;
		case "update-trans-date-remarks":
			log_type = "Update";
			details = `Transaction updated T${getValue(
				"trans_id"
			)} of Client: ${getValue("client_name")}`;
			set_system_log_three(log_type, details);
			return;
		case "adjust-capital":
			log_type = "Update";
			details = "New capital adjustment";
			set_system_log(log_type, details);
			location.reload();
			return;
		case "update-capital-date-remarks":
			log_type = "Update";
			details = `Capital adjustment updated to: P${getValue("capital_id")}`;
			break;
		case "add-schedule":
			log_type = "Add";
			details = `New schedule added: ${getValue("title")}`;
			break;
		case "update-schedule":
			log_type = "Update";
			details = `Schedule updated S${getValue("sched_id")}: ${getValue(
				"title"
			)}`;
			break;
		case "add-loan":
			log_type = "Add";
			details = `New loan added to: C${getValue("client_id")}: ${getValue(
				"client_name"
			)}`;
			set_system_log_one(log_type, details);
			location.reload();
			return;
		case "update-loan":
		case "update-loan-date-remarks":
			log_type = "Update";
			details = `Loan updated to: C${getValue("client_id")}: ${getValue(
				"client_name"
			)}`;
			set_system_log_one(log_type, details);
			return;
		case "add-user":
			log_type = "Add";
			details = `New user added: ${getValue("username")}`;
			break;
		case "update-user":
			log_type = "Update";
			details = `User record updated U${getValue("user_id")}: ${getValue(
				"username"
			)}`;
			break;
		case "update-privileges":
			log_type = "Update";
			details = `User record updated U${getValue("user_id")}`;
			break;
		default:
			return;
	}
	set_system_log(log_type, details);
}

// ================================================= LOGS SECTION ===========================================================================

const sanitizeDetails = (details) => details.replace(/[|&;$%@"<>()+,]/g, "");

const sendSystemLog = (basePath, log_type, details) => {
	const cleanString = sanitizeDetails(details);

	$.ajax({
		url: `${basePath}Logs/Logs_controller/ajax_add/${log_type}/${cleanString}`,
		type: "POST",
		dataType: "JSON",
		success: () => {},
		error: (jqXHR, textStatus, errorThrown) => {
			alert("Error get data from ajax");
		},
	});
};

function set_system_log(log_type, details) {
	sendSystemLog("", log_type, details);
}

function set_system_log_one(log_type, details) {
	sendSystemLog("../", log_type, details);
}

function set_system_log_two(log_type, details) {
	sendSystemLog("../../", log_type, details);
}

function set_system_log_three(log_type, details) {
	sendSystemLog("../../../", log_type, details);
}

// ================================================= DELETE SECTION =========================================================================

const confirmAndDelete = ({
	url,
	log_type,
	details,
	system_log_fn = set_system_log,
	postDelete = () => {},
}) => {
	$.confirm({
		title: "Confirm Delete",
		theme: "modern",
		type: "red",
		icon: "fa fa-warning",
		content: "Are you sure to delete this data?",
		buttons: {
			confirm: () => {
				$.ajax({
					url,
					type: "POST",
					dataType: "JSON",
					success: () => {
						system_log_fn(log_type, details);
						$("#modal_form").modal("hide");
						postDelete();
						reload_table();
					},
					error: () => {
						alert("Error deleting data");
					},
				});
			},
			cancel: () => {},
		},
	});
};

function delete_client(id) {
	const log_type = "Delete";
	const details = `Client deleted C${id}`;
	const url = `Clients/Clients_controller/ajax_delete/${id}`;
	confirmAndDelete({ url, log_type, details });
}

function delete_company(id, name) {
	const log_type = "Delete";
	const details = `Company deleted J${id}: ${name}`;
	const url = `Companies/Companies_controller/ajax_delete/${id}`;
	confirmAndDelete({ url, log_type, details });
}

function delete_atm(id, name) {
	const log_type = "Delete";
	const details = `ATM Bank deleted A${id}: ${name}`;
	const url = `Atm/Atm_controller/ajax_delete/${id}`;
	confirmAndDelete({ url, log_type, details });
}

function delete_loan(id) {
	const log_type = "Delete";
	const clientName = $('[name="client_name"]').val();
	const details = `Loan deleted: L${id} from client: ${clientName}`;
	const url = `../Profiles/Profiles_controller/ajax_delete/${id}`;
	confirmAndDelete({
		url,
		log_type,
		details,
		system_log_fn: set_system_log_one,
		postDelete: () => window.location.reload(),
	});
}

function delete_schedule(id) {
	const log_type = "Delete";
	const details = "Appointment schedule deleted";
	const url = `Schedules/Schedules_controller/ajax_delete/${id}`;
	confirmAndDelete({ url, log_type, details });
}

function delete_user(id) {
	const log_type = "Delete";
	const details = "User record deleted";
	const url = `Users/Users_controller/ajax_delete/${id}`;
	confirmAndDelete({
		url,
		log_type,
		details,
		postDelete: () => $("#modal_form_privileges").modal("hide"),
		errorMessage: "Unable to delete one remaining administrator account",
	});
}

function delete_interest(id, interest_amt) {
	const log_type = "Delete";
	const clientName = $('[name="client_name"]').val();
	const loan_id = $('[name="loan_id"]').val();
	const details = `Loan interest deleted from client: ${clientName}`;
	const url = `../../../Transactions/Transactions_controller/ajax_delete/${id}/${interest_amt}/${loan_id}`;
	confirmAndDelete({
		url,
		log_type,
		details,
		system_log_fn: set_system_log_three,
		postDelete: () => window.location.reload(),
	});
}

function delete_payment(id, amount) {
	const log_type = "Delete";
	const clientName = $('[name="client_name"]').val();
	const loan_id = $('[name="loan_id"]').val();
	const details = `Loan payment deleted from client: ${clientName}`;
	const url = `../../../Transactions/Transactions_controller/ajax_delete_pay/${id}/${amount}/${loan_id}`;
	confirmAndDelete({
		url,
		log_type,
		details,
		system_log_fn: set_system_log_three,
		postDelete: () => window.location.reload(),
	});
}

// =========================================================
// =============== Shared Helper Functions =================
// =========================================================

const getVal = (name) => parseFloat($(`[name="${name}"]`).val()) || 0;
const setVal = (name, value) => $(`[name="${name}"]`).val(value);
const setTotal = (total) => {
	setVal("total", total);
	setVal("total_display", formatCurrency(total));
};
const resetPercentage = () =>
	$('[name="percentage"]').val(0).prop("selected", true);
function formatCurrency(num) {
	return num.toLocaleString(undefined, {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2,
	});
}

// =========================================================
// =============== Cash Input Buttons (10-12-19) ===========
// =========================================================

function add_cash_input(cash_input) {
	const new_cash = getVal("amount") + cash_input;
	setVal("amount", new_cash);
	resetPercentage();
	update_total_value();
}

function clear_cash_input() {
	setVal("amount", 0);
	setVal("interest", 0);
	resetPercentage();
	update_total_value();
}

function add_cash_input_interest(cash_input) {
	const new_cash = getVal("interest") + cash_input;
	setVal("interest", new_cash);
	resetPercentage();
	update_total_value_trans();
}

function clear_cash_input_interest() {
	setVal("interest", 0);
	resetPercentage();
	update_total_value_trans();
}

function add_cash_input_payment(cash_input) {
	const new_cash = getVal("amount") + cash_input;
	setVal("amount", new_cash);
	update_total_value_trans_payment();
}

function clear_cash_input_payment() {
	setVal("amount", 0);
	update_total_value_trans_payment();
}

function full_cash_input_payment() {
	setVal("amount", getVal("total_balance"));
	update_total_value_trans_payment();
}

// =========================================================
// ================== Loan Form Listeners ==================
// =========================================================

$("#amount").change(() => {
	resetPercentage();
	update_total_value();
});

$("#interest").change(() => {
	resetPercentage();
	update_total_value();
});

$("#percentage").change(() => {
	const percentage = getVal("percentage");
	if (percentage !== 0) {
		const interest = (getVal("amount") * percentage).toFixed(2);
		setVal("interest", interest);
		update_total_value();
	}
});

function update_total_value() {
	const total = getVal("amount") + getVal("interest");
	setTotal(total);
}

// =========================================================
// ============= Transaction Form Listeners ================
// =========================================================

$("#amount_payment").change(() => {
	const total =
		getVal("total_balance") - parseFloat($("#amount_payment").val()) || 0;
	setTotal(total);
});

$("#interest_amount").change(() => {
	resetPercentage();
	update_total_value_trans();
});

$("#percentage_trans").change(() => {
	const percentage = getVal("percentage");
	if (percentage !== 0) {
		const interest = (getVal("total_balance") * percentage).toFixed(2);
		setVal("interest", interest);
		update_total_value_trans();
	}
});

$("#adjustment_amount").change(() => {
	const total = getVal("total_balance") + getVal("adjustment_amount");
	setTotal(total);
});

function update_total_value_trans() {
	const total = getVal("total_balance") + getVal("interest");
	setTotal(total);
}

function update_total_value_trans_payment() {
	const total = getVal("total_balance") - getVal("amount");
	setTotal(total);
}

// =========================================================
// ================= Capital Form Listener =================
// =========================================================

$("#amount_capital").change(() => {
	const total = getVal("amount") + getVal("total_capital");
	setTotal(total);
});

// =========================================================
// ==================== Fix Bal Paid ========================
// =========================================================

function fix_bal_paid_calculation() {
	const loan_id = $('[name="loan_id"]').val();

	$.ajax({
		url: `../../../Profiles/Profiles_controller/ajax_update_bal_paid/${loan_id}`,
		type: "POST",
		dataType: "JSON",
		success: () => location.reload(),
		error: () => alert("Error get data from ajax"),
	});
}

// ========================================== STATISTICS CHARTS =====================================================

// Helper: get float values from input names with prefix and optional index suffix
const getMonthlyValues = (prefix = "", index = "") =>
	[
		"jan",
		"feb",
		"mar",
		"apr",
		"may",
		"jun",
		"jul",
		"aug",
		"sep",
		"oct",
		"nov",
		"dec",
	].map((month) => parseFloat($(`[name="${prefix}${month}${index}"]`).val()));

// Helper: build a Highcharts line chart
const renderInterestChart = (containerId, year, yearTotal, data) => {
	Highcharts.chart(containerId, {
		chart: { type: "line" },
		title: {
			text: `Net Income ( ${year} ): ₱ ${yearTotal}`,
		},
		subtitle: {
			text: `January to December ${year}`,
		},
		xAxis: {
			categories: [
				"Jan",
				"Feb",
				"Mar",
				"Apr",
				"May",
				"Jun",
				"Jul",
				"Aug",
				"Sep",
				"Oct",
				"Nov",
				"Dec",
			],
		},
		yAxis: {
			title: { text: "Interest values in PhP amount" },
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true,
					formatter() {
						return Highcharts.numberFormat(this.y, 2);
					},
				},
				enableMouseTracking: true,
				tooltip: {
					pointFormat:
						'<b style="color:#66cccc;">●</b> {series.name}: <b>₱ {point.y}.00</b>',
				},
			},
		},
		series: [
			{
				name: "Monthly total interest",
				data,
			},
		],
	});
};

// Main chart (current year)
if (document.getElementById("container-interests")) {
	const current_year = $('[name="current_year"]').val();
	const year_total = $('[name="year_total"]').val();
	const monthlyData = getMonthlyValues();

	renderInterestChart(
		"container-interests",
		current_year,
		year_total,
		monthlyData
	);
}

// Previous years chart(s)
const years_count = parseInt($('[name="years_count"]').val(), 10);

for (let i = 0; i < years_count; i++) {
	const containerId = `container-interests-prev${i}`;
	if (document.getElementById(containerId)) {
		const prev_year = $(`[name="prev_year${i}"]`).val();
		const prev_year_total = $(`[name="prev_year_total${i}"]`).val();
		const monthlyData = getMonthlyValues("prev_", i);

		renderInterestChart(containerId, prev_year, prev_year_total, monthlyData);
	}
}

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
});
