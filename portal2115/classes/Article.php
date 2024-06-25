<?php
class Article {
    private $conn;
    private $table_name = "articles";

    public $id;
    public $title;
    public $content;
    public $author_id;
    public $category_id;
    public $image;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }
//obiektowosc przyklad 
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (title, content, author_id, category_id, image) VALUES (:title, :content, :author_id, :category_id, :image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':image', $this->image);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT articles.*, users.username AS author, categories.name AS category 
                  FROM " . $this->table_name . " 
                  JOIN users ON articles.author_id = users.id 
                  JOIN categories ON articles.category_id = categories.id 
                  ORDER BY articles.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
