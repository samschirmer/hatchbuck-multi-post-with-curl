<?php

# PULLING VALUES FROM FORM SUBMISSION
$formid = $_POST["formID"];
$server_validation = $_POST["enableServerValidation"];
$enable_303 = $_POST["enable303Redirect"];
$firstname = $_POST["q1_firstName1"]; 
$lastname = $_POST["q3_lastName3"]; 
$email = $_POST["q4_email"];
$antispam = $_POST["website"];
$simple_spc = $_POST["simple_spc"];

# POSTING DATA TO ANOTHER API (LOGIC EXAMPLE)
#################################################
# $endpoint = "https://api.whatever.com/v1/add?key=MyApiKeyForOtherApp";
# $data_to_post = array("email" => $email, "firstname" => $firstname, "lastname" => $lastname);
# $json = json_encode($data);
#
# $ch = curl_init($url);
# curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
# curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
# curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
# curl_setopt($ch, CURLOPT_HTTPHEADER, array(
#   "Content-Type: application/json",
#   "Content-Length: " . strlen($json))
# );
#################################################


# POSTING DATA TO INTERNAL DATABASE VIA PDO (LOGIC EXAMPLE)
#################################################
# CONNECTING TO DB
# $db = new PDO('sqlite:db/contacts.db') or die("fail to connect db");
#
# WRITING AND PREPPING QUERY
# $insert_contacts_sql = 'INSERT INTO Contacts (FirstName, LastName, Email) VALUES (:firstname, :lastname, :email)';
# $insert_contacts = $db->prepare($insert_contacts_sql);
#
# EXECUTING QUERY
# $insert_contacts->execute(array(':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email)) or die(print_r($db->errorInfo(), true));
#################################################

# NOW POSTING FIELDS TO HATCHBUCK
$hb_submit_url = "https://app.hatchbuck.com/onlineForm/submit.php";
$fields = array(
	"formID" => urlencode($formid),
	"enableServerValidation" => urlencode($server_validation),
	"enable303Redirect" => urlencode($enable_303),
	"q1_firstName1" => urlencode($firstname),
	"q3_lastName3" => urlencode($lastname),
	"q4_email" => urlencode($email),
	"website" => urlencode($antispam),
	"simple_spc" => urlencode($simple_spc)
);

# FORMATTING QUERY STRINGS IN URL FOR POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

# INITIALIZE CONNECTION
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $hb_submit_url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

# CAPTURING ERRORS AND DROPPING CONNECTION
$result = curl_exec($ch);
curl_close($ch);

?>
