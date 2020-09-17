<?php

namespace Keizah7\CustomDateFilter;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class CustomDateFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'custom-date-filter';

    /**
     * Default data for component
     *
     * @var array
     */
    public $defaultData = [
        'altFormat' => 'Y-m-d H:i',
        'dateFormat' => 'Y-m-d H:i',
        'enableTime' => true,
        'enableSeconds' => false,
        'firstDayOfWeek' => 1,
    ];

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function options(Request $request)
    {
        return [];
    }

    /**
     * Prepare the filter for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(
            parent::jsonSerialize(),
            [
                'options' => array_merge($this->defaultData, $this->options(resolve(Request::class)))
            ]
        );
    }

    /**
     * Filter resources by selected day, hour and minutes
     *
     * @param $query
     * @param $field
     * @param $value
     * @return mixed
     */
    public function byTime($query, $field, $value)
    {
        $startOfMinute = Carbon::parse($value)->startOfMinute();
        $endOfMinute = $startOfMinute->copy()->endofMinute();

        return $query->where($field, '>=', $startOfMinute)->where($field, '<=', $endOfMinute);
    }

    /**
     * Filter resources by selected day and hour
     *
     * @param $query
     * @param $field
     * @param $value
     * @return mixed
     */
    public function byHour($query, $field, $value)
    {
        $startOfHour = Carbon::parse($value)->startOfHour();
        $endOfHour = $startOfHour->copy()->endOfHour();

        return $query->where($field, '>=', $startOfHour)->where($field, '<=', $endOfHour);
    }

    /**
     * Filter resources from selected day and hour
     *
     * @param $query
     * @param $field
     * @param $value
     * @return mixed
     */
    public function fromHour($query, $field, $value)
    {
        $startOfHour = Carbon::parse($value)->startOfHour();

        return $query->where($field, '>=', $startOfHour);
    }

    /**
     * Filter resources to selected day and hour
     *
     * @param $query
     * @param $field
     * @param $value
     * @return mixed
     */
    public function toHour($query, $field, $value)
    {
        $startOfHour = Carbon::parse($value)->endOfHour();

        return $query->where($field, '<=', $startOfHour);
    }

    /**
     * Filter resources by selected day
     *
     * @param $query
     * @param $field
     * @param $value
     * @return mixed
     */
    public function byDay($query, $field, $value)
    {
        $startOfDay = Carbon::parse($value)->startOfDay();
        $endOfDay = $startOfDay->copy()->endOfDay();

        return $query->where($field, '>=', $startOfDay)->where($field, '<=', $endOfDay);
    }

    /**
     * Filter resources from selected day
     *
     * @param $query
     * @param $field
     * @param $value
     * @return mixed
     */
    public function fromDay($query, $field, $value)
    {
        $startOfDay = Carbon::parse($value)->startOfDay();

        return $query->where($field, '>=', $startOfDay);
    }

    /**
     * Filter resources to selected day
     *
     * @param $query
     * @param $field
     * @param $value
     * @return mixed
     */
    public function toDay($query, $field, $value)
    {
        $endOfDay = Carbon::parse($value)->endOfDay();

        return $query->where($field, '<=', $endOfDay);
    }
}
