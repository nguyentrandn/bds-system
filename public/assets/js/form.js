$(function () {
	$('.compBtn, .inpCover').click(function () {
		var type = $(this)[0].classList[1]
		$('.alert.' + type).fadeIn().css({ 'display': 'flex' });
	});
	$('.close').click(function () {
		$('.alert').fadeOut();
	});
	var read = [false, false];
	$('.checkbox01 .links1 a').each(function(i, e){
		e.addEventListener('click', function(){
			read[i] = true;
			console.log(read)
			if (read[0] && read[2]){
				$('input[name="agree"]').prop('checked', true);
			};
			$('.inpCover').hide();
		});
	});
	$('.checkbox01 .links2 a').each(function (i, e) {
		e.addEventListener('click', function () {
			read[i] = true;
			console.log(read)
			if (read[0] && read[1]) {
				$('input[name="agree"]').prop('checked', true);
			}
		});
	});
});


/**
 * Application JS code
 */
$(document).ready(function() {
	/**
	 * RG10 form submit
	 */
     let is_rg10_form_valid = false;

    /**
     * Full-width characters (kanji, hiragana, katakana).
     */
    $('#rg10_form input[name="秘密の質問（答え）"]').focusout(function( event ) {
        if( ! /^[ぁ-んァ-ン一-龥]/.test(event.target.value) ) {
            $( event.target ).focus();
            $( event.target ).css('background-color', '#FFE0E0');

            is_rg10_form_valid = false;
        } else {
            $( event.target ).css('background-color', 'inherit');
            is_rg10_form_valid = true;
        }
    });


    $('#rg10_form').submit(function( event ) {
        event.preventDefault();

        if(!is_rg10_form_valid) {
            return;
        }

        /**
         * If user not checked checkbox, show popup.
         */
        if(!$('input[name="agree"]').is(':checked')) {
            var type = 'document';
            $('.alert.' + type).fadeIn().css({ 'display': 'flex' });
            return;
        }

        $('#rg10_submit_button').prop("disabled", true);
        
        let data = getDataFromForm('#rg10_form');

        $.ajax({
            url: `/ajax/register/send-email-invitation`,
            data: JSON.stringify(data),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function() {
            window.location.replace('/form/rg11');
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON, 5000);
            $('#rg10_submit_button').prop("disabled", false);

            if (error.responseJSON.error_code == 'required_fields') {
                displayFormValidation(error.responseJSON.error_fields, '#rg10_form');
            }
        });
    });

	/**
	 * RG20 form submit
	 */
    let is_rg20_form_valid = true;

    /**
     * Validate furigana full-width
     */
    $('#rg20_form .furigana-input').focusout(function( event ) {
        if( ! /^([ァ-ン]|ー)+$/.test(event.target.value) ) {
            $( event.target ).focus();
            $( event.target ).css('background-color', '#FFE0E0');

            is_rg20_form_valid = false;
        } else {
            $( event.target ).css('background-color', 'inherit');
            is_rg20_form_valid = true;
        }
    });

	$('#rg20_form').submit(function( event ) {
        event.preventDefault();

        // If both field is empty
        if( !$('#rg20_form input[name="固定電話"]').val() && !$('#rg20_form input[name="携帯電話"]').val() ) {
            $('#rg20_form input[name="固定電話"]').css('background-color', '#FFE0E0');
            $('#rg20_form input[name="携帯電話"]').css('background-color', '#FFE0E0');
            $('#rg20_form input[name="携帯電話"]').focus();

            return;
        } else {
            $('#rg20_form input[name="固定電話"]').css('background-color', 'inherit');
            $('#rg20_form input[name="携帯電話"]').css('background-color', 'inherit');
        }

        if(!is_rg20_form_valid) {
            return;
        }

        /**
         * If user not checked checkbox
         */
        if(!$('input[name="agree"]').is(':checked')) {
            var type = 'document';
            $('.alert.' + type).fadeIn().css({ 'display': 'flex' });
            return;
        }

        let data = getDataFromForm('#rg20_form');

        $('#rg20_submit_button').prop("disabled", true);

        $.ajax({
            url: `/ajax/register/input-profile/${$.urlParam('invitation_token')}`,
            data: JSON.stringify(data),
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function() {
            window.location.replace('/form/rg21' + window.location.search);
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON, 5000);
            $('#rg20_submit_button').prop("disabled", false);

            if (error.responseJSON.error_code == 'required_fields') {
                displayFormValidation(error.responseJSON.error_fields, '#rg20_form');
            }
        });
    });

	/**
	 * RG21 Form Submit
	 */
	$('#rg21_form').submit(function( event ) {
        event.preventDefault();

        $('#rg21_submit_button').prop("disabled", true);

        $.ajax({
            url: `/ajax/register/confirm-and-create-account/${$.urlParam('invitation_token')}`,
            type: 'POST',
            contentType: 'application/json',
        })
        .done(function() {
            window.location.replace('/form/rg30' + window.location.search);
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON, 5000);
            $('#rg21_submit_button').prop("disabled", false);

            if (error.responseJSON.error_code == 'required_fields') {
                displayFormValidation(error.responseJSON.error_fields, '#rg21_form');
            }
        });
    });

    /**
     * LG10 Form Submit
     */
    $('#lg10_form').submit(function( event ) {
        event.preventDefault();
        $('#lg10_submit_button').prop("disabled", true);

        var data = {
            email:     $('#lg10_form [name="email"]').val(),
            password:  $('#lg10_form [name="password"]').val(),
        };

        $.ajax({
            url: `/ajax/user/signin`,
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
        })
        .done(function(response) {
            if(response.previous_url) {
                window.location.replace(response.previous_url);
            } else {
                window.location.replace('/my-page');
            }
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON, 5000);
            $('#lg10_submit_button').prop("disabled", false);

            if (error.responseJSON.error_code == 'required_fields') {
                displayFormValidation(error.responseJSON.error_fields, '#rg21_form');
            }
        });
    });

    /**
	 * CP10 Form Submit
	 */
	$('#cp10_form').submit(function( event ) {
        event.preventDefault();

        $('#cp10_submit_button').prop("disabled", true);

        var data = {
            'メールアドレス':      $('#cp10_form [name="メールアドレス"]').val(),
            '秘密の質問':         $('#cp10_form [name="秘密の質問"]').val(),
            '秘密の質問（答え）':  $('#cp10_form [name="秘密の質問（答え）"]').val(),
        };

        $.ajax({
            url: `/ajax/user/email-reset-password`,
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
        })
        .done(function() {
            /**
             * Show success popup and clear form
             */
            var type = 'send';
            $('.alert.' + type).fadeIn().css({ 'display': 'flex' });
            $('#cp10_form').trigger('reset');
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON, 5000);
            $('#cp10_submit_button').prop("disabled", false);

            if (error.responseJSON.error_code == 'required_fields') {
                displayFormValidation(error.responseJSON.error_fields, '#cp10_form');
            }
        });
    });

    /**
	 * CP20 Form Submit
	 */
	$('#cp20_form').submit(function( event ) {
        event.preventDefault();

        $('#cp20_submit_button').prop("disabled", true);

        var data = {
            'new_password':          $('#cp20_form [name="new_password"]').val(),
            'confirm_password':      $('#cp20_form [name="confirm_password"]').val(),
            'reset_password_token':  $.urlParam('reset_password_token'),
        };

        $.ajax({
            url: `/ajax/user/reset-password`,
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
        })
        .done(function() {
            /**
             * Show success popup and clear form
             */
            var type = 'config';
            $('.alert.' + type).fadeIn().css({ 'display': 'flex' });
            $('#cp20_form').trigger('reset');
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON, 5000);
            $('#cp20_submit_button').prop("disabled", false);

            if (error.responseJSON.error_code == 'required_fields') {
                displayFormValidation(error.responseJSON.error_fields, '#cp10_form');
            }
        });
    });


    /**
	 * MY10 - Input Identify Code Form Submit
	 */
	$('#input_identify_code_form').submit(function( event ) {
        event.preventDefault();

        $('#button_submit_identify_code').prop("disabled", true);

        var data = {
            'code':      $('#input_identify_code_form [name="code"]').val(),
        };

        $.ajax({
            url: `/ajax/user/input-verification-code`,
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
        })
        .done(function() {
            var type = 'code';
            $('.alert.' + type).fadeIn().css({ 'display': 'flex' });
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON, 5000);
            $('#button_submit_identify_code').prop("disabled", false);

            if (error.responseJSON.error_code == 'required_fields') {
                displayFormValidation(error.responseJSON.error_fields, '#cp10_form');
            }
        });
    });

    /**
     * FU20 Form Submit
     */
    $('#fu20_form [name="申込口数"]').on('change', function() {
        var investmentUnit = $(this).data('investmentUnit');
        var amount = investmentUnit * $(this).val();

        $('#fu20_form [name="出資金額"]').val( new Intl.NumberFormat().format(amount) );

        /**
         * Update text of comfirm popup.
         */
        $('#申込口数_selected').text($(this).val() + ' 口');
        $('#出資金額_selected').text(new Intl.NumberFormat().format(amount) + ' 円');
    });


    $('#fu20_form').submit(function( event ) {
        event.preventDefault();

        // Default will show confirm popup.
        var type = 'confirm';

        let popup_to_show = $('#fu20_submit_button').data('popupToShow');
        if(popup_to_show) {
            type = popup_to_show;
        }

        /**
         * If user not checked checkbox, show popup.
         */
        if(!$('#fu20_form input[name="agree"]').is(':checked')) {
            var type = 'document';
        }

		$('.alert.' + type).fadeIn().css({ 'display': 'flex' });
    });


    $('#confirm_apply_fund_button').click(function( event ) {
        event.preventDefault();

        $('#confirm_apply_fund_button').prop("disabled", true);

        let data = getDataFromForm('#fu20_form');

        $.ajax({
            url: `/ajax/fund_application/create`,
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
        })
        .done(function() {
            let FUND_ID = $.urlParam('fund_id');
            window.location.replace(`/fund/fu31?fund_id=${FUND_ID}`);
        })
        .fail(function(error) {
            showErrorMessage(error.responseJSON, 5000);
            $('#confirm_apply_fund_button').prop("disabled", false);

            if (error.responseJSON.error_code == 'required_fields') {
                displayFormValidation(error.responseJSON.error_fields, '#cp10_form');
            }
        });
    });

    // ----------------------------
    // USER CONTACT (CT10)
    // ----------------------------

    /**
     * Handle required document links click.
     */
    var ct10_document_read = [false];

    $('#ct10_form .checkbox01 .links2 a').each(function (i, e) {
		e.addEventListener('click', function () {
			ct10_document_read[i] = true;
			if (ct10_document_read[0]) {
				$('input[name="agree"]').prop('checked', true);
			}
		});
	});

    $('#ct10_form').submit(function( event ) {
        event.preventDefault();

        /**
         * If user not checked checkbox
         */
        if(!$('input[name="agree"]').is(':checked')) {
            var type = 'document';
            $('.alert.' + type).fadeIn().css({ 'display': 'flex' });
            return;
        }

        $('#ct10_form_submit_button').prop("disabled", true);

        let data = getDataFromForm('#ct10_form');

        $.ajax({
                url: `/ajax/user/send-contact`,
                data: JSON.stringify(data),
                type: 'POST',
                contentType: 'application/json',
            })
            .done(function() {
                window.location.replace('/ct11');
            })
            .fail(function(error) {
                showErrorMessage(error.responseJSON);
                $('#ct10_form_submit_button').prop("disabled", false);

				if (error.responseJSON.error_code == 'required_fields') {
                    displayFormValidation(error.responseJSON.error_fields, '#ct10_form');
                }
            });
    });
});