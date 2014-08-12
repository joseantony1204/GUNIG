<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/academico/unidadesacademicascpanel/index');
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel'=>array('unidadesacademicascpanel/'),
	'Admin Académico',
);
?>
<table width="75%" border="0" align="center">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "UNIDADES ACADÉMICAS "; ?></h4>
    </fieldset>
    </td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
   <table width="100%" height="110" border="0" align="center">
                      <tr>
                        <th colspan="9"><hr /></th>
                      </tr>
                      <tr align="center">
                        <td colspan="2" >&nbsp;</td>
                        <td width="20%" scope="col"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/sedes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Sedes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlunidadesacademicas/sedes/admin',),$htmlOptions ); 
	 
	?></td>
    
                            
    
    
                        <td scope="col">&nbsp;</td>
                        <td scope="col"><?php
						$imageUrl = Yii::app()->request->baseUrl . '/images/academico/facultades.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Facultades');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlunidadesacademicas/facultades/admin',),$htmlOptions ); 
	
	?></td>
                        <td width="2%" align="center">&nbsp;</td>
                        <td width="15%" align="center"><?php
						 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/programas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Programas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlunidadesacademicas/programas/admin',),$htmlOptions ); 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/decanos.png';
	
	?></td>
                        <td colspan="2" align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td width="20%" height="21" align="center">&nbsp;</td>
                        <td width="2%">&nbsp;</td>
                        <td align="center"><?php 
	  $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Decanos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlunidadesacademicas/decanos/admin',),$htmlOptions );  
	?></td>
                        <td width="2%" align="center">&nbsp;</td>
                        <td width="20%" align="center"><?php  $imageUrl = Yii::app()->request->baseUrl . '/images/academico/directoresprogramas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Coordinadores de Programas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlunidadesacademicas/directoresprogramas/admin',),$htmlOptions );
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/coordinadoresprovinciales.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Coordinadores Provinciales');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlunidadesacademicas/coordinadoresprovinciales/admin',),$htmlOptions ); 
	?></td>
                        <td width="1%" align="center">&nbsp;</td>
                        <td width="18%" align="center"><!--</td>
                      </tr>
                      <tr>
                        <td height="14" colspan="9"><hr /></td>
                      </tr>-->

<tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td width="20%" height="21" align="center">&nbsp;</td>
                        <td width="2%">&nbsp;</td>
                        <td align="center"><?php  $imageUrl = Yii::app()->request->baseUrl . '/images/academico/rectores.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Rectores');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlunidadesacademicas/rectores/admin',),$htmlOptions );
	?></td>
                        <td width="2%" align="center">&nbsp;</td>
                        <td width="20%" align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/secretariosgenerales.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Secretarios Generales');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlunidadesacademicas/secretariosgenerales/admin',),$htmlOptions ); 
	?></td>
                        <td width="1%" align="center">&nbsp;</td>
                        <td width="18%" align="center"></td>
                      </tr>
                      <tr>
                        <td height="" colspan="9" align="center"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal ACADÉMICO');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/academico',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="6" colspan="9"><hr /></td>
                      </tr>
        </table> 
    </fieldset>
    </td>
  </tr>
</table>
