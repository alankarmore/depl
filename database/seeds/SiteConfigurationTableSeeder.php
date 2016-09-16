<?php

use App\SiteConfig;
use Illuminate\Database\Seeder;

class SiteConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = array(
            array(
                'config_name' => 'SITE_NAME',
                'config_value' => 'Dinesh Engineers Pvt. Ltd.',
                'created_at' => date("Y-m-d H:i:s"),
            ),
            array(
                'config_name' => 'SITE_LOGO',
                'config_value' => 'logo.png.',
                'created_at' => date("Y-m-d H:i:s"),
            ),
            array(
                'config_name' => 'SITE_ADDRESS',
                'config_value' => '25, Lorem Lis Street, Orange California, US Phone: 800 123 3456 <br>Fax: 800 123 3456<br>Email: info@anybiz.com',
                'created_at' => date("Y-m-d H:i:s"),
            ),
            array(
                'config_name' => 'COPYRIGHT_MESSAGE',
                'config_value' => 'copyrights&copy;dinesh pvt ltd 2016',
                'created_at' => date("Y-m-d H:i:s"),
            )
        );

        foreach($configs as $config) {
            SiteConfig::create($config);
        }
    }
}
