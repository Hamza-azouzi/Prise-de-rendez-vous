<?php
//Headers
header('Acces-Control-Allow-Origin: *');

header('Content-Type: application/json');

header('Access-Control-Allow-Methods: POST');

header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once __DIR__ . '/../model/usermodel.php';

class User
{

    //Instantiate user object
    public function read()
    {

        $user = new UserModel();

        echo json_encode($user->read()->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
    }

    public function read_single($ref)
    {

        //Instantiate blog user$user object
        $user = new UserModel;
        //Get ID
        $user->reference = $ref;

        //Make Json
        echo json_encode($user->read_single());
    }

    public function create()
    {

        $user = new UserModel;

        //Get raw user data 

        $data = json_decode(file_get_contents("php://input"));

        $user->reference = $data->reference;
        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->age = $data->age;
        $user->email = $data->email;
        $user->tel = $data->tel;



        //Create user

        if ($user->create()) {

            echo json_encode(
                [
                    'message' => 'User Create',
                    'data' => $data
                ]
            );
        } else {
            echo json_encode(
                array('message' => 'User Not Create')
            );
        }
    }
}
