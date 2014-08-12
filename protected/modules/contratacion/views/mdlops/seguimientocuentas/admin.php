<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Contratos'=>array('mdlops/opscontratos/adminSupervisores'),
	'Cuentas'=>array('mdlops/cuentas/admin','id'=>$Cuentas->CONT_ID),
	'Seguimiento Cuenta'=>array('admin','id'=>$model->CUEN_ID),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('seguimientocuentas-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="80%" border="0" align="left">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td>
        <fieldset>
          <table width="100%" border="0" align="center">
            <tr>
              <td width="6%" align="center">
              <?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
              </td>
             <td width="74%"><strong><span><em>ADMINISTRACION DE SEGUIMIENTO DE CUENTAS</em></span></strong></td>

<td width="10%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/cuentas/admin','id'=>$Cuentas->CONT_ID),$htmlOptions ); 
?></td>

<td width="10%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/seguimientocuentas/admin','id'=>$model->CUEN_ID),$htmlOptions ); 
?></td>
            </tr>
          </table>
          </fieldset>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td> </br></br></br>
<?php 
$Dependencias = array(1=>"Talento Humano </br> ó Contratación", 2=>"</br>Trámite Cuentas", 3=>"</br>Contabilidad", 4=>"</br>Presupuesto", 
                      5=>"V. Administrativa </br> y Financiera", 6=>"</br>Tesorería");
$Dependencia = array(1=>"1", 2=>"49", 3=>"17", 4=>"18", 5=>"8", 6=>"4");					  
					  
$DepIconosDef = array(1=>"11.png", 2=>"12.png", 3=>"12.png", 4=>"12.png", 5=>"12.png", 6=>"13.png");
$DepIconosSeg = array(1=>"01.png", 2=>"02.png", 3=>"02.png", 4=>"02.png", 5=>"02.png", 6=>"03.png");
$DepIconosDev = array(1=>"21.png", 2=>"22.png", 3=>"22.png", 4=>"22.png", 5=>"22.png", 6=>"23.png");			  

echo 
'
 <table width="100%" border="0" align="center">
  <tr>';
  for($i=1; $i<=6; $i++){			 
   $dependencia = $Dependencias[$i];
   $seguimiento = $model->searchSeguimiento($model->CUEN_ID, $Dependencia[$i]);
   if($seguimiento!=""){
    $Seguimientocuentas = Seguimientocuentas::model()->findByPk($seguimiento);
     if($Seguimientocuentas->SECU_ESTADO ==0){
      $icon = $DepIconosSeg[$i];
	  $url = "mdlops/seguimientocuentas/admin/id/".$model->CUEN_ID;
	  $detalles = "Cuenta tramitada con exito.";
     }else{
	       $icon = $DepIconosDev[$i];
		   $url = "mdlops/devolucionescuentas/admin/id/".$Seguimientocuentas->SECU_ID;
		   $detalles = "La cuenta ha tenido inconvenientes y a sido devuelta. Ir a Detalles?";
		  }
   }else{
	     $icon = $DepIconosDef[$i];
		 $url = "mdlops/seguimientocuentas/admin/id/".$model->CUEN_ID;
		 $detalles = "Sin nada que decir";
		}
   
   $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/cuenta/img/'.$icon.'';	
   $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => $detalles);
   $image = CHtml::image($imageUrl);
   
   echo'
   <td>
    
	 <table width="100%" border="0" align="center">
	  <thead>
	  <tr>	
	   <td align="center"><strong>'.CHtml::link($image, array($url,),$htmlOptions ).'</strong></td>
      </tr>';
      echo'      
	  <tr>	
		<td align="center"><div align="center"><strong>'.$dependencia .'</strong></div></td>
      </tr>
	  </thead>
     </table>
	</td>';
   } 
echo'
  </tr>
 </table>';

?>
   </td>
  </tr>
</table>
