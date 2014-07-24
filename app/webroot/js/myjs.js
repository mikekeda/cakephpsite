$( document ).ready(function() {
	$( "#rate > li" ).click(function( event ) {
		var index = $( "li" ).index( this ) - 1;
		alert( index );

		$.ajax({
		    url: '/votes/'+index,
		    cache: false,
		    type: 'GET',
		    dataType: 'HTML',
		    success: function (data) {
		    	alert( data );
		    }
		});

	});
});