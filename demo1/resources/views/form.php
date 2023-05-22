
<?php
// Start session
session_start();

if(!$_SESSION['LOGGED_IN'] === TRUE)
{
    header("Location: index.php");
}

// Include and initialize DB class
require_once 'database_class.php';
$db = new DB();
//$city_DATA = $db->GET_CITY();
//$state_DATA= $db->GET_STATE();

// Fetch the user data by ID
if(!empty($_GET['id'])){
    $conditions =(int)$_GET['id'];
    $leadData = $db->get_lead_by_id('lead_data', $conditions);
    $action_type = "update";
    $page_type = "Update_lead";

}
else
{
    $leadData['Lead_name'] = '';
    $leadData['Contact_number'] = '';
    $leadData['Address'] = '';
    $leadData['City'] = '';
    $leadData['State_name'] = '';
    $leadData['Employment_type'] = '';
    $leadData['Loan_status'] = '';
    $leadData['id']='';
    $action_type = "add";
    $page_type = "Add lead";
}


// Get submitted form data

?>
<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
    <div class="row">
        <div class="col-md-12 head">
            <h5><?php echo $page_type; ?></h5>

        <!-- Back link -->
        <div class="float-right">
        <button id="back" >Back</button>
        </div>
    </div>



            <div class="col-md-12">
                <form>
                    <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="Lead_name" value="<?php echo !empty($postData['Lead_name'])?$postData['Lead_name']:$leadData['Lead_name']; ?>" required="">
                        </div><br>
                    <div class="form-group">
                        <label>Contact number</label>
                        <input type="number"  name="Contact number" value="<?php echo !empty($postData['Contact_number'])?$postData['Contact_number']:$leadData['Contact_number']; ?>" required="">
                    </div><br>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="Address" name="Address"><?php echo !empty($postData['Address'])?$postData['Address']:$leadData['Address']; ?></textarea>
                    </div><br>
                    <div class="form-group">
                        <label for="city"> City </label>
                        <select id="city" name="City">



                            <option value="Delhi"<?php if($leadData['City']==="Delhi"){ echo "selected"; } ?>>Delhi</option>
                            <option value="Mumbai"<?php if($leadData['City']==="Mumbai"){ echo "selected"; } ?>>Mumbai</option>
                            <option value="Chennai"<?php if($leadData['City']==="Chennai"){ echo "selected"; } ?>>Chennai</option>
                            <option value="Kolkata"<?php if($leadData['City']==="Kolkata"){ echo "selected"; } ?>>Kolkata</option>
                            <option value="Gurugram"<?php if($leadData['City']==="Gurugram"){ echo "selected"; } ?>>Gurugram</option>
                            <option value="Pune"<?php if($leadData['City']==="Pune"){ echo "selected"; } ?>>Pune</option>
                            <option value="Bengaluru"<?php if($leadData['City']==="Bengaluru"){ echo "selected"; } ?>>Bengaluru</option>
                            <option value="Ahemdabad"<?php if($leadData['City']==="Ahemdabad"){ echo "selected"; } ?>>Ahemdabad</option>
                            <option value="Nagpur"<?php if($leadData['City']==="Nagpur"){ echo "selected"; } ?>>Nagpur</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="state">State</label>
                        <select id="state" name="State_name">

                            <option value="delhi"<?php if($leadData['State_name']==="delhi"){ echo "selected"; } ?>>Delhi</option>
                            <option value="maharashtra"<?php if($leadData['State_name']==="maharashtra"){ echo "selected"; } ?>>Maharashtra</option>
                            <option value="tamil nadu"<?php if($leadData['State_name']==="tamil nadu"){ echo "selected"; } ?>>Tamil Nadu</option>
                            <option value="west bengal"<?php  if($leadData['State_name']==="west bengal"){ echo "selected"; } ?>>west bengal</option>
                            <option value="haryana"<?php  if($leadData['State_name']==="haryana"){ echo "selected"; } ?>>Haryana</option>
                            <option value="karnataka"<?php if($leadData['State_name']==="karnataka"){ echo "selected"; } ?>>Karnataka</option>
                            <option value="Gujarat"<?php  if($leadData['State_name']==="Gujarat"){ echo "selected"; } ?>>Gujarat</option>
                        </select>
                    </div><br>
                    <br>
                    <div class="form-group">
                        <legend>Employment Type</legend>

                        <label><input type="radio" value="salaried" name="Employment_type"<?php if($leadData['Employment_type']==="salaried"){ echo "checked"; } ?>>Salaried</label>
                        <label><input type="radio" value="Self employed" name="Employment_type"<?php if($leadData['Employment_type']==="Self employed"){ echo "checked"; } ?>>Self employed</label>
                        <label><input type="radio" value="unemployed" name="Employment_type"<?php if($leadData['Employment_type']==="unemployed"){ echo "checked"; } ?>>Not employed</label>

                    </div><br>
                    <div class="form-group">
                        <legend>Existing Loan</legend>

                        <label><input type="radio" name="Loan_status" value="no"<?php if($leadData['Loan_status']==="no"){ echo "checked"; } ?>>no</label><br>
                        <label><input type="radio" name="Loan_status" value="yes"<?php if($leadData['Loan_status']==="yes"){ echo "checked"; } ?>>yes</label><br>
                    </div><br>


                    <input type="hidden" name="id" value="<?php echo $leadData['id']; ?>"/>
                    <input class="form-group" type="hidden" name="action_type" value="<?php echo $action_type; ?>"/>

                    <input type="submit" class="form-control btn-primary" id="save" name="submit" value="Save"/>

                </form>
            </div>
        </div>
    </body>
    <script src ="form.js"></script>
</html>




