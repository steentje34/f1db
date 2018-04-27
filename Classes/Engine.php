<?php

/**
 * Description of Engine
 *
 * @author Simon
 */
class Engine {

    public $id;
    public $name;

    function __construct(pdo $conn, int $id) {
        $this->id = $id;
        $query = "SELECT name FROM engines WHERE id=?";
        $stmt =$conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $result['name'];
    }
}
