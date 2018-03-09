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

    function __construct($conn, $id) {
        $this->conn = $conn;
        $this->id = $id;
        $query = "SELECT last_name, first_name, nationality, birth_date, death_date FROM drivers WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $last_name, $first_name, $nationality, $birth_date, $death_date);
        mysqli_store_result($conn);

        while (mysqli_stmt_fetch($stmt)) {
            $this->last_name = $last_name;
            $this->first_name = $first_name;
            $this->nationality = $nationality;
            $this->birth_date = $birth_date;
            $this->death_date = $death_date;
        }
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
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $this->id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_store_result($this->conn);
        
        while (mysqli_stmt_fetch($stmt)) {
            $result = $count;
        }
        
        return $result;
    }
}
