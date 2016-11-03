<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/9/16
 * Time: 3:15 PM
 */
class post_model extends base_model
{
    private $table = "posts";

    public function getDataByID($id)
    {
        $sql = "SELECT posts.*, users.user_name, categories.category_name
                FROM posts
                INNER JOIN users ON posts.user_ID = users.id
                INNER JOIN categories ON categories.id = posts.category_ID
                WHERE posts.id = ?
                ORDER BY posts.created_time DESC";

        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(1,$id,PDO::PARAM_INT);
            $this->stmt->execute();
        } catch(PDOException $e){
            die($e->getMessage());
        }
        return $this->stmt->fetch();
    }

    public function getAllData(){
        $limit = 10;
        $sql = "SELECT posts.* FROM posts ORDER BY posts.id DESC LIMIT $limit";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        // return $this->stmt->fetchAll();
        $total_records = count(fetchAll()['title']);
        $total_page = ceil($total_records/$limit);
        if ($current_page) {
            # code...
        }
    }
}