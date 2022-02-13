<?php

namespace App\View\Components;

use App\Models\WeatherDailyReport;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ReportsTable extends Component
{

    public Collection $reports;

    public string $type;

    public function __construct(Collection $reports, string $type)
    {
        $this->reports = $reports;
        $this->type = $type;
    }

    public function hasAtLeastOneReportWithSnowDepth()
    {
        return $this->reports->contains(fn(WeatherDailyReport $report) => $report->snow_depth > 0);
    }

    public function render()
    {
        return view('components.reports-table');
    }
}
