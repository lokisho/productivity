<?php

class OperacionController extends Controller
{
	
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','pausar','reiniciar','terminar','getSecciones'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
	public function actionCreate()
	{
		$model=new Operacion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$model->id_estado=$model::ESTADO_ABIERTO;
		$model->fechaInicio = $this->fechaInicio();
		$model->horaInicio = $this->horaInicio();
		
		
		if(isset($_POST['Operacion']))
		{
			$model->attributes=$_POST['Operacion'];
			//print_r($model->attributes,false);
			//die();
			if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
				$this->refresh();
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	protected function fechaInicio()
	{
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Costa_Rica'));
		return $date->format('Y-m-d');
	}
	
	protected function horaInicio()
	{
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Costa_Rica'));
		return $date->format('H:i');
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Operacion']))
		{
			$model->attributes=$_POST['Operacion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/
	
	/* OVERWRITES ORIGINAL FUNCTION */
	
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Operacion']))
		{
			$model->attributes=$_POST['Operacion'];
			if($model->fechaPausa == "")
				$model->fechaPausa = null;
			if($model->horaPausa == "")
				$model->horaPausa = null;
			
			if(! $model->save())
				throw new CHttpException('501','Error al actualizar la operacion');
				//$this->redirect(array('view','id'=>$model->id));
		}

		$this->renderPartial('/operacion/_form_edit',array(
			'model'=>$model,
		),false,true);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Operacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Operacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Operacion']))
			$model->attributes=$_GET['Operacion'];

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
		$model=Operacion::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='operacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionPausar($id)
	{
		$model= $this->loadModel($id);
		$model->id_estado = $model::EST_PAUSADO;
			
		$model->calculateTiempoReal(); //Calculates the acumulated of "tiempoReal";
		$model->numPausa++;	
		if(! $model->save())
			throw new CHttpException('501','Error al actualizar la operación');
		else{
			$this->renderPartial('_list', array('operaciones'=>Operacion::getOperaciones(array('estados'=>array($model::EST_ACTIVO,$model::EST_PAUSADO)))),false,true);
		}
		
	}
	
	public function actionReiniciar($id)
	{
		$model= $this->loadModel($id);
		$model->fechaPausa = $this->fechaInicio();
		$model->horaPausa = $this->horaInicio();
		$model->id_estado = $model::EST_ACTIVO;
		if(! $model->save())
			throw new CHttpException('501','Error al actualizar la operación');
		else{
			$this->renderPartial('_list', array('operaciones'=>Operacion::getOperaciones(array('estados'=>array($model::EST_ACTIVO,$model::EST_PAUSADO)))),false,true);
		}
		
	}
	
	public function actionTerminar($id)
	{
		$model= $this->loadModel($id);
		$model->fechaFin = $this->fechaInicio();
		$model->horaFin = $this->horaInicio();
		if($model->id_estado == $model::EST_ACTIVO)
		{
			$model->calculateTiempoReal();
		}
		$model->id_estado = $model::EST_TERMINADO;
		
		if(! $model->save())
			throw new CHttpException('501','Error al actualizar la operación');
		else{
			$this->renderPartial('_list', array('operaciones'=>Operacion::getOperaciones(array('estados'=>array($model::EST_ACTIVO,$model::EST_PAUSADO)))),false,true);
		}
		
	}
	
	public function actionGetSecciones()
	{
		$seccion=Seccion::model()->findAll(array('condition'=>'id_proyecto=:idProyecto AND activo = :Activo', 
		'params'=>array(':idProyecto'=>(int) $_POST['id_proyecto'],':Activo'=>1),'order'=>'nombre ASC'));
		
		$data= CHtml::listData($seccion,'id','nombre');
		echo "<option value=''>Seleccione Uno</option>";
		foreach($data as $key=>$seccion)
			echo CHtml::tag('option', array('value'=>$key),CHtml::encode($seccion),true);
		
	}
	
	
	
	
}
