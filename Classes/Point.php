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

    function __construct(pdo $conn, int $id) {
        $this->id = $id;
        $query = "SELECT race_id, position, driver_id, constructor_id, driver_points, driver_points_discarded, constructor_points, constructor_points_discarded FROM points WHERE id=?";
        $stmt =$conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->race_id = $result['race_id'];
        $this->position = $result['position'];
        $this->driver_id = $result['driver_id'];
        $this->constructor_id = $result['constructor_id'];
        $this->driver_points = $result['driver_points'];
        $this->driver_points_discarded = $result['driver_points_discarded'];
        $this->constructor_points = $result['constructor_points'];
        $this->constructor_points_discarded = $result['constructor_points_discarded'];
    }
}
