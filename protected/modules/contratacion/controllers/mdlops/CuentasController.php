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
                                 ''.$array[6].'','admin',  
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cuentas']))
		{
			$model->attributes=$_POST['Cuentas'];
			$valorPagado = $Contratos->valorCuentasPagadas($id);
			echo $valorContrato = $Contratos->valorContrato($id);
			
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
        $model->CONT_ID = $id;
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
		$Contratos = new Contratos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cuentas']))
		{
			$model->attributes=$_POST['Cuentas'];
			$valorPagado = $Contratos->valorCuentasPagadas($model->CONT_ID);
			$valorContrato = $Contratos->valorContrato($model->CONT_ID);
			
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
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cuentas']))
			$model->attributes=$_GET['Cuentas'];
        $model->CONT_ID = $id;
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

	public function actionChangeState($id, $estado){
		$model=Cuentas::model()->findByPk($id);
              $Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
	
		if($estado==0){
			$this->redirect(array('segcuenta/liquidaciones/create','id'=>$id));
		}
		if($estado==1){
			$dato = $model->loadLastData($model->CUEN_ID);
			$this->redirect(array('segcuenta/liquidaciones/update','id'=>$dato->LIQU_ID));
		}
		if($estado==2){
				
			$Usuariosdependencias = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
			WHERE USUA_ID = ".$Usuarios->USUA_ID);
			$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariosdependencias->SEUD_ID);
			
			$lastI = $model->loadRegistro($model->CUEN_ID, $Usuariosdependencias->SEUD_ID);	
						
			$this->redirect(array('segcuenta/seguimientocuentas/update','id'=>$lastI));						
		}		
	}	
   
   public function actiongenerarOrden($id, $estado){
		$model=$this->loadModel($id);
		
		if($estado==1){
			$dato = $model->loadLiquidacion($id);
			$this->redirect(array('segcuenta/liquidaciones/download','id'=>$dato->LIQU_ID));			
		}		
	}


	public function actionSearch()
	{
		$model=new Cuentas;
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariosdependencias = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariosdependencias->SEUD_ID);
		
		if(isset($_POST['Cuentas']))
		{
			$model->attributes=$_POST['Cuentas'];
			$this->redirect(array('segcuenta/cuentas/Excel','inicial'=>$model->CUEN_FECHAINICIO,'final'=>$model->CUEN_FECHAFINAL, 'dependencia'=>$Seguimientouserdependencias->DEPE_ID));	
		}
		$this->render('search',array(
			'model'=>$model,
		));
	} 


	
	public function actionExcel($inicial, $final, $dependencia) //paramentro ES opcional
    {
		$model = Cuentas::model()->consultarLiquidaciones($inicial, $final, $dependencia);
		
		Yii::app()->request->sendFile('descarga.xls',$this->renderPartial('viewExcel',array('model'=>$model,),true));
	}
	 

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cuentas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

		
	public function actionCuentasNoTramitadas()
	{
		$Cuentas = new Cuentas('buscarCuentasNoTramitadas');
		$Personas = new Personas;		
		
		$Cuentas->unsetAttributes(); 

		 
		if(isset($_GET['Cuentas'])){
			$Cuentas->attributes=$_GET['Cuentas'];
		}
 
		$this->render('cuentasNoTramitadas',array(
			'Cuentas'=>$Cuentas,
			'Personas'=>$Personas,
		));
	}
	
	public function actionCuentasTramitadas()
	{
		$Cuentas = new Cuentas('buscarCuentasTramitadas');
		$Personas = new Personas;		
		
		$Cuentas->unsetAttributes(); 

		 
		if(isset($_GET['Cuentas'])){
			$Cuentas->attributes=$_GET['Cuentas'];
		}
 
		$this->render('cuentasTramitadas',array(
			'Cuentas'=>$Cuentas,
			'Personas'=>$Personas,
		));
	}
	
	public function actionReporteCuentasN()
	{
		$Cuentas = new Cuentas;
		$Cuentas->unsetAttributes();
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
	    $Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
	    WHERE USUA_ID = ".$Usuarios->USUA_ID);		
	    $Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
		
	    if((isset($_POST['Cuentas'])))
	    {
	     $Cuentas->attributes=$_POST['Cuentas'];
		 $Cuentas->CUEN_ESTADO = $Cuentas->attributes=$_POST['Cuentas']["CUEN_ESTADO"];	   
	     $Registros = $Cuentas->ctaTramitadas($Cuentas);
	     if($Seguimientouserdependencias->DEPE_ID==17){
		 $this->render('downloadc',array(
		                               'Registros'=>$Registros,
									   'Cuentas'=>$Cuentas,	                                    
								      ));
		 }else{
			  $this->render('download',array(
		                               'Registros'=>$Registros,
									   'Cuentas'=>$Cuentas,	                                    
								      ));
			  }  
	  }	 
		$this->render('reporteCuentasN',array(
			'Cuentas'=>$Cuentas,
		));
	}
	
	public function actionReporteCuentasS()
	{
		$Cuentas = new Cuentas;
		$Cuentas->unsetAttributes();
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
	    $Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
	    WHERE USUA_ID = ".$Usuarios->USUA_ID);		
	    $Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariodependencia->SEUD_ID);
		
	    if((isset($_POST['Cuentas'])))
	    {
	     $Cuentas->attributes=$_POST['Cuentas'];
		 $Cuentas->CUEN_ESTADO = $Cuentas->attributes=$_POST['Cuentas']["CUEN_ESTADO"];	   
	     $Registros = $Cuentas->ctaTramitadas($Cuentas);
	     if($Seguimientouserdependencias->DEPE_ID==17){
		 $this->render('downloadc',array(
		                               'Registros'=>$Registros,
									   'Cuentas'=>$Cuentas,	                                    
								      ));
		 }else{
			  $this->render('download',array(
		                               'Registros'=>$Registros,
									   'Cuentas'=>$Cuentas,	                                    
								      ));
			  }	  
	  }	 
		$this->render('reporteCuentasS',array(
			'Cuentas'=>$Cuentas,
		));
	}
	
		
}
