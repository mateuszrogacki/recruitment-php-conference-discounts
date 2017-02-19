<?php
/**
 * Created by PhpStorm.
 * User: Mateuszek
 * Date: 19.02.2017
 * Time: 16:56
 */

namespace RstGroup\Recruitment\ConferenceSystem\Conference;


class ConferenceRepository
{
    /**
     * @param $conferenceId
     * @return Conference
     */
    public function getConference($conferenceId)
    {
        return new Conference();
    }
}