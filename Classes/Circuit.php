<?php

/**
 * Description of Circuit
 *
 * @author Simon
 */
class Circuit {

    public $id;
    public $name;

    function __construct(mysqli $conn, int $id) {
        $this->id = $id;
        $query = "SELECT name FROM circuits WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name);
        mysqli_store_result($conn);

        while (mysqli_stmt_fetch($stmt)) {
            $this->name = $name;
        }
    }
}
