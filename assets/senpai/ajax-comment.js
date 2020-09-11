/*
 * Let's begin with validation functions
 */
jQuery.extend(jQuery.fn, {
	/*
	 * check if field value lenth more than 3 symbols ( for name and comment ) 
	 */
	validate: function () {
		if (jQuery(this).val().length < 3) {jQuery(this).addClass('error');return false} else {jQuery(this).removeClass('error');return true}
	},
	/*
	 * check if email is correct
	 * add to your CSS the styles of .error field, for example border-color:red;
	 */
	validateEmail: function () {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
		    emailToValidate = jQuery(this).val();
		if (!emailReg.test( emailToValidate ) || emailToValidate == "") {
			jQuery(this).addClass('error');return false
		} else {
			jQuery(this).removeClass('error');return true
		}
	},
});
 
jQuery(function($){
 
	/*
	 * On comment form submit
	 */
	$( '#comment-form' ).submit(function(){
        console.log('comment submitted');
		// define some vars
		var button = $('#submit'), // submit button
		    respond = $('#respond'), // comment form container
		    commentlist = $('.comment-list'), // comment list container
		    cancelreplylink = $('#cancel-comment-reply-link');
 
		// if user is logged in, do not validate author and email fields
		if( $( '#author' ).length )
			$( '#author' ).validate();
 
		if( $( '#email' ).length )
			$( '#email' ).validateEmail();
 
		// validate comment in any case
		$( '#comment' ).validate();
 
		// if comment form isn't in process, submit it
        if ( true
             //!button.hasClass( 'loadingform' ) &&
             //!$( '#author' ).hasClass( 'error' ) && 
             //!$( '#email' ).hasClass( 'error' ) && 
             //!$( '#comment' ).hasClass( 'error' ) 
            ){
 
            // ajax request
			$.ajax({
				type : 'POST',
				url : senpai_ajax_comment_params.ajaxurl, // admin-ajax.php URL
				//comment_parent
				data: $(this).serialize() + 
						'&action=ajaxcomments' + 
						'&comment_post_ID=' + senpai_ajax_comment_params.postID + 
						'&nonce='+ senpai_ajax_comment_params.nonce , 
				beforeSend: function(xhr){
					// what to do just after the form has been submitted
					button.addClass('loadingform').val('Loading...');
				},
				error: function (request, status, error) {
                    console.log('err');
					if( status == 500 ){
						alert( 'Error while adding comment' );
					} else if( status == 'timeout' ){
						alert('Error: Server doesn\'t respond.');
					} else {
						// process WordPress errors
						var wpErrorHtml = request.responseText.split("<p>"),
							wpErrorStr = wpErrorHtml[1].split("</p>");
 
						alert( wpErrorStr[0] );
					}
				},
				success: function ( addedCommentHTML ) {
                    console.log('success');
					// if this post already has comments
					$('#close-comment-modal').trigger("click");
					commentlist.append( addedCommentHTML );
					// clear fields
					$('#comment').val('');
					$( '#email' ).val('');
					$( '#author').val('');
				},
				complete: function(){
					// what to do after a comment has been added
					//button.removeClass( 'loadingform' ).val( 'Post Comment' );
				}
			});
		}
		return false;
	});
});

jQuery(document).ready(function($) {
   
});