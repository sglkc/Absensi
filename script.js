// Variabel tema
var theme = [
	["linear-gradient(#1f3947, #231f47)",
	"linear-gradient(#70A5C2, #7A70C2)"], // body background
	["#D9D9D9FF", "#000000FF"], // body text
	["#5663757F" , "#707AC27F"], // form background
	["#5663757F", "#707AC27F"], // list background
	["#566375FF", "#707AC2FF"], // table hover
	["#B38F00FF", "#000"], // cell hover
	["#FFCD00FF", "#FFFB00FF"], // button text
	["#FFFFFF7F", "#000000FF"] // footer text
	];
var themeNum = 0;

// Variabel sorting
var sortArray = [true, false, false];

// AJAX
function refreshData(){
	var div = document.getElementById("list");
	var xml = new XMLHttpRequest();

	xml.onreadystatechange = function (){
		if (xml.readyState == XMLHttpRequest.DONE){
			div.innerHTML = xml.responseText;
		} else {
			div.innerHTML = "Error.";
		}
	}

	xml.open("POST", "db.php", true);
	xml.send();
}

// Sorting tabel, original w3school
function sortTable(num) {
	var table, rows, switching, i, x, y, ascend, shouldSwitch;
	table = document.getElementById("tblList");
	switching = true;

	if (sortArray[num]) {
		sortArray[num] = false;
		ascend = false;
	} else {
		sortArray[num] = true;
		ascend = true;
	}

	while (switching) {
		switching = false;
		rows = table.rows;

		for (i = 1; i < (rows.length - 2); i++) {
			shouldSwitch = false;
			x = rows[i].getElementsByTagName("TD")[num];
			y = rows[i + 1].getElementsByTagName("TD")[num];
			if (ascend) {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			} else {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()){
					shouldSwitch = true;
					break;
				}
			}
		}
		if (shouldSwitch) {
			rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			switching = true;
		}
	}
	sortText(num);
}

// Sort dengan teks
function sortText(num) {
	var text = document.getElementsByClassName("sort")[num];
	var inner;

	switch(num){
		case 0:	inner = "Waktu "; break;
		case 1:	inner = "Kelas "; break;
		case 2:	inner = "Nama "; break;
	}

	if (sortArray[num]) {
		text.innerHTML = inner + " <img src='img/arrow-down.png'>";
	} else {
		text.innerHTML = inner + " <img src='img/arrow-up.png'>";
	}
}

// Cari kata sama dari isi tabel
function matchRow(text) {
	text = text.toLowerCase();
	var table = document.getElementById("tblList");
	var matches = [];

	for (let i = 1; i < table.rows.length - 1; i++) {
		for (let j = 1; j <= 2; j++) {
			var content = table.rows[i].cells[j].innerText.toLowerCase();
			if (content.includes(text)) {
				matches[matches.length] = i;
			}
		}
	}

	return matches;
}

/* Hapus baris dengan kata sama
function hideRow(array) {
	var table = document.getElementById("tblList");
	array.reverse();

	for (var val of array) {
		table.deleteRow(val);
	}
}	*/

// Hanya tampilkan baris dengan kata sama
function filterRow(array) {
	if (array == []) { return; }

	var table = document.getElementById("tblList");
	array.reverse();

	for (let i = table.rows.length - 2; i > 0; i--) {
		if (array.includes(i)) {
			continue;
		}
		table.deleteRow(i);
	}
}

// Toggle tema
function toggleTheme() {
	themeNum = themeNum ? 0 : 1;

	var html = document.getElementsByTagName("html")[0];
	var form = document.getElementById("form");
	var list = document.getElementById("list");
	var button = document.getElementsByTagName("button");
	var p = document.getElementsByTagName("p");

	html.style.background = theme[0][themeNum];
	html.style.color = theme[1][themeNum];
	form.style.backgroundColor = theme[2][themeNum];
	list.style.backgroundColor = theme[3][themeNum];
	// TODO: table
	// TODO: cell
	for (let i = 0; i < button.length; i++) {
		button[i].style.color = theme[6][themeNum];
	}
	for (let i = 0; i < p.length; i++) {
		p[i].style.color = theme[7][themeNum];
	}
}

// Hapus TKJ & RPL dikelas 13
function checkClVal() {
	var kelas = document.getElementsByName("kelas")[0];
	var jurusan = document.getElementsByName("jurusan")[0];
	var options = jurusan.getElementsByTagName("option");
	
	if (kelas.value == "13") {
		is13 = true;
		jurusan.value = "AK 1";
	}	else { is13 = false; }

	for (let i = 7; i < options.length; i++) {
		options[i].hidden = is13;
	}
}
