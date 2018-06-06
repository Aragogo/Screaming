<!doctype html>
<?php
    $veza=mysqli_connect("localhost","root","","projekt");
    if(!$veza){
        die(mysqli_error($veza));
    }
    $s_s;
    $s_p;
    $p_s;
    $p_p;
    $mjesec;
    if(isset($_POST["stud_stud"])){
        $s_s=true;
    }else{
        $s_s=false;
    }
    if(isset($_POST["stud_prof"])){
        $s_p=true;
    }else{
        $s_p=false;
    }
    if(isset($_POST["prof_stud"])){
        $p_s=true;
    }else{
        $p_s=false;
    }
    if(isset($_POST["prof_prof"])){
        $p_p=true;
    }else{
        $p_p=false;
    }
    $upit1="SELECT vrijeme,poruka FROM student_studentu";
    $upit2="SELECT vrijeme,poruka FROM student_profesoru";
    $upit3="SELECT vrijeme,poruka FROM profesor_studentu";
    $upit4="SELECT vrijeme,poruka FROM profesor_profesoru";
    
    if(isset($_POST["po_mjesecu"])){
        $mjesec=$_POST["mjesec"];
        $upit1=$upit1." WHERE month(vrijeme) = '$mjesec'";
        $upit2=$upit2." WHERE month(vrijeme) = '$mjesec'";
        $upit3=$upit3." WHERE month(vrijeme) = '$mjesec'";
        $upit4=$upit4." WHERE month(vrijeme) = '$mjesec'";
    }

    $rezultat1=mysqli_query($veza,$upit1);
    if(!$rezultat1){
        echo $upit1;
        echo mysqli_error($veza);
    }
    $rezultat2=mysqli_query($veza,$upit2);
    $rezultat3=mysqli_query($veza,$upit3);
    $rezultat4=mysqli_query($veza,$upit4);
    $student_studentu=[];
    $student_profesoru=[];
    $profesor_studentu=[];
    $profesor_profesoru=[];
    while($red= mysqli_fetch_array($rezultat1)){
        array_push($student_studentu,$red[0]);
        array_push($student_studentu,$red[1]);
    }
    while($red2= mysqli_fetch_array($rezultat2)){
        array_push($student_profesoru,$red2[0]);
        array_push($student_profesoru,$red2[1]);
    }
    while($red3= mysqli_fetch_array($rezultat3)){
        array_push($profesor_studentu,$red3[0]);
        array_push($profesor_studentu,$red3[1]);
    }
    while($red4= mysqli_fetch_array($rezultat4)){
        array_push($profesor_profesoru,$red4[0]);
        array_push($profesor_profesoru,$red4[1]);
    }
    $js_st_st=json_encode($student_studentu);
    $js_st_pr=json_encode($student_profesoru);
    $js_pr_st=json_encode($profesor_studentu);
    $js_pr_pr=json_encode($profesor_profesoru);



