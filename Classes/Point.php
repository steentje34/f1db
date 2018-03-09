<?php

/**
 * Description of Point
 *
 * @author Simon
 */
class Point {

    public $id;
    public $race_id;
    public $position;
    public $driver_id;
    public $constructor_id;
    public $driver_points;
    public $driver_points_discarded;
    public $constructor_points;
    public $constructor_points_discarded;

    function __construct($conn, $id) {
        $this->id = $id;
        $query = "SELECT race_id, position, driver_id, constructor_id, driver_points, driver_points_discarded, constructor_points, constructor_points_discarded FROM points WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $race_id, $position, $driver_id, $constructor_id, $driver_points, $driver_points_discarded, $constructor_points, $constructor_points_discarded);
        mysqli_store_result($conn);

        while (mysqli_stmt_fetch($stmt)) {
            $this->race_id = $race_id;
            $this->position = $position;
            $this->driver_id = $driver_id;
            $this->constructor_id = $constructor_id;
            $this->driver_points = $driver_points;
            $this->driver_points_discarded = $driver_points_discarded;
            $this->constructor_points = $constructor_points;
            $this->constructor_points_discarded = $constructor_points_discarded;
        }
    }

}
