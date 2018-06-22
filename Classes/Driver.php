<?php

/**
 * Description of Driver
 *
 * @author Simon
 */
class Driver {

    public $conn;
    public $id;
    public $last_name;
    public $first_name;
    public $nationality;
    public $birth_date;
    public $death_date;

    function __construct(pdo $conn, int $id) {
        $this->conn = $conn;
        $this->id = $id;
        $query = "SELECT last_name, first_name, nationality, birth_date, death_date FROM drivers WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->last_name = $result['last_name'];
        $this->first_name = $result['first_name'];
        $this->nationality = $result['nationality'];
        $this->birth_date = $result['birth_date'];
        $this->death_date = $result['death_date'];
    }

    function calculateAge(): int {
        $from = new DateTime($this->birth_date);
        if ($this->death_date !== NULL){
            $to = new DateTime($this->death_date);
        } else {
            $to = new DateTime('today');
        }
        
        return $from->diff($to)->y;
    }
    
    function getChampionships(): int {
        $query = "SELECT count(*) AS count FROM seasons WHERE driver_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $championships = (is_null($result['count']) ? 0 : $result['count']);

        return $championships;
    }

    function getPointsAwarded(): int {
        $query = "SELECT ifnull(sum(driver_points), 0) AS sum FROM points WHERE driver_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['sum'];
    }

    function getPointsDiscarded(): int {
        $query = "SELECT ifnull(sum(driver_points_discarded), 0) AS sum FROM points WHERE driver_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['sum'];
    }

    function getPointsTotal(): int {
        $query = "SELECT ifnull(sum(driver_points), 0) + ifnull(sum(driver_points_discarded), 0) AS sum FROM points WHERE driver_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['sum'];
    }

    function getWins(): int {
        $query = "SELECT count(*) AS count FROM wins WHERE driver_id=? OR driver_2_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->bindValue(2, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $wins = (is_null($result['count']) ? 0 : $result['count']);

        return $wins;
    }

    function getPoles(): int {
        $query = "SELECT count(*) AS count FROM poles WHERE driver_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $poles = (is_null($result['count']) ? 0 : $result['count']);

        return $poles;
    }

    function getFastestLaps(): int {
        $query = "SELECT count(*) AS count FROM fastest_laps WHERE driver_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $fastestLaps = (is_null($result['count']) ? 0 : $result['count']);

        return $fastestLaps;
    }
}