?>
<html>
	<head>
        <div id="home"><a href="index.html">
         <img src="home.png" alt="home" style="width:50px;height:50px;border:0;">
         </a> </div>
         
		<title>STABLO DOBROTE</title>
		<meta charset="UTF-8">
        <meta name="author" content="Lucijana Brkanović, Lucija Tomac, Stella Maria Varga">
		<meta name="viewport" content="initial-scale=1.0">
        <link rel="icon" href="ikona.png" type="image/gif" sizes="16x16">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.10/p5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.10/addons/p5.dom.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.10/addons/p5.sound.min.js"></script>
        <script>
            var mjesec;
            var s_s;
            var s_p;
            var p_s;
            var p_p;
            var vrijednosti=[];
            var stud_stud;
            var stud_prof;
            var prof_stud;
            var prof_prof;
            var radiusx;
            var radiusy;
            var plodovi=[];
            var kvadrat=[];
            var rad=9;
            var legenda = [];
            var legenda_odabrana=false;
            var boje=["",[255, 255, 0],[255, 0, 0],[0, 130, 200],[255, 0, 191]];
            var kliknuto=false;
            var od_za=["","Student studentu.","Student profesoru.", "Profesor studentu.","Profesor profesoru."];
            
            function setup(){
                var canvas = createCanvas(window.innerWidth-15, 600);
                canvas.parent('placeholder');
                
                
                stablo();
                stud_stud = JSON.parse('<?php echo json_encode($student_studentu); ?>');
                stud_prof = JSON.parse('<?php echo json_encode($student_profesoru); ?>');
                prof_stud = JSON.parse('<?php echo json_encode($profesor_studentu); ?>');
                prof_prof = JSON.parse('<?php echo json_encode($profesor_profesoru); ?>');
                
                s_s=JSON.parse('<?php echo json_encode($s_s); ?>');
                s_p=JSON.parse('<?php echo json_encode($s_p); ?>');
                p_s=JSON.parse('<?php echo json_encode($p_s); ?>');
                p_p=JSON.parse('<?php echo json_encode($p_p); ?>');
                
                vrijednosti.push([s_s,1]);
                vrijednosti.push([s_p,2]);
                vrijednosti.push([p_s,3]);
                vrijednosti.push([p_p,4]);
                
                noFill();
                stroke(0);
                strokeWeight(3);
                radiusx= 500;
                radiusy= 430;
                
                for (var i=1;i<stud_stud.length;i+=2){
                    fill(255, 255, 0);
                    noStroke();
                    var kordice=koordinate();
                    ellipse(kordice[0],kordice[1],15,15);
                    plodovi.push([kordice[0],kordice[1],[stud_stud[i-1],stud_stud[i]],1,0]);
                }
                for (var i=1;i<stud_prof.length;i+=2){
                    fill(255, 0, 0);
                    noStroke();
                    var kordice=koordinate();
                    ellipse(kordice[0],kordice[1],15,15);
                    fill(255);
                    stroke(255);
                    plodovi.push([kordice[0],kordice[1],[stud_prof[i-1],stud_prof[i]],2,0]);
                }
                for (var i=1;i<prof_stud.length;i+=2){
                    fill(0, 130, 200);
                    noStroke();
                    var kordice=koordinate();
                    ellipse(kordice[0],kordice[1],15,15);
                    plodovi.push([kordice[0],kordice[1],[prof_stud[i-1],prof_stud[i]],3,0]);
                }
                for (var i=1;i<prof_prof.length;i+=2){
                    fill(255, 0, 191);
                    noStroke();
                    var kordice=koordinate();
                    ellipse(kordice[0],kordice[1],15,15); 
                    plodovi.push([kordice[0],kordice[1],[prof_prof[i-1],prof_prof[i]],4,0]);
                }
                
                provjeri_zadanost(vrijednosti);
                
            }
            
            
            function stablo(){
                background(154, 187, 218);
                var a = createVector(width / 2, height);
                var b = createVector(width / 2, height*0.6);
                stroke(83,53,10);
                strokeWeight(60);
                line(a.x, a.y, b.x, b.y);
                fill(0,26,0);
                noStroke();
                ellipse(width/2,height*0.355,width*0.4,height*0.7);
                var x=width*0.04;
                var y=height*0.6;
                
                fill(255, 255, 0);
                ellipse(x,y,15,15);
                legenda.push([x,y,1]);
                
                fill(255, 0, 0);
                ellipse(x,y+height*0.06,15,15);
                legenda.push([x,y+height*0.06,2]);
                
                fill(0, 130, 200);
                ellipse(x,y+height*0.12,15,15);
                legenda.push([x,y+height*0.12,3]);
                
                fill(255, 0, 191);
                ellipse(x,y+height*0.18,15,15);
                legenda.push([x,y+height*0.18,4]);
                
                fill(255);
                ellipse(x,y+height*0.24,15,15);
                legenda.push([x,y+height*0.24,5]);
                
                x+=15;
                fill(0);
                textSize(14);
                textStyle("Bold");
                textAlign("left");
                text("Student studentu",x,y+5);
                y+=height*0.06+5;
                text("Student profesoru",x,y);
                y+=height*0.06;
                text("Profesor studentu",x,y);
                y+=height*0.06;
                text("Profesor profesoru",x,y);
                y+=height*0.06;
                text("Sva dobra djela",x,y);
            }
            
            function crtaj_plodove(broj){
                if(broj){
                    for (var i=0;i<plodovi.length;i++){
                        if (broj==1&&(plodovi[i][3]==1)){
                            fill(255, 255, 0);
                            noStroke();
                            ellipse(plodovi[i][0],plodovi[i][1],15,15);
                        }else if(broj==2&&(plodovi[i][3]==2)){
                            fill(255, 0, 0);
                            noStroke();
                            ellipse(plodovi[i][0],plodovi[i][1],15,15);
                        }else if(broj==3&&(plodovi[i][3]==3)){
                            fill(0, 130, 200);
                            noStroke();
                            ellipse(plodovi[i][0],plodovi[i][1],15,15)
                        }else if(broj==4&&(plodovi[i][3]==4)){
                            fill(255, 0, 191);
                            noStroke();
                            ellipse(plodovi[i][0],plodovi[i][1],15,15);
                        }
                    }
                }else{
                    for (var i=0;i<plodovi.length;i++){
                        if (plodovi[i][3]==1){
                            fill(255, 255, 0);
                            noStroke();
                            ellipse(plodovi[i][0],plodovi[i][1],15,15);
                        }else if(plodovi[i][3]==2){
                            fill(255, 0, 0);
                            noStroke();
                            ellipse(plodovi[i][0],plodovi[i][1],15,15);
                        }else if(plodovi[i][3]==3){
                            fill(0, 130, 200);
                            noStroke();
                            ellipse(plodovi[i][0],plodovi[i][1],15,15)
                        }else if(plodovi[i][3]==4){
                            fill(255, 0, 191);
                            noStroke();
                            ellipse(plodovi[i][0],plodovi[i][1],15,15);
                        }
                    }
                }
            }
            
            function provjeri_zadanost(vrijednost){
                for (var i=0;i<vrijednost.length;i++){
                    if (vrijednost[i][0]==true){
                        stablo();
                        crtaj_plodove(vrijednost[i][1]);
                        legenda_odabrana=true;
                    }
                }
            }
            
            function kordx(){
                return width*0.3+(Math.floor(Math.random() * ((radiusx) - 1)));
            }
            
            function kordy(){
                return Math.floor(Math.random() * ((radiusy) - 1));;
            }
            
            var koordinate=function(){
                while(true){
                    this.x=kordx();
                    this.y=kordy();
                    if ((this.y<0.05*height)||(this.x<width*0.33)||(this.y>height*0.64)||(this.x>width*0.67)){
                        koordinate();
                    }else if((this.x>width*0.33 && this.x<width*0.37)&&((this.y>height*0.05 && this.y<height*0.17)||(this.y>height*0.55))){
                        koordinate();
                    }else if((this.x>width*0.6 && this.x<width*0.67)&&((this.y>height*0.05  && this.y<height*0.17 )||(this.y>height*0.53))){
                        koordinate();
                    }else if(!collision(this.x,this.y)){
                        koordinate();
                    }
                    else{
                        var x=this.x;
                        var y=this.y;
                        break;
                    }
                }
                return [x,y];
            }
            
            function collision(x,y){
                if(plodovi.length>0){
                    for (var i=0;i<plodovi.length;i++){
                        var dis=dist(plodovi[i][0],plodovi[i][1],x,y);
                        console.log(dis);
                        if(dis<=20){
                            return false;
                        }else{
                            return true;
                        }
                    }
                }else{
                    return true;
                }
            }
            
            function provjera(x,y){
                var d = Math.sqrt(((mouseX-x)*(mouseX-x))+((mouseY-y)+(mouseY-y)));
                return d<=15;
            }
            
            function mousePressed() {
                if(kvadrat.length>0 && kliknuto==true){
                    for(var i=0;i<kvadrat.length;i++){
                        var d = dist(kvadrat[i][0],kvadrat[i][1],mouseX,mouseY);
                        if ((d<=9)||(mouseX>kvadrat[i][0]-200 && mouseX<kvadrat[i][0]+200 && mouseY>kvadrat[i][1] && mouseY<kvadrat[i][1]+200)){
                            stablo();
                            if(legenda_odabrana){
                                crtaj_plodove(kvadrat[i][3]);
                            }else{
                                crtaj_plodove();
                            }
                            kliknuto=false;
                        }
                    }
                }
                
                for(var i=0;i<legenda.length;i++){
                    var d= dist(legenda[i][0],legenda[i][1],mouseX,mouseY);
                    if(d<9){
                        stablo();
                        if(legenda[i][2]!=5){
                            crtaj_plodove(legenda[i][2]);
                            legenda_odabrana=true;
                        }else if(legenda[i][2]==5){
                            legenda_odabrana=false;
                            crtaj_plodove();
                        }
                        break;
                    }
                }
                
                if (!kliknuto){
                    for (var i=0;i<plodovi.length;i++){
                        var d = dist(plodovi[i][0],plodovi[i][1],mouseX,mouseY);
                        if (d<=9){
                            plodovi[i][4]+=1;
                            kvadrat.push(plodovi[i]);

                            stroke(0);
                            strokeWeight(1);
                            fill(255);
                            rect(plodovi[i][0]-200,plodovi[i][1],400,200);
                            var pocetak_x=plodovi[i][0];
                            var pocetak_y=plodovi[i][1]+20;
                            textAlign("center");
                            textSize(14);
                            textFont("Arial");
                            fill(0);
                            text(od_za[plodovi[i][3]],pocetak_x,pocetak_y-2);
                            stroke(0);
                            strokeWeight(1);
                            line(pocetak_x-200,pocetak_y+5,pocetak_x+200,pocetak_y+5);
                            line(pocetak_x-200,pocetak_y+155,pocetak_x+200,pocetak_y+155);
                            fill(19, 21, 22);
                            textAlign("justify");
                            textSize(18);
                            text(plodovi[i][2][1],pocetak_x-200,pocetak_y+20,400,150);
                            fill(0);
                            textSize(13);
                            textAlign("center");
                            text("Datum: "+plodovi[i][2][0],pocetak_x,pocetak_y+170);
                            kliknuto=true;
                        }
                    }
                }
                
            }
                                 
            
        </script>
        <style>
            #placeholder{
                margin:0 auto;
                text-align: center;
            }
            #home{
                background-color: #9ABBDA;
                
            }
            
        </style>
	</head>

	<body>
        <div id="placeholder">   
        </div>
        
     
	</body>
</html>