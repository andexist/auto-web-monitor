<?php

declare(strict_types=1);

namespace App\Schedule\Url\Generator;

use App\Message\Url\Generator\RickAndMortyUrlGeneratorMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;

#[AsSchedule('default')]
class RickAndMortyUrlGeneratorScheduleProvider implements ScheduleProviderInterface
{
    public function getSchedule(): Schedule
    {
        return (new Schedule())->add(
            RecurringMessage::every('10 seconds', new RickAndMortyUrlGeneratorMessage())
        );
    }
}
