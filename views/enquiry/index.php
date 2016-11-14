<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Enquiry', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   <?php  Pjax::begin(); ?>
    <?=    
            GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
          ['attribute'=> 'on_date',
              
              'filter'=>DateRangePicker::widget([
    'model'=>$searchModel,
    'attribute'=>'on_date',
    'convertFormat'=>true,
    'pluginOptions'=>[
        'timePicker'=>false,
        'timePickerIncrement'=>30,
        'locale'=>[
            'format'=>'Y-m-d'
        ]
    ]
])
              ],
//              ,'format'=>['date','d/m/Y']],
            ['attribute'=>'nameAndEmail',
                'label'=>'Name And Email',
                'value'=>  function ($data){
                return $data->name." ".$data->email;
                },
                ],
            ['attribute'=>'gender','filter'=>array('Male'=>'Male','Female'=>'Female')],
            ['attribute'=>'status',
                'filter'=>array('Active'=>'Active','Inactive'=>'Inactive'),
                'format'=>'raw',
                
             
                'value'=>function ($model, $key, $index, $column){
                   
                    if($model->status=='Active')
                    {
                        
                         return  Html::a('Active', ['change-status',['id'=>$model->id,'status'=>$model->status]], ['class'=>'btn btn-primary']);
                    }
                    else
                    {
                       return Html::a('Inactive', ['change-status',['id'=>$model->id,'status'=>$model->status]], ['class'=>'btn btn-danger'],['data-pjax'=>'0']);
                    }
                }
               ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);    ?>
    <?php  Pjax::end(); ?>
</div>
