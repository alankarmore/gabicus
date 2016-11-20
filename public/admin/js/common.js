$(function () {
    $("#image").fileupload({
        formData: {'mediatype': $("#mediatype").val()},
        dataType: 'json',
        url: fileTempUpload,
        limitMultiFileUploads: 1,
        sequentialUploads: true,
        replaceFileInput: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        beforeSend: function (e) {
            $("#loading_image").remove();
            $('p.alert .alert-error').remove();
            $("input[type='file']").after('<span id="loading_image" class="pull-left" style="margin-left: 5px;"></span>');
        },
        done: function (e, data) {
            $("#loading_image").remove();
            if (data.result.valid == 1) {
                $("#fileName").val(data.result.fileName);
                $("#uploadwrapper").html('<img src="' + tempPath + data.result.fileName + '" width="100" height="100"/><a href="javascript:void(0);" class="removeuploadmedia deleteMedia" data-file="' + data.result.fileName + '"><i class="fa fa-times"></i></a>');
            }

            if (data.result.error != null) {
                $("#fileName").val("");
                $("#uploadwrapper").append('<p class="alert alert-error">' + data.result.error + '</p>');
            }
        }
    });

    $(document).on('click', ".removeuploadmedia", function () {
        removeUploadedMedia(removeRoute);
    });

    $(document).on('click', ".deleteRecord", function (event) {
        if(confirm('Are you sure?')) {
            return true;
        } else {
            event.preventDefault();
        }
    });
});

function generateTable(tableId, route, sortColumn, sortOrder)
{
    $("#" + tableId).bootstrapTable({
        url: route,
        contentType: 'application/x-www-form-urlencoded',
        queryParams: function (p) {
            return {
                limit: p.limit,
                offset: p.offset,
                search: (p.search) ? p.search : "",
                sort: p.sort,
                order: p.order
            };
        },
        method: 'post',
        pagination: true,
        sidePagination: 'server',
        search: true,
        sortName: sortColumn,
        sortOrder: sortOrder,
        cache: false,
        pageSize: 10,
    });
}

/**
 * Remove uploaded media
 * 
 * @param {string} removeRoute
 * @returns {void}
 */
function removeUploadedMedia(removeRoute)
{
    var result = null;
    $.ajax({
        url: removeRoute,
        type: "POST",
        dataType: "JSON",
        data: {"file": $("#fileName").val()},
        beforeSend: function () {

        },
        success: function (response) {
            result = response;
        },
        complete: function () {
            if (result.valid == true) {
                $("#uploadwrapper").html('');
                $("#fileName").val('');
                $('input[type=file]').closest("form")[0].reset();
            }
        }
    });

}

function activeParentMenu(menu)
{
    $('#sidebar-menu > .menu_section > ul:first > li').removeClass('active')
    var parentMenu = $("#" + menu).parent();
    parentMenu.addClass('active');
    $("ul:first", parentMenu).slideDown();
}