<?php

namespace Plugin\BanliTheme\Seeders;

use Beike\Repositories\SettingRepo;
use Illuminate\Database\Seeder;

class BanliThemeSeeder extends Seeder
{
    public function run()
    {
        $designSetting = $this->getDesignSetting();
        SettingRepo::update('system', 'base', ['design_setting' => $designSetting]);
        
        if (isset($this->command)) {
            $this->command->info('BanliTheme demo data imported successfully.');
        }
    }

    private function getDesignSetting()
    {
        return include __DIR__ . '/design_setting_data.php';
    }
}
