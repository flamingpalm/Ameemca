 /* -------------------------------------------------------------------
 * Plugin Name           : VARSITY - UNIVERSITY SMART ATTENDANCE SYSTEM ACCESSIBILITY SCRIPT
 * Author Name           : Immanuel Ochem
 * Author URI            : 
 * Created Date          : 2020
 * Last Update           : 2020
 * Version               1.0
 * File Name            universal.js
------------------------------------------------------------------- */
// Define your library strictly...
"use strict";

//Execute
//autoScroll();

//Functions
function autoScroll() {
  setTimeout(function() {
     $('html, body').animate({
        scrollTop: $(".navbar").offset().top
    }, 1200);
    }, 2500);
  }

function getFacultyDepartments() {
  var faculty_id = $("#faculty_id option:selected").val();
  $.ajax({
              url:"../../administrator/actionController/faculty_departments.php",
              type:"POST",
              async: false, //Important 
              data: {faculty : faculty_id},
              dataType: "json",
              success:function(response){
var len = response.length;
if (len == "") {
$('#deptForm').hide();
} else {
$('#deptForm').show();
     $("#department_id").empty();
     $("#department_id").append("<option value='0'  disabled selected>--select--</option>");
          for( var i = 0; i<len; i++){
          var departmentid = response[i]['departmentid'];
          var departmentname = response[i]['departmentname'];
          $("#department_id").append("<option value='"+departmentid+"'>"+departmentname+"</option>");                    
                   }  
                 }
                 }
            });
        }




//inputTextLimit
function inputTextLimit(id) {
$(id).on('keyup', function(){
		var max = $(id).attr('maxlength');
        var len = $(id).val().length;     
   if(len > 0){
	if ((max - len) > 0) {
	if ((max - len) == 1) {
	$(id).siblings('.form-error-text').text(max - len + ' character remaining');
	} else {
	$(id).siblings('.form-error-text').text(max - len + ' characters remaining');
	}
	} else {
	$(id).siblings('.form-error-text').text('Maximum Length Reached!');
	}
   if (len > max) {
		$(id).val($(id).val().substring(0, max));
		$(id).siblings('.form-error-text').text('Maximum Length Reached!');
    }       
    } else {
  $(id).siblings('.form-error-text').text('');
     }
});
  
$(id).on('blur', function(){
	$(id).siblings('.form-error-text').text('');
  });
}

function timeInterval(){
var refresh=1000;
mytime=setTimeout('displayLiveTime()',refresh)
}
function displayLiveTime() {
var date = new Date();
var ampm = (date.getHours() >= 12) ? "PM" : "AM";
var time = date.getHours( ) % 12+ ":" +  date.getMinutes() + ":" +  date.getSeconds() +" "+ampm;
document.getElementById('liveTime').innerHTML = time;
timeInterval();
 }
