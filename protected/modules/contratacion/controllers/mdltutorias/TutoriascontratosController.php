<?php

class TutoriascontratosController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'','download'),
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
		$Tutoriascontratos = new Tutoriascontratos;
		$Contratos = new Contratos;
		$Personas = Personas::model()->findByPk($id);
		$Tutoriascontratos->NOMBREPERSONA = $Personas->nombrePersona;
		
        $Contratos->PERS_ID = $id;
		
		$criterio = array('select'=>'PEAC_ID','join'=>'WHERE t.PEAC_ESTADO = 0','limit'=>1);  
	    $data = Periodosacademicos::model()->find($criterio);
		$Contratos->CONT_ANIO = (int)(substr($data['PEAC_ID'],0,4));
		//$Contratos->obtenerNumOrden($Contratos->CONT_ANIO,2,14); 
		
		$Tutoriascontratos->obtenerValorHora($Contratos->CONT_ANIO);
		if((isset($_POST['Tutoriascontratos'])) & (isset($_POST['Contratos'])))
		{
			$Tutoriascontratos->attributes=$_POST['Tutoriascontratos'];
			$Contratos->attributes=$_POST['Contratos'];
			$Contratos->attributes=$_POST['Contratos']['PECO_ID'];
			$Contratos->obtenerNumOrden($Contratos->CONT_ANIO,$Contratos->TICO_ID,$Contratos->CLCO_ID);
			if($Contratos->save()){
			 $Tutoriascontratos->CONT_ID = $Contratos->CONT_ID;			 
			 if($Tutoriascontratos->save()){
				$this->redirect(array('mdltutorias/tutorias/create','id'=>$Tutoriascontratos->TUCO_ID));
		     }else{
			       throw new CHttpException(400,'Error creando el contrato - catedra...');
			      }
			}else{
			       throw new CHttpException(400,'Error creando el contrato...');
			      }
		}

		$this->render('create',array(
			'Tutoriascontratos'=>$Tutoriascontratos,
			'Contratos'=>$Contratos,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$Tutoriascontratos = Tutoriascontratos::model()->findByPk($id);
		$Contratos = Contratos::model()->findByPk($Tutoriascontratos->CONT_ID);
        $Contratostipo = new Contratostipo;
		$Personas = Personas::model()->findByPk($Contratos->PERS_ID);
		$Tutoriascontratos->NOMBREPERSONA = $Personas->nombrePersona;
		
        $Contratos->PERS_ID = $Contratos->PERS_ID;
		if((isset($_POST['Tutoriascontratos'])) & (isset($_POST['Contratos'])))
		{
			$Tutoriascontratos->attributes=$_POST['Tutoriascontratos'];
			$Contratos->attributes=$_POST['Contratos'];
			if($Contratos->save()){		 
			 if($Tutoriascontratos->save()){
				$this->redirect(array('mdltutorias/tutorias/detail','id'=>$Tutoriascontratos->TUCO_ID));
		     }else{
			       throw new CHttpException(400,'Error actualizando el contrato - tutorias...');
			      }
			}else{
			       throw new CHttpException(400,'Error actualizando el contrato...');
			      }
		}

		$this->render('update',array(
			'Contratos'=>$Contratos,
			'Tutoriascontratos'=>$Tutoriascontratos,
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
		$dataProvider=new CActiveDataProvider('Tutoriascontratos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tutoriascontratos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tutoriascontratos'])){
			$model->attributes=$_GET['Tutoriascontratos'];
		    Yii::app()->user->setState('TutoriascontratosSearchParams', $_GET['Tutoriascontratos']);
		}
		$this->render('admin',array('model'=>$model,));
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
		$model=Tutoriascontratos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tutoriascontratos-form')
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

    public function actionDownload($id=NULL,$sede=NULL,$sbp=NULL,$opcion=NULL){		
	 $Tutoriascontratos = new Tutoriascontratos('search');
	 
	 if($_REQUEST['opcion']=='true'){
	  $paramsTutoriascontratos = Yii::app()->user->getState('TutoriascontratosSearchParams');
	  
	  $Tutoriascontratos->attributes = $paramsTutoriascontratos;
	  $dataProvider = $Tutoriascontratos->search();
      $data = $dataProvider->getData();	  
	  $this->render('download',array(
	                               'Tutoriascontratos'=>$Tutoriascontratos,
								   'Registros'=>$data,
								   )
				   );
	 }
	 	 
	 $this->render('download',array(
	                               'Tutoriascontratos'=>$Tutoriascontratos,
								   )
				   );
    }
	
	public function actionAdminSupervisores()
	{
		$model = new Tutoriascontratos('searchSupervisores');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tutoriascontratos']))
			$model->attributes=$_GET['Tutoriascontratos'];

		$this->render('adminSupervisores',array(
			'model'=>$model,
		));
	}	 	
}
