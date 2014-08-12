<?php

class TutoriasController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'','detail2'),
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
	public function actionCreate($id)
	{
		$model = new Tutorias;
		$Supervisores = new Supervisores;
		$Tutoriascontratos = Tutoriascontratos::model()->findByPk($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $model->TUCO_ID = $id;
		$model->TUTO_PLAZO ='Durante :';
		if(isset($_POST['Tutorias']))
		{
			$model->attributes=$_POST['Tutorias'];
			$valorHora = $Tutoriascontratos->TUCO_VALORHORA;
			$intensidad = $_POST['Tutorias']['TUTO_INTENSIDAD'];
			$model->TUTO_VALOR = round($intensidad*$valorHora);
			if($model->save()){
				
				$criteria = new CDbCriteria;
	            $criteria->condition = 'CONT_ID = '.$Tutoriascontratos->CONT_ID;
				if(!$Supervisor = Supervisores::model()->find($criteria)){
				
				$criteria = new CDbCriteria;
	            $criteria->condition = 'TUSP_ID = '.$model->TUSP_ID;	
				 if($Tutoriassubprograma = Tutoriassubprogramas::model()->find($criteria)){	
				   $Tutoriasprogramas = Tutoriasprogramas::model()->findByPk($Tutoriassubprograma->TUPR_ID);
				   $Personasnaturales = Personasnaturales::model()->findByPk($Tutoriasprogramas->PENA_ID);
				   $Supervisores->PERS_ID = $Personasnaturales->PERS_ID;
				   $Supervisores->CARG_ID = 175;
				   $Supervisores->CONT_ID = $Tutoriascontratos->CONT_ID;
				   $Supervisores->save();
				 }
				}
				
				$this->redirect(array('mdltutorias/tutoriasmodulos/create','id'=>$model->TUTO_ID));
			}
		}
		$this->render('create',array('model'=>$model,'Tutoriascontratos'=>$Tutoriascontratos));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$Supervisores = new Supervisores;
		$Tutoriascontratos = Tutoriascontratos::model()->findByPk($model->TUCO_ID);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tutorias']))
		{
			$model->attributes=$_POST['Tutorias'];
			$valorHora = $Tutoriascontratos->TUCO_VALORHORA;
			$intensidad = $_POST['Tutorias']['TUTO_INTENSIDAD'];
			$model->TUTO_VALOR = round($intensidad*$valorHora);
			if($model->save()){
				
				$criteria = new CDbCriteria;
	            $criteria->condition = 'CONT_ID = '.$Tutoriascontratos->CONT_ID;
				if(!$Supervisor = Supervisores::model()->find($criteria)){
				
				$criteria = new CDbCriteria;
	            $criteria->condition = 'TUSP_ID = '.$model->TUSP_ID;	
				 if($Tutoriassubprograma = Tutoriassubprogramas::model()->find($criteria)){	
				   $Tutoriasprogramas = Tutoriasprogramas::model()->findByPk($Tutoriassubprograma->TUPR_ID);
				   $Personasnaturales = Personasnaturales::model()->findByPk($Tutoriasprogramas->PENA_ID);
				   $Supervisores->PERS_ID = $Personasnaturales->PERS_ID;
				   $Supervisores->CARG_ID = 175;
				   $Supervisores->CONT_ID = $Tutoriascontratos->CONT_ID;
				   $Supervisores->save();
				 }
				}else{
					 $criteria = new CDbCriteria;
	                 $criteria->condition = 'CONT_ID = '.$Tutoriascontratos->CONT_ID;
				     $Supervisor = Supervisores::model()->find($criteria);					 
					 $Supervisores = Supervisores::model()->findByPk($Supervisor->SUPE_ID);
					 $criteria = new CDbCriteria;
					 $criteria->condition = 'TUSP_ID = '.$model->TUSP_ID;	
					 if($Tutoriassubprograma = Tutoriassubprogramas::model()->find($criteria)){	
					  $Tutoriasprogramas = Tutoriasprogramas::model()->findByPk($Tutoriassubprograma->TUPR_ID);
					  $Personasnaturales = Personasnaturales::model()->findByPk($Tutoriasprogramas->PENA_ID);
					  $Supervisores->PERS_ID = $Personasnaturales->PERS_ID;
					  $Supervisores->CARG_ID = 175;
					  $Supervisores->CONT_ID = $Tutoriascontratos->CONT_ID;
					  $Supervisores->save();
					 } 
					 }
				
				$this->redirect(array('mdltutorias/tutorias/detail','id'=>$model->TUCO_ID));
			}
		}
		$this->render('update',array('model'=>$model,'Tutoriascontratos'=>$Tutoriascontratos));
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
		$dataProvider=new CActiveDataProvider('Tutorias');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tutorias('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tutorias']))
			$model->attributes=$_GET['Tutorias'];

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
		$model=Tutorias::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tutorias-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDetail($id)
	{
		$model=new Tutorias('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tutorias'])){
		  $model->attributes=$_GET['Tutorias'];
		  Yii::app()->user->getState('TutoriasSearchParams',$_GET['Tutorias']);
		}
		$model->TUCO_ID = $id;
		$this->render('detail',array('model'=>$model,));
	}
	
	public function actionDetail2($id)
	{
		$model=new Tutorias('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tutorias'])){
		  $model->attributes=$_GET['Tutorias'];
		  Yii::app()->user->getState('TutoriasSearchParams',$_GET['Tutorias']);
		}
		$model->TUCO_ID = $id;
		$this->render('detail2',array('model'=>$model,));
	}
		
}
