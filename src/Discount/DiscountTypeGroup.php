<?php
/**
 * Created by PhpStorm.
 * User: Mateuszek
 * Date: 19.02.2017
 * Time: 17:42
 */

namespace RstGroup\Recruitment\ConferenceSystem\Discount;


use RstGroup\Recruitment\ConferenceSystem\Conference\Conference;

class DiscountTypeGroup extends AbstractDiscountType
{
    public function __construct($attendantsCount, $price, $discountCode)
    {
        parent::__construct($attendantsCount, $price, $discountCode);
    }

    public function calculate(Conference $conference)
    {
        $groupDiscount = $conference->getGroupDiscount();

        if(!is_array($groupDiscount))
        {
            $this->setError('Error', 'Error message');
        }

        $matchingDiscountPercent = 0;

        foreach($groupDiscount as $minAttendantsCount => $discountPercent)
        {
            if($this->attendantsCount >= $minAttendantsCount)
            {
                $matchingDiscountPercent = $discountPercent;
            }
        }

        $this->totalDiscount = $this->price * (float)"0.{$matchingDiscountPercent}";
    }
}