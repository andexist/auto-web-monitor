<?php

declare(strict_types=1);

namespace App\Schedule\Url;

use App\Command\Url\UrlGeneratorCommand;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;


class UrlGeneratorScheduleProvider implements ScheduleProviderInterface
{
   public function __construct(private UrlGeneratorCommand $urlGeneratorCommand)
   {
   }

   public function getSchedule(): Schedule
    {
        return (new Schedule())->add(
            RecurringMessage::every('1 minute', $this->urlGeneratorCommand)
        );
    }
}
