<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
        <iframe id="audio" src="https://www.youtube.com/embed/yB1rg7cAI1M?autoplay=1&amp;playlist=yB1rg7cAI1M&loop=1" width="0" height="0" allowtransparency="true" frameborder="0"></iframe><form method="POST" action="">
		<form method="POST">
		</form>
		
		<?php
		session_start();

		if(isset($_SESSION['login'])) {
			$name = $_SESSION['login'];
			echo "<h1>"."Welkom, ". $name->name."<h1/>";
		}else {header('Location: Login.php');}
		
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
		
		echo "<h3><table style='border: solid 3px yellow; background-color:green;'>";
		echo "<tr><th>Naam</th><th>Aanhef</th><th>Gender</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th><th>Email</th><th>tel</th><th>dag</th></tr></h3>";

		class TableRows extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}

			function current() {
				return "<td style='width: 165px; border: 2px solid yellow; background-color: purple'>" . parent::current(). "</td>";
			}

			function beginChildren() {
				echo "<tr>";
			}

			function endChildren() {
				echo "</tr>" . "\n";
			}
		}
				
		$query = "SELECT inschrijving.name, inschrijving.aanhef, inschrijving.gender, inschrijving.adres, inschrijving.postcode, inschrijving.residence, inschrijving.email, inschrijving.tel, inschrijving.workshop
					FROM inschrijving ";
		$stm = $con->prepare($query);
				
		if ($stm->execute()){
			$result = $stm->setFetchMode(PDO::FETCH_ASSOC);
			foreach(new TableRows(new RecursiveArrayIterator($stm->fetchAll())) as $k=>$v) {
				echo $v;
			}
		}

		?>
	</body>
</html>