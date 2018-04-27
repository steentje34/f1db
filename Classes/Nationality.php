<?php

/**
 * Description of Nationality
 *
 * @author Simon
 */
class Nationality {

    public $code;
    public $country;

    function __construct(pdo $conn, string $code) {
        $this->code = $code;
        $query = "SELECT country FROM nationalities WHERE code=?";
        $stmt =$conn->prepare($query);
        $stmt->bindValue(1, $code, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->country = $result['country'];
    }
}
