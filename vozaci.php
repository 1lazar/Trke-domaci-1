<?php include "konekcija.php"?>
<?php include "klase.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trke-vozaci</title>
    <script src="skripta.js"></script>
    <style>
        *{
            font-family: Montserrat;
        }
        body{
            background-image: url("../img/nissangtr.jpg");
            background-size: 100% 100%;
            background-attachment: fixed;
        }
        label{
            
            color: white;
        }
        table, td, th {
            border: 1px solid;
        }
        table {
            color: white;
            //background-color: #0a87e6;
            width: 100%;
            border-collapse: collapse;
        }
        td:hover{
            background-color: #0a87e6;
        }
        th:hover{
            background-color: #0a87e6;
        }
    </style>
</head>
<body>
    
    <!-- div za prikazSvih -->
    <div id="divZaPrikazSvih" style="display:none">
        <label for="rbPrikaz">Prikaži sve: </label>
        <a href="vozaci.php"><input type="submit" value="Potvrdi" name="rbPrikaz" id="rbPrikaz"></a>
   </div>


    <!-- forma za dodavanje novog vozaca -->
    <div id="FormaDodavanjeVozaca">
    <fieldset>
    <form action="" method="post">
    <label for="">Dodajte novog vozaca: </label><br><br>
    <!-- <p>Dodajte novog vozaca: </p> -->
        <label for="imeNovogVozaca">Ime vozaca: </label>
        <input type="text" name="imeNovogVozaca" id="imeNovogVozaca">
        <label for="prezimeNovogVozaca">Prezime vozaca: </label>
        <input type="text" name="prezimeNovogVozaca" id="prezimeNovogVozaca">
        <!-- padajuca lista svih auta -->
        <label for="sviAuto">Auto: </label>
        <select name="sviAuto" id="sviAuto">
            <?php 
                $rezultatUpita = Automobil::vratiSveAutomobile($link);
                while($auta = mysqli_fetch_array($rezultatUpita))
                {
                    $markaModel = $auta['marka'].' '.$auta['model'].' '.$auta['godinaProizvodnje'];
                ?>
                <option value="<?php echo $markaModel ?>"><?php echo $markaModel ?></option>
                <?php
                }
            ?>
        </select>
        
        <!-- dugme za brisanje knjige -->
        <!-- u slucaju da mora da se dodaju novi pisac ili zanr -->
        </label>
        <br><br>
        <label for="">Ukoliko auto ne postoji u padajućoj listi, dodajte ga ovde: </label><br><br>
        <!-- <p>Ukoliko pisac ne postoji u padajućoj listi, dodajte ga ovde: </p> -->
        <label for="markaNovogAuta">Marka auta: </label>
        <input type="text" name="markaNovogAuta" id="markaNovogAuta">
        <label for="modelNovogAuta">Model auta: </label>
        <input type="text" name="modelNovogAuta" id="modelNovogAuta">
        <label for="godProiz">Godina proizvodnje: </label>
        <input type="number" name="godProiz" id="godProiz">
        <br><br>
        
        <!-- dugme za dodavanje knjige -->
        <button type="submit" name="dodavanjeVozaca" onclick="proveriFormuZaVozaca()">Dodaj vozaca</button>
        <button type="submit" name="brisanje" onclick="proveriFormuZaBrisanjeVozaca()">Obriši vozaca</button>
    </form>
    <br>
    
    </fieldset>
    </div>
    <br>
    <!-- prikaz vozaca po kolima -->
    <div id="FormaZaPrikazVozacaPoKolima">
        <fieldset>
            <form action="" method="post">
                <label for="">Vidite koja kola  voze vozaci: </label><br><br>
                <label for="vozaci">Automobili: </label>
                <select name="vozaci" id="vozaci">
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
                <button type="submit" name="proveriAuto">Proveri</button>
            </form>
        </fieldset>
    </div>
    <br>
    <script>
        var blokovi = ["FormaDodavanjeVozaca","FormaZaPrikazVozacaPoKolima"];
    </script>
</body>
</html>
<?php
    //dodavanje vozaca
    if(isset($_POST['dodavanjeVozaca']))
    {
        $marka;
        $model;
        $godProiz;
        
        $povratniNiz = Automobil::iseciMarkaModel($_POST['sviAuto']);
        $marka = $povratniNiz['marka'];
        $model = $povratniNiz['model'];
        $godProiz = $povratniNiz['godinaProizvodnje'];
       
        if($_POST['markaNovogAuta'] != '' && $_POST['modelNovogAuta'] != '' &&  $_POST['godProiz'] != '')
        {
            $marka = $_POST['markaNovogAuta'];
            $model = $_POST['modelNovogAuta'];
            $godProiz = $_POST['godProiz'];
        }

        
        $auto = new Automobil($marka,$model,$godProiz);
        if(!$auto->postojiAuto($link))
            $auto->upisiUBazu($link);
        

        //dodaj novog vozaca u bazu
        $autoID = Automobil::vratiIdAuta($link,$marka,$model);
        if($_POST['imeNovogVozaca'] != '' && $_POST['prezimeNovogVozaca'] != '')
        {
            
            $ime = $_POST['imeNovogVozaca'];
            $prezime = $_POST['prezimeNovogVozaca'];
            $vozac = new Vozaci($ime,$prezime,$autoID);
            if(!$vozac->postojiVozac($link))
                $vozac->dodajUBazu($link);
        }


    }
    //BrisanjeVozaca
   if(isset($_POST['brisanje']))
   {
        $ime = $_POST['imeNovogVozaca'];
        $prezime = $_POST['prezimeNovogVozaca'];
        
        $marka = $_POST['markaNovogAuta'];
        $model = $_POST['modelNovogAuta']; 
        $autoID = Automobil::vratiIdAuta($link,$marka,$model);
        
        $auto = new Automobil($marka,$model,$autoID);
        
        $vozacZaBrisanje = new Vozaci($ime,$prezime,$auto);
        $vozacZaBrisanje->izbaciVozacaIzBaze($link);
   }


   //provera koji vozac sta vozi
    if(isset($_POST['proveriAuto']))
    {

        $auto = $_POST['vozaci'];
        $rezulUpita = Vozaci::vratiSveVozace($link);
        
        echo "<table border=2>";
        echo "<tr>";
            echo "<th>"; echo "Vozac"; echo "</th>";
            echo "<th>"; echo "Auto"; echo "</th>";
        echo "</tr>";
        $id = 0;
        $automobili = Automobil::vratiSveAutomobile($link);
        while($a=mysqli_fetch_array($automobili)){
            if($a['marka'].' '.$a['model'] == $auto){
                $id=$a['autoID'];
            }
        }
        while($vozac = mysqli_fetch_array($rezulUpita))
        {
            if($vozac['auto'] == $id)
            {
                echo "<tr>";
                    echo "<td>"; echo $vozac['ime'].' '.$vozac['prezime']; echo "</td>";
                    echo "<td>"; echo $auto; echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }
?>