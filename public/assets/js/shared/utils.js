//===================================================================================
// Global Fn()

/**
 * convert html table to DataTable (Client Side)
 */
function convertToDataTable(dt, opt = "") {
    if (opt) {
        $(dt).dataTable({
            lengthChange: false,
            dom: "Bfrtip",
            pagingType: "numbers",
            buttons: {
                dom: {
                    button: {
                        className: "btn btn-dark btn-sm btn-rounded mb-2",
                    },
                },
                buttons: [
                    "copyHtml5",
                    "excelHtml5",
                    "csvHtml5",
                    "pdfHtml5",
                    "print",
                ],
                position: "bottom",
            },
        });
    } else {
        $(dt).dataTable();
    }
}

/**
 * convert time
 */
function convert_time(value) {
    let converted_time = new Date(
        "1970-01-01T" + value + "Z"
    ).toLocaleTimeString(
        {},
        { timeZone: "UTC", hour12: true, hour: "numeric", minute: "numeric" }
    );

    return converted_time;
}

/**
 * convert dateString to a DateAgo
 */
function calDateAgo(dString = null) {
    var d1 = new Date(dString);
    var d2 = new Date();
    var t2 = d2.getTime();
    var t1 = d1.getTime();
    var d1Y = d1.getFullYear();
    var d2Y = d2.getFullYear();
    var d1M = d1.getMonth();
    var d2M = d2.getMonth();

    var time_obj = {};
    time_obj.year = d2.getFullYear() - d1.getFullYear();
    time_obj.month = d2M + 12 * d2Y - (d1M + 12 * d1Y);
    time_obj.week = parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
    time_obj.day = parseInt((t2 - t1) / (24 * 3600 * 1000));
    time_obj.hour = parseInt((t2 - t1) / (3600 * 1000));
    time_obj.minute = parseInt((t2 - t1) / (60 * 1000));
    time_obj.second = parseInt((t2 - t1) / 1000);

    for (const obj_key in time_obj) {
        if (time_obj[obj_key] == 0) {
            delete time_obj[obj_key];
        }
    }
    var ago_text = "just now";

    if (typeof Object.keys(time_obj)[0] != "undefined") {
        var time_key = Object.keys(time_obj)[0];
        var time_val = time_obj[Object.keys(time_obj)[0]];
        time_key += time_val > 1 ? "s" : "";
        ago_text = time_val + " " + time_key + " ago";
    }

    return ago_text;
}

/**
 * handle display of data to form.selected input element
 */
function displayDataToSelectInputField(values, column, opt = "") {
    // if there is an optional param
    if (opt) {
        // if method is create
        if (opt.method == "create") {
            let output = `<option></option>`;
            if (values.length > 0) {
                values.forEach((value) => {
                    output += getColumnValue(column, value);
                });
            } else {
                output = `<option>No Data Found</option>`;
            }
            return output;
        }
        // if method is edit
        else {
            // check if the relational model are more than one
            let output = getCurrentColumnValue(column, opt.r_model);

            if (values.length > 0) {
                values.forEach((value) => {
                    output += getColumnValue(column, value);
                });
            } else {
                output = `<option>No Data Found</option>`;
            }

            return output;
        }
    }
}

/**
 * format Date Object
 */
function formatDate(date, opt) {
    if (opt == "full") {
        const formatted_date = new Date(date);
        return formatted_date.toLocaleDateString();
    }

    if (opt == "datetime") {
        const formatted_date = new Date(date);
        return formatted_date.toLocaleString();
    }

    if (opt == "dateString") {
        const formatted_date = new Date(date);
        return formatted_date.toDateString();
    }
}

/**
 * format Time
 */
function formatTime(time, opt = "12") {
    const timeString12hr = new Date(
        "1970-01-01T" + time + "Z"
    ).toLocaleTimeString("en-US", {
        timeZone: "UTC",
        hour12: true,
        hour: "numeric",
        minute: "numeric",
    });

    if (opt == "12") {
        return timeString12hr.toLocaleString([], { hour12: true });
    }
}

/**
 * get file extension
 */
function getFileExtension(file) {
    return file.split(".").pop();
}

/**
 * get current column value | for crud_edit / c_edit()
 */
function getCurrentColumnValue(column, value) {
    let output;
    if (column == "type") {
        output += `<option value='${value.id}'> Current ( ${value.type}  )</option>`;
    }
    if (column == "name") {
        output += `<option value='${value.id}'>Current ( ${value.name} )</option>`;
    }
    if (column == "fullname") {
        output += `<option value='${value.id}'> Current ( ${value.fname} ${value.lname} ) </option>`;
    }

    return output;
}

/**
 * get column value | for crud_create / c_create()
 */
function getColumnValue(column, value) {
    let output = "";
    if (column == "type") {
        output += `<option value='${value.id}'> ${value.type} </option>`;
    }
    if (column == "name") {
        output += `<option value='${value.id}'> ${value.name} </option>`;
    }
    if (column == "fullname") {
        output += `<option value='${value.id}'> ${value.fname} ${value.lname} </option>`;
    }

    return output;
}

/**
 * handle null avatar
 */
function handleNullAvatar(img, with_path = "", width = "75") {
    if (img && with_path) {
        return `<img class='img-fluid rounded-circle' src='/${with_path}/${img}' width='${width}' id="show_img">`;
    } else if (img && with_path == "") {
        return `<img class='img-fluid rounded-circle' src='${img}' width='${width}' id="show_img">`;
    } else {
        return `<img class='img-fluid rounded-circle' src='/img/noimg.svg' width='${width}' id="show_img">`;
    }
}

/**
 * handle null image
 */
function handleNullImage(img, with_path = "", width = "75") {
    if (img && with_path) {
        return `<img class='img-thumbnail' src='/${with_path}/${img}' width='${width}' id="show_img">`;
    } else if (img && with_path == "") {
        return `<img class='img-thumbnail' src='${img}' width='${width}' id="show_img">`;
    } else {
        return `<img class='img-thumbnail' src='/img/noimg.png' width='${width}' id="show_img">`;
    }
}

/**
 * handle file type
 */
function handleFileType(file) {
    const images = ["jpg", "png", "webp", "jpeg"];
    const docs = ["docx", "pdf", "xlsx", "txt"];

    if (file == "") {
        return "";
    }

    if (images.includes(file)) {
        return "images";
    }

    if (docs.includes(file)) {
        return "documents";
    }
}

/**
 * check status of a request
 */
function handleRequestStatus(data) {
    if (data === 0) {
        return `<span class='badge badge-warning'>Pending <i class='fas fa-spinner ml-1'></i></span>`;
    } else if (data === 1) {
        return `<span class='badge badge-success'>Approved <i class='fas fa-check-circle ml-1'></i></span>`;
    } else {
        return `<span class='badge badge-danger'>Declined <i class='fas fa-times-circle ml-1'></i></span>`;
    }
}

/**
 * handle file upload using file Pond
 */

function initiateFilePond(
    element,
    file_type = ["image/png", "image/jpeg", "image/jpg", "image/webp"],
    label = `Drag & Drop your files or <span class="filepond--label-action"> Browse </span>`
) {
    // Register Plugins
    FilePond.registerPlugin(FilePondPluginFileValidateSize);
    FilePond.registerPlugin(FilePondPluginFileValidateType);

    // FOR TMP FILE UPLOAD

    // Get a reference to the file input element
    const images = document.querySelectorAll(element);

    images.forEach((img) => {
        // Create a FilePond instance
        pond = FilePond.create(img, {
            labelIdle: label,
            acceptedFileTypes: file_type ?? [],
            maxFileSize: "3MB",
            storeAsFile: true,
            server: {
                url: `${baseUrl}/tmp_upload`,
                headers: {
                    "X-CSRF-TOKEN": `${token}`,
                },
                revert: "/revert",
            },
        });
    });
}

/**
 * handle editor - convert to tinyMCEditor
 */
function initiateEditor(selector) {
    tinymce.init({
        selector: selector,
        height: 250,
        placeholder: "Ask a question or post something...",
        plugins: [
            "advlist",
            "autolink",
            "lists",
            "link",
            "charmap",
            "preview",
            "anchor",
            "searchreplace",
            "visualblocks",
            "code",
            "fullscreen",
            "table",
            "help",
            "wordcount",
            "emoticons",
        ],
        toolbar:
            "undo redo | blocks | " +
            "bold italic | alignleft aligncenter " +
            "alignright alignjustify | bullist numlist outdent indent | " +
            "removeformat | help | emoticons",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
    });
}

/**
 * check if the boolean is true || false
 */
function isTrue(bool) {
    if (bool) {
        return `<span class='badge bg-success p-2'>Yes</span>`;
    } else {
        return `<span class='badge bg-secondary p-2'>No</span>`;
    }
}

/**
 * check if the input field is not empty
 */
function isNotEmpty(input) {
    if (input.val() == "") {
        input.addClass("is-invalid");
        return false;
    } else {
        input.removeClass("is-invalid");

        return true;
    }
}
/**
 * check if the status is approved
 */
function isApproved(data) {
    if (data === 0) {
        return `<span class='badge bg-info text-white'>Pending</span>`;
    } else if (data === 1) {
        return `<span class='badge bg-success text-white'>Approved</span>`;
    } else {
        return `<span class='badge bg-danger text-white'>Canceled</span>`;
    }
}

/**
 * check if the status is available
 */
function isAvailable(bool) {
    return bool == true
        ? `<span class='badge badge-success'>Activated <i class='fas fa-check-circle ml-1'></i></span>`
        : `<span class='badge badge-danger'>Deactivated</span>`;
}

/**
 * check if the status is active
 */
