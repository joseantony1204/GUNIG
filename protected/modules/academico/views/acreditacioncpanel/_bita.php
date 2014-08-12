<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>

<table width="75%" border="0" align="center">
  <tr>
    <td height="21" align="center">  <fieldset> <h4><?php echo "MODULO DE APOYO A LA AUTOEVALUACION PARA LA CALIDAD DE PROGRAMAS ACADEMICOS"; ?></h4> </fieldset> </td>
  </tr>
  <tr>
    <td height="21">


<tr align="center">
                            <td>&nbsp;&nbsp;&nbsp;</td>
</tr>
    	<fieldset>
   		<table width="100%" border="0" align="center">
        				<tr align="center">
                            <td>&nbsp;</td>
                            <td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/programas.png';
                                                 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informacion Base');
                                                 $image = CHtml::image($imageUrl);
                                                 echo CHtml::link($image, array('mdlacreditacion/acreditacionprogramas/create',),$htmlOptions ); 											
                                                ?></td>
                            <td>&nbsp;</td>
                            <td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/bitacoras.png';
															 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Bitacoras');
															 $image = CHtml::image($imageUrl);
															 echo CHtml::link($image, array('mdlacreditacion/acreditacionbitacoras/create',),$htmlOptions ); 
														?></td>
                        	<td>&nbsp;</td>
							<td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/factores.png';
                                                             $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Factores');
                                                             $image = CHtml::image($imageUrl);
                                                             echo CHtml::link($image, array('mdlacreditacion/acreditacionfactores/create',),$htmlOptions ); 														 														?>
                                                          </td>
                            <td>&nbsp;</td>                            
                      </tr>
                      	<tr align="center">
                            <td>&nbsp;</td>
                           <td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/caracteristicas.png';
															 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Caracteristicas');
															 $image = CHtml::image($imageUrl);
															 echo CHtml::link($image, array('mdlacreditacion/acreditacioncaracteristicas/create',),$htmlOptions ); 
														?></td>
                        	<td>&nbsp;</td>
							 <td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/aspectos.png';
                                                 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Aspectos');
                                                 $image = CHtml::image($imageUrl);
                                                 echo CHtml::link($image, array('mdlacreditacion/acreditacionaspectos/create',),$htmlOptions ); 											
                                                ?></td>
                            <td>&nbsp;</td>
                            <td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/indicadores.png';
                                                             $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Indicadores');
                                                             $image = CHtml::image($imageUrl);
                                                             echo CHtml::link($image, array('mdlacreditacion/acreditacionindicadores/create',),$htmlOptions ); 														 														?>
                                                          </td>
                            <td>&nbsp;</td>                            
                      </tr>
                      	<tr align="center">
                            <td>&nbsp;</td>
                            <td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/soportes.png';
                                                             $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Soportes');
                                                             $image = CHtml::image($imageUrl);
                                                             echo CHtml::link($image, array('mdlacreditacion/acreditacionsoportes/create',),$htmlOptions ); 														 														?>
                                                          </td>
                            <td>&nbsp;</td> <td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/acreditacion.png';
                                                 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Consulta');
                                                 $image = CHtml::image($imageUrl);
                                                 echo CHtml::link($image, array('mdlacreditacion/acreditaciones/admin',),$htmlOptions ); 											
                                                ?></td>
                            <td>&nbsp;</td>
                            <td><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/ponderacion.png';
															 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ponderación');
															 $image = CHtml::image($imageUrl);
															 echo CHtml::link($image, array('mdlacreditacion/acreditacionponderaciones/admin',),$htmlOptions ); 
														?></td>
                        	<td>&nbsp;</td>							                           
                      </tr>
        </table> 
    	</fieldset>
    </td>
  </tr>
</table>
