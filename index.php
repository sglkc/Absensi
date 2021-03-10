<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Absensi</title>
</head>
<body>
	<h1>Absensi <button onclick="toggleTheme()">Theme</button></h1>
	<form method="POST" action="index.php">
		<div id="form">
			<div id="form-nama">
				<label for="nama">Nama: </label>
				<input type="text" name="nama" autocomplete="off" autofocus="on" required>
			</div>
			<div id="form-kelas">
				<label for="kelas">Kelas: </label>
				<select name="kelas" onchange="checkClVal()" required>
					<option value="10">10 - X</option>
					<option value="11">11 - XI</option>
					<option value="12">12 - XII</option>
					<option value="13">13 - XIII</option>
				</select>
				<select name="jurusan" required>
					<option disabled="on">-- AK --</option>
					<option value="AK 1">AK 1</option>
					<option value="AK 2">AK 2</option>
					<option value="AK 3">AK 3</option>
					<option value="AK 4">AK 4</option>
					<option value="AK 5">AK 5</option>
					<option value="AK 6">AK 6</option>
					<option disabled="on">-- TKJ --</option>
					<option value="TKJ 1">TKJ 1</option>
					<option value="TKJ 2">TKJ 2</option>
					<option value="TKJ 3">TKJ 3</option>
					<option disabled="on">-- RPL --</option>
					<option value="RPL 1">RPL 1</option>
					<option value="RPL 2">RPL 2</option>
				</select>
			</div>
			<div id="form-button">
				<label for="absen"></label>
				<input type="submit" value="Absen" id="absen">
			</div>
		</div>
		<div id="list"></div><br>
	</form>
	<footer>
		<div>
			<p>sglkc @ Februari 2021</p>
		</div>
	</footer>
	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
		var filter = false;

		<?php
		if (isset($_GET['filter'])) {
			echo "filter = \"".$_GET['filter']."\";";
		}
		?>

		if (filter) {
			var interval = setInterval(function (){
				if (isLoaded()) {
					console.log("cleared");
					clearInterval(interval);

					// if (show) showRow(matchRow(show));
					filterRow(matchRow(filter));
				}
			}, 500);
			
			function isLoaded() {
				var table = document.getElementById("tblList");
				if (table) return true; else return false;
			}
		}
	</script>
</body>
</html>

<?php 
include 'mysql.php';

if (isset($_POST['nama'])) {
	if ($_POST['nama'] == $adminName) {
		if (isset($_POST['reset'])) {
		
			$delete = "DELETE FROM $dbTable";
			$resinc = "ALTER TABLE $dbTable AUTO_INCREMENT = 1";
			$mysqli->query($delete);
			$mysqli->query($resinc);
		
		} elseif (isset($_POST['del'])) {
		
			$id = $_POST['del'];
			$delete = "DELETE FROM $dbTable WHERE id = $id";

			if (!$mysqli->query($delete)){
				echo "<script>alert('Error deleting $id')</script>";
			}
			
			$mysqli->query("SET @count = 0;");
			$mysqli->query("UPDATE $dbTable SET $dbTable.id = @count:= @count + 1;");
			$mysqli->query("ALTER TABLE $dbTable AUTO_INCREMENT = 1;");
		
		}
	} else {
		
		$nama = $_POST['nama'];
		$kelas = $_POST['kelas'];
		$jurusan = $_POST['jurusan'];
		$time = time() + 60 * 60 * 6;
		$insert = "INSERT INTO $dbTable VALUES (NULL, '$time', '$nama', '$kelas', '$jurusan')";
		$mysqli->query($insert);

	}
}
?>
