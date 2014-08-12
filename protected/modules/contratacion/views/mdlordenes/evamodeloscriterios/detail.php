<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Contratos'=>array('/contratacion/mdlordenes/modeloordenes/adminsupervisores'),
	'Evaluar',
	//$_POST['supervisor']
);
?>
<table width="100%" border="0" align="center">
  <tr>
   <td><table width="100%" border="0" align="center">
      <tr>
        <td width="100" border="0" align="center">
             <?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?>  
                
			         </td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE REGISTROS [ 
		EVALUACIÓN DE CONTRATO  : Evaluar ] </strong></td>
        <td width="8%" align="center">

 <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/viewsupervisores','id'=>$model->MOOR_ID),$htmlOptions ); 
?>         
	</td>

<td width="8%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/evamodeloscriterios/detail','id'=>$model->MOOR_ID),$htmlOptions ); 
?>  </td>
            </tr>
          </table>
          </fieldset>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <?php 
	$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'CRITERIOS-GRID',
    'itemsCssClass' => 'table-bordered',
    'dataProvider'=>$model->search(),
    'columns'=>array(
	
	array('name'=>'TIPO', 'filter' => false, 'value'=>'$data->rel_criterios->rel_tiposcriterios->ETCR_NOMBRE','htmlOptions'=>array('width'=>'5'),),
	array('name'=>'EVCR_ID', 'filter' => false, 'value'=>'$data->rel_criterios->EVCR_NOMBRE','htmlOptions'=>array('width'=>'400'),),
	array('name'=>'VALOR', 'filter' => false, 'value'=>'$data->rel_criterios->EVCR_PUNTO','htmlOptions'=>array('width'=>'5'),),
	
	
	array(
     'class' => 'editable.EditableColumn',
     'name' => 'EVES_ID',
     'headerHtmlOptions' => array('style' => 'width: 90px'),
     'editable' => array(
	   'type'    => 'select',
	   'source'  => array('1'=> 'SI', '2' => 'NO'),
       'url' => $this->createUrl('mdlordenes/evamodeloscriterios/updateResp'),
       'placement' => 'right',
       )
    ),
  
   ),
  ));
  
    ?>

    </td>
  </tr>
</table>
