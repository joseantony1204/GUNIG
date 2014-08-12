<?php

class ExpedientedocumentosController extends Controller
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
                                 ''.$array[6].'',''.$array[7].'','adminSupervisor','create2','delete','unirpdf',  
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
	public function actionCreate($id)
	{
		$model=new Expedientedocumentos;
		
		$criteria = new CDbCriteria;
        $criteria->condition = 'CONT_ID = '.$id;		
        $Contratos = Contratos::model()->find($criteria);		
        $Personas = Personas::model()->findByPk($Contratos->PERS_ID);
		
		$criteria = new CDbCriteria;
        $criteria->condition = 'PERS_ID = '.$Personas->PERS_ID;		
        $Personanatural = Personasnaturales::model()->find($criteria);		
		$Personasnaturales = Personasnaturales::model()->findByPk($Personanatural->PENA_ID);

		
		if(isset($_POST['Expedientedocumentos'])){
		$model->attributes=$_POST['Expedientedocumentos'];
		
		$uploadedFile = CUploadedFile::getInstance($model,'ARCHIVO');
		$Contratos = Contratos::model()->findByPk($model->CONT_ID);		
		$Tiposdocumentos = Tiposdocumentos::model()->findByPk($model->TIDO_ID);
		$idPersona = $Contratos->Persona->PERS_ID; $anioContrato = $Contratos->CONT_ANIO;
		$tipoContrato = $Contratos->TICO_ID; $claseContrato = $Contratos->CLCO_ID; 
		$numOrden = $Contratos->CONT_NUMORDEN;
		
		$basePath = 'GESTIONDOC/PERSONAS/'.$idPersona.'/CONTRATACION/'.$anioContrato.'/'.$tipoContrato.'/'.$claseContrato.'/'.$numOrden.'/';    
		$path = Yii::app()->basePath.'/../uploads/'.$basePath;	
	    $this->verificarRuta($path);
		
		$ruta = 'GESTIONDOC/PERSONAS/'.$idPersona.'/CONTRATACION/'.$anioContrato.'/'.$tipoContrato.'/'.$claseContrato.'/'.$numOrden;
		$realPath = realpath(Yii::app()->getBasePath()."/../uploads/".$ruta);		
		$nameFile="arch_".date("YmdHis").'.pdf';
		
		$model->EXDO_RUTA ='/uploads/'.$ruta.'/'.$nameFile; 	
        $model->ARCHIVO = $uploadedFile;
          if($model->save())
            {  
				$uploadedFile->saveAs("$realPath/{$nameFile}");             
				$this->redirect(array('admin','id'=>$model->CONT_ID));
            }
		}
		
        $model->CONT_ID = $id;
		$this->render('create',array(
			'model'=>$model,
			'Personasnaturales'=>$Personasnaturales,
		));
	}
	
	public function actionCreate2($id)
	{
		$model=new Expedientedocumentos;
		
		$criteria = new CDbCriteria;
        $criteria->condition = 'CONT_ID = '.$id;		
        $Contratos = Contratos::model()->find($criteria);		
        $Personas = Personas::model()->findByPk($Contratos->PERS_ID);
		
		$criteria = new CDbCriteria;
        $criteria->condition = 'PERS_ID = '.$Personas->PERS_ID;		
        $Personanatural = Personasnaturales::model()->find($criteria);		
		$Personasnaturales = Personasnaturales::model()->findByPk($Personanatural->PENA_ID);

		
		if(isset($_POST['Expedientedocumentos'])){
		$model->attributes=$_POST['Expedientedocumentos'];
		
		$uploadedFile = CUploadedFile::getInstance($model,'ARCHIVO');
		$Contratos = Contratos::model()->findByPk($model->CONT_ID);		
		$Tiposdocumentos = Tiposdocumentos::model()->findByPk($model->TIDO_ID);
		$idPersona = $Contratos->Persona->PERS_ID; $anioContrato = $Contratos->CONT_ANIO;
		$tipoContrato = $Contratos->TICO_ID; $claseContrato = $Contratos->CLCO_ID; 
		$numOrden = $Contratos->CONT_NUMORDEN;
		
		$basePath = 'GESTIONDOC/PERSONAS/'.$idPersona.'/CONTRATACION/'.$anioContrato.'/'.$tipoContrato.'/'.$claseContrato.'/'.$numOrden.'/';    
		$path = Yii::app()->basePath.'/../uploads/'.$basePath;	
	    $this->verificarRuta($path);
		
		$ruta = 'GESTIONDOC/PERSONAS/'.$idPersona.'/CONTRATACION/'.$anioContrato.'/'.$tipoContrato.'/'.$claseContrato.'/'.$numOrden;
		$realPath = realpath(Yii::app()->getBasePath()."/../uploads/".$ruta);		
		$nameFile="arch_".date("YmdHis").'.pdf';
		
		$model->EXDO_RUTA ='/uploads/'.$ruta.'/'.$nameFile; 	
        $model->ARCHIVO = $uploadedFile;
          if($model->save())
            {  
				$uploadedFile->saveAs("$realPath/{$nameFile}");             
				$this->redirect(array('adminSupervisor','id'=>$model->CONT_ID));
            }
		}
		
        $model->CONT_ID = $id;
		$this->render('create2',array(
			'model'=>$model,
			'Personasnaturales'=>$Personasnaturales,
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

		if(isset($_POST['Expedientedocumentos']))
		{
			$model->attributes=$_POST['Expedientedocumentos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->EXDO_ID));
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
			$model = $this->loadModel($id);
			$ruta = realpath(Yii::app( )->getBasePath( )."/..".$model->EXDO_RUTA);
			if(file_exists($ruta))
			{
			 unlink($ruta);
			}
			$model->delete();

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
		$dataProvider=new CActiveDataProvider('Expedientedocumentos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new Expedientedocumentos('search');
		
		$criteria = new CDbCriteria;
        $criteria->condition = 'CONT_ID = '.$id;		
        $Contratos = Contratos::model()->find($criteria);		
        $Personas = Personas::model()->findByPk($Contratos->PERS_ID);
		
		$criteria = new CDbCriteria;
        $criteria->condition = 'PERS_ID = '.$Personas->PERS_ID;		
        $Personanatural = Personasnaturales::model()->find($criteria);		
		$Personasnaturales = Personasnaturales::model()->findByPk($Personanatural->PENA_ID);
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Expedientedocumentos'])){
			$model->attributes=$_GET['Expedientedocumentos'];
		}
        $model->CONT_ID = $id;
		$this->render('admin',array(
			'model'=>$model,
			'Personasnaturales'=>$Personasnaturales,
		));
	}
	
	public function actionAdminSupervisor($id)
	{
		$model=new Expedientedocumentos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Expedientedocumentos']))
			$model->attributes=$_GET['Expedientedocumentos'];
        $model->CONT_ID = $id;
		$this->render('adminSupervisor',array(
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
		$model=Expedientedocumentos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    public function verificarRuta($url)
	{
        if( !is_dir( $url ) ) {
            mkdir( $url, 0700, true );
            chmod ( $url , 0777 );
            //throw new CHttpException(500, "{$this->path} does not exists.");
        } else if( !is_writable( $url ) ) {
            chmod( $url, 0777 );
            //throw new CHttpException(500, "{$this->path} is not writable.");
        }
     }
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='expedientedocumentos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionUnirpdf($id)
	{
	 $criterio = array('join'=>'WHERE t.CONT_ID = '.$id);
	 $Expedientedocumentos = Expedientedocumentos::model()->findAll($criterio);	 
	 $this->render('unirpdf2',array(
			'Expedientedocumentos'=>$Expedientedocumentos,
	        ));	
	}	
}
