<?php

class LiqudescauditoriaController extends Controller
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
	 
	 /*
	 
	public function actionCreate()
	{
		$model=new Liqudescauditoria;
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$model->LIQU_ID = 559;
		
		$model->USUA_ID=$Usuarios->USUA_ID;
		$model->LDAU_ACCION = 'INSERT';
		
		$model->LDAU_FECHAPROCESO = date("Y-m-d").' '.date("h:i:s");
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Liqudescauditoria']))
		{
			$model->attributes=$_POST['Liqudescauditoria'];														
			$Descuentos = $model->Descuentos($model->LIQU_ID);			
			
			foreach($Descuentos as $desc){						
					$model=new Liqudescauditoria;										
					$model->DESC_ID = $desc['DESC_ID'];
					$model->LDAU_TARIFA = $desc['LIDE_TARIFA'];									
					$model->attributes=$_POST['Liqudescauditoria'];				
					$model->save();								
			}	
			
					
					$this->redirect(array('admin','id'=>$model->LDAU_ID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	
	*/
	
	
	
	
	
	
	
	
	public function actionCreate($id, $action)
	{
		$model=new Liqudescauditoria;		
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$model->LIQU_ID = $id;		
		$Liquidaciones=Liquidaciones::model()->findByPk($model->LIQU_ID);		
					
			/*if(isset($_POST['Liqudescauditoria'])){*/
			$model->attributes=$_POST['Liqudescauditoria'];														
			
			$Descuentos = $model->Descuentos($model->LIQU_ID);			
			
			foreach($Descuentos as $desc){						
					$model=new Liqudescauditoria;	
					$model->LDAU_FECHAPROCESO = date("Y-m-d").' '.date("h:i:s");					
					$model->USUA_ID=$Usuarios->USUA_ID;
					$model->LDAU_ACCION=$action;
					$model->LIQU_ID = $id;									
					$model->DESC_ID = $desc['DESC_ID'];
					$model->LDAU_TARIFA = $desc['LIDE_TARIFA'];									
					$model->attributes=$_POST['Liqudescauditoria'];				
					$model->save();								
			}				
			$this->redirect(array('segcuenta/seguimientocuentas/create','id'=>$Liquidaciones->CUEN_ID));
					//$this->redirect(array('admin','id'=>$model->LDAU_ID));}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	
	
	
	
	
	

	
	
	
	
	
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Liqudescauditoria']))
		{
			$model->attributes=$_POST['Liqudescauditoria'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->LDAU_ID));
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('Liqudescauditoria');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	 
	public function actionAdmin($id)
	{
		$model=new Liqudescauditoria('search');
		$model->unsetAttributes();  // clear any default values
		$liquidacion=$model->loadLiquidacion($id);
		if(isset($_GET['Actasvecindad'])){
			$model->attributes=$_GET['Liqudescauditoria'];
			 Yii::app()->user->getState('LiqudescauditoriaSearchParams',$_GET['Liqudescauditoria']);	
		}
		$model->LIQU_ID = $liquidacion;
		$this->render('admin',array('model'=>$model,));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Liqudescauditoria::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='liqudescauditoria-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
