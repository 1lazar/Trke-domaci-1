<?php
  include "konekcija.php";
  include "klase.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Trke-automobili</title>
    <style>
        #unosimAutomobil{
            color: white;
        }
        label{
          color: white;
        }
        
    </style>
</head>
<body>
    
    <div id="unosimAutomobil">
    <fieldset>
      <form action="" name="unosAutomobila" method="post">
      <label for="">Dodajte novi automobil: </label><br><br>
        
        <label for="marka">Marka:</label><br>
        <input type="text" name="marka" id="marka" placeholder="Unesi marka"> <br><br>
        <label for="model">Model: </label><br>
        <input type="text" name="model" id="model" placeholder="Unesi model"> <br><br>
        <label for="godProizvodnje">Godina Proizvodnje: </label><br>
        <input type="text" name="godProizvodnje" id="godProizvodnje" placeholder="Unesi godinu proizvodnje"> <br>
        <br>
        <button type="submit" name="unesiAuto"onclick="proveriFormuZaUnosAuta()">Unesi u bazu</button>
        <br>
    </form>
    <br>
    
    </fieldset>
    </div>
    <br>

    
      <fieldset>
      <form action="" name="proveravanje" method="post">
      <label for="">Brisi: </label><br><br>
      
        <label for="prov">Automobil: </label>
        <select name="auto" id="auto">
                    <?php 
                        $rezultatUpita = Automobil::vratiSveAutomobile($link);
                        
                        while($auto = mysqli_fetch_array($rezultatUpita))
                        { 
                            $markaModel= $auto['marka'].' '.$auto['model'];
                        ?>
                            <option value="<?php echo $markaModel ?>"><?php echo $markaModel ?></option>
                        <?php
                        }
                    ?>
                </select>
        <button type="submit" name="brisanje" value="Obriši">Obriši</button>
      </form>
      <br>
      </fieldset>
      </div>
      <br> 

    <script>
    
    </script>
</body>
</html>
<?php

    
    if(isset($_POST['unesiAuto']))
    {
      if($_POST['marka'] !== "" && $_POST['model'] !== "" && $_POST['godProizvodnje'] !== "")
      {
          $automobil = new Automobil($_POST['marka'], $_POST['model'], $_POST['godProizvodnje']);
          
          if(!$automobil->postojiUBazi($link))
          $automobil->upisiUBazu($link);
          else
          echo "Citalac vec postoji u bazi!";
      }
      echo "zavrseno";
    }
     
   if(isset($_POST['brisanje']))
   {
      $auto = $_POST['auto'] ;
      $automobili = Automobil::vratiSveAutomobile($link);
    
      $marka;
      $model;
      $god;
      while($a=mysqli_fetch_array($automobili)){
        if($a['marka'].' '.$a['model'] == $auto){
            $id=$a['autoID'];
            $marka = $a['marka'];
            $model = $a['model'];
            $god = $a['godinaProizvodnje'];
        }
      }
      
      $autic = new Automobil($marka,$model,$god);
      $autic->izbaciAutaIzBaze($link);
      
   }
?>