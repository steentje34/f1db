<?php

/**
 * Description of Nationality
 *
 * @author Simon
 */
class Nationality {

    public $code;
    public $country;

    function __construct($conn, $code) {
        $this->code = $code;
        $query = "SELECT country FROM nationalities WHERE code=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $code);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $country);
        mysqli_store_result($conn);
        
        while (mysqli_stmt_fetch($stmt)) {
            $this->country = $country;
        }
    }

}
