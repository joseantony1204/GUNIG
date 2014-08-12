<?php

class AcreditacionesController extends Controller
{
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


	//acciones para select
	/*$criteria = new CDbCriteria();
        $criteria->condition = 'ACPR_ID = :id';
        $criteria->params = array(':id' => (int) $id);
        $criteria->order = 'ACPR_ID ASC';
		$criteria->select = 'ACBI_ID, CONCAT(ACBI_NUMERO," ",ACBI_FECHA) DATO';*/
	/*
	public function actionCargar_bitacoras(){
		$id = $_POST['acreditaciones']['ACPR_ID']; //ok
		
		$sql =  "SELECT ACBI_ID, CONCAT('Bitacora ', ACBI_NUMERO,': ',ACBI_FECHA) DATO FROM TBL_ACREDITACIONBITACORAS WHERE ACPR_ID = '$id'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryAll();
		//$lista=acreditacionbitacoras::model()->findAll($criteria);
		$lista=CHtml::listData($query, 'ACBI_ID',  'DATO' );//,  'ACBI_NUMERO' la clave del array lista es el ACBI_ID 'ACBI_FECHA', <script>alert('ok')  </ script>		
		echo CHtml::tag('option', array('value' => ''), 'Seleccione ...', true);       
		foreach($lista as $clave => $dato){
			echo CHtml::tag('option',array('value'=>$clave), CHtml::encode($dato), true);
		}	
	}*/
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
	
	public function actioncargar_aspectos(){
		$id = $_POST['acreditaciones']['ACCA_ID'];
		$sql =  "SELECT ACAS_ID, CONCAT('Aspecto ', ACAS_NUMERO,': ',ACAS_DESCRIPCION) DATO FROM TBL_ACREDITACIONASPECTOS WHERE ACCA_ID = '$id'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryAll();
		$lista=CHtml::listData($query, 'ACAS_ID',  'DATO' );//,  'ACBI_NUMERO' la clave del array lista es el ACBI_ID 'ACBI_FECHA', <script>alert('ok')  </ script>				
		echo CHtml::tag('option', array('value' => ''), 'Seleccione ...', true);       		
		foreach($lista as $clave => $dato){
			echo CHtml::tag('option',array('value'=>$clave), CHtml::encode($dato),true);
		}		
	}
	
	public function actioncargar_indicadores(){
		$id = $_POST['acreditaciones']['ACAS_ID'];
		$sql =  "SELECT ACIN_ID, CONCAT('Indicador ', ACIN_NUMERO,': ',ACIN_DESCRIPCION) DATO FROM TBL_ACREDITACIONINDICADORES WHERE ACAS_ID = '$id'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryAll();
		$lista=CHtml::listData($query, 'ACIN_ID',  'DATO' );//,  'ACBI_NUMERO' la clave del array lista es el ACBI_ID 'ACBI_FECHA', <script>alert('ok')  </ script>				
		echo CHtml::tag('option', array('value' => ''), 'Seleccione ...', true);       		
		foreach($lista as $clave => $dato){
			echo CHtml::tag('option',array('value'=>$clave), CHtml::encode($dato),true);
		}		
	}
	
		//acciones para datagrip
	
	public function actionfiltrarbitacoras()
    {
        //$data = array();$data["myValue"] = "Content updated in AJAX";
		$model_bitaco = new acreditacionbitacoras;
		$model_bitaco->unsetAttributes();  // clear any default values		
		$model_bitaco->ACPR_ID=$_POST['acreditaciones']['ACPR_ID'];
        $this->renderPartial('_bitacoras', array('model_bitaco'=>$model_bitaco));
    }			
	
	public function actionfiltrarfactores()
    {
        //$data = array();$data["myValue"] = "Content updated in AJAX";
		$model_factor = new acreditacionfactores;
		$model_factor->unsetAttributes();  // clear any default values		
		$model_factor->ACBI_ID=$_POST['acreditaciones']['ACBI_ID'];
        $this->renderPartial('_factores',  array('model_factor'=>$model_factor));
    }		
	
	public function actionfiltrarcaracteristicas()
    {
        //$data = array();$data["myValue"] = "Content updated in AJAX";
		$model_caract = new acreditacioncaracteristicas;
		$model_caract->unsetAttributes();  // clear any default values		
		$model_caract->ACFA_ID=$_POST['acreditaciones']['ACFA_ID'];
        $this->renderPartial('_caracteristicas',  array('model_caract'=>$model_caract));
    }	
	
	public function actionfiltraraspectos()
    {
        //$data = array();$data["myValue"] = "Content updated in AJAX";
		$model_aspect = new acreditacionaspectos;
		$model_aspect->unsetAttributes();  // clear any default values		
		$model_aspect->ACCA_ID=$_POST['acreditaciones']['ACCA_ID'];
        $this->renderPartial('_aspectos',  array('model_aspect'=>$model_aspect));
    }	
	
