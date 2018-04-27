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

    function calculateAge() {
        $from = new DateTime($this->birth_date);
        if ($this->death_date !== NULL){
            $to = new DateTime($this->death_date);
        } else {
            $to = new DateTime('today');
        }
        
        return $from->diff($to)->y;
    }
    
    function getChampionships() {
        $query = "SELECT count(driver_id) AS count FROM seasons WHERE driver_id=? GROUP BY driver_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $championships = $result['count'];

        return $championships;
    }
}
