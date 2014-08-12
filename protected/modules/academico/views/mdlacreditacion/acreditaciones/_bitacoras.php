<table width="100%" border="0" align="center">
     <tr>
        <td>
           	<?php $this->widget('bootstrap.widgets.TbGridView',array(
					'id'=>'bitacoras-grid',
					'dataProvider'=>$model_bitaco->search(),
					'type'=>'striped bordered condensed',
					'filter'=>$model_bitaco,
					'columns'=>array(
						'ACBI_NUMERO',
						'ACBI_FECHA',
						//'PROG_ID',																
						array(
							'class'=>'bootstrap.widgets.TbButtonColumn',
						),
					),
				)); ?>        
        </td>
     </tr>
</table>
   