<?php  
		//$modulo='academico'; 				//obtener el modulo
		//$submodulo='mdlacreditacion';      //obtener el submodulo
		//$modelo='acreditacionbitacoras'; 			//obtener el modelo
		$modulo=$model->rel_usuarios_controladores->rel_usuarios_submodulos->rel_usuarios_modulos->USMO_URL;	//obtener el modulo
		$submodulo=$model->rel_usuarios_controladores->rel_usuarios_submodulos->USSM_URL;      //obtener el submodulo
		$modelo=$model->rel_usuarios_controladores->USCO_URL; 			//obtener el modelo el nombre de la url del controlador es el msmo que el modelo
		$path = Yii::app()->basePath.'/../protected/modules/'.$modulo.'/views/'.$submodulo.'/'.$modelo.'/';				
		$directorio = dir($path);
		echo "Directorio ".$path.":<br><br>";
	?>           
	  <table border="1" cellpadding="11">
         <tr>	
                <td align="center">#</td>
                <td align="center">DIGITE NOMBRE VISTA</td>
                <td align="center">URL</td><td align="center">SELECCIONE</td>
         </tr>			
       	 <?php 
            $i=1;
            while ($archivo = $directorio->read())
            { 	//$archivophp = ; 	//excluir los archivos reciduales		
                if( strpos($archivo, '.php')== true){ 				
                    if( strncasecmp($archivo,'_',1) == true) { //excluir las vistas partiales
                        $url_vista=substr($archivo,0,-4); //extraer la extencion del texto                            
                      ?><tr>	
                            <td align="center" valign="middle"><?php echo $i; ?></td>
                            <td align="center" valign="middle"><input id="nombre(<?php echo $i; ?>)"  type="text" /></td>
                            <td valign="middle"><input id="url(<?php echo $i; ?>)"  type="text" value="<?php echo $url_vista; ?>" /></td>
                            <td align="center" valign="middle"><input id="check(<?php echo $i; ?>)"  type="checkbox"  
                                <?php if($i==0){ ?> checked="checked" <?php } ?> />
                            </td>         		
                       </tr>
                     <?php	
                     $i=$i+1;
                    }
                }
            }
            $directorio->close();  
        	?>
		</table> 
		
	
 