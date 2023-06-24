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
    
    $data = '<div class="solution-bg"></div>
    <div class="solution-area-heading">
          Doctors found in your area
        </div><div class="steps-bg">';
        $doctor_data = "";
        
    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorimage = $row["DoctorImage"];

        $doctor_data = $doctor_data.'
        <div class="search-doctor-icon">
            <div class="search-sq"></div>
            <img
              class="search-doctor-emoji"
              alt=""
              src="'.$doctorimage.'"
            />
            <div class="search-doctor">'.$doctorname.'</div>
            <div class="search-doctor-des-container">
              <p class="discovering-a-doctor">'.$doctorinfo.'</p>
              
            </div>
            
          </div>';
    }

   

} else{
    $data = '<div class="solution-bg"></div><div class="solution-area-heading">
          No Doctor found in your area
        </div>';
}
//sending response back to the request
//echo json_encode($data);
}else{
    $data = '<div class="solution-bg"></div><div class="solution-area-heading">
          Bad Query
        </div>';
}

$data = $data.$doctor_data;
echo $data;

?>