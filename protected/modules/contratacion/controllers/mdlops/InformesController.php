<?php

class InformesController extends Controller
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
	
	public function actionAdmin()
	{
		$this->render('admin',array());
	}
	
	public function actionContraloria()
	{
	  $Contratos = new Contratos;
	  $Informes = new Informes;
	  if((isset($_POST['Informes'])))
	  {
	   $Informes->attributes=$_POST['Informes'];	   
	   $Informes->CONT_NUMORDEN = $Informes->attributes=$_POST['Informes']["CONT_NUMORDEN"];
	   $registros = $Contratos->reporteContraloria($Informes);
	   $this->render('rep_contraloria',array(
		                                      'registros'=>$registros,		
		                                     ));  	
	  }	  
	  $this->render('contraloria',array(
		                           'Contratos'=>$Contratos,
								   'Informes'=>$Informes,		
		                          )
		);
	}
	
    public function actionDependencias()
	{
	  $Opscontratos = new Opscontratos;
	  $Informes = new Informes;
	  if((isset($_POST['Informes'])))
	  {
	   $Informes->attributes=$_POST['Informes'];	   
	   $Informes->CONT_NUMORDEN = $Informes->attributes=$_POST['Informes']["CONT_NUMORDEN"];
	   $dependencias = $Opscontratos->reporteDependencias($Informes);
	   $this->render('rep_dependencias',array(
		                                      'dependencias'=>$dependencias,
											  'Informes'=>$Informes,
											  'Opscontratos'=>$Opscontratos,		
		                                     ));  	  
	  }	  
	  $this->render('dependencias',array(
		                           'Opscontratos'=>$Opscontratos,
								   'Informes'=>$Informes,		
		                          )
		);
	}
	
	public function actionGeneral()
	{
	  $Opscontratos = new Opscontratos;
	  $Informes = new Informes;
	  if((isset($_POST['Informes'])))
	  {
	   $Informes->attributes=$_POST['Informes'];	   
	   $Informes->CONT_NUMORDEN = $Informes->attributes=$_POST['Informes']["CONT_NUMORDEN"];
	   $registros = $Opscontratos->reporteContraloria($Informes);
	   $this->render('rep_general',array(
		                                      'registros'=>$registros,		
		                                     ));  	  
	  }	  
	  $this->render('general',array(
		                           'Opscontratos'=>$Opscontratos,
								   'Informes'=>$Informes,		
		                          )
		);
	}	
}
