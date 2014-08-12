<?php

class EgresadosController extends Controller
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
		$model=new Egresados;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Egresados']))
		{
			$model->attributes=$_POST['Egresados'];
			if($model->save())
				$this->redirect(array('admin'));
		}

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

		if(isset($_POST['Egresados']))
		{
			$model->attributes=$_POST['Egresados'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->EGRE_ID));
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
		$dataProvider=new CActiveDataProvider('Egresados');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionExportar()
	{
		$model=new Egresados;
		
		if(isset($_POST['Egresados']))
		{
			$model->attributes=$_POST['Egresados'];
			
			$this->redirect(array('mdlegresados/egresados/Excel','fechagrado'=>$model->fEGR->FEGR_ID));
		}
					
		$this->render('exportar',array(
			'model'=>$model,
		));
	}
	
	
	public function actionExcel($fechagrado) 
    {  
	  {
		$model = Egresados::model()->consultarEgresados($fechagrado);
		
		Yii::app()->request->sendFile('GRADUADO.xls',$this->renderPartial('viewExcel',array('model'=>$model,),true));
	  }
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Egresados('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Egresados']))
			$model->attributes=$_GET['Egresados'];

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
		$model=Egresados::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	public function actionObtdepa()
        {   
		$filtro = $_POST['Egresados']['PAIS_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'PAIS_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'DEPA_NOMBRE ASC';
				
		$lista = Departamentos::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'DEPA_ID','DEPA_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione departamento', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
	 
     public function actionObtmuni()
        {   
		$filtro = $_POST['Egresados']['DEPA_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'DEPA_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'MUNI_NOMBRE ASC';
				
		$lista = Municipios::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'MUNI_ID','MUNI_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione municipio', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
	 
	 
	 public function actionObtmunis()
        {   
		 $filtro = $_POST['Egresados']['DEPA_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'DEPA_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'MUNI_NOMBRE ASC';
				
		$lista = Municipios::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'MUNI_ID','MUNI_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione municipio', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );               
       }
     }
	 
	 
	 public function actionObtprosede()
        {   
		$filtro = $_POST['Egresados']['PROG_ID'];
		$criteria = new CDbCriteria();
        $criteria->condition = 'PROG_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'PRSE_ID ASC';
				
		$lista = Programassedes::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'PRSE_ID','PRSE_PROCONSECUTIVO');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione una opcion', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='egresados-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
