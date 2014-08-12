<?php

class PersnaturalesocasionalesController extends Controller
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
 	    $criteria = new CDbCriteria;
		$criteria->condition = 'PENA_ID = '.$id;
		$criteria->order = 'PENO_FECHAINGRESO DESC';
					
        if($Persnaturalesocasionales = Persnaturalesocasionales::model()->find($criteria)){
		}else{
			 $Persnaturalesocasionales = new Persnaturalesocasionales;
			 $Persnaturalesocasionales->PENA_ID = $id;
			 }
		$Personasnaturales = Personasnaturales::model()->findByPk($Persnaturalesocasionales->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);
		$Persnaturalesocasionales->NOMBREPERSONA = $Personas->nombrePersona;

		$Ocasionalescontratos = new Ocasionalescontratos;
        
		$criterio = new CDbCriteria;
		$anio = date("Y");
		$criterio->select='t.VAPU_VALOR';
		$criterio->condition='t.VAPU_ANIO = '.$anio;	
	    $criterio->order = 't.VAPU_ANIO DESC';
		$valorPuntos = Valorpuntos::model()->find($criterio);
        $Persnaturalesocasionales->PENO_VALORPUNTO = $valorPuntos->VAPU_VALOR;
		
		if((isset($_POST['Persnaturalesocasionales']))&&(isset($_POST['Ocasionalescontratos'])))
		{
			$Persnaturalesocasionales->attributes=$_POST['Persnaturalesocasionales'];
			$Ocasionalescontratos->attributes=$_POST['Ocasionalescontratos'];
			/*verificar si la persona ya tiene un contrato para el semestre actual*/
			$row = $Persnaturalesocasionales->verificarContratos($Persnaturalesocasionales->PENA_ID,
			$Persnaturalesocasionales->PEAC_ID,$Persnaturalesocasionales->FACU_ID);
			
			if($row==0){			 
			 if($Persnaturalesocasionales->save()){
			   $Persnaturalesocasional = $Persnaturalesocasionales->loadLastData($Persnaturalesocasionales->PENA_ID,
			   $Persnaturalesocasionales->PEAC_ID,$Persnaturalesocasionales->PENO_FECHAINGRESO,
			   $Persnaturalesocasionales->FACU_ID);
			   $Ocasionalescontratos->PENO_ID = $Persnaturalesocasional->PENO_ID;
			    if($Ocasionalescontratos->save()){
				  $this->redirect(array('admin'));
				}
		     }
			}else{
				 Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>La persona tiene un 
				 contrato registrado para este periodo :(');
				 }
		}
		$this->render('create',array(
			'Persnaturalesocasionales'=>$Persnaturalesocasionales,
			'Ocasionalescontratos'=>$Ocasionalescontratos,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$Persnaturalesocasionales = $this->loadModel($id);
	
		$Personasnaturales = Personasnaturales::model()->findByPk($Persnaturalesocasionales->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);
		
		$Persnaturalesocasionales->NOMBREPERSONA = $Personas->nombrePersona;
        
		$criterio = new CDbCriteria;
		$criterio->condition = 'PENO_ID = '.$Persnaturalesocasionales->PENO_ID;
        $Ocasionalcontrato =  Ocasionalescontratos::model()->find($criterio);
		$Ocasionalescontratos =  Ocasionalescontratos::model()->findByPk($Ocasionalcontrato->OCCO_ID);
        
		$criterio = new CDbCriteria;
		$anio = date("Y");
		$criterio->select='t.VAPU_VALOR';
		$criterio->condition='t.VAPU_ANIO = '.$anio;	
	    $criterio->order = 't.VAPU_ANIO DESC';
		$valorPuntos = Valorpuntos::model()->find($criterio);
        $Persnaturalesocasionales->PENO_VALORPUNTO = $valorPuntos->VAPU_VALOR;

		if((isset($_POST['Persnaturalesocasionales']))&&(isset($_POST['Ocasionalescontratos'])))
		{
			$Persnaturalesocasionales->attributes=$_POST['Persnaturalesocasionales'];
			$Ocasionalescontratos->attributes=$_POST['Ocasionalescontratos'];
			
			if($Persnaturalesocasionales->save()){
			    if($Ocasionalescontratos->save()){
				  $this->redirect(array('admin'));
				}
			}
		}

		$this->render('update',array(
			'Persnaturalesocasionales'=>$Persnaturalesocasionales,
			'Ocasionalescontratos'=>$Ocasionalescontratos,
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
		$dataProvider=new CActiveDataProvider('Persnaturalesocasionales');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Persnaturalesocasionales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Persnaturalesocasionales']))
			$model->attributes=$_GET['Persnaturalesocasionales'];

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
		$model=Persnaturalesocasionales::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='persnaturalesocasionales-form')
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
	
	public function actionLoadCdp()
        {   
		$filtro = $_POST['Persnaturalesocasionales']['FACU_ID'];
		
		$criteria = new CDbCriteria();
		$anio = date("Y");
		$criteria->select='t.OCPR_ID, p.PRES_NOMBRE';
        $criteria->condition = 't.FACU_ID = :id_uno';
		$criteria->join = '
			 INNER JOIN TBL_FACULTADES  f ON t.FACU_ID = f.FACU_ID
			 INNER JOIN TBL_PRESUPUESTOS  p ON t.PRES_ID = p.PRES_ID AND t.OCPR_FECHAINGRESO LIKE "'.$anio.'%"';
        $criteria->params = array(':id_uno' => (int) $filtro);
        $criteria->order = 't.FACU_ID ASC';
				
		$lista = Ocasionalespresupuestos::model()->findAll($criteria);				 
		$list = CHtml::listData($lista,'OCPR_ID','PRES_NOMBRE');            
        echo CHtml::tag('option', array('value' => ''), 'Seleccione el presupuesto', true);
        foreach ($list as $valor => $descripcion){
         echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion), true );                
       }
     }
}
