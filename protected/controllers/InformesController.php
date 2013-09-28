<?php

class InformesController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('informeOperaciones','informeOperaciones_1','informeOperaciones_0'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
		
	public function actionInformeOperaciones()
	{
		

		
		$informe = new Informes;
		$array=array('informe'=>$informe);
		if(isset($_POST['Inf_Operaciones']))
		{
			$array['params']=$_POST['Inf_Operaciones'];
		}
		
		$this->render('informeOperaciones',$array);
		


		
	}

	public function actionInformeOperaciones_1()
	{
	
		
		$informe = new Informes;
		$array = array('informe'=>$informe);
		if(isset($_POST['Inf_Operaciones']))
		{
			
			$params = $_POST['Inf_Operaciones'];
			$array['params']=$params;
		} 
	
		 $this->renderPartial('_sub_1_informeOperaciones',$array,false,true); 
				 

	}
	
	public function actionInformeOperaciones_0()
	{
	 		 
		 $this->renderPartial('_sub_0_informeOperaciones',array(),false,true); 
			 
	}
	

	public function actionDownloadInformeOperaciones(){
		/*
		if(isset($_POST['ids']))
		{
		
		Yii::import('ext.yiireport.*');

		$informe = new Informes;
		
		$data = $informe->dataInfMantenimientosExcel($_POST['ids']);
        
        $r = new YiiReport(array('template'=> 'informeMantenimientosNr.xls'));
        
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'title' => 'INFORME DE MANTENIMIENTOS NO REALIZADOS'
                    )
                ),
                array(
                    'id'=>'cal',
                    'repeat'=>true,
                    'data'=>$data,
                    'minRows'=>2
                )
            )
        );
        
        //echo $r->render('excel5', 'Students');
        echo $r->render('excel2007', 'InformeMantenimientosNr');
        //echo $r->render('pdf', 'Students');
		}
		else{ 
			throw new CHttpException('403','Calendarios not found');
		}
		*/
	}
	
	
}
	