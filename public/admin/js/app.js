// Restricts input for the set of matched elements to the given inputFilter function.
(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));

/**
 * Get query param from URL 
 * @param {string} name 
 * @returns 
 */
$.urlParam = function(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)')
        .exec(window.location.search);
    return (results !== null) ? results[1] || 0 : false;
}

/**
 * Do not allow input text in input number field
 */
function initFilterInputNumber() {
    $('input[type="number"]').inputFilter(function(value) {
        return /^\d*$/.test(value); // Allow digits only, using a RegExp
    });
}

/**
 * Binding data to form
 * @param {array} data 
 */
function bindDataForForm(data, formId) {
    /**
     * Get data from Form
     */
    var target = '#form .form-group';

    if(formId) {
        target = formId
    }

    $(target).each(function(index, element) {
        let input = $(element).find('input, select, textarea, radio');

        input.each(async function(index, element) {
            data.forEach(function(item) {
                if ($(`[data-model="${item.column_name}"]`).length > 0) {
                    let el = $(`[data-model="${item.column_name}"]`)[0];

                    if (el.dataset.outputFormat == 'number') {
                        $(`[data-model="${item.column_name}"]`).text(new Intl.NumberFormat().format(item.value));
                    } else {
                        $(`[data-model="${item.column_name}"]`).text(item.value);
                    }
                }

                if (item.column_name === $(element).attr('name')) {
                    if ($(element).attr('type') === 'file') {
                        /**
                         * Nothing to do for file
                         */
                    } else if ($(element).attr('type') === 'radio') {
                        $(element).val([item.value]).change();
                    } else if ($(element).attr('type') === 'checkbox') {
                        if($(element).val() === item.value) {
                            $(element).prop('checked', true);
                        }
                    }
                    else {
                        $(element).val(item.value).change();
                    }
                }
            })
        });
    });
}

function bindingDataToView(data) {
    data.forEach(function(item) {
        if ($(`[data-model="${item.column_name}"]`).length > 0) {
            let el = $(`[data-model="${item.column_name}"]`)[0];
    
            if (el.dataset.outputFormat == 'number') {
                $(`[data-model="${item.column_name}"]`).text(new Intl.NumberFormat().format(item.value));
            } else {
                $(`[data-model="${item.column_name}"]`).text(item.value);
            }
        }
    });
}

function merge(data) {
    var seen = {};
    data = data.filter(function(entry) {
        var previous;

        // Have we seen this label before?
        if (seen.hasOwnProperty(entry.column_name)) {
            // Yes, grab it and add this data to it
            previous = seen[entry.column_name];
            if(entry.value) {
                previous.value.push(entry.value);
            }
                
            // Don't keep this entry, we've merged it into the previous one
            return false;
        }

        // entry.data probably isn't an array; make it one for consistency
        if (!Array.isArray(entry.value)) {
            if(entry.value)  {
                entry.value = [entry.value];
            } else {
                entry.value = [];
            }
        }

        // Remember that we've seen it
        seen[entry.column_name] = entry;

        // Keep this one, we'll merge any others that match into it
        return true;
    });

    var results = [];

    // Convert object mapping back to array
    for (const [key, item] of Object.entries(seen)) {
        if(item.value.length === 0) {
            item.value = '';
        }

        if(item.value.length == 1) {
            item.value = item.value[0];
        }

        results.push(item);
    }

    return results;
}

function getDataFromForm($formId) {
    let data = [];

    if (!$formId) {
        $formId = '#form .form-group';
    }

    /**
     * Get data from Form
     */
    $($formId).each(function(index, element) {
        let input = $(element).find('input, select, textarea, radio');

        input.each(function(index, element) {
            var dataType = $(element).attr('type') || 'text';

            if (dataType === 'file') {
                /**
                 * no need process file input
                 */
            } else if(dataType == 'radio' || dataType == 'checkbox') {
                if($(element).is(":checked")) {
                    data.push({
                        'column_name': $(element).attr('name'),
                        'data_type': dataType,
                        'value': $(element).val(),
                        'search_operator': $(element).data('searchOperator'),
                        'search_multiple_column': $(element).data('searchMultipleColumn'),
                    });
                } else {
                    data.push({
                        'column_name': $(element).attr('name'),
                        'data_type': dataType,
                        'value': '',
                        'search_operator': $(element).data('searchOperator'),
                        'search_multiple_column': $(element).data('searchMultipleColumn'),
                    });
                }
            } else {
                data.push({
                    'column_name': $(element).attr('name'),
                    'data_type': dataType,
                    'value': $(element).val(),
                    'search_operator': $(element).data('searchOperator'),
                    'search_multiple_column': $(element).data('searchMultipleColumn'),
                });
            }
        });
    });

    /**
     * Merge data of checkbox (same column name) into array
     */
    data = merge(data)

    return data;
}

function displayFormValidation(error_fields = [], $formId) {
    if (!$formId) {
        $formId = '#form .form-group';
    }

    $($formId).each(function(index, element) {
        let input = $(element).find('input, select, textarea, radio');

        $(element).find('input, select, textarea, radio').removeClass('required-field');

        let focusToFirstElement = false;
        input.each(function(index, element) {
            error_fields.forEach(function (item) {
                if($(element).attr('name') === item['column_name']) {
                    $(element).addClass('required-field');

                    if(!focusToFirstElement) {
                        $(element).focus();
                        focusToFirstElement = true;
                    }
                }
            });
        });
    });
}

function clearFormValidation($formId) {
    if (!$formId) {
        $formId = '#form .form-group';
    }

    $($formId).find('input, select, textarea, radio').removeClass('required-field');
}

function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

function showMessageSaveSuccessfully(message) {
    return $.toast({
        text: message || '編集が完了しました。',
        showHideTransition: 'slide', // It can be plain, fade or slide
        bgColor: '#30e18f', // Background color for toast
        textColor: '#fff', // text color
        allowToastClose: true, // Show the close button or not
        hideAfter: 2000, // `false` to make it sticky or time in miliseconds to hide after
        stack: 5, // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
        textAlign: 'left', // Alignment of text i.e. left, right, center
        position: 'top-center' // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
    });
}

function showMessageCreateSuccessfully() {
    return $.toast({
        text: '新規作成が完了しました。',
        showHideTransition: 'slide', // It can be plain, fade or slide
        bgColor: '#30e18f', // Background color for toast
        textColor: '#fff', // text color
        allowToastClose: true, // Show the close button or not
        hideAfter: 2000, // `false` to make it sticky or time in miliseconds to hide after
        stack: 5, // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
        textAlign: 'left', // Alignment of text i.e. left, right, center
        position: 'top-center' // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
    });
}

function showErrorMessage(error, hideAfter = false) {
    let errorMessage = error.message || 'エラーが発生しました。';

    $.toast({
        text: errorMessage,
        showHideTransition: 'slide', // It can be plain, fade or slide
        bgColor: '#DA678C', // Background color for toast
        textColor: '#fff', // text color
        allowToastClose: true, // Show the close button or not
        hideAfter: hideAfter, // `false` to make it sticky or time in miliseconds to hide after
        stack: 5, // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
        textAlign: 'left', // Alignment of text i.e. left, right, center
        position: 'top-center' // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
    });
}

/**
 * Generate random string
 * 
 * @param {number} length 
 * @returns 
 */
 function makeid(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
}


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

function downloadCSV(url, param) {
    return jQuery.ajax({
        url: url,
        cache:false,
        data: JSON.stringify(param),
        type: 'POST',
        contentType: 'application/json',
        xhrFields:{
            responseType: 'blob'
        },
        success: function(response, textStatus, request){
            const url = window.URL.createObjectURL(new Blob([response]));
            const link = document.createElement('a');
            link.href = url;
    
            var regex = /filename=(.+)/;
            var fileStr = request.getResponseHeader('Content-Disposition');
            var file_name = fileStr.match(regex) && fileStr.match(regex).length ? fileStr.match(regex)[1] : 'data.csv';

            // Convert filename to UTF-8
            file_name = decodeURIComponent( escape( file_name.replaceAll('"','') ) );

            link.setAttribute('download', file_name);

            document.body.appendChild(link);
            link.click();
    
            if (link.parentNode) link.parentNode.removeChild(link);
        },
        error:function(error){
            showErrorMessage(error.responseJSON);
        }
    });
}

/**
 * Format: #########
 * @param {*} phone 
 */
function formatFixedPhoneNumber(phone = '') {
    if(!phone) return;

    let parts = [];
    phone = phone.replace(/ー/g, '');
    phone = phone.replace(/-/g, '');

    parts.push(phone.substring(0, 3));
    parts.push(phone.substring(3, 6));
    parts.push(phone.substring(6, 9));


    return parts.join('-');
}


/**
 * Format: #########
 * @param {*} phone 
 */
 function formatTelephonePhoneNumber(phone = '') {
    if(!phone) return;

    let parts = [];
    phone = phone.replace(/ー/g, '');
    phone = phone.replace(/-/g, '');

    parts.push(phone.substring(0, 3));
    parts.push(phone.substring(3, 7));
    parts.push(phone.substring(7, 11));

    return parts.join('-');
}

function getFundStatusColorByName(name) {
    switch(name) {
        case '作成中': {
            return '#dd4b39';
        }
        case '募集前': {
            return '#fecb31';
        }
        case '募集中': {
            return '#3399CC';
        }
        case '募集終了': {
            return '#999999';
        }
        case '不成立': {
            return '#434343';
        }
        case '運用中': {
            return '#6db54f';
        }
        case '運用終了': {
            return '#674ea7';
        }
    }
}

var validate_email = function(email){
    return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
}

function setFundHeaderData() {
    let FUND_ID = $.urlParam('fund_id');
    $.get(`/ajax/fund.detail.${FUND_ID}`, function(data) {
        bindingDataToView(data);
        var statusName = $('[data-model="ファンドステータス"]').text();
        $('.fund-screen .title-recruitment .nhan-recruitment').css('background-color', getFundStatusColorByName(statusName));
    });
}

function setUserHeaderData() {
    let USER_ID = $.urlParam('user_id');
    $.get(`/ajax/user.detail.${USER_ID}`, function(data) {
        bindingDataToView(data);

        $('[data-model="固定電話x"]').text( formatFixedPhoneNumber( getFormDataByFieldName(data, '固定電話').value ) );
        $('[data-model="携帯電話x"]').text( formatTelephonePhoneNumber( getFormDataByFieldName(data, '携帯電話').value ) );

        $('.user-detail-screen .title-recruitment .information li ').css('min-width', 'none');
    });
}


/**
 * Code need to run when website is ready.
 */
$(document).ready(function() {
    initFilterInputNumber();
});