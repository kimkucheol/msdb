<?php
function adminer_object() {
  
  class AdminerSoftware extends Adminer {
    
    function login($login, $password) {
      // validate user submitted credentials
      return ($login == 'admin' && $password == 'P@ssw0rd');
		}
  }
  return new AdminerSoftware;
}

include "./adminer.php";
?>