<?php

/**
 * Description of Race
 *
 * @author Simon
 */
class Race {

    public $id;
    public $date;
    public $event_id;
    public $circuit_id;

    function __construct(pdo $conn, int $id) {
        $this->id = $id;
        $query = "SELECT date, event_id, circuit_id FROM races WHERE id=?";
        $stmt =$conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->date = $result['date'];
        $this->event_id = $result['event_id'];
        $this->circuit_id = $result['circuit_id'];
    }
}
