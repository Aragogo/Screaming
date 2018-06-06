<?php
    $bravo="Uspješno. Pričekajte...";
    $uspjeh=true;
    $veza=mysqli_connect("localhost","root","","projekt");
    if(!$veza){
        die(mysqli_error($veza));
    }
    if((isset($_POST["vi_ste"]))&&(isset($_POST["saljete"]))){
        if(($_POST["vi_ste"]=="student")&&($_POST["saljete"]=="studentu")){
            $poruka=$_POST["poruka"];
            $unos="INSERT INTO student_studentu (poruka) VALUES ('$poruka')";
            mysqli_query($veza,$unos);
            echo $bravo;
        }elseif(($_POST["vi_ste"]=="student")&&($_POST["saljete"]=="profesoru")){
            $poruka=$_POST["poruka"];
            $unos="INSERT INTO student_profesoru (poruka) VALUES ('$poruka')";
            mysqli_query($veza,$unos);
            echo $bravo;
        }elseif(($_POST["vi_ste"]=="profesor")&&($_POST["saljete"]=="studentu")){
            $poruka=$_POST["poruka"];
            $unos="INSERT INTO profesor_studentu (poruka) VALUES ('$poruka')";
            mysqli_query($veza,$unos);
            echo $bravo;
        }elseif(($_POST["vi_ste"]=="profesor")&&($_POST["saljete"]=="profesoru")){
            $poruka=$_POST["poruka"];
            $unos="INSERT INTO profesor_profesoru (poruka) VALUES ('$poruka')";
            mysqli_query($veza,$unos);
            echo $bravo;
        }
    }else{
        echo "Niste označili potrebne radio gumbe.";
        echo "<button onclick='history.go(-1)'>Natrag</button>";
        $uspjeh=false;
    }
    if($uspjeh){
        header('Refresh: 2; URL=stablo.php');
    }
      
      
?>