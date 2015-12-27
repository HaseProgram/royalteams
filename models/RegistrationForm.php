<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class RegistrationForm extends Model
{
    public $password_repeat;
    public $username;
    public $email;
    public $password;
    public $access_group;

    public $first_name;
    public $second_name;
    public $birth_day;
    public $birth_month;
    public $birth_year;
    public $country;

    public $character;
    public $ingame_username;
    public $ingame_clan;
    public $ingame_league;

    public $verify;

    public function attributeLabels(){
        return [
            'username'=>'Username',
            'email'=>'Email',
            'password'=>'Password',
            'password_repeat'=>'Repeat password',
            'first_name'=>'First name',
            'second_name'=>'Second name',
            'character'=>'Character *',
            'ingame_username' => 'Nickname *',
            'ingame_clan'=>'Clan',
            'ingame_league'=>'League'
        ];
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat', 'first_name', 'second_name','character','ingame_username'],'filter', 'filter' => 'trim'],
            [['username', 'email', 'password', 'password_repeat', 'first_name', 'second_name','character','ingame_username'],'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'This username is already taken'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'This email is already taken'],
            ['verify', 'default', 'value' => User::verify_false, 'on' => 'default'],
            ['verify', 'in', 'range' =>[
                User::verify_false,
                User::verify_true
            ]],
            ['verify', 'default', 'value' => User::verify_true, 'on' => 'emailActivation'],
        ];
    }


    public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->verify = $this->verify;
        $user->access_group = 1;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }

}
