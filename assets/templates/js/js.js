/**
* this js file only use for frontend
* @razib
*/
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    return pattern.test(emailAddress);
};

jQuery(document).ready(function($){	
	
	$(document).on('click', '.btn-online-survey-submit', function(){
		$(this).addClass('btn-online-survey-submitting');			
		$('.online-survey-notice').empty().append('Working....');
		var error = 0;
		
		//---form validation-----------------
		$('form.form-online-survey input[type=text] , form.form-online-survey textarea.textarea').css('border-color', '#CFCFCF');
		$('form.form-online-survey input[type=text]').each(function(){
			if($(this).val() == ''){
				$(this).css('border-color', 'red');
				error = 1;
			}else if( $(this).val().length < 5){
				$(this).css('border-color', 'red');				
				$(this).closest('span').find('span.error').empty().text(' Add more than 5 Chars.').fadeIn();
				error = 1;
			}else if( ($(this).hasClass('email')) && ( !isValidEmailAddress($(this).val()) ) ){
				$(this).css('border-color', 'red');
				$(this).closest('span').find('span.error').empty().text('Please Enter a valid Email Address.').fadeIn();
					error = 1;
					
			}
						
		});
		if($('form.form-online-survey textarea.textarea').val() == '' ){
			$('form.form-online-survey textarea.textarea').css('border-color', 'red');
			error = 1;
		}
		//---End validation------------------
		
		//----Submit-------------------------
		if( error== 0 ){		
			var data = {
				form_data		: $(this).closest('form.form-online-survey').serialize(),
				action	:	'online_survey_form_submit',
				_ajax_nonce: OnlineSurvey.nonceSubmitForm,
			};
			$.post(OnlineSurvey.ajaxurl, data, function(response) {
				if(-1 === response){
					alert('Something went wrong!!');
				}
				alert(response.msg);
				if(response.id == 1){
					url=window.location.href;
					urlArr=url.split('?');
					window.location.href=urlArr[0];
				}
								
			}, 'json');	
		}
		
		//----End Submit---------------------
		
		$('.online-survey-notice').empty();
		$(this).show();
		return false;
	});
	
	
	
	
});


