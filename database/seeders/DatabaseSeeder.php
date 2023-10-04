<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ConstantSeeder::class);
        $this->call(CMSSeeder::class);
//        $this->call(CountriesTableSeeder::class);
//        $this->call(StatesTableSeeder::class);
//        $this->call(CitiesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AttachmentsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProjectTypesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(CompanyProjectsTableSeeder::class);
        $this->call(CompanyProjectServiceTableSeeder::class);
        $this->call(IconsTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(NewsTableSeeder::class);

//        $this->call(StatusesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        if (\Nwidart\Modules\Facades\Module::has('Projects')){
            $this->call(\Modules\Projects\Database\Seeders\ProjectsDatabaseSeeder::class);
        }

        Artisan::call('passport:install');

    }
}
