<?php
$this->breadcrumbs=array(
	'Escaneados'=>array('index'),
	$model->ESCA_ID,
);

?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">RESULTADO DE CARGA DE ARCHIVO [ ESCANEADOS : Detalles ] </strong></td>
        <td width="80" align="center"><?php
												 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/tesoreria/regresar.png';
												 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
												 $image = CHtml::image($imageUrl);
												 echo CHtml::link($image, array('tesoreria/libroresoluciones/admin',),$htmlOptions ); 
										?>         
		 </td>      
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<h1>EL ARCHIVO HA SIDO GUARDADO EXITOSAMENTE </h1> 
    
    </td>
  </tr>
</table>
