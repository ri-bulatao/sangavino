const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {
    // Profile
    if (window.location.href === route("profile.index")) {
        $("#profile_nav").addClass("active");
    }

    // Activity Logs
    if (window.location.href === route("admin.activity_logs.index")) {
        const activitylog_data = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "description" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            { data: "properties.ip" },
        ];
        c_index(
            $(".activitylog_dt"),
            route("admin.activity_logs.index"),
            activitylog_data
        );

        $("#activity_logs_nav").addClass("active");
    }

    //Purok;
    if (window.location.href === route("admin.puroks.index")) {
        const columns = [
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".purok_dt"), route("admin.puroks.index"), columns);
        $("#resident_management_nav").addClass("active");
        $("#purok").addClass("font-weight-bold text-success");
    }

    //Resident;
    if (window.location.href === route("admin.residents.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "age" },
            {
                data: "gender",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            { data: "purok" },
            { data: "contact" },
            { data: "email" },
            {
                data: "is_voter",
                render(data) {
                    return isVoter(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".resident_dt"), route("admin.residents.index"), columns);

        $("#resident_management_nav").addClass("active");
        $("#resident").addClass("font-weight-bold text-success");
    }

    //User;
    if (window.location.href === route("admin.users.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            {
                data: "role",
                render(data) {
                    return `<span class='badge badge-success'>${data}</span>`;
                },
            },
            {
                data: "is_activated",
                render(data) {
                    return isActivated(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".user_dt"), route("admin.users.index"), columns);

        $("#auth_management_nav").addClass("active");
    }

    //Service;
    if (window.location.href === route("admin.services.index")) {
        const columns = [
            { data: "name" },
            { data: "description" },
            { data: "fee" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".service_dt"), route("admin.services.index"), columns);

        $("#services_management_nav").addClass("active");
        $("#services").addClass("font-weight-bold text-success");
    }

    //Blotter;
    if (window.location.href === route("admin.blotters.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "complainant" },
            { data: "respondent" },
            { data: "official.name" },
            {
                data: "is_solved",
                render(data) {
                    return isSolved(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".blotter_dt"), route("admin.blotters.index"), columns);
    }

    //Position;
    if (window.location.href === route("admin.positions.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".position_dt"), route("admin.positions.index"), columns);

        $("#official_management_nav").addClass("active");
        $("#positions").addClass("font-weight-bold text-success");
    }

    //Official;
    if (window.location.href === route("admin.officials.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "avatar",
                render(data) {
                    return handleNullAvatar(data);
                },
            },
            { data: "name" },
            {
                data: "position",
                render(data) {
                    return `${data.name}`;
                    blank;
                },
            },
            {
                data: "is_active",
                render(data) {
                    return isActive(data);
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".official_dt"), route("admin.officials.index"), columns);

        initiateFilePond(
            ".avatar_image",
            ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            `Drag & Drop your files or <span class="filepond--label-action"> Browse Avatar</span>`
        );

        $("#official_management_nav").addClass("active");
        $("#officials").addClass("font-weight-bold text-success");
    }

    // Request
    if (window.location.href === route("admin.requests.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "paypal_transaction_id",
            },
            {
                data: "resident",
            },
            {
                data: "service",
            },
            { data: "purpose" },
            {
                data: "status",
                render(data) {
                    return handleRequestStatus(data);
                },
            },
            { data: "remark" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".request_dt"), route("admin.requests.index"), columns);
        $("#services_management_nav").addClass("active");
        $("#requests").addClass("font-weight-bold text-success");
    }

    //Category;
    if (window.location.href === route("admin.categories.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".category_dt"), route("admin.categories.index"), columns);

        $("#inventory_management_nav").addClass("active");
        $("#category").addClass("text-success");
    }

    // Product
    if (window.location.href === route("admin.products.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },

            { data: "code" },
            { data: "name" },
            { data: "description" },
            { data: "category.name" },
            { data: "price" },
            { data: "qty" },
            {
                data: "manufactured_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            {
                data: "expired_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            {
                data: "is_available",
                render(data) {
                    return isAvailable(data);
                },
            },
            {
                data: "updated_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        const table = c_index(
            $(".product_dt"),
            route("admin.products.index"),
            columns
        );

        $("#inventory_management_nav").addClass("active");
        $("#product").addClass("text-success");
    }
});

//=========================================================
// Custom Functions()
function filterRequestsByService(service) {
    if (service.value) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "resident",
            },
            {
                data: "service",
            },
            { data: "purpose" },
            {
                data: "status",
                render(data) {
                    return handleRequestStatus(data);
                },
            },
            { data: "remark" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".request_dt"),
            route("admin.requests.index", {
                service: service.value,
            }),
            columns,
            null,
            true
        );
    }
}

function filterResident(status) {
    if (status.value) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "age" },
            {
                data: "gender",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            { data: "purok" },
            { data: "contact" },
            { data: "email" },
            {
                data: "is_voter",
                render(data) {
                    return isVoter(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".resident_dt"),
            route("admin.residents.index", {
                status: status.value,
            }),
            columns,
            null,
            true
        );
    }
}
