<?php

class OpspresupuestosController extends Controller
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
		 //echo "<br><br><br>".$Usuario->USUA_USUARIO;
         //'download','clasesc'
         return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''.$array[0].'',''.$array[1].'',''.$array[2].'',''.$array[3].'',''.$array[4].'',''.$array[5].'',
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].''),
				'users'=>array($Usuario->USUA_USUARIO),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),	
		 );
	   }else{
		     return array(			
			  array('deny',  // deny all users
				'users'=>array('*'),
			  ),	
		     );
			}
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
		$Presupuestos = new Presupuestos;
		$Opspresupuestos = new Opspresupuestos;
		$FormatoFechas = new FormatearFechas();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Presupuestos']))
		{
			$Presupuestos->attributes=$_POST['Presupuestos'];
			$certificado = $Presupuestos->attributes['PRES_NUM_CERTIFICADO'];
			$fecha = $Presupuestos->attributes['PRES_FECHA_VIGENCIA'];
			$seccion = $Presupuestos->attributes['PRES_SECCION'];
			$codigo = $Presupuestos->attributes['PRES_CODIGO'];
			$FormatoFechas->fechaLarga($fecha);
			$nombre = "No. ".$certificado.", del ".$FormatoFechas->fecha." Seccion ".$seccion." codigo ".$codigo;
	              $Presupuestos->PRES_NOMBRE = $nombre;
                     $Presupuestos->PRES_FECHA_INGRESO = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_INGRESO"];
			
			if($Presupuestos->save()){
				$lastData = $Presupuestos->loadLastData();
				$Opspresupuestos->PRES_ID = $lastData->PRES_ID;
				$Opspresupuestos->OPPR_FECHA_INGRESO = $lastData->PRES_FECHA_INGRESO; 
				if($Opspresupuestos->save()){
				 $this->redirect(array('admin',));
				 Yii::app()->user->setFlash('success','<strong>Hecho!. </strong>Exito actualizando el presupuesto...');
				}else{
			          Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Error creando el presupuesto - ops...');
			         }
			}else{
			       Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Error creando el presupuesto...');
			     }
		}
		$this->render('create',array('model'=>$Presupuestos,'Opspresupuestos'=>$Opspresupuestos));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{	
		$Opspresupuestos = new Opspresupuestos;
		$Opspresupuestos = $this->loadModel($id);
		$Presupuestos = Presupuestos::model()->findByPk($Opspresupuestos->PRES_ID);
		
		$FormatoFechas = new FormatearFechas();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Presupuestos']))
		{
			$Presupuestos->attributes=$_POST['Presupuestos'];
			$certificado = $Presupuestos->attributes['PRES_NUM_CERTIFICADO'];
			$fecha = $Presupuestos->attributes['PRES_FECHA_VIGENCIA'];
			$seccion = $Presupuestos->attributes['PRES_SECCION'];
			$codigo = $Presupuestos->attributes['PRES_CODIGO'];
			$FormatoFechas->fechaLarga($fecha);
			$nombre = "No. ".$certificado.", del ".$FormatoFechas->fecha." Seccion ".$seccion." codigo ".$codigo;
	        $Presupuestos->PRES_NOMBRE = $nombre;
			
			if($Presupuestos->save()){
				 $this->redirect(array('admin',));
			}else{
			       Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Error actualizando el presupuesto...');
			     }
		}

		$this->render('update',array(
			'model'=>$Presupuestos,
			'Opspresupuestos'=>$Opspresupuestos,
		));
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
		$dataProvider=new CActiveDataProvider('Opspresupuestos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Opspresupuestos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Opspresupuestos']))
			$model->attributes=$_GET['Opspresupuestos'];

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
		$model=Opspresupuestos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Opspresupuestos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
