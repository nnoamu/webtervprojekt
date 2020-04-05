<?php session_start(); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kezdőlap</title>
    <link rel="stylesheet" type="text/css" href="base.css">
    <!-- font import -->
    <link href="https://fonts.googleapis.com/css?family=Varela&display=swap" rel="stylesheet">
    <!-- icon import -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- jquery import -->
    <script src="jquery-3.4.1.min.js"></script>

</head>
<body>
<!-- nav-bar START -->

<header id="hedor">
    <img class="logo" src="pics/owotter.png" alt="thats an otter logo" style="width: 85px;height: 85px">
    <nav>
        <ul class="nav_links">
            <li class="activepage"><a href="index.php">Kezdőlap</a></li>
            <li><a href="szolgaltatasok.html">Szolgáltatások</a></li>
            <li><a href="adopt.html">Örökbefogadás</a></li>
            <li><a href="contact.html">Elérhetőség</a></li>
        </ul>
    </nav>
   	<?php if (isset($_SESSION["username"])) { 	 /* ha már be van jelentkezve a user… */ ?>

 		<button class="btn" onclick="kijelentkezes()">Kijelentkezés</button>
 	<?php } else {  /* ha még nincs bejelentkezve… */ ?>

 		<button class="btn" onclick="openNav()">Bejelentkezés</button>

 		<?php } ?>

 		


</header>
<!-- nav-bar END -->

