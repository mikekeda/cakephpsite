$( document ).ready(function() {
/*	$( "#rate > li" ).click(function( event ) {
		var vote = $( "li" ).index( this ) - 1;
		var s = $(this)[0]["baseURI"].split('/');
		var post = s[s.length-1];

		$.ajax({
			type:'GET',
			url:'/firstsite2/votes/add',
			data:"post_id=" + post + "&rating="+vote,
			success: function(data) {
				alert( data );
			}
		});

		event.preventDefault();

	});*/
	
/*	$( "#SignupForm" ).validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			name: "Please specify your name",
			email: {
				required: "We need your email address to contact you",
				email: "Your email address must be in the format of name@domain.com"
			}
		}
	});*/

	$( "#SignupForm" ).validate({
        rules: {
            username: "required",
            email: {
                required: true,
                email: true
            },
            name: "required",
            surname: "required",
            password: {
                required: true,
                minlength: 2
            },
            password_confirm: {
                required: true,
                minlength: 2/*,
                equalTo: "#userpassword"*/
            }
        },
        messages: {
            username: "Please enter your Username",
            email: "Please enter a valid email address",
            name: "Please enter your Name",
            surname: "Please enter your Surname",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least {0} characters long"
            },
            password_confirm: {
                required: "Please provide a password",
                minlength: "Your password must be at least {0} characters long",
                /*equalTo: "Enter Confirm Password Same as password"*/
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        errorPlacement: function(error, element) {
			error.insertAfter(element);
		}
    });

/*	$( "#SignupForm" ).validate({
		invalidHandler: function(event, validator) {
			// 'this' refers to the form
			var errors = validator.numberOfInvalids();
			if (errors) {
			var message = errors == 1
			? 'You missed 1 field. It has been highlighted'
			: 'You missed ' + errors + ' fields. They have been highlighted';
			$("#SignupForm").html(message);
			$("#SignupForm").show();
			} else {
				$("div.error").hide();
			}
		}
	});*/

/*	$( "#SignupForm" ).click(function( event ) {
		event.preventDefault();
		var data = $( this ).serializeArray();
		var t = data['data[User][email]'];
		alert( $( this ).serialize() );
	});*/
});
