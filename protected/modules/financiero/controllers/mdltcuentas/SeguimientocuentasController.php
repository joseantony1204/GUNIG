<?php

class SeguimientocuentasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	
	public $persona; 
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

	public function actionCreate($id)
	{
		
		$model = new Seguimientocuentas;
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariosdependencias = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariosdependencias->SEUD_ID);
		
		if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
		$estadoCta = 1; 
		}elseif($Seguimientouserdependencias->DEPE_ID==49){
		$estadoCta = 3; 
		}elseif($Seguimientouserdependencias->DEPE_ID==17){
		$estadoCta = 4; 
		}elseif($Seguimientouserdependencias->DEPE_ID==18){
		$estadoCta = 5; 
		}elseif($Seguimientouserdependencias->DEPE_ID==8){
		$estadoCta = 6; 
		}elseif($Seguimientouserdependencias->DEPE_ID==4){
		$estadoCta = 7; 
		}
		
		if((isset($_POST['Seguimientocuentas'])) && (isset($_POST['Cuentas'])))
		{
			$model->attributes=$_POST['Seguimientocuentas'];
			$model->CUEN_ID = $_POST['Cuentas']["CUEN_ID"];
			$model->SEUD_ID = $model->attributes=$_POST['Seguimientocuentas']["SEUD_ID"];
			$model->SECU_ESTADO = $model->attributes=$_POST['Seguimientocuentas']["SECU_ESTADO"];
			$model->SECU_NUMORDENPAGO = $model->attributes=$_POST['Seguimientocuentas']["SECU_NUMORDENPAGO"];
			$model->SECU_VRORDENPAGO = $model->attributes=$_POST['Seguimientocuentas']["SECU_VRORDENPAGO"];
			$model->SECU_CODIGOCDP = $model->attributes=$_POST['Seguimientocuentas']["SECU_CODIGOCDP"];
			$model->SECU_NUMCHECQUE = $model->attributes=$_POST['Seguimientocuentas']["SECU_NUMCHECQUE"];
			$model->SECU_VALORCHEQUE = $model->attributes=$_POST['Seguimientocuentas']["SECU_VALORCHEQUE"];
			$model->SECU_FECHAPAGO = $model->attributes=$_POST['Seguimientocuentas']["SECU_FECHAPAGO"];
			if($model->save()){
				if($model->SECU_ESTADO==1){
				 $model->CUEN_ID = $id;
				 $model->cambiarEstado($id,2);
				 $model->enviarEmail($model->CUEN_ID,$Seguimientouserdependencias->DEPE_ID,$model->SECU_ESTADO);
				 $this->redirect(array('mdltcuentas/devolucionescuentas/create','id'=>$model->SECU_ID));
		        }else{
				      $model->CUEN_ID = $id;
					  $model->cambiarEstado($id,$estadoCta);			    
					   $model->enviarEmail($model->CUEN_ID,$Seguimientouserdependencias->DEPE_ID,$model->SECU_ESTADO);					  
					   $this->redirect(array('admin','id'=>$model->CUEN_ID));
				}
			}
		}
        $Cuentas = Cuentas::model()->findByPk($id);
		$model->SEUD_ID = $Usuariosdependencias->SEUD_ID;
		$model->CUEN_ID = $id;
		$model->DEPENDENCIA = $Seguimientouserdependencias->DEPE_ID;
		$this->render('create',array(
			'model'=>$model,
			'Cuentas'=>$Cuentas,
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
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariosdependencias = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariosdependencias->SEUD_ID);
		$Usuariosdependencia = Seguimientouserdependencias::model()->findByPK($model->SEUD_ID);
		
		if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
		$estadoCta = 1; 
		}elseif($Seguimientouserdependencias->DEPE_ID==49){
		$estadoCta = 3; 
		}elseif($Seguimientouserdependencias->DEPE_ID==17){
		$estadoCta = 4; 
		}elseif($Seguimientouserdependencias->DEPE_ID==18){
		$estadoCta = 5; 
		}elseif($Seguimientouserdependencias->DEPE_ID==8){
		$estadoCta = 6; 
		}elseif($Seguimientouserdependencias->DEPE_ID==4){
		$estadoCta = 7; 
		}

		if(isset($_POST['Seguimientocuentas']))
		{
			
			if($Usuariosdependencia->DEPE_ID == $Seguimientouserdependencias->DEPE_ID){
			
			
			$model->attributes=$_POST['Seguimientocuentas'];
			$model->SEUD_ID = $model->attributes=$_POST['Seguimientocuentas']["SEUD_ID"];
			$model->SECU_NUMORDENPAGO = $model->attributes=$_POST['Seguimientocuentas']["SECU_NUMORDENPAGO"];
			$model->SECU_ESTADO = $model->attributes=$_POST['Seguimientocuentas']["SECU_ESTADO"];
			$model->SECU_VRORDENPAGO = $model->attributes=$_POST['Seguimientocuentas']["SECU_VRORDENPAGO"];
			$model->SECU_CODIGOCDP = $model->attributes=$_POST['Seguimientocuentas']["SECU_CODIGOCDP"];
			$model->SECU_NUMCHECQUE = $model->attributes=$_POST['Seguimientocuentas']["SECU_NUMCHECQUE"];
			$model->SECU_VALORCHEQUE = $model->attributes=$_POST['Seguimientocuentas']["SECU_VALORCHEQUE"];
			$model->SECU_FECHAPAGO = $model->attributes=$_POST['Seguimientocuentas']["SECU_FECHAPAGO"];
			if($model->save()){
				if($model->SECU_ESTADO==1){
				$model->cambiarEstado($model->CUEN_ID,2);
				$model->enviarEmail($model->CUEN_ID,$Seguimientouserdependencias->DEPE_ID,$model->SECU_ESTADO); 
				$this->redirect(array('mdltcuentas/devolucionescuentas/create','id'=>$model->SECU_ID));
		        }else{
			          $Cuentas = Cuentas::model()->findByPk($model->CUEN_ID);
					  $model->cambiarEstado($Cuentas->CUEN_ID,$estadoCta);
					  $model->enviarEmail($model->CUEN_ID,$Seguimientouserdependencias->DEPE_ID,$model->SECU_ESTADO); 
					  $this->redirect(array('admin','id'=>$model->CUEN_ID));
					 }
			}
			
			
			}
			 else{
				 Yii::app()->user->setFlash('success',"Error 400, usted no tiene permiso para editar este registro!");			 	 
		    }
			
		}


		$Seguimientocuentas = Seguimientocuentas::model()->findByPk($id);
		$Cuentas = Cuentas::model()->findByPk($Seguimientocuentas->CUEN_ID);
		$model->SEUD_ID = $Usuariosdependencias->SEUD_ID;
		$model->CUEN_ID = $id;
		$model->DEPENDENCIA = $Seguimientouserdependencias->DEPE_ID;
		$this->render('update',array(
			'model'=>$model,
			'Cuentas'=>$Cuentas,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariosdependencias = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariosdependencias->SEUD_ID);
		if($Seguimientouserdependencias->DEPE_ID==1 OR $Seguimientouserdependencias->DEPE_ID==14){
			$estadoCta = 0; 
			}elseif($Seguimientouserdependencias->DEPE_ID==49){
			$estadoCta = 1; 
			}elseif($Seguimientouserdependencias->DEPE_ID==17){
			$estadoCta = 3; 
			}elseif($Seguimientouserdependencias->DEPE_ID==18){
			$estadoCta = 4; 
			}elseif($Seguimientouserdependencias->DEPE_ID==8){
			$estadoCta = 5; 
			}elseif($Seguimientouserdependencias->DEPE_ID==4){
			$estadoCta = 6; 
			}
			
		if(Yii::app()->request->isPostRequest)
		{
			$model=$this->loadModel($id);
			$Usuariosdependencia = Seguimientouserdependencias::model()->findByPK($model->SEUD_ID);
			
			if($Usuariosdependencia->DEPE_ID == $Seguimientouserdependencias->DEPE_ID){
				
			$Cuentas = Cuentas::model()->findByPk($model->CUEN_ID);
			$model->cambiarEstado($Cuentas->CUEN_ID,$estadoCta);
			// we only allow deletion via POST request
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
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

	public function actionAdmin($id)
	{
		$model=new Seguimientocuentas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientocuentas']))
			$model->attributes=$_GET['Seguimientocuentas'];
        $Cuentas = Cuentas::model()->findByPk($id);
		$model->CUEN_ID = $id;
		$this->render('admin',array(
			'model'=>$model,
			'Cuentas'=>$Cuentas,
		));
	}
	


	public function loadModel($id)
	{
		$model=Seguimientocuentas::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='seguimientocuentas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
