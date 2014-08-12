<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/contratacion/tutoriascpanel/index');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias',
);

$Usuario = Usuario::model()->findByPk(Yii::app()->user->id);
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
    <h4><?php echo "ORDENES DE PRESTACIÓN DE SERVICIOS  DOCENTES TUTORES"; ?></h4>
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
	if(($Perfil==18) or	 ($Perfil==29)){	 	 			
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_supe.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Supervisores');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/tutoriascontratos/adminSupervisores/'),$htmlOptions ); 
	
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
	 echo CHtml::link($image, array('mdltutorias/tutoriascontratos/admin',),$htmlOptions ); 
	?></td>
                        <td width="3%" scope="col">&nbsp;</td>
                        <td width="21%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_sp.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Sub Programas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/tutoriassubprogramas/admin',),$htmlOptions ); 
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personas en Base de Datos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/personasnaturales/admin',),$htmlOptions ); 
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="21%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contrt.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratantes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/contratantes/admin',),$htmlOptions ); 
	?></td>
                        <td width="3%" scope="col">&nbsp;</td>
                        <td width="10%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_mod.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Modulos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/modulos/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_prog.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Programas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/tutoriasprogramas/admin',),$htmlOptions ); 
	?></td>
                        <td>&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Estudios');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/estudios/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_informes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Impresion de Informes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/informes/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_pres.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Presupuestos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/tutoriaspresupuestos/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_paca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Periodos Academicos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/periodosacademicos/admin',),$htmlOptions ); 
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
	 echo CHtml::link($image, array('mdltutorias/sedes/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal CONTRATACION');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/contratacion',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_horas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Valor de Horas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/tutoriasvalorhora/admin',),$htmlOptions ); 
	}?></td>
                      </tr>
                      <tr>
                        <td height="6" colspan="9"><hr /></td>
                      </tr>
                    </table> 
    </fieldset>
    </td>
  </tr>
</table>
