<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("../conexion.php");
  
//preparando consulta que traera los datos del curso a editar
  $registros=$con->prepare("SELECT cur.nombre,fed.nombre as nombrefederado, fed.apellido as apellidofederado,eva.nombre as nombreevaluacion,eva.porcentaje,nota.nota,nota.promedio FROM matriculas as matri INNER JOIN federados AS fed ON fed.id_federado = matri.id_federado INNER JOIN notas AS nota ON nota.id_matricula = matri.id_matricula INNER JOIN evaluaciones AS eva ON eva.id_evaluacion = nota.id_evaluacion INNER JOIN cursos AS cur ON cur.id_curso = eva.id_curso WHERE fed.id_federado=:codigo AND cur.estado='INICIADO'");
//asignando datos
  $registros->bindParam(':codigo',$_GET['codigo']);
//ejecutando consulta
  $registros->execute();
    
  //almacenamiento de datos de usuario en arreglo en caso de que exista
$vec=[];  
 $vec=$registros->fetchAll(PDO::FETCH_ASSOC);
  
  $cad=json_encode($vec);
  echo $cad;
  //header('Content-Type: application/json');
?>