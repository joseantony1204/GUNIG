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
  
   
  $Cuentas=Cuentas::model()->findByPk($id);
  $Contratos=Contratos::model()->findByPk($Cuentas->CONT_ID);
  $Clasescontratos=Clasescontratos::model()->findByPk($Contratos->CLCO_ID);
  $dt = $liquidaciones->loadLiquidacion($id);
  $Liquidaciones = Liquidaciones::model()->findByPk($dt);
    
  $querys = $liquidaciones->consultarPresupuesto($id);
	foreach($querys as $data){	   
	  $filla[3] = $data['PRES_SECCION'];
	  $filla[4] = $data['PRES_CODIGO'];	   
	}

	$pago = $liquidaciones->consultarPago($Contratos->CONT_ID);
	foreach($pago as $dato){	  
	  $fil[0] = $dato['CANTIDAD'];
	  $fil[1] = $dato['TOTAL'];	 
	}	
	$pagos = $liquidaciones->consultarPagos($Contratos->CONT_ID);
	foreach($pagos as $datos){	  
	  $filc[0] = $datos['CANTIDAD'];
	  $filc[1] = $datos['TOTAL'];	 
	}
		
		
		



	if ($Contratos->CLCO_ID == 140){ 
	
	if ($Cuentas->TIPA_ID == 2){   
			$valorTotal =  $Cuentas->CUEN_VALOR;
			$valorLetras = strtoupper($NumberToLetters->ValorEnLetras($valorTotal,"PESOS M/CTE."));		
		}else{
	
					 $rtfuente = round($liquidaciones->aplicaRtfuente($Liquidaciones->LIQU_ID, $Liquidaciones->LIQU_UTILIDAD, $Liquidaciones->DEAT_ID), -3);
						 	
						 $iva=round(($Liquidaciones->LIQU_IVA *0.15), -3);
						 			 
						 $base = round($Liquidaciones->LIQU_EJECUTADO - $Liquidaciones->LIQU_IVA);					
												
						 $desc = $liquidaciones->aplicaDescuento($Liquidaciones->LIQU_ID, $base);
						 
						 
						 $i=0;
						 $valorDescuentos = 0;
						 foreach($desc as $des){		 
							$id[$i] = $des['DESC_ID'];
							$nombre[$i] = $des['DESC_NOMBRE'];
							$nombres[$i] = $des['DESC_NOMBRES'];
							$valor[$i] = $des['VALOR'];
							$tarifa[$i] = $des['LIDE_TARIFA'];
							$porcentaje[$i] = $des['PORCENTAJE'];
							if(($des['DESC_ID'])== 10){	
								$a=	($base * $des['LIDE_TARIFA']) / 1000;
								$valor[$i] = (($a * 0.15) + $a);
							}
							
							if(($des['DESC_ID'])== 14){	
								$valor[$i] = (($Cuentas->CUEN_VALOR-$Liquidaciones->LIQU_IVA)*($des['LIDE_TARIFA']/100));
							}
							
							if(($des['DESC_ID'])== 9){	
								$valor[$i] = round($iva, -3);	
								$nombres[$i] = 'Iva (15%)';	
								$porcentaje[$i] = '0.150';	
								
								
								if($liquidaciones->LIQU_APLICAIVA==2){
							   		
									$valor[$i] = $iva*0;	
									$nombres[$i] = 'Iva (0%)';	
									$porcentaje[$i] = '0.0';
								}
								
								
													
							}
							
							if($des['DESC_ID']== 2){								
										$valor[$i] = $rtfuente;								  
							}
							
							
							$vaDe = $vaDe + $valor[$i];
							$i=$i+1;	   
						  }					
						  
						  
						  	$valorDescuentos=round($vaDe);		
							$valorTotal =  (int)($Cuentas->CUEN_VALOR - $valorDescuentos);
							$valorLetras = strtoupper($NumberToLetters->ValorEnLetras($valorTotal,"PESOS M/CTE."));	
	
	
	}
	}else{
	
	
	
		
		if ($Cuentas->TIPA_ID == 2){   
			$valorTotal =  $Cuentas->CUEN_VALOR;
			$valorLetras = strtoupper($NumberToLetters->ValorEnLetras($valorTotal,"PESOS M/CTE."));		
		}else{
				if(($Cuentas->TIPA_ID != 2) & ($Liquidaciones->LIQU_ANTICIPO == 1)){		 					
					 $culi='EN ESTA LIQUIDACION SE ADICIONAN LOS DESCUENTOS POR ANTICIPO ENTREGADO POR VALOR DE: $ ' .number_format($fil[1]);
					 $valorLiquidar = $Cuentas->CUEN_VALOR + $fil[1];
					 
					 $iv = $liquidaciones->aplicaIva($Liquidaciones->LIQU_ID, $valorLiquidar);
					 $iva=round($iv, -3);	
					 
					 if($liquidaciones->LIQU_APLICAIVA==2){							   		
						$iva=0;									
					 }
					 				 
					 $base = (($Cuentas->CUEN_VALOR + $fil[1]) - $iva);				 
					 
					 $desc = $liquidaciones->aplicaDescuento($Liquidaciones->LIQU_ID, $base);
					 $i=0;
					 $valorDescuentos = 0;
					 foreach($desc as $des){		 
						$id[$i] = $des['DESC_ID'];
						$nombre[$i] = $des['DESC_NOMBRE'];
						$nombres[$i] = $des['DESC_NOMBRES'];
						$valor[$i] = $des['VALOR'];
						$tarifa[$i] = $des['LIDE_TARIFA'];			
						$porcentaje[$i] = $des['PORCENTAJE'];
						if(($des['DESC_ID'])== 10){	
								$a=	($base * $des['LIDE_TARIFA']) / 1000;
								$valor[$i] = ($a * 0.15) + $a;
						}
						
						
						
						if(($des['DESC_ID'])== 9){	
							$valor[$i] = round(( $iva * 0.15 ),-3);
							$nombres[$i] = 'Iva (15%)';	
							$porcentaje[$i] = '0.150';
							
							if($liquidaciones->LIQU_APLICAIVA==2){							   		
									$valor[$i] = $iva*0;	
									$nombres[$i] = 'Iva (0%)';	
									$porcentaje[$i] = '0.0';
								}
								
						}
						
						if(($des['DESC_ID'])== 2){	
								$valor[$i] = round($valor[$i], -3);													
						}
						
						
						
						$vaDe = $vaDe + $valor[$i];
						$i=$i+1;	   
					  }	
					  $valorDescuentos=round($vaDe);
					  $valorTotal =  (int)($Cuentas->CUEN_VALOR - $valorDescuentos);
					  $valorLetras = strtoupper($NumberToLetters->ValorEnLetras($valorTotal,"PESOS M/CTE."));
										
				}else{						
						 $iv = $liquidaciones->aplicaIva($Liquidaciones->LIQU_ID, $Cuentas->CUEN_VALOR);		
						 $iva=round($iv, -3);	
						 
						 if($liquidaciones->LIQU_APLICAIVA==2){							   		
							$iva=0;									
						 }
						 		 
						 $base = ($Cuentas->CUEN_VALOR - $iva);					
												
						 $desc = $liquidaciones->aplicaDescuento($Liquidaciones->LIQU_ID, $base);
						 $i=0;
						 $valorDescuentos = 0;
						 foreach($desc as $des){		 
							$id[$i] = $des['DESC_ID'];
							$nombre[$i] = $des['DESC_NOMBRE'];
							$nombres[$i] = $des['DESC_NOMBRES'];
							$valor[$i] = $des['VALOR'];
							$tarifa[$i] = $des['LIDE_TARIFA'];
							$porcentaje[$i] = $des['PORCENTAJE'];
							
							if(($des['DESC_ID'])== 10){	
								$a=	($base * $des['LIDE_TARIFA']) / 1000;
								$valor[$i] = (($a * 0.15) + $a);
							}
							
							if(($des['DESC_ID'])== 9){	
								$valor[$i] = round(($iva * 0.15), -3);	
								$nombres[$i] = 'Iva (15%)';	
								$porcentaje[$i] = '0.150';
								
								if($liquidaciones->LIQU_APLICAIVA==2){
							   		
									$valor[$i] = $iva*0;	
									$nombres[$i] = 'Iva (0%)';	
									$porcentaje[$i] = '0.0';
								}
															
							}
							
							
						if(($des['DESC_ID'])== 2){	
								$valor[$i] = round($valor[$i], -3);													
						}						
							
							$vaDe = $vaDe + $valor[$i];
							$i=$i+1;	   
						  }						  
						  	$valorDescuentos=round($vaDe);		
							$valorTotal =  (int)($Cuentas->CUEN_VALOR - $valorDescuentos);
							$valorLetras = strtoupper($NumberToLetters->ValorEnLetras($valorTotal,"PESOS M/CTE."));		
				}
		}
		
	}
		
		
		
		

		
		
			
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
                            <td width="332" colspan="2" rowspan="2" bgcolor="#FFFFFF"><div align="justify">'.$Contratos->Persona->rel_personas_juridicas->PEJU_NOMBRE.''.$Contratos->Persona->rel_personas_naturales->PENA_NOMBRES.'    '.$Contratos->Persona->rel_personas_naturales->PENA_APELLIDOS.'</div></td>
                            <td width="222" colspan="2" rowspan="2" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$Contratos->Persona->PERS_IDENTIFICACION.'</td>
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
                            <td width="554" colspan="4" rowspan="3" bgcolor="#FFFFFF"><div align="justify">'.$Liquidaciones->LIQU_CONCEPTO.'</div></td>
                            
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
                            <td width="554" colspan="4" rowspan="2" bgcolor="#FFFFFF"><div align="justify">'.$culi.'</div></td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="203" colspan="2" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;Sección:</strong> '.$filla[3].'</td>
                            <td width="237" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;VALOR TOTAL DE LA CUENTA</strong></td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right"><strong>$    '.number_format($Cuentas->CUEN_VALOR).'&nbsp;&nbsp;</strong></div></td>
                            
                            <td width="222" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                            
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;Código:</strong> '.$filla[4].'</td>
                            <td width="101" bgcolor="#FFFFFF"><div align="center">Valor</div></td>
                            <td width="237" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[0].'</td>
                            <td width="95" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[0].'&nbsp;&nbsp;</div></td>
                            <td width="148" bgcolor="#FFFFFF">&nbsp;&nbsp;'.$nombre[5].'</td>
                            <td width="74" bgcolor="#FFFFFF"><div align="right">'.$porcentaje[5].'&nbsp;&nbsp;</div></td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp;CONTABILIDAD</strong></td>
                          </tr>
                          <tr>
                            <td width="102" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="101" bgcolor="#FFFFFF"><div align="right">$    '.number_format($Cuentas->CUEN_VALOR).'&nbsp;&nbsp;</div></td>
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
                            <td width="101" bgcolor="#FFFFFF"><div align="right">$    '.number_format($Cuentas->CUEN_VALOR).'&nbsp;&nbsp;</div></td>
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
                            <td width="203" colspan="2" bgcolor="#FFFFFF"><div align="center">Fecha: '.$Liquidaciones->LIQU_FECHA.'</div></td>
                            <td width="554" colspan="4" bgcolor="#FFFFFF"><div align="justify"><strong>CANTIDAD EN LETRAS:</strong> '.$valorLetras.'</div></td>
                            <td width="157" colspan="2" bgcolor="#FFFFFF"><div align="center">Beneficiario</div></td>
                          </tr>
                        </table>

	  ';
	
   $pdf->SetFont('times', 'K', 10);
   $pdf->writeHTML($html, true, 0, true, 0); 
   $pdf->Output("$NombreDocumento.pdf", 'D');   
   Yii::app()->end();  
?>