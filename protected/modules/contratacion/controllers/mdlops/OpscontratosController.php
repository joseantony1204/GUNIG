<?php

class OpscontratosController extends Controller
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
		$Opscontratos = new Opscontratos;
		$Contratos = new Contratos;
		$Formclasescontratos = new Formclasescontratos;
		$Formcontratosformatos = new Formcontratosformatos;
		$Salariosminimos = new Salariosminimos;
		$Personas = Personas::model()->findByPk($id);
		$Opscontratos->NOMBREPERSONA = $Personas->nombrePersona;
		$Supervisores = new Supervisores;
		
        $Contratos->PERS_ID = $id;
		$criterio = array('select'=>'ANAC_ID','join'=>'WHERE t.ANAC_ESTADO = 0','limit'=>1);  
	    $data = Aniosacademicos::model()->find($criterio);		 		
		
		$Contratos->CONT_ANIO = (int)(substr($data['ANAC_ID'],0,4));
		//$Contratos->obtenerNumOrden($Contratos->CONT_ANIO,2,14);

		if((isset($_POST['Opscontratos'])) & (isset($_POST['Contratos'])))
		{
			$Opscontratos->attributes=$_POST['Opscontratos'];
			$Contratos->attributes=$_POST['Contratos'];
			$Formcontratosformatos->attributes=$_POST['Formcontratosformatos'];
			
			$Contratos->PECO_ID=$_POST['Contratos']['PECO_ID'];
			$Contratos->CONT_FECHAPROCESO = $Contratos->attributes=$_POST['Contratos']["CONT_FECHAPROCESO"];
			$Contratos->obtenerNumOrden($Contratos->CONT_ANIO,$Contratos->TICO_ID,$Contratos->CLCO_ID);
			 if($Contratos->save()){
			  $Contrato = $Contratos->loadLastData($Contratos->PERS_ID,$Contratos->TICO_ID,$Contratos->CLCO_ID,$Contratos->CONT_FECHAPROCESO);	
			  $Opscontratos->CONT_ID = $Contrato->CONT_ID;
			  $Formcontratosformatos->CONT_ID = $Contrato->CONT_ID;
			   if($Formcontratosformatos->save()){
			    if($Opscontratos->save()){
				   
				   $criteria = new CDbCriteria;	               
				   $criteria->condition = 'DEPE_ID = '.$Opscontratos->DEPE_ID;		
		           if($Jefesdependencia = Jefesdependencias::model()->find($criteria)){	
				    $Personasnaturales = Personasnaturales::model()->findByPk($Jefesdependencia->PENA_ID);				  
				    $Supervisores->PERS_ID = $Personasnaturales->PERS_ID;
				    $Supervisores->CARG_ID = 175;
				    $Supervisores->CONT_ID = $Opscontratos->CONT_ID;
				    $Supervisores->save();
				   }	
					
				 $this->redirect(array('admin',));
		        }else{
			          throw new CHttpException(400,'Error creando el contrato - ops...');
			         }
			   }else{
			         throw new CHttpException(400,'Error agregando el formato contrato...');
			        }
			 }else{
			       throw new CHttpException(400,'Error creando el contrato...');
			      }
		}

		$this->render('create',array(
			'Opscontratos'=>$Opscontratos,
			'Contratos'=>$Contratos,
			'Formclasescontratos'=>$Formclasescontratos,
			'Formcontratosformatos'=>$Formcontratosformatos,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$Opscontratos=$this->loadModel($id);
		$Contratos = Contratos::model()->findByPk($Opscontratos->CONT_ID);
		$Supervisores = new Supervisores;
		
		$criteria = new CDbCriteria;
	    $criteria->condition = 'CONT_ID = '.$Contratos->CONT_ID;		
		$Formcontratosformatos = Formcontratosformatos::model()->find($criteria);		
		$Formclasescontratos = Formclasescontratos::model()->findByPk($Formcontratosformatos->FCCO_ID);

		$Personas = Personas::model()->findByPk($Contratos->PERS_ID);
		$Opscontratos->NOMBREPERSONA = $Personas->nombrePersona;

		if((isset($_POST['Opscontratos'])) & (isset($_POST['Opscontratos'])))
		{
			$Opscontratos->attributes=$_POST['Opscontratos'];
			$Contratos->attributes=$_POST['Contratos'];
			$Formcontratosformatos->attributes=$_POST['Formcontratosformatos'];
			$Contratos->PECO_ID=$_POST['Contratos']['PECO_ID'];
			
			if($Contratos->save()){	
			 if($Formcontratosformatos->save()){		 
			  if($Opscontratos->save()){
				  
				$criteria = new CDbCriteria;
	            $criteria->condition = 'CONT_ID = '.$Opscontratos->CONT_ID;
				if(!$Supervisor = Supervisores::model()->find($criteria)){
				
				  $criteria = new CDbCriteria;
	              $criteria->condition = 'DEPE_ID = '.$Opscontratos->DEPE_ID;		
		          if($Jefesdependencia = Jefesdependencias::model()->find($criteria)){	
				   $Personasnaturales = Personasnaturales::model()->findByPk($Jefesdependencia->PENA_ID);				  
				   $Supervisores->PERS_ID = $Personasnaturales->PERS_ID;
				   $Supervisores->CARG_ID = 175;
				   $Supervisores->CONT_ID = $Opscontratos->CONT_ID;
				   $Supervisores->save();
				  }
				}else{
					 $criteria = new CDbCriteria;
	                 $criteria->condition = 'CONT_ID = '.$Opscontratos->CONT_ID;
				     $Supervisor = Supervisores::model()->find($criteria);					 
					 $Supervisores = Supervisores::model()->findByPk($Supervisor->SUPE_ID);
					  $criteria = new CDbCriteria;
					  $criteria->condition = 'DEPE_ID = '.$Opscontratos->DEPE_ID;		
					  if($Jefesdependencia = Jefesdependencias::model()->find($criteria)){	
					   $Personasnaturales = Personasnaturales::model()->findByPk($Jefesdependencia->PENA_ID);				  
					   $Supervisores->PERS_ID = $Personasnaturales->PERS_ID;
					   $Supervisores->CARG_ID = 175;
					   $Supervisores->CONT_ID = $Opscontratos->CONT_ID;
					   $Supervisores->save();
					  } 
					 }
				  
				$this->redirect(array('admin',));
		      }else{
			       throw new CHttpException(400,'Error actualizando el contrato - ops...');
			       }
			 }else{
			       throw new CHttpException(400,'Error actualizando el formato contrato...');
			      }
			}else{
			       throw new CHttpException(400,'Error actualizando el contrato...');
			      }
		}

		$this->render('update',array(
			'Opscontratos'=>$Opscontratos,
			'Contratos'=>$Contratos,
			'Formclasescontratos'=>$Formclasescontratos,
			'Formcontratosformatos'=>$Formcontratosformatos,
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
		Yii::import("application.extensions.xupload.models.XUploadForm");
        $model = new XUploadForm;
        $this -> render('index', array('model' => $model, ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$Opscontratos = new Opscontratos('search');
		$Contratos = new Contratos('search');
		$Personas = new Personas('search');
		
		$Opscontratos->unsetAttributes();
		$Contratos->unsetAttributes();  // clear any default values
		if((isset($_GET['Opscontratos'])) or (isset($_GET['Contratos']))){
			$Opscontratos->attributes=$_GET['Opscontratos'];
			$Contratos->attributes=$_GET['Contratos'];
			$Personas->attributes=$_GET['Personas'];
            $Opscontratos->CONT_ID = $Contratos->CONT_ID;
			
	   }
		$this->render('admin',array(
			'model'=>$Opscontratos,
			'Contratos'=>$Contratos,
			'Personas'=>$Personas,
		));
	}

	public function actionSearchPersonas()
	{
		$Personas = new Personas('search');		
		$Personas->unsetAttributes();
		
		if(isset($_GET['Personas']))
			$Personas->attributes=$_GET['Personas'];
		
		$this->render('searchPersonas',array(
			'Personas'=>$Personas,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Opscontratos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='opscontratos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
     public function actionClasesc()
        {   
		$filtro = $_POST['Contratos']['TICO_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'TICO_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'CLCO_NOMBRE ASC';
				
		$lista = Contratosclase::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'CLCO_ID','CLCO_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione clase de contrato', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
	 
     public function actionFormclcontrato()
        {   
		$filtro = $_POST['Contratos']['CLCO_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'CLCO_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'FCCO_NOMBRE ASC';
				
		$lista = Formclasescontratos::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'FCCO_ID','FCCO_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione formato para el contrato', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }	 	
	 
    public function actionDownload($id=NULL,$sede=NULL,$dependencia=NULL,$opcion=NULL){
     $Opscontratos = new Opscontratos;
	 
	 if($_REQUEST['opcion']=='true'){
	  $paramsOpscontratos = Yii::app()->user->getState('OpscontratosSearchParams');
	  $data = $paramsOpscontratos->getData();	  
	  $this->render('download',array(
	                               'Opscontratos'=>$Opscontratos,
								   'Registros'=>$data,
								   )
				   );
	 }      
	 $this->render('download',array(
	                               'Opscontratos'=>$Opscontratos,
								   )
				   );
    }
	
	public function actionAdminSupervisores()
	{
		$model = new Opscontratos('searchSupervisores');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Opscontratos']))
			$model->attributes=$_GET['Opscontratos'];

		$this->render('adminSupervisores',array(
			'model'=>$model,
		));
	}	 
}
