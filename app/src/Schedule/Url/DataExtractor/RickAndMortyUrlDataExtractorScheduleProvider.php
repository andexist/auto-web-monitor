<?php

declare(strict_types=1);

namespace App\Schedule\Url\DataExtractor;

use App\Message\Url\DataExtractor\RickAndMortyUrlDataExtractorMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;

#[AsSchedule('url_data_extract')]
class RickAndMortyUrlDataExtractorScheduleProvider implements ScheduleProviderInterface
{
    public function getSchedule(): Schedule
    {
        return (new Schedule())->add(
            RecurringMessage::every('11 minutes', new RickAndMortyUrlDataExtractorMessage()),
        );
    }
}
