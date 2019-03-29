<?php

/**
 * Description of Engine
 *
 * @author Simon
 */
class Engine {

    public $conn;
    public $id;
    public $name;

    function __construct(pdo $conn, int $id) {
        $this->conn = $conn;
        $this->id = $id;
        $query = "SELECT name FROM engines WHERE id=?";
        $stmt =$conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $result['name'];
    }

    function getChampionships(): int {
        $query = "SELECT count(*) AS count FROM seasons WHERE engine_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $championships = (is_null($result['count']) ? 0 : $result['count']);

        return $championships;
    }

    function getWins(): int {
        $query = "SELECT count(*) AS count FROM wins WHERE engine_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $wins = (is_null($result['count']) ? 0 : $result['count']);

        return $wins;
    }

    function getPoles(): int {
        $query = "SELECT count(*) AS count FROM poles WHERE engine_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $poles = (is_null($result['count']) ? 0 : $result['count']);

        return $poles;
    }

    function getFastestLaps(): int {
        $query = "SELECT count(*) AS count FROM fastest_laps WHERE engine_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $fastestLaps = (is_null($result['count']) ? 0 : $result['count']);

        return $fastestLaps;
    }
}
