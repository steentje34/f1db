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

    function __construct($conn, $id) {
        $this->id = $id;
        $query = "SELECT date, event_id, circuit_id FROM races WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $date, $event_id, $circuit_id);
        mysqli_store_result($conn);
        
        while (mysqli_stmt_fetch($stmt)) {
            $this->date = $date;
            $this->event_id = $event_id;
            $this->circuit_id = $circuit_id;
        }
    }

}
