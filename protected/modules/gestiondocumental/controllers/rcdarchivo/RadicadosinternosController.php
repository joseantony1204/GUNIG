<?php

class RadicadosInternosController extends Controller
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
        $model=new Radicadosinternos; 


        if(isset($_POST['Radicadosinternos'])) 
        { 
            $model->attributes=$_POST['Radicadosinternos']; 
			//$model->MENS_ID=$_POST['MENS_ID'];
			
			/*$uploadedFile = CUploadedFile::getInstance($model,'ARCHIVO');
			$model->ARCHIVO = $uploadedFile;
			$folder = $model->RAIN_UBICACION;
			
			$basePath = 'GESTIONDOC/'.$folder;        
            $path = Yii::app()->basePath.'/../uploads/'.$basePath;    
            $this->verificarRuta($path);
			
			$ruta = 'GESTIONDOC/'.$folder;
            $realPath = realpath(Yii::app()->getBasePath()."/../uploads/".$ruta);        
            $nameFile="arch_".date("YmdHis").'.pdf';
			
			$model->RAIN_ESCANEORUTA ='/uploads/'.$ruta.'/'.$nameFile;     
            $model->ARCHIVO = $uploadedFile;*/
			
			if($model->save()){
                //$uploadedFile->saveAs("$realPath/{$nameFile}");
                $this->redirect(array('admin'));
            }
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
		$model=$this->loadModel1($id);

		

		if(isset($_POST['Radicadosinternos1']))
		{
			$model->attributes=$_POST['Radicadosinternos1'];
			
			$uploadedFile = CUploadedFile::getInstance($model,'ARCHIVO');
			$model->ARCHIVO = $uploadedFile;
			$folder = $model->RAIN_UBICACION;
			
			$basePath = 'GESTIONDOC/'.$folder;        
            $path = Yii::app()->basePath.'/../uploads/'.$basePath;    
            $this->verificarRuta($path);
			
			$ruta = 'GESTIONDOC/'.$folder;
            $realPath = realpath(Yii::app()->getBasePath()."/../uploads/".$ruta);        
            $nameFile="arch_".date("YmdHis").'.pdf';
			
			$model->RAIN_ESCANEORUTA ='/uploads/'.$ruta.'/'.$nameFile;     
            $model->ARCHIVO = $uploadedFile;
			
			if($model->save())
			    $uploadedFile->saveAs("$realPath/{$nameFile}");
				$this->redirect(array('admin'));
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
		$dataProvider=new CActiveDataProvider('Radicadosinternos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Radicadosinternos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Radicadosinternos']))
			$model->attributes=$_GET['Radicadosinternos'];

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
		$model=Radicadosinternos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

public function loadModel1($id)
	{
		$model=Radicadosinternos1::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='radicadosinternos-form')
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
	
	public function actionChangeState($radicado, $estado){
		$Radicadosinternos = Radicadosinternos::model()->findByPk($radicado);
		if($estado==0){
			$nuevoEstado = 1;
		}else{ 
			$nuevoEstado = 1;
		}
		$cambiarEstado = $Radicadosinternos->cambiarEstado($radicado,$nuevoEstado);
		$this->redirect(array('admin',));
	}	
	
}
