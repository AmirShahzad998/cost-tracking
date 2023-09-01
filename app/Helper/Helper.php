<?php

use App\Models\OrderPayment;
use Carbon\Carbon;
use Illuminate\Support\Str;


function getTime($time)
{
    return Carbon::createFromFormat('h:i', $time)->format('H:i');
}

function getSlug($value = null)
{
    if($value){
        return Str::slug($value);
    }
    return getCurrentTime();
}

function getCurrentTime()
{
    return Carbon::now()->timestamp;
}
function update_env($key, $value)
{
    $path = base_path('.env');

    if (file_exists($path)) {

        file_put_contents($path, str_replace(
            $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
        ));
    }
}


function getStatusClass($status)
{
    switch($status){
        case "Completed":
            $status_class = "badge badge-success";
            break;
        case "In-Progress":
            $status_class = "badge badge-danger";
            break;
        default:
            $status_class = "badge badge-primary";
    }
    return $status_class;
}
function getPaymentClass($status)
{
    $arrow_class = "fas fa-arrow-up text-primary";
    if($status == "Out"){
        $arrow_class = "fas fa-arrow-down text-danger";
    }
    return $arrow_class;
}

function getPercentage($num1 , $num2)
{
    $percentage = null;

    if($num2 > 0){
        $percentage = ($num1*100)/$num2;
    }
    return $percentage;
}

