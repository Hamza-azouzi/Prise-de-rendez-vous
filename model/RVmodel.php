


<?php

include_once __DIR__ . "/../config/connection.php";

class RVModel extends Connection
{


    //DB stuff
    private $conn;
    private $table = "rendez_vous";

    //rendez-vous Properties
    public $id;
    public $date;
    public $time;
    public $reference_id;
    public $typeConsultation;


    //Constructor with DB 

    // Get rendez-vous

    public function read()
    {


        //create query


        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY date DESC  ';


        //Prepare statement 

        $stmt = $this->sql->prepare($query);

        //Execute query

        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {


        $query = 'SELECT id, date, time, reference_id, typeConsultation FROM ' . $this->table . ' as rv WHERE rv.id=? LIMIT 0,1 ';

        $stmt = $this->sql->prepare($query);

        //Bind ID 

        $stmt->bindParam(1, $this->id);

        //Execute query

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties


        return $row;

        print_r($row);
    }

    public function create()
    {

        $query = "INSERT INTO rendez_vous (date,time,reference_id,typeConsultation) VALUES (:date,:time,:reference_id,:typeConsultation)";

        //Prepare statement

        $stmt = $this->sql->prepare($query);

        //Bind data 

        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':reference_id', $this->reference_id);
        $stmt->bindParam(':typeConsultation', $this->typeConsultation);

        return  $stmt->execute();
    }

    public function update()
    {

        $query = ' UPDATE  ' . $this->table . ' SET  date=:date , time=:time , reference_id=:reference_id , typeConsultation=:typeConsultation WHERE id=:id ';

        //Prepare statement

        $stmt = $this->sql->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':reference_id', $this->reference_id);
        $stmt->bindParam(':typeConsultation', $this->typeConsultation);

        if ($stmt->execute()) {
            return true;
        }

        //Print error if something goes wrong 

        printf("error:%s.\n", $stmt->error);

        return false;
    }
}
