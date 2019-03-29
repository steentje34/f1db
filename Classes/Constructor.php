<?php

/**
 * Description of Constructor
 *
 * @author Simon
 */
class Constructor {

    public $conn;
    public $id;
    public $name;

    function __construct(pdo $conn, int $id) {
        $this->conn = $conn;
        $this->id = $id;
        $query = "SELECT name FROM constructors WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $result['name'];
    }

    function getChampionships(): int {
        $query = "SELECT count(*) AS count FROM seasons WHERE constructor_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $championships = (is_null($result['count']) ? 0 : $result['count']);

        return $championships;
    }

    function getPointsAwarded(): int {
        $query = "SELECT ifnull(sum(constructor_points), 0) AS sum FROM points WHERE constructor_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['sum'];
    }

    function getPointsDiscarded(): int {
        $query = "SELECT ifnull(sum(constructor_points_discarded), 0) AS sum FROM points WHERE constructor_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['sum'];
    }

    function getPointsTotal(): int {
        $query = "SELECT ifnull(sum(constructor_points), 0) + ifnull(sum(constructor_points_discarded), 0) AS sum FROM points WHERE constructor_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['sum'];
    }

    function getWins(): int {
        $query = "SELECT count(*) AS count FROM wins WHERE constructor_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $wins = (is_null($result['count']) ? 0 : $result['count']);

        return $wins;
    }

    function getPoles(): int {
        $query = "SELECT count(*) AS count FROM poles WHERE constructor_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $poles = (is_null($result['count']) ? 0 : $result['count']);

        return $poles;
    }

    function getFastestLaps(): int {
        $query = "SELECT count(*) AS count FROM fastest_laps WHERE constructor_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $fastestLaps = (is_null($result['count']) ? 0 : $result['count']);

        return $fastestLaps;
    }

}