function isActive(data) {
    if (data === 0) {
        return `<span class='badge badge-danger'>Inactive <i class='fas fa-times-circle ml-1'></i></span>`;
    } else {
        return `<span class='badge badge-success'>Active <i class='fas fa-check-circle ml-1'></i></span>`;
    }
}

/**
 * check if the status is activated
 */
function isActivated(data) {
    if (data === 0) {
        return `<span class='badge badge-danger'>Deactivated</span>`;
    } else {
        return `<span class='badge badge-success'>Activated</span>`;
    }
}

/**
 * check if the resident is a voter
 */
function isVoter(data) {
    return data
        ? `<span class='badge badge-success'>Yes <i class='fas fa-check-circle ml-1'></i></span>`
        : `<span class='badge badge-warning'>No <i class='fas fa-times-circle ml-1'></i></span>`;
}

/**
 * check if the resident is a voter
 */
function isSolved(data) {
    return data === 1
        ? `<span class='badge badge-success'>Solved <i class='fas fa-check-circle ml-1'></i></span>`
        : `<span class='badge badge-warning'>On Going <i class='fas fa-spinner ml-1'></i></span>`;
}

/**
 * print a response
 */
function log(response) {
    return console.log(response);
}

/**
 * prompt dialog box before attemptingto delete a model
 */
async function promptDestroy(event, form_element) {
    event.preventDefault();
    const res = await confirm();
    return res.isConfirmed ? $(form_element).submit() : false;
}

/**
 * prompt dialog box before attemptingto saving a model
 */
async function promptStore(
    event,
    form_element,
    title = "Do you want to Submit?",
    subtitle = ""
) {
    event.preventDefault();
    const res = await confirm(title, subtitle, "Yes");
    return res.isConfirmed ? $(form_element).submit() : false;
}

/**
 * prompt dialog box before attemptingto update a model
 */
async function promptUpdate(
    event,
    form_element,
    title = "Do you want to Update?",
    subtitle = ""
) {
    event.preventDefault();
    const res = await confirm(title, subtitle, "Yes");
    return res.isConfirmed ? $(form_element).submit() : false;
}

// show image on click
$(document).on("click", "#show_img", function () {
    let image = $(this).attr("src");
    Swal.fire({
        title: "",
        imageWidth: "100%",
        imageHeight: "100%",
        padding: "3em",
        imageUrl: `${image}`,
        backdrop: `
          rgba(0,0,123,0.4)
          left top
          no-repeat
        `,
    });
});

function translateToTagalog(btn) {
    let targets = document.querySelectorAll(".translated_text");

    const apiKey = "c6a2d2688730471d80ad60d4f800747c";
    const endpoint = "https://api.cognitive.microsofttranslator.com/";

    // Add your location, also known as region. The default is global.
    // This is required if using an Azure AI multi-service resource.
    let location = "eastasia";

    targets.forEach((translated_text) => {
        axios({
            baseURL: endpoint,
            url: "/translate",
            method: "post",
            headers: {
                "Ocp-Apim-Subscription-Key": apiKey,
                // location required if you're using a multi-service or regional (not global) resource.
                "Ocp-Apim-Subscription-Region": location,
                "Content-type": "application/json",
                // "X-ClientTraceId": uuidv4().toString(),
            },
            params: {
                "api-version": "3.0",
                to: "fil",
                toScript: "latn",
            },
            data: [
                {
                    text: translated_text.textContent,
                },
            ],
            responseType: "json",
        })
            .then(function (response) {
                let result = response.data[0].translations[0].text;

                translated_text.textContent = `${result}`;

                btn.remove();
            })
            .catch((e) => log(e));
    });
}

//==========================================================================================

// GLOBAL ALERTS

/**
 * throw a success message
 */
function success(msg) {
    Swal.fire({
        icon: "success",
        title: `${msg}`,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}
/**
 * throw an error message
 */
function error(msg) {
    Swal.fire({
        icon: "error",
        title: `${msg}`,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}

/**
 * prompt a confirmation dialog box
 */
function confirm(
    title = "Are you sure?",
    text = `You won't be able to revert this!`,
    confirmTxt = `Yes, delete it!`
) {
    return Swal.fire({
        title,
        text,
        imageUrl: window.location.origin + "/img/prompt/question.svg",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Problem Solved",
        showCancelButton: true,
        confirmButtonColor: "#4085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmTxt,
    }).then((result) => result);
}

/**
 * throw a success message
 */
function toastSuccess(message) {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    Command: toastr["success"](`${message} Successfully`, "Success");
}

/**
 * throw an error message
 */
function toastDanger(message = "Sorry, there was a problem.") {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    Command: toastr["error"](`${message}`, "Error");
}

/**
 * throw a warning message
 */
function toastWarning(message = "Please fill up all required fields ") {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-bottom-right",
        preventDuplicates: true,
        onclick: null,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    Command: toastr["warning"](`${message}`, "Warning");
}
