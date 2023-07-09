 /* -------------------------------------------------------------------
 * Plugin Name           : VARSITY - UNIVERSITY SMART ATTENDANCE SYSTEM
 * Author Name           : EBP
 * Author URI            : 
 * Created Date          : 2020
 * Last Update           : 2020
 * Version               1.0
 * File Name            login.js
------------------------------------------------------------------- */

/* ---------------------------------------------------------------*/

function loginValidator() {
    "use-strict";

   
$('.ulogin').on('click', function ulogin (event) {
    event.preventDefault(); 
	window.location.replace("login");
        return false; 
});

$('.uregister').on('click', function uregister (event) {
    event.preventDefault(); 
	window.location.replace("register");
        return false; 
});

}