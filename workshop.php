<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" href="style.css">
		<title> Gratis Workshop </title>
	</head>
	<body>
        <iframe id="audio" src="https://www.youtube.com/embed/yB1rg7cAI1M?autoplay=1&amp;playlist=yB1rg7cAI1M&loop=1" width="0" height="0" allowtransparency="true" frameborder="0"></iframe><form method="POST" action="">
		<form method="POST">
		<h1>Workshop</h1>
		<hr>
		<h3>Naam:<input name="name" type="name"></h3>
		<h3>Aanhef:<br/><h3/>
			<h4><input type="radio" name="aanhef" value="dhr" /> dhr.
				<input type="radio" name="aanhef" value="mvr" /> mvr.
				<input type="radio" name="aanhef" value="dr" /> dr.</h4>
				
		<h3>Geslacht:</h3>
			<h4><input type="radio" name="gender" value="man" /> man
				<input type="radio" name="gender" value="woman" /> vrouw</h4>
		<h3> 		
			Adres:<input name="adres" type="text" /><br/>
			Postcode:<input name="postcode" type="text" /><br/>
			Woonplaats:<input name="wplaats" type="text" /><br/>
			Email:<input name="email" type="email" /><br/>
			telefoon:<input name="tel" type="phonenumber"/><br/>
		<br/>	
			Datum:<h3/>
			<h4><input type="radio" name="date" value="di"/> Dinsdag 13 februari 2020 van 09:00u – 13:30u<br/>
				<input type="radio" name="date" value="wo"/> Woensdag 14 februari 2020 van 13:00u – 17:30u<br/></h4>
		<br/>
		<h3><input type = "submit" name = "btnOpslaan" value = "Verstuur" /></h3>
		<br/>
		</form>
		
		<?php
		$host = "localhost";
        $dbname = "workshop";
        $username = "root";
        $password = "";

        try{
            $con = new PDO("mysql:host=".$host.";dbname=".$dbname.";",$username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
		
        catch(PDOException $ex)
        {
            echo "Connection failed: " . $ex->getMessage();
        }
		
		$query = "SELECT * FROM inschrijving WHERE workshop='di'";
		$stm = $con->prepare($query);
		$stm->execute();
		$resultDinsdag = $stm->fetchALL(PDO::FETCH_OBJ);
		$aantaldi = $stm->rowCount();
		
		$query = "SELECT * FROM inschrijving WHERE workshop='wo'";
		$stm = $con->prepare($query);
		$stm->execute();
		$resultWoensdag = $stm->fetchALL(PDO::FETCH_OBJ);
		$aantalwo = $stm->rowCount();
		
		if (isset($_POST["btnOpslaan"])){
		     
			$lijst = array();
			array_push($lijst, $_POST["name"]); 
			array_push($lijst, $_POST["aanhef"]);
			array_push($lijst, $_POST["gender"]);
			array_push($lijst, $_POST["adres"]);
			array_push($lijst, $_POST["postcode"]);
			array_push($lijst, $_POST["wplaats"]);
			array_push($lijst, $_POST["email"]);
			array_push($lijst, $_POST["tel"]);
			array_push($lijst, $_POST["date"]);
			
			foreach ($lijst as $key => $value)
			if(empty($value)){
				echo $key . "is niet ingevuld.";
			}else{
				echo $key . ":" . $value ; 
			}
				
			$name = $_POST["name"];
			$aanhef = $_POST["aanhef"];
			$gender = $_POST["gender"];
			$adres = $_POST["adres"];
			$postcode = $_POST["postcode"];
			$residence = $_POST["wplaats"];
			$email = $_POST["email"];
			$tel = $_POST["tel"];
			$workshop = $_POST["date"];
			
			if($workshop == "di"){
				if($aantaldi>=20){
					echo "<h3>Er zijn al 20 inschrijvingen dit is het maximaal.</h3>";
				}
				else{
					$query = "INSERT INTO inschrijving(name, aanhef, gender, adres, postcode, residence, email, tel, workshop) VALUES".
						"('$name', '$aanhef', '$gender', '$adres', '$postcode', '$residence', '$email', '$tel', '$workshop')";
					$stm = $con->prepare($query);
					if($stm->execute()){
						echo "record toegevoegd!";
					}
					else{
						echo "!werkt niet!";
					}
				}
			}
			
			
			if($workshop == "wo"){
				if($aantalwo>=20){
					echo "<h3>Er zijn al 20 inschrijvingen dit is het maximaal.</h3>";
				}
				else{
					$query = "INSERT INTO inschrijving (name, aanhef, gender, adres, postcode, residence, email, tel, workshop) VALUES".
						"('$name', '$aanhef', '$gender', '$adres', '$postcode', '$residence', '$email', '$tel', '$workshop')";
					$stm = $con->prepare($query);
					if($stm->execute()){
						echo "record toegevoegd!!";
					}
					else{
						echo "!werkt niet!";
					}
				}
			}
		}
		?>
	</body>
</html>