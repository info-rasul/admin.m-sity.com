<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\JsExpression;
use dosamigos\fileupload\FileUpload;

$this->title = 'Добавить объявление';
?>
<div class="container-fluid">
	<?= Html::beginForm(['/flatrent/'], 'post', ['data-pjax' => '', 'id' => 'flatrentform', 'class' => 'form-horizontal']); ?>
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
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-header">
	                                <strong><?=Yii::t('app', 'Address');?></strong>
	                            </div>
	                            <div class="card-block">
	                                <div class="row">
	                                    <div class="col-sm-12">
	                                        <div class="">
	                                            <input type="text" class="form-control" id="address" name="address[address]" placeholder="<?=Yii::t('app', 'Address')?>" required>
	                                            <input type="hidden" id="lat" name="address[lat]">
	                                            <input type="hidden" id="lng" name="address[lng]">
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-12">
								    		<div id="map"></div>
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
									    <? $data = array(1=>'Авиамоторная', 2=>'Автозаводская', 3=>'Академическая', 4=>'Александровский сад', 5=>'Алексеевская', 6=>'Алтуфьево', 7=>'Аннино', 8=>'Арбатская', 9=>'Аэропорт', 10=>'Бабушкинская', 11=>'Багратионовская', 12=>'Баррикадная', 13=>'Бауманская', 14=>'Беговая', 15=>'Белорусская', 16=>'Беляево', 17=>'Бибирево', 18=>'Библиотека им. Ленина', 19=>'Новоясеневская', 20=>'Боровицкая', 21=>'Ботанический сад', 22=>'Братиславская', 23=>'Бульвар Адмирала Ушакова', 24=>'Бульвар Дмитрия Донского', 25=>'Бунинская аллея', 26=>'Варшавская', 27=>'ВДНХ', 28=>'Владыкино', 29=>'Водный стадион', 30=>'Войковская', 31=>'Волгоградский проспект', 32=>'Волжская', 33=>'Воробьевы горы', 34=>'Выхино', 35=>'Выставочная', 36=>'Динамо', 37=>'Дмитровская', 38=>'Добрынинская', 39=>'Домодедовская', 40=>'Дубровка', 41=>'Измайловская', 42=>'Калужская', 43=>'Кантемировская', 44=>'Каховская', 45=>'Каширская', 46=>'Киевская', 47=>'Китай-город', 48=>'Кожуховская', 49=>'Коломенская', 50=>'Комсомольская', 51=>'Коньково', 52=>'Красногвардейская', 53=>'Красносельская', 54=>'Красные ворота', 55=>'Крестьянская застава', 56=>'Кропоткинская', 57=>'Крылатское', 58=>'Кузнецкий мост', 59=>'Кузьминки', 60=>'Кунцевская', 61=>'Курская', 62=>'Кутузовская', 63=>'Ленинский проспект', 64=>'Лубянка', 65=>'Люблино', 66=>'Марксистская', 67=>'Марьино', 68=>'Маяковская', 69=>'Медведково', 70=>'Международная', 71=>'Менделеевская', 72=>'Молодежная', 73=>'Нагатинская', 74=>'Нагорная', 75=>'Нахимовский проспект', 76=>'Новогиреево', 77=>'Новокузнецкая', 78=>'Новослободская', 79=>'Новые Черемушки', 80=>'Октябрьская', 81=>'Октябрьское поле', 82=>'Орехово', 83=>'Отрадное', 84=>'Охотный ряд', 85=>'Павелецкая', 86=>'Парк Культуры', 87=>'Парк Победы', 88=>'Партизанская', 89=>'Первомайская', 90=>'Перово', 91=>'Петровско-Разумовская', 92=>'Печатники', 93=>'Пионерская', 94=>'Планерная', 95=>'Площадь Ильича', 96=>'Площадь Революции', 97=>'Полежаевская', 98=>'Полянка', 99=>'Пражская', 100=>'Преображенская площадь', 101=>'Пролетарская', 102=>'Проспект Вернадского', 103=>'Проспект Мира', 104=>'Профсоюзная', 105=>'Пушкинская', 106=>'Речной вокзал', 107=>'Рижская', 108=>'Римская', 109=>'Рязанский проспект', 110=>'Савеловская', 111=>'Свиблово', 112=>'Севастопольская', 113=>'Семеновская', 114=>'Серпуховская', 115=>'Смоленская', 116=>'Сокол', 117=>'Сокольники', 118=>'Спортивная', 119=>'Сретенский бульвар', 120=>'Студенческая', 121=>'Сухаревская', 122=>'Сходненская', 123=>'Таганская', 124=>'Тверская', 125=>'Театральная', 126=>'Текстильщики', 127=>'Теплый Стан', 128=>'Тимирязевская', 129=>'Третьяковская', 130=>'Трубная', 131=>'Тульская', 132=>'Тургеневская', 133=>'Тушинская', 134=>'Улица 1905 года', 135=>'Улица Академика Янгеля', 136=>'Улица Горчакова', 137=>'Бульвар Рокоссовского', 138=>'Улица Скобелевская', 139=>'Улица Старокачаловская', 140=>'Университет', 141=>'Филевский парк', 142=>'Фили', 143=>'Фрунзенская', 144=>'Царицыно', 145=>'Цветной бульвар', 146=>'Черкизовская', 147=>'Чертановская', 148=>'Чеховская', 149=>'Чистые пруды', 150=>'Чкаловская', 151=>'Шаболовская', 152=>'Шоссе Энтузиастов', 153=>'Щелковская', 154=>'Щукинская', 155=>'Электрозаводская', 156=>'Юго-Западная', 157=>'Южная', 158=>'Ясенево', 159=>'Краснопресненская', 228=>'Строгино', 229=>'Славянский бульвар', 233=>'Мякинино', 234=>'Волоколамская', 235=>'Митино', 236=>'Марьина роща', 237=>'Достоевская', 238=>'Шипиловская', 239=>'Зябликово', 240=>'Борисово', 243=>'Новокосино', 244=>'Пятницкое шоссе', 245=>'Алма-Атинская', 270=>'Жулебино', 271=>'Лермонтовский проспект', 272=>'Деловой центр', 273=>'Лесопарковая', 274=>'Битцевский парк', 275=>'Спартак', 276=>'Улица Сергея Эйзенштейна', 277=>'Выставочный центр', 278=>'Улица Академика Королева', 279=>'Телецентр', 280=>'Улица Милашенкова', 281=>'Тропарево', 282=>'Котельники', 283=>'Технопарк', 284=>'Румянцево', 285=>'Саларьево', 286=>'Фонвизинская', 287=>'Бутырская', 289=>'Хорошёво', 290=>'Зорге', 291=>'Панфиловская', 292=>'Стрешнево', 293=>'Балтийская', 294=>'Коптево', 295=>'Лихоборы', 296=>'Окружная', 297=>'Ростокино', 298=>'Белокаменная', 299=>'Локомотив', 300=>'Измайлово', 301=>'Соколиная гора', 302=>'Андроновка', 303=>'Нижегородская', 304=>'Новохохловская', 305=>'Угрешская', 306=>'ЗИЛ', 307=>'Верхние котлы', 308=>'Крымская', 309=>'Площадь Гагарина', 310=>'Лужники', 311=>'Шелепиха', 312=>'Раменки'); ?>
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
																<? echo Select2::widget([
																    'name' => 'metro[0][name]',
															        'id' => 'metro',
																    'data' => $data,
																    'options' => [
																        'placeholder' => Yii::t('app', 'Metro station'),
																    ],
																]);	
															    ?>
															</td>
				                                            <td>
				                                            	<input type="text" class="form-control" id="metro[0][minutes]" name="metro[0][minutes]" placeholder="<?=Yii::t('app', 'Minutes to Metro')?>" required>
				                                            </td>
				                                            <td>						                                        
						                                        <select class="form-control" id="metro[0][walk_transp]" name="metro[0][walk_transp]">
						                                            <option value="walk"><?=Yii::t('app', 'Walking')?></option>
						                                            <option value="transport"><?=Yii::t('app', 'Transportation')?></option>
						                                        </select>
						                                    </td>
				                                            <td>
					                                            <div class="main_metro_block">
																	<label class="switch switch-xs switch-3d switch-primary">
					                                                    <input type="checkbox" id="metro[0][main]" name="metro[0][main]" class="switch-input" checked="">
					                                                    <span class="switch-label"></span>
					                                                    <span class="switch-handle"></span>
					                                                </label>
					                                                <label for="metro[0][main]" class="radio-object">Основная</label>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                        <tr>
				                                            <td>								                
																<? echo Select2::widget([
																    'name' => 'metro[1][name]',
															        'id' => 'metro_1',
																    'data' => $data,
																    'options' => [
																        'placeholder' => Yii::t('app', 'Metro station'),
																    ],
																]);	
															    ?>
															</td>
				                                            <td>
				                                            	<input type="text" class="form-control" id="metro[1][minutes]" name="metro[1][minutes]" placeholder="<?=Yii::t('app', 'Minutes to Metro')?>">
				                                            </td>
				                                            <td>						                                        
						                                        <select class="form-control" id="metro[1][walk_transp]" name="metro[1][walk_transp]">
						                                            <option value="walk"><?=Yii::t('app', 'Walking')?></option>
						                                            <option value="transport"><?=Yii::t('app', 'Transportation')?></option>
						                                        </select>
						                                    </td>
				                                            <td>
					                                            <div class="main_metro_block">
																	<label class="switch switch-xs switch-3d switch-primary">
					                                                    <input type="checkbox" id="metro[1][main]" name="metro[1][main]" class="switch-input">
					                                                    <span class="switch-label"></span>
					                                                    <span class="switch-handle"></span>
					                                                </label>
					                                                <label for="metro[1][main]" class="radio-object">Основная</label>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                        <tr>
				                                            <td>								                
																<? echo Select2::widget([
																    'name' => 'metro[2][name]',
															        'id' => 'metro_2',
																    'data' => $data,
																    'options' => [
																        'placeholder' => Yii::t('app', 'Metro station'),
																    ],
																]);	
															    ?>
															</td>
				                                            <td>
				                                            	<input type="text" class="form-control" id="metro[2][minutes]" name="metro[2][minutes]" placeholder="<?=Yii::t('app', 'Minutes to Metro')?>">
				                                            </td>
				                                            <td>						                                        
						                                        <select class="form-control" id="metro[2][walk_transp]" name="metro[2][walk_transp]">
							                                        <option value="walk"><?=Yii::t('app', 'Walking')?></option>
						                                            <option value="transport"><?=Yii::t('app', 'Transportation')?></option>
						                                        </select>
						                                    </td>
				                                            <td>
					                                            <div class="main_metro_block">
																	<label class="switch switch-xs switch-3d switch-primary">
					                                                    <input type="checkbox" id="metro[2][main]" name="metro[2][main]" class="switch-input">
					                                                    <span class="switch-label"></span>
					                                                    <span class="switch-handle"></span>
					                                                </label>
					                                                <label for="main_metro" class="radio-object">Основная</label>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
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
					                                        <select class="form-control" id="about[number_rooms]" name="about[number_rooms]">
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
																			<input type="checkbox" class="switch-input" name="furnished[mebel_v_komnatah]" id="furnished[mebel_v_komnatah]">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[mebel_v_komnatah]" class="radio-object"><?=Yii::t('app', 'mebel_v_komnatah');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[mebel_na_kuhne]" id="furnished[mebel_na_kuhne]">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[mebel_na_kuhne]" class="radio-object"><?=Yii::t('app', 'mebel_na_kuhne');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[holodilnik]" id="furnished[holodilnik]">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[holodilnik]" class="radio-object"><?=Yii::t('app', 'holodilnik');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[posudomoechnaya_mashina]" id="furnished[posudomoechnaya_mashina]">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[posudomoechnaya_mashina]" class="radio-object"><?=Yii::t('app', 'posudomoechnaya_mashina');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[stiralnaya_mashina]" id="furnished[stiralnaya_mashina]">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[stiralnaya_mashina]" class="radio-object"><?=Yii::t('app', 'stiralnaya_mashina');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[mozhno_s_detmi]" id="furnished[mozhno_s_detmi]">
																			<span class="switch-label" data-on="" data-off=""></span>
																			<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[mozhno_s_detmi]" class="radio-object"><?=Yii::t('app', 'mozhno_s_detmi');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																			<input type="checkbox" class="switch-input" name="furnished[mozhno_s_zhivotnymi]" id="furnished[mozhno_s_zhivotnymi]">
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
																		<input type="checkbox" class="switch-input" name="furnished[internet]" id="furnished[internet]">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[internet]"><?=Yii::t('app', 'internet');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[telefon]" id="furnished[telefon]">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[telefon]"><?=Yii::t('app', 'telefon');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[televizor]" id="furnished[televizor]">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[televizor]"><?=Yii::t('app', 'televizor');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[kondicioner]" id="furnished[kondicioner]">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[kondicioner]"><?=Yii::t('app', 'kondicioner');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[vanna]" id="furnished[vanna]">
																		<span class="switch-label" data-on="" data-off=""></span>
																		<span class="switch-handle"></span>
																		</label>
																		<label for="furnished[vanna]"><?=Yii::t('app', 'vanna');?></label>
																	</div>
																	<div class="cui-switcher">
																		<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																		<input type="checkbox" class="switch-input" name="furnished[dushevaya_kabina]" id="furnished[dushevaya_kabina]">
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
				                                        <select class="form-control" name="information_building[type]" id="information_building_type">
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
		                                	$add_object = !empty($add_object) ? $add_object : 0;
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
												           	$.post('/flatrent/addphoto', { id: $add_object, file_name: file.name} );
											           }",
											           'removedfile' => "function(file){
												           	$.post('/flatrent/delphoto', { id: $add_object, file_name: file.name } );
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
			                                        <div class="col-md-3">
			                                            <input type="text" id="price_conditions[price_per_month]" name="price_conditions[price_per_month]" class="form-control" placeholder="<?=Yii::t('app', 'Price per month');?>" required>
			                                        </div>
			                                        <div class="col-md-1">
				                                        <select class="form-control" id="price_conditions[currency]" name="price_conditions[currency]">
					                                        <? foreach ($currency as $key => $type): ?>
					                                            <option value="<?=$type?>"><?=Yii::t('app', $type);?></option>
					                                        <? endforeach; ?>
				                                        </select>
								                    </div>
			                                        <div class="col-md-3">
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
		                                
		                                <div class="row" style="margin-bottom: 20px;">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="price_conditions[bargainprice]">
			                                        	<?=Yii::t('app', 'Price including bargaining');?>
			                                        </label>
			                                        <div class="col-md-4">
			                                            <input type="text" id="price_conditions[bargainprice]" name="price_conditions[bargainprice]" class="form-control" placeholder="<?=Yii::t('app', 'Price including bargaining');?>">
			                                        </div>
			                                    </div>
						                    </div>

	            		                    <div class="col-sm-12">
				                                <div class="row">
				                                	<div class="col-lg-12">
			                                            <textarea id="price_conditions[trading]" name="price_conditions[trading]" rows="5" class="form-control" placeholder="<?=Yii::t('app', 'Trading is subject to');?>"></textarea>
			                                		</div>
				                                </div>
						                    </div> 
					                    </div>	

		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="price_conditions[includedinprice]">
			                                        	<?=Yii::t('app', 'Communal payments');?>
			                                        </label>
			                                        <div class="col-md-4">
				                                        <select class="form-control" id="price_conditions[includedinprice]" name="price_conditions[includedinprice]">
				                                            <option value="1"><?=Yii::t('app', 'On_included');?></option>
				                                            <!-- <option value="0"><?=Yii::t('app', 'Off_included');?></option> -->
				                                        </select>
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>	

		                                <div class="row">
						                    <div class="col-lg-12">
			                                    <div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="price_conditions[leasetermtype]">
			                                        	<?=Yii::t('app', 'Lease');?>
			                                        </label>
			                                        <div class="col-md-4">
				                                        <select class="form-control" id="price_conditions[leasetermtype]" name="price_conditions[leasetermtype]">
					                                        <? foreach ($lease as $key => $type): ?>
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
			                                        <label class="col-md-4 form-control-label" for="price_conditions[prepay]">
			                                        	<?=Yii::t('app', 'Prepayment');?>
			                                        </label>
			                                        <div class="col-md-4">
				                                        <select class="form-control" id="price_conditions[prepay]" name="price_conditions[prepay]">
					                                        <? foreach ($prepay as $key => $type): ?>
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
			                                        <label class="col-md-4 form-control-label" for="price_conditions[deposit]">
			                                        	<?=Yii::t('app', 'Deposit owner');?>
			                                        </label>
			                                        <div class="col-md-4">
			                                            <input type="text" id="price_conditions[deposit]" name="price_conditions[deposit]" class="form-control" placeholder="<?=Yii::t('app', 'Deposit owner');?>">
			                                        </div>
			                                    </div>
						                    </div>
					                    </div>

		                                <div class="row">
						                    <div class="col-lg-12">			                                    
		                                	<p style="font-style: italic;">Какой процент стоимости аренды вы хотите получить</p>
						                    	<div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="price_conditions[direct_client]">
			                                        	<?=Yii::t('app', 'From direct client');?>
			                                        </label>
			                                        <div class="col-md-2">
			                                            <input type="text" id="price_conditions[direct_client]" name="price_conditions[direct_client]" class="form-control">
			                                        </div>
			                                        <div class="col-md-1">%</div>
			                                        <div class="col-md-2">
														<div class="cui-switcher">
															<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																<input type="checkbox" class="switch-input" name="price_conditions[no_direct_client]" id="price_conditions[no_direct_client]">
																<span class="switch-label" data-on="" data-off=""></span>
																<span class="switch-handle"></span>
															</label>
					                                        <label for="price_conditions[no_direct_client]"><?=Yii::t('app', 'No commission');?></label>
														</div>
													</div>
			                                    </div>

						                    	<div class="form-group row">
			                                        <label class="col-md-4 form-control-label" for="price_conditions[another_agent]">
			                                        	<?=Yii::t('app', 'From another agent');?>
			                                        </label>
			                                        <div class="col-md-2">
			                                            <input type="text" id="price_conditions[another_agent]" name="price_conditions[another_agent]" class="form-control">
			                                        </div>
			                                        <div class="col-md-1">%</div>
			                                        <div class="col-md-2">
														<div class="cui-switcher">
															<label class="switch switch-icon switch-text switch-primary-outline switch-sm">
																<input type="checkbox" class="switch-input" name="price_conditions[no_another_agent]" id="price_conditions[no_another_agent]">
																<span class="switch-label" data-on="" data-off=""></span>
																<span class="switch-handle"></span>
															</label>
					                                        <label for="price_conditions[no_another_agent]"><?=Yii::t('app', 'No commission');?></label>
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
		                                <strong><?=Yii::t('app', 'Contacts');?></strong>
		                            </div>
		                            <div class="card-block">
	                                    <div class="col-md-12" style="margin-bottom:20px;">
		                                    <div class="col-md-4">
		                                        <input type="text" id="phone_1" name="contacts[0][phone]" class="form-control"  placeholder="+7 (999) 999-99-99">
		                                    </div>
	                                    </div>
	                                    <div class="col-md-12">
		                                    <div class="col-md-4">
		                                        <input type="text" id="phone_2" name="contacts[1][phone]" class="form-control" placeholder="+7 (999) 999-99-99">
		                                    </div>
	                                    </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
	                </div>
		        </div>
	        </div>
			<button type="submit">Сохранить</button>
        </div>
    </div>
	<?= Html::endForm() ?>
</div>


