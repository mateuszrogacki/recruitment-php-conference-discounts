<?php
/**
 * Created by PhpStorm.
 * User: Mateuszek
 * Date: 19.02.2017
 * Time: 17:43
 */

namespace RstGroup\Recruitment\ConferenceSystem\Discount;


use RstGroup\Recruitment\ConferenceSystem\Conference\Conference;

class DiscountTypeCode extends AbstractDiscountType
{
    public function __construct($attendantsCount, $price, $discountCode)
    {
        parent::__construct($attendantsCount, $price, $discountCode);
    }

    public function calculate(Conference $conference)
    {
        if($conference->isCodeNotUsed($this->discountCode))
        {
            list($type, $discount) = $conference->getDiscountForCode($this->discountCode);

            if($type == 'percent')
            {
                $this->totalDiscount = $this->price * (float)"0.{$discount}";
            }
            else if($type == 'money')
            {
                $this->totalDiscount = $discount;
            }
            else
            {
                $this->setError('Error', 'Error message');
            }

            $conference->markCodeAsUsed($this->discountCode);
        }
    }
}