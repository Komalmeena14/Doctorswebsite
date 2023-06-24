<?php

$search_param = $_POST["search"];
$search_area = $_POST["area"];

if(isset($_POST["search"]) && isset($_POST["area"])){
//echo $search_param;
//echo $search_area;

// Connect to database
$host = "localhost";
$dbuser = "id20925635_doctorspage";
$dbpass = "Abcd123!";
$dbname = "id20925635_doctor";

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

$sql = "SELECT * FROM `Doctor` WHERE DoctorArea like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorimage = $row["DoctorImage"];

        $doctor_data["DocName"] = $doctorname;
        $doctor_data["DocInfo"] = $doctorinfo;
        $doctor_data["DocImage"] = $doctorimage;

        $data[$doctorid] = $doctor_data;
    }

    $data["Result"] = "True";
    $data["Message"] = "Doctors fetched successfully";

} else{
    $data["Result"] = "False";
    $data["Message"] = "No Doctor Found";
}
//sending response back to the request
//echo json_encode($data);
}else{
    $data["Result"] = "False";
    $data["Message"] = "Bad Query";
}

echo json_encode($data, JSON_UNESCAPED_SLASHES);

?>