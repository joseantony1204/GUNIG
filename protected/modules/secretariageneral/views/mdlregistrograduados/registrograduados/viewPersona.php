
<!-- saved from url=(0117)https://bitbucket.org/christiansalazarh/ejemplodialogbox/raw/8608caa29384979982c4710d8a7c865b620000f4/viewPersona.php -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"></head><body><pre style="word-wrap: break-word; white-space: pre-wrap;">&lt;h1&gt;Prueba de Dialogo&lt;/h1&gt;

&lt;?php
	// 1. preparar los scripts de jQuery:
	$cs = Yii::app()-&gt;getClientScript();
	$cs-&gt;registerCoreScript('jquery');
	$cs-&gt;registerScriptFile($cs-&gt;getCoreScriptUrl()."/jui/js/jquery-ui.min.js");
	$cs-&gt;registerCssFile($cs-&gt;getCoreScriptUrl()."/jui/css/base/jquery-ui.css");
	// validator no lo trae Yii, asi que lo ponemos a mano en folder /JS/
	$cs-&gt;registerScriptFile("js/jquery-validate.js");
	$cs-&gt;registerScriptFile("js/json2.js");
	$cs-&gt;registerScriptFile("js/dialogo1.js");
?&gt;

&lt;?php
	// 2. un simple lanzador del dialogo
?&gt;
&lt;a id='lanzador' style='cursor: pointer;'&gt;Nueva Persona&lt;/a&gt;


&lt;?php
	// 3. el codigo del lanzador
?&gt;
&lt;script&gt;
	new Dialogo1(
	{
		idlanzador: "lanzador",
		iddialogo: "dialogo1",
		action: "index.php?r=site/persona",
		logid: "logger"
	}
);&lt;/script&gt;


&lt;?php // 4. el layout html del dialogo: ?&gt;
&lt;div id='dialogo1' class='form' style='display: none;'&gt;
	&lt;form id='dialogo1_form'&gt;
		&lt;div class="row"&gt;
			&lt;label&gt;Cédula: &lt;span class='required'&gt;*&lt;/span&gt;&lt;/label&gt;
			&lt;input type='text' name='cedula'&gt;
		&lt;/div&gt;
		&lt;div class="row"&gt;
			&lt;label class='requiered'&gt;Nombre: &lt;span class='required'&gt;*&lt;/span&gt;&lt;/label&gt;
			&lt;input type='text' name='nombre'&gt;
		&lt;/div&gt;
		&lt;div class="row"&gt;
			&lt;label&gt;Apellido:&lt;/label&gt;
			&lt;input type='text' name='apellido'&gt;
		&lt;/div&gt;
	&lt;/form&gt;
	&lt;div id='logger'&gt;...&lt;/div&gt;
&lt;/div&gt;
</pre></body></html>