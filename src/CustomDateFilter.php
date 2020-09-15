<?php

namespace Keizah7\CustomDateFilter;

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
}
