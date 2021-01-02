<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\web\Controller;
use yii\helpers\ArrayHelper;

use app\models\Influencers;
use app\models\Countrys;
use app\models\Langs;

use yii\jui\DatePicker;

$model = Influencers::findOne(1);
$model->category1 = unserialize($model->category1);
$model->category2 = unserialize($model->category2);
$model->category3 = unserialize($model->category3);

$country = ArrayHelper::map(Countrys::find()->orderBy('name')->asArray()->all(), 'code', 'name');
$lang = ArrayHelper::map(Langs::find()->orderBy('name')->asArray()->all(), 'code', 'name');

?>

<div class="col-12 mt-4">
	<h4>Mis redes sociales</h4>
</div>
<section class="step-1">
<div class="col-12">
	<?php $form = ActiveForm::begin([
		'id'=> 'formdatos',
		'options' => ['name' => 'formdatos'],
		'method' => 'POST',
	    'action' => Url::to(['site/update', 'id' => $model->id]),
		'enableClientValidation' => false,
		'enableAjaxValidation' => true,
	]); ?>
	<div class="form-row">
	    <div class="col-md-4 mb-3">
		      <?= $form->field($model, 'name')
		        	->label('Nombre')
		        	->textInput(['placeholder'=>'Nombre']); ?>
			<div class="valid-feedback">
				ok!
			</div>
	    </div>
	    <div class="col-md-4 mb-3">
	      <?= $form->field($model, 'email')
	        	->label('Email')
	        	->textInput(['placeholder'=>'Email']); ?>
			<div class="valid-feedback">
				ok!
			</div>
	    </div>    
	</div>
	<div class="form-row">
	    <div class="col-md-12 mb-3">
		      <?= $form->field($model, 'url')
		        	->label('Url')
		        	->textarea(['rows' => '2']); ?>	    	
	    </div>
	</div>	
	<div class="form-row">
	    <div class="col-md-6 mb-3">
		      <?= $form->field($model, 'country')->dropdownList($country,
			    ['prompt'=>'Seleccione']
				)->label('Para mayoria de la audiencia'); ?>	    	
	    </div>
	    <div class="col-md-6 mb-3">
		     <?= $form->field($model, 'lang')->dropdownList($lang,
			    ['prompt'=>'Seleccione']
				)->label('Idioma'); ?>	    	
	    </div>	    
	</div>	
	<div class="form-row">
	    <div class="col-md-12 mb-3">
		      <?= $form->field($model, 'publicidad')->radioList([
				    1 => 'Siempre indicaré en mis publicaciones patrocinados que ese texto es publicidad', 
				    2 => 'Dependerá de cada caso, de la marca y del producto del que hable'
				]); ?>	    	
	    </div>
	</div>	
	<div class="form-row">
	    <div class="col-md-12 mb-3 droply-filedrag">
			<div class="droply-box-label">¡Arrastra y suelta tu imagen aqui!</div>	
			<div class="droply-box-size">300x300 px (como minimo). Solo PNG y JPEG</div>	
 			<input type="file" class="form-control-file" id="inputFile" accept="image/png, image/jpeg" onchange="readUrl(this)"  data-title="Drag and drop a file">
			<div class="droply-box-file"></div>
	    </div>
		<button type="button" class="btn btn-primary">Aceptar captura</button>	
		<button type="button" class="btn btn-primary ml-3" onclick="document.getElementById('inputFile').click()">Subir imagen</button>		    
	</div>
	<div class="form-row mt-5">
		<div class="col-md-12">
			<label>Categorias a la que pertenece tu red social (Máximo 3)</label>
		</div>
	    <div class="col-md-4 mb-3">
			<?= $form->field($model, 'category1')->label('')->checkboxList([
		    1 => 'Animales', 
		    2 => 'Fotografia y diseño',
		    3 => 'Belleza',
		    4 => 'Deportes',
			], ['itemOptions'=>['class' => 'category']]); ?>		    	
	    </div>
	    <div class="col-md-4 mb-3">
			<?= $form->field($model, 'category2')->label('')->checkboxList([
			5 => 'Diarios',
		    6 => 'Animales', 
		    7 => 'Fotografia y diseño',
		    8 => 'Belleza',
			], ['itemOptions'=>['class' => 'category']]); ?>		    	
	    </div>
	    <div class="col-md-4 mb-3">
			<?= $form->field($model, 'category3')->label('')->checkboxList([
		    9 => 'Animales', 
		    10 => 'Fotografia y diseño',
		    11 => 'Belleza',
			], ['itemOptions'=>['class' => 'category']]); ?>		    	
	    </div>	    	    
	</div>
	<div class="form-row">
	    <div class="col-md-12 mb-3">
			<h5>Modo Vacaciones</h5>    	
	    </div>		
	    <div class="col-md-12 mb-3">
			<label>Configura el Modo Vacaciones si quieres desactivar este recurso durante una temporada</label>    	
	    </div>
	    <div class="col-md-4 mb-3">
             <label for="mi_calendario" class="control-label">Fecha de inicio de vacaciones</label>
             <div class="controls">
                <div class="input-group date">
			   		<?= DatePicker::widget([
				    'model' => $model,
				    'attribute' => 'fstart',
			   		'language' => 'es',
				    'dateFormat' => 'dd-MM-yyyy',
				    'options' => ['placeholder'=>'  /  /  ','class' => 'form-control']
					]); ?>
                   <label for="influencer-fstart" class="input-group-addon generic_btn"><i class="far fa-calendar-alt" aria-hidden="true"></i></label>
                </div>
             </div>
	    </div>	 
		<div class="col-md-4">
             <label for="mi_calendario" class="control-label">Fecha de fin de vacaciones</label>
             <div class="controls">
                <div class="input-group date">
			   		<?= DatePicker::widget([
				    'model' => $model,
				    'attribute' => 'fend',
			   		'language' => 'es',
				    'dateFormat' => 'dd-MM-yyyy',
				    'options' => ['placeholder'=>'  /  /  ','class' => 'form-control']
					]); ?>
                   <label for="influencer-fstart" class="input-group-addon generic_btn"><i class="far fa-calendar-alt" aria-hidden="true"></i></label>
                </div>
             </div>
        </div>       
	</div>		
</div>
</section>
<section class="step-2" style="display: none;">
	<div class="row mt-4">
		<div class="col-6">	
			<h4>Servicios y precios</h4>
		</div>		
	</div>	
	<div class="card">
		<div class="card-body">
				<div class="row">
					<div class="col-6">
						<label><input type="checkbox" name="photoInstagram" <?= ($model->ig_valuephoto>0) ? 'checked':''; ?>> Foto en Instagram</label>							
					</div>		
					<div class="col-6 text-right">
						<i class="fa fa-info-circle" aria-hidden="true"></i>					
					</div>		
				</div>
				<div class="row">
					<div class="col-12">
						El servicio consiste en Publicar una foto en Instagram con un texto asociado  y uno o varios hashtags a elegir por el anunciante.
					</div>		
				</div>
				<div class="row">
					<div class="col-6">
						 <label for="email" class="mr-sm-2">Valor para este paquete:</label>
						<?= Html::input('number', 'Influencers[ig_valuephoto]', $model->ig_valuephoto, ['placeholder' => '$']) ?>
					</div>		
					<div class="col-6 text-right">
						 <label for="email" class="mr-sm-2">Promoción descuento:</label>
						<?= Html::input('number', 'Influencers[ig_discountphoto]', $model->ig_discountphoto) ?>				
					</div>		
				</div>				
		</div>
	</div>
	<div class="card">
		<div class="card-body">
				<div class="row">
					<div class="col-6">
						<label><input type="checkbox" name="photoInstagram" <?= ($model->ig_valuevideo>0) ? 'checked':''; ?>> Video en Instagram</label>							
					</div>		
					<div class="col-6 text-right">
						<i class="fa fa-info-circle" aria-hidden="true"></i>					
					</div>		
				</div>
				<div class="row">
					<div class="col-12">
						El servicio consiste en Publicar un video en Instagram con un texto asociado  y uno o varios hashtags a elegir por el anunciante.
					</div>		
				</div>
				<div class="row">
					<div class="col-6">
						 <label for="email" class="mr-sm-2">Valor para este paquete:</label>
						<?= Html::input('number', 'Influencers[ig_valuevideo]', $model->ig_valuevideo, ['placeholder' => '$']) ?>
					</div>		
					<div class="col-6 text-right">
						 <label for="email" class="mr-sm-2">Promoción descuento:</label>
						<?= Html::input('number', 'Influencers[ig_discountvideo]', $model->ig_discountvideo) ?>				
					</div>		
				</div>				
		</div>
	</div>
	<div class="card">
		<div class="card-body">
				<div class="row">
					<div class="col-6">
						<label><input type="checkbox" name="photoInstagram" <?= ($model->ig_valuestory>0) ? 'checked':''; ?>> Instagram Story</label>									
					</div>		
					<div class="col-6 text-right">
						<i class="fa fa-info-circle" aria-hidden="true"></i>					
					</div>		
				</div>
				<div class="row">
					<div class="col-12">
						El servicio consiste en Publicar un Instagram Story siguiendo el briefing definido por la marca.
					</div>		
				</div>
				<div class="row">
					<div class="col-6">
						 <label for="email" class="mr-sm-2">Valor para este paquete:</label>
						<?= Html::input('number', 'Influencers[ig_valuestory]', $model->ig_valuestory, ['placeholder' => '$']) ?>
					</div>		
					<div class="col-6 text-right">
						 <label for="email" class="mr-sm-2">Promoción descuento:</label>
						<?= Html::input('number', 'Influencers[ig_discountstory]', $model->ig_discountstory) ?>				
					</div>		
				</div>				
		</div>
	</div>	
</section>
<?php ActiveForm::end(); ?>