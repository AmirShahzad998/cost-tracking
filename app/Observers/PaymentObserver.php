<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Setting;
use App\Models\Transaction;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        $data = [
            'project_id' => $payment->project_id,
            'payment_id' => $payment->id,
            'title' => $payment->title,
            'slug' => getSlug(),
            'date' => $payment->date,
            'type' => "In",
            'amount' => $payment->payment,
            'description' => $payment->description,
        ];

        Transaction::create($data);

        if($payment->project_id){

            $setting = Setting::first();

            $data['title'] = "UpWork Fee";
            $data['slug'] = getSlug();
            $data['type'] = "Out";
            $data['amount'] = ($payment->payment * $setting->up_work_fee)/100;
            $data['description'] = "Up Work Fee Added {$setting->up_work_fee}";
            Transaction::create($data);
        }
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