<!-- SIDENAV -->
<div id="sideNav" class="sidenav">
    <a class="closebtn" onclick="closeNav()" style="cursor: pointer">&times;</a>
    <button class="reglogin" onclick="showlogin() ">Jelentkezz be</button>
    <br>

    <div class="loginformd" id="loginform">
        <form class="loginform" method="POST">

            <label for="felhnev">Felhasználónév:</label>
            <br>
            <input type="text" id="felhnev" name="felhnev">
            <br>
            <label for="jelszo">Jelszó:</label>
            <br>
            <input type="password" id="jelszo" name="jelszo">
            <br>
            <input type="submit" name="login" value="Bejelentkezés">
            <br>
        </form>
    </div>
    <p id="regp" style="font-weight: unset; font-size: 10px">-------------vagy ha még nem vagy regisztrált tagunk------------</p><br>

    <button class="reglogin" onclick="showReg() ">Regisztrálj</button>
    <br>
    <div class="regformd" id="regform" hidden>
        <form class="regform" action="index.php" method="POST">

            <label for="rfelhnev">Felhasználónév:</label><br>
            <input type="text" id="rfelhnev" name="rfelhnev"><br>

            <label for="teljesnev">Teljes név:</label><br>
            <input type="text" id="teljesnev" name="teljesnev"><br>

            <label for="email">E-mail cím:</label><br>
            <input type="email" id="email" name="email"><br>

            <label for="rvheart">Hány aranyos vidrának van hely a szívedben?</label><br>
            <input type="number" id="rvheart" name="rvheart"><br>

            <label for="rjelszo">Jelszó:</label><br>
            <input type="password" id="rjelszo" name="rjelszo"><br>

            <label for="rjelszoa">Jelszó mégegyszer:</label><br>
            <input type="password" id="rjelszoa" name="rjelszoa"><br>

            <input type="submit" name="regist"><br>

            <input type="checkbox" id="acceptcare" name="acceptcare">
            <p>A gomb megnyomásával nyilatkozol, hogy a vidrák házi körülmények között tartásáról mindent tudsz, így
                biztonságban,egészségben lesznek nálad a kis nyunyók.
                Ha nem vagy biztos a tudásodban, ajánlom <a href="https://pethelpful.com/exotic-pets/pet-otter">ezt</a>
                a cikket alapos átolvasásra.</p><br>


           
        </form>

     <?php

     	 //BEJELENTKEZÉS

     		$login = [];
     		$file = fopen("be.txt", "r");

     		while (($line = fgets($file)) !== false) {
     			$login[] = unserialize($line);
     		}

     		fclose($file);

     		if(isset($_POST["login"])) {
     			$felhnev = $_POST["felhnev"];
     			$jelszo = $_POST["jelszo"];

     			foreach ($login as $key) {
     				if ($key["username"] == $felhnev && $key["password"] == $jelszo) {


     					$_SESSION["username"] = $felhnev;
     					alert("Bejelentkeztél!");
     					header("Location: index.php");
     				}
     			}
     		}

     	 //BEJELENTKEZÉS END

         //REGISZTRÁCIÓ

     	  function alert($uzenet) {
   			 echo '<script type="text/javascript">alert("' . $uzenet . '")</script>'; 
		}

     	$tmp=[];

        if(isset($_POST["regist"])){

        	$file= fopen("be.txt","r");
			while(($line = fgets($file)) !== false){
				$tmp[] = unserialize($line);
			}

			

			fclose($file);
        	 

        	if($_POST["rfelhnev"] !== NULL ){
        		$rfelhnev = $_POST["rfelhnev"];
        	}else{
        		header("Refresh:0");
        		die(alert("A felhasználó nevet kötelező megadni!"));
        		
        	}

        	if($_POST["teljesnev"] !== NULL){
        		$teljesnev = $_POST["teljesnev"];
        	}else{
        		header("Refresh:0");
        		die(alert("A teljes nevet kötelező megadni!"));
        	}

        	if($_POST["email"] !== NULL){
        		$email = $_POST["email"];
        	}else{
        		header("Refresh:0");
        		die(alert("Az email-t kötelező megadni!"));
        	}

        	if($_POST["rvheart"] !== NULL){
        		$rvheart = $_POST["rvheart"];
        	}else{
        		header("Refresh:0");
        		die(alert("Vidrákat is kötelező megadni! S H A M E !!!!"));
        	}

        	if($_POST["rjelszo"] !== NULL){
        		$rjelszo = $_POST["rjelszo"];
        		$rjelszoa = $_POST["rjelszoa"];
        	}else{
        		header("Refresh:0");
        		die(alert("A jelszót kötelező megadni!"));
        	}

        	foreach ($tmp as $key) {
        		if($key["username"] === $rfelhnev){
        			header("Refresh:0");
        			die(alert("A felhasználó név már foglalt!"));
        		}

        		if($key["email"] === $email){
        			header("Refresh:0");
        			die(alert("Az email már foglalt!"));
        		}
        	}

        	if($rjelszo !== $rjelszoa){
        		header("Refresh:0");
        			die(alert("A két jelszó nem egyezik!"));
        	}

        	$tmp[] =["username" => $rfelhnev, "teljesnev"=> $teljesnev, "email" => $email, "rvheart" => $rvheart, "password" => $rjelszo];
        	alert("Sikeres regisztráció!");

        	

        	$file= fopen("be.txt","w");
			foreach ($tmp as $key) {
				fwrite($file, serialize($key) . "\n");
			}
			fclose($file);

			
        	

        }
        	//REGISZTRÁCIÓ END

    ?>

    </div>

</div>

<!-- SIDENAV END-->

<!-- tartalom START -->

<div class="content">
    <h1>Üdvözlünk a weblapunkon!</h1>

    <div class="rovidism">
        <div class="otterpic"><img src="pics/otter-1.jpg" alt="cuteotter"></div>
        <div class="ismszov">
            <h2>Szervezetünk célja</h2>
            A "We love you like no otter" a fogságban tartott vidrák megsegítése érdekében létrejött szervezet,
            amelyet Dr. K. Ruzor és Dr. N. Naomi professzionális tengerbiológusok alapítottak
            2020-ben a webtervezés beadandó érdekében. A szervezet célja, hogy a kis nyunyókat visszajuttassa az eredeti
            élőhelyükre, mivel egy páran úgy gondolták, hogy a vidrák otthon tartása jó ötlet lesz, viszont ez nem igaz.
            A vidrák kényes állatok, így egy átlag ember számára lehetetlen a megfelelő körülmények biztosítása.
        </div>
    </div>
</div>
<div class="eddigmentett">
    <div class="em1">Eddig megmentett vidrák száma:</div>
    <div class="em2">120</div>
