<?php

namespace app\models;

use Yii;
use yii\base\Model;

class TrackForm extends Model
{
    public $track;
    public $result = 'test';

    public function rules()
    {
        return [
            ['track', 'required'],
        ];
    }
}