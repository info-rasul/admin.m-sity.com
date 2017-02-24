ymaps.ready(init);

function init() {
	var data = {1:'Авиамоторная', 2:'Автозаводская', 3:'Академическая', 4:'Александровский сад', 5:'Алексеевская', 6:'Алтуфьево', 7:'Аннино', 8:'Арбатская', 9:'Аэропорт', 10:'Бабушкинская', 11:'Багратионовская', 12:'Баррикадная', 13:'Бауманская', 14:'Беговая', 15:'Белорусская', 16:'Беляево', 17:'Бибирево', 18:'Библиотека им. Ленина', 19:'Новоясеневская', 20:'Боровицкая', 21:'Ботанический сад', 22:'Братиславская', 23:'Бульвар Адмирала Ушакова', 24:'Бульвар Дмитрия Донского', 25:'Бунинская аллея', 26:'Варшавская', 27:'ВДНХ', 28:'Владыкино', 29:'Водный стадион', 30:'Войковская', 31:'Волгоградский проспект', 32:'Волжская', 33:'Воробьевы горы', 34:'Выхино', 35:'Выставочная', 36:'Динамо', 37:'Дмитровская', 38:'Добрынинская', 39:'Домодедовская', 40:'Дубровка', 41:'Измайловская', 42:'Калужская', 43:'Кантемировская', 44:'Каховская', 45:'Каширская', 46:'Киевская', 47:'Китай-город', 48:'Кожуховская', 49:'Коломенская', 50:'Комсомольская', 51:'Коньково', 52:'Красногвардейская', 53:'Красносельская', 54:'Красные ворота', 55:'Крестьянская застава', 56:'Кропоткинская', 57:'Крылатское', 58:'Кузнецкий мост', 59:'Кузьминки', 60:'Кунцевская', 61:'Курская', 62:'Кутузовская', 63:'Ленинский проспект', 64:'Лубянка', 65:'Люблино', 66:'Марксистская', 67:'Марьино', 68:'Маяковская', 69:'Медведково', 70:'Международная', 71:'Менделеевская', 72:'Молодежная', 73:'Нагатинская', 74:'Нагорная', 75:'Нахимовский проспект', 76:'Новогиреево', 77:'Новокузнецкая', 78:'Новослободская', 79:'Новые Черемушки', 80:'Октябрьская', 81:'Октябрьское поле', 82:'Орехово', 83:'Отрадное', 84:'Охотный ряд', 85:'Павелецкая', 86:'Парк Культуры', 87:'Парк Победы', 88:'Партизанская', 89:'Первомайская', 90:'Перово', 91:'Петровско-Разумовская', 92:'Печатники', 93:'Пионерская', 94:'Планерная', 95:'Площадь Ильича', 96:'Площадь Революции', 97:'Полежаевская', 98:'Полянка', 99:'Пражская', 100:'Преображенская площадь', 101:'Пролетарская', 102:'Проспект Вернадского', 103:'Проспект Мира', 104:'Профсоюзная', 105:'Пушкинская', 106:'Речной вокзал', 107:'Рижская', 108:'Римская', 109:'Рязанский проспект', 110:'Савеловская', 111:'Свиблово', 112:'Севастопольская', 113:'Семеновская', 114:'Серпуховская', 115:'Смоленская', 116:'Сокол', 117:'Сокольники', 118:'Спортивная', 119:'Сретенский бульвар', 120:'Студенческая', 121:'Сухаревская', 122:'Сходненская', 123:'Таганская', 124:'Тверская', 125:'Театральная', 126:'Текстильщики', 127:'Теплый Стан', 128:'Тимирязевская', 129:'Третьяковская', 130:'Трубная', 131:'Тульская', 132:'Тургеневская', 133:'Тушинская', 134:'Улица 1905 года', 135:'Улица Академика Янгеля', 136:'Улица Горчакова', 137:'Бульвар Рокоссовского', 138:'Улица Скобелевская', 139:'Улица Старокачаловская', 140:'Университет', 141:'Филевский парк', 142:'Фили', 143:'Фрунзенская', 144:'Царицыно', 145:'Цветной бульвар', 146:'Черкизовская', 147:'Чертановская', 148:'Чеховская', 149:'Чистые пруды', 150:'Чкаловская', 151:'Шаболовская', 152:'Шоссе Энтузиастов', 153:'Щелковская', 154:'Щукинская', 155:'Электрозаводская', 156:'Юго-Западная', 157:'Южная', 158:'Ясенево', 159:'Краснопресненская', 228:'Строгино', 229:'Славянский бульвар', 233:'Мякинино', 234:'Волоколамская', 235:'Митино', 236:'Марьина роща', 237:'Достоевская', 238:'Шипиловская', 239:'Зябликово', 240:'Борисово', 243:'Новокосино', 244:'Пятницкое шоссе', 245:'Алма-Атинская', 270:'Жулебино', 271:'Лермонтовский проспект', 272:'Деловой центр', 273:'Лесопарковая', 274:'Битцевский парк', 275:'Спартак', 276:'Улица Сергея Эйзенштейна', 277:'Выставочный центр', 278:'Улица Академика Королева', 279:'Телецентр', 280:'Улица Милашенкова', 281:'Тропарево', 282:'Котельники', 283:'Технопарк', 284:'Румянцево', 285:'Саларьево', 286:'Фонвизинская', 287:'Бутырская', 289:'Хорошёво', 290:'Зорге', 291:'Панфиловская', 292:'Стрешнево', 293:'Балтийская', 294:'Коптево', 295:'Лихоборы', 296:'Окружная', 297:'Ростокино', 298:'Белокаменная', 299:'Локомотив', 300:'Измайлово', 301:'Соколиная гора', 302:'Андроновка', 303:'Нижегородская', 304:'Новохохловская', 305:'Угрешская', 306:'ЗИЛ', 307:'Верхние котлы', 308:'Крымская', 309:'Площадь Гагарина', 310:'Лужники', 311:'Шелепиха', 312:'Раменки'};
    var myPlacemark,
        myMap = new ymaps.Map('map', {
            center: [55.753994, 37.622093],
            zoom: 9
        }, {
            searchControlProvider: 'yandex#search'
        });

    // Слушаем клик на карте.
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');

        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getMetro(coords);
        getAddress(coords);
    });

    // Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            preset: 'islands#violetDotIconWithCaption',
            draggable: true
        });
    }

    // Определяем адрес по координатам (обратное геокодирование).
    function getMetro(coords) {
        ymaps.geocode(coords, {kind: 'metro'}).then( function (res) {
                var street = res.geoObjects.get(0);
                var name = street.properties.get('name');
                name_arr = name.split(' '); name_arr.shift();
                metro = name_arr.join(' ');
                for(key in data) {
				  if(data[key] == metro){
	                $('#metro option[value='+key+']').attr('selected','selected').change();
				  }
				}
            }
        );
    }

    function getAddress(coords) {
    	$('#lat').val(coords[0]);
		$('#lng').val(coords[1]);
        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            $('#address').val(firstGeoObject.properties.get('text'));
            myPlacemark.properties
                .set({
                    iconCaption: firstGeoObject.properties.get('name'),
                    balloonContent: firstGeoObject.properties.get('text')
                });

        });
    }
}