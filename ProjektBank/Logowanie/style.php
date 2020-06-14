<?php
header('Content-type: text/css; charset:UTF-8');
?>

body{
    font-size: 20px;
    margin-top:2%;
    width:100%
    margin-left:0;
    margin-right:0;
    height: 100%;
    margin-bottom: 0;
    
}
.content{
    min-height: 100%;

  /* Equal to height of footer */
  /* But also accounting for potential margin-bottom of last child */
  margin-bottom: -50px;
}
.footer,
.push {
  height: 50px;
}

.szerokosc{
    width:1140px;
    text-align: center;
    margin-left:auto;
    margin-right:auto;
}

/*...Blok Lewy...*/

.lewy{
    float:left;
    width: 250px;
    height: 700px;
    margin-top: 2%;
}

#goraLewy{
    
    height:45px;
    width:250px;
    background-color: wheat;
    text-align: center;
    font-weight: 700;
    padding-top:25px;
    padding-bottom:2px;
    

    box-shadow: 3px 3px 30px 5px rgba(19, 16, 16, 0.9);
	-webkit-box-shadow: 3px 3px 30px 5px (19, 16, 16, 0.9);
    -moz-box-shadow: 3px 3px 30px 5px (19, 16, 16, 0.9);
    
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    border-bottom-left-radius: 20px;
	border-bottom-right-radius: 20px;
    
    
}
.przerwa{
    height:50px;
}
#srodekLewy{
    
    height:350px;
    width:250px;
    border-top-left-radius: 50px;
    border-top-right-radius: 100px;
    border-bottom-left-radius: 60px;
    border-bottom-right-radius: 60px;
    
    box-shadow: 3px 3px 30px 5px rgba(71, 10, 10, 0.9);
    -webkit-box-shadow: 3px 3px 30px 5px (71, 10, 10, 0.9);
    -moz-box-shadow: 3px 3px 30px 5px (71, 10, 10, 0.9);
    
}
#logo{
    text-align:left;
}
#logo img{
    float:left;
    height: auto;
    width:186px
}
#kontakt{
    text-align:left;
}

img {
    border-top-left-radius: 50px;
    border-top-right-radius: 100px;
    border-bottom-left-radius: 70px;
	border-bottom-right-radius: 70px;
    width: 100%;
    height: auto;
    
}
#dolLewy{
    
    height:130px;
    width:250px;
    background-color: wheat;

    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    border-bottom-left-radius: 70px;
	border-bottom-right-radius: 70px;
    
    box-shadow: 3px 3px 30px 5px rgba(19, 16, 16, 0.9);
	-webkit-box-shadow: 3px 3px 30px 5px (19, 16, 16, 0.9);
    -moz-box-shadow: 3px 3px 30px 5px (19, 16, 16, 0.9);
}

/*...KONIEC - Blok Lewy...*/


/*...Blok Środkowy...*/

.centrum{
    float:left;
}
#srodekDolny{

    font-size: 12px;
    width: 500px;
    height: 90px;
    margin: 40px;
    background-color: wheat;
    padding-left:10px;
    padding-right:10px;
}
#srodekDolny h5{
    padding-top:5px;
    color: red; 
    font-size: 12px; 
    text-align: left; 
    font-weight: 700;

}
a:link {
  color: green;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: pink;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: red;
  background-color: transparent;
  text-decoration: underline;
}
a:active {
  color: yellow;
  background-color: transparent;
  text-decoration: underline;
  
}
.glownyPanel{
    border:10px solid black;
    
    padding: 20px;

    width: 500px;
    height: 300px;
    margin: 40px;
    
}

/*...KONIEC - Blok Środkowy...*/


/*...Blok Prawy...*/


.prawy{
    margin-top: 2%;
    float:left;
    width: 250px;
    height: 600px;
    padding-bottom:145px;
    background-image: url(../pieniadz.jpg);

    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    border-bottom-left-radius: 70px;
    border-bottom-right-radius: 70px;

    overflow: hidden;
    
     
    box-shadow: 3px 3px 30px 5px rgba(19, 16, 16, 0.9);
	-webkit-box-shadow: 3px 3px 30px 5px (19, 16, 16, 0.9);
    -moz-box-shadow: 3px 3px 30px 5px (19, 16, 16, 0.9);
}

/*...KONIEC - Blok Prawy...*/

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

input[type=text],
input[type=password] {
	width: 300px;
	background-color: #efefef;
	color: #666;
	border: 2px solid #ddd;
	border-radius: 5px;
	font-size: 20px;
	padding: 10px;
    box-sizing: border-box;
    outline: none;
    margin-bottom: 10px;
}
input[type=text]:focus,
input[type=password]:focus{
    box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
	-webkit-box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
    -moz-box-shadow: 0px 0px 10px 2px rgba(204, 204, 204, 0.9);
    border: 2px solid #a5cda5;
    background-color: #e9f3e9;
    color: #428c42;
} 
input[type=submit] {
	width: 300px;
	background-color: grey;
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
    background-color: #3a3b45;
	box-shadow: 0px 0px 15px 5px rgba(236, 70, 70, 1);
	-webkit-box-shadow: 0px 0px 15px 5px rgba(236, 70, 70, 1);
    -moz-box-shadow: 0px 0px 15px 5px rgba(236, 70, 70, 1);
}

/*...Koniec środkowego okna logowania */


.info{
    
    clear:both;
	border-top:1px solid white;
    margin-left: auto;
    margin-right: auto;
	text-align: center;
	color: wheat;
	background-color: black;
    padding-top: 15px;
    padding-bottom: 15px;
    position: absolute;
    bottom: 0;
    left:0;
    width:100%;
    
}
/*...wyśrodkowanie recaptchy...*/
.text-xs-center {
        text-align: center;
    }

    .g-recaptcha {
        display: inline-block;
    }
    