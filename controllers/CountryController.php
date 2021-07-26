<?php

namespace app\controllers;

use Yii;
use app\models\Country;
use app\models\CountrySearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex($pageSize = 10)
    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$pageSize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pageSize' => $pageSize,
        ]);
    }

    /**
     * Displays a single Country model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Country();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = UploadedFile::getInstance($model, 'imageFile');
            $upload->saveAs(Yii::getAlias('@web') .'uploads/' . $model->SKU.'.'.$upload->extension);
            $model->imageFile = $model->SKU.'.'.$upload->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->SKU]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionBulk(){
        $selection=(array)Yii::$app->request->post('keylist');//typecasting
        foreach($selection as $id){
            //$e=Evento::findOne((int)$id);//make a typecasting
            //do your stuff
            $this->actionDelete($id);
            //$e->save();
        }
    }

    /**
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $upload = UploadedFile::getInstance($model, 'imageFile');
            $upload->saveAs(Yii::getAlias('@web') .'uploads/' . $model->SKU.'.'.$upload->extension);
            $model->imageFile = $model->SKU.'.'.$upload->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->SKU]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Country model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
