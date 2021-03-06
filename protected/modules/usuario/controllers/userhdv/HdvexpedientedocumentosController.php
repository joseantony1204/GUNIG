<?php

class HdvexpedientedocumentosController extends Controller
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
	public function actionCreate($id)
	{
		$model=new Hdvexpedientedocumentos;

	    $criteria = new CDbCriteria;
        $criteria->condition = 'PERS_ID = '.$id;		
        $Personanatural = Personasnaturales::model()->find($criteria);		
        $Personasnaturales = Personasnaturales::model()->findByPk($Personanatural->PENA_ID);
        $verificar = $model->verificarPersona($id);
		if(isset($_POST['Hdvexpedientedocumentos']))
		{
			$model->attributes=$_POST['Hdvexpedientedocumentos'];
			$uploadedFile = CUploadedFile::getInstance($model,'ARCHIVO');
			$idPersona = $model->PERS_ID;
			
			$basePath = 'GESTIONDOC/PERSONAS/'.$idPersona.'/HDV/';	       
		    $path = Yii::app()->basePath.'/../uploads/'.$basePath;	
	        $this->verificarRuta($path);
			
			$ruta = 'GESTIONDOC/PERSONAS/'.$idPersona.'/HDV';
		    $realPath = realpath(Yii::app()->getBasePath()."/../uploads/".$ruta);		
		    $nameFile="arch_".date("YmdHis").'.pdf';
		
		    $model->HEXD_RUTA ='/uploads/'.$ruta.'/'.$nameFile; 	
            $model->ARCHIVO = $uploadedFile;
			
			if($model->save()){
				$uploadedFile->saveAs("$realPath/{$nameFile}");             
				$this->redirect(array('admin','id'=>$model->PERS_ID));
			}
		}

		$model->PERS_ID = $verificar->PERS_ID;
		$this->render('create',array(
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

		$criteria = new CDbCriteria;
        $criteria->condition = 'PERS_ID = '.$model->PERS_ID;		
        $Personanatural = Personasnaturales::model()->find($criteria);		
        $Personasnaturales = Personasnaturales::model()->findByPk($Personanatural->PENA_ID);

		if(isset($_POST['Hdvexpedientedocumentos']))
		{
			$model->attributes=$_POST['Hdvexpedientedocumentos'];
			$uploadedFile = CUploadedFile::getInstance($model,'ARCHIVO');
			$idPersona = $model->PERS_ID;
			
			$basePath = 'GESTIONDOC/PERSONAS/'.$idPersona.'/HDV/';	       
		    $path = Yii::app()->basePath.'/../uploads/'.$basePath;	
	        $this->verificarRuta($path);
			
			$ruta = 'GESTIONDOC/PERSONAS/'.$idPersona.'/HDV';
		    $realPath = realpath(Yii::app()->getBasePath()."/../uploads/".$ruta);		
		    $nameFile="arch_".date("YmdHis").'.pdf';
		
		    $model->HEXD_RUTA ='/uploads/'.$ruta.'/'.$nameFile; 	
            $model->ARCHIVO = $uploadedFile;
			if($model->save()){
				$uploadedFile->saveAs("$realPath/{$nameFile}"); 
				$this->redirect(array('admin','id'=>$model->PERS_ID));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'Personasnaturales'=>$Personasnaturales,
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
		$dataProvider=new CActiveDataProvider('Hdvexpedientedocumentos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new Hdvexpedientedocumentos('search');
		$criteria = new CDbCriteria;
        $criteria->condition = 'PERS_ID = '.$id;		
        $Personanatural = Personasnaturales::model()->find($criteria);		
        $Personasnaturales = Personasnaturales::model()->findByPk($Personanatural->PENA_ID);
		$verificar = $model->verificarPersona($id);
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Hdvexpedientedocumentos'])){
			$model->attributes=$_GET['Hdvexpedientedocumentos'];
		}
		$model->PERS_ID = $verificar->PERS_ID;
		$this->render('admin',array(
			'model'=>$model,
			'Personasnaturales'=>$Personasnaturales,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Hdvexpedientedocumentos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='hdvexpedientedocumentos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
    
	public function actionUnirpdf($id)
	{
	 $model=new Hdvexpedientedocumentos();
	 $verificar = $model->verificarPersona($id);
	 $criterio = array('join'=>'WHERE t.PERS_ID = '.$verificar->PERS_ID);
	 $Hdvexpedientedocumentos = Hdvexpedientedocumentos::model()->findAll($criterio);	 
	 $this->render('unirpdf2',array(
			'Hdvexpedientedocumentos'=>$Hdvexpedientedocumentos,
	        ));	
	}	 
}
