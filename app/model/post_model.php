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

        $sql = "SELECT posts.*, users.user_name , categories.category_name FROM posts
        INNER JOIN users ON posts.user_ID = users.id
        INNER JOIN categories ON posts.category_ID = categories.id
        ORDER BY posts.id DESC";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $this->stmt->fetchAll();
    }

    public function getDataByPage($page = 1)
    {
        $limit = 5;
        $sql  = "SELECT posts.*, users.user_name , categories.category_name FROM posts
        INNER JOIN users ON posts.user_ID = users.id
        INNER JOIN categories ON posts.category_ID = categories.id
        ORDER BY posts.id ASC LIMIT " . ($page-1)*$limit . "," . $limit;
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $this->stmt->fetchAll();
    }

    public function getCountPost()
    {
        $sql = "SELECT count(*) FROM posts";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $this->stmt->fetch();
    }
}