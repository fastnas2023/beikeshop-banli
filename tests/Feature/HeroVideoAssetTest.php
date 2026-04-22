<?php

namespace Tests\Feature;

use Tests\TestCase;

class HeroVideoAssetTest extends TestCase
{
    public function test_hero_background_video_asset_exists(): void
    {
        $this->assertFileExists(
            base_path('public/image/catalog/banli_theme/cyber-bg-2.mp4')
        );
    }
}

