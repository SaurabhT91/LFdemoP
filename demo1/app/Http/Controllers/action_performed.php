<?php

header("Access-Control-Allow-Origin: http://localhost");

header("Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: plain/text');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods,Access-Control-Allow-Origin, Access-Control-Allow-Credentials, Authorization, X-Requested-With");


session_start();
// Include and initialize DB class
require_once 'database_class.php';

$db = new DB();

var_dump($_POST);


// Database table name
$tblName = 'lead_data';

$postData = $statusMsg = $valErr = '';
$status = 'danger';
$redirectURL = 'index.php';


//echo $_REQUEST['action_type'];
//die();
function valid_phone($phone){
    if(preg_match('/^[0-9]{10}+$/', $phone))
    {
        return "1";
    }
    else{
        return "0";
    }
}




// If Add request is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action_type'] == 'add') {
    $redirectURL = 'user_page.php';
    // Get user's input
    $postData = $_POST;
    $name = !empty($_POST['Lead_name'])?trim($_POST['Lead_name']):'';
    $phone = !empty($_POST['Contact_number'])?trim($_POST['Contact_number']):'';
    $validity = valid_phone($phone);
//    echo "validity : ". $validity;
//    die();
    if ($validity)
    {
        $address = !empty($_POST['Address'])?trim($_POST['Address']):'';
        $city = !empty($_POST['City'])?trim($_POST['City']):'';
        $State_name = !empty($_POST['State_name'])?trim($_POST['State_name']):'';
        $employment = !empty($_POST['Employment_type'])?trim($_POST['Employment_type']):'';
        $Loan = !empty($_POST['Loan_status'])?trim($_POST['Loan_status']):'';
        $USER_ID =$_SESSION['USER_ID'];


        // Validate form fields
        if (empty($name)) {
            $valErr .= 'Please enter your name.<br/>';
        }
        if (empty($phone)) {
            $valErr .= 'Please enter your phone no.<br/>';
        }
        if (empty($address)) {
            $valErr .= 'Please enter your phone no.<br/>';
        }
        if (empty($city)) {
            $valErr .= 'Please choose city<br/>';
        }
        if (empty($state)) {
            $valErr .= 'Please choose city<br/>';
        }
        if (empty($employment)) {
            $valErr .= 'Please choose employment type<br/>';
        }
        if (empty($loan)) {
            $valErr .= 'Please enter leads loan status.<br/>';
        }


        // Check whether user inputs are empty
        if (!empty($valErr)) {
            // Insert data into the database
            $userData = array(
                'Lead_name' => $name,
                'Contact_number' => $phone,
                'Address' => $address,
                'City' => $city,
                'State_name' => $State_name,
                'Employment_type' => $employment,
                'Loan_status' => $Loan,
                'USER_ID'=>$USER_ID,
            );
//            var_dump($leadData);
            $insert = $db->insert_lead($userData,$USER_ID);

            if ($insert) {
                $status = 'success';
                $statusMsg = 'User data has been added successfully!';
                $postData = '';

                $redirectURL = 'index.php';
            } else {
                $statusMsg = 'Something went wrong, please try again after some time.';
            }
        } else {
            $statusMsg = '<p>Please fill all the mandatory fields:</p>' . trim($valErr, '<br/>');
        }

        // Store status into the SESSION
        $sessData['postData'] = $postData;
        $sessData['status']['type'] = $status;
        $sessData['status']['msg'] = $statusMsg;
        $_SESSION['sessData'] = $sessData;

        http_response_code(200);

    }
    else
    {
        echo "you provided invalid phone number. ";
    }

}
elseif($_SERVER['REQUEST_METHOD'] == 'DELETE'){ // If Delete request is submitted
    // Delete data from the database

    $conditions = $_GET['deleteID'];

    $delete = $db->delete($tblName, $conditions);

    if($delete){
        $status = 'success';
        $statusMsg = 'User data has been deleted successfully!';
       
    }else{
        $statusMsg = 'Something went wrong, please try again after some time.';
    }

    // Store status into the SESSION
    $sessData['status']['type'] = $status;
    $sessData['status']['msg'] = $statusMsg;
    $_SESSION['sessData'] = $sessData;

    http_response_code(200);

}
elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action_type'] == 'update' && !empty($_POST['id']))
{ // If Edit request is submitted
    $redirectURL = 'form.php?id=' . $_POST['id'];
    $id=$_POST['id'];
    // Get user's input
    $postData = $_POST;
    $name = !empty($_POST['Lead_name']) ? trim($_POST['Lead_name']) : '';
    $phone = !empty($_POST['Contact_number']) ? trim($_POST['Contact_number']) : '';

    $validity = valid_phone($phone);
//    echo "validity : ". $validity;
//    die();
    if ($validity === "0")
    {
        echo "you provided invalid phone number. ";
        echo "<a href=form.php?id=$id>GO BACK</a>";
    }
    else
    {
        $address = !empty($_POST['Address']) ? trim($_POST['Address']) : '';
        $city = !empty($_POST['City'])?trim($_POST['City']):'';
        $State_name = !empty($_POST['State_name'])?trim($_POST['State_name']):'';
        $employment = !empty($_POST['Employment_type'])?trim($_POST['Employment_type']):'';
        $Loan = !empty($_POST['Loan_status'])?trim($_POST['Loan_status']):'';
        $User_Id = $_SESSION['USER_ID'];

        // Validate form fields
        if (empty($name)) {
            $valErr .= 'Please enter your name.<br/>';
        }
        if (empty($phone)) {
            $valErr .= 'Please enter your phone no.<br/>';
        }
        if (empty($address)) {
            $valErr .= 'Please enter your phone no.<br/>';
        }
        if (empty($city)) {
            $valErr .= 'Please choose city<br/>';
        }
        if (empty($state)) {
            $valErr .= 'Please choose city<br/>';
        }
        if (empty($employment)) {
            $valErr .= 'Please choose employment type<br/>';
        }
        if (empty($loan)) {
            $valErr .= 'Please enter your loan status.<br/>';
        }
        if (empty($User_ID)) {
            $valErr .= 'Please enter your loan status.<br/>';
        }

        // Check whether user inputs are empty
        // Check whether user inputs are empty
        if (!empty($valErr)) {
            // Insert data into the database
            $userData = array(
                'Lead_name' => $name,
                'Contact_number' => $phone,
                'Address' => $address,
                'City' => $city,
                'State_name' => $State_name,
                'Employment_type' => $employment,
                'Loan_status' => $Loan,
                'User_Id'=>$User_Id,

            );
            $conditions = array('id' => $_POST['id']);
            $update = $db->update_lead($userData, $conditions,$User_Id);

            if ($update) {
                $status = 'success';
                $statusMsg = 'User data has been updated successfully!';
                $postData = '';

                $redirectURL = 'index.php';
            } else {
                $statusMsg = 'Something went wrong, please try again after some time.';
            }
        } else {
            $statusMsg = '<p>Please fill all the mandatory fields:</p>' . trim($valErr, '<br/>');
        }

        // Store status into the SESSION
        $sessData['postData'] = $postData;
        $sessData['status']['type'] = $status;
        $sessData['status']['msg'] = $statusMsg;
        $_SESSION['sessData'] = $sessData;

        http_response_code(200);
    }


}
elseif(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'search' && !empty($_POST['search']))
{ // If Edit request is submitted
//    $redirectURL = 'index.php?id=' . $_POST['id'];
    $conditions = $_POST['id'];
    $data = $db->get_lead_by_id('lead_data', $conditions);
    var_dump($data);
}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action_type'] == 'login')
{

   

    $conditions = $_POST['USER_NAME'];
    $data = $db->get_user_by_username('users', $conditions);

    if ($data['USER_PASSWORD'] === $_POST['PASSWORD'])
    {
        session_start();
        $_SESSION['USER_ID'] = $data['USER_ID'];
        $_SESSION['NAME']= $data['NAME'];
        $_SESSION['LOGGED_IN'] = TRUE;
        ?>
        <input type="hidden" value="<?php echo $_SESSION['USER_ID'];echo $_SESSION['USER_NAME'] ;?>">
        <?php
        header("Location: resources/views/user_page");
    }
    else
    {
        echo "invalid user name  or password";
    }

}
elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action_type'] == 'signup')
{
    $postData = $_POST;
    $user_name = !empty($_POST['USER_NAME'])?trim($_POST['USER_NAME']):'';
    $user_password = !empty($_POST['PASSWORD'])?trim($_POST['PASSWORD']):'';
    $user_id = !empty($_POST['USER_ID'])?trim($_POST['USER_ID']):'';
    $name = !empty($_POST['NAME'])?trim($_POST['NAME']):'';

    $userData = array(
        'USER_NAME' => $user_name,
        'USER_PASSWORD' => $user_password,
        'USER_ID' => $user_id,
        'NAME' => $name,);


    $insert = $db->SIGNUP($tblName, $userData);

    if ($insert) {
        $status = 'success';
        $statusMsg = 'User data has been added successfully!';
        $postData = '';

        $redirectURL = 'index.php';
    } else {
        $statusMsg = 'Something went wrong, please try again after some time.';
    }


    // Store status into the SESSION
    $sessData['postData'] = $postData;
    $sessData['status']['type'] = $status;
    $sessData['status']['msg'] = $statusMsg;
    $_SESSION['sessData'] = $sessData;

    header("location: index.php"   );
}