<?php

class LibroresolucionesController extends Controller
{
	public function actionExcel($id=null) //paramentro ES opcional
    {
		if($id!==null)
				Yii::app()->request->sendFile('descarga.xls',
				$this->renderPartial('viewExcelxid',array(
					'model'=>$this->loadModel($id),
				),true));
		
		$model=Archivos::model()->findAll();
		Yii::app()->request->sendFile('descarga.xls',
				$this->renderPartial('viewExcel',array(
					'model'=>$model,
				),true));
	}
	
	
	public function actionPdf($id=null) //paramentro ES opcional
    {
		if($id!==null)
			$this->render('DescargaPdfxid',array('model'=>$this->loadModel($id),));
		$model=Archivos::model()->findAll();
		$this->render('DescargaPdf',array('model'=>$model,));
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
                                 ''.$array[6].'',''.$array[7].'',  
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
		$model=new Libroresoluciones;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Libroresoluciones']))
		{
			$model->attributes=$_POST['Libroresoluciones'];
			$model->PERS_ID =$_POST['PERS_ID'];
			//echo $model->PERS_ID;
			if($model->save())
				$this->redirect(array('view','id'=>$model->LIRE_ID));
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

		if(isset($_POST['Libroresoluciones']))
		{
			$model->attributes=$_POST['Libroresoluciones'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->LIRE_ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{	
			//SELECCIONAR LOS ESCANEOS CON EL ID DEL AVANCE
			$criteria = new CDbCriteria();
			$criteria->condition = "LIRE_ID =:id";
			$criteria->params = array(':id' => $id);
			$lista_escaneados = Escaneados::model()->findAll($criteria);
			//POR CADA ESCANEO BORRAR EL ARCHIVO
			foreach($lista_escaneados as $escaneo){
				$ruta = realpath(Yii::app( )->getBasePath( )."/..".$escaneo['ESCA_RUTA']);
				if(file_exists($ruta)){	unlink($ruta);}
				$sql = 'DELETE FROM TBL_ESCANEADOS WHERE ESCA_ID = '.$escaneo['ESCA_ID'];				
				$connection = Yii::app()->db;					
				$connection->createCommand($sql)->execute();
			}//fin for
			$this->loadModel($id)->delete();
			if(!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 
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
	}*/

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Libroresoluciones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Libroresoluciones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Libroresoluciones']))
			$model->attributes=$_GET['Libroresoluciones'];

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
		$model=Libroresoluciones::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Libroresoluciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
