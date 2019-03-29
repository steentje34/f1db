<?php

/**
 * Description of Circuit
 *
 * @author Simon
 */
class Circuit {

    public $conn;
    public $id;
    public $name;

    function __construct(pdo $conn, int $id) {
        $this->conn = $conn;
        $this->id = $id;
        $query = "SELECT name FROM circuits WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $result['name'];
    }

    function getRaces(): int {
        $query = "SELECT count(*) as count FROM races WHERE circuit_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $races = (is_null($result['count']) ? 0 : $result['count']);

        return $races;
    }
}
