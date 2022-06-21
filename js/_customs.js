$('.datattable').DataTable({
  'columnDefs': [{
      'targets': [0], // column index (start from 0)
      'orderable': false, // set orderable false for selected columns
      'searchable': false,

    }]
});
$(document).on('submit', 'form.submiit', function(e){
  e.preventDefault();
    // alert("heel");
      var form = $(this);
        // /alert(previoussubmit); // name of submit button
      var formId = $(this).attr('id');
      var action = $(this).attr('data-id');

      var nonce = $(this).attr('nonce');
      var targetURL = '_functions.php';
      var values = form.serializeArray();
      //alert(JSON.stringify(form.serializeArray()));

      var $checkboxes = form.find('input.checkbox[type=checkbox]');
      $checkboxes.each(function() {
        var item_name = $(this).attr('name');
        //alert(value);
            if ($(this).is(':not(:checked)')){
              var item_value = "0";
                // NO value has been found add new one
                values.push({name: item_name, value: item_value});

            }
        });
        console.log(JSON.stringify(values));
        // console.log(action);
        //console.log(JSON.stringify(values));
      Swal.fire({
        title: 'Are you Sure',
        text: "Are you sure you want to save the changes!?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sure!',
        showLoaderOnConfirm: true,
        preConfirm: function() {
           return new Promise(function(resolve) {
           /*
           Ajax code will be here
           */
           $.ajax({
             method: "POST",
             url: targetURL,
             // async: false,
             data: {data:JSON.stringify(values),type:formId,nonce:nonce,action:action}
          })
             .done(function(data){
               //$(':input[type="submit"]').prop('disabled', false);
                console.log(data);
              //  alert(data);
                if (data.trim()==='Successful' || data.trim()==='SuccessfulSuccessful') {
                $('#spinner').hide();
                  Swal.fire({
                  title: 'Successful',
                  text: "Saved successfully!",
                  icon: 'success',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Done!'
                }).then((result) => {
                  if (result.value) {
                    if(action == "update" && formId !== "users"){
                      window.history.back();
                    }
                    else{
                      location.reload();
                    }
                  }
                });
                }else{
                    //alert(data);
                    Swal.fire({
                    icon: 'warning',
                    title: data
                  });
                }
                  return true;
             })
             .fail(function(data){
                console.log(data);

                Swal.fire({
                  title: 'Oops...',
                  text: 'Something went wrong',
                  icon: 'error'
                  });
            });

      });
    }//preconfirm close
  });//swal colose
  $('#spinner').hide();
});


$('#checkall').click(function(){
  if($(this).is(':checked')){
     $('.delete_enquiry').prop('checked', true);
  }else{
     $('.delete_enquiry').prop('checked', false);
  }
});
// Checkbox checked
function checkcheckbox(){
   // Total checkboxes
   var length = $('.delete_enquiry').length;

   // Total checked checkboxes
   var totalchecked = 0;
   $('.delete_enquiry').each(function(){
      if($(this).is(':checked')){
         totalchecked+=1;
      }
   });
   // Checked unchecked checkbox
   if(totalchecked == length){
      $("#checkall").prop('checked', true);
   }else{
      $('#checkall').prop('checked', false);
   }
}
// approve record
function statusChange(active_deactive,approveids_insideData,nonce,t){
  if(active_deactive == "Delete"){
    	Swal.fire({
    		title: 'Are you Sure',
    		text: "Are you sure you want to "+active_deactive.replace(/_/g, ' ')+"!?!",
    		type: 'warning',
    		showCancelButton: true,
    		confirmButtonColor: '#3085d6',
    		cancelButtonColor: '#d33',
    		confirmButtonText: 'Sure!',
    		showLoaderOnConfirm: true,
    		preConfirm: function() {
    			 return new Promise(function(resolve) {
    				 $('#spinner').show();
    			 $.ajax({
    					url: '_functions.php',
    					type: 'POST',
    					data: {for: 'delete_enquiry',approveids_arr: approveids_insideData,active_deactive:active_deactive,nonce:nonce,t:t}
    			 })
    		 .done(function(data){
    			 console.log(data);
    				 $('#spinner').hide();
    				 Swal.fire({
    				 title: 'Successful',
    				 text: data,
    				 type: 'success',
    				 allowOutsideClick: false,
    				 allowEscapeKey: false,
    				 showCancelButton: false,
    				 confirmButtonColor: '#3085d6',
    				 cancelButtonColor: '#d33',
    				 confirmButtonText: 'Done!'
    			 }).then((result) => {
    				 if (result.value) {
    					 $('#spinner').show();
    						location.reload();
    				 }
    			 });
    				 return true;
    		 })
    		 .fail(function(data){
    				console.log(data);

    				Swal.fire({
    					title: 'Oops...',
    					text: 'Something went wrong',
    					type: 'error'
    					});
    		});
    					$('#spinner').hide();
    		}); //promise close
    			// $('#spinner').hide();
    	}//preconfirm close
  });//swal colose
}
else{
      $.ajax({
         url: '_functions.php',
         type: 'POST',
         data: {for: 'update_task',approveids_arr: approveids_insideData,active_deactive:active_deactive,nonce:nonce,t:t},
         beforeSend: function() {
             // setting a timeout
             // $("td[value='"+approveids_insideData+"']").closest("tr").addClass('strikeout');
             // $("#taskList tbody tr").addClass('strikeout');
         }
      })
    .done(function(data){
      console.log(data);
      $("#taskList tbody").html(data);
    })
    .fail(function(data){
       console.log(data);

       Swal.fire({
         title: 'Oops...',
         text: 'Something went wrong',
         type: 'error'
         });
    });
    // $('#spinner').hide();
    }
}
 $(document).on('click','#delete_all_enquiry',function(){
	 var active_deactive = $(this).attr('active_deactive');
	 var nonce = $(this).attr('nonce');
	 var t = $(this).attr('ta');
    var approveids_insideData = [];
    // Read all checked checkboxes
    $("input:checkbox[class=delete_enquiry]:checked").each(function () {
       approveids_insideData.push($(this).val());
    });
		if(active_deactive == "Delete"){

					if(approveids_insideData.length > 0){
						statusChange(active_deactive,approveids_insideData,nonce,t);
					}
			}
 });
 $(document).on('change','.mark_done',function(){
	 var active_deactive = $(this).attr('active_deactive');
	 var nonce = $(this).attr('nonce');
	 var t = $(this).attr('ta');
    var approveids_insideData = [];
    // Read all checked checkboxes
    $("input:checkbox[class=mark_done]:checked").each(function () {
       approveids_insideData.push($(this).val());
    });
		if(active_deactive == "Update"){
					if(approveids_insideData.length > 0){
             setTimeout(function () {
               statusChange(active_deactive,approveids_insideData,nonce,t);
             }, 500);
					}
			}
 });

 $(document).on('submit','#changepass',function(e){
 	e.preventDefault();
 	var nonce = $(this).attr('nonce');
    var currpass = $('#current_password').val();
     // alert(currpass);
    var newpass = $('#newpass').val();
    var confirmpass = $('#confirmpass').val();
    var email = $('#email_id').val();
 	 var my_passw = $('#my_passw').val();

      if(currpass == '' || newpass == '' || confirmpass == '')
      {
 			Swal.fire({
         title: 'Empty fields',
         text: 'Please enter your valid data',
         icon: 'warning'
         });

        $("#current_password").focus();
 			 return false;
      }
      if(confirmpass != newpass)
       {
 				Swal.fire({
 	        title: 'Invalid Password',
 	        text: 'Current password and confirmation password must be same',
 	        icon: 'warning'
 	        });
          $("#confirmpass").focus();
        }
      else
      {
         $.ajax({
 		     method : 'POST',
 		     url  : '_functions.php',
 		     data : {current_password:currpass,email:email,password:newpass,for:'change_passowrd',nonce:nonce},
 		     success : function(data)
 		          {
                console.log(data);
                if(data.trim() == "Done"){
                  Swal.fire({
   									title: 'Password changed',
   									text: "Password Changed Successfully",
   									type: 'success',
   									allowOutsideClick: false,
   									allowEscapeKey: false,
   									showCancelButton: false,
   									confirmButtonColor: '#3085d6',
   									cancelButtonColor: '#d33',
   									confirmButtonText: 'Done!'
   								}).then((result) => {
   									if (result.value) {
   											 window.location.href = 'logout.php';
   									}
   								});
                }
                else{
                  Swal.fire({
   									title: 'Error occured',
   									text: data,
   									type: 'warning'
   								});
                }
 		         },
             error: function (textStatus, errorThrown) {
               Swal.fire({
                  title: 'Error occured',
                  text: textStatus,
                  type: 'warning'
                });
             }
 					 });
 				 }
    });
