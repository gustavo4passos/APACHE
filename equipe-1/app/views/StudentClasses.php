<?php
  require_once("../helpers/SessionStarter.php");
  require_once("../helpers/Retrieve.php");
  SessionStarter::start();;

  if(!isset($_SESSION['username']) || empty($_SESSION['username']))
  {
    header("Location: ../views/StudentLogin.php");
    exit;
  }
 ?>

 <!DOCTYPE HTML>
 <html>
   <head>
       <meta name="viewport" content="width=device-width">
     <link rel="stylesheet" type="text/css" href="../assets/css/styleAdmin.css">
     <title>Página do Estudante</title>
   </head>
   <body>
   <header>
     <nav class="menu">
       <ul>
         <li><a href="StudentHomepage.php">Home</a></li>
         <li><a href="StudentClassEnrolling.php">Disciplinas</a></li>
         <li><a href="#">Cursos</a></li>
         <li><a href="#">Informações Pessoais</a></li>
         <li><a href="../helpers/StudentLogout.php">Logout</a></li>
       </ul>
     </nav>
   </header>
     <section class="inicio_department">
       <h1> Disciplinas </h1>
       <table>
         <tr>
           <th> Nome </th>
           <th> Codigo </th>
           <th> Professor </th>
         </tr>
         <?php
          $currentClasses = Retrieve::select_from_where("class_has_student", "student_user_id", $_SESSION['id']);
          if(empty($currentClasses))
          {
            ?>
            <tr>
              <td class="enroll-link" colspan="3" style="text-align:center"> <br> Você não está matriculado em nenhuma disciplina <br> <a href="StudentClassEnrolling.php"> (Matricular-se agora) <br> </a></td>
            </tr>
          </table>
            <?php
          }
          else
          {
              for($i = 0; $i < sizeof($currentClasses); $i++)
              {
                $currentClass = Retrieve::select_from_where("class", "id", $currentClasses[$i]['class_id']);
                $currentSubject = Retrieve::select_from_where("subject", "id", $currentClass[0]['subject_id']);
                $currentProfessor = Retrieve::select_from_id_assoc('professor', $currentClass[0]['professor_id']);

                ?>
                <tr>
                  <td> <?= $currentSubject[0]['name']; ?> </td>
                  <td> <?= $currentClass[0]['code']; ?> </td>
                  <td> <?= $currentProfessor['name'] ?> </td>
                </tr>

                <?php
              }

              ?>
            </table>
            <section class="create-form">
              <form action="../controllers/StudentClassEnrollingController.php" method="POST">
                <div style="text-align:center"> <br> <button name="action" value="delete"> Cancelar matrícula. </button> </div>
              </form>
            </section>
            <?php

          }
         ?>
     </section>
   </body>
 </html>
