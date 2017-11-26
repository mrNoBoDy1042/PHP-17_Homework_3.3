<?php

/*************
 * Cупер класс Вещь
 * От него наследуются все классы
 ************/
class Thing
{
    protected $weight;
    protected $colour;
    protected $height;
    protected $width;
    protected $length;

    function __construct($weight, $colour, $height, $width, $length)
    {
        $this->weight = $weight;
        $this->colour = $colour;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }
}

/***********
 * Интерфейс для класса Машина
 ***********/
interface CarFuncs
{
  const Max_passangers = 4;
  const Max_speed = 250;

  public function setOwner($owner);

  public function setYear($year);

  public function StartEngine();

  public function StopEngine();

  public function Accelerate();

  public function SlowDown();

  public function GetPassanger($new_passanger);
}


/************
 * Класс Машина
 *      Описывается определенная модель определенной марки,
 * например Aston Martin Rapide S
 * Свойства:
 *      1) Текущая скорость
 *      2) Текущее положение в пространстве
 *      3) Статус двигателя (заведен \ заглушен)
 *
 *      Обязательные:
 *      4) Владелец
 *      5) Цвет
 *      6) Год выпуска конкретного автомобиля
 * Константы:
 *      1) Максимальная скорость
 *      2) Количество пассажиров
 * Методы:
 *      1) Завести двигатель
 *      2) Заглушить двигатель
 *      3) Нажать педаль газа
 *      4) Нажать педаль тормоза
 *      5) Продать машину (сменить владельца)
 ************/
class Car extends Thing implements CarFuncs
{
    private $current_speed = 0;
    private $current_position = array('x' => 0, 'y' => 0);
    private $engine_started = false;
    private $passangers = array();
    private $owner;
    private $year;

    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    public function setYear($year)
    {
        $this->year = date("Y");
        return $this;
    }

    public function StartEngine()
    {
        $this->engine_started = true;
        echo "Двигатель завелся<br>";
    }

    public function StopEngine()
    {
        $this->engine_started = false;
        echo "Двигатель заглушен<br>";
    }

    public function Accelerate()
    {
        if ($this->engine_started && $this->current_speed < self::Max_speed) {
            $this->current_speed += 10;
            $this->current_position['x'] += 10;
            $this->current_position['y'] += 5;
        } elseif ($this->current_speed === self::Max_speed) {
            echo "Нельзя ехать еще быстрее. Это максимальная скорость.<br>";
        } else {
            echo "Сначала нужно завести машину.<br>";
        }
    }

    public function SlowDown()
    {
        if ($this->engine_started && $this->current_speed > 0) {
            $this->current_speed -= 10;
            $this->current_position['x'] -= 10;
            $this->current_position['y'] -= 5;
        } else {
            echo "Ничего не произошло. Машина и так никуда не двигалась.<br>";
        }
    }

    public function SellCar($new_owner)
    {
        $this->owner = $new_owner;
        echo "Новый владелец - " . $new_owner . "<br>";
    }

    public function GetPassanger($new_passanger)
    {
        if (count($this->passangers) < self::Max_passangers) {
            $this->passangers[] = $new_passanger;
        } else {
            echo "Свободных мест нет<br>";
        }
    }
}

echo "Автомобили:<br>";

$first_aston = new Car(2500, 'black', 2, 2, 4);
$first_aston->setOwner('Михаил')
    ->setYear(1990);

$first_aston->StartEngine();
$first_aston->Accelerate();
$first_aston->SellCar('Андрей');

$second_aston = new Car(2000, 'white', 2, 2, 3.5);
$second_aston->setOwner('Игорь')
    ->setYear(2012);

$second_aston->StopEngine();

echo "--------------------<br>";

/*********
 * Интерфейс для класса Телевизор
 *********/
interface TVFuncs
{
  const max_volume = 100;

  public function setScreenSize($screen_size);

  public function setResolution($resolution);

  public function setYear($year);

  public function TurnOn();

  public function TurnOff();

  public function NextChannel();

  public function PreviousCannel();

  public function VolumeUp();

  public function VolumeDown();

  public function GetNewChannels();
}

/************
 * Класс Телевизор
 * Свойства:
 *      1) Количество каналов
 *      2) Текущий канал
 *      3) Текущая громкость
 *      4) Текущее состояние (вкл \ выкл)
 *
 *      Обязательные:
 *      5) Диагональ
 *      6) Разрешение
 *      7) Год выпуска
 * Константа:
 *      - Максимальная громкость
 * Методы:
 *      1) Включить телевизор
 *      2) Выключить телевизор
 *      3) Переключить канал на следующий
 *      4) Переключить канал на предыдущий
 *      5) Прибавить громкость
 *      6) Убавить громкость
 *      7) Обновить список каналов
 ************/
class TV extends Thing implements TVFuncs
{
    private $count_channels = 10;
    private $current_channel = 1;
    private $turned_on = false;
    private $current_volume = 5;
    protected $screen_size;
    protected $resolution;
    protected $year;

    public function setScreenSize($screen_size)
    {
        $this->screen_size = $screen_size;
        return $this;
    }

    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
        return $this;
    }


    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function TurnOn()
    {
        $this->turned_on = true;
        echo "TV включен<br>";
    }

    public function TurnOff()
    {
        $this->turned_on = false;
        echo "TV выключен<br>";
    }

    public function NextChannel()
    {
        if ($this->turned_on && $this->current_channel < $this->count_channels) {
            $this->current_channel += 1;
        } elseif ($this->current_channel === $this->count_channels) {
            $this->current_channel = 1;
        } else {
            echo "Сначала нужно включить телевизор.<br>";
            //break;
        }
        echo "Текущий канал - " . $this->current_channel . "<br>";
    }

    public function PreviousCannel()
    {
        if ($this->turned_on && $this->current_channel > 1) {
            $this->current_channel -= 1;
        } elseif ($this->current_channel === 1) {
            $this->current_channel = $this->count_channels;
        } else {
            echo "Сначала нужно включить телевизор.<br>";
            //break;
        }
        echo "Текущий канал - " . $this->current_channel . "<br>";
    }

    public function VolumeUp()
    {
        if ($this->turned_on && $this->current_volume < self::max_volume) {
            $this->current_volume += 1;
            echo "Текущая громкость - " . $this->current_volume . "<br>";
        } elseif ($this->current_volume === self::max_volume) {
            echo "Максимальная громкость.<br>";
        } else {
            echo "Сначала нужно включить телевизор.<br>";
        }
    }

    public function VolumeDown()
    {
        if ($this->turned_on && $this->current_volume > 0) {
            $this->current_volume -= 1;
            echo "Текущая громкость - " . $this->current_volume . "<br>";
        } elseif ($this->current_volume === 0) {
            echo "Звук выключен.<br>";
        } else {
            echo "Сначала нужно включить телевизор.<br>";
        }
    }

    public function GetNewChannels()
    {
        $this->count_channels += rand(0, 10);
        echo "Всего каналов - " . $this->count_channels . "<br>";
    }
}

echo "Телевизоры:<br>";
$TV_one = new TV(20, 'black', 2, 4, 0.2);
$TV_one->setYear(2017)->setResolution("UHD")->setScreenSize(40);
$TV_two = new TV(10, 'white', 1, 2, 0.4);
$TV_two->setYear(2016)->setResolution("HD")->setScreenSize(20);

$TV_one->TurnOn();
$TV_one->GetNewChannels();
$TV_one->VolumeUp();

echo "--------------------<br>";

/**
 * Интерфейс для класса ручка
 */
interface PenFuncs
{
  public function Write($text);

  public function FillInk();
}


/************
 * Класс Шариковая ручка
 * Свойства:
 *      1) Количество оставшихся чернил (в %)
 *      Обязательные:
 *      2) Цвет чернил
 * Методы:
 *      1) Написать что-то
 *      2) Заменить стержень
 ************/
class Pen extends Thing implements PenFuncs
{
    private $ink_left=100;

