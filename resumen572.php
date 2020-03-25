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


<main class="container">
    <h1>Búsqueda por Cuil o nombre de archivo</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        Cuil: <br>
        <input type="text" name="formCuil" class="form-control" >
        <br>
        Nombre Archivo: <br>
        <input type="text" name="formNombre" class="form-control" >
        <br>
        <br>
        <input type="submit" class="btn btn-secondary mb-3" name="someAction" value="Buscar Empleado" />
        
    </form>

</main>

<?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
        {
?>
<?php

$formCuil = $_POST['formCuil'];
$formNombre = $_POST['formNombre'];

$files = glob("xml/*.xml");
foreach($files as $file) 
{ 

?> 
<div class="container"> 

<?php  $xml=simplexml_load_file($file) or die("Error: Cannot create object");

if (substr($file, 4, 11) == $formCuil OR $file == 'xml/' . $formNombre OR $file == 'xml/' .$_POST['formNombre'] . '.xml')
{
?>
<h1>Datos de Formulario 572</h1>  
        <br><br> 
        <table class="table" >
          <thead class="thead-dark">
            <tr>
              <th colspan="12">Datos Principales</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-parent" colspan="12">Nombre</td>
            </tr>
            <tr>
              <td class="td-child" colspan="12"><?php echo $xml->empleado->apellido . '  ' .  $xml->empleado->nombre; ?></td>
            </tr>
            <tr>
              <td class="td-parent" colspan="6">Cuil</td>
              <td class="td-parent" colspan="6">Tipo Doc</td>
            </tr>
            <tr>
              <td class="td-child" colspan="6"><?php echo substr($file, 4, 11); ?></td>
              <td class="td-child" colspan="6"><?php echo $xml->empleado->tipoDoc;?></td>
            </tr>
            <tr>
              <td class="td-parent" colspan="4">Período</td>
              <td class="td-parent" colspan="4">Nro Presentación</td>
              <td class="td-parent" colspan="4">Fecha Presentación</td>
            </tr>
            <tr>
              <td class="td-child" colspan="4"><?php echo $xml->periodo;?></td>
              <td class="td-child" colspan="4"><?php echo $xml->nroPresentacion;?></td>
              <td class="td-child" colspan="4"><?php echo $xml->fechaPresentacion;?></td>
            </tr>
          </tbody>
        </table>
      
      
        <table class="table" >
          <thead class="thead-dark">
            <tr>
              <th colspan="12">Dirección</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-parent" colspan="3">Calle</td>
              <td class="td-parent" colspan="3">Número</td>
              <td class="td-parent" colspan="3">Piso</td>
              <td class="td-parent" colspan="3">Depto</td>
            </tr>
            <tr>
              <td class="td-child" colspan="3"><?php echo $xml->empleado->direccion->calle;?></td>
              <td class="td-child" colspan="3"><?php echo $xml->empleado->direccion->nro;?></td>
              <td class="td-child" colspan="3"><?php echo $xml->empleado->direccion->piso;?></td>
              <td class="td-child" colspan="3"><?php echo $xml->empleado->direccion->dpto;?></td>
            </tr>
            <tr>
              <td class="td-parent" colspan="12">Provincia</td>
            </tr>
            <tr>
              <td class="td-child" colspan="12"><?php echo $xml->empleado->direccion->provincia;?></td>
            </tr>
            <tr>
              <td class="td-parent" colspan="6">Código Postal</td>
              <td class="td-parent" colspan="6">Localidad</td>
            </tr>
            <tr>
              <td class="td-child" colspan="6"><?php echo $xml->empleado->direccion->cp;?></td>
              <td class="td-child" colspan="6"><?php echo $xml->empleado->direccion->localidad;?></td>
            </tr>
            </tbody>
        </table>

<?php
          if(isset($xml->cargasFamilia)) 
          {
              foreach($xml->cargasFamilia->children() as $dependientes) 
              { 
?>
        <table class="table" >
          <thead class="thead-dark">
            <tr>
              <th colspan="12">Dependiente</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-parent" colspan="12">Nombre</td>
            </tr>
            <tr>
              <td class="td-child" colspan="12"><?php echo $dependientes->apellido . '  ' .  $dependientes->nombre; ?></td>
            </tr>
            <tr>
              <td class="td-parent" colspan="6">Tipo Doc</td>
              <td class="td-parent" colspan="6">Nro Doc</td>
            </tr>
            <tr>
              <td class="td-child" colspan="6"><?php echo $dependientes->tipoDoc;?></td>
              <td class="td-child" colspan="6"><?php echo $dependientes->nroDoc;?></td>
            </tr>
            <tr>
              <td class="td-parent" colspan="6">Fecha Nac</td>
              <td class="td-parent" colspan="6">Parentesco</td>
            </tr>
            <tr>
              <td class="td-child" colspan="6"><?php echo $dependientes->fechaNac;?></td>
              <td class="td-child" colspan="6"><?php echo $dependientes->parentesco;?></td>
            </tr>
            <tr>
              <td class="td-parent" colspan="4">Mes Desde</td>
              <td class="td-parent" colspan="4">Mes Hasta</td>
              <td class="td-parent" colspan="4">Vigente Proximos Períodos</td>
            </tr>
            <tr>
              <td class="td-child" colspan="4"><?php echo $dependientes->mesDesde;?></td>
              <td class="td-child" colspan="4"><?php echo $dependientes->mesHasta;?></td>
              <td class="td-child" colspan="4"><?php echo $dependientes->vigenteProximosPeriodos;?></td>
            </tr>
          </tbody>
        </table>
<?php
              }
          }
?>

<?php
          if(isset($xml->ganLiqOtrosEmpEnt)) 
          {
              foreach($xml->ganLiqOtrosEmpEnt->children() as $expProfesional) 
              { 

?>



        <!--<table class="table" ><thead class="thead-dark"><tr><th colspan="12">Experiencia Profesional</th></tr></thead><tbody></tbody></table>-->
        <div class="p-3 mb-2 bg-dark text-white"><b>Experiencia Profesional</b></div>
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">Cuit<span class="badge badge-primary badge-pill"><?php echo $expProfesional->cuit;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Denominacion<span class="badge badge-primary badge-pill"><?php echo $expProfesional->denominacion;?></span></li>
<?php
                    foreach($expProfesional->ingresosAportes->children() as $ingresosAportes) 
                    { 
?>
                    <ul class="list-group">
                      <br>
                      <div class="alert alert-info" role="alert">Mes <?php echo $ingresosAportes[0]['mes'];?></div>
                      <li class="list-group-item d-flex justify-content-between align-items-center">obraSoc<span class="badge badge-primary badge-pill">  <?php echo $ingresosAportes->obraSoc;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">segSoc<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->segSoc;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">sind<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->sind;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">ganBrut<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->ganBrut;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">retGan<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->retGan;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">retribNoHab<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->retribNoHab;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">ajuste<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->ajuste;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">exeNoAlc<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->exeNoAlc;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">sac<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->sac;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">horasExtGr<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->horasExtGr;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">horasExtEx<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->horasExtEx;?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">matDid<span class="badge badge-primary badge-pill"><?php echo $ingresosAportes->matDid;?></span></li>
                    </ul>
<?php
                    }
?> 
                </ul>
<?php
              }
          }
?>


<?php
          $count = 1;
          if(isset($xml->deducciones)) 
          {
?>

<?php
              foreach($xml->deducciones->children() as $deducciones) 
              { 
?>
        <!--<table class="table" ><thead class="thead-dark"> <tr><th colspan="12">Deducción</th>    </tr></thead><tbody></tbody></table>-->
              <div class="p-3 mb-2 bg-dark text-white"><b>Deducción</b></div>



                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">Deducción<span class="badge badge-primary badge-pill"> <?php echo $deducciones[0]['tipo'];?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Tipo Doc<span class="badge badge-primary badge-pill"><?php echo $deducciones->tipoDoc;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Nro Doc<span class="badge badge-primary badge-pill"><?php echo $deducciones->nroDoc;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Denominación<span class="badge badge-primary badge-pill"><?php echo $deducciones->denominacion;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Desc Basica<span class="badge badge-primary badge-pill"><?php echo $deducciones->descBasica;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Monto Total<span class="badge badge-primary badge-pill"><?php echo $deducciones->montoTotal;?></span></li>
<?php
                    if(isset($deducciones->periodos)) 
                    {
                    foreach($deducciones->periodos->children() as $periodos) 
                    { 
?>
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">Mes Desde<span class="badge badge-primary badge-pill"><?php echo $periodos[0]['mesDesde'];?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">Mes Hasta<span class="badge badge-primary badge-pill"><?php echo $periodos[0]['mesHasta'];?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">Monto Mensual<span class="badge badge-primary badge-pill"><?php echo $periodos[0]['montoMensual'];?></span></li>
                    </ul>
<?php
                    }
                    }
?> 
<?php
                    if(isset($deducciones->detalles)) 
                    {
                    /*foreach($deducciones->detalles->children() as $detDeduc) 
                    { */
                    $detDeduc = $deducciones->detalles->children();
?>
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">Nombre detDeduc<span class="badge badge-primary badge-pill"><?php echo $detDeduc[0]['nombre'];?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">Valor detDeduc<span class="badge badge-primary badge-pill"><?php echo $detDeduc[0]['valor'];?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">Nombre: detDeduc<span class="badge badge-primary badge-pill">mes</span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">Mes detDeduc<span class="badge badge-primary badge-pill"><?php echo $count;?></span></li>
                    </ul>
<?php               $count = $count + 1;
                    /*}*/
                    }
                    ?> 
                </ul>
<?php
              }
          }
?> 



<?php
          if(isset($xml->retPerPagos)) 
          {
              foreach($xml->retPerPagos->children() as $retenciones) 
              { 
?>

        <!--<table class="table" ><thead class="thead-dark"><tr><th colspan="12">Retención</th></tr></thead><tbody></tbody></table>-->
        <div class="p-3 mb-2 bg-dark text-white"><b>Retención</b></div>

                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">Tipo Retención<span class="badge badge-primary badge-pill"><?php echo $retenciones[0]['tipo'];?></span></li>
                  <?php if(isset($retenciones->tipoDoc)) { ?><li class="list-group-item d-flex justify-content-between align-items-center">tipoDoc<span class="badge badge-primary badge-pill"><?php echo $retenciones->tipoDoc;?></li></span><?php } ?>
                  <?php if(isset($retenciones->nroDoc)) { ?><li class="list-group-item d-flex justify-content-between align-items-center">nroDoc<span class="badge badge-primary badge-pill"><?php echo $retenciones->nroDoc;?></span></li><?php } ?>
                  <?php if(isset($retenciones->denominacion)) { ?><li class="list-group-item d-flex justify-content-between align-items-center">denominacion<span class="badge badge-primary badge-pill"><?php echo $retenciones->denominacion;?></span></li><?php } ?>
                  <?php if(isset($retenciones->descBasica)) { ?><li class="list-group-item d-flex justify-content-between align-items-center">descBasica<span class="badge badge-primary badge-pill"><?php echo $retenciones->descBasica;?></span></li><?php } ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Monto Total<span class="badge badge-primary badge-pill"><?php echo $retenciones->montoTotal;?></span></li>
<?php
                    foreach($retenciones->periodos->children() as $periodosRet) 
                    { 
?>
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">Mes Desde<span class="badge badge-primary badge-pill"><?php echo $periodosRet[0]['mesDesde'];?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">Mes Hasta<span class="badge badge-primary badge-pill"><?php echo $periodosRet[0]['mesHasta'];?></span></li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">Monto Mensual<span class="badge badge-primary badge-pill"><?php echo $periodosRet[0]['montoMensual'];?></span></li>
                    </ul>
<?php
                    }
?> 
<?php               if(isset($retenciones->detalles)) 
                    {
                      foreach($retenciones->detalles->children() as $detallesRet) 
                      { 
?>
                        <ul class="list-group">
                          <li class="list-group-item d-flex justify-content-between align-items-center">Detalle<span class="badge badge-primary badge-pill"><?php echo $detallesRet[0]['nombre'];?></span></li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Valor<span class="badge badge-primary badge-pill"><?php echo $detallesRet[0]['valor'];?></span></li>
                        </ul>
<?php
                      }
                    }
?> 
                  <li class="list-group-item d-flex justify-content-between align-items-center">Nombre<span class="badge badge-primary badge-pill"><?php echo $dependientes->nombre;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Fecha Nac<span class="badge badge-primary badge-pill"><?php echo $dependientes->fechaNac;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Mes Desde<span class="badge badge-primary badge-pill"><?php echo $dependientes->mesDesde;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Mes Hasta<span class="badge badge-primary badge-pill"><?php echo $dependientes->mesHasta;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Parentesco<span class="badge badge-primary badge-pill"><?php echo $dependientes->parentesco;?></span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">Vigente Proximos Periodos<span class="badge badge-primary badge-pill"><?php echo $dependientes->vigenteProximosPeriodos;?></span></li>
                </ul>
              <?php
                            }
                        }
              ?>
              </div>
              
              
              
              <?php  
              }



            }
        /*}*/

}
include 'includes/footer.php';  
?>