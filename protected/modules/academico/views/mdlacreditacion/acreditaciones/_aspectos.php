<table width="100%" border="0" align="center">
     <tr>
        <td>
           	<?php $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'aspectos-grid',
                'dataProvider'=>$model_aspect->search(),
                'type'=>'striped bordered condensed',
                'filter'=>$model_aspect,
                'columns'=>array(
                    'ACAS_NUMERO',
                    'ACAS_DESCRIPCION',
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                    ),
                ),
            )); ?>
        </td>
     </tr>
</table>
     