<table width="100%" border="0" align="center">
     <tr>
        <td>
			<?php $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'factores-grid',
                'dataProvider'=>$model_factor->search(),
                'type'=>'striped bordered condensed',
                'filter'=>$model_factor,
                'columns'=>array(
                    'ACFA_NUMERO',
                    'ACFA_DESCRIPCION',
                     array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                    ),
                ),
            )); ?>
         </td>
     </tr>
</table>
     