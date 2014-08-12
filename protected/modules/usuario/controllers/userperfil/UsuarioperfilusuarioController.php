<?php

class UsuarioperfilusuarioController extends Controller
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
		$model=new Usuarioperfilusuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Usuarioperfilusuario']))
		{
			$model->attributes=$_POST['Usuarioperfilusuario'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->USPU_ID));
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
	public function actionUpdate($id=NULL)
	{
		$Usuario = Usuario::model()->findByPk(Yii::app()->user->id);		
		$criteria = new CDbCriteria;
	    $criteria->condition = 'USUA_ID = '.$Usuario->USUA_ID;
	    $Userperfil = Usuarioperfilusuario::model()->find($criteria);
		$Usuarioperfilusuario = $this->loadModel($Userperfil->USPU_ID);
		$oldPass = $Usuario->USUA_CLAVE;
		$PENA_ID = $Usuario->PENA_ID;
		$USPE_ID = $Usuarioperfilusuario->USPE_ID;
		$oldSession = $Usuario->USUA_SESSION;		
		$Usuario->USUA_CLAVE ="";
		

		if((isset($_POST['Usuarioperfilusuario'])) && (isset($_POST['Usuario'])))
		{
			$Usuario->attributes=$_POST['Usuario'];
			$pass = $Usuario->attributes["USUA_CLAVE"];
			
			if($pass!=""){
			 $newSession = $Usuario->generateSalt();	
			 $Usuario->USUA_CLAVE = $Usuario->hashPassword($pass, $newSession);
			 $Usuario->USUA_SESSION = $newSession;
			}else{
				 $Usuario->USUA_CLAVE = $oldPass;
				 $Usuario->USUA_SESSION = $oldSession;
				 }
			$Usuario->PENA_ID = $PENA_ID;	
			if($Usuario->save()){
				$Usuarioperfilusuario->USPE_ID = $USPE_ID;			   
			   if($Usuarioperfilusuario->save()){		   
			     Yii::app()->user->logout();
				 $this->redirect(array('/site/login',));
				 
			    }
			   }
		}

		$this->render('update',array(
			'Usuario'=>$Usuario,
			'Usuarioperfilusuario'=>$Usuarioperfilusuario,
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
		$dataProvider=new CActiveDataProvider('Usuarioperfilusuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuarioperfilusuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarioperfilusuario']))
			$model->attributes=$_GET['Usuarioperfilusuario'];

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
		$model=Usuarioperfilusuario::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuarioperfilusuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
