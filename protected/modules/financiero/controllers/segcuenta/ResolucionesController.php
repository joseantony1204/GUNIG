<?php

class ResolucionesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
	  if(!Yii::app()->user->getIsGuest())
      {
		$Usuario = Usuarios::model()->findByPk(Yii::app()->user->id);
		$curpage = Yii::app()->getController()->id;
		$controllers = explode('/',$curpage);
		
		$modulos = Yii::app()->user->modulosUsuarios;
		$views = Yii::app()->user->viewsAccesoUsuario($this->module->id,$controllers[0],$controllers[1]);
		foreach($views as $data){
		 $array[] = $data['USVI_URL'];
		}
        return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''.$array[0].'',''.$array[1].'',''.$array[2].'',''.$array[3].'',''.$array[4].'',''.$array[5].'',
                                 ''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'',  
                                 ),
				'users'=>array($Usuario->USUA_USUARIO),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),	
		);
	  }else{ return array( array('deny','users'=>array('*'),),);}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$Resoluciones=new Resoluciones;
		$Presupuestos = new Presupuestos;
		$Presupuestosresoluciones = new Presupuestosresoluciones;
		$Resolucionesliquidaciones = new Resolucionesliquidaciones;
		$FormatoFechas = new FormatearFechas();
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);

		if(isset($_POST['Resoluciones']))
		{
			$Resoluciones->attributes=$_POST['Resoluciones'];
			$Resoluciones->PERS_ID = $_POST['PERS_ID'];
			$Resoluciones->USUA_INSERT=$Usuarios->USUA_ID;
			if($Resoluciones->save()){			
				
					
				$Resolucionesliquidaciones->attributes=$_POST['Resolucionesliquidaciones'];		
				$Resolucionesliquidaciones->RESO_ID = $Resoluciones->loadLastDatas();			
				
				if($Resolucionesliquidaciones->save()){				
			
					$Presupuestos->attributes=$_POST['Presupuestos'];
					$certificado = $Presupuestos->attributes['PRES_NUM_CERTIFICADO'];
					$fecha = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_VIGENCIA"];
					$seccion = $Presupuestos->attributes['PRES_SECCION'];
					$codigo = $Presupuestos->attributes['PRES_CODIGO'];
					$FormatoFechas->fechaLarga($fecha);
					$Presupuestos->PRES_FECHA_INGRESO = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_INGRESO"];
					$nombre = "No. ".$certificado.", del ".$FormatoFechas->fecha." Seccion ".$seccion." codigo ".$codigo;
					$Presupuestos->PRES_NOMBRE = $nombre; 
									 
					if($Presupuestos->save()){
							$Pres = $Presupuestos->loadLastDatas();
													
							$Presupuestosresoluciones->attributes=$_POST['Presupuestosordenes'];
							$Presupuestosresoluciones->RESO_ID = $Resoluciones->loadLastDatas();
							$Presupuestosresoluciones->PRES_ID = $Pres->PRES_ID;
							
							if($Presupuestosresoluciones->save()){
							
							}else{
									throw new CHttpException(400,'ERROR AL CREAR UNA RESOLUCION');
			    			 }
			
					}
					
				}
			}
		
		
	
			if($Resolucionesliquidaciones->CLRE_ID==1){				
				$this->redirect(array('descuento','id'=>$Resolucionesliquidaciones->RELI_ID));			
			}else{ $this->redirect(array('admin','id'=>$Resolucionesliquidaciones->RELI_ID));}
			
		}

		$this->render('create',array(
			'Resoluciones'=>$Resoluciones,
			'Presupuestos'=>$Presupuestos,
			'Presupuestosresoluciones'=>$Presupuestosresoluciones,
			'Resolucionesliquidaciones'=>$Resolucionesliquidaciones,
			
		));
	}

		 
	 
	 public function actionDescuento($id)
	{
		$Resolucionesliquidaciones=$this->loadModelo($id);
		$Resolucionesliquidaciones->RELI_ID = $id;
		
		if(isset($_POST['Resolucionesliquidaciones']))
		{			
			$Resolucionesliquidaciones->attributes=$_POST['Resolucionesliquidaciones'];		
			$Resolucionesliquidaciones->DEAT_ID  = $_POST['DEAT_ID'];
			$Resolucionesliquidaciones->DEAT_IDD = $_POST['DEAT_IDD'];
			$Resolucionesliquidaciones->RELI_EJECUTADO = $_POST['Resolucionesliquidaciones']['RELI_EJECUTADO'];
			$Resolucionesliquidaciones->RELI_UTILIDAD = $_POST['Resolucionesliquidaciones']['RELI_UTILIDAD'];
			$Resolucionesliquidaciones->RELI_AMOTIZACION = $_POST['Resolucionesliquidaciones']['RELI_AMOTIZACION'];
			$Resolucionesliquidaciones->RELI_IVA = $_POST['Resolucionesliquidaciones']['RELI_IVA'];
			
			if($Resolucionesliquidaciones->save()){
							$Anio = $Resolucionesliquidaciones->Anio($id);					
							$Salario = $Resolucionesliquidaciones->SalarioMinimo($Anio);
							$Dato = $_POST['DEAT_ID'];
							$Dato1 = $_POST['DEAT_IDD'];
							
							$Descuentoatributos = $Resolucionesliquidaciones->loadDescuentos($Anio, $id, $Salario, $Dato, $Dato1);
							
							foreach($Descuentoatributos as $desc){						
								$resolucionesdescuentos=new Resolucionesdescuentos;						
								$resolucionesdescuentos->DESC_ID = $desc['DESC_ID'];
								$resolucionesdescuentos->REDE_TARIFA = $desc['DEAT_VALOR'];
								$resolucionesdescuentos->RELI_ID = $Resolucionesliquidaciones->RELI_ID;	
								$resolucionesdescuentos->attributes=$_POST['resolucionesdescuentos'];					
								$resolucionesdescuentos->save();							
							}			
			}
				$this->redirect(array('admin',));
		}
		$this->render('descuento',array(
			'Resolucionesliquidaciones'=>$Resolucionesliquidaciones,
		));
	}
	 
	 
	 
	 
	public function actionUpdate($id)
	{
		$Resoluciones=$this->loadModel($id);
		
		$Resolucionesliquidaciones = Resolucionesliquidaciones::model()->findByPk($Resoluciones->loadLastDato($id));
		$Presupuestosresoluciones = Presupuestosresoluciones::model()->findByPk($Resoluciones->presupuestoliquidacion($id));
		$Presupuestos = Presupuestos::model()->findByPk($Presupuestosresoluciones->PRES_ID);
	/*	
		$FormatoFechas = new FormatearFechas();
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);	
		$Resoluciones->RESO_ID = $id;
		
		if(isset($_POST['Resoluciones']))
		{
			$Resoluciones->attributes=$_POST['Resoluciones'];
			$Resoluciones->PERS_ID = $_POST['PERS_ID'];
			$Resoluciones->USUA_UPDATE=$Usuarios->USUA_ID;
			if($Resoluciones->save()){
				
				
				
				$Resolucionesliquidaciones->attributes=$_POST['Resolucionesliquidaciones'];		
				$Resolucionesliquidaciones->RELI_VALOR = $_POST['Resolucionesliquidaciones']['RELI_VALOR'];
				$Resolucionesliquidaciones->RELI_ID = $Resoluciones->loadLastDato($id);	
				
				if($Resolucionesliquidaciones->save()){
				
				
					//$elimina = $Resoluciones->eliminaPresupuesto($id);
					
						$Presupuestos->attributes=$_POST['Presupuestos'];
						$certificado = $Presupuestos->attributes['PRES_NUM_CERTIFICADO'];
						$fecha = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_VIGENCIA"];
						$seccion = $Presupuestos->attributes['PRES_SECCION'];
						$codigo = $Presupuestos->attributes['PRES_CODIGO'];
						$FormatoFechas->fechaLarga($fecha);
						$Presupuestos->PRES_FECHA_INGRESO = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_INGRESO"];
						$nombre = "No. ".$certificado.", del ".$FormatoFechas->fecha." Seccion ".$seccion." codigo ".$codigo;
						$Presupuestos->PRES_NOMBRE = $nombre; 
										
						if($Presupuestos->save()){
								$Pres = $Presupuestos->loadLastData();
								$Reso = $Resoluciones->loadLastData($id);
								$Presupuestosresoluciones->attributes=$_POST['Presupuestosordenes'];
								$Presupuestosresoluciones->RESO_ID = $Reso->RESO_ID;
								$Presupuestosresoluciones->PRES_ID = $Pres->PRES_ID;
								
								if($Presupuestosresoluciones->save()){
								
								}else{
										throw new CHttpException(400,'ERROR AL CREAR UNA RESOLUCION');
								 }					
						}
				  }
			}
		
		
		
			if($Resolucionesliquidaciones->CLRE_ID==1){			
				$elimina = $Resoluciones->eliminaDescuentos($id);			
				$this->redirect(array('descuento','id'=>$Resolucionesliquidaciones->RELI_ID));			
			}else{ $this->redirect(array('admin','id'=>$Resoluciones->RESO_ID));}
			
		}

		$this->render('update',array(
			'Resoluciones'=>$Resoluciones,
			'Presupuestos'=>$Presupuestos,
			'Resolucionesliquidaciones'=>$Resolucionesliquidaciones,
			'Presupuestosresoluciones'=>$Presupuestosresoluciones,
		));*/
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Resoluciones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Resoluciones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Resoluciones']))
			$model->attributes=$_GET['Resoluciones'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Resoluciones::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	public function loadModelo($id)
	{
		$model=Resolucionesliquidaciones::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='resoluciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionDownload($id)
	{
	 $model=Resoluciones::model()->findByPk($id);
	 $this->render('download',array('model'=>$model,'id'=>$model->RESO_ID));
    }
	
	
}
