
<?php
//Headers
header('Acces-Control-Allow-Origin: *');

header('Content-Type: application/json');

header('Access-Control-Allow-Methods: POST');

header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once __DIR__ . '/../model/RVmodel.php';

class RV
{


    //Instantiate rv object
    public function read()
    {

        $rv = new RVModel;

        echo json_encode($rv->read()->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
    }

    public function read_single($iD)
    {

        //Instantiate blog rv$rv object

        $rv = new RVModel;

        //Get ID

        $rv->id = $iD;

        //Make Json

        echo json_encode($rv->read_single());
    }


    public function create()
    {

        $rv = new RVModel;

        //Get raw rv data 

        $data = json_decode(file_get_contents("php://input"));

        $rv->date = $data->date;
        $rv->time = $data->time;
        $rv->reference_id = $data->reference_id;
        $rv->typeConsultation = $data->typeConsultation;

        //Create rv
        try {
            $result = $rv->create();
            if ($result) {
                echo json_encode(
                    [
                        'message' => 'rv Create',
                        'data' => $data
                    ]
                );
            } else {
                echo json_encode(
                    array('message' => 'rv Not Create')
                );
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update()
    {

        $rv = new RVModel;

        //Get raw rv data 

        $data = json_decode(file_get_contents("php://input"));

        $rv->id = $data->id;
        $rv->date = $data->date;
        $rv->time = $data->time;
        $rv->reference_id = $data->reference_id;
        $rv->typeConsultation = $data->typeConsultation;


        //update rv
        if ($rv->update()) {
            echo json_encode(
                array('message' => 'rv update')
            );
        } else {
            echo json_encode(
                array('message' => 'rv Not update')
            );
        }
    }
}
