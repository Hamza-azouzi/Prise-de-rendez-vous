
<?php

include_once __DIR__ . "/../config/connection.php";

class UserModel extends Connection
{

    //DB stuff
    private $conn;
    private $table = "user";

    //user Properties
    public $reference;
    public $firstname;
    public $lastname;
    public $age;
    public $email;
    public $tel;

    //Constructor with DB 

    // Get user

    public function read()
    {

        //create query

        $query = 'SELECT  u.reference , u.firstname , u.lastname , u.age , u.email , u.tel FROM ' . $this->table . ' as u LEFT JOIN `rendez_vous` as rv ON u.reference = rv.id ';

        //Prepare statement 

        $stmt = $this->sql->prepare($query);

        //Execute query

        $stmt->execute();

        return $stmt;
        
    }



    public function read_single()
    {

        //Create query

        $query = 'SELECT  u.reference , u.firstname , u.lastname , u.age , u.email , u.tel FROM ' . $this->table . ' as u LEFT JOIN `rendez_vous` as rv ON u.reference = rv.id   WHERE u.reference=? LIMIT 0,1';


        $stmt = $this->sql->prepare($query);

        //Bind ID 

        $stmt->bindParam(1, $this->reference);

        //Execute query

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //Set properties
        return $row;
    }

    

            //Create user
    public function create()
    {
        //Create query
        $query = 'INSERT INTO '  . $this->table . ' (reference, firstname, lastname, age, email, tel) VALUES (:reference,:firstname,:lastname,:age,:email,:tel)';
           
        //Prepare statement

        $stmt = $this->sql->prepare($query);

        //Clean data 
        // $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        // $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        // $this->age = htmlspecialchars(strip_tags($this->age));
        // $this->email = htmlspecialchars(strip_tags($this->email));
        // $this->tel = htmlspecialchars(strip_tags($this->tel));
      
        //Bind data 

        $stmt->bindParam(':reference',$this->reference );
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':tel', $this->tel);

        $stmt->execute();
        return $stmt;
 }

}