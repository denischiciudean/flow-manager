<?php


namespace App\Components;


use Carbon\Carbon;
use Illuminate\Support\Str;

class TimeHelpers
{
    /**
     *
     * Format your string like so
     *
     *  Acum {days} zile, {hours} left {date}
     *
     * @param int $timestamp
     * @param string $string
     * @return string
     */
    public static function convertTimestampToDayHoursLeft(Carbon $timestamp, string $string, string $date_format = 'D m Y @ H:i')
    {
        return (string)Str::of($string)->replace(
            [
                '{days}',
                '{hours}',
                '{date}'
            ],
            [
                (int)((now()->timestamp - $timestamp->timestamp) / 60 / 60 / 24),
                (int)((now()->timestamp - $timestamp->timestamp) / 60 / 60) % 24,
                $timestamp->format($date_format)
            ]
        );
    }

    /**
     * @param int $timestamp
     * @return float[]|int[]
     */
    public static function timeLeft(int $timestamp)
    {
        $left_seconds = $timestamp - now()->timestamp;

        $hours_left = $left_seconds / 60 / 60;
        $days_left = $hours_left / 24;
        return [(int)$hours_left, (int)$days_left];
    }
}
