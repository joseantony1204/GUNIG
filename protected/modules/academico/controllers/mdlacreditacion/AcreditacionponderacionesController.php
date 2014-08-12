<?php

class AcreditacionponderacionesController extends Controller
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
                                 ''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'',
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
		$model=new acreditacionponderaciones;
		$model_acredi=new acreditaciones;


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['acreditacionponderaciones']))
		{
			$model->attributes=$_POST['acreditacionponderaciones'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ACCP_ID));
		}
	
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
		$model_acredi=new acreditaciones;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['acreditacionponderaciones']))
		{
			$model->attributes=$_POST['acreditacionponderaciones'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ACCP_ID));
		}

		$this->render('update',array(
			'model'=>$model,'model_acredi'=>$model_acredi,
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
		$dataProvider=new CActiveDataProvider('acreditacionponderaciones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new acreditacionponderaciones('search');
		$model_acredi=new acreditaciones;
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['acreditacionponderaciones']))
			$model->attributes=$_GET['acreditacionponderaciones'];

		$this->render('admin',array(
				'model'=>$model,'model_acredi'=>$model_acredi,
	));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=acreditacionponderaciones::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='acreditacionponderaciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actioncargar_bitacoras(){ 
		$id = $_POST['acreditaciones']['ACPR_ID']; 		
		$sql =  "SELECT ACBI_ID, CONCAT('Bitacora ', ACBI_NUMERO,': ',ACBI_FECHA) DATO FROM TBL_ACREDITACIONBITACORAS WHERE ACPR_ID = '$id'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryAll();
		$lista=CHtml::listData($query, 'ACBI_ID',  'DATO' );
		echo CHtml::tag('option', array('value' => ''), 'Seleccione ...', true);       
		foreach($lista as $clave => $dato){
			echo CHtml::tag('option',array('value'=>$clave), CHtml::encode($dato), true);
		}	
	}

	public function actioncargar_factores(){
		$id = $_POST['acreditaciones']['ACBI_ID'];
		$sql =  "SELECT ACFA_ID, CONCAT('Factor ', ACFA_NUMERO,': ',ACFA_DESCRIPCION) DATO FROM TBL_ACREDITACIONFACTORES WHERE ACBI_ID = '$id'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryAll();
		$lista=CHtml::listData($query, 'ACFA_ID',  'DATO' );//,  'ACBI_NUMERO' la clave del array lista es el ACBI_ID 'ACBI_FECHA', <script>alert('ok')  </ script>				
		echo CHtml::tag('option', array('value' => ''), 'Seleccione ...', true);       		
		foreach($lista as $clave => $dato){
			echo CHtml::tag('option',array('value'=>$clave), CHtml::encode($dato),true);
		}		
	}
	
	public function actioncargar_caracteristicas(){
		$id = $_POST['acreditaciones']['ACFA_ID'];
		$sql =  "SELECT ACCA_ID, CONCAT('Caracteristica ', ACCA_NUMERO,': ',ACCA_DESCRIPCION) DATO FROM TBL_ACREDITACIONCARACTERISTICAS WHERE ACFA_ID = '$id'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryAll();
		$lista=CHtml::listData($query, 'ACCA_ID',  'DATO' );//,  'ACBI_NUMERO' la clave del array lista es el ACBI_ID 'ACBI_FECHA', <script>alert('ok')  </ script>				
		echo CHtml::tag('option', array('value' => ''), 'Seleccione ...', true);       		
		foreach($lista as $clave => $dato){
			echo CHtml::tag('option',array('value'=>$clave), CHtml::encode($dato),true);
		}		
	}

	public function actioncargar_modeloponderacion(){ //actualizacion de datagrip
		$model=new acreditacionponderaciones;
		$model_acredi=new acreditaciones;
		if(isset($_POST['acreditaciones'])){	
			$model_acredi->attributes=$_POST['acreditaciones'];
			 $model->ACCA_ID = $model_acredi->ACCA_ID; 
		}		
		echo $this->renderPartial('_admin', array('model'=>$model));					  
	}
	
	public function actioncargar_ponderacion(){ 
		$model=new acreditacionponderaciones;
		$model_acredi=new acreditaciones;
		if(isset($_POST['acreditaciones'])){
			$model_acredi->attributes=$_POST['acreditaciones'];
			 $model=$this->loadModel($model_acredi->ACCA_ID);
		}		
		echo $this->renderPartial('_create', array('model'=>$model));					  
	}
	

}
