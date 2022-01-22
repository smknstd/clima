<?php

namespace App\Sharp\MyWeatherDailyReport\Filters;

use Code16\Sharp\EntityList\Filters\EntityListDateRangeFilter;

class ReportDateFilterHandler extends EntityListDateRangeFilter
{
    public function buildFilterConfig(): void
    {
        $this
            ->configureLabel("Date")
            ->configureKey("report_date")
            ->configureRetainInSession()
            ->configureDateFormat("YYYY-MM-DD")
            ->configureMondayFirst(false);
    }


}
