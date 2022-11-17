<?php
    class Automobil
    {
        private $id;
        private $marka;
        private $model;
        private $godProizvodnje;

        public function __construct($marka, $model, $godProizvodnje)
        {
            $this->marka = $marka;
            $this->model = $model;
            $this->godProizvodnje = $godProizvodnje;
        } 
        public function vratiID($auto)
        {
            
            return $this->id;
        }

        static function iseciMarkaModel($string)
        {
            $niz = explode(" ", $string);
            $povratniNiz = ['marka' => $niz[0], 'model' => $niz[1],'godinaProizvodnje' =>$niz[2]];
            return $povratniNiz;
        }

        //upisivanje auta u bazu
        function upisiUBazu($baza)
        {
            $sqlUpit = "INSERT INTO automobili(marka, model, godinaProizvodnje) VALUES('$this->marka', '$this->model', '$this->godProizvodnje')";
            $rez = mysqli_query($baza, $sqlUpit);
            if($rez)
                echo "Čitalac je uspešno ubačen u bazu!".'<br>';
            else
                echo "Došlo je do greške prilikom ubacivanja čitaoca!".'<br>'; 
        }

        //da li citalac postoji u bazi
        function postojiUBazi($baza)
        {
            $rez = self::vratiSveAutomobile($baza);
            while($auto = mysqli_fetch_array($rez))
            {
                if($auto['marka'] == $this->marka &&  $auto['model'] == $this->model)
                    return true;
            }
        
            return false;
        }
        
        //vracam rezultat select * upita, jer ga imam na dosta mesta
        static function vratiSveAutomobile($baza)
        {
            $sql = "SELECT * FROM automobili";
            $rez = mysqli_query($baza, $sql);
            return $rez;
        }

        function postojiAuto($baza)
        {
            $rez = self::vratiSveAutomobile($baza);
            while($auto = mysqli_fetch_array($rez))
            {
                if($auto['marka'] == $this->marka && $auto['model'] == $this->model)
                {
                    echo "Taj auto vec postoji u bazi";
                    return true;
                }
            }
            return false;
        }

        public static function vratiIdAuta($baza, $marka, $model)
        {
            $rezultatUpita = self::vratiSveAutomobile($baza);
            while($auto = mysqli_fetch_array($rezultatUpita))
            {
            if($auto['marka'] == $marka && $auto['model'] == $model)
                return $auto['autoID'];
            }
            return false;
        }

        //izbacivanje knjige iz baze
        function izbaciAutaIzBaze($baza)
        {
            echo $this->model;
            $sqlUpit = "DELETE FROM automobili WHERE marka == '$this->marka' AND model == '$this->model' AND godinaProizvodnje = '$this->godProizvodnje'";
            $rez = mysqli_query($baza, $sqlUpit);
            
            if($rez)
                echo "Auto je uspešno obrisan iz baze!".'<br>';
            else  
                echo "Došlo je do greške prilikom brisanje auta iz baze!".'<br>';
        }

    }

    class Vozaci{
        private $id;
        private $ime;
        private $prezime;
        private $auto;

        public function __construct($ime,$prezime,$auto)
        {
            $this->ime = $ime;
            $this->prezime = $prezime;
            $this->auto = $auto;
        }

        static function vratiSveVozace($baza)
        {
            $sqlUpit = "SELECT * FROM vozaci";
            $rez = mysqli_query($baza, $sqlUpit);
            return $rez;
        }

        //dodavanje knjige u bazu
        function dodajUBazu($baza)
        {
            $sqlUpit = "INSERT INTO vozaci(ime,prezime, auto) VALUES('$this->ime', '$this->prezime', '$this->auto')";
            $rezultatUpita = mysqli_query($baza, $sqlUpit);
            if($rezultatUpita)
                echo "Vozac je uspešno dodat u bazu!".'<br>';
            else
                echo "Došlo je do greške prilikom dodavanja vozaca!".'<br>';
        }

        //izbacivanje knjige iz baze
        function izbaciVozacaIzBaze($baza)
        {
            $sqlUpit = "DELETE FROM vozaci WHERE ime = '$this->ime' AND prezime = '$this->prezime'";
            $rez = mysqli_query($baza, $sqlUpit);
            if($rez)
                echo "Vozac je uspešno obrisan iz baze!".'<br>';
            else  
                echo "Došlo je do greške prilikom brisanje vozaca iz baze!".'<br>';
        }

        function postojiVozac($baza)
        {
            $rez = self::vratiSveVozace($baza);
            while($vozaci = mysqli_fetch_array($rez))
            {
                if($vozaci['ime'] == $this->ime && $vozaci['prezime'] == $this->prezime)
                {
                    echo "Unet je taj vozac";
                    return true;
                }
                
            }
            return false;
        }
        static function iseciImePrezime($string)
        {
            $niz = explode(" ", $string);
            $povratniNiz = ['ime' => $niz[0], 'prezime' => $niz[1]];
            return $povratniNiz;
        }

    }
?>