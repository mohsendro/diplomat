// function toJobAjaxJs() {

// 	let toJobUserID  = document.getElementById('to-job-user-id').value;
// 	let toJobJobID   = document.getElementById('to-job-job-id').value;
// 	let toJobContent = document.getElementById('to-job-content').value;
	
// 	jQuery.ajax({
// 			url : tojob_ajax_localize_obj.ajax_url,
// 			type : 'post',
// 			dataType: 'json',
// 			data : {
// 				action : 'tojob_ajax_handle',
// 				submitted_nonce : tojob_ajax_localize_obj.the_nonce,
// 				toJobUserID  : toJobUserID,
// 				toJobJobID   : toJobJobID,
// 				toJobContent : toJobContent,
// 			},
// 			success : function( response ) {
// 				alert( response.data.success );
// 				console.log( response );
// 			},
// 			error : function( response ) {
// 				alert('Error retrieving the information: ' + response.status + ' ' + response.statusText);
// 				console.log( response );
// 			}
// 		});
	
// }