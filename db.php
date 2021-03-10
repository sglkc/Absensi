<?php
include 'mysql.php';

// Ambil data dari tabel database
$select = "SELECT * FROM $dbTable";
$table = $mysqli->query($select);

// Deklarasi
$empty = false;
$eRow = "<td></td>"; // Baris kosong
$button = "<button type='button' class='sort' onclick='sortTable"; // Button header tabel
$sortTime = "$button(0)'><img src='img/arrow.png' style='transform: scaleY(-1)'></button>";
$sortClass = "$button(1)'><img src='img/stripe.png'></button>";
$sortName = "$button(2)'><img src='img/stripe.png'></button>";
$sortRow = "<td class='sort' onclick='sortTable";
$clearBtn = "<button type='submit' name='reset'>Clear</button>"; // Button Clear
$refreshBtn = "<button type='button' onclick='getData()'>Refresh</button>"; // Button Refresh

// Membuat tabel form
echo "<form action='index.php' method='POST'>";
echo "<table id='tblList'><tr id='header'>";
echo $sortRow."(0)'>Waktu <img src='img/arrow-down.png'</td>";
echo $sortRow."(1)'>Kelas <img src='img/stripe.png'></td>";
echo $sortRow."(2)'>Nama <img src='img/stripe.png'></td>";
echo "<td>Action</td></tr>";

// Periksa data dari database
if (mysqli_num_rows($table) > 0){
	while($row = mysqli_fetch_assoc($table)){

		// Variabel dari setiap data
		$nama = ucwords($row['nama']); // Huruf awal kapital
		$time = strftime("(%d-%m-%Y) %H:%M:%S", $row['time']);
		$kelas = $row['kelas']." ".$row['jurusan'];

		// Buat baris baru
		echo "<tr>";
		echo "<td>".$time."</td>";
		echo "<td>".$kelas."</td>";
		echo "<td>".$nama." </td>";
		echo "<td><button type='submit' name='del' value='".$row['id']."'>Delete</button>"; // Button Hapus
		echo "</td></tr>";
	}
} else {
	// Variabel kosong jika tidak ada data
	$empty = true;
	$sortTime = "";
	$sortClass = "";
	$sortName = "";
	$clearBtn = "";
}

echo "<tr style='height: 40px; vertical-align: center'>";

// Baris bawah, cek jika data kosong
if ($empty) {
	echo "<td>Belum ada yang absen.</td>".$eRow.$eRow;
	echo "<td>".$refreshBtn."</td>";
} else {
	echo $eRow.$eRow.$eRow."<td>".$clearBtn."<br>".$refreshBtn."</td>";
}

// Akhir tabel form
echo "</tr></table></form>";
?>
