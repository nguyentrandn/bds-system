/**
 * @param {array} data 
 * @param {string} fieldName 
 * @returns 
 */
 function getFormDataByFieldName(data, fieldName) {
    for (let i = 0; i < data.length; i++) {
        if (data[i].column_name == fieldName) {
            return data[i];
        }
    }

    return null;
}

// ==========================
// Image File Uploader
// ==========================
function checkUploadImageLimitation(targetId, maxFiles) {
    /**
     * Off upload button if total file is over limit
     */
    if ($(`#${targetId}`).find('.image-item').length >= maxFiles) {
        $(`#${targetId}`).find('.image-upload-placeholder').hide();
    } else {
        $(`#${targetId}`).find('.image-upload-placeholder').show();
    }
}

function initialImageFileUploader(targetId, imageUrls, maxFiles = 1) {
    imageUrls.forEach(function(item) {
        let imgContainer = $(`<div class="image-item"></div>`);
        let imgPreview = $(`<div class="image-preview"></div>`);
        let removeImgButton = $(`<button class="remove-image-button"></button>`);

        imgContainer.append(imgPreview);
        imgContainer.append(removeImgButton);
        imgPreview.css('background-image', 'url("' + item + '")');

        imgContainer.data('file', item);
        imgContainer.data('data_type', 'text');

        $(`#${targetId}`).append(imgContainer);

        removeImgButton.on('click', function(event) {
            if (confirm('写真を本当に削除しますか？')) {
                $(event.target).parent().fadeOut(1000).remove();

                checkUploadImageLimitation(targetId, maxFiles);
            }
        });
    });

    checkUploadImageLimitation(targetId, maxFiles);

    $(`#${targetId}`).find('input[type="file"]').on('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                let imgContainer = $(`<div class="image-item"></div>`);
                let imgPreview = $(`<div class="image-preview"></div>`);
                let removeImgButton = $(`<button class="remove-image-button"></button>`);

                imgPreview.css('background-image', 'url("' + e.target.result + '")');
                imgContainer.append(imgPreview);
                imgContainer.append(removeImgButton);

                imgContainer.data('file', e.target.result);
                imgContainer.data('file_name', event.target.files[0].name);
                imgContainer.data('data_type', 'file');

                $(`#${targetId}`).append(imgContainer);

                removeImgButton.on('click', function(event) {
                    if (confirm('写真を本当に削除しますか？')) {
                        $(event.target).parent().fadeOut(1000).remove();

                        checkUploadImageLimitation(targetId, maxFiles);
                    }
                });

                checkUploadImageLimitation(targetId, maxFiles);
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    });
}

function getDataFromImageFileUploader(targetId) {
    let results = [];
    $(`#${targetId}`).find('.image-item').each(function(index, item) {
        results.push({
            file: $(item).data('file'),
            name: $(item).data('file_name'),
            dataType: $(item).data('data_type'),
        });
    });

    return results;
}


// ==========================
// Attachment File Uploader
// ==========================
function checkUploadAttachmentFileLimitation(targetId, maxFiles) {
    if(maxFiles == -1) {
        return;
    }

    /**
     * Off upload button if total file is over limit
     */
    if ($(`#${targetId}`).find('.file-item').length >= maxFiles) {
        $(`#${targetId}`).find('.file-upload-placeholder').hide();
    } else {
        $(`#${targetId}`).find('.file-upload-placeholder').show();
    }
}

function initialAttacmentFileUploader(targetId, fileUrls, maxFiles = -1) {
    fileUrls.forEach(function(item) {
        let container = $(`<div class="file-item"></div>`);
        let fileLink = $(`<a></a>`);
        let removeImgButton = $(`<button class="remove-file-button"></button>`);

        container.append(removeImgButton);
        container.append(fileLink);

        fileLink.text(item.name);
        fileLink.attr("href", item.url);

        container.data('file', item.url);
        container.data('file_name', item.name);
        container.data('data_type', 'text');

        $(`#${targetId}`).append(container);

        removeImgButton.on('click', function(event) {
            if (confirm('写真を本当に削除しますか？')) {
                $(event.target).parent().fadeOut(1000).remove();

                checkUploadAttachmentFileLimitation(targetId, maxFiles);
            }
        });
    });

    checkUploadAttachmentFileLimitation(targetId, maxFiles);

    $(`#${targetId}`).find('input[type="file"]').on('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                let container = $(`<div class="file-item"></div>`);
                let fileLink = $(`<a></a>`);
                let removeImgButton = $(`<button class="remove-file-button"></button>`);
        
                container.append(removeImgButton);
                container.append(fileLink);
        
                fileLink.text(event.target.files[0].name);
                fileLink.attr("href", "");

                container.data('file', e.target.result);
                container.data('file_name', event.target.files[0].name);
                container.data('data_type', 'file');

                $(`#${targetId}`).append(container);

                removeImgButton.on('click', function(event) {
                    if (confirm('写真を本当に削除しますか？')) {
                        $(event.target).parent().fadeOut(1000).remove();

                        checkUploadAttachmentFileLimitation(targetId, maxFiles);
                    }
                });

                checkUploadAttachmentFileLimitation(targetId, maxFiles);
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    });
}

function getDataFromAttachmentFileUploader(targetId) {
    let results = [];
    $(`#${targetId}`).find('.file-item').each(function(index, item) {
        results.push({
            file: $(item).data('file'),
            name: $(item).data('file_name'),
            data_type: $(item).data('data_type'),
        });
    });

    return results;
}
