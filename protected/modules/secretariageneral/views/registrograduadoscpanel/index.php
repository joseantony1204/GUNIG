<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/secretariageneral/registrograduadoscpanel/index');
$this->breadcrumbs=array(
	'Modulo Secretaria General'=>array('/secretariageneral/'),
	'Panel'=>array('registrograduadoscpanel/'),
	'Admin Secretaria General',
);
?>
<table width="75%" border="0" align="center">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "REGISTRO GRADUADOS "; ?></h4>
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
                        <td width="20%" scope="col"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/libros.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'libros');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/libros/admin',),$htmlOptions ); 
	 
	?></td>
    
                            
    
    
                        <td scope="col">&nbsp;</td>
                        <td scope="col"><?php
						$imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/folios.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Facultades');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/folios/admin',),$htmlOptions ); 
	
	?></td>
                        <td width="2%" align="center">&nbsp;</td>
                        <td width="15%" align="center"><?php
						 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/fechasgrados.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Fechas Grados');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/fechasgrados/admin',),$htmlOptions ); 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/jornadas.png';
	
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
	  $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Jornadas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/Jornadas/admin',),$htmlOptions );  
	?></td>
                        <td width="2%" align="center">&nbsp;</td>
                        <td width="20%" align="center"><?php  $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/nivelesestudios.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Niveles Estudios');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/nivelesestudios/admin',),$htmlOptions );
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/metodologias.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Metodologias');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/metodologias/admin',),$htmlOptions ); 
	?></td>
                        <td width="1%" align="center">&nbsp;</td>
                        <td width="18%" align="center"></td>
                      </tr>
                     <!-- <tr>
                        <td height="14" colspan="9"><hr /></td>
                      </tr>-->
                      
                       <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      
                      <tr>
                        <td width="20%" height="21" align="center">&nbsp;</td>
                        <td width="2%">&nbsp;</td>
                        <td align="center"><?php  $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/titulos.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Rectores');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/titulos/admin',),$htmlOptions );
	?></td>
                        <td width="2%" align="center">&nbsp;</td>
                        <td width="20%" align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/titulostrabajosgrados.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Titulos Trabajos Grados');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/titulostrabajosgrados/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/graduados.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Graduados');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/graduados/admin',),$htmlOptions ); 
	?></td>
                        <td width="1%" align="center">&nbsp;</td>
                        <td width="18%" align="center"></td>
                      </tr>
                      <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/codigosicfes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Resoluciones');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/codigosicfes/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/registrograduados.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Graduados');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlregistrograduados/registrograduados/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"></td>
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
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al Menu principal SECRETARIA GENERAL');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/secretariageneral',),$htmlOptions ); 
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
