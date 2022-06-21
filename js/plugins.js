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

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
//allow-alphanumeric class used for restrict to use only alphanumeric
$(".allow-alphanumeric").keydown(function (e){
		var k = e.keyCode || e.which;
		var ok = k >= 65 && k <= 90 || // A-Z
			k >= 96 && k <= 105 || // a-z
			k >= 35 && k <= 40 || // arrows
			k == 9 || //tab
			k == 46 || //del
			k == 8 || // backspaces
      k == 32 || // space
			(!e.shiftKey && k >= 48 && k <= 57); // only 0-9 (ignore SHIFT options)

		if(!ok || (e.ctrlKey && e.altKey)){
			e.preventDefault();
		}
	});

  $(".allow-number").inputFilter(function(value) {
    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
  });
//allow floatval only
$('.floatval').keypress(function(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
    eve.preventDefault();
  }
  // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
  $('.floatval').keyup(function(eve) {
    if ($(this).val().indexOf('.') == 0) {
      $(this).val($(this).val().substring(1));
    }
  });
});
  //check valid email
$(document).on("blur",".allow-email",function (e){
  if($(this).val().length > 1){
    if(IsEmail($(this).val())==false){
      Swal.fire({
        title: 'Invalid data',
        text: 'Please enter valid email address.',
        icon: 'warning'
        });
       //alert("Please enter valid email address");
      return false;
    }
  }
});
