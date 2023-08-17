<?php

namespace Models;
class Post {
    private $conn;
    private $table = 'posts';

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;    
    public $author;    
    public $created_at;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function getAll()
    {
        $query = "SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
        FROM {$this->table} p
        LEFT JOIN
          categories c ON p.category_id = c.id
        ORDER BY
          p.created_at DESC";

        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function get()
    {
      $query = "SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
        FROM {$this->table} p
        LEFT JOIN
          categories c ON p.category_id = c.id
        WHERE
          p.id = :id
        LIMIT 0,1  ";

        $statement = $this->conn->prepare($query);
        $statement->execute(['id' => $this->id]);

        return $statement;
    }

    // create post
    public function create() 
    {
      $query = "INSERT INTO {$this->table} SET
        title = :title,
        body = :body,
        author = :author,
        category_id = :category_id
      ";

      $statement = $this->conn->prepare($query);

      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));

      if($statement->execute([
        'title' => $this->title,
        'body' => $this->body,
        'author' => $this->author,
        'category_id' => $this->category_id
      ])) {
        return true;
      } else {
        printf("Error: %s. /n", $statement->error);
        return false;
      }
    }

    // update post
    public function update() 
    {
      $query = "UPDATE {$this->table} SET
        title = :title,
        body = :body,
        author = :author,
        category_id = :category_id
        WHERE id = :id
      ";

      $statement = $this->conn->prepare($query);

      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));
      $this->id = htmlspecialchars(strip_tags($this->id));

      if($statement->execute([
        'title' => $this->title,
        'body' => $this->body,
        'author' => $this->author,
        'category_id' => $this->category_id,
        'id' => $this->id
      ])) {
        return true;
      } else {
        printf("Error: %s. /n", $statement->error);
        return false;
      }
    }

    // delete post
    public function destory()
    {
      $query = "DELETE FROM {$this->table}  WHERE id = :id";

      $statement = $this->conn->prepare($query);

      $this->id = htmlspecialchars(strip_tags($this->id));

      if($statement->execute([
        'id' => $this->id
      ])) {
        return true;
      } else {
        printf("Error: %s. /n", $statement->error);
        return false;
      }
    }
}