    public function Write($text)
    {
        $ink_needed = round(strlen($text) / 10);
        if ($ink_needed <= $this->ink_left) {
            echo "<font color=\"" . $this->colour . "\">$text</font><br>";
            $this->ink_left -= $ink_needed;
        } else {
            echo "Чернил больше нет. Необходимо заменить стержень.<br>";
        }
    }

    public function FillInk()
    {
        $this->ink_left = 100;
    }
}

echo "Ручки:<br>";
$pen_one = new  Pen(0.005, 'blue', 0.15, 0.02, 0.02);
$pen_two = new  Pen(0.002, 'black', 0.10, 0.03, 0.03);
$pen_one->Write('Hello world');

echo "--------------------<br>";

/**
 * Интерфейс для класса Утка
 */
interface DuckFuncs
{
  public function setPosition();

  public function setAge($age);

  public function Eat();
}

/************
 * Класс Утка
 * Свойства:
 *      1) Голод (в %, где 100 - утка умирает с голоду, а 0 - полностью сытая утка)
 *      2) Текущее положение в 3-х мерном пространстве
 *      3) Возраст
 * Методы:
 *      1) Переместиться в новое место
 *      2) Поесть
 *      3) Крякнуть
 * Внутренний метод:
 *      1) Сгенерировать рандомную координату
 ************/
class Duck extends Thing implements DuckFuncs
{
    private $hunger = 0;
    protected $position = array(
        'x' => 0,
        'y' => 0,
        'z' => 0);
    protected $age;

    private function GetRandCoord()
    {
        $destination = (rand(0, 1) == 0) ? 1 : -1;
        return $destination * rand(0, 200);
    }

    private function RandTravel()
    {
        $this->position['x'] = $this->GetRandCoord();
        $this->position['y'] = $this->GetRandCoord();
        $this->position['z'] = abs($this->GetRandCoord());// так как утка не может уйти под землю
        var_dump($this->position);
        echo "<br>";
        $this->hunger += rand(5, 15);
    }

    public function setPosition()
    {
        $this->RandTravel();
        return $this;
    }

    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    public function Quack()
    {
        echo "Кря-кря-кря<br>";
    }

    public function Eat()
    {
        $food = rand(0, 35);
        if ($this->hunger > $food) {
            $this->hunger -= $food;
        } else {
            $this->hunger = 0;
        }
        echo 'Голод утки - ' . $this->hunger;
    }
}

echo "Утки:<br>";
echo "Перемещения первой утки:<br>";
$first_duck = new Duck(25, 'Brown', 0.5, 0.5, 0.5);
$first_duck->setAge(10)->setPosition();

echo "Перемещения второй утки:<br>";
$second_duck = new Duck(15, 'Brown', 0.5, 0.5, 0.5);
$second_duck->setAge(5)->setPosition();
$second_duck->Quack();

echo "--------------------<br>";

/**
 * Интерфейс для класса Продукт
 */
interface ProduckFuncs
{
  public function setName($name);

  public function setPrice($price);

  public function setCategory($category);

  public function setDiscount($discount);

  public function getPrice();
}


/************
 * Класс Товар
 * Свойства:
 *      1) Скидка
 *      Обязательные:
 *      2) ID товара
 *      3) Наименование
 *      4) Стоимость
 *      5) Категория
 * Методы:
 *      1) Получить стоимость
 *      2) Получить стоимость с учетом скидки
 ************/
class Product extends Thing implements ProduckFuncs
{
    public $name;
    public $price;
    public $category;
    public $discount;

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }

    public function getPrice()
    {
        echo "Стоимость $this->name = $this->price<br>";
    }

    public function getDiscountPrice()
    {
        echo "Стоимость $this->name со скидкой = " . ($this->price - ($this->price * $this->discount / 100)) . "<br>";
    }
}

echo "Товары:<br>";
$first_product = new Product(0.2, 'Black', 0.15, 0.10, 0.08);
$first_product->setCategory('Phone')->setDiscount(0)->setName('Iphone')->setPrice(65000);
$first_product->GetPrice();
$first_product->GetDiscountPrice();
