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
        // $this->call(PersonTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SpecialitiesTableSeeder::class);
        // $this->call(TreatmentsTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
        $this->call(ProcedureTableSeeder::class); 
        $this->call(UsersTableSeeder::class);
        // $this->call(PositionsTableSeeder::class);
        // $this->call(EmployeTableSeeder::class);
        $this->call(VisitorTableSeeder::class);
        // $this->call(PatientsTableSeeder::class);
        // $this->call(SchedulesTableSeeder::class);
        // $this->call(ReservationsTableSeeder::class);
        $this->call(CitesTableSeeder::class);
        $this->call(ConsultationTypesTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        // $this->call(DiagnosticsTableSeeder::class);
        $this->call(TypeAreasTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(ClassificationsTableSeeder::class);
        $this->call(AreaAssigmentsTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
        $this->call(BalancesTableSeeder::class);
        // $this->call(TypeDoctorTableSeeder::class);
        // $this->call(DoctorTableSeeder::class);
        $this->call(TypeEquipmentTableSeeder::class);
        $this->call(EquipmentTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(TypeSupplieTableSeeder::class);     
        $this->call(SupplieTableSeeder::class);
        $this->call(ClassificationSurgeryTableSeeder::class);
        $this->call(TypeSurgeriesTableSeeder::class);
        $this->call(HospitalizationTableSeeder::class);
        $this->call(SurgeriesTableSeeder::class);
        $this->call(TypeCurrenciesTableSeeder::class);
        $this->call(TypePaymentsTableSeeder::class);
        $this->call(InventoriesTableSeeder::class);
        $this->call(InventoryAreasTableSeeder::class);
        $this->call(BillingsTableSeeder::class);
        $this->call(IncomeTableSeeder::class);
        $this->call(ExamTableSeeder::class);
        $this->call(TypeCleaningTableSeeder::class);
        $this->call(CleaningRecordTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(BudgetTableSeeder::class);
        $this->call(AssistanceTableSeeder::class);
        $this->call(RecipeTableSeeder::class);
        $this->call(ItineraryTableSeeder::class);
        $this->call(AllergyTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
