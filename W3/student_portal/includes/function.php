<?php
function usValidUser($user,$pass){
    $admin_user ="brandon96120@gmail.com";
    $admin_pass ='12345';
    return($user===$admin_user && $pass===$admin_pass);
}
?>