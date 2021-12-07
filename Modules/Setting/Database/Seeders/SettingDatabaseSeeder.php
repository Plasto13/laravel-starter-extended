<?php
namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Repositories\SettingRepository;

class SettingDatabaseSeeder extends Seeder
{
    /**
    * @var SettingRepository
    */
    private $setting;

    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $data = [
            'core::locales' => ['en', 'sk'],
            'core::app_name' => ['en' => 'Starter Extended'],
            'core::meta_site_name' => ['en' => 'Site meta name'],
            'core::meta_description' => ['en' => 'Site meta name description'],
            'core::app_name' => ['sk' => 'Starter Extended'],
            'core::meta_site_name' => ['sk' => 'Site meta názov'],
            'core::meta_description' => ['sk' => 'Site meta name popis'],
            'core::frontend_theme' => 'starter',
            'core::backend_theme' => 'adminlte3',
            'core::email' => 'noreply@site.xyz',
            'core::show_copyright' => true,
        ];

        $this->setting->createOrUpdate($data);
    }
}
