$( document ).ready(function() {
	$( "#rate > li" ).click(function( event ) {
		var vote = $( "li" ).index( this ) - 1;
		var s = $(this)[0]["baseURI"].split('/')
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

	});

	$( "#SignupForm" ).click(function( event ) {
		event.preventDefault();
		var data = $( this ).serializeArray();
		var t = data['data[User][email]'];
		alert( $( this ).serialize() );
	});
});
