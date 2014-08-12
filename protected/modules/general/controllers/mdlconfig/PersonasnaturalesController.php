<?php

class PersonasnaturalesController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].''),
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
	public function actionCreate()
	{
		$Personasnaturales = new Personasnaturales;
		$Personas = new Personas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if((isset($_POST['Personasnaturales'])) & (isset($_POST['Personas'])))
		{
			$Personasnaturales->attributes=$_POST['Personasnaturales'];
			$Personas->attributes=$_POST['Personas'];
			$Personas->PERS_FECHAINGRESO = $Personas->attributes=$_POST['Personas']["PERS_FECHAINGRESO"];
			if($Personas->save()){
                $Personas->PERS_FECHAINGRESO = $Personas->attributes=$_POST['Personas']["PERS_FECHAINGRESO"];
				$Persona = $Personas->loadLastData($Personas->PERS_IDENTIFICACION,$Personas->TIID_ID,$Personas->PERS_FECHAINGRESO);
				$Personasnaturales->PERS_ID = $Persona->PERS_ID;			 
			 if($Personasnaturales->save()){
				 $this->redirect(array('view','id'=>$Personasnaturales->PENA_ID));
		         Yii::app()->user->setFlash('success','<strong>Hecho!. </strong>Exito al crear la persona natural...');
				}else{
			          Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Error creando la perdona natural...');
			         }
			}else{
			       Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Error creando la persona...');
			     }
		}

		$this->render('create',array(
			'Personasnaturales'=>$Personasnaturales,
			'Personas'=>$Personas,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$Personasnaturales = $this->loadModel($id);
        $Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);
		$fechaIngreso = $Personas->PERS_FECHAINGRESO;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		
		if((isset($_POST['Personasnaturales'])) & (isset($_POST['Personas'])))
		{
			$Personasnaturales->attributes=$_POST['Personasnaturales'];
			$Personas->attributes=$_POST['Personas'];
			$Personas->PERS_FECHAINGRESO = $fechaIngreso;
			if($Personas->save()){			 
			 if($Personasnaturales->save()){
				 $this->redirect(array('view','id'=>$Personasnaturales->PENA_ID));
		         Yii::app()->user->setFlash('success','<strong>Hecho!. </strong>Exito al actualizar la persona natural...');
				}else{
			          Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Error actualizando la perdona natural...');
			         }
			}else{
			       Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Error actualizando la persona...');
			     }
		}

		$this->render('update',array(
			'Personasnaturales'=>$Personasnaturales,
			'Personas'=>$Personas,
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
		$dataProvider=new CActiveDataProvider('Personasnaturales');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personasnaturales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personasnaturales']))
			$model->attributes=$_GET['Personasnaturales'];

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
		$model=Personasnaturales::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='personasnaturales-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
     public function actionObtdepa()
        {   
		$filtro = $_POST['Personasnaturales']['PAIS_ID'];
		
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
		$filtro = $_POST['Personasnaturales']['DEPA_ID'];
		
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
	 
     public function actionMiscontratos($id)
     {   
		$Personas = new Personas;
		$Personas->PERS_ID = $id;
		$model = $this->loadModel($id);		
		$this->render('miscontratos',array(
			'Personas'=>$Personas,
			'model'=>$model,
		));
     }	 	 	
}
