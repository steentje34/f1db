<?php

/**
 * Description of Season
 *
 * @author Simon
 */
class Season {

    public $id;
    public $driver_id;
    public $constructor_id;
    public $engine_id;

    function __construct(pdo $conn, int $id) {
        $this->id = $id;
        $query = "SELECT driver_id, constructor_id, engine_id FROM seasons WHERE id=?";
        $stmt =$conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->driver_id = $result['driver_id'];
        $this->constructor_id = $result['constructor_id'];
        $this->engine_id = $result['engine_id'];
    }
}
