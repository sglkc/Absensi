<?php
include 'mysql.php';

// Ambil data dari tabel database
$query = "SELECT * FROM $dbTable";
$table = $mysqli->query($query);
$num_rows = mysqli_num_rows($table);

// Membuat tabel form
echo "<form action='index.php' method='POST'>
	<table id='tblList'><tr id='header'>
		<td class='sort' onclick='sortTable(0)'>Waktu <img src='img/arrow-down.png'</td>
		<td class='sort' onclick='sortTable(1)'>Kelas <img src='img/stripe.png'></td>
		<td class='sort' onclick='sortTable(2)'>Nama <img src='img/stripe.png'></td>
		<td>Aksi</td></tr>";

// Periksa data dari database
if ($num_rows){
	// Looping setiap data
	while($row = mysqli_fetch_assoc($table)){

		// Huruf awal dalam nama harus kapital
		$nama = ucwords($row['nama']);
		// Konversi format waktu
		$time = strftime("(%d-%m-%Y) %H:%M:%S", $row['time']);
		// Kelas dan jurusan digabung
		$kelas = $row['kelas']." ".$row['jurusan'];

		echo "<tr>
			<td>".
				strftime("(%d-%m-%Y) %H:%M:%S", $row['time'])
			."</td>
			<td>".
				$row['kelas']." ".$row['jurusan']
			."</td>
			<td>".
				ucwords($row['nama'])
			."</td>
			<td>
				<button type='submit' name='del' value='".$row['id']."'>Delete</button>
			</td>
			</tr>";
	}
	echo "<tr style='height: 40px; vertical-align: center'>
		<td colspan=3>
		</td>
		<td>
			<button type='submit' name='reset'>Clear</button>
			<br>
			<button type='button' onclick='refreshData()'>Refresh</button>
		</td>";
} else {
	echo "<tr style='height: 40px; vertical-align: center'>
		<td colspan=3>
			<center> Belum ada yang absen </center>
		</td>
		<td>
			<button type='button' onclick='refreshData()'>Refresh</button>
		</td>";
}

// Akhir tabel form
echo "</tr>
	</table>
	</form>";
?>
