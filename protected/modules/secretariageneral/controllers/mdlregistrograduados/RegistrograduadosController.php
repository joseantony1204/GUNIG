<?php

class RegistrograduadosController extends Controller
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
                                 ''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'',  
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
		$model=$this->loadModel($id);
	
	 if(isset($_GET['pdf'])){
			
		$mPDF1 = Yii::app()->ePdf->mpdf();
	  $mPDF1->WriteHTML($this->render('pdf',array(
			'model'=>$model,
		), true)
		);  
	   $mPDF1->Output();
		}else{
	
		$this->render('view',array(
			'model'=>$model,
		));
		
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Registrograduados;
		$libros= new Libros;
      $folios= new Folios;
	  $rectores = new Rectores;
	  $decanos = new Decanos;
	  $secretarios =new Secretariosgenerales;
	  	  $programas =new Programas;
		  $fechasgrados= new Fechasgrados;
		  $titulos= new Titulos;
		   $codigosicfes= new Codigosicfes;
	   

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $graduados = new Graduados;
        $titulostrabajogrados=new Titulostrabajosgrados;
	    if((isset($_POST['Graduados'])) && (($_POST['Graduados']['GRAD_CEDULA']!="")))
	        {
            $graduados->attributes=$_POST['Graduados'];
			$cedulaExiste=$graduados->cedulaGraduadoExiste($graduados->GRAD_CEDULA);
			if($cedulaExiste==1){
            $graduados->save();
			}else{
				 Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>La cédula del graduado que esta ingresado, ya se encuentra registrada, Favor revisar.');
				}
			               
        }elseif((isset($_POST['Titulostrabajosgrados'])) && (($_POST['Titulostrabajosgrados']['TITG_NOMBRE']!=""))){
			$titulostrabajogrados->attributes=$_POST['Titulostrabajosgrados'];
			$titulosExiste=$titulostrabajogrados->titulogradoExiste($titulostrabajogrados->TITG_NOMBRE);
			if($titulosExiste==1){
            $titulostrabajogrados->save();
			}else{
				  Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>El titulo del trabajo de graduado que esta ingresado, ya se encuentra registrado, Favor revisar.');
				 
				}
			}
else{
		if(isset($_POST['Registrograduados']))
		{ 
			$model->attributes=$_POST['Registrograduados'];
			$model->FEGR_ID=$_POST['Registrograduados']["FEGR_ID"];
			$model->GRAD_ID=$_POST['Registrograduados']["GRAD_ID"];
			$model->COIC_ID=$_POST['Registrograduados']["COIC_ID"];
			$model->TITG_ID=$_POST['Registrograduados']["TITG_ID"];
			
			$model->REGR_ACTA= $model->getNextActa();
			$model->LIBR_ID= $libros->getLibroActivo();
			$model->FOLI_ID= $folios->setFolios($model->LIBR_ID);
			
			$model->TITU_ID=$codigosicfes->getTituloApartirCodigoicfes($model->COIC_ID);
			$model->SEDE_ID=$codigosicfes->getSedeApartirCodigoicfes($model->COIC_ID);	
			$model->METO_ID=$codigosicfes->getMetodlogiaApartirCodigoicfes($model->COIC_ID);
			$model->JORN_ID=$codigosicfes->getJornadaApartirCodigoicfes($model->COIC_ID);	
			
			$model->PROG_ID= $titulos->getProgramaTitulo($model->TITU_ID);
			$model->NIES_ID=$programas->getNivelEstudioPrograma($model->PROG_ID);			
			$FECHA= $fechasgrados->FechaGrado($model->FEGR_ID);
			
			
			$model->FACU_ID= $programas->facultadPrograma($model->PROG_ID);
			$model->SEGE_ID=$secretarios->getSecretarioporFechaGrado($FECHA);
			$model->RECT_ID=$rectores->getRectoresFechaGrado($FECHA);
			$model->DECA_ID=$decanos->getDecanosFechaGrado($FECHA, $model->FACU_ID);
			
			
		if($model->save())
			$CREO=$libros->getNumeroFoliosDeLibro($model->LIBR_ID);
		       $this->redirect(array('admin','id'=>$model->REGR_ID));
				
				
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
		$model=$this->loadModel($id);
		$libros= new Libros;
      $folios= new Folios;
	  $rectores = new Rectores;
	  $decanos = new Decanos;
	  $secretarios =new Secretariosgenerales;
	  	  $programas =new Programas;
		  $fechasgrados= new Fechasgrados;
		  $titulos= new Titulos;
		  $codigosicfes= new Codigosicfes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Registrograduados']))
		{
			$model->attributes=$_POST['Registrograduados'];
			
			$model->FEGR_ID=$_POST['Registrograduados']["FEGR_ID"];
			$model->GRAD_ID=$_POST['Registrograduados']["GRAD_ID"];
			$model->COIC_ID=$_POST['Registrograduados']["COIC_ID"];
			$model->TITG_ID=$_POST['Registrograduados']["TITG_ID"];
			
			/*$model->REGR_ACTA= $model->getNextActa();
			$model->LIBR_ID= $libros->getLibroActivo();
			$model->FOLI_ID= $folios->setFolios($model->LIBR_ID);*/
			
			$model->TITU_ID=$codigosicfes->getTituloApartirCodigoicfes($model->COIC_ID);
			$model->SEDE_ID=$codigosicfes->getSedeApartirCodigoicfes($model->COIC_ID);	
			$model->METO_ID=$codigosicfes->getMetodlogiaApartirCodigoicfes($model->COIC_ID);
			$model->JORN_ID=$codigosicfes->getJornadaApartirCodigoicfes($model->COIC_ID);	
			
			$model->PROG_ID= $titulos->getProgramaTitulo($model->TITU_ID);
			$model->NIES_ID=$programas->getNivelEstudioPrograma($model->PROG_ID);			
			$FEGR_FECHA= $fechasgrados->FechaGrado($model->FEGR_ID);
			
			
			$model->FACU_ID= $programas->facultadPrograma($model->PROG_ID);
			$model->SEGE_ID=$secretarios->getSecretarioporFechaGrado($FEGR_FECHA);
			$model->RECT_ID=$rectores->getRectoresFechaGrado($FEGR_FECHA);
			$model->DECA_ID=$decanos->getDecanosFechaGrado($FEGR_FECHA, $model->FACU_ID);
			
			
			if($model->save())
				$this->redirect(array('admin','id'=>$model->REGR_ID));
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
		$dataProvider=new CActiveDataProvider('Registrograduados');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Registrograduados('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registrograduados']))
			$model->attributes=$_GET['Registrograduados'];

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
		$model=Registrograduados::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='registrograduados-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	 public function actiongetTitulos()
        {   
		$filtro = $_POST['model']['PROG_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'PROG_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'TITU_NOMBRES ASC';
				
		$lista = Titulos::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'TITU_ID','TITU_NOMBRES');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione Titulos', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
	 
	 public function actionPdf($id)
	{ 
	        
			$model=$this->loadModel($id);
			$this->render('pdf',array('model'=>$model,
		));
		
	}
	
	public function actionExcel()
	{ 
	$this->render('excel');

	}
	
	public function CargarProgramas(){
		$id = $_POST['Sedes']['SEDE_ID']; 
		
		$sql =  "SELECT PROG_ID, PROG_NOMBRE WHERE SEDE_ID = '$id'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryAll();
		$lista=CHtml::listData($query, 'PROG_ID',  'PROG_NOMBRE' );
		echo CHtml::tag('option', array('value' => ''), 'Seleccione ...', true);       
		foreach($lista as $clave => $dato){
			echo CHtml::tag('option',array('value'=>$clave), CHtml::encode($dato), true);
		}/**/	
		}
		
		public function CargarTitulos(){
		$id = $_POST['Programas']['PROG_ID']; 
		
		$sql =  "SELECT PROG_ID, PROG_NOMBRE WHERE PROG_ID = '$id'";
		$connection = Yii::app()->db;
		$query = $connection->createCommand($sql)->queryAll();
		$lista=CHtml::listData($query, 'PROG_ID',  'PROG_NOMBRE' );
		echo CHtml::tag('option', array('value' => ''), 'Seleccione ...', true);       
		foreach($lista as $clave => $dato){
			echo CHtml::tag('option',array('value'=>$clave), CHtml::encode($dato), true);
		}/**/	
		}


 public function actionActa($id)
	{ 
	        
			//$model=$this->loadModel($id);
			$this->render('acta',array('model'=>$model,
		));
		
	}
	



}
