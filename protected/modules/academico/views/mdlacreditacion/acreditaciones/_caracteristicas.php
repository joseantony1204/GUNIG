<table width="100%" border="0" align="center">
     <tr>
        <td>
           	<?php $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'caractersiticas-grid',
                'dataProvider'=>$model_caract->search(),
                'type'=>'striped bordered condensed',
                'filter'=>$model_caract,
                'columns'=>array(
                    'ACCA_NUMERO',
                    'ACCA_DESCRIPCION',
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                    ),
                ),
            )); ?>
        </td>
     </tr>
</table>
     