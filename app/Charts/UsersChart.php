<?php

namespace App\Charts;

use App\Models\User;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class UsersChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
