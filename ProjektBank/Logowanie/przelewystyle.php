<?php
header('Content-type: text/css; charset:UTF-8');
?>

/*... Srodkowe okno logowania */

#container {
	background-color: #ffffff;
	width: 400px;
	padding: 50px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 100px;
	box-shadow: 3px 3px 30px 5px rgba(204, 204, 204, 0.9);
	-webkit-box-shadow: 3px 3px 30px 5px rgba(204, 204, 204, 0.9);
	-moz-box-shadow: 3px 3px 30px 5px rgba(204, 204, 204, 0.9);
}

select{
    width: 300px;
	background-color: #36b03c;
	font-size: 20px;
	color: white;
	padding: 15px 10px;
	margin-top: 10px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
    letter-spacing: 2px;
    outline: none;
    margin-top: 20px;
}


select:hover { 
	background-color: #37b93d;
}

form{
    box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
	-webkit-box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
    -moz-box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
    border: 2px solid #a5cda5;
    background-color: #e9f3e9;
    color: #428c42;
    padding:20px
}

input[type=text] {
	width: 300px;
	background-color: #efefef;
	color: #666;
	border: 2px solid #ddd;
	border-radius: 5px;
	font-size: 20px;
	padding: 10px;
    box-sizing: border-box;
    outline: none;
    margin-top: 10px;
}
input[type=text]:focus{
    box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
	-webkit-box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
    -moz-box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
    border: 2px solid #a5cda5;
    background-color: #e9f3e9;
    color: #428c42;
} 
input[type=submit] {
	width: 300px;
	background-color: #36b03c;
	font-size: 20px;
	color: white;
	padding: 15px 10px;
	margin-top: 10px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
    letter-spacing: 2px;
    outline: none;
    margin-top: 20px;
}

input[type=submit]:focus{
    box-shadow: 0px 0px 15px 5px rgba(204, 204, 204, 0.9);
	-webkit-box-shadow: 0px 0px 15px 5px rgba(204, 204, 204, 0.9);
    -moz-box-shadow: 0px 0px 15px 5px rgba(204, 204, 204, 0.9);
}
input[type=submit]:hover { 
	background-color: #37b93d;
}