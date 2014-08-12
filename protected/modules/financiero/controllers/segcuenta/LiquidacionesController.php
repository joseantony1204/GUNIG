<?php

class LiquidacionesController extends Controller
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
									 ''.$array[6].'',''.$array[7].'','
									 ',  
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
	
	public function actionCreate($id)
	{
		$liquidaciones=new Liquidaciones;
		$liquidacionesdescuentos=new Liquidacionesdescuentos;
		$seguimientocuentas=new Seguimientocuentas;
		
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariosdependencias = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);
		
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariosdependencias->SEUD_ID);
		$liquidaciones->LIQU_FECHA;
		
		
		
		$nuevoEstado = 0;
		
		
  ////////////////////////////////////
  
  
  $Cuentas=Cuentas::model()->findByPk($id);
  $Contratos=Contratos::model()->findByPk($Cuentas->CONT_ID);
  $Clasescontratos=Clasescontratos::model()->findByPk($Contratos->CLCO_ID);
  $Tipospagos = Tipospagos::model()->findByPk($Cuentas->TIPA_ID);
  $Tiposcontratos = Tiposcontratos::model()->findByPk($Contratos->TICO_ID);
  		
  function NombreMes($m){
   switch ($m){
    case 1: return "ENERO";
    case 2: return "FEBRERO";
    case 3: return "MARZO";
    case 4: return "ABRIL";
    case 5: return "MAYO";
    case 6: return "JUNIO";
    case 7: return "JULIO";
    case 8: return "AGOSTO";
    case 9: return "SEPTIEMBRE";    
	case 10: return "OCTUBRE";
    case 11: return "NOVIEMBRE";
    case 12: return "DICIEMBRE";
   }
  }
  
   
  if($Clasescontratos->CLCO_ID==14){
   $claseContrato = " PRESTACION DE SERVICIOS ";
  }else{
	    $claseContrato = $Clasescontratos->CLCO_NOMBRE;
	   }
  
	$mesIni = NombreMes(date("m",strtotime($Contratos->CONT_FECHAINICIO)));
	$diaIni = date("d",strtotime($Contratos->CONT_FECHAINICIO));
	
	$diaInicioCuenta = date("d",strtotime($Cuentas->CUEN_FECHAINICIO));
	$mesInicioCuenta = NombreMes(date("m",strtotime($Cuentas->CUEN_FECHAINICIO)));
	
	$diaFinalCuenta = date("d",strtotime($Cuentas->CUEN_FECHAFINAL));
	$mesFinalCuenta = NombreMes(date("m",strtotime($Cuentas->CUEN_FECHAFINAL)));
	
	$anioCuenta = date("Y",strtotime($Cuentas->CUEN_FECHAFINAL));	
	
	 if($Cuentas->TIPA_ID==2 || $Cuentas->TIPA_ID==4){
		$concepto = 'PAGO '.$Tipospagos->TIPA_NOMBRE.' SEGUN '.$Tiposcontratos->TICO_NOMBRE.' DE '.$claseContrato.' No.	'.$Contratos->CONT_NUMORDEN.' DE '.
		$mesIni.' '.$diaIni.' DE '.$Contratos->CONT_ANIO;
	 }else{
	    $concepto = 'PAGO '.$Tipospagos->TIPA_NOMBRE.' SEGUN '.$Tiposcontratos->TICO_NOMBRE.' DE '.$claseContrato.' No.	'.$Contratos->CONT_NUMORDEN.' DE '.
		$mesIni.' '.$diaIni.' DE '.$Contratos->CONT_ANIO.', DESDE EL '.$diaInicioCuenta.' DE '.$mesInicioCuenta.' HASTA EL '.$diaFinalCuenta.' DE '.
		$mesFinalCuenta.' DE '.$anioCuenta;
	 }
		
		
		$liquidaciones->LIQU_CONCEPTO = $concepto;
		$liquidaciones->CUEN_ID = $id;
		
		///////////////////////////////////////////////////
		$liquidaciones->CONT_FECHAINICIO = $Contratos->CONT_FECHAINICIO;
		///////////////////////////////////////////////////

		if(isset($_POST['Liquidaciones'])){
			
			$Seguimiento = $liquidaciones->Seguimiento($id, $Seguimientouserdependencias->DEPE_ID);
			
			if($Seguimiento != 1){
					 Yii::app()->user->setFlash('error','Lo sentimos, la cuenta no puede ser liquidada.</strong> Se requiere que sea tramitada previamente por otra(s) dependencia(s).');
			}else{
			
					
					
					$liquidaciones->attributes=$_POST['Liquidaciones'];
					$liquidaciones->DEAT_ID = $_POST['DEAT_ID'];
					$liquidaciones->DEAT_IDD = $_POST['DEAT_IDD'];
					$liquidaciones->DEAT_IDDD = $_POST['DEAT_IDDD'];
					$liquidaciones->LIQU_APLICAIVA = $_POST['Liquidaciones']['LIQU_APLICAIVA'];	
					$liquidaciones->USUA_INSERT = $Usuarios->USUA_ID;	
					$cod = $liquidaciones->loadContrato($id);			
					$anti = $liquidaciones->loadAnticipo($cod);
					$cuen = $liquidaciones->loadPagos($cod);
					
					if(($anti == 1) & ($cuen == 0)){				
						$liquidaciones->LIQU_ANTICIPO=1;					
					}			
					
					if($liquidaciones->save()){					
						$tipa = $liquidaciones->loadTipopago($id);						
						if($tipa != 2){			
							$liquidaciones->CUEN_ID = $id;
							$Liquidar = $liquidaciones->loadLastData($liquidaciones->CUEN_ID);				
							$Anio = $_POST['Liquidaciones']['ANAC_ID'];					
							$Salario = $liquidaciones->SalarioMinimo($Anio);
							$Dato = $_POST['DEAT_ID'];
							$Dato1 = $_POST['DEAT_IDD'];
							$Dato2 = $_POST['DEAT_IDDD'];
							
							
															
							$Descuentoatributos = $liquidaciones->loadDescuentos($Anio, $id, $Salario, $Dato, $Dato1, $Dato2);
							
							foreach($Descuentoatributos as $desc){						
								$liquidacionesdescuentos=new Liquidacionesdescuentos;						
								$liquidacionesdescuentos->DESC_ID = $desc['DESC_ID'];
								$liquidacionesdescuentos->LIDE_TARIFA = $desc['DEAT_VALOR'];
								$liquidacionesdescuentos->LIQU_ID = $Liquidar->LIQU_ID;	
								$liquidacionesdescuentos->attributes=$_POST['liquidacionesdescuentos'];					
								$liquidacionesdescuentos->save();								
							}					
						}
						
						
						
						$liquidaciones->actualizarFecha($_POST['Liquidaciones']['CONT_FECHAINICIO'], $Cuentas->CONT_ID);
											
						//$this->redirect(array('segcuenta/seguimientocuentas/create','id'=>$liquidaciones->CUEN_ID));
						
						$this->redirect(array('segcuenta/liqudescauditoria/create','id'=>$liquidaciones->LIQU_ID, 'action'=>'INSERTO'));
						
						
																				
					 }
			
			}
			
		}	
		$this->render('create',array(
			'liquidaciones'=>$liquidaciones,
			'liquidacionesdescuentos'=>$liquidacionesdescuentos,
			'seguimientocuentas'=>$seguimientocuentas,
		));
	}
	
	
	
	
	
	
	
	
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	public function actionCreatecobra($id)
	{
		$liquidaciones=new Liquidaciones;
		$liquidacionesdescuentos=new Liquidacionesdescuentos;
		$seguimientocuentas=new Seguimientocuentas;
		
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Usuariosdependencias = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
		WHERE USUA_ID = ".$Usuarios->USUA_ID);
		
		$Seguimientouserdependencias = Seguimientouserdependencias::model()->findByPk($Usuariosdependencias->SEUD_ID);
		$liquidaciones->LIQU_FECHA;
		$nuevoEstado = 0;
		
	
		$Cuentas=Cuentas::model()->findByPk($id);
		$Contratos=Contratos::model()->findByPk($Cuentas->CONT_ID);
		$Clasescontratos=Clasescontratos::model()->findByPk($Contratos->CLCO_ID);
		$Tipospagos = Tipospagos::model()->findByPk($Cuentas->TIPA_ID);
		$Tiposcontratos = Tiposcontratos::model()->findByPk($Contratos->TICO_ID);
				
		function NombreMes($m){
		  switch ($m){
			case 1: return "ENERO";
			case 2: return "FEBRERO";
			case 3: return "MARZO";
			case 4: return "ABRIL";
			case 5: return "MAYO";
			case 6: return "JUNIO";
			case 7: return "JULIO";
			case 8: return "AGOSTO";
			case 9: return "SEPTIEMBRE";    
			case 10: return "OCTUBRE";
			case 11: return "NOVIEMBRE";
			case 12: return "DICIEMBRE";
		  }
		}
		   
		   
		$mesIni = NombreMes(date("m",strtotime($Contratos->CONT_FECHAINICIO)));
		$diaIni = date("d",strtotime($Contratos->CONT_FECHAINICIO));  	
		$anioCuenta = date("Y",strtotime($Contratos->CONT_FECHAINICIO));	
		
		$concepto = 'PAGO '.$Tipospagos->TIPA_NOMBRE.' SEGUN '.$Tiposcontratos->TICO_NOMBRE.' DE '.$Clasescontratos->CLCO_NOMBRE.' No. '.$Contratos->CONT_NUMORDEN.' DE '.
		$mesIni.' '.$diaIni.' DE '.$Contratos->CONT_ANIO;
						
		$liquidaciones->LIQU_CONCEPTO = $concepto;
		$liquidaciones->CUEN_ID = $id;
				
		$cuen = $liquidaciones->consultarPagos($Cuentas->CONT_ID);
		foreach($cuen as $dato){	  
			 $fils[0] = $dato['CANTIDAD'];
			 $fils[1] = $dato['AMORTIZADO'];	 
		}
		
		$anti = $liquidaciones->consultarPago($Cuentas->CONT_ID);
		foreach($anti as $dato){	  
			$fil[0] = $dato['CANTIDAD'];
			$fil[1] = $dato['TOTAL'];	 
		}	
		
		if(($fil[0] == 1) & ($fils[0] == 0)){				
			$liquidaciones->LIQU_ANTICIPO=1;					
		}					
						
		$total = $fil[1] - $fils[1];
		
		$liquidaciones->LIQU_AMOTIZACION = $total;		
		
		if(isset($_POST['Liquidaciones'])){
			
			$Seguimiento = $liquidaciones->Seguimiento($id, $Seguimientouserdependencias->DEPE_ID);
			
			if($Seguimiento != 1){
					 Yii::app()->user->setFlash('error','Lo sentimos, la cuenta no puede ser liquidada.</strong> Se requiere que sea tramitada 
					 previamente por otra(s) dependencia(s).');
			}else{				
					$liquidaciones->attributes=$_POST['Liquidaciones'];
					$liquidaciones->DEAT_ID = $_POST['DEAT_ID'];
					$liquidaciones->DEAT_IDD = $_POST['DEAT_IDD'];
					$liquidaciones->DEAT_IDDD = $_POST['DEAT_IDDD'];
					$liquidaciones->LIQU_APLICAIVA = $_POST['Liquidaciones']['LIQU_APLICAIVA'];
					$liquidaciones->USUA_INSERT = $Usuarios->USUA_ID;		
							
					$cod = $liquidaciones->loadContrato($id);			
					
										
					 $valor= $_POST['Liquidaciones']['LIQU_AMOTIZACION'];
													
						if(	$total < $valor){
							
							Yii::app()->user->setFlash('error','El valor amortizado no puede superar el monto pendiente por anticipo de $'
							.number_format($total) );
					}else{
																
					if($liquidaciones->save()){					
						$tipa = $liquidaciones->loadTipopago($id);						
						if($tipa != 2){			
							$liquidaciones->CUEN_ID = $id;
							$Liquidar = $liquidaciones->loadLastData($liquidaciones->CUEN_ID);				
							$Anio = $_POST['Liquidaciones']['ANAC_ID'];					
							$Salario = $liquidaciones->SalarioMinimo($Anio);
							$Dato = $_POST['DEAT_ID'];
							$Dato1 = $_POST['DEAT_IDD'];
							$Dato2 = $_POST['DEAT_IDDD'];
															
							$Descuentoatributos = $liquidaciones->loadDescuentos($Anio, $id, $Salario, $Dato, $Dato1, $Dato2);
							
							foreach($Descuentoatributos as $desc){						
								$liquidacionesdescuentos=new Liquidacionesdescuentos;						
								$liquidacionesdescuentos->DESC_ID = $desc['DESC_ID'];
								$liquidacionesdescuentos->LIDE_TARIFA = $desc['DEAT_VALOR'];
								$liquidacionesdescuentos->LIQU_ID = $Liquidar->LIQU_ID;	
								$liquidacionesdescuentos->attributes=$_POST['liquidacionesdescuentos'];					
								$liquidacionesdescuentos->save();								
							}					
						}											
						//$this->redirect(array('segcuenta/seguimientocuentas/create','id'=>$liquidaciones->CUEN_ID));									
					 	$this->redirect(array('segcuenta/liqudescauditoria/create','id'=>$liquidaciones->LIQU_ID, 'action'=>'INSERTO'));
					 }
				}
			}			
		}	
	 	$this->render('createcobra',array(
			'liquidaciones'=>$liquidaciones,
			'liquidacionesdescuentos'=>$liquidacionesdescuentos,
			'seguimientocuentas'=>$seguimientocuentas,
		));
	}
	
	
	
	
	public function actionUpdate($id)
	{
		$liquidaciones=$this->loadModel($id);
		$liquidacionesdescuentos=new Liquidacionesdescuentos;
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
		
		$model=new Liqudescauditoria;
		
		$Cuentas=Cuentas::model()->findByPk($liquidaciones->CUEN_ID);
		$Contratos=Contratos::model()->findByPk($Cuentas->CONT_ID);
		
		///////////////////////////////////////////////////
		$liquidaciones->CONT_FECHAINICIO = $Contratos->CONT_FECHAINICIO;
		///////////////////////////////////////////////////
		
		
		if(isset($_POST['Liquidaciones']))
		{
			$liquidaciones->attributes=$_POST['Liquidaciones'];
			$liquidaciones->DEAT_ID = $_POST['DEAT_ID'];
			$liquidaciones->DEAT_IDD = $_POST['DEAT_IDD'];
			$liquidaciones->DEAT_IDDD = $_POST['DEAT_IDDD'];
			$liquidaciones->LIQU_APLICAIVA = $_POST['Liquidaciones']['LIQU_APLICAIVA'];
			$liquidaciones->USUA_UPDATE = $Usuarios->USUA_ID;
			
					
			$last = $liquidaciones->loadCuenta($id);
			$cod = $liquidaciones->loadContrato($last);			
			$anti = $liquidaciones->loadAnticipo($cod);
		    $cuen = $liquidaciones->loadPagos($cod);
			
			if(($anti == 1) & ($cuen == 0)){				
				$liquidaciones->LIQU_ANTICIPO=1;					
			}		
						
			
			if($liquidaciones->save())
			
				$tipa = $liquidaciones->loadTipopago($last);						
				if($tipa != 2){	
								
					$Anio = $_POST['Liquidaciones']['ANAC_ID'];					
					$Salario = $liquidaciones->SalarioMinimo($Anio);
					$Dato = $_POST['DEAT_ID'];
					$Dato1 = $_POST['DEAT_IDD'];
					$Dato2 = $_POST['DEAT_IDDD'];
													
					$Descuentoatributos = $liquidaciones->loadDescuento($Anio, $last, $Salario, $Dato, $Dato1, $Dato2);
					////////////////////////////////////////////////////////////////////////////////////////////////////
					
					$Descuentos = $model->Descuentos($liquidaciones->LIQU_ID);			
			
					foreach($Descuentos as $desc){						
							$model=new Liqudescauditoria;	
							$model->LDAU_FECHAPROCESO = date("Y-m-d").' '.date("h:i:s");					
							$model->USUA_ID=$Usuarios->USUA_ID;
							$model->LDAU_ACCION='ACTUALIZO';
							$model->LIQU_ID = $liquidaciones->LIQU_ID;									
							$model->DESC_ID = $desc['DESC_ID'];
							$model->LDAU_TARIFA = $desc['LIDE_TARIFA'];									
							$model->attributes=$_POST['Liqudescauditoria'];				
							$model->save();								
					}				
					
					
					////////////////////////////////////////////////////////////////////////////////////////////////////
					$elimina = $liquidaciones->eliminaDescuentos($id);
					
					foreach($Descuentoatributos as $desc)
					{	
						$liquidacionesdescuentos=new Liquidacionesdescuentos;
						$liquidacionesdescuentos->DESC_ID = $desc['DESC_ID'];
						$liquidacionesdescuentos->LIDE_TARIFA = $desc['DEAT_VALOR'];
						$liquidacionesdescuentos->LIQU_ID = $id;
						$liquidacionesdescuentos->attributes=$_POST['liquidacionesdescuentos'];					
						$liquidacionesdescuentos->save();	
										
					}
				
				}
				$liquidaciones->actualizarFecha($_POST['Liquidaciones']['CONT_FECHAINICIO'], $Cuentas->CONT_ID);
				$this->redirect(array('segcuenta/cuentas/admin','id'=>$liquidaciones->cUEN->CONT_ID)); 
				  
		}

		$this->render('update',array(
			'liquidaciones'=>$liquidaciones,
			'model'=>$model,
			'liquidacionesdescuentos'=>$liquidacionesdescuentos,
		));
	}


	
	
	public function actionUpdatecobra($id)
	{
		$liquidaciones=$this->loadModel($id);
		$Cuentas=Cuentas::model()->findByPk($liquidaciones->CUEN_ID);
		$liquidacionesdescuentos=new Liquidacionesdescuentos;
		$caja= $liquidaciones->LIQU_AMOTIZACION;
		$Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);		
		$model=new Liqudescauditoria;
		
		if(isset($_POST['Liquidaciones']))
		{
			$liquidaciones->attributes=$_POST['Liquidaciones'];
			$liquidaciones->DEAT_ID = $_POST['DEAT_ID'];
			$liquidaciones->DEAT_IDD = $_POST['DEAT_IDD'];
			$liquidaciones->DEAT_IDDD = $_POST['DEAT_IDDD'];
			$liquidaciones->LIQU_APLICAIVA = $_POST['Liquidaciones']['LIQU_APLICAIVA'];
			$liquidaciones->USUA_UPDATE = $Usuarios->USUA_ID;
			
			$last = $liquidaciones->loadCuenta($id);						
			$cod = $liquidaciones->loadContrato($liquidaciones->CUEN_ID);			
					
					$cuen = $liquidaciones->consultarPagos($Cuentas->CONT_ID);
					foreach($cuen as $dato){	  
					  $fils[0] = $dato['CANTIDAD'];
					  $fils[1] = $dato['AMORTIZADO'];	 
					}
					
					$anti = $liquidaciones->consultarPago($Cuentas->CONT_ID);
					foreach($anti as $dato){	  
					  $fil[0] = $dato['CANTIDAD'];
					  $fil[1] = $dato['TOTAL'];	 
					}	
									
					if(($fil[0] == 1) & ($fils[0] == 0)){				
						 $liquidaciones->LIQU_ANTICIPO=1;					
					}	
					
					 $total = $fil[1] - $fils[1] + $caja;						
					 $valor= $_POST['Liquidaciones']['LIQU_AMOTIZACION'];
					
					
					if(	$total < $valor){
							
						Yii::app()->user->setFlash('error','El valor amortizado no puede superar el monto pendiente por anticipo de $'
						.number_format($total) );
					}else{							
				
						if($liquidaciones->save())
						
							$tipa = $liquidaciones->loadTipopago($last);						
							if($tipa != 2){	
											
								$Anio = $_POST['Liquidaciones']['ANAC_ID'];					
								$Salario = $liquidaciones->SalarioMinimo($Anio);
								$Dato = $_POST['DEAT_ID'];
								$Dato1 = $_POST['DEAT_IDD'];
								$Dato2 = $_POST['DEAT_IDDD'];
																
								$Descuentoatributos = $liquidaciones->loadDescuento($Anio, $last, $Salario, $Dato, $Dato1, $Dato2);
								
								
								////////////////////////////////////////////////////////////////////////////////////////////////////
					
								$Descuentos = $model->Descuentos($liquidaciones->LIQU_ID);			
						
								foreach($Descuentos as $desc){						
										$model=new Liqudescauditoria;	
										$model->LDAU_FECHAPROCESO = date("Y-m-d").' '.date("h:i:s");					
										$model->USUA_ID=$Usuarios->USUA_ID;
										$model->LDAU_ACCION='ACTUALIZO';
										$model->LIQU_ID = $liquidaciones->LIQU_ID;									
										$model->DESC_ID = $desc['DESC_ID'];
										$model->LDAU_TARIFA = $desc['LIDE_TARIFA'];									
										$model->attributes=$_POST['Liqudescauditoria'];				
										$model->save();								
								}				
					
								////////////////////////////////////////////////////////////////////////////////////////////////////
								
								$elimina = $liquidaciones->eliminaDescuentos($id);
								
								foreach($Descuentoatributos as $desc)
								{	
									$liquidacionesdescuentos=new Liquidacionesdescuentos;
									$liquidacionesdescuentos->DESC_ID = $desc['DESC_ID'];
									$liquidacionesdescuentos->LIDE_TARIFA = $desc['DEAT_VALOR'];
									$liquidacionesdescuentos->LIQU_ID = $id;
									$liquidacionesdescuentos->attributes=$_POST['liquidacionesdescuentos'];					
									$liquidacionesdescuentos->save();	
													
								}
							
							}
							$this->redirect(array('segcuenta/cuentas/admin','id'=>$liquidaciones->cUEN->CONT_ID)); 
			}
		}

	$this->render('updatecobra',array(
			'liquidaciones'=>$liquidaciones,
			'model'=>$model,
			'liquidacionesdescuentos'=>$liquidacionesdescuentos,
		));
	}



	
	
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
		$dataProvider=new CActiveDataProvider('Liquidaciones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Liquidaciones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Liquidaciones']))
			$model->attributes=$_GET['Liquidaciones'];

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
		$model=Liquidaciones::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}



	public function actionDownload($id)
	{
	 $liquidaciones=Liquidaciones::model()->findByPk($id);
	 $this->render('download',array('liquidaciones'=>$liquidaciones,'id'=>$liquidaciones->CUEN_ID));
    }
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='liquidaciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	
	 public function actionObtdescripcion()
        {   
		$inicia = $_POST['Liquidaciones']['CONT_FECHAINICIO'];
		$id= $_POST['Liquidaciones']['CUEN_ID'];
		
		
		
		
		
		
		
		
  $Cuentas=Cuentas::model()->findByPk($id);
  $Contratos=Contratos::model()->findByPk($Cuentas->CONT_ID);
  $Clasescontratos=Clasescontratos::model()->findByPk($Contratos->CLCO_ID);
  $Tipospagos = Tipospagos::model()->findByPk($Cuentas->TIPA_ID);
  $Tiposcontratos = Tiposcontratos::model()->findByPk($Contratos->TICO_ID);
  		
  function NombreMes($m){
   switch ($m){
    case 1: return "ENERO";
    case 2: return "FEBRERO";
    case 3: return "MARZO";
    case 4: return "ABRIL";
    case 5: return "MAYO";
    case 6: return "JUNIO";
    case 7: return "JULIO";
    case 8: return "AGOSTO";
    case 9: return "SEPTIEMBRE";    
	case 10: return "OCTUBRE";
    case 11: return "NOVIEMBRE";
    case 12: return "DICIEMBRE";
   }
  }
  
   
  if($Clasescontratos->CLCO_ID==14){
   $claseContrato = " PRESTACION DE SERVICIOS ";
  }else{
	    $claseContrato = $Clasescontratos->CLCO_NOMBRE;
	   }
  
	$mesIni = NombreMes(date("m",strtotime($inicia)));
	$diaIni = date("d",strtotime($inicia));
	
	$diaInicioCuenta = date("d",strtotime($Cuentas->CUEN_FECHAINICIO));
	$mesInicioCuenta = NombreMes(date("m",strtotime($Cuentas->CUEN_FECHAINICIO)));
	
	$diaFinalCuenta = date("d",strtotime($Cuentas->CUEN_FECHAFINAL));
	$mesFinalCuenta = NombreMes(date("m",strtotime($Cuentas->CUEN_FECHAFINAL)));
	
	$anioCuenta = date("Y",strtotime($Cuentas->CUEN_FECHAFINAL));	
	
	 if($Cuentas->TIPA_ID==2 || $Cuentas->TIPA_ID==4){
		$concepto = 'PAGO '.$Tipospagos->TIPA_NOMBRE.' SEGUN '.$Tiposcontratos->TICO_NOMBRE.' DE '.$claseContrato.' No.	'.$Contratos->CONT_NUMORDEN.' DE '.
		$mesIni.' '.$diaIni.' DE '.$Contratos->CONT_ANIO;
	 }else{
	    $concepto = 'PAGO '.$Tipospagos->TIPA_NOMBRE.' SEGUN '.$Tiposcontratos->TICO_NOMBRE.' DE '.$claseContrato.' No.	'.$Contratos->CONT_NUMORDEN.' DE '.
		$mesIni.' '.$diaIni.' DE '.$Contratos->CONT_ANIO.', DESDE EL '.$diaInicioCuenta.' DE '.$mesInicioCuenta.' HASTA EL '.$diaFinalCuenta.' DE '.
		$mesFinalCuenta.' DE '.$anioCuenta;
	 }
		
		
		echo CHtml::encode($concepto);
		
		  
     }
}