</div>

    <div class="szolgaltatasok">
        <div class="sz1">
            <ul>
                <li> e</li>
                <li> e</li>
            </ul>
        </div>
        <div class="szkep"></div>
        <div class="sz3">
            <ul>
                <li> e</li>
                <li> e</li>
            </ul>
        </div>
    </div>


<!--tartalom END -->


<!-- footer START -->
<footer>
    <div class="footer_nav">
        <ul class="fnav_links">
            <li><a href="index.html">Kezdőlap</a></li>
            <li><a href="https://www.nationalgeographic.com/animals/mammals/group/otters/" target="_blank">Blog</a></li>
            <li><a href="adopt.html">Örökbefogadás</a></li>
            <li><a href="ourteam.html">Csapatunk</a></li>
        </ul>
    </div>

    <div class="footer_links">
        <ul>
            <li><a href="https://www.facebook.com/OtterLovers/posts/2094566290586405" target="_blank"><i
                    class="fab fa-facebook-f"></i></a></li>
            <li><a href="https://www.youtube.com/watch?v=1xf2VVB7boI" target="_blank"><i class="fab fa-youtube"></i></a>
            </li>
            <li>
                <a href="https://www.google.com/search?q=sleepy+otter&tbm=isch&hl=hu&ved=2ahUKEwjHwO6j2rjoAhUZkaQKHR4BCxYQBXoECAEQJg&biw=1583&bih=786#imgrc=HmjFGcwiEUIHEM"
                   target="_blank"><i class="fab fa-google"></i></a></li>
            <li><a href="https://www.instagram.com/cutest.otters/" target="_blank"><i class="fab fa-instagram"></i></a>
            </li>
            <li><a href="https://www.reddit.com/r/Otters/" target="_blank"><i class="fab fa-reddit"></i></a></li>
        </ul>


        <!--<div class="fnavp" > <a href="" target="_blank"><img src="facebook.svg"></a></div>
         <div class="fnavp" > <a href="" target="_blank"><img src="google.svg"></a></div>
         <div class="fnavp" > <a href="" target="_blank"><img src="instagram.svg"></a></div>
         <div class="fnavp" > <a href="" target="_blank"><img src="reddit.svg"></a></div>
         <div class="fnavp" > <a href="" target="_blank"><img src="youtube.svg"></a></div>
         <div class="fnavp" >  <a href="" target="_blank"><img src="twitter.svg"></a></div>-->

    </div>

    <div class="footer_szoveg">
        <div>OTTERS</div>
        <div>YES, WE LOVE OTTERS</div>
    </div>

    <div class="footer_cont">
        <div><img src="pics/contact_phone.svg" style="height: 20px; width: 20px" alt="phone"> (30) 7565042</div>
        <div><img src="pics/contact_email.svg" style="height: 20px; width: 20px" alt="email"> info@ottermail.uwu</div>
        <div><img src="pics/contact_home.svg" style="height: 20px; width: 20px" alt="ház">OTT ER. STR 15</div>

    </div>


</footer>
<div class="footer_copyright">
    ©OPY®ÁJT KURZI ÉS NEOMI
</div>

<!-- footer END -->
<!-- scriptek -->
<script>
    //sidenav script
    function openNav() {
        document.getElementById("sideNav").style.width = "300px";
    }

    function closeNav() {
        document.getElementById("sideNav").style.width = "0px";

    }

    function kijelentkezes() {

      $.ajax({
           type: "POST",
           url: 'ajax.php',
           data:{action:'call_this'},
           success:function(html) {
           	alert(html);
             location.reload();
           }

           

      } );
      
 }

    // Nav shadow script
    $(window).scroll(function () {
        if ($(window).scrollTop() > 1) {
            $('#hedor').addClass('headArnyek');
        } else {
            $('#hedor').removeClass('headArnyek');
        }
    });

    //reg/login script
    function showReg() {
        document.getElementById("loginform").style.display = "none";
        document.getElementById("regform").style.display = "inline";
        document.getElementById("regp").style.display = "none";
    }

    function showlogin() {
        document.getElementById("loginform").style.display = "inline";
        document.getElementById("regform").style.display = "none";
        document.getElementById("regp").style.display = "inline";

    }
</script>
</body>
</html>