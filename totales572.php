<html>
<head>

<style type="text/css">
thead tr th, td{
  text-align: center;
  width: 1%;
}

div{
  text-align: center;
}

.td-parent {
  font-weight: bold;
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>



<?php

list($countEmpl, $countDepend, $depenMeses, $depenProxPer, $countExpProf, $totGanBrut, $countDeducs, $dedMontoTotal, $countReten, $retMontoTotal) = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

$files = glob("xml/*.xml");
foreach($files as $file) 
{ 

$xml=simplexml_load_file($file) or die("Error: Cannot create object");


  if(isset($xml->empleado->nombre)){
    $countEmpl ++;
  }

  if(isset($xml->cargasFamilia)){
      foreach($xml->cargasFamilia->children() as $dependientes){ 
        if(isset($dependientes->nombre)) {
          $countDepend ++;
        }

        $mesDesde = 0;
        if(isset($dependientes->mesDesde)) {
          $mesDesde = $dependientes->mesDesde;
        }

        $mesHasta = 12;
        if(isset($dependientes->mesHasta)) {
          $mesHasta = $dependientes->mesHasta;
        }

        $depenMeses =  $depenMeses + $mesHasta - $mesDesde;

        if(isset($dependientes->vigenteProximosPeriodos)) {
          $depenProxPer ++;
        }

      }
   }

    if(isset($xml->ganLiqOtrosEmpEnt)) 
    {
       foreach($xml->ganLiqOtrosEmpEnt->children() as $expProfesional) 
       { 

          if(isset($expProfesional->cuit)){
            $countExpProf ++;
          }

            foreach($expProfesional->ingresosAportes->children() as $ingresosAportes){ 
              $totGanBrut =  $totGanBrut + $ingresosAportes->ganBrut;
            }

        }
     }

    $count = 1;
    if(isset($xml->deducciones)) 
    {
      $countDeducs ++;

      foreach($xml->deducciones->children() as $deducciones) 
      { 
         $dedMontoTotal = $dedMontoTotal + $deducciones->montoTotal;
      }
     }


    

    if(isset($xml->retPerPagos)) 
    {
      foreach($xml->retPerPagos->children() as $retenciones) 
      { 
        $countReten ++;
        $retMontoTotal = $retMontoTotal + $retenciones->montoTotal;
      }
    }

}
?>

<div class="container"> 
<h1>Totales Formularios 572</h1>  
        <br><br> 
        <table class="table" >
          <thead class="thead-dark">
            <tr>
              <th colspan="12">Datos Principales</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-parent" colspan="12">Total Empleados</td>
            </tr>
            <tr>
              <td class="td-child" colspan="12"><?php echo $countEmpl; ?></td>
            </tr>
          </tbody>
        </table>
      
      
        <table class="table" >
          <thead class="thead-dark">
            <tr>
              <th colspan="12">Dependiente</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-parent" colspan="4">Total Dependientes</td>
              <td class="td-parent" colspan="4">Total Períodos</td>
              <td class="td-parent" colspan="4">Total Vigentes Proximos Períodos</td>
            </tr>
            <tr>
              <td class="td-child" colspan="4"><?php echo $countDepend;?></td>
              <td class="td-child" colspan="4"><?php echo $depenMeses; ?></td>
              <td class="td-child" colspan="4"><?php echo $depenProxPer;?></td>
            </tr>
          </tbody>
        </table>


        <table class="table" >
          <thead class="thead-dark">
            <tr>
              <th colspan="12">Experiencia Profesional</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-parent" colspan="6">Cantidad de Otros trabajos</td>
              <td class="td-parent" colspan="6">Total Ganancia Bruta</td>
            </tr>
            <tr>
              <td class="td-child" colspan="6"><?php echo $countExpProf;?></td>
              <td class="td-child" colspan="6"><?php echo $depenMeses; ?></td>
            </tr>
          </tbody>
        </table>


        <table class="table" >
          <thead class="thead-dark">
            <tr>
              <th colspan="12">Deducciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-parent" colspan="6">Cantidad de Deducciones</td>
              <td class="td-parent" colspan="6">Total Monto Deducido</td>
            </tr>
            <tr>
              <td class="td-child" colspan="6"><?php echo $countDeducs;?></td>
              <td class="td-child" colspan="6"><?php echo $dedMontoTotal; ?></td>
            </tr>
          </tbody>
        </table>

        <table class="table" >
          <thead class="thead-dark">
            <tr>
              <th colspan="12">Retenciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-parent" colspan="6">Cantidad de Retenciones</td>
              <td class="td-parent" colspan="6">Total Monto Retenido</td>
            </tr>
            <tr>
              <td class="td-child" colspan="6"><?php echo $countReten;?></td>
              <td class="td-child" colspan="6"><?php echo $retMontoTotal; ?></td>
            </tr>
          </tbody>
        </table>

              </div>
<?php
include 'includes/footer.php';  
?>