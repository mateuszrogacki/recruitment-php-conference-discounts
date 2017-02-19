<?php
/**
 * Created by PhpStorm.
 * User: Mateuszek
 * Date: 19.02.2017
 * Time: 18:46
 */

namespace RstGroup\Recruitment\ConferenceSystem\Discount;


use RstGroup\Recruitment\ConferenceSystem\Conference\ConferenceRepository;

class DiscountService
{
    private $conferenceRepository = null;

    public function __construct(ConferenceRepository $conferenceRepository)
    {
        $this->conferenceRepository = $conferenceRepository;
    }

    public function calculate($conferenceId, AbstractDiscountType $discountType, &$error = null)
    {
        $conference = $this->conferenceRepository->getConference($conferenceId);

        if($conference === null)
        {
            throw new \InvalidArgumentException(sprintf("Conference with id %s not exist", $conferenceId));
        }

        $discountType->calculate($conference);

        if($discountType->isError() !== false)
        {
            $error = $discountType->getError('Error');
            return;
        }

        return $discountType->getTotalDiscount();
    }
}