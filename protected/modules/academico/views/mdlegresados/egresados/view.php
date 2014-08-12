<?php
$this->breadcrumbs=array(
	'Egresados'=>array('index'),
	$model->EGRE_ID,
);

?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [ EGRESADOS : Detalles ] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlegresados/egresados/admin',),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlegresados/egresados/view','id'=>$model->EGRE_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlegresados/egresados/update','id'=>$model->EGRE_ID),$htmlOptions ); 
?>         
		 </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'EGRE_ID',
		'EGRE_LIBRO',
		'EGRE_FOLIO',
		'EGRE_ACTAGRADO',
		'EGRE_PRIMERNOMBRE',
		'EGRE_SEGUNDONOMBRE',
		'EGRE_PRIMERAPELLIDO',
		'EGRE_SEGUNDOAPELLIDO',
		array('name'=>'TIID_ID', 'value'=>$model->tIID->TIID_NOMBRE),
		'EGRE_NUMEROIDENTIFICACION',
		'EGRE_FECHAEXPEDICION',
		array('name'=>'MUNI_IDCEDULA', 'value'=>$model->mUNI->MUNI_NOMBRE),
		array('name'=>'PAIS_ID', 'value'=>$model->pAIS->PAIS_NOMBRE),
		array('name'=>'DEPA_ID', 'value'=>$model->dEPA->DEPA_NOMBRE),
		array('name'=>'MUNI_ID', 'value'=>$model->mUNI->MUNI_NOMBRE),		
		'EGRE_FECHANACIMIENTO',
		array('name'=>'SEXO_ID', 'value'=>$model->sEXO->SEXO_NOMBRE),
		'EGRE_DIRECCION',
		'EGRE_BARRIO',
		'EGRE_TELEFONO',
		'EGRE_EMAIL',
		array('name'=>'ESCI_ID', 'value'=>$model->eSCI->ESCI_NOMBRE),
		array('name'=>'COVU_ID', 'value'=>$model->cOVU->COVU_NOMBRE),
		array('name'=>'RELI_ID', 'value'=>$model->rELI->RELI_NOMBRE),
		'EGRE_CUAL',
		'EGRE_LABORA',
		array('name'=>'SELA_ID', 'value'=>$model->sELA->SELA_NOMBRE),
		'EGRE_EMPRESALABORA',
		array('name'=>'PROG_ID', 'value'=>$model->pROG->PROG_NOMBRE),
		array('name'=>'PRSE_ID', 'value'=>$model->pRSE->PRSE_PROCONSECUTIVO),
		'EGRE_CODIGOIES',
		array('name'=>'DEPA_IDPROGRAMA', 'value'=>$model->dEPA->DEPA_NOMBRE),
		array('name'=>'MUNI_IDPROGRAMA', 'value'=>$model->mUNI->MUNI_NOMBRE),
		'ANAC_ID',
		'EGRE_SEMESTREINGRESO',
		'EGRE_TRANSFERENCIA',
		'EGRE_TRABAJOGRADO',
		array('name'=>'FEGR_ID', 'value'=>$model->fEGR->FEGR_FECHA),		
		'EGRE_ANIOREPORTE',
		'EGRE_SEMESTREREPORTE',
		'EGRE_ECAES',
		'EGRE_RESULTADOECAES',
		'EGRE_OBSERVACIONESECAES',		
	),
)); ?>    
    
    </td>
  </tr>
</table>
