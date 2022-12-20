<?php
class userModel extends Model
{
    public function login($username, $password)
    {
        $sql = parent::$connection->prepare('SELECT * FROM `uml_user` WHERE `user_username` = ? AND `user_password` = ?');
            $sql->bind_param('ss', $username, $password);
            $user = parent::select($sql)[0];
            if(password_verify($password, $user['user_password'])){
                return $user;
            }
            return false;

    }

    public function register($username, $password)
    {
        $sql = parent::$connection->prepare('INSERT INTO `uml_user`(`user_username`, `user_password`) VALUES (?, ?)');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql->bind_param('ss', $username, $password);
        return $sql->execute();
    }
}
