<table width="100%" border="0" align="center">
     <tr>
        <td>
           	<?php $this->widget('bootstrap.widgets.TbGridView',array(
                    'id'=>'soportes-grid',
                    'dataProvider'=>$model_soport->search(),
                    'type'=>'striped bordered condensed',
                    'filter'=>$model_soport,
                    'columns'=>array(
                                'ACSO_NUMERO',
                                'ACSO_DESCRIPCION',
                                //'ACSO_RESPUESTA',
                                array( 'name'=>'ACSO_RESPUESTA',
                                        'htmlOptions'=>array( 'width'=>'250','style'=>'text-align: rigth',)													 						
                                    ), 
                                'ACSO_FUENTE',
                                'ACSO_ESTADOPM',										                               
                                array('name'=>'ACSO_URL',
                                        'header'=>'FUENTE',
                                        'type'=>'raw', //sierve para reconocer textos de programacion php en e//"imageUrl" => Yii::app()->request->baseUrl . "/images/ir.png",	 
                                        'value'=>'CHtml::link(Acreditacionsoportes::getEstadoRuta($data["ACSO_URL"]),
                                              $data["ACSO_URL"], 
                                              Acreditacionsoportes::getEstadoRuta($data["ACSO_URL"])=="PENDIENTE"? array("target"=>"_self") : array("target"=>"_blank")																				
                                            )',
                                         'htmlOptions'=>array('width'=>'50','style'=>'text-align: center')													 
                                    ),  //'ACSO_URL',
                                array('class'=>'bootstrap.widgets.TbButtonColumn')
                                ),
                    )
					);
				?>
            </td>
     </tr>
</table>
     