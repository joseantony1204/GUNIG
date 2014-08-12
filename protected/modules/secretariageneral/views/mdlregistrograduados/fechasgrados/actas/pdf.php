<?php
$mPDF1 = Yii::app()->ePdf->mpdf();
//$mPDF1->mirrorMargins = 1;


?>

<?php /*$fechaActual=date("Y-m-d");
       $rectores=new Rectores;
		  $Secretarios=new Secretariosgenerales;
		  $Decanos=new Decanos;
		   $SEGE_ID=$Secretarios->getSecretarioporFechaGrado($fechaActual);
		   $Secretarios->getNombreSecretarios($SEGE_ID);
		   */
?>

<?php 
      ob_start(); 
 ?> 
 <page backtop="8mm" backbottom="2.5mm" backleft="2.5mm" backright="2.5mm"> 
   
<?php $content='
<p align="right"><strong></strong><strong>No.<u>9023</u></strong></p>
<p><em>&nbsp;</em></p>
<p align="justify">En Riohacha, Capital  del Departamento de La Guajira,  a los Seis (6) días del mes de Septiembre del año 2013,  se reunieron en la Ciudadela Universitaria  el doctor CARLOS ARTURO ROBLES JULIO<strong> </strong>en  su calidad de Rector de la   Institución, JAIRO SALCEDO DAVILA, Decano de la Facultad de Ingeniería y  LULIA PAULINA FUENTES SANCHEZ<strong> </strong>Secretaria  General, con el objeto de otorgar el título  profesional de <strong>INGENIERO DEL MEDIO  AMBIENTE</strong>, a <strong>SINDY  MARCELA MEJIA MENDOZA </strong>con Cédula de Ciudadanía Numero 1.122.403.209 expedida en San  Juan del Cesar (La Guajira).  El  graduado terminó sus estudios de acuerdo con los reglamentos según consta en  los respectivos registros de la   Facultad de Ingeniería, y presentó el Trabajo de Grado  titulado: <strong>&ldquo;EVALUACION  DE UN SISTEMA INTEGRADO BIODIGESTOR BIOFILTRO OPCION SOSTENIBLE PARA EL  TRATAMIENTO DE LAS AGUAS RESIDUALES EN EL RESGUARDO INDIGENA DE ZAHINO&rdquo;.  </strong>La Universidad de La Guajira por intermedio de  su Representante Legal El Rector, previo juramento en rigor y en virtud del  Acuerdo No. 009 del 7 de Septiembre de (1993), Emanado del Consejo Superior,  bajo el Código No. 121846280004427901100 del 13  de Septiembre de 1995 ante el Instituto Colombiano para el Fomento de la Educación Superior  (ICFES), otorga el título de <strong>INGENIERO DEL  MEDIO AMBIENTE</strong> a <strong>SINDY MARCELA MEJIA MENDOZA</strong> haciéndole entrega del correspondiente Diploma.  El presente se encuentra registrado en el Libro  de Actas No. 29 Folio 0236.</p>
<p>Este documento se firma sin borrones ni  enmendaduras.</p>
<p>Para constancia se firma,</p>
<p>&nbsp;</p>
<p><strong>CARLOS ARTURO ROBLES JULIO                   </strong><strong>JAIRO  SALCEDO DAVILA</strong><strong> </strong><br />
  Rector                                                                      Decano</p>
<p>&nbsp;</p>
<p align="center"><strong>LULIA  PAULINA FUENTES SANCHEZ</strong><br />
  Secretaria General </p>

  '; ?>  
 </page> 
 <?php 
      $content = ob_get_clean(); 
      $mPDF1->WriteHTML($content); 
      $mPDF1->Output('prueba.pdf','I'); 
	  exit;
 ?>

<div align="rigth"><img src="'.Yii::app()->request->baseUrl.'/images/plantillapdf/footer2.png" width="90%" height="10%" /></div>


