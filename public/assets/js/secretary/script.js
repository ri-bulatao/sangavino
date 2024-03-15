const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {
    // Profile
    if (window.location.href === route("profile.index")) {
        $("#profile_nav").addClass("active");
    }

    // //Blotter;
    // if (window.location.href === route("secretary.blotters.index")) {
    //     const columns = [
    //         {
    //             data: "id",
    //             render(data, type, row) {
    //                 return row.DT_RowIndex;
    //             },
    //         },
    //         { data: "complainant" },
    //         { data: "respondent" },
    //         { data: "official.name" },
    //         {
    //             data: "is_solved",
    //             render(data) {
    //                 return isSolved(data);
    //             },
    //         },
    //         {
    //             data: "created_at",
    //             render(data) {
    //                 return formatDate(data, "datetime");
    //             },
    //         },
    //         { data: "actions", orderable: false, searchable: false },
    //     ];
    //     c_index($(".blotter_dt"), route("secretary.blotters.index"), columns);
    // }

    // Request
    if (window.location.href === route("secretary.requests.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "transaction_id",
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
        c_index($(".request_dt"), route("secretary.requests.index"), columns);
        $("#services_management_nav").addClass("active");
        $("#requests").addClass("font-weight-bold text-success");
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
            route("secretary.requests.index", {
                service: service.value,
            }),
            columns,
            null,
            true
        );
    }
}
