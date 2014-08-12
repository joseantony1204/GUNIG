<?php

class ModeloordenesController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'',''.$array[10].'',''.$array[11].'',''.$array[12].'',
				''.$array[13].'',''.$array[14].'',''.$array[15].'',''.$array[16].'',''.$array[17].'',''.$array[18].'',''.$array[19].''
				,''.$array[20].'',''.$array[21].'',''.$array[22].'',''.$array[23].'',''.$array[24].''),
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
	
	
	public function actionViewsupervisores($id)
	{
		$this->render('viewsupervisores',array(
			'model'=>$this->loadModel($id),
		));
		
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$Modeloordenes = new Modeloordenes;
		$Contratos = new Contratos;
		$Formcontratosformatos = new Formcontratosformatos;
		$Personas = new Personas;
		$Supervisores = new Supervisores;
		$Presupuestos = new Presupuestos;
		$Presupuestosordenes = new Presupuestosordenes;
		$Evacriterios = new Evacriterios;
		$Evamodeloscriterios = new Evamodeloscriterios;
		
		
		$FormatoFechas = new FormatearFechas();
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Modeloordenes']) & (isset($_POST['Contratos'])) & (isset($_POST['Formcontratosformatos'])) & (isset($_POST['Supervisores'])) & (isset($_POST['Presupuestos']))  & (isset($_POST['Presupuestosordenes'])))
		{
		$Contratos->attributes=$_POST['Contratos'];
		$Contratos->PERS_ID = $_POST['PERS_ID'];
		
		$Contratante = $Modeloordenes->rectorcontratos($id,$Contratos);
		$Contratos->PECO_ID=$Contratante["PECO_ID"];
		$Contratos->CONT_FECHAPROCESO = $Contratos->attributes=$_POST['Contratos']["CONT_FECHAPROCESO"];	
		
		$Contratos->obtenerNumContratacion($Contratos->TICO_ID,$Contratos->CLCO_ID);		
			
			if($Contratos->save())
			{
			$Contrato = $Contratos->loadLastData($Contratos->PERS_ID,$Contratos->TICO_ID,$Contratos->CLCO_ID,$Contratos->CONT_FECHAPROCESO);
			$Formcontratosformatos->attributes=$_POST['Formcontratosformatos'];	
			$Formcontratosformatos->CONT_ID = $Contrato->CONT_ID;
			
			if($Formcontratosformatos->save())
			$Supervisores->attributes=$_POST['Supervisores'];
			$Supervisores->PERS_ID = $_POST['PERSU_ID'];
			//$Supervisores->CARG_ID = $_POST['CARG_ID'];
			$Supervisores->CONT_ID = $Contrato->CONT_ID;	
			
				if($Supervisores->save())
				$Modeloordenes->attributes=$_POST['Modeloordenes'];
				$Modeloordenes->CONT_ID = $Contrato->CONT_ID;	
				$Modeloordenes->FCCO_ID = $Formcontratosformatos->FCCO_ID;

				
					if($Modeloordenes->save())
					$Presupuestos->attributes=$_POST['Presupuestos'];
					$certificado = $Presupuestos->attributes['PRES_NUM_CERTIFICADO'];
					$fecha = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_VIGENCIA"];
					$seccion = $Presupuestos->attributes['PRES_SECCION'];
					$codigo = $Presupuestos->attributes['PRES_CODIGO'];
					$FormatoFechas->fechaLarga($fecha);
					$Presupuestos->PRES_FECHA_INGRESO = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_INGRESO"];
					$nombre = "No. ".$certificado.", del ".$FormatoFechas->fecha." Seccion ".$seccion." codigo ".$codigo;
					$Presupuestos->PRES_NOMBRE = $nombre; 
					
					//$Formcontratosformatos = $Formcontratosformatos->loadLastData();
					//$Presupuestos->PRES_DESCRIPCION = $Formcontratosformatos->FCCO_ID;
					
				//	$Presupuestos->PRES_DESCRIPCION=$Formcontratosformatos->FCCO_ID;

						if($Presupuestos->save())
						$Presupuestos = $Presupuestos->loadLastData2($Presupuestos->PRES_FECHA_INGRESO,$Presupuestos->PRES_NUM_CERTIFICADO,$Presupuestos->PRES_SECCION,$Presupuestos->PRES_CODIGO);
						$Modeloordenes = $Modeloordenes->loadLastData($Modeloordenes->CONT_ID);
						$Presupuestosordenes->attributes=$_POST['Presupuestosordenes'];
						$Presupuestosordenes->MOOR_ID = $Modeloordenes->MOOR_ID;
						$Presupuestosordenes->PRES_ID = $Presupuestos->PRES_ID;
						
	
//EVTC clase: 1 BIENES, 2 SERVICIOS, 3 OBRAS
//2 servcios: (20, 180 ORDEN PRESTACION DE SERVICIO), 50 ORDEN TRABAJO, 60 ORDEN ARRENDAMIENTO, (80, 170 CONTRATO PRESTACION DE SERVICIOS), 110 CONSULRORÍA, 150 SEGUROS
//1 bienes: 30 SUMINISTRO, 40 COMPRAVENTA, 90 SUMINISTRO, 100 COMPRAVENTA, 120 ARRENDAMIENTO
//3 obras: 140 OBRA
					
					$clasecont=$Contratos["CLCO_ID"];
					
					if($clasecont==20 or $clasecont==50 or $clasecont==60 or $clasecont==80 or $clasecont==110 or $clasecont==150 or $clasecont==170 or $clasecont==180){
					$clase=2;
						$lista = $Evacriterios->AllEvacriterios($clase);
						
						foreach($lista as $data){	
						$Modeloordenes = $Modeloordenes->loadLastData($Modeloordenes->CONT_ID);
						$MOOR_ID = $Modeloordenes->MOOR_ID;
						$agregarEvamodeloscriterios = $Evamodeloscriterios->agregarEvamodeloscriterios('NULL',0000-00-00,$MOOR_ID,$data['EVCR_ID'],2);			
						}
					
					}elseif($clasecont==30 or $clasecont==40 or $clasecont==90 or $clasecont==100 or $clasecont==120){
					$clase=1;
						$lista = $Evacriterios->AllEvacriterios($clase);
						foreach($lista as $data){	
						$Modeloordenes = $Modeloordenes->loadLastData($Modeloordenes->CONT_ID);
						$MOOR_ID = $Modeloordenes->MOOR_ID;
						$agregarEvamodeloscriterios = $Evamodeloscriterios->agregarEvamodeloscriterios('NULL',0000-00-00,$MOOR_ID,$data['EVCR_ID'],2);			
						}
					
					}elseif($clasecont==140){
					$clase=3;
						$lista = $Evacriterios->AllEvacriterios($clase);
						foreach($lista as $data){	
						$Modeloordenes = $Modeloordenes->loadLastData($Modeloordenes->CONT_ID);
						$MOOR_ID = $Modeloordenes->MOOR_ID;
						$agregarEvamodeloscriterios = $Evamodeloscriterios->agregarEvamodeloscriterios('NULL',0000-00-00,$MOOR_ID,$data['EVCR_ID'],2);					
						}
					}					
						
			
						
						if($Presupuestosordenes->save()) 
						{
						$this->redirect(array('admin'));
						//$this->redirect(array('admin','id'=>$model->MOOR_ID));
						}else{
						throw new CHttpException(400,'¡ERROR AL CREAR UNA ORDEN!');
			    		}
			}
		}
		$this->render('create',array(
			'Modeloordenes'=>$Modeloordenes,
			'Contratos'=>$Contratos,
			'Formcontratosformatos'=>$Formcontratosformatos,
			'Personas'=>$Personas,			
			'Presupuestos'=>$Presupuestos,
			'Presupuestosordenes'=>$Presupuestosordenes,
			'Supervisores'=>$Supervisores,
		));
	}
	
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	 
	public function actionUpdate($id)
	{
		$Modeloordenes=$this->loadModel($id);		
		
		$Formclasescontratos = Formclasescontratos::model()->findByPk($Modeloordenes->FCCO_ID);
		$Contratos = Contratos::model()->findByPk($Modeloordenes->CONT_ID);
		
		$criteria = new CDbCriteria;
	    $criteria->condition = 'CONT_ID = '.$Contratos->CONT_ID;		
		$Formcontratosformatos = Formcontratosformatos::model()->find($criteria);		
		$Formclasescontratos = Formclasescontratos::model()->findByPk($Formcontratosformatos->FCCO_ID);
		
		$Personas = Personas::model()->findByPk($Contratos->PERS_ID);
		
		$criteria = new CDbCriteria;
	    $criteria->condition = 'MOOR_ID = '.$Modeloordenes->MOOR_ID;		
		$PresupuestosordenesContratos = Presupuestosordenes::model()->find($criteria);		
		$Presupuestosordenes = Presupuestosordenes::model()->findByPk($PresupuestosordenesContratos->PROR_ID);
		
		$Presupuestos = Presupuestos::model()->findByPk($Presupuestosordenes->PRES_ID);
		$FormatoFechas = new FormatearFechas();
		
		$criteria = new CDbCriteria;
	    $criteria->condition = 'CONT_ID = '.$Contratos->CONT_ID;		
		$SupervisoresContratos = Supervisores::model()->find($criteria);		
		$Supervisores = Supervisores::model()->findByPk($SupervisoresContratos->SUPE_ID);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Modeloordenes']) & (isset($_POST['Contratos'])) & (isset($_POST['Formcontratosformatos'])) & (isset($_POST['Supervisores'])) & (isset($_POST['Presupuestos']))  & (isset($_POST['Presupuestosordenes'])))
		{

				
		$Contratos->attributes=$_POST['Contratos'];
		$Modeloordenes->attributes = $_POST['Modeloordenes'];
		$Formcontratosformatos->attributes = $_POST['Formcontratosformatos'];
		$Supervisores->attributes = $_POST['Supervisores'];
		$Presupuestos->attributes = $_POST['Presupuestos'];
		//$Presupuestosordenes->attributes = $_POST['Presupuestosordenes'];

		$Contratos->PERS_ID = $_POST['PERS_ID'];
		$Contratante = $Modeloordenes->rectorcontratos($id,$Contratos);
		$Contratos->PECO_ID=$Contratante["PECO_ID"];
		$Contratos->CONT_FECHAFINAL = $Contratos->attributes=$_POST['Contratos']["CONT_FECHAPROCESO"];
		
			if($Contratos->save())
			{
			
			if($Formcontratosformatos->save())
			$Supervisores->PERS_ID =  $Supervisores->attributes=$_POST["PERSU_ID"];
		
				if($Supervisores->save())
		
					if($Modeloordenes->save())
					$certificado = $Presupuestos->attributes['PRES_NUM_CERTIFICADO'];
					$fecha = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_VIGENCIA"];
					$seccion = $Presupuestos->attributes['PRES_SECCION'];
					$codigo = $Presupuestos->attributes['PRES_CODIGO'];
					$FormatoFechas->fechaLarga($fecha);
					$Presupuestos->PRES_FECHA_INGRESO = $Presupuestos->attributes=$_POST['Presupuestos']["PRES_FECHA_INGRESO"];
					$nombre = "No. ".$certificado.", del ".$FormatoFechas->fecha." Seccion ".$seccion." codigo ".$codigo;
					$Presupuestos->PRES_NOMBRE = $nombre; 
					
						if($Presupuestos->save())
						
						$this->redirect(array('admin'));

						}else{
						throw new CHttpException(400,'¡ERROR AL ACTUALIZAR UNA ORDEN O CONTRATO!');
			    		}

			}

		$this->render('update',array(
			'Modeloordenes'=>$Modeloordenes,
			'Contratos'=>$Contratos,
			'Formcontratosformatos'=>$Formcontratosformatos,
			'Personas'=>$Personas,			
			'Presupuestos'=>$Presupuestos,
			'Presupuestosordenes'=>$Presupuestosordenes,
			'Supervisores'=>$Supervisores,
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
		$dataProvider=new CActiveDataProvider('Modeloordenes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Modeloordenes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Modeloordenes']))
			$model->attributes=$_GET['Modeloordenes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionadminsupervisores()
	{
		$model=new Modeloordenes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Modeloordenes']))
			$model->attributes=$_GET['Modeloordenes'];

		$this->render('adminsupervisores',array(
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
		$model=Modeloordenes::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='modeloordenes-form')
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
        echo CHtml::tag('option', array('value' => ''), 'Seleccione la clase del contrato', true);
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
	 
    public function actionDownload($id=NULL){
	 $Modeloordenes = new Modeloordenes;	 
	 $this->render('download',array(
	                               'Modeloordenes'=>$Modeloordenes,
								   )
				   );
    }
	
	  public function actionAnexo1($id=NULL){
	 $Modeloordenes = new Modeloordenes;	 
	 $this->render('anexo1',array(
	                               'Modeloordenes'=>$Modeloordenes,
								   )
				   );
    }
	
	  public function actionAnexo2($id=NULL){
	 $Modeloordenes = new Modeloordenes;	 
	 $this->render('anexo2',array(
	                               'Modeloordenes'=>$Modeloordenes,
								   )
				   );
    }
	
	public function actionAnexo3($id=NULL){
	 $Modeloordenes = new Modeloordenes;	 
	 $this->render('anexo3',array(
	                               'Modeloordenes'=>$Modeloordenes,
								   )
				   );
    }
	
public function actionInvitacion($id,$Invitaciones=NULL)
	{
	  $model=new Modeloordenes('search');
	  $model->unsetAttributes();
	  $Modeloordenes = new Modeloordenes;
	  $Invitaciones = new Invitaciones;
	  if((isset($_POST['Invitaciones'])))
	  {
	   $Invitaciones->attributes=$_POST['Invitaciones'];	   
	   $registros = $Modeloordenes->downloadInvitados($id,$Invitaciones);
	   
	   $model->MOOR_ID=$id;
	   $this->render('rep_invitacion',array(
		                                    
											  'Invitaciones'=>$Invitaciones,										  	
		                                      'Modeloordenes'=>$Modeloordenes,
											 ));  	  
	  }	  
	  $model->MOOR_ID=$id;
	  $this->render('invitacion',array(
		                           'Modeloordenes'=>$Modeloordenes,
								   'Invitaciones'=>$Invitaciones,
								   'model'=>$model,			
		                          )
		);
	}
	
	
	public function actionEvaluacion($id,$Evaluaciones=NULL)
	{
	  $model=new Modeloordenes('search');
	  $model->unsetAttributes();
	  $Modeloordenes = new Modeloordenes;
	  $Evaluaciones = new Evaluaciones;
	  if((isset($_POST['Evaluaciones'])))
	  {
	   $Evaluaciones->attributes=$_POST['Evaluaciones'];	   
	   $model->MOOR_ID=$id;
	   $this->render('anexo3',array(
											  'Evaluaciones'=>$Evaluaciones,										  	
		                                      'Modeloordenes'=>$Modeloordenes,
											 ));  	  
	  }	  
	  $model->MOOR_ID=$id;
	  $this->render('evaluacion',array(
		                           'Modeloordenes'=>$Modeloordenes,
								   'Evaluaciones'=>$Evaluaciones,
								   'model'=>$model,			
		                          )
		);
	}
	
	
}
