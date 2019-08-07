// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var info = {
    images: []
};
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: BASE_URL + "/api/upload", // Set the url
    paramName: "photo",
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    maxFiles: 5,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
});

myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

myDropzone.on("sending", function(file, xhr, data) {
    var input = file.previewElement.querySelector("input[name='position'");
    var inputService = file.previewElement.querySelector("input[name='service'");
    var title = 1;
    var service = 'SERVICE';
    if (input !== null){
        var title = input.value;
    }
    if (inputService !== null){
        var service = inputService.value;
    }
    data.append('position', title);
    data.append('service', service);
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
    //myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
};

myDropzone.on("success",function(response,data){
    info.images.push(data.data.id);
    $(".dz-image-preview:last-child").attr('id', data.data.id);
    $('input#idUpload').val(info.images);
});

myDropzone.on("removedfile",function(file){
    var id = file.previewTemplate.id;
    if (id){
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
    }

});

if (dataImage){
    var folder = '/service/';
    if ($('#idFolder').length){
         folder = $('#idFolder').val();
    }
    $.each(dataImage, function(i, e) {
        existingFile = { name: e.name, size: 12345 };
        myDropzone.options.addedfile.call(myDropzone, existingFile);

        existingFile.previewElement.querySelector("input[name='position'").value = e.position;
        existingFile.previewElement.querySelector(".delete").style.display = 'block';
        existingFile.previewElement.querySelector(".start").style.display = 'none';
        existingFile.previewElement.querySelector(".cancel").style.display = 'none';
        $(".dz-image-preview:last-child").attr('id', e.id);
        info.images.push(e.id);
        $('input#idUpload').val(info.images);

        myDropzone.options.thumbnail.call(myDropzone, existingFile, '/' + e.link + folder + e.name);
        $(existingFile.previewElement).attr('id', e.id); // adds a custom id to the preview element.
        myDropzone.files.push(existingFile);  // added this line so the files array is the correct length.
    });
}

function updatePosition(){
    $(".positionImage").on('change', function () {
        var id = $(this).parent().parent().attr('id');
        var position = $(this).val();
        $.ajax({
            url: BASE_URL + '/api/update-image/' + id,
            type: 'POST',
            cache: false,
            data: {"position": position},
            success: function(respone){
                if(respone.status == 200){
                    console.log('success');
                }
            }
        });
    });
}
