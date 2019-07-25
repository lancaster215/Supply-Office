	function w3_open() {
  	document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
  	document.getElementsByClassName("w3-overlay")[0].style.display = "block";
	}

	function w3_close() {
  	document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
  	document.getElementsByClassName("w3-overlay")[0].style.display = "none";
	}


function search_stock(){
	xmlhttp= new XMLHttpRequest();
	xmlhttp.open("GET","../php/fetch_data-stock.php?nm="+document.getElementById("search_text").value,false);
	xmlhttp.send(null);
	document.getElementById("result").innerHTML=xmlhttp.responseText;
	}
function search_person(){
	xmlhttp= new XMLHttpRequest();
	xmlhttp.open("GET","../php/fetch_data-person.php?nm="+document.getElementById("search_text").value,false);
	xmlhttp.send(null);
	document.getElementById("result").innerHTML=xmlhttp.responseText;
	}
/*function search_text(){
	xmlhttp= new XMLHttpRequest();	
	xmlhttp.open("GET","../php/fetch_data.php?nm="+document.getElementById("search_text1").value,false);
	xmlhttp.send(null);
	document.getElementById("result").innerHTML=xmlhttp.responseText;
	}
function get_id() {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET","../php/fetch_data.php?sid="+document.getElementId('perid').value,false );
	xmlhttp.send(null);
}*/


function valid_person(){
	xmlhttp= new XMLHttpRequest();
	xmlhttp.open("GET","../php/valid_data-person.php?xm="+document.getElementById("person_name").value,false);
	xmlhttp.send(null);
	document.getElementById("validate").innerHTML=xmlhttp.responseText;
	}

function valid_cat(){
	xmlhttp= new XMLHttpRequest();
	xmlhttp.open("GET","../php/valid_data-cat.php?cm="+document.getElementById("cat_name").value,false);
	xmlhttp.send(null);
	document.getElementById("validcat").innerHTML=xmlhttp.responseText;
	}

function valid_person1() {
	var x = document.forms["myForm"]["person_name"].value;
    if (x == null || x == "") {
        alert("Name must be filled out!");
        return false;
    	}
	}

function valid_cat1() {
	var x = document.forms["catForm"]["cat_name"].value;
    if (x == null || x == "") {
        alert("Category name must be filled out!");
        return false;
    	}
	}




/*
$(document).ready(function(){
	var flag = 0;
	$.ajax ({
		type: "GET",
		url: "../php/load_more.php",
		data: {
		'offset': 0, 
		'limit': 20
		},
		success: function(data){
			$('tbody').append(data);
			flag += 20;
		}
	});

	$(window).scroll(function(){
		if($(window).scrollTop() >= ($(document).height() - $(window).height())){
			$.ajax ({
				type: "GET",
				url: "../php/load_more.php",
				data: {'offset': flag, 'limit': 20},
				success: function(data){
					$('tbody').append(data);
					flag += 20;
				}
			});
		}
	});
});

*/



