<?php

namespace App\Providers;

use App\Models\GeneralExpense;
use App\Models\MyExpense;
use App\Models\Payment;
use App\Models\ProjectExpense;
use App\Models\ProjectMilestone;
use App\Observers\GeneralExpenseObserver;
use App\Observers\MyExpenseObserver;
use App\Observers\PaymentObserver;
use App\Observers\ProjectExpenseObserver;
use App\Observers\ProjectMilestoneObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        MyExpense::observe(MyExpenseObserver::class);
        Payment::observe(PaymentObserver::class);
    }
}
