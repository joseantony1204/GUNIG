<?php
Yii::app()->homeUrl = array('/contratacion/ordenescpanel/index');
$this->breadcrumbs=array(
	
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Generar Invitaciones',

	
);

?>
<table width="60" border="0" align="center" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left">
       <?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?>
        </td>
        <td align="left">
        <strong style="border-bottom-style:groove">GENERADOR DE CARTAS DE INVITACIÓN [Contratación] </strong></td>
        <td width="80" align="center">
          <?php
		   $id = "";
  if($_REQUEST["id"]){
   $id = $_REQUEST["id"];
  }
		  
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/view','id'=>$model->MOOR_ID),$htmlOptions ); 
?>         
	         
		         
        </td>
        <td width="80" align="center">
        <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/invitacion','id'=>$model->MOOR_ID),$htmlOptions ); 
         ?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_formInvitados',array(
	                                       'Modeloordenes'=>$Modeloordenes,
										   'Invitaciones'=>$Invitaciones,
										   ));
	?></p></td>
  </tr>
</table>
