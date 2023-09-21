<?php

declare(strict_types=1);

namespace App\Schedule\Url;

use App\Command\Url\UrlDataExtractorCommand;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;

#[AsSchedule('default')]
class UrlDataExtractorScheduleProvider implements ScheduleProviderInterface
{
    public function __construct(private UrlDataExtractorCommand $urlDataExtractorCommand)
    {
    }

    public function getSchedule(): Schedule
    {
        return (new Schedule())->add(
            RecurringMessage::every('2 days', $this->urlDataExtractorCommand)
        );
    }
}
