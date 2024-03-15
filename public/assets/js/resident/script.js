const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {
    // Profile
    if (window.location.href === route("profile.index")) {
        $("#profile_nav").addClass("active");
    }

    //Service;
    if (window.location.href === route("resident.requests.index")) {
        const column_data = [
            { data: "id" },
            {
                data: "service",
                render(data) {
                    return `${data.name}`;
                },
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
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".request_dt"),
            route("resident.requests.index"),
            column_data
        );
        $("#issuance_nav").addClass("active");
    }
});

//=========================================================
// Custom Functions()