	public function actionfiltrarindicadores()
    {
        //$data = array();$data["myValue"] = "Content updated in AJAX";
		$model_indica = new acreditacionindicadores;
		$model_indica->unsetAttributes();  // clear any default values		
		$model_indica->ACAS_ID=$_POST['acreditaciones']['ACAS_ID'];
        $this->renderPartial('_indicadores',  array('model_indica'=>$model_indica));
    }		
	
	public function actionfiltrarsoportes()
    {
        //$data = array();$data["myValue"] = "Content updated in AJAX";
		$model_soport = new acreditacionsoportes;
		$model_soport->unsetAttributes();  // clear any default values		
		$model_soport->ACIN_ID=$_POST['acreditaciones']['ACIN_ID'];
        $this->renderPartial('_soportes',  array('model_soport'=>$model_soport));
    }	
	
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
		$model_acredi=new acreditaciones;
		$model=new acreditaciones;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['acreditaciones']))
		{
			$model->attributes=$_POST['acreditaciones'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ACRE_ID));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['acreditaciones']))
		{
			$model->attributes=$_POST['acreditaciones'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ACRE_ID));
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
		$dataProvider=new CActiveDataProvider('acreditaciones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model_acredi=new acreditaciones('search');
		$model_progra=new acreditacionprogramas('search');
		$model_bitaco=new acreditacionbitacoras('search');
		$model_factor=new acreditacionfactores('search');
		$model_caract=new acreditacioncaracteristicas('search');
		$model_aspect=new acreditacionaspectos('search');
		$model_indica=new acreditacionindicadores('search');
		$model_soport=new acreditacionsoportes('search');			
		$model_acredi->unsetAttributes();  // clear any default values
		$model_progra->unsetAttributes();  // clear any default values
		$model_bitaco->unsetAttributes();  // clear any default values
		$model_factor->unsetAttributes();  // clear any default values
		$model_caract->unsetAttributes();  // clear any default values
		$model_aspect->unsetAttributes();  // clear any default values
		$model_indica->unsetAttributes();  // clear any default values
		$model_soport->unsetAttributes();  // clear any default values
		
		if(isset($_POST['acreditaciones'])){  ?><script>alert('ingreso');</script> <?php }
				
		if(isset($_POST['acreditaciones'])){  	//VIENEN DE LOS BOTONES AGREGAR
			
			$model_acredi->attributes=$_POST['acreditaciones'];
			
			$model_progra->ACPR_ID=$model_acredi->ACPR_ID;
			$model_bitaco->ACPR_ID=$model_acredi->ACPR_ID;
			$model_bitaco->ACBI_ID=$model_acredi->ACBI_ID;
			$model_factor->ACBI_ID=$model_acredi->ACBI_ID;
			$model_factor->ACFA_ID=$model_acredi->ACFA_ID;
			$model_caract->ACFA_ID=$model_acredi->ACFA_ID;
			$model_caract->ACCA_ID=$model_acredi->ACCA_ID;
			$model_aspect->ACCA_ID=$model_acredi->ACCA_ID;
			$model_aspect->ACAS_ID=$model_acredi->ACAS_ID;
			$model_indica->ACAS_ID=$model_acredi->ACAS_ID;
			$model_indica->ACIN_ID=$model_acredi->ACIN_ID; 
			$model_soport->ACIN_ID=$model_acredi->ACIN_ID;
			$model_soport->ACSO_ID=$model_acredi->ACSO_ID;
						
			//if($_POST['acreditaciones']['ACPR_ID']<>""){ }
		}
		
		if(isset($_GET['acreditacionprogramas'])) $model_progra->attributes=$_GET['acreditacionprogramas'];
		if(isset($_GET['acreditacionbitacoras'])) $model_bitaco->attributes=$_GET['acreditacionbitacoras'];
		if(isset($_GET['acreditacionfactores'])) $model_factor->attributes=$_GET['acreditacionfactores'];
		if(isset($_GET['acreditacioncaracteristicas'])) $model_caract->attributes=$_GET['acreditacioncaracteristicas'];
		if(isset($_GET['acreditacionaspectos'])) $model_aspect->attributes=$_GET['acreditacionaspectos'];
		if(isset($_GET['acreditacionindicadores'])) $model_indica->attributes=$_GET['acreditacionindicadores'];
		if(isset($_GET['acreditacionsoportes'])) $model_soport->attributes=$_GET['acreditacionsoportes'];
				
		//if(isset($_GET['acreditaciones'])) $model_acredi->attributes=$_GET['acreditaciones'];
		$this->render('admin',array( //los otros modelos para los datagrid
			'model_acredi'=>$model_acredi,
			'model_progra'=>$model_progra,
			'model_bitaco'=>$model_bitaco,
			'model_factor'=>$model_factor,
			'model_caract'=>$model_caract,
			'model_aspect'=>$model_aspect,
			'model_indica'=>$model_indica,
			'model_soport'=>$model_soport,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=acreditaciones::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='acreditaciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
