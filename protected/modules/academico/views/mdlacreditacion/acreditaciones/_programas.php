<table width="100%" border="0" align="center">
     <tr>
        <td>
            <div id="div_programa">	               
				<?php $this->widget('bootstrap.widgets.TbGridView',array(
							'id'=>'programas-grid',
							'dataProvider'=>$model_progra->search(),
							'type'=>'striped bordered condensed',
							'filter'=>$model_progra,
							'columns'=>array(
								//'ACPR_ID',
								array(	 'name'=>'ACPR_ID',
										'htmlOptions'=>array(	'width'=>'50','style'=>'text-align: center',
													 						)), 
								'ACPR_NOMBRE',
								//'FACU_ID',
							    array(
									'class'=>'bootstrap.widgets.TbButtonColumn',
								),
							),
							//'onClick'=>'actualizarporid();',
							
						)); ?>
            </div>
        </td>
     </tr>
</table>
     