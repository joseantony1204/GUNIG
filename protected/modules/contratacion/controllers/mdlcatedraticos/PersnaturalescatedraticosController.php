<?php

class PersnaturalescatedraticosController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'','cargarProgramas'),
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
		$Persnaturalescatedraticos = $this->loadModel($id);
		$Personasnaturales = Personasnaturales::model()->findByPk($Persnaturalescatedraticos->PENA_ID);
		$this->redirect(array('mdlcatedraticos/personasnaturales/view','id'=>$Personasnaturales->PENA_ID));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$phpNumToLetterPath = Yii::getPathOfAlias('ext');
        include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
        $NumberToLetters = new EnLetras();
		$tipoContratoDocente = "";
		$criteria = new CDbCriteria;
		$criteria->condition = 'PENA_ID = '.$id;
		$criteria->order = 'PENC_FECHAINGRESO DESC';
		
		if($Persnaturalescatedraticos = Persnaturalescatedraticos::model()->find($criteria)){
		   $Persnaturalescatedraticos = Persnaturalescatedraticos::model()->findByPk($Persnaturalescatedraticos->PENC_ID);		   
		  
		   $criterio = new CDbCriteria;
		   $criterio->condition = 'PENC_ID = '.$Persnaturalescatedraticos->PENC_ID;
		   $criterio->order = 'CACO_FECHAPROCESO DESC';		   
		   if($Catedraticoscontratos = Catedraticoscontratos::model()->find($criterio)){
		      $Catedraticoscontratos = Catedraticoscontratos::model()->findByPk($Catedraticoscontratos->CACO_ID);
			  $tipoContratoDocente = $Catedraticoscontratos->CATC_ID;
		   }else{
			     $Catedraticoscontratos = new Catedraticoscontratos;
				}		   
		}else{
			  $Persnaturalescatedraticos = new Persnaturalescatedraticos;
			  $Persnaturalescatedraticos->PENA_ID = $id;
			  $Catedraticoscontratos = new Catedraticoscontratos;
			 }
			 
		$Personasnaturales = Personasnaturales::model()->findByPk($Persnaturalescatedraticos->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);
		$Persnaturalescatedraticos->NOMBREPERSONA = $Personas->nombrePersona;	 

		$Catedraticoscatedras = new Catedraticoscatedras;
		$Facultades = new Facultades;
		
		$criterio = array('select'=>'ANAC_ID','join'=>'WHERE t.ANAC_ESTADO = 0','limit'=>1);  
	    $data = Aniosacademicos::model()->find($criterio);
		
		$Catedraticoscontratos->CACO_ANIO = (int)(substr($data['ANAC_ID'],0,4));
		$Catedraticoscontratos->obtenerNumOrden($Catedraticoscontratos->CACO_ANIO);

		if((isset($_POST['Catedraticoscatedras'])) & (isset($_POST['Catedraticoscontratos'])) & (isset($_POST['Persnaturalescatedraticos'])))
		{
			$Catedraticoscatedras->attributes=$_POST['Catedraticoscatedras'];
			$Catedraticoscontratos->attributes=$_POST['Catedraticoscontratos'];
			$Persnaturalescatedraticos->attributes=$_POST['Persnaturalescatedraticos'];
			
			/*datos del docente catedratico*/
			$Categorias = Categorias::model()->findByPk($Persnaturalescatedraticos->CATE_ID);
			$Persnaturalescatedraticos->PENC_CATEGORIA = $Categorias->CATE_NOMBRE;
			$Persnaturalescatedraticos->PENC_VALORCATEGORIA = $Categorias->CATE_VALOR;
			 if($Persnaturalescatedraticos->save()){
			
	// $sw = $Persnaturalescatedraticos->validarDocenteEnPeriodo($Persnaturalescatedraticos->PEAC_ID,$Persnaturalescatedraticos->PENA_ID);
			  //if($sw==0){

			  /*datos del contrato*/
			
			  if($tipoContratoDocente!=""){
				  if($tipoContratoDocente != $_POST['Catedraticoscontratos']["CATC_ID"]){
			       $Catedraticoscontratos = new Catedraticoscontratos;
				   $Catedraticoscontratos->attributes=$_POST['Catedraticoscontratos'];
				   $Catedraticoscontratos->PENC_ID = $Persnaturalescatedraticos->PENC_ID;
			       $Catedraticoscontratos->CACO_ANIO = date('Y');
			       $Catedraticoscontratos->CACO_VALORHORA = $Persnaturalescatedraticos->PENC_VALORCATEGORIA;
				  }else{
					    $Catedraticoscontratos->PENC_ID = $Persnaturalescatedraticos->PENC_ID;
			            $Catedraticoscontratos->CACO_ANIO = date('Y');
			            $Catedraticoscontratos->CACO_VALORHORA = $Persnaturalescatedraticos->PENC_VALORCATEGORIA;
					   }
			  }else{
					$Catedraticoscontratos->PENC_ID = $Persnaturalescatedraticos->PENC_ID;
			        $Catedraticoscontratos->CACO_ANIO = date('Y');
			        $Catedraticoscontratos->CACO_VALORHORA = $Persnaturalescatedraticos->PENC_VALORCATEGORIA;
				   }
			  
					   
			  if($Catedraticoscontratos->save()){
			  
			   /*datos para la catedra*/
			   $Programas = Programas::model()->findByPk($Catedraticoscatedras->PROG_ID);	 
			   $Catedraticoscatedras->CACO_ID = $Catedraticoscontratos->CACO_ID;
			   $Catedraticoscatedras->CACA_NOMBRE = $Programas->PROG_NOMBRE;
			   $intensidad = $Catedraticoscatedras->CACA_INTENSIDAD;
			   $Catedraticoscatedras->CACA_INTENSIDADENLETRAS = strtoupper($NumberToLetters->ValorEnLetras($intensidad," "));
			   $Catedraticoscatedras->CACA_ESTADO = 3;
			  
			    if($Catedraticoscatedras->save()){
				 $this->redirect(array('mdlcatedraticos/catedratiasignaturascatedr/create','id'=>$Catedraticoscatedras->CACA_ID));
			    }
			   }
		     }
			 /*
			}else{
				 Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>Esta persona esta agregada como docente catedrático
				 en el periodo que ha seleccionado...');
				 }*/
			
		}
		$this->render('create',array(
			'Persnaturalescatedraticos'=>$Persnaturalescatedraticos,
			'Catedraticoscontratos'=>$Catedraticoscontratos,
			'Catedraticoscatedras'=>$Catedraticoscatedras,
			'Facultades'=>$Facultades,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		   $Persnaturalescatedraticos = $this->loadModel($id);
		   $criterio = new CDbCriteria;
		   $criterio->condition = 'PENC_ID = '.$Persnaturalescatedraticos->PENC_ID;
		   $criterio->order = 'CACO_FECHAPROCESO DESC';		   
		   if($Catedraticoscontratos = Catedraticoscontratos::model()->find($criterio)){
		      $Catedraticoscontratos = Catedraticoscontratos::model()->findByPk($Catedraticoscontratos->CACO_ID);
		   }else{
			     $Catedraticoscontratos = new Catedraticoscontratos;
				}		   
        
		$Personasnaturales = Personasnaturales::model()->findByPk($Persnaturalescatedraticos->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);
		$Persnaturalescatedraticos->NOMBREPERSONA = $Personas->nombrePersona;
		$Facultades = new Facultades;	 

		if((isset($_POST['Catedraticoscontratos'])) & (isset($_POST['Persnaturalescatedraticos'])))
		{
			$Catedraticoscontratos->attributes=$_POST['Catedraticoscontratos'];
			$Persnaturalescatedraticos->attributes=$_POST['Persnaturalescatedraticos'];
			
			/*datos del docente catedratico*/
			$Categorias = Categorias::model()->findByPk($Persnaturalescatedraticos->CATE_ID);
			$Persnaturalescatedraticos->PENC_CATEGORIA = $Categorias->CATE_NOMBRE;
			$Persnaturalescatedraticos->PENC_VALORCATEGORIA = $Categorias->CATE_VALOR;
			if($Persnaturalescatedraticos->save()){
			
			 /*datos del contrato*/
			 $Catedraticoscontratos->PENC_ID = $Persnaturalescatedraticos->PENC_ID;
			 $Catedraticoscontratos->CACO_ANIO = date('Y');
			 $Catedraticoscontratos->CACO_VALORHORA = $Persnaturalescatedraticos->PENC_VALORCATEGORIA;
			 if($Catedraticoscontratos->save()){
				$this->redirect(array('mdlcatedraticos/catedraticoscatedras/admin','id'=>$Catedraticoscontratos->CACO_ID));			  
			 }
		    }
		}

		$this->render('update',array(
			'Persnaturalescatedraticos'=>$Persnaturalescatedraticos,
			'Catedraticoscontratos'=>$Catedraticoscontratos,
			'Facultades'=>$Facultades,
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
		$dataProvider=new CActiveDataProvider('Persnaturalescatedraticos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Persnaturalescatedraticos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Persnaturalescatedraticos'])){
			$model->attributes=$_GET['Persnaturalescatedraticos'];
		}
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
		$model=Persnaturalescatedraticos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='persnaturalescatedraticos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSearchPersonas()
	{
		$Personasnaturales=new Personasnaturales('search');
		$Personasnaturales->unsetAttributes();  // clear any default values
		if(isset($_GET['Personasnaturales'])){
			$Personasnaturales->attributes=$_GET['Personasnaturales'];
	    }
		$this->render('searchPersonas',array(
			'Personasnaturales'=>$Personasnaturales,
		));
	}
	
	public function actionCargarProgramas()
        {   
		$filtro = $_POST['Facultades']['FACU_ID'];
		
		$criteria = new CDbCriteria();
        $criteria->condition = 'FACU_ID = :id_uno';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 'PROG_NOMBRE ASC';
				
		$lista = Programas::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'PROG_ID','PROG_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione un programa...', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
	
	public function actionLoadCdp()
        {   
		$filtro = $_POST['Catedraticoscatedras']['PROG_ID'];
		
		$criteria = new CDbCriteria();
		$anio = date("Y");
		$criteria->select='t.CAPR_ID, p.PRES_NOMBRE';
        $criteria->condition = 'pr.PROG_ID = :id_uno';
		$criteria->join = '
			 INNER JOIN TBL_FACULTADES  f ON t.FACU_ID = f.FACU_ID
			 INNER JOIN TBL_PROGRAMAS  pr ON f.FACU_ID = pr.FACU_ID
			 INNER JOIN TBL_PRESUPUESTOS  p ON t.PRES_ID = p.PRES_ID AND t.CAPR_FECHAINGRESO LIKE "'.$anio.'%"';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 't.FACU_ID ASC';
				
		$lista = Catedraticospresupuestos::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'CAPR_ID','PRES_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione el presupuesto', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
}
