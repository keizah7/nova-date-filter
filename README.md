[![Latest Version on Packagist](https://img.shields.io/packagist/v/keizah7/custom-date-filter.svg)](https://packagist.org/packages/keizah7/custom-date-filter)
[![Total Downloads](https://img.shields.io/packagist/dt/keizah7/custom-date-filter.svg)](https://packagist.org/packages/epartment/nova-dependency-container)
![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)
![Forks](https://img.shields.io/github/forks/keizah7/nova-date-filter?style=social)
![Stars](https://img.shields.io/github/stars/keizah7/nova-date-filter?style=social)
![Watchers](https://img.shields.io/github/watchers/keizah7/nova-date-filter?style=social)
![Contributors](https://img.shields.io/github/contributors/keizah7/nova-date-filter)
# Data Filter
Laravel Nova Custom Date Filter

With this package you can set custom date filter `format` and other options, which newest Nova doesn't support.

![custom date filter](https://github.com/keizah7/nova-date-filter/blob/master/data-filter.png?raw=true)
# Installation
Install your package in any Nova app
```
composer require keizah7/nova-date-filter
```
You may generate a  filter using the `nova:filter` command.
By default, Nova will place newly generated filters in the `app/Nova/Filters` directory
```
php artisan nova:filter TimestampFilter
```
Extend your filter class with `CustomDateFilter`
```
use Keizah7\CustomDateFilter\CustomDateFilter;

class TimestampFilter extends CustomDateFilter
{
    //
}
```
Once you have defined a filter, you are ready to attach it to a resource. Each resource generated by Nova contains a `filters` method. To attach a filter to a resource, you should simply add it to the array of filters returned by this method:
```
/**
 * Get the filters available for the resource.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return array
 */
public function filters(Request $request)
{
    return [
        new TimestampFilter(),
    ];
}
```
Remove `TimestampFilter` `$component` variable
```
/**
 * The filter's component.
 *
 * @var string
 */
public $component = 'select-filter'; // remove this line
```
After completing these steps you can see date filter in your nova resource.
## Usage
The filter `apply` method is responsible for modifying the query to achieve the desired filter state, so you can modify it as you want or use prepared package methods:
- `byTime`
- `byHour`
- `fromHour`
- `toHour`
- `byDay`
- `fromDay`
- `toDay`
```
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
    return $this->byHour($query, 'created_at', $value);
}
```
## Settings
Default filter setings is:
```
'altFormat' => 'Y-m-d H:i'
'dateFormat' => 'Y-m-d H:i'
'enableTime' => true
'enableSeconds' => false
'firstDayOfWeek' => 1
'defaultHour' => 7
'defaultMinute' => 0
```
You can change them by modify your filter class `options` method:
```
/**
 * Get the filter's available options.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return array
 */
public function options(Request $request)
{
    return [
        'altFormat' => 'Y-m-d H:i:S',
        'dateFormat' => 'Y-m-d H:i:S',
        'enableTime' => true,
        'enableSeconds' => true,
        'firstDayOfWeek' => 7,
        'defaultHour' => 12,
        'defaultMinute' => 0,
    ];
}
```
## License
The MIT License (MIT). Please see [License File](https://github.com/keizah7/nova-date-filter/blob/master/LICENSE) for more information.
