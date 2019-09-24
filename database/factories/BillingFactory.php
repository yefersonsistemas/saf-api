<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Billing;
use App\Person;
use App\Patient;
use App\TypePayment;
use App\TypeCurrency;
use App\Employe;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Billing::class, function (Faker $faker) {
    $person = Person::inRandomOrder()->first();
    $employe = Employe::inRandomOrder()->first();
    $patient = Patient::inRandomOrder()->first();
    $tipepayment = TypePayment::inRandomOrder()->first();
    $typecurrency = TypeCurrency::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'procedure_employe_id' => $employe->procedure_employe->id,
        'person_id' =>$person->id,
        'patient_id' =>$patient->id,
        'type_payment_id' =>$typepayment->id,
        'type_currency_id' =>$typecurrency->id,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
