<?php
class Password
{
    public function hash($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
    }
    public function verify($password, $hash) {
		return	password_verify($password, $hash);
    }
}
?>
