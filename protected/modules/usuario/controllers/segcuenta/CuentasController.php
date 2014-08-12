<?php

class CuentasController extends Controller
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
	public function actionCreate($id)
	{
		$model=new Cuentas;
		$Contratos = new Contratos;
		$verificar = $model->verificarContrato($id);
        //$Contratos=Contratos::model()->findByPk($id);
		
		$criteria = new CDbCriteria;
	    $criteria->condition = 'CONT_ID = '.$id;
	    $Opscontrato = Opscontratos::model()->find($criteria);
		$Opscontratos = Opscontratos::model()->findByPk($Opscontrato->OPCO_ID);
		$model->CUEN_VALOR = $Opscontratos->OPCO_VALOR_MENSUAL;
		$valorCta = $model->CUEN_VALOR = $Opscontratos->OPCO_VALOR_MENSUAL;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Cuentas']))
		{
			$model->attributes=$_POST['Cuentas'];
			$valorPagado = $Contratos->valorCuentasPagadas($id);
			$valorContrato = $Contratos->valorContrato($id);
			
			if($model->CUEN_VALOR>$valorContrato){
			 Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Lo sentimos, el <strong>valor de la cuenta</strong> ingresado 
			 <strong>supera el monto</strong> total este contrato. <br> Corrija el valor e intente nuevamente...');
			}else{
			     $varlorXPagar = round($valorContrato-$valorPagado);
				 if(($model->CUEN_VALOR>$varlorXPagar)){
			      Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Lo sentimos, el 
				  <strong>valor de la cuenta</strong> ingresado 
			      <strong>supera el monto</strong> total que se le adeuda en este contrato. 
				  <br> Corrija el valor e intente nuevamente...');
			     }else{
			           if($model->save()){
				       	$this->redirect(array('admin','id'=>$model->CONT_ID));
			           }
			          }
			    }
		}
		
        $model->CONT_ID = $verificar->CONT_ID;
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
		$verificar = $model->verificarCuenta($id);

		if(isset($_POST['Cuentas']))
		{			
			if($model->CUEN_ESTADO < 3){			
				$model->attributes=$_POST['Cuentas'];
				if($model->save()){
					$this->redirect(array('admin','id'=>$model->CONT_ID));
				}			
			}
			else{
					 Yii::app()->user->setFlash('success',"Error 400, usted no tiene permiso para editar este registro!");			 	 
			}				
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
		$model=$this->loadModel($id);
		if(Yii::app()->request->isPostRequest)
		{
			
			if($model->CUEN_ESTADO < 3){			
				$this->loadModel($id)->delete();
				
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
					
				}
				 else{
					throw new CHttpException(400,'Usted no tiene permiso para eliminar este registro!');			 	 
				}	
				
		}
		else
				throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Cuentas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new Cuentas('search');
		$verificar = $model->verificarContrato($id);
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cuentas'])){
			$model->attributes=$_GET['Cuentas'];
		}
	    $model->CONT_ID = $verificar->CONT_ID;
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
		$model=Cuentas::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cuentas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
