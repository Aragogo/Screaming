<html>
<head>
     <meta charset="utf-8" />
    <title>Drvo</title>
    
    </head>
    <body>
 
            
    <?php
            
      if(isset($_POST['BPkreiraj'])){
          BPkreiraj();
        }
      elseif(isset($_POST['TBLkreiraj'])){
        TBLkreiraj();
        }
      elseif(isset($_POST['TBLunos'])){
            TBLunos();
            }
      elseif(isset($_POST['TBLispis'])){
            TBLispis();
            }
       elseif (isset($_POST['TBLbrisi']))
            {
                TBLbrisi();
            }
      
    #funkcije------------------------------------
      function BPkreiraj(){
          $server= "localhost";
          $korisnik= "root";
          $lozinka= "";
          $baza= "projekt";
          $db_veza= mysqli_connect($server, $korisnik, $lozinka);
          $upit= "CREATE DATABASE $baza;";
          $porukaOK= "<h2>Uspjesno kreirana baza</h2>. $baza";
          $porukaERROR="<h2>Dogodila se greska kod kreiranja baze: </h2>". mysqli_error($db_veza);

          if(mysqli_query($db_veza, $upit)){
              echo $porukaOK;
          }
          else{
              echo $porukaERROR;
          }
          mysqli_close($db_veza);
      }
        function TBLkreiraj(){
        $server= "localhost";
        $korisnik= "root";
        $lozinka= "";
        $baza= "kolokvij2";
        $db_veza= mysqli_connect($server, $korisnik, $lozinka, $baza);
        
        $upit= "CREATE TABLE Korisnik(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                ime VARCHAR(30) NOT NULL,
                prezime VARCHAR(30) NOT NULL,
                datum VARCHAR (30),
                stu_prof VARCHAR (30),
                dobrota VARCHAR (60),
                osoba VARCHAR (30),
                datum_registracije TIMESTAMP);";
        $porukaOK= "<h2>Uspjesno kreirana tablica</h2> Korisnik";
        $porukaERROR="<h2>Dogodila se greska kod kreiranja tablice: </h2>". mysqli_error($db_veza);

        if(mysqli_query($db_veza, $upit)){
            echo $porukaOK;
        }
        else{
            echo $porukaERROR;
        }
        mysqli_close($db_veza);
    }
        function TBLunos(){
        $server= "localhost";
        $korisnik= "root";
        $lozinka= "";
        $baza= "kolokvij2";
        $db_veza= mysqli_connect($server, $korisnik, $lozinka, $baza);

        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $datum=$_POST['datum'];
        $stu_prof=$_POST['stu_prof'];
        $dobrota=$_POST['dobrota'];
        $osoba=$_POST['osoba'];
          

        $upit= "INSERT INTO Korisnik(ime, prezime, datum, stu_prof, dobrota,osoba) VALUES ('$ime', '$prezime', '$datum', '$stu_prof','$dobrota','$osoba');";
        $porukaOK= "<h2>Uspjesno dodan korisnik u tablicu</h2> Korisnik";
        $porukaERROR="<h2>Dogodila se greska kod dodavanja korisnika u tablicu: </h2>". mysqli_error($db_veza);

        if(!mysqli_query($db_veza, $upit)){
            echo $porukaERROR;
        }
        else{
           $upit2="SELECT * FROM Korisnik;";
           $rezultat=mysqli_query($db_veza, $upit2);
           $br_zapisa=mysqli_num_rows($rezultat);
           if ($br_zapisa > 0){
               echo $porukaOK. "U tablici  je $br_zapisa zapisa";
                echo "<table><tr><th>ID</th><th>IME</th><th>PREZIME<th>DATUM ROĐENJA</th><th>STU_PROF</th><th>DOBROTA</th><th>OSOBA</th></tr>";
               while($red = mysqli_fetch_assoc($rezultat)){
                   echo "<tr>";
                   echo "<td>" . $red["id"]. "</td>";
                   echo "<td>" . $red["ime"]. "</td>";
                   echo "<td>" . $red["prezime"]. "</td>";
                   echo "<td>" . $red["datum"]. "</td>";
                   echo "<td>" . $red["stu_prof"]. "</td>";
                   echo "<td>" . $red["dobrota"]. "</td>";
                   echo "<td>" . $red["osoba"]. "</td>";
                   echo "</tr>";
               }
               echo "</table>";
           }
           elseif($br_zapisa < 1){
               echo "Prazna tablica...";
           }
           else{
               echo $porukaERROR;
           }
        }

        $kolacicIme2="ZadnjiPosjet";
        $vrijednost2=date("d.m.y.") . " u " . date("H:i:s");
        $istjece2=time()+60*60*24*30;

        if(isset($_COOKIE["ZadnjiPosjet"]))
        {
            $datum = $_COOKIE["ZadnjiPosjet"];
            echo "<br>Nismo se vidjeli od " . $datum;
        }
        setcookie($kolacicIme2, $vrijednost2, $istjece2);
            
    }
   function TBLispis(){
        $server= "localhost";
        $korisnik= "root";
        $lozinka= "";
        $baza= "kolokvij2";
        $db_veza= mysqli_connect($server, $korisnik, $lozinka, $baza);
        
        $upit= "SELECT * FROM Korisnik;";
        $porukaOK= "<h2>Korisnici u tablici Student su: </h2>";
        $porukaERROR="<h2>Nije moguce dohvatiti korisnika iz tablice </h2>". mysqli_error($db_veza);
        $rezultat= mysqli_query($db_veza, $upit);
        $br_zapisa= mysqli_num_rows($rezultat);
       
      if ($br_zapisa > 0){
               echo $porukaOK. "U tablici je $br_zapisa zapisa";
               echo "<table><tr><th>ID</th><th>IME</th><th>PREZIME<th>DATUM ROĐENJA</th><th>STU_PROF</th><th>DOBROTA</th><th>OSOBA</th></tr>";
               while($red = mysqli_fetch_assoc($rezultat)){
                   echo "<tr>";
                   echo "<td>" . $red["id"]. "</td>";
                   echo "<td>" . $red["ime"]. "</td>";
                   echo "<td>" . $red["prezime"]. "</td>";
                   echo "<td>" . $red["datum"]. "</td>";
                   echo "<td>" . $red["stu_prof"]. "</td>";
                   echo "<td>" . $red["dobrota"]. "</td>";
                   echo "<td>" . $red["osoba"]. "</td>";
                   echo "</tr>";
               }
               echo "</table>";
           }
           elseif($br_zapisa < 1){
               echo "Prazna tablica...";
           }
           else{
               echo $porukaERROR;
           }
        }
        
     function TBLbrisi()
            {
                $server = "localhost";
                $korisnik = "root";
                $lozinka = "";
                $baza="kolokvij2";
                $db_veza=mysqli_connect($server, $korisnik, $lozinka, $baza);
                $imeK = $_POST['ime'];
                $upit = "DELETE FROM Korisnik;";
                
                $porukaOK = "Korisnici izbrisani";
                $porukaERROR = "nemrem zbrisat podatke s tablice ".mysqli_error($db_veza);
                 
                if (!mysqli_query($db_veza,$upit))
                {
                    echo $porukaERROR;
                }
                else
                {
                    echo $porukaOK;
               
                }
                 
                
                 
               
                mysqli_close($db_veza);
            }
         
      ?>        
        

    
    </body>
</html>

