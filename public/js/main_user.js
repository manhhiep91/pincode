function get_alias(){
    var str = (document.getElementById("user_name").value);
    //alert(str);
    str= str.toLowerCase();
    str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
    str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
    str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
    str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
    str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
    str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
    str= str.replace(/đ/g,"d");
    str= str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g,"");
    str= str.replace(/-+-/g,""); //thay thế 2- thành 1-
    str= str.replace(/^\-+|\-+$/g,"");//cắt bỏ ký tự - ở đầu và cuối chuỗi
    str= str.replace(' ',"");//cắt bỏ ký tự - ở đầu và cuối chuỗi
    document.getElementById("user_name").value = str;
    return str;
}

function tao_ma(){
    var str = (document.getElementById("ma").value);
    //alert(str);
    str= str.toLowerCase();
    str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
    str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
    str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
    str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
    str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
    str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
    str= str.replace(/đ/g,"d");
    str= str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g,"");
    str= str.replace(/-+-/g,""); //thay thế 2- thành 1-
    str= str.replace(/^\-+|\-+$/g,"");//cắt bỏ ký tự - ở đầu và cuối chuỗi
    str= str.replace(' ',"");//cắt bỏ ký tự - ở đầu và cuối chuỗi
    str= str.toUpperCase();
    document.getElementById("ma").value = str;
    return str;
}
$(document).ready(function () {
    $('.action-upload').click(function () {
        $(this).parent().parent().find('input').click();
    });
});

function readURLAndSendAjax(input) {
    if (!input.files || !input.files[0]) return false;
    const fileSize = input.files[0].size / 1024 / 1024;
    var mimeType = input.files[0]['type'];
    var nameFile = input.files[0]['name'];
    var extension = input.files[0].type;
    let checkType = checkFileType(mimeType, input);
    let checkSize = checkFileSize(fileSize, input);
    var url = URL.createObjectURL(event.target.files[0]);
    //$(input).closest('.form-group').find("span.invalid-feedback").remove();
    if (!checkSize) {
        $(input).closest('.form-group').find('.invalid-feedback').text("Dung lượng ảnh không được quá 5MB").show();
        return false;
    }
    if (!checkType) {
        $(input).closest('.form-group').find('.invalid-feedback').text("Đuôi file ảnh là JPG,PNG").show();
        return false;
    }
    if (extension == 'application/pdf' || extension == 'application/msword') {
        $(input).closest('.form-group').find('.file-name').text(nameFile).show();
    }
    console.log(nameFile);
    console.log(extension);
    $(input).closest('.form-group').find('.invalid-feedback').text("");
    $(input).parent().find('div.preview').show();
    $(input).parent().find('div.preview').attr("style", "background: #eef0f8 url('" + url + "') no-repeat top center; background-size: contain; display: block; background-position: center");
    $(input).parent().find('div.fill').addClass('active');
    $(input).parent().find('.b-drop').addClass('active');



    if (checkType && checkSize) {
        inputname = input.name;
        var file_data = input.files[0];
        var form_data = new FormData();
        form_data.append("file", file_data);

        $("#ajax-loading").show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: urlUploadImage,
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (url) {
                //console.log(data);
                //let url = data.response.url;
                $(input).siblings(".file-url").val(url);
                $("#ajax-loading").hide();
            },
            error: function (error) {
                $("#ajax-loading").hide();
            }
        })
    }


}




function uploadFileAjax(input) {
    if (!input.files || !input.files[0]) return false;
    const fileSize = input.files[0].size / 1024 / 1024;
    var mimeType = input.files[0]['type'];
    var nameFile = input.files[0]['name'];
    var extension = input.files[0].type;
    //let checkType = checkFileType(mimeType, input);
    let checkSize = checkFileSize(fileSize, input);
    var url = URL.createObjectURL(event.target.files[0]);
    //$(input).closest('.form-group').find("span.invalid-feedback").remove();
    if (!checkSize) {
        $(input).closest('.form-group').find('.invalid-feedback').text("Dung lượng ảnh không được quá 5MB").show();
        return false;
    }
    // if (!checkType) {
    //     $(input).closest('.form-group').find('.invalid-feedback').text("Đuôi file ảnh là JPG,PNG").show();
    //     return false;
    // }
    if (extension == 'application/pdf' || extension == 'application/msword') {
        $(input).closest('.form-group').find('.file-name').text(nameFile).show();
    }
    console.log(nameFile);
    console.log(extension);
    $(input).closest('.form-group').find('.invalid-feedback').text("");
    $(input).parent().find('div.preview').show();
    $(input).parent().find('div.preview').attr("style", "background: #eef0f8 url('" + url + "') no-repeat top center; background-size: contain; display: block; background-position: center");
    $(input).parent().find('div.fill').addClass('active');
    $(input).parent().find('.b-drop').addClass('active');



    if (checkSize) {
        inputname = input.name;
        var file_data = input.files[0];
        var form_data = new FormData();
        form_data.append("file", file_data);

        $("#ajax-loading").show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: urlUploadImage,
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (url) {
                //console.log(data);
                //let url = data.response.url;
                $(input).siblings(".file-url").val(url);
                $("#ajax-loading").hide();
            },
            error: function (error) {
                $("#ajax-loading").hide();
            }
        })
    }


}


function checkFileType(fileType, input, type = "image") {
    let validImgTypes = type == "image" ? ["image/gif", "image/jpeg", "image/png"] : ["image/gif", "image/jpeg", "image/png"];
    if ($.inArray(fileType, validImgTypes) < 0) {
        return false
    }
    return true;
}

function checkFileSize(fileSize, input, max = 5) {
    if (fileSize > max) {
        return false;
    }
    return true;
}
function removeUpload(e) {
    document.getElementById("box-upload-" + e).remove();
}