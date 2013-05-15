$(document).ready(function(){
 
 $('#contact-form').validate(
 {
  // not 100% with default rules so have overridden with some of my own
    rules: {
      name: {
        minlength: 2,
        required: true
      },
      email: {
        required: true,
        email: true
      },
      message: {
        minlength: 2,
        required: true
      }
    },
// custom error messages go here
// perhaps I could pass the error message into a 'tooltip'?
// R&D for later
    messages:{
      name: {
        required: '',
      }
    },

// creates the red error color
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');

    },
//creates the green and happy colour. Wooo
    success: function(element) {
      $(element).addClass('valid').closest('.control-group').removeClass('error').addClass('success')
      ;
    },
// use  submitHandler as correct point to intitate ajaxSubmit
   

    submitHandler: function(form) {
      
// serialize the data from the form
      var datastring = $('#contact-form').serialize();

      // alert(datastring);

    

// Terrible coding but works...
// replaces the contact form with a thank you when complete

// I will fix it up so
// 1. options are set
// 2. if submitHandler is happy send form via ajaxSubmit
// 3.IF php file returns a success of sending the email
// THEN replace the contact form with thank you message
// May need to dig into the phpmailer documentaion to find a return success value

      var options = {
        url: 'bin/send.php',
        type: 'POST',
        data: datastring,
        success: function() {

          $('#contact-form').html("<div id='message'></div>");
          $('#message').html("<legend>Thanks for contacting me!</legend>")
          .append("<p>I will be in touch soon.</p><p><em>Nathan</em></p>")
          .hide()
          .fadeIn(2500, function() {
        });
      }
      };

      $(form).ajaxSubmit(options);


//return false to prevent normal browser submit and pagenavigation
      return false;
    }
 

 });





}); // end document.ready