<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 *
	 * @throws CHttpException
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=Yii::app()->getModule('ycm')->username;
		$pass=Yii::app()->getModule('ycm')->password;
		$users=array(
			$user=>$pass,
		);
		$users_idresp = array();
		$usuarios_proyectos = GeoUsuarios::model()->findAll();
		foreach($usuarios_proyectos as $usr) {
			$users[$usr->usuario] = $usr->password;
			$users_idresp[$usr->usuario] = $usr->id_instructors;
		}
		if ($user===null || $pass===null) {
			throw new CHttpException(500,Yii::t(
				'YcmModule.ycm',
				'Please configure "username" and "password" properties of the module in configuration file.')
			);
		} else if (!isset($users[$this->username])) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if ($users[$this->username]!==$this->password) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else {
				$_SESSION["usuario"] = $this->username;
				if($this->username != $user)
					$_SESSION["id_instructors"] = $users_idresp[$this->username];
				else
					$_SESSION["id_instructors"] = '';

			$this->errorCode=self::ERROR_NONE;
		}

		return !$this->errorCode;
	}
}