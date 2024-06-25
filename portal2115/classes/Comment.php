<?php
class Comment {
    private $conn;
    private $table_name = "comments";

    public $id;
    public $article_id;
    public $author;
    public $content;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT comments.*, articles.title AS article_title 
                  FROM " . $this->table_name . " 
                  JOIN articles ON comments.article_id = articles.id 
                  ORDER BY comments.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
