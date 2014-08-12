<?php
$this->widget('application.extensions.xupload.XUpload', array(
                    'url' => Yii::app()->createUrl("site/upload"),
                    'model' => $model,
                    'attribute' => 'file',
                    'multiple' => true,
));
?>