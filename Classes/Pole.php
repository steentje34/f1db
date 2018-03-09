<?php

/**
 * Description of Pole
 *
 * @author Simon
 */
class Pole {

    public $race_id;
    public $driver_id;
    public $constructor_id;
    public $engine_id;

    function __construct($conn, $id) {
        $this->race_id = $id;
        $query = "SELECT driver_id, constructor_id, engine_id FROM poles WHERE race_id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $driver_id, $constructor_id, $engine_id);
        mysqli_store_result($conn);
        
        while (mysqli_stmt_fetch($stmt)) {
            $this->driver_id = $driver_id;
            $this->constructor_id = $constructor_id;
            $this->engine_id = $engine_id;
        }
    }

}
