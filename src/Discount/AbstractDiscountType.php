<?php
/**
 * Created by PhpStorm.
 * User: Mateuszek
 * Date: 19.02.2017
 * Time: 17:15
 */

namespace RstGroup\Recruitment\ConferenceSystem\Discount;


use RstGroup\Recruitment\ConferenceSystem\Conference\Conference;

abstract class AbstractDiscountType
{
    protected $attendantsCount = null;
    protected $price = null;
    protected $discountCode = null;
    protected $totalDiscount = 0;
    protected $errors = array();

    abstract public function calculate(Conference $conference);

    public function __construct($attendantsCount, $price, $discountCode)
    {
        $this->attendantsCount = $attendantsCount;
        $this->price = $price;
        $this->$discountCode = $discountCode;
    }

    public function isError()
    {
        if(!empty($this->errors))
        {
            return $this->errors;
        }

        return false;
    }

    public function getError($id)
    {
        return $this->errors[$id];
    }

    public function getTotalDiscount()
    {
        return $this->totalDiscount;
    }

    protected function setError($id, $message)
    {
        $this->errors[$id] = $message;
    }
}