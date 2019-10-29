<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(RolesAndPermissionsTablesSeeders::class);
        $this->call(HeadquartersTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(PersonTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(EmployeTableSeeder::class);
        $this->call(VisitorTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SpecialitiesTableSeeder::class);
        $this->call(ConsultationTypesTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(DiagnosticsTableSeeder::class);
        $this->call(TypeAreasTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(AreaAssigmentsTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
        $this->call(BalancesTableSeeder::class);
        $this->call(TypeDoctorTableSeeder::class);
        $this->call(DoctorTableSeeder::class);
        $this->call(TypeEquipmentTableSeeder::class);
        $this->call(EquipmentTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(ProcedureTableSeeder::class); 
        $this->call(TypeSupplieTableSeeder::class);     
        $this->call(SupplieTableSeeder::class);
        $this->call(TypeSurgeriesTableSeeder::class);
        $this->call(SurgeriesTableSeeder::class);
        $this->call(TypeCurrenciesTableSeeder::class);
        $this->call(TypePaymentsTableSeeder::class);
        $this->call(InventoriesTableSeeder::class);
        $this->call(InventoryAreasTableSeeder::class);
        $this->call(BillingsTableSeeder::class);
        $this->call(IcomeTableSeeder::class);
        $this->call(ExamTableSeeder::class);
        $this->call(TypeCleaningTableSeeder::class);
        $this->call(CleaningRecordTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
