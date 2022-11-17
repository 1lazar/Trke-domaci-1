<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Trke</title>
    <style>
      a{
        text-decoration: none;
        color: black;
      }
    </style>
</head>
<body>
    
    <h2>AUTOMOBILI</h2>
    <button type="submit" id="dugme1" class="button button1" name="submit">Info o automobilima</button>
    <button type="submit" id="dugme2" class="button button1" name="submit">Info o vozacima</button>
    <button type="submit" name="skloni" id="skloni" class="button button1" onclick="skloniDiv('text')">Skloni tekst</button>
    
    
    <button type="submit" id="dugme3" class="button button1" name="submit">Filmovi</button>
    <button type="submit" name="skloniPocasne" id="skloniPocasne" class="button button1" onclick="skloniDiv('filmovi')">Skloni filmove</button>

    <button type="submit" id="dugme4" class="button button1" name="submit"><a href="automobili.php" target="_blank" style="text-decoration: none; color: black; ">Automobili</a></button>
    <button type="submit" id="dugme5" class="button button1" name="submit"><a href="vozaci.php" target="_blank">Vozaci</a></button>

    <br><br><br><br>
    <div id="text" style="background-color: white"></div>
    <div id="filmovi"></div>
    <script>
    //primena AJAXA 1

    //namestio sam da se tekst iz fajla ucitava pritiskom na dugme
    document.getElementById("dugme1").addEventListener("click", ucitajTekst1);

    //funkcija za ucitavanje teksta
    function ucitajTekst1() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "tekst/text.txt", true);

        xhr.onload = function () {
            if (this.status == 200) {
            document.getElementById("text").innerHTML = this.responseText; //ispisi taj tekst na stranici
            }
        };

      xhr.send();
    }

    function skloniDiv(div) {
      document.getElementById(div).innerHTML = "";
    }
    //primena AJAXA 2

    //namestio sam da se tekst iz fajla ucitava pritiskom na dugme
    document.getElementById("dugme2").addEventListener("click", ucitajTekst2);

    //funkcija za ucitavanje teksta
    function ucitajTekst2() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "tekst/vozaci.txt", true);

        xhr.onload = function () {
            if (this.status == 200) {
            document.getElementById("text").innerHTML = this.responseText; //ispisi taj tekst na stranici
            }
        };

      xhr.send();
    }

    //primena AJAXA 3

    //namestio sam da se niz filmova iz json fajla ucita pritiskom na dugme
    document.getElementById("dugme3").addEventListener("click", ucitajFilmove);
    
    //funkcija za ucitavanje filmova
    function ucitajFilmove() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "filmovi.json", true);

        xhr.onload = function () {
          if (this.status == 200) {
            var filmovi = JSON.parse(this.responseText); //funkcija koja je potrebna kad radis sa JSON objektom,
            //da bi mogao da ga parsiras niz objekata u ovom slucaju, pa da pristupas poljima dot operatorom

            var output = "";

            //prolazim kroz niz objekata 
            for (var i in filmovi) {
              output +="<ul>"+"<li>Broj: " +filmovi[i].broj +" </li>" +"<li>Ime filma: " +filmovi[i].ime +" </li>" +"</ul>";
            }

            document.getElementById("filmovi").innerHTML = output;
          }
        };

        xhr.send();
      }
   

    </script>
</body>
</html>