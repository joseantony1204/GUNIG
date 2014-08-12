<?php

class CatedraticoscatedrasController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'','cargarProgramas'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$Catedraticoscatedras = new Catedraticoscatedras;
		$phpNumToLetterPath = Yii::getPathOfAlias('ext');
        include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
        $NumberToLetters = new EnLetras();
		$Facultades = new Facultades;

		if(isset($_POST['Catedraticoscatedras']))
		{
			$Catedraticoscatedras->attributes=$_POST['Catedraticoscatedras'];
			/*datos para la catedra*/
			$Programas = Programas::model()->findByPk($Catedraticoscatedras->PROG_ID);	 
			$Catedraticoscatedras->CACA_NOMBRE = $Programas->PROG_NOMBRE;
			$intensidad = $Catedraticoscatedras->CACA_INTENSIDAD;
			$Catedraticoscatedras->CACA_INTENSIDADENLETRAS = strtoupper($NumberToLetters->ValorEnLetras($intensidad," "));
			$Catedraticoscatedras->CACA_ESTADO = 3;
			if($Catedraticoscatedras->save()){
				$this->redirect(array('mdlcatedraticos/catedratiasignaturascatedr/create','id'=>$Catedraticoscatedras->CACA_ID));
			}
		}

		$Catedraticoscatedras->CACO_ID = $id;
		$this->render('create',array(
			'Catedraticoscatedras'=>$Catedraticoscatedras,
			'Facultades'=>$Facultades,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$phpNumToLetterPath = Yii::getPathOfAlias('ext');
        include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
        $NumberToLetters = new EnLetras();
		
		$Facultades = new Facultades;
		$Catedraticoscatedras = $this->loadModel($id);


		if(isset($_POST['Catedraticoscatedras']))
		{
			$Catedraticoscatedras->attributes=$_POST['Catedraticoscatedras'];
			/*datos para la catedra*/
			$Programas = Programas::model()->findByPk($Catedraticoscatedras->PROG_ID);	 
			$Catedraticoscatedras->CACA_NOMBRE = $Programas->PROG_NOMBRE;
			$intensidad = $Catedraticoscatedras->CACA_INTENSIDAD;
			$Catedraticoscatedras->CACA_INTENSIDADENLETRAS = strtoupper($NumberToLetters->ValorEnLetras($intensidad," "));
			if($Catedraticoscatedras->save()){
			$this->redirect(array('mdlcatedraticos/catedraticoscatedras/admin','id'=>$Catedraticoscatedras->CACO_ID));
			}
		}

		$this->render('update',array(
			'Catedraticoscatedras'=>$Catedraticoscatedras,
			'Facultades'=>$Facultades,
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
		$dataProvider=new CActiveDataProvider('Catedraticoscatedras');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new Catedraticoscatedras('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Catedraticoscatedras'])){
			$model->attributes=$_GET['Catedraticoscatedras'];
	    }
		$model->CACO_ID = $id;
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionView()
	{
		$model=new Catedraticoscatedras('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Catedraticoscatedras'])){
			$model->attributes=$_GET['Catedraticoscatedras'];
	    }
		$this->render('view',array(
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
		$model=Catedraticoscatedras::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='catedraticoscatedras-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionLiquidacion()
	{
		$model = new Catedraticoscatedras;
		$model->liquidacionCatedras();  
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
}
