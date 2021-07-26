<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "country".
 *
 * @property string $SKU
 * @property string $name
 * @property int $Qty
 * @property string $Type
 * @property string $imageFile
 */
class Country extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SKU', 'name'], 'required'],
            [['Qty'], 'integer'],
            [['SKU'], 'string', 'min' => 2],
            [['Type'], 'string', 'min' => 2],
            [['name'], 'string', 'max' => 52],
            [['SKU'], 'unique'],
//            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SKU' => 'SKU',
            'name' => 'Name',
            'Qty' => 'Quantity',
            'Type' => 'Type',
            'imageFile' => 'imageFile',
        ];
    }
    public function getImageurl()
    {
        return Yii::getAlias('@web') .'uploads/' . $this->imageFile;
    }
}
