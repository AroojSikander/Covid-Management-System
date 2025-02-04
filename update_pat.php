<!DOCTYPE html>
<html>
    <head>
        <title>Patients Record</title>
        <link href="styles.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body class="body">
        <div class="navbar">
            <p class="title">Covid-19 Management System</p>
            <div class="links">
                <a href="homepage.php">Homepage</a>
                <a href="isolation.php">Isolation Wards</a>
                <a href="quarantine.php">Quarantine Wards</a>
                <a class="active" href="patients.php">Patients Record</a>
                <a href="staff.php">Staff</a>
                <a href="helpline.php">Helpline</a>
                <a href="recommendations.php">Recommendations</a>
                <a href="admin.php">Admin</a>
            </div>
        </div>

        <div class="col-lg-5 m-auto">

        <form method ="post">
        <br><br>
        <div class="card">

        <div class="card-header bg-dark">

        <h1 class="text-white text-center">Patients form(Update)</h1>
        </div>
        <br>
        <!-- <label class="m-auto"> Patient id: </label>
        <input type="text" name="P_id" class="form-control m-auto"> <br> -->

        <label class="m-auto"> Patient Name: </label>
        <input type="text" name="Name" class="form-control m-auto"> <br>

        <label class="m-auto"> Status: </label>
        <input type="text" name="status" class="form-control m-auto"> <br>

        <label class="m-auto"> Quarantine Ward ID: </label>
        <input type="text" name="q_ward_id" class="form-control m-auto"> <br>

      <!--  <label class="m-auto"> Isolation Ward ID: </label>
        <input type="text" name="i_ward_id" class="form-control m-auto"> <br> -->

        <label class="m-auto"> Manager ID: </label>
        <input type="text" name="manager_id" class="form-control m-auto"> <br>

        <label class="m-auto"> Phone no: </label>
        <input type="text" name="phone_no" class="form-control m-auto"> <br>

        <label class="m-auto"> Region ID: </label>
        <input type="text" name="region_id" class="form-control m-auto"> <br>

        <label class="m-auto"> Address: </label>
        <input type="text" id="address" name="address" class="form-control m-auto">
      <br>
				<button class="btn btn-success m-auto" id="btn" type="button">Get Location</button>
                <br>
		<div id="map" style="width: 100%; height: 400px; border: 1px solid black;"></div>
<br><br>
        <button class="btn btn-success m-auto" type="submit" name="done"> Update </button>

       <input type="hidden" name="lat" id="lat" />
		<input type="hidden" name="lng" id="lng" />
        <br><br>
        </div> 

        </form>
        <br><br>
       <div class="text-center">
            <button onclick="location.href = 'patient_show.php';" type="submit" name="submit" class="float-right submit-button">Return to list</button>
            </div>
            <br><br>
        </div>
<br><br>







            <div class="footer">
                <div class="sub">
                    <ul >
                    <li><a href="homepage.php">Homepage</a></li>
                    <li><a href="isolation.php">Isolation Wards</a></li>
                    <li><a href="quarantine.php">Quarantine Wards</a></li>
                    <li><a class="active" href="patients.php">Patients Record</a></li>
                    <li><a href="staff.php">Staff</a></li>
                    <li><a href="helpline.php">Helpline</a></li>
                    <li><a href="recommendations.php">Recommendations</a></li>
                    <li><a href="admin.php">Admin</a></li>
                    </ul>
                    </div>
                    <br><br><br>
      <p class="p">&copy; Covid-19 Management System</p>
                </div>
                <script type="text/javascript">
		const API_KEY = "AIzaSyCrt3fvZJoTCA0oav2zYS2v937Ja7NZg2E";
	
		var btn = document.getElementById("btn");
		btn.addEventListener('click', async (event) => {
			event.preventDefault();
			
			let address = document.getElementById("address").value;
			let response =  await fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=${API_KEY}`);
		
			if(response.ok) {
				let json = await response.json();
				let location = json.results[0].geometry.location;
				
				renderMap(location);
			}
		});
		
			
        function renderMap(location) {
			console.log(location);
			var latval = location.lat;
			var lngval = location.lng;    

			var mapOptions = {
				zoom: 12,
				center: new google.maps.LatLng(latval, lngval),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			var map = new google.maps.Map(document.getElementById('map'), mapOptions);	
			
			var infoWindow = new google.maps.InfoWindow;
			//infoWindow.setPosition(location);
            infoWindow.open(map);
            map.setCenter(location);
			
			var marker = new google.maps.Marker({
				position: location,
				map: map,
				draggable: true,
				animation: google.maps.Animation.DROP,
				icon: {
					url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
					labelOrigin: new google.maps.Point(75, 32),
					size: new google.maps.Size(32,32),
					anchor: new google.maps.Point(16,32)
				}
			});
        
			marker.addListener('click', () => {
				if (marker.getAnimation() !== null) {
					marker.setAnimation(null);
				} else {
					marker.setAnimation(google.maps.Animation.BOUNCE);
				}
			});
			
			marker.addListener('dragend', handleEvent);
			
			function handleEvent(event) {
				var updatedLatitude = event.latLng.lat();
				var updatedLongitude = event.latLng.lng();
				
				document.getElementById("lat").value = updatedLatitude;
				document.getElementById("lng").value = updatedLongitude;
			}
        }
		
		function initMap() {
		
		}
	</script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrt3fvZJoTCA0oav2zYS2v937Ja7NZg2E&callback=initMap">
    </script>
    </body>
</html>
<?php
include 'db_connection.php';

$conn = OpenCon();

if(isset($_POST['done']))
{
        $id = $_GET['P_id']; 
        $name = $_POST["Name"];
        $status = $_POST["status"]; 
        $address = $_POST["address"];
        $latitude = $_POST["lat"];
        $longitude = $_POST["lng"];
        $q_ward_id = $_POST["q_ward_id"];
        $manager_id = $_POST["manager_id"];
        $phone_no = $_POST["phone_no"];
        $region_id = $_POST["region_id"];

        $query = "UPDATE `patient` SET `P_id`='$id',`Name`='$name',`Status`='$status',`Address`='$address',`Latitude`='$latitude', `Longitude`='$longitude',`Q_Ward_id`='$q_ward_id',`I_Ward_id`=NULL,`Manager_id`='$manager_id',`Phone_no`='$phone_no',`Region_id`='$region_id' WHERE P_id=$id";
        $q=mysqli_query($conn, $query);

       // header('location:patient_show.php');
}

CloseCon($conn);
?>