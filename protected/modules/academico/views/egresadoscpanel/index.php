<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/academico/egresadoscpanel/index');
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel'=>array('egresadoscpanel/'),
	'Admin Egresados',
);
?>
<table width="75%" border="0" align="center">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "PANEL DE CONTROL - EGRESADOS"; ?></h4>
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
                        <td width="20%" scope="col"><?php
						$imageUrl = Yii::app()->request->baseUrl . '/images/academico/egresados.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'BASE DE DATOS EGRESADOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlegresados/egresados/admin',),$htmlOptions ); 
	
	?></td>
    
                            
    
    
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td width="2%" align="center">&nbsp;</td>
                        <td width="15%" align="center"><?php
						$imageUrl = Yii::app()->request->baseUrl . '/images/academico/planillas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'EXPORTAR REGISTROS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlegresados/egresados/exportar',),$htmlOptions ); 
	
	?></td>
                        <td colspan="2" align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td width="20%" height="21" align="center">&nbsp;</td>
                        <td width="2%">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td width="2%" align="center">&nbsp;</td>
                        <td width="20%" align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td width="1%" align="center">&nbsp;</td>
                        <td width="18%" align="center"><!--</td>
                      </tr>
                      <tr>
                        <td height="14" colspan="9"><hr /></td>
                      </tr>-->
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
