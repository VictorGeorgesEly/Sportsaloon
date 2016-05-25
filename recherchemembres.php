<?php session_start(); ?>

<html>
	<head>
		<meta charset='utf-8'/>
		    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" href="stylesheet.css" />
		<title>Membres</title>
	</head>

	<body>


  <div class= "imagefondrecherchemembre">
  <?php include("header.php"); ?>


  		<h3> Membres</h3>
		</br></br>

		<div class="navbarresrecherchemembre">
      <div id="navbarrecherchemembre" >
        <ul>
          <li><a href=".html">Tous les membres</a></li>
          <li><a href=".html">Membres récemment connectés</a></li>
          <li><a href="Membres.html">rechercher un membre</a></li>
        </ul>
      </div>
      </div>


      <div class="recherchemembregeneral">
          <div class = "couleurtitrerecherche"> <span style="color:white"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;votre recherche   </span>
          </div>

       	<div class = "couleurrecherche">

          <div class = "ligne1membre">
            <div class="listemembre1">région :
    			     <input type = "text" placeholder="nom de la région" name = "nom de la région" />

  		   		</div>


            <div class="champsmembre2">Sport le plus pratiqué :
              <select name=age size=1>
                <option value="Football" selected>Football<option value="Rugby">Rugby<option value="Basketball">Basketball<option value="Handball">Handball
              </select>

            </div>
          </div>

          </br>
        <div class = "ligne2membre">
            <div class="champsmembre1">Tranche d'âge :
		           <select name=age size=1>
		           <option value="13-17" selected>13-17 ans<option value="18-25">18-25 ans<option value="25-39">25-39 ans
		           </select>
		        </div>


          <div class="checkbox">
            <form method="post" action="traitement.php">
              <input type="checkbox" name="nouveau membre" id="nouveau membre" /> <label for="nouveau membre">nouveau membre</label>
       		    <input type="checkbox" name="en ligne" id="en ligne" /> <label for="en ligne">en ligne</label></br>
   			   </form>
           </div>
			   </div>

          <div class="Recherchemembre">
 			 	          <input type="submit" value="lancer la recherche" ></code>
 			 	    </div>
        </div>



          <div class= "couleurmembrerecherche">
             </br>
             <div class= "photogrouperecherche">  <img src="IMG/imagegroupe.jpg"width="70" height="70"/> </div>
            	   <div class = "nommembrerecherche">   nom du membre </div>
                 <input type="submit" value="son profil" class="boutonvoirprofil" ></code>
                </br>
              </div>

          </div>




					 <?php include("footer.php"); ?>
 </div>
			 	</body>
			 </html>
