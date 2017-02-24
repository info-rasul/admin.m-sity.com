<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUpload;

$this->title = 'Добавить объявление';
//var_dump($model); die();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
		    <div class="card">
		        <div class="card-header">
		            <div class="row head-new-ads">
			            <div class="col-md-7">
				            <h4 class="card-title"><i class="fa fa-plus new-head-ad"></i><?=Yii::t('app', 'New ad');?></h4>
				            <div class="small text-muted" style="margin-top:-10px;"></div>
			            </div>
			            <div class="col-md-5 float-md-right-text">
		                    <label class="switch switch-default switch-sm switch-primary-outline-alt">
		                        <input type="checkbox" class="switch-input" checked="">
		                        <span class="switch-label"></span>
		                        <span class="switch-handle"></span>
		                    </label>
		                    <span class="active-chern"><?=Yii::t('app', 'Active draft');?></span><i class="fa fa-question-circle"></i>
			            </div>
		            </div>
		        </div>
		        <div class="card-block">
					<?php// Pjax::begin(); ?>
					<?= Html::beginForm(['site/addads?'.$puth_form], 'post', ['data-pjax' => '', 'id' => 'top_dom', 'class' => 'form-horizontal']); ?>
		        	<?=$type_object_html?>
		        	<?=$type_rental_html?>
		        	<?=$type_property_html?>
		        	<?=$type_transaction_html?>
		        	<?=$object_html?>

		        	<? if (!empty($address)){ ?>
		                <div class="row">
							<input type="hidden" name="id_object" value="<?=$add_object?>">
		                    <div class="col-sm-12">
		                        <div class="card">
		                            <div class="card-header">
		                                <strong><?=Yii::t('app', 'Address');?></strong>
		                            </div>
		                            <div class="card-block">
		                                <div class="row">
		                                    <div class="col-sm-2">
		                                        <div class="">
		                                            <label for="address[country]"><?=Yii::t('app', 'Country')?></label>
		                                            <input type="text" class="form-control" id="address[country]" name="address[country]" placeholder="<?=Yii::t('app', 'Country')?>" value="Россия" required>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-2">
		                                        <div class="">
		                                            <label for="address[city]"><?=Yii::t('app', 'City')?></label>
		                                            <input type="text" class="form-control" id="address[city]" name="address[city]" placeholder="<?=Yii::t('app', 'City')?>" value="Москва" required>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-7">
		                                        <div class="">
		                                            <label for="address[street]"><?=Yii::t('app', 'Street')?></label>
		                                            <input type="text" class="form-control" id="address[street]" name="address[street]" placeholder="<?=Yii::t('app', 'Street')?>" required>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-1">
		                                        <div class="">
		                                            <label for="address[house]"><?=Yii::t('app', 'House')?></label>
		                                            <input type="text" class="form-control" id="address[house]" name="address[house]" placeholder="<?=Yii::t('app', 'House')?>" required>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>	

		                <div class="row">
		                    <div class="col-sm-12">
		                        <div class="card">
		                            <div class="card-header">
		                                <?=Yii::t('app', 'Metro');?>
		                            </div>
		                            <div class="card-block">
		                                <div class="row">
						                    <div class="col-lg-12">
				                                <table class="table">
				                                    <thead>
				                                        <tr>
				                                            <th><?=Yii::t('app', 'Nearest metro station');?></th>
				                                            <th><?=Yii::t('app', 'Minutes to Metro');?></th>
				                                            <th><?=Yii::t('app', 'Walking / transportation');?></th>
				                                            <th></th>
				                                            <th></th>
				                                        </tr>
				                                    </thead>
				                                    <tbody>
				                                        <tr>
				                                            <td>								                
															    <? $url = '/site/metrolist';
															        echo Select2::widget([
															        'name' => 'metro[name]',
															        'id' => 'metro',
															        'value' => '',
															        'maintainOrder' => true,
															        'toggleAllSettings' => [
															            'selectLabel' => false,
															            'unselectLabel' => false,
															            'selectOptions' => ['class' => 'text-success'],
															            'unselectOptions' => ['class' => 'text-danger'],
															        ],
															        'options' => ['placeholder' => Yii::t('app', 'Metro station')],
															        'pluginOptions' => [
															            'minimumInputLength' => 2,
															            'allowClear' => true,
															            'tags' => true,
															            'maximumInputLength' => false,
															            'language' => [
															                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
															            ],
															            'ajax' => [
															                'url' => $url,
															                'dataType' => 'json',
															                'data' => new JsExpression('function(params) { return {q:params.term}; }')
															            ],
															            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
															            'templateResult' => new JsExpression('function(domain) { return domain.text; }'),
															            'templateSelection' => new JsExpression('function (domain) { return domain.text; }'),
															        ]]); 
															    ?>
															</td>
				                                            <td>
				                                            	<input type="text" class="form-control" id="metro[minutes]" name="metro[minutes]" placeholder="<?=Yii::t('app', 'Minutes to Metro')?>" required>
				                                            </td>
				                                            <td>						                                        
						                                        <select class="form-control" id="metro[walk_transp]" name="metro[walk_transp]">
						                                            <option><?=Yii::t('app', 'Walking')?></option>
						                                            <option><?=Yii::t('app', 'Transportation')?></option>
						                                        </select>
						                                    </td>
				                                            <td>
					                                            <div class="main_metro_block">
																	<label class="switch switch-xs switch-3d switch-primary">
					                                                    <input type="checkbox" id="metro[main]" name="metro[main]" class="switch-input" checked="" required>
					                                                    <span class="switch-label"></span>
					                                                    <span class="switch-handle"></span>
					                                                </label>
					                                                <label for="main_metro" class="radio-object">Основная</label>
				                                                </div>
				                                            </td>
				                                            <td>
				                                                <i class="fa fa-remove fa-lg remove_metro"></i>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                                <button type="button" class="btn btn-outline-primary"><i class="fa fa-plus fa-lg"></i>&nbsp; <?=Yii::t('app','Add station')?></button>
						                    </div>
					                    </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-sm-12">
		                        <div class="card">
		                            <div class="card-header">
		                                <strong><?=Yii::t('app', 'About object');?></strong>
		                            </div>
		                            <div class="card-block">
		                                <div class="row">
						                    <div class="col-lg-12">
                	                            <div class="card-block">
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label" for="about[cadastral_number]"><?=Yii::t('app', 'Cadastral number');?></label>
				                                        <div class="col-md-5">
				                                            <input type="text" id="about[cadastral_number]" name="about[cadastral_number]" class="form-control" placeholder="<?=Yii::t('app', 'Cadastral number');?>" required>
				                                            <span class="help-block">Номер в формате 47:14:1203001:814.</span>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label" for="about[total_area]"><?=Yii::t('app', 'Total area');?>*</label>
				                                        <div class="col-md-4">
				                                            <input type="text" id="about[total_area]" name="about[total_area]" class="form-control" placeholder="<?=Yii::t('app', 'Total area');?>" required>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Number of rooms');?></label>
				                                        <div class="col-md-2">
					                                        <select class="form-control" id="about[number_floors]" name="about[number_floors]">
					                                        <? foreach ($number_floors as $key => $num): ?>
					                                            <option value="<?=$num?>"><?=Yii::t('app', $num);?></option>
					                                        <? endforeach; ?>
					                                        </select>
				                                        </div>
				                                        <div class="col-md-6">
					                                        <div class="col-md-6">
	                                                            <label class="switch switch-icon switch-text switch-primary-outline switch-sm">
								                                    <input type="checkbox" id="about[rooms_apartments]" name="about[rooms_apartments]" class="switch-input">
								                                    <span class="switch-label" data-on="" data-off=""></span>
								                                    <span class="switch-handle"></span>
								                                </label>
								                                <label for="about[rooms_apartments]" class="radio-object"><?=Yii::t('app', 'Apartments');?></label>
					                                        </div>
					                                        <div class="col-md-6">
	                                                            <label class="switch switch-icon switch-text switch-primary-outline switch-sm">
								                                    <input type="checkbox" id="about[rooms_penthouse]" name="about[rooms_penthouse]" class="switch-input">
								                                    <span class="switch-label" data-on="" data-off=""></span>
								                                    <span class="switch-handle"></span>
								                                </label>
								                                <label for="about[rooms_penthouse]" class="radio-object"><?=Yii::t('app', 'Penthouse');?></label>
					                                        </div>

				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label" for="about[number_floors]"><?=Yii::t('app', 'Floor');?></label>
				                                        <div class="col-md-2">
				                                            <input type="text" id="about[number_floors]" name="about[number_floors]" class="form-control" placeholder="<?=Yii::t('app', 'Floor');?>" required>
				                                        </div>
				                                        <div class="col-md-1 of_fllor"><?=Yii::t('app', 'of');?></div>
				                                        <div class="col-md-2">
				                                            <input type="text" id="about[floor]" name="about[floor]" class="form-control" placeholder="<?=Yii::t('app', 'All floor');?>" required>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label" for="about[rooms_area]"><?=Yii::t('app', 'Rooms area');?>*</label>
				                                        <div class="col-md-4">
				                                            <input type="text" id="about[rooms_area]" name="about[rooms_area]" class="form-control" placeholder="<?=Yii::t('app', 'Rooms area');?>" required>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label" for="about[living_space]"><?=Yii::t('app', 'Living space');?>*</label>
				                                        <div class="col-md-4">
				                                            <input type="text" id="about[living_space]" name="about[living_space]" class="form-control" placeholder="<?=Yii::t('app', 'Living space');?>" required>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label" for="about[kitchen]"><?=Yii::t('app', 'Kitchen');?></label>
				                                        <div class="col-md-4">
				                                            <input type="text" id="about[kitchen]" name="about[kitchen]" class="form-control" placeholder="<?=Yii::t('app', 'Kitchen');?>" required>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Loggia');?></label>
				                                        <div class="col-md-2">
					                                        <select class="form-control" id="about[loggia]" name="about[loggia]">
					                                        <? foreach ($loggia as $key => $num): ?>
					                                            <option value="<?=$num?>"><?=Yii::t('app', $num);?></option>
					                                        <? endforeach; ?>
					                                        </select>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Balcony');?></label>
				                                        <div class="col-md-2">
					                                        <select class="form-control" id="about[balcony]" name="about[balcony]">
					                                        <? foreach ($balcony as $key => $num): ?>
					                                            <option value="<?=$num?>"><?=Yii::t('app', $num);?></option>
					                                        <? endforeach; ?>
					                                        </select>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Window');?></label>
				                                        <div class="col-md-8">
					                                        <div class="col-md-5">
	                                                            <label class="switch switch-icon switch-text switch-primary-outline switch-sm">
								                                    <input type="checkbox" id="courtyard" name="about[courtyard]" class="switch-input">
								                                    <span class="switch-label" data-on="" data-off=""></span>
								                                    <span class="switch-handle"></span>
								                                </label>
								                                <label for="courtyard" class="radio-object"><?=Yii::t('app', 'Facing the courtyard');?></label>
					                                        </div>
					                                        <div class="col-md-5">
	                                                            <label class="switch switch-icon switch-text switch-primary-outline switch-sm">
								                                    <input type="checkbox" id="street" name="about[street]" class="switch-input">
								                                    <span class="switch-label" data-on="" data-off=""></span>
								                                    <span class="switch-handle"></span>
								                                </label>
								                                <label for="street" class="radio-object"><?=Yii::t('app', 'Facing the street');?></label>
					                                        </div>

				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Separate toilets');?></label>
				                                        <div class="col-md-2">
					                                        <select class="form-control" id="separate_toilets" name="about[separate_toilets]">
					                                        <? foreach ($separate_toilets as $key => $num): ?>
					                                            <option value="<?=$num?>"><?=Yii::t('app', $num);?></option>
					                                        <? endforeach; ?>
					                                        </select>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Combined bathroom');?></label>
				                                        <div class="col-md-2">
					                                        <select class="form-control" id="combined_bathroom" name="about[combined_bathroom]">
					                                        <? foreach ($combined_bathroom as $key => $num): ?>
					                                            <option value="<?=$num?>"><?=Yii::t('app', $num);?></option>
					                                        <? endforeach; ?>
					                                        </select>
				                                        </div>
				                                    </div>
				                                    <div class="form-group row">
				                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Repairs');?></label>
				                                        <div class="col-md-4">
					                                        <select class="form-control" id="repairs" name="about[repairs]">
					                                        <? foreach ($repairs as $key => $num): ?>
					                                            <option value="<?=$num?>"><?=Yii::t('app', $num);?></option>
					                                        <? endforeach; ?>
					                                        </select>
				                                        </div>
				                                    </div>
				                                    <div class="row type-ads">
														<div class="col-md-4">
															<div class="field_name"><?=Yii::t('app', 'In the apartment');?></div>
														</div>
														<div class="col-md-8">
															<div class="col-md-6">
																<div class="field_content">
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[mebel_v_komnatah]" id="furnished[mebel_v_komnatah]" value="mebel_v_komnatah">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[mebel_v_komnatah]" class="radio-object"><?=Yii::t('app', 'mebel_v_komnatah');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[mebel_na_kuhne]" id="furnished[mebel_na_kuhne]" value="mebel_na_kuhne">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[mebel_na_kuhne]" class="radio-object"><?=Yii::t('app', 'mebel_na_kuhne');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[holodilnik]" id="furnished[holodilnik]" value="holodilnik">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[holodilnik]" class="radio-object"><?=Yii::t('app', 'holodilnik');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[posudomoechnaya_mashina]" id="furnished[posudomoechnaya_mashina]" value="posudomoechnaya_mashina">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[posudomoechnaya_mashina]" class="radio-object"><?=Yii::t('app', 'posudomoechnaya_mashina');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[stiralnaya_mashina]" id="furnished[stiralnaya_mashina]" value="stiralnaya_mashina">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[stiralnaya_mashina]" class="radio-object"><?=Yii::t('app', 'stiralnaya_mashina');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[mozhno_s_detmi]" id="furnished[mozhno_s_detmi]" value="mozhno_s_detmi">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[mozhno_s_detmi]" class="radio-object"><?=Yii::t('app', 'mozhno_s_detmi');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[mozhno_s_zhivotnymi]" id="furnished[mozhno_s_zhivotnymi]" value="mozhno_s_zhivotnymi">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[mozhno_s_zhivotnymi]" class="radio-object"><?=Yii::t('app', 'mozhno_s_zhivotnymi');?></label>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="field_content">
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[internet]" id="furnished[internet]" value="internet">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[internet]"><?=Yii::t('app', 'internet');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[telefon]" id="furnished[telefon]" value="telefon">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[telefon]"><?=Yii::t('app', 'telefon');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[televizor]" id="furnished[televizor]" value="televizor">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[televizor]"><?=Yii::t('app', 'televizor');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[kondicioner]" id="furnished[kondicioner]" value="kondicioner">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[kondicioner]"><?=Yii::t('app', 'kondicioner');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[vanna]" id="furnished[vanna]" value="vanna">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[vanna]"><?=Yii::t('app', 'vanna');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[dushevaya_kabina]" id="furnished[dushevaya_kabina]" value="dushevaya_kabina">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[dushevaya_kabina]"><?=Yii::t('app', 'dushevaya_kabina');?></label>
																	</div>
																</div>
															</div>
														</div>
													</div>
			                                    </div>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>

		                <div class="row">
		                    <div class="col-sm-12">
		                        <div class="card">
		                            <div class="card-header">
		                                <strong><?=Yii::t('app', 'About the building');?></strong>
		                            </div>
		                            <div class="card-block">
		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="information_building[name]">
			                                        	<?=Yii::t('app', 'Name');?>
			                                        </label>
			                                        <div class="col-md-4">
			                                            <input type="text" id="information_building[name]" name="information_building[name]" class="form-control" placeholder="<?=Yii::t('app', 'Example: HC Scarlet Sails');?>">
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>					                    
		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="information_building[year_construction]">
			                                        	<?=Yii::t('app', 'Year construction');?>
			                                        </label>
			                                        <div class="col-md-4">
			                                            <input type="text" id="information_building[year_construction]" name="information_building[year_construction]" class="form-control" placeholder="<?=Yii::t('app', '1999');?>">
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>					                    
		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'The type and range of house');?></label>
			                                        <div class="col-md-3">
				                                        <select class="form-control" id="information_building_type">
				                                        <? foreach ($information_building_type as $key => $type): ?>
				                                            <option value="<?=$type?>"><?=Yii::t('app', $type);?></option>
				                                        <? endforeach; ?>
				                                        </select>
			                                        </div>
			                                        <div class="col-md-2">
			                                        	<input type="text" id="information_building[serial]" name="information_building[serial]" class="form-control" placeholder="<?=Yii::t('app', 'Serial');?>">
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>
		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="information_building[ceiling_height]">
			                                        	<?=Yii::t('app', 'Ceiling height');?>
			                                        </label>
			                                        <div class="col-md-4">
			                                            <input type="text" id="information_building[ceiling_height]" name="information_building[ceiling_height]" class="form-control" placeholder="<?=Yii::t('app', 'Ceiling height');?>" required>
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>
		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Passenger elevators');?></label>
			                                        <div class="col-md-3">
				                                        <select class="form-control" id="information_building[passenger_elevators]" name="information_building[passenger_elevators]">
				                                        <? foreach ($passenger_elevators as $key => $type): ?>
				                                            <option value="<?=$type?>"><?=Yii::t('app', $type);?></option>
				                                        <? endforeach; ?>
				                                        </select>
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>
		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Service lift');?></label>
			                                        <div class="col-md-3">
				                                        <select class="form-control" id="information_building[service_lift]" name="information_building[service_lift]">
				                                        <? foreach ($service_lift as $key => $type): ?>
				                                            <option value="<?=$type?>"><?=Yii::t('app', $type);?></option>
				                                        <? endforeach; ?>
				                                        </select>
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>
		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="information_building[garbage_chute]"><?=Yii::t('app', 'Indoors');?></label>
			                                        <div class="col-md-3">
														<div class="cui-switcher">
															<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																<input type="checkbox" class="switch-input" name="information_building[garbage_chute]" id="information_building[garbage_chute]">
																<span class="switch-label" data-on="" data-off=""></span>
																<span class="switch-handle"></span>
															</label>
					                                        <label for="information_building[garbage_chute]"><?=Yii::t('app', 'Garbage chute');?></label>
														</div>
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>
		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label"><?=Yii::t('app', 'Parking');?></label>
			                                        <div class="col-md-3">
				                                        <select class="form-control" id="information_building[parking]" name="information_building[parking]">
				                                        <? foreach ($parking as $key => $type): ?>
				                                            <option value="<?=$type?>"><?=Yii::t('app', $type);?></option>
				                                        <? endforeach; ?>
				                                        </select>
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>
					                    
					                </div>
					            </div>
					        </div>
					    </div>

		                <div class="row">
		                    <div class="col-sm-12">
		                        <div class="card">
		                            <div class="card-header">
		                                <strong><?=Yii::t('app', 'Photo');?></strong><br>
		                                <small><?=Yii::t('app', 'Not allowed to place pictures with water marks, foreign objects and banner ads. JPG, PNG or GIF. Maximum file size 10 MB')?></small>
		                            </div>
		                            <div class="card-block">
		                                <div class="row">
		                                	<div class="col-lg-12">
		                                	<?
		                                	$_FILES['file']['id'] = $add_object;
		                                	echo \kato\DropZone::widget([
											       'options' => [
											           'maxFilesize' => '10',
											           'acceptedFiles' => 'image/*',
											           'addRemoveLinks' => true,
											           'dictRemoveFile' => Yii::t('app', 'Remove file'),
											           'dictDefaultMessage' => Yii::t('app', 'Select the files on your computer'),
											           'dictInvalidFileType' => Yii::t('app', 'You cant upload files of this type')
											       ],
											       'clientEvents' => [
											           'complete' => "function(file){
												           	$.post('/site/addphoto', { id: $add_object, file_name: file.name} );
											           }",
											           'removedfile' => "function(file){
												           	$.post('/site/delphoto', { id: $add_object, file_name: file.name } );
												           	//alert(file.name + ' is removed')
											           }",
											           'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
											       ],
											   ]);
		                                	?>
	                                		</div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-sm-12">
		                        <div class="card">
		                            <div class="card-header">
		                                <strong><?=Yii::t('app', 'Description');?></strong>
		                            </div>
		                            <div class="card-block">
		                                <div class="row">
		                                	<div class="col-lg-12">
	                                            <textarea id="opisanie" name="opisanie" rows="9" class="form-control" placeholder="Content.."></textarea>
	                                		</div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-sm-12">
		                        <div class="card">
		                            <div class="card-header">
		                                <strong><?=Yii::t('app', 'The price and terms of the transaction');?></strong>
		                            </div>
		                            <div class="card-block">
		                                <div class="row">
		                                	<div class="col-lg-12">
     		                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="price_conditions[price_per_month]">
			                                        	<?=Yii::t('app', 'Price per month');?>
			                                        </label>
			                                        <div class="col-md-6">
				                                        <div class="col-md-6">
				                                            <input type="text" id="price_conditions[price_per_month]" name="price_conditions[price_per_month]" class="form-control" placeholder="<?=Yii::t('app', 'Price per month');?>" required>
				                                        </div>
				                                        <div class="col-md-6">
				                                            <div class="field_content">
				                                            <? //foreach ($currency as $key => $valute): ?>
																<!-- <div class="cui-switcher">
																	<label class="switch switch-xs switch-3d switch-primary">
																		<input type="radio" class="switch-input" onclick="this.form.submit();" name="object-type" id="object-type-apartment" value="apartment">
																		<span class="switch-label"></span>
																		<span class="switch-handle"></span>
																	</label>
																	<label for="object-type-apartment" class="radio-object">Квартира</label>
																</div> -->
				                                            <?// endforeach; ?>
															</div>
															<div class="cui-switcher">
																<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																	<input type="checkbox" class="switch-input" name="price_conditions[possible_bargain]" id="price_conditions[possible_bargain]">
																	<span class="switch-label" data-on="" data-off=""></span>
																	<span class="switch-handle"></span>
																</label>
						                                        <label for="price_conditions[possible_bargain]"><?=Yii::t('app', 'Possible bargain');?></label>
															</div>
														</div>
			                                        </div>
			                                    </div>   
	                                		</div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
					<? } ?>

		        	<button type="submit">Отправить</button>
					<?= Html::endForm() ?>
					<?php// Pjax::end(); ?>
		        </div> 
		        <div class="card-footer">
		        </div>
		    </div>
	    </div>
        <div class="col-md-2">
	    </div>
    </div>
</div>


