<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/contratacion/opscpanel/index');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('opscpanel/'),
	'Admin Ops',
);

$Usuario = Usuario::model()->findByPk(Yii::app()->user->id);
//$supervisor = $Usuario->USUA_ID;
$IdUsuario = $Usuario->USUA_ID;

$criteria = new CDbCriteria;
$criteria->condition = 'USUA_ID = '.$Usuario->USUA_ID;
$Usuarioperfilusuario = Usuarioperfilusuario::model()->find($criteria);

$UsuarioPerfil = Usuarioperfilusuario::model()->findByPk($Usuarioperfilusuario->USPU_ID);
$Perfil = $UsuarioPerfil->USPE_ID;

?>
<table width="75%" border="0" align="center">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "ORDENES DE PRESTACIÓN DE SERVICIOS ADMINISTRATIVOS Y TECNICOS"; ?></h4>
    </fieldset>
    </td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
   <table width="98%" height="110" border="0" align="center">
                      <tr>
                        <th colspan="9"><hr /></th>
                      </tr>
                      <tr align="center">
                        <td width="15%" >
    <?php
	if((($Perfil==18) or	 ($Perfil==29)) or ($Perfil==30)){	 	 			
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_supe.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Supervisores');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/opscontratos/adminSupervisores/'),$htmlOptions ); 
	
	?>                    
      <td width="3%" scope="col">&nbsp;</td>
      <td width="20%" scope="col">&nbsp;</td>
      <td width="3%" scope="col">&nbsp;</td>
      <td width="20%" scope="col">&nbsp;</td>
      <td width="3%" scope="col">&nbsp;</td>
      <td width="20%" scope="col">&nbsp;</td>
      <td width="3%" scope="col">&nbsp;</td>
      <td width="20%" scope="col">&nbsp;</td>
                                         
	<?php
	}else{
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_cont.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/opscontratos/admin',),$htmlOptions ); 
	?></td>
                        <td width="3%" scope="col">&nbsp;</td>
                        <td width="21%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_pres.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Presupuestos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/opspresupuestos/admin',),$htmlOptions ); 
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personas en Base de Datos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/personasnaturales/admin',),$htmlOptions ); 
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="21%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_pres_adic.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Presupuestos Para Adicionales');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/adicionalespresupuestos/admin',),$htmlOptions ); 
	?></td>
                        <td width="3%" scope="col">&nbsp;</td>
                        <td width="10%" scope="col"><?php
	//}else{
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_cont_adic.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Adicionales Para Contratos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/contratosadicionales/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_jfdep.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Jefes de Dependencia
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/jefesdependencias/admin',),$htmlOptions ); 
	?></td>
                        <td>&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_dep.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Dependencias');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/dependencias/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_informes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Impresion de Informes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/informes/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contrt.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratantes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/contratantes/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_anca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Años Academicos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/aniosacademicos/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="14" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_sedes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Sedes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/sedes/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_serv.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Objetos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/opsobjetos/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal CONTRATACION');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/contratacion',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_salar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Valor del SMMLV');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/salariosminimos/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Estudios');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/estudios/admin',),$htmlOptions ); 
	}
	?></td>
                      </tr>
                      <tr>
                        <td height="6" colspan="9"><hr /></td>
                      </tr>
        </table> 
    </fieldset>
    </td>
  </tr>
</table>
