<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/contratacion/contratacioncpanel/index');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion',
);
?>

<?php 
$Usuario = Usuario::model()->findByPk(Yii::app()->user->id);
//$supervisor = $Usuario->USUA_ID;
$IdUsuario = $Usuario->USUA_ID;

$criteria = new CDbCriteria;
$criteria->condition = 'USUA_ID = '.$Usuario->USUA_ID;
$Usuarioperfilusuario = Usuarioperfilusuario::model()->find($criteria);

$UsuarioPerfil = Usuarioperfilusuario::model()->findByPk($Usuarioperfilusuario->USPU_ID);
$Perfil = $UsuarioPerfil->USPE_ID;
//$Perfil = Personas::model()->findByPk($Personasnaturales->PERS_ID);



//$Usuario = $model->rel_contrato->CONT_NUMORDEN; 
//$tipo = $model->rel_contrato->tICO->TICO_NOMBRE;
//$clase = $model->rel_contrato->cLCO->CLCO_NOMBRE;
//$anio = $model->rel_contrato->CONT_ANIO; 
?>


<table width="75%" border="0" align="center">
  <tr>
    <td>
    <fieldset>
    <table  width="100%" border="0">
  	<tr>
    <td width="17%" height="75%" align="left">
    <?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?>   
    </td>
    <td width="64%" height="75%" align="center">  
    <h4><?php echo "CPANEL - ADMINISTRACIÓN DE CONTRATACIÓN"; ?></h4>
    </td>
    <td width="8%" height="10%" align="right">&nbsp;</td>
    <td width="8%" height="10%" align="right"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal CONTRATACION');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/contratacion',),$htmlOptions ); 
	?></td>  
	</tr>
	</table>

    
    </fieldset>
  
         
    
    </td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
   <table width="98%" height="119" border="0" align="center">
                      <tr>
                        <th colspan="7"><hr /></th>
                      </tr>
                      <tr align="center">
                        <td width="20%" ><?php
			 if( ($Perfil==1) or
			 	 ($Perfil==13)or
			 	 ($Perfil==25) or
			 	 ($Perfil==19) or
			 	 ($Perfil==29)){				
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_cont.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/admin',),$htmlOptions ); 
			 }
						 ?>
                        <?php
						if(($Perfil==18)){	 
	 //$Usuario = Usuario::model()->findByPk(Yii::app()->user->id);
	 //$supervisor = $Usuario->USUA_ID;
	 			
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_supe.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Supervisores');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/adminsupervisores/'),$htmlOptions ); 
				 }
	?>
    
    <?php 
					if ($Perfil==17){	
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_informes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/informes/admin',),$htmlOptions ); 
				 }
	?>
    
    </td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
					if( ($Perfil==1) or
			 	 ($Perfil==13)or
			 	 ($Perfil==25)or
			 	 ($Perfil==19) or
			 	 ($Perfil==29)){	
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personas en Base de Datos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/personasnaturales/admin',),$htmlOptions ); 
				 }
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
						if( ($Perfil==1) or
			 	 ($Perfil==13)or
			 	 ($Perfil==25)or
			 	 ($Perfil==19) or
			 	 ($Perfil==29)){	
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_emp.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Empresas en Base de Datos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/personasjuridicas/admin',),$htmlOptions ); 
				 }
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
						if( ($Perfil==1) or
			 	 ($Perfil==13)or
			 	 ($Perfil==25)or
			 	 ($Perfil==19) or
			 	 ($Perfil==29)){	
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contrt.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratantes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/resolucionesacuerdos/admin',),$htmlOptions ); 
				 }
	?></td>
                      </tr>
                      <tr>
                        <td height="14" colspan="7"></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php 
					if( ($Perfil==1) or
			 	 ($Perfil==13)or
			 	 ($Perfil==25)or
			 	 ($Perfil==19) or
			 	 ($Perfil==29)){	
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_informes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/informes/admin',),$htmlOptions ); 
				 }
	?></td>
                        <td>&nbsp;</td>
                        <td align="center"><?php
						if( ($Perfil==1) or
			 	 ($Perfil==29)){	
						//echo $Perfil; 
	 //$Usuario = Usuario::model()->findByPk(Yii::app()->user->id);
	 //$supervisor = $Usuario->USUA_ID;
	 			
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_supe.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Supervisores');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/adminsupervisores/'),$htmlOptions ); 
				 }
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14" colspan="7"></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php /*
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_contratoria.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de Contratatación para la Contraloría');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/informes/contraloria',),$htmlOptions ); 
	*/?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="6" colspan="7"><hr /></td>
                      </tr>
                    </table> 
    </fieldset>
    </td>
  </tr>
</table>
