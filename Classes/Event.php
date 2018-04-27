<?php

/**
 * Description of Event
 *
 * @author Simon
 */
class Event {

    public $id;
    public $name;

    function __construct(pdo $conn, int $id) {
        $this->id = $id;
        $query = "SELECT name FROM events WHERE id=?";

        $stmt =$conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $result['name'];
    }
}
