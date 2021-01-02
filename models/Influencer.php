<?php

namespace app\models;
use yii\base\Model;

class Influencer  extends Model {
	public $id;
    public $name;
    public $email;
	public $url;
	public $country;
	public $lang;
	public $publicidad;
	public $category1;
	public $category2;
	public $category3;		
	public $fstart;
	public $fend;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}
