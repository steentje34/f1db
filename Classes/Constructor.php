<?php

/**
 * Description of Constructor
 *
 * @author Simon
 */
class Constructor {

    public $conn;
    public $id;
    public $name;

    function __construct(pdo $conn, int $id) {
        $this->conn = $conn;
        $this->id = $id;
        $query = "SELECT name FROM constructors WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $result['name'];
    }

}
