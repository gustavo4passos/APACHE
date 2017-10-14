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
         <li><a href="StudentClasses.php">Disciplinas</a></li>
         <li><a href="#">Cursos</a></li>
         <li><a href="#">Informações Pessoais</a></li>
         <li><a href="../helpers/StudentLogout.php">Logout</a></li>
       </ul>
     </nav>
   </header>
     <section class="inicio_department">
       <h1> Matrícula em Disciplinas </h1>
     </section>

     <section class="create_form">
       <form id="enroll_student" action="../controllers/StudentClassEnrollingController.php" method="POST">
          <?php
            $student = Retrieve::select_from_id_assoc('student', $_SESSION['id']);
            $availableSubjects = Retrieve::select_from_where("course_has_subject", "course_id", $student['course_id']);
            $availableClasses = Retrieve::get_available_classes_from_course($availableSubjects);

            if(empty($availableClasses))
            {
              echo "Não há turmas disponíveis para o seu curso.";
            }
            else
            {
              $allSubjects = Retrieve::select_from_assoc("subject");

              for($i = 0; $i < sizeof($availableSubjects); $i++){ ?>
                <table>
                <?php
                if(isset($availableClasses[$availableSubjects[$i]['subject_id']]) && !empty($availableClasses[$availableSubjects[$i]['subject_id']]))
                {
                  echo "<tr> <th> {$allSubjects[$availableSubjects[$i]['subject_id']]['name']} </th> </tr>\n";
                  for($j = 0; $j < sizeof($availableClasses[$availableSubjects[$i]['subject_id']]); $j++)
                  {
                    echo "<tr>\n";
                    echo "<td> <input type=\"radio\" name=\"{$availableSubjects[$i]['subject_id']}\" value=\"{$availableClasses[$availableSubjects[$i]['subject_id']][$j]['id']}\"> {$availableClasses[$availableSubjects[$i]['subject_id']][$j]['code']} </td>\n";
                    echo "</tr>";
                  }
                } ?>

              </table>
              <br>

              <?php
              }
              echo "<div class=\"enroll-button\"> <button name=\"action\" value=\"create\">Solicitar matrícula </button> </div>";
            }
          ?>
        </form>
     </section>
   </body>
 </html>
