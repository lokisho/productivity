<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $nombre
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $last_login_time
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class User extends CActiveRecord
{
	public $password_repeat;
	public $flag_pass_change = true; //avoid to encrypt an already encrypted pass
	const PASS_RESET='Cmms7084$';
	const ID_ADMIN = 1;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, nombre','required'),
			array('password', 'compare'),
			array('username','unique','message'=>'user_repeated'),
			array('username', 'length', 'max'=>256),
			array('create_user_id, update_user_id', 'length', 'max'=>20),
			array('last_login_time, create_time, update_time, nombre, password_repeat, email, activo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, username, last_login_time, create_time, create_user_id, update_time, update_user_id, nombre', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'e-mail',
			'nombre' => 'Nombre',
			'username' => 'Usuario',
			'password' => 'Clave',
			'last_login_time' => 'Last Login Time',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
			'password_repeat' => 'Confirmar clave',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getUsers()
	{
		$sql="SELECT * FROM tbl_user WHERE activo = :activo ORDER BY username ASC";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":activo",1, PDO::PARAM_INT);
		return CHtml::listData($command->queryAll(),'id','username');
	}
	
	public static function getListUsers(){
		return self::model()->findAll(array('condition'=>'activo = :activo','params'=>array('activo'=>1),'order'=>'nombre ASC'));
	}
	
	public function afterValidate()
	{
		
		if($this->flag_pass_change) //avoid to encrypt an already encrypted pass
		{
			$this->password=$this->encrypt($this->password);
			return parent::afterValidate();
		}
		
	}
	
	public function encrypt($value)
	{
		return md5($value);
	}
    
    public function resetPassword()
    {
	    $this->password=self::PASS_RESET;
	    $this->password_repeat= self::PASS_RESET;
    } 
	
	public function registrarPermisos($permisos=array())
	{
		$permisos_actual = Yii::app()->authManager->getAuthAssignments($this->id);
		
        foreach ($permisos_actual as $item) {
            Yii::app()->authManager->revoke($item->itemName, $this->id);
        }
		
		foreach($permisos as $key => $permiso)
		{
			if($permiso==1)
				Yii::app()->authManager->assign($key,$this->id);
		}
		
		
	}
	
}