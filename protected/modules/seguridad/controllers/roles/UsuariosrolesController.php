<?php

class UsuariosrolesController extends Controller
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
		$model=new Usuariosroles;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Usuariosroles']))
		{
			if(isset($_POST['check_vistas'])){			
				$vistasseleccionadas=$_POST['check_vistas'];
				foreach($vistasseleccionadas as $ID){
					$model_rol = new Usuariosroles;
					$model_rol->attributes=$_POST['Usuariosroles'];
					$model_rol->USVI_ID=$ID;
					$model_rol->save();					
				}
				$this->redirect(array('admin','id'=>$model->USRO_ID));				  	
			}
		}
		$this->render('create',array('model'=>$model,));
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

		if(isset($_POST['Usuariosroles']))
		{
			$model->attributes=$_POST['Usuariosroles'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->USRO_ID));
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
		$dataProvider=new CActiveDataProvider('Usuariosroles');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuariosroles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuariosroles']))
			$model->attributes=$_GET['Usuariosroles'];

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
		$model=Usuariosroles::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuariosroles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

     public function actionCargarSubModulos()
        {   
		$filtro = $_POST['Usuariosroles']['USMO_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'USMO_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'USSM_NOMBRE ASC';
				
		$lista = Usuariossubmodulos::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'USSM_ID','USSM_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione sub modulo', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
	 
     public function actionCargarControladores()
        {   
		$filtro = $_POST['Usuariosroles']['USSM_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'USSM_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'USCO_NOMBRE ASC';
				
		$lista = Usuarioscontroladores::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'USCO_ID','USCO_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione controlador', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
	 
     public function actionCargarVistas()
        {   
		$filtro = $_POST['Usuariosroles']['USCO_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'USCO_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'USVI_NOMBRE ASC';
				
		$lista = Usuariosvistas::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'USVI_ID','USVI_NOMBRE');            
		 echo CHtml::checkBoxList('check_vistas','',$list, array('class'=>'span4','prompt'=>'Seleccione controlador'));
     
	   /* echo CHtml::tag('option', array('value' => ''), 'Seleccione una vista', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
	   */
   }	 		 	
}
