<?php

class UsersperfilesusuariosController extends Controller
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
		$Users = new Users;
		$Usersperfilesusuarios = new Usersperfilesusuarios;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if((isset($_POST['Usersperfilesusuarios'])) && (isset($_POST['Users'])))
		{
			$Users->attributes=$_POST['Users'];
			$Usersperfilesusuarios->attributes=$_POST['Usersperfilesusuarios'];
			
			$Users->PENA_ID = $_POST['PENA_ID'];			
			$User = $Users->verificarPersona($Users->PENA_ID);			
			if($User->PENA_ID==$Users->PENA_ID){
			Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Esta persona ya posee un usuario y una contraseña asignada.');
			}else{
				   $nombreUsuario = $Users->verificarNombreUsuario($Users->USUA_USUARIO);
				   if($nombreUsuario->USUA_ID!=""){
				    Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>El nombre de usuario no esta disponible.');
				   }else{
					      $newSession = $Users->generateSalt();
			              $Users->USUA_CLAVE = $Users->hashPassword($Users->USUA_CLAVE, $newSession);
			              $Users->USUA_SESSION = $newSession;
					      if($Users->save()){
						   $User = $Users->loadLastData($Users->USUA_USUARIO,$Users->USUA_SESSION,$Users->USUA_FECHAALTA);
						   $Usersperfilesusuarios->USUA_ID = $User->USUA_ID;
						    if($Usersperfilesusuarios->save()){
						     $this->redirect(array('admin'));
						    }
					       }						
						}
				 }
		}

		$this->render('create',array(
			'Users'=>$Users,
			'Usersperfilesusuarios'=>$Usersperfilesusuarios,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$Usersperfilesusuarios = $this->loadModel($id);
		$Users = Users::model()->findByPk($Usersperfilesusuarios->USUA_ID);
		$oldPass = $Users->USUA_CLAVE;
		$oldSession = $Users->USUA_SESSION;		
		if((isset($_POST['Usersperfilesusuarios'])) && (isset($_POST['Users'])))
		{
			$Usersperfilesusuarios->attributes = $_POST['Usersperfilesusuarios'];
			$pass = $Users->attributes = $_POST["Users"]["USUA_CLAVE"];
			
			if($pass!=""){
			 $newSession = $Users->generateSalt();	
			 $Users->USUA_CLAVE = $Users->hashPassword($pass, $newSession);
			 $Users->USUA_SESSION = $newSession;
			}else{
				 $Users->USUA_CLAVE = $oldPass;
				 $Users->USUA_SESSION = $oldSession;
				 }
				 
			if($Users->save()){
			  if($Usersperfilesusuarios->save()){
			   $this->redirect(array('admin'));
			  }
			}
		}

		$this->render('update',array(
			'Users'=>$Users,
			'Usersperfilesusuarios'=>$Usersperfilesusuarios,
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
		$dataProvider=new CActiveDataProvider('Usersperfilesusuarios');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usersperfilesusuarios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usersperfilesusuarios']))
			$model->attributes=$_GET['Usersperfilesusuarios'];

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
		$model=Usersperfilesusuarios::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='usersperfilesusuarios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
public function actionCreateAll()
	{
		$Userss = new Users;	
		 
		 $usuarios = $Userss->allUsuarios();
		 foreach($usuarios as $rows){
			$Users = new Users;
		    $Usersperfilesusuarios = new Usersperfilesusuarios;	
			$Users->PENA_ID = $rows["PENA_ID"];
			$Users->USUA_USUARIO = $rows["USUARIO"];
			$Users->USUA_CLAVE = $rows["CLAVE"];
			$Users->USUA_FECHAALTA = date("Y-m-d")." ".date("h:i:s  A");
			$Users->USUA_FECHABAJA = "0000-00-00 00:00:00";
			$Users->USUA_ULTIMOACCESO = "0000-00-00 00:00:00";
			$Users->USES_ID = 1;
			
			$Usersperfilesusuarios->USPE_ID = 14;
			$Usersperfilesusuarios->USPU_FECHAINGRESO = $Users->USUA_FECHAALTA;
						
			$User = $Users->verificarPersona($Users->PENA_ID);			
			if($User->PENA_ID==$Users->PENA_ID){
			echo "Esta persona ya posee un usuario y una contraseña asignada.";
			echo $rows["PENA_ID"]; echo "<br>";
			}else{
				   $nombreUsuario = $Users->verificarNombreUsuario($Users->USUA_USUARIO);
				   if($nombreUsuario->USUA_ID!=""){
				    Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>El nombre de usuario no esta disponible.');
				   }else{
					      $newSession = $Users->generateSalt();
			              echo $Users->USUA_CLAVE = $Users->hashPassword($Users->USUA_CLAVE, $newSession); echo "<br>";
			              $Users->USUA_SESSION = $newSession;
					     
						  if($Users->save()){
						   $User = $Users->loadLastData($Users->USUA_USUARIO,$Users->USUA_SESSION,$Users->USUA_FECHAALTA);
						   $Usersperfilesusuarios->USUA_ID = $User->USUA_ID;
						   
						    if($Usersperfilesusuarios->save()){
						     echo $Users->USUA_CLAVE; echo "<br>";
							 //$this->redirect(array('admin'));
						    }
							
					       }
						  					
						}
				 }
		} 
	}	
}
