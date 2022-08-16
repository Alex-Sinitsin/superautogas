<?php

namespace Date;

class DateFormat
{

  public static function post($time)
  {
    $timestamp = strtotime($time);
    $published = date('d.m.Y', $timestamp);

    if ($published === date('d.m.Y')) {
      return trans('date.today');
    } elseif ($published === date('d.m.Y', strtotime('-1 day'))) {
      return trans('date.yesterday');
    } else {
      $formatted = trans('date.later', [
        'date' => date('d F Y', $timestamp)
      ]);

      return strtr($formatted, trans('date.month_declensions'));
    }
  }
}
