<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enquiry".
 *
 * @property integer $id
 * @property string $on_date
 * @property string $name
 * @property string $email
 * @property string $gender
 * @property string $status
 */
class Enquiry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enquiry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['on_date', 'name', 'email', 'gender','status'], 'required'],
            [['on_date'], 'safe'],
            [['gender'], 'string'],
            [['name', 'email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'on_date' => 'Date of Enquiry',
            'name' => 'Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'status'=>'Status'
        ];
    }
}
