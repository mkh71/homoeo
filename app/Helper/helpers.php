<?php

use App\Models\Patient;

if (!function_exists('total_company')){
    function total_company(){
        return \App\Models\Company::query()->latest()->get();
    }
}

if (!function_exists('low_stock')){
    function low_stock(){
        return \App\Models\Medicine::query()->where('qty','<',3)->get();
    }
}

if (!function_exists('medicines')){
    function medicines(){
        return \App\Models\Medicine::query()->get();
    }
}

if (!function_exists('totalStockAmount')){
    function totalStockAmount(){
        $med =  \App\Models\Medicine::query()->get()->map(function ($item){
            $item->total = $item->qty * $item->net_price ;
            return $item;
        });
        return $med;
    }
}

if (!function_exists('expire_medicine')){
    function expire_medicine(){
        return \App\Models\Medicine::query()
            ->where('expired_date', '<=', now()->addMonths(6))->get();
    }
}
if (!function_exists('powers')){
    function powers(){
        return \App\Models\Power::query()->latest()->get();
    }
}

if (!function_exists('does')){
    function does(){
        return \App\Models\Dose::query()->latest()->get();
    }
}

if (!function_exists('diseases')){
    function diseases(){
        return \App\Models\Disease::query()->latest()->get();
    }
}


if (!function_exists('companies')){
    function companies(){
        return \App\Models\Company::query()->latest()->get();
    }
}


if (!function_exists('invoices')){
    function invoices(){
        return \App\Models\CompanyInvoice::query()->latest()->get();
    }
}

if (!function_exists('todayPatient')){
    function todayPatient(){
        return \App\Models\Patient::query()->whereDate('created_at', '=', date('Y-m-d'))->get();
    }
}

if (!function_exists('peckSize')){
    function peckSize(){
        return \App\Models\PeackSize::query()->get();
    }
}

