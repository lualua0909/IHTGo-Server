var info = {
    images: []
};

var myDropzone = new Dropzone("img#profile-user-img", {
    url: BASE_URL + "/api/upload",
    paramName: "photo",
    addRemoveLinks: true,
    dictRemoveFile: "Bỏ ảnh này",
    dictRemoveFileConfirmation: 'Ban Chac Chan?',
    maxFiles: 6,
    clickable: "#profile-user-img",
});
myDropzone.on("addedfile", function(file) {
    $("#upload-area .intrucstion").addClass('hide');
    $("#upload-area .add-image").addClass('show');
});
myDropzone.on("success",function(response,data){
    info.images.push(data.data.id);
    $(".dz-preview:last-child").attr('id', data.data.id);
    $('input#idUpload').val(info.images);
});
myDropzone.on("reset",function(file){
    $("#upload-area .intrucstion").removeClass('hide');
    $("#upload-area .add-image").removeClass('show');
})
myDropzone.on("maxfilesexceeded",function(file){
    myDropzone.clickable = false;
})

myDropzone.on("removedfile",function(file){
    var id = file.previewTemplate.id;
    $.ajax({
        url: BASE_URL + '/api/delete-upload/' + id,
        type: 'GET',
        cache: false,
        success: function(respone){
            if(respone){
                var index = info.images.indexOf(parseInt(respone.id));
                if (index !== -1) info.images.splice(index, 1);
                $('input#idUpload').val(info.images);

            }
        }
    });
})



