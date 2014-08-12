<table width="100%" border="0" align="center">
     <tr>
        <td>
           	<?php $this->widget('bootstrap.widgets.TbGridView',array(
                    'id'=>'indicadores-grid',
                    'dataProvider'=>$model_indica->search(),
                    'type'=>'striped bordered condensed',
                    'filter'=>$model_indica,
                    'columns'=>array(
                        'ACIN_NUMERO',
                        'ACIN_DESCRIPCION',
                         array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                        ),
                    ),
                )); ?>
         </td>
     </tr>
</table>
     