<?php
class reg_admin_model extends base_model
{
    private $table = 'users';
    public function checkReg($username,$email){
        $sql = "SELECT user_name,user_email FROM "  .$this->table  . " WHERE user_name = ? OR user_email = ? ";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(1,$username,PDO::PARAM_STR);
            $this->stmt->bindParam(2,$email,PDO::PARAM_STR);
            $this->stmt->execute();
        }catch(PDOException $e){
            echo "<pre>"; var_dump(die($e->getMessage())); echo "</pre>";
        }
        $result = $this->stmt->fetch();
        if ($this->stmt->rowCount($result)){
            return true;
        }else{
            return false;
        }
    }

    public function insertUser($user,$pass,$email){
        $sql = "INSERT INTO " . $this->table . " (user_name,user_pass,user_email,created_time) VALUES (:user,:pass,:email,:created_time)";
        $date = 'y-m-d';
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(':user',$user);
            $this->stmt->bindParam(':pass',$pass);
            $this->stmt->bindParam(':email',$email);
            $this->stmt->bindParam(':created_time',$date);
            $this->stmt->execute();
        }catch(PDOException $e){
            echo "<pre>"; var_dump(die($e->getMessage())); echo "</pre>";
        }
        if ($this->conn->lastInsertId() > 0){
            return true;
        }else{
            return false;
        }
    }
}