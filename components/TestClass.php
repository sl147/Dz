<?php
/**
 * 
 */
class Vehicle
{
	public $speed;
	public $colour;
	const  PARENT_CONSTANT;
	
	function __construct(argument)
	{
	
	}

	public function tripTime($distance) {
		$time = $distance / $this->speed;
		return $time;
	}
}

/**
 * 
 */
class Bicycle extends Vehicle {
	
	public $type;
	public $colour = "red";//перевизначення батьківських властивостей(свойств)
	const  CALORIES_PER_HOUR = 500;

	public function Calories_Burned ($distance) {
		$time = $this->tripTime($distance); // tripTime($distance) бере перевизначений метод зі свого класу
		$calories = $time * self::CALORIES_PER_HOUR;
		return $calories;
	}

	public function tripTime($distance) {  //перевизначення батьківського  класу tripTime($distance)
		$time = parent::tripTime($distance) * 1.2; // використовуєм такий же батьківський клас tripTime
		$time = ($distance / $this->speed) * 1.2;
		$parConst = parent::PARENT_CONSTANT;
		return $time;
	}	
}

/**
 * 
 */
class Car extends Vehicle
{
	
	public $fuel;
	public $colour = "white"; //перевизначення батьківських властивостей(свойств)
	public function fuelConsumption ($distance) {
		$result = ($this->fuel * $distance) / 100;
		return $result;
	}
}

$car1 = new Car;
$car1->speed = 110;
$car1->fuel  = 11;

$car2 = new Car;
$car2->speed = 120;
$car2->fuel  = 14;

$car2 = new Bicycle;
$car2->speed = 20;

$distance = 100;
echo "trip time: ".$car1->tripTime($distance);
echo "trip time: ".$car2->tripTime($distance);

echo "fuel: ".$car1->fuelConsumption($distance);
echo "fuel: ".$car2->fuelConsumption($distance);
?>