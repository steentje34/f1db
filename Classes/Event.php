<?php

/**
 * Description of Event
 *
 * @author Simon
 */
class Event {

    public $id;
    public $name;

    function __construct($conn, $id) {
        $this->id = $id;
        $query = "SELECT name FROM events WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name);
        mysqli_store_result($conn);
        
        while (mysqli_stmt_fetch($stmt)) {
            $this->name = $name;
        }
    }

}
