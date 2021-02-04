<!DOCTYPE HTML>
<html>

<!--
I worked with this function without my boss knowing about it, even though I was told that further development had stopped, He was not so happy when he found out. 
But when I explained to him how easy the documentation work would be and how easy it would be for everyone else, he understood it very well and said good job. 
And my boss have learned that sometimes you need to develop a little bit more even the development has stopped.

Boss comment: ohh yehh i have learnd. i also learn to listen better to the suggestions. is it easy, no but i am learning.

-->
  <head>
    <link href="/Tools/CSS/ny-bruker.css" type="text/css" rel="stylesheet"/>
  </head>
  <body>
    <div id="top-nav">
      <?php include '/var/www/html/Tools/PHP/PHP-uni/nav-bar-uni.php'; ?>
      <!--
     <ul>
       <li><a href="http://10.12.3.26/">Hjem</a></li>
       <li><a href="http://senja.vgs.no">Hjemme Side</a></li>
       <li class="dropdown">
         <a href="javascript:void(0)" class="dropbtn">Grafer</a>
         <div class="dropdown-content">
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-01.html">LMTS-1</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-02.html">LMTS-2</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-03.html">LMTS-3</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-04.html">LMTS-4</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-05.html">LMTS-5</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-06.html">LMTS-6</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-07.html">LMTS-7</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-08.html">LMTS-8</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-09.html">LMTS-9</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-10.html">LMTS-10</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-11.html">LMTS-11</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-12.html">LMTS-12</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-13.html">LMTS-13</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-14.html">LMTS-14</a>
           <a href="http://10.12.3.26/Linker/Grafer/LMTS-15.html">LMTS-15</a>
         </div>
       </li>
       <li class="dropdown">
         <a href="javascript:void(0)" class="dropbtn">Info</a>
         <div class="dropdown-content">
           <a href="http://10.12.3.26/phpmyadmin">Data Base</a>
           <a href="/Linker/info/info.php">PHP Info</a>
           <a href="/Linker/info/apache2-info.html">Apache2 Info</a>
         </div>
       </li>
       <li class="dropdown">
         <a href="javascript:void(0)" class="dropbtn">Lab</a>
         <div class="dropdown-content">
            <a href="/Tools/Lab">Lab mappe</a>
            <a href="/Tools/ETC">ETC mappe</a>
          </div>
        </li>
        <li><a href="http://10.12.3.26/Linker/Make-new-user.html">Legg til ny enhet</a></li>
        <a href="https://www.tffk.no/">
          <img id="logo" src="http://10.12.3.26/Tools/media/logo_farge_web.svg" alt="TFFK-Logo">
        </a>
      </ul>
    </div>
    -->
    <div id="wrapper">
        <div id="send_data">
          <form method="post" action="/Tools/PHP/PHP-uni/Legge-til-ny.php">
          <!--
          <textarea name="newUsr" placeholder="Skriv inn Brukernavn"></textarea>
            <br>
          <textarea name="newUsrPasswd" placeholder="Skriv inn Passord"></textarea>
            <br>
          <textarea name="newDataBase" placeholder="Skriv inn Database"></textarea>
            <br>
          <textarea name="serialNumber" placeholder="Skriv inn Serienummer"></textarea>
            <br>
-->
          <input type="submit" name="newQuery" value="Opprett Ny Database">
        </form>
      </div>
      <!--
      Denne funksjonen kommer etterhvert.
      <div id="send_data_graf">
        <form method="post" action="/Tools/PHP/Scripts-PHP/TEST/Legge-til-ny.php">
          <textarea name="newUsr" placeholder="Skriv inn Brukernavn"></textarea>
            <br>
          <textarea name="newUsrPasswd" placeholder="Skriv inn Passord"></textarea>
            <br>
          <textarea name="newDataBase" placeholder="Skriv inn Database"></textarea>
            <br>
          <textarea name="serialNumber" placeholder="Skriv inn Serienummer"></textarea>
            <br>
          <input type="submit" name="newGraf" value="Opprett Graf">
        </form>
      </div>
      -->
    </body>
  </html>
