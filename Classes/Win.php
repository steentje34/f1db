<?php

/**
 * Description of Win
 *
 * @author Simon
 */
class Win {

    public $race_id;
    public $driver_id;
    public $driver_2_id;
    public $constructor_id;
    public $engine_id;

    function __construct(pdo $conn, int $id) {
        $this->race_id = $id;
        $query = "SELECT driver_id, driver_2_id, constructor_id, engine_id FROM wins WHERE race_id=?";
        $stmt =$conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->driver_id = $result['driver_id'];
        $this->driver_2_id = $result['driver_2_id'];
        $this->constructor_id = $result['constructor_id'];
        $this->engine_id = $result['engine_id'];
    }
}
