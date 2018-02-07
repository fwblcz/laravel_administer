<?php
    function _getSaltHash($password, $salt, $gsalt='scYltK') {
        $passwordmd5 = preg_match('/^\w{32}$/', $password) ? $password : md5($password);
        return md5($passwordmd5.$salt.$gsalt);
    }