<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'cm', 'A4', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. ENIO FONSECA REDONDO - UNIVERSIDAD DE LA GUAJIRA';  
 // $Numero = $Contratos->numOrden;     
  $titulo="ORDEN DE PAGO";
  $palabrasClaves='ORDENE DE PAGO, CUENTAS, CENTRAL DE CUENTAS';
  $Sujeto='ORDENES DE PAGOS';
  $NombreDocumento=$titulo;
  
  $pdf = new TCPDF(L, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $pdf->SetHeaderData('tcpdf_logoo.jpg', 160, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
 // Información referente al PDF
  $pdf->SetCreator($autor);
  $pdf->SetAuthor($autor);
  $pdf->SetTitle($titulo);
  $pdf->SetSubject($Sujeto);
  $pdf->SetKeywords($palabrasClaves);
  
    // Fuente de la cabecera y el pie de página
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
  // Márgenes
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  //$pdf->setPrintFooter(false);
	
  // Saltos de página automáticos.
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
  // Establecer el ratio para las imagenes que se puedan utilizar
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  
  
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
  
  ////////////////////////////////////
  	
		  
 	$model=Resoluciones::model()->findByPk($id);	
	$Reli = $model->loadLastDato($id);
	$Resolucionesliquidaciones=Resolucionesliquidaciones::model()->findByPk($Reli);
	
 	
	$qdato = $model->consultarPresupuesto($model->RESO_ID);
	foreach($qdato as $datos){	   
		  $fida[3] = $datos['PRES_SECCION'];
		  $fida[4] = $datos['PRES_CODIGO'];	   
	}
							
	
	$diaInicio = date("d",strtotime($model->RESO_FECHASUSCRIPCION));
	$mesInicio = NombreMes(date("m",strtotime($model->RESO_FECHASUSCRIPCION)));
	$anio = date("Y",strtotime($model->RESO_FECHASUSCRIPCION));
	
	$periodoCuenta = ', SUSCRITO DESDE EL '.$diaInicio.' DE '.$mesInicio.' DE '.$anio;
	$valorLetras = strtoupper($NumberToLetters->ValorEnLetras($Resolucionesliquidaciones->RELI_VALOR,"PESOS"));	
	
			if ($Resolucionesliquidaciones->CLRE_ID == 1){ 
						 
						 $rtfuente = round($Resolucionesliquidaciones->aplicaRtfuente($Resolucionesliquidaciones->RELI_ID, $Resolucionesliquidaciones->RELI_UTILIDAD, $Resolucionesliquidaciones->DEAT_ID), -3);
						 	
						 $iva=round($Resolucionesliquidaciones->RELI_IVA *0.15);
						 			 
						 $base = round($Resolucionesliquidaciones->RELI_EJECUTADO - $Resolucionesliquidaciones->RELI_IVA);					
												
						 $desc = $Resolucionesliquidaciones->aplicaDescuento($Resolucionesliquidaciones->RELI_ID, $base);
					 
						 $i=0;
						 $valorDescuentos = 0;
						 foreach($desc as $des){		 
							$id[$i] = $des['DESC_ID'];
							$nombre[$i] = $des['DESC_NOMBRE'];
							$nombres[$i] = $des['DESC_NOMBRES'];
							$valor[$i] = $des['VALOR'];
							$tarifa[$i] = $des['REDE_TARIFA'];
							$porcentaje[$i] = $des['PORCENTAJE'];
							
							
							if(($des['DESC_ID'])== 14){	
								$valor[$i] = (($Resolucionesliquidaciones->RELI_VALOR-$Resolucionesliquidaciones->RELI_IVA)*($des['REDE_TARIFA']/100));
							}
							
							
							if(($des['DESC_ID'])== 10){	
								$a=	($base * $des['REDE_TARIFA']) / 1000;
								$valor[$i] = (($a * 0.15) + $a);
							
							}
							
							if(($des['DESC_ID'])== 9){	
								$valor[$i] = round(($iva * 0.15), -3);;	
															
								$nombres[$i] = 'Iva (15%)';	
								$porcentaje[$i] = '0.150';
															
							}
							
							if($des['DESC_ID']== 2){								
										$valor[$i] = $rtfuente;								  
							}
													
							
							$vaDe = $vaDe + $valor[$i];
							$i=$i+1;	   
						  }					
						  
						  
						  	
			}
	
							
							
		$valorDescuentos=round($vaDe);		
							$valorTotal =  (int)($Resolucionesliquidaciones->RELI_VALOR - $valorDescuentos);
							$valorLetras = strtoupper($NumberToLetters->ValorEnLetras($valorTotal,"PESOS M/CTE."));				
							
							
							
	
	
	
	   //***** AÑADIR PAGINA *****//
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
	  $html =
	  '	
 
					                    
					


  


      



                        <table border="1" cellpadding="0" cellspacing="0">
                          <col width="102" />
                          <col width="101" />
                          <col width="237" />
                          <col width="95" />
                          <col width="148" />
                          <col width="74" />
                          <col width="90" />
                          <col width="67" />
                          <tr>
                            <td width="102" bgcolor="#FFFFFF"><strong>ORDEN    PAGO</strong></td>
                            <td width="101" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="332" colspan="2" bgcolor="#FFFFFF"><strong>A FAVOR DE:</strong></td>
                            <td width="222" colspan="2" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;C.C. o NIT:</strong></td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;FECHA DE PAGO</strong></td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;&nbsp;Cheque:</td>
                            <td width="101" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="332" colspan="2" rowspan="2" bgcolor="#FFFFFF"><div align="justify">'.$model->pERS->rel_personas_juridicas->PEJU_NOMBRE.''.$model->pERS->rel_personas_naturales->PENA_NOMBRES.'    '.$model->pERS->rel_personas_naturales->PENA_APELLIDOS.'</div></td>
                            <td width="222" colspan="2" rowspan="2" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;</strong>'.$model->pERS->PERS_IDENTIFICACION.'</td>
                            <td width="90" bgcolor="#FFFFFF">&nbsp;&nbsp;Dia:</td>
                            <td width="67" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;&nbsp;Banco:</td>
                            <td width="101" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="90" bgcolor="#FFFFFF">&nbsp;&nbsp;Mes:</td>
                            <td width="67" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;&nbsp;Obligación</td>
                            <td width="101" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="554" colspan="4" bgcolor="#FFFFFF"><strong>POR CONCEPTO DE:</strong></td>
                            <td width="90" bgcolor="#FFFFFF">&nbsp;&nbsp;Año:</td>
                            <td width="67" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;FECHA INGRESO</strong></td>
                            <td width="554" colspan="4" rowspan="3" bgcolor="#FFFFFF"><div align="justify">'.$model->RESO_CONCEPTO.'    '.$periodoCuenta.'</div></td>
                            
                             <td width="157" colspan="2" rowspan="5" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;&nbsp;Dia:</td>
                            <td width="101" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;&nbsp;Mes:</td>
                            <td width="101" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;&nbsp;Año:</td>
                            <td width="101" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="554" colspan="4" rowspan="2" bgcolor="#FFFFFF"><div align="justify"></div></td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;Sección:</strong> '.$fida[3].'</td>
                            <td width="237" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;VALOR TOTAL DE LA CUENTA</strong></td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right"><strong>$    '.number_format($Resolucionesliquidaciones->RELI_VALOR).'&nbsp;&nbsp;</strong></div></td>
                            
                            <td width="222" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                            
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;Código: '.$fida[4].'</strong></td>
                            <td width="101" bgcolor="#FFFFFF"><div align="center">Valor</div></td>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[0].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[0].'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[5].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[5].'&nbsp;&nbsp;</div></td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;CONTABILIDAD</strong></td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="101" bgcolor="#FFFFFF"><div align="right">$    '.number_format($Resolucionesliquidaciones->RELI_VALOR).'&nbsp;&nbsp;</div></td>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[1].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[1].'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[6].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[6].'&nbsp;&nbsp;</div></td>
                            <td width="90" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;Codificación</strong></td>
                            <td width="67" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="101" bgcolor="#FFFFFF"><div align="right">$    0&nbsp;&nbsp;</div></td>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[2].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[2].'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[7].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[7].'&nbsp;&nbsp;</div></td>
                            <td width="157" colspan="2" rowspan="7" bgcolor="#FFFFFF"><div align="center"></div></td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="101" bgcolor="#FFFFFF"><div align="right">$    0&nbsp;&nbsp;</div></td>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[3].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[3].'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[8].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[8].'&nbsp;&nbsp;</div></td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;&nbsp;Valor:</td>
                            <td width="101" bgcolor="#FFFFFF"><div align="right">$    '.number_format($Resolucionesliquidaciones->RELI_VALOR).'&nbsp;&nbsp;</div></td>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[4].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[4].'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[9].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[9].'&nbsp;&nbsp;</div></td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" rowspan="4" bgcolor="#FFFFFF"><div align="center"></div></td>
                            <td width="554" colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="554" colspan="4" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;VALORES DE DESCUENTOS</strong></td>
                          </tr>
                          <tr>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[0].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[0]).'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[5].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[5]).'&nbsp;&nbsp;</div></td>
                          </tr>
                          <tr>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[1].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[1]).'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[6].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[6]).'&nbsp;&nbsp;</div></td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" bgcolor="#FFFFFF"><div align="center">Presupuesto</div></td>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[2].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[2]).'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[7].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[7]).'&nbsp;&nbsp;</div></td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF"><div align="center">Vicerrec Admin y Finan</div></td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" rowspan="2" bgcolor="#FFFFFF"><div align="center"></div></td>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[3].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[3]).'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[8].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[8]).'&nbsp;&nbsp;</div></td>
                            <td width="157" colspan="2" rowspan="2" bgcolor="#FFFFFF"><div align="center"></div></td>
                          </tr>
                          <tr>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[4].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[4]).'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombres[9].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.number_format($valor[9]).'&nbsp;&nbsp;</div></td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" bgcolor="#FFFFFF"><div align="center">Central de Cuentas</div></td>
                            <td width="554" colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF"><div align="center">Tesorero</div></td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" rowspan="2" bgcolor="#FFFFFF"><div align="center"></div></td>
                            <td width="237" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;TOTAL DESCUENTOS:</strong></td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right"><strong>$    '.number_format($valorDescuentos).'&nbsp;&nbsp;</strong></div></td>
                            <td width="222" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="157" colspan="2" rowspan="2" bgcolor="#FFFFFF"><div align="center"></div></td>
                          </tr>
                          <tr>
                            <td width="237" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;TOTAL A PAGAR:</strong></td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right"><strong>$    '.number_format($valorTotal).'&nbsp;&nbsp;</strong></div></td>
                            <td width="222" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" bgcolor="#FFFFFF"><div align="center">Fecha: '.$model->RESO_FECHAPROCESO.'</div></td>
                            <td width="554" colspan="4" bgcolor="#FFFFFF"><div align="justify"><strong>CANTIDAD EN LETRAS:</strong> '.$valorLetras.'</div></td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF"><div align="center">Beneficiario</div></td>
                          </tr>
                        </table>
                        
                        
                        
                    
                              


     


                        						
                    
                    
                    
	 

	  ';
	
   $pdf->SetFont('times', 'K', 12);
   $pdf->writeHTML($html, true, 0, true, 0); 
   $pdf->Output("$NombreDocumento.pdf", 'D');   
   Yii::app()->end();  
?>