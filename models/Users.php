<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $email
 * @property string $gender
 * @property string $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'phone', 'email', 'gender', 'status'], 'required'],
            [['gender', 'status'], 'string'],
            ['status', 'in','range'=>['Married','Single']],
            ['gender', 'in','range'=>['Male','Female']      ],
            [['firstname', 'lastname'], 'string', 'max' => 20],
             [['firstname', 'lastname'],'match', 'not' => true, 'pattern' => '/[^a-zA-Z_\'.]/', 'message' => 'Only alphabets are allowed'],
            [['phone'], 'match','pattern'=>'/[2-9]{2}\d{8}/'],
            [['email'], 'email'],
            ['email','unique', 'message'=>'Already exist']
        ];
    }


/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phone' => 'Phone',
            'email' => 'Email',
            'gender' => 'Gender',
            'status' => 'Status',
        ];
    }
}
