<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/Contratacioncpanel/index'),
	'Detalles del contrato',
);

$numero=$model->rel_contrato->CONT_NUMORDEN;
$clase=$model->rel_contrato->cLCO->CLCO_NOMBRE;
$tipo=$model->rel_contrato->tICO->TICO_NOMBRE;
$anio=$model->rel_contrato->CONT_ANIO;

?>




<table width="70%" border="0" align="center" class="" style="white-space-collapse:collapse">
  <tr>
    <td colspan="4"><table width="820" border="0" align="center"> <fieldset>  
      <tr>
        <td width="60" align="left"><?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?></fieldset></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">  [ <?php echo $tipo ?> <?php echo $numero ?> DE <?php echo $clase ?>   DE  <?php echo $anio ?>]   </strong></td>
        <td width="80" align="center">&nbsp;   </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/admin',),$htmlOptions ); 
?>
</td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/view','id'=>$model->MOOR_ID),$htmlOptions ); 
?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4"> 
    <fieldset>  
  <strong>OBJETO DEL CONTRATO:</strong> <?php  echo  $model->MOOR_OBJETO;  ?>.   
	</fieldset>  
    </td>
  </tr>
  
  </table>
<table width="70%" border="0" align="center" class="" style="white-space-collapse:collapse">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="20%"><?php
	

	
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_pres.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'CDP');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/presupuestosordenes/admin','id'=>$model->MOOR_ID,),$htmlOptions ); 

	?></td>
      <td width="6%">&nbsp;</td>
      <td width="20%"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_prod.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'PRODUCTOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/productos/admin','id'=>$model->MOOR_ID,),$htmlOptions ); 
	?></td>
      <td width="6%">&nbsp;</td>
      <td width="20%"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_gara.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'GARANTIAS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/garantias/admin','id'=>$model->MOOR_ID,),$htmlOptions ); 
	?> </td>
      <td width="6%">&nbsp;</td>
      <td width="20%"><?php

	   if(
	      ($model->rel_contrato->CLCO_ID!=140) 
	  )
	  {
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_fopa.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'FORMA DE PAGO');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/formaspagos/admin','id'=>$model->MOOR_ID,),$htmlOptions ); 
	 }
	?>
      <?php
	   if(
	      ($model->rel_contrato->CLCO_ID==140) 
	  )
	  {
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_invita.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'INVITADOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/invitados/admin','id'=>$model->MOOR_ID,),$htmlOptions ); 
	  }
	?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="20%"><?php
	   
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_super.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'DESCARGAR - DESIGNACIÓN DE SUPERVISOR');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/anexo1','id'=>$model->MOOR_ID,),$htmlOptions ); 
	
	?></td>
      <td width="6%">&nbsp;</td>
      <td><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_invitaciones.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Generar Invitaciones del Contrato');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/invitacion','id'=>$model->MOOR_ID,),$htmlOptions ); 
	?></td>
      <td>&nbsp;</td>
      <td><?php
	  if( ($model->rel_contrato->CLCO_ID==80) or
	      ($model->rel_contrato->CLCO_ID==90) or
	      ($model->rel_contrato->CLCO_ID==100) or
	      ($model->rel_contrato->CLCO_ID==110) or
	      ($model->rel_contrato->CLCO_ID==120) or
	      ($model->rel_contrato->CLCO_ID==130) or
	      ($model->rel_contrato->CLCO_ID==140) or
	      ($model->rel_contrato->CLCO_ID==150)or
	      ($model->rel_contrato->CLCO_ID==170) 
		   
	  )
	  {
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_acep.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'DESCARGAR - ACEPTACIÓN DE OFERTA');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/anexo2','id'=>$model->MOOR_ID,),$htmlOptions ); 
	  }
	
	?>
      <?php
	    if( ($model->rel_contrato->TICO_ID==2)
         or ($model->rel_contrato->TICO_ID==4)
	  )
	  {
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contratopdf.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'DESCARGAR - CONTRATO');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/download','id'=>$model->MOOR_ID,),$htmlOptions ); 
	  }
	?></td>
      <td>&nbsp;</td>
      <td><?php
	    if( ($model->rel_contrato->CLCO_ID==80) or
	      ($model->rel_contrato->CLCO_ID==90) or
	      ($model->rel_contrato->CLCO_ID==100) or
	      ($model->rel_contrato->CLCO_ID==110) or
	      ($model->rel_contrato->CLCO_ID==120) or
	      ($model->rel_contrato->CLCO_ID==130) or
	      ($model->rel_contrato->CLCO_ID==140) or
	      ($model->rel_contrato->CLCO_ID==150) or
	      ($model->rel_contrato->CLCO_ID==170)
	  )
	  {
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_nece.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'NECESIDAD DE CONTRATOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/necesidades/admin','id'=>$model->MOOR_ID,),$htmlOptions ); 
	
	}
	?></td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
    <tr>
      <td height="24"><?php
	   if( ($model->rel_contrato->CLCO_ID==80) or
	      ($model->rel_contrato->CLCO_ID==90) or
	      ($model->rel_contrato->CLCO_ID==100) or
	      ($model->rel_contrato->CLCO_ID==110) or
	      ($model->rel_contrato->CLCO_ID==120) or
	      ($model->rel_contrato->CLCO_ID==130) or
	      ($model->rel_contrato->CLCO_ID==150) or
	      ($model->rel_contrato->CLCO_ID==170)
	  )
	  {
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_invita.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'INVITADOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/invitados/admin','id'=>$model->MOOR_ID,),$htmlOptions ); 
	  }
	?>
      <?php
	    if( ($model->rel_contrato->CLCO_ID==140) 
	  )
	  {
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contratopdf.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'DESCARGAR - CONTRATO');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/download','id'=>$model->MOOR_ID,),$htmlOptions ); 
	  }
	?></td>
      <td>&nbsp;</td>
      <td><?php
	   if ($model->rel_contrato->CLCO_ID!=140){
	    if( ($model->rel_contrato->TICO_ID==1) or
		 ($model->rel_contrato->TICO_ID==3) 
	  )
	  {
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contratopdf.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'DESCARGAR - CONTRATO');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/download','id'=>$model->MOOR_ID,),$htmlOptions ); 
	  }}
	?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
