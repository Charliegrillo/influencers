<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\FormRegister;
use app\models\Users;

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

use app\models\Influencers;

class SiteController extends Controller
{

 private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
 public function actionConfirm()
 {
    $table = new Users;
    if (Yii::$app->request->get())
    {
   
        //Obtenemos el valor de los parámetros get
        $id = Html::encode($_GET["id"]);
        $authKey = $_GET["authKey"];
    
        if ((int) $id)
        {
            //Realizamos la consulta para obtener el registro
            $model = $table
            ->find()
            ->where("id=:id", [":id" => $id])
            ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
 
            //Si el registro existe
            if ($model->count() == 1)
            {
                $activar = Users::findOne($id);
                $activar->activate = 1;
                if ($activar->update())
                {
                    echo "Enhorabuena registro llevado a cabo correctamente, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                }
                else
                {
                    echo "Ha ocurrido un error al realizar el registro, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                }
             }
            else //Si no existe redireccionamos a login
            {
                return $this->redirect(["site/login"]);
            }
        }
        else //Si id no es un número entero redireccionamos a login
        {
            return $this->redirect(["site/login"]);
        }
    }
 }
 
 public function actionRegister()
 {
  //Creamos la instancia con el model de validación
  $model = new FormRegister;
   
  //Mostrará un mensaje en la vista cuando el usuario se haya registrado
  $msg = null;
   
  //Validación mediante ajax
  if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
   
  //Validación cuando el formulario es enviado vía post
  //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
  //También previene por si el usuario tiene desactivado javascript y la
  //validación mediante ajax no puede ser llevada a cabo
  if ($model->load(Yii::$app->request->post()))
  {
   if($model->validate())
   {
    //Preparamos la consulta para guardar el usuario
    $table = new Users;
    $table->username = $model->username;
    $table->email = $model->email;
    //Encriptamos el password
    $table->password = crypt($model->password, Yii::$app->params["salt"]);
    //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
    //clave será utilizada para activar el usuario
    $table->authKey = $this->randKey("abcdef0123456789", 200);
    //Creamos un token de acceso único para el usuario
    $table->accessToken = $this->randKey("abcdef0123456789", 200);
     
    //Si el registro es guardado correctamente
    if ($table->insert())
    {
     //Nueva consulta para obtener el id del usuario
     //Para confirmar al usuario se requiere su id y su authKey
     $user = $table->find()->where(["email" => $model->email])->one();
     $id = urlencode($user->id);
     $authKey = urlencode($user->authKey);
      
     $subject = "Confirmar registro";
     $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
     $body .= "<a href='http://localhost:8080/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";
      
     //Enviamos el correo
     Yii::$app->mailer->compose()
     ->setTo($user->email)
     ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
     ->setSubject($subject)
     ->setHtmlBody($body)
     ->send();
     
     $model->username = null;
     $model->email = null;
     $model->password = null;
     $model->password_repeat = null;
     
     $msg = "Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo";
    }
    else
    {
     $msg = "Ha ocurrido un error al llevar a cabo tu registro";
    }
     
   }
   else
   {
    $model->getErrors();
   }
  }
  return $this->render("register", ["model" => $model, "msg" => $msg]);
 }	
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionUpdate($id)
    {   
        $model = Influencers::find()->where(['id' => $id])->one();
        $influencer = Yii::$app->request->post('Influencers');

        $model->name = $influencer['name'];
        $model->email = $influencer['email'];
        $model->url = $influencer['url'];        
        $model->category1 = serialize($influencer['category1']);
        $model->category2 = serialize($influencer['category2']);
        $model->category3 = serialize($influencer['category3']);      
        $model->category3 = serialize($influencer['category3']);    
        $model->fstart = Yii::$app->formatter->asDate($influencer['fstart'], "yyyy-MM-dd");
        $model->fend =  Yii::$app->formatter->asDate($influencer['fend'], "yyyy-MM-dd");
        $model->country = $influencer['country'];
        $model->lang = $influencer['lang'];
        $model->publicidad = $influencer['publicidad'];
        $model->ig_valuephoto = $influencer['ig_valuephoto'];
        $model->ig_discountphoto = $influencer['ig_discountphoto'];      
        $model->ig_valuevideo = $influencer['ig_valuevideo'];
        $model->ig_discountvideo = $influencer['ig_discountvideo'];  
        $model->ig_valuestory = $influencer['ig_valuestory'];
        $model->ig_discountstory = $influencer['ig_discountstory'];                            
        $model->save();
        //return $this->redirect(['/', ['id' => $id, 'action'=>'save']]);
    }
}
