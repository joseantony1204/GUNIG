<?php

class AcreditacionbitacorasController extends Controller
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
                                 ''.$array[6].'',''.$array[7].'',  
                                 ),
				'users'=>array($Usuario->USUA_USUARIO),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),	
		);
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
		$model=new acreditacionbitacoras;
		$model_acredi=new acreditaciones;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_GET['PROGRAMA'])){ 
			$model->ACPR_ID = $_GET['PROGRAMA'];
			$model->ACPR_NUMERO=$this->contar_grupos($model->ACPR_ID);
		}
		
		if(isset($_POST['acreditacionbitacoras']))
		{
			$model->attributes=$_POST['acreditacionbitacoras'];
			if($model->save()){ $this->numerar_grupos();	
				$this->redirect(array('view','id'=>$model->ACBI_ID));
			}
		}
		$model->ACBI_FECHA=date('y-m-d');
		$model->ACBI_NUMERO=acreditacionbitacoras::model()->count()+1;
		$model->ACBI_NUMERO=Yii::app()->db->getLastInsertID('ACREDITACIONBITACORAS'); 
		 $this->render('create',array(
			'model'=>$model,'model_acredi'=>$model_acredi,
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

		if(isset($_POST['acreditacionbitacoras']))
		{
			$model->attributes=$_POST['acreditacionbitacoras'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ACBI_ID));
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
			$this->numerar_grupos();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function numerar_grupos() //funciona ok
	{	$criterio = array('order'=>'ACPR_ID ASC');
		$modelos=acreditacionbitacoras::model()->findAll($criterio);
		$k=1;//count(*)
		$var='';
		foreach($modelos as $model){
			if($var==$model['ACPR_ID']){
				$k = $k + 1;
			}else{
				$k=1;
			}
			$sql = 'UPDATE TBL_ACREDITACIONBITACORAS SET ACBI_NUMERO = '.$k.' WHERE ACBI_ID = '.$model['ACBI_ID'];	
			$connection = Yii::app()->db;			
			$connection->createCommand($sql)->execute();							
			$var=$model['ACPR_ID'];			
		}
	}
	
	public function actioncargar_numero(){
		if(isset($_GET['id'])){ 
			$id_clave = $_GET['id'];
			$num=$this->contar_grupos($id_clave);
		}else{
				$num='';
			}
		echo json_encode(array('num'=>$num+1));		
	}
	
	public function contar_grupos($id_clave) //funciona ok
	{	$criteria=new CDbCriteria;
		$criteria->compare('ACPR_ID',$id_clave);
		$grupo=acreditacionbitacoras::model()->findAll($criteria);					
		return(count($grupo));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('acreditacionbitacoras');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/** 
	 * Manages all models.
	 */
	
	public function actionAdmin()
	{
		$model=new acreditacionbitacoras('search');		
		$model->unsetAttributes();  // clear any default values	
		if(isset($_GET['acreditacionbitacoras']))
			$model->attributes=$_GET['acreditacionbitacoras'];
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
		$model=acreditacionbitacoras::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='acreditacionbitacoras-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}