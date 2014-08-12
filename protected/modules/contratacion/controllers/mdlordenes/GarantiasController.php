<?php

class GarantiasController extends Controller
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
		$model=new Garantias;
		$model->MOOR_ID = $id;
		$tipo = $Modeloordenes->rel_contrato->tICO->TICO_NOMBRE;
  		$clase = $Modeloordenes->rel_contrato->cLCO->CLCO_NOMBRE;	
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Garantias']))
		{
			$model->attributes=$_POST['Garantias'];
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'MOOR_ID = '.$model->MOOR_ID;		
			$Modeloordenes = Modeloordenes::model()->find($criteria);
			$tipo = $Modeloordenes->rel_contrato->tICO->TICO_ID;
			
			$nombre = $model->attributes['GARA_NOMBRE'];
			$anios = $model->attributes['GARA_ANIO'];
			$meses = $model->attributes['GARA_MES'];
			$porcentaje = $model->attributes['GARA_PORCENTAJE'];
			
			if ($tipo==1 or $tipo==3){
				
					if ($model->attributes['GARA_PORCENTAJE']==100){
					$tipocontrato='del anticipo';
					}else{
					$tipocontrato='del contrato';
					}
					
				}elseif($tipo==2 or $tipo==4){
					if ($model->attributes['GARA_PORCENTAJE']==100){
					$tipocontrato='del anticipo';
					}else{
					$tipocontrato='del contrato';
					}
					
				}
					
			
			
			
			if(($anios>0) & $meses==0){
			$descripcion = "- ".$nombre.", equivalente al (".$porcentaje."%) del valor ".$tipocontrato.", la cual estará vigente por el término de su duración y ".$anios." AÑO(S) más.";
			}else{
			if(($anios==0) & $meses>0){
		    $descripcion = "- ".$nombre.", equivalente al (".$porcentaje."%) del valor ".$tipocontrato.", la cual estará vigente por el término de su duración y ".$meses." MES(ES) más."; 
			}else{
			if(($anios==0) & $meses==0){
		   $descripcion = "- ".$nombre.", equivalente al (".$porcentaje."%) del valor ".$tipocontrato.", la cual estará vigente por el término de su duración."; 
			}else{
			if(($anios==5) & $meses==0){
		   $descripcion = "- ".$nombre.", equivalente al (".$porcentaje."%) del valor ".$tipocontrato.", la cual estará vigente por el término de ".$anios." AÑO(S) a partir del acta de recibido a satisfacción."; 
			}
			}
			}
			
	
				  
				 }
			$model->GARA_DESCRIPCION = $descripcion; 
			
			
			if($model->save())
				$this->redirect(array('admin','id'=>$model->MOOR_ID));
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
		
		//$Modeloordenes = Modeloordenes::model()->findByPk($model->MOOR_ID);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Garantias']))
		{
			$model->attributes=$_POST['Garantias'];
			
			$criteria = new CDbCriteria;
			$criteria->condition = 'MOOR_ID = '.$model->MOOR_ID;		
			$Modeloordenes = Modeloordenes::model()->find($criteria);
			$tipo = $Modeloordenes->rel_contrato->tICO->TICO_ID;
			
				if ($tipo==1){
				
					if ($model->attributes['GARA_PORCENTAJE']==100){
					$tipocontrato='del anticipo';
					}else{
					$tipocontrato='del contrato';
					}
					
				}elseif($tipo==2){
					if ($model->attributes['GARA_PORCENTAJE']==100){
					$tipocontrato='del anticipo';
					}else{
					$tipocontrato='del contrato';
					}
					
				}
			
			$nombre = $model->attributes['GARA_NOMBRE'];
			$anios = $model->attributes['GARA_ANIO'];
			$meses = $model->attributes['GARA_MES'];
			$porcentaje = $model->attributes['GARA_PORCENTAJE'];
			if(($anios>0) & $meses==0){
			$descripcion = "- ".$nombre.", equivalente al (".$porcentaje."%) del valor ".$tipocontrato.", la cual estará vigente por el término de su duración y ".$anios." AÑO(S) más.";
			
			}else{
			
			if(($anios==0) & $meses>0){
			$descripcion = "- ".$nombre.", equivalente al (".$porcentaje."%) del valor ".$tipocontrato.", la cual estará vigente por el término de su duración y ".$meses." MES(ES) más."; 
		    
			}else{
		    
			if(($anios==0) & $meses==0){
			$descripcion = "- ".$nombre.", equivalente al (".$porcentaje."%) del valor ".$tipocontrato.", la cual estará vigente por el término de su duración."; 
			}else{
			if(($anios==5) & $meses==0){
		   $descripcion ="- ".$nombre.", equivalente al (".$porcentaje."%) del valor ".$tipocontrato.", la cual estará vigente por el término de ".$anios." AÑO(S) a partir del acta de recibido a satisfacción."; 
			}
			}
			
			} }
			$model->GARA_DESCRIPCION = $descripcion; 

			if($model->save())
				$this->redirect(array('admin','id'=>$model->MOOR_ID));
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
		$dataProvider=new CActiveDataProvider('Garantias');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new Garantias('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Garantias']))
			$model->attributes=$_GET['Garantias'];

		$model->MOOR_ID=$id;
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
		$model=Garantias::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='garantias-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
