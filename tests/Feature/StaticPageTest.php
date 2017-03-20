<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StaticPageTest extends TestCase
{
    /**
     * Test GET /p/{slug}
     * @dataProvider pageProvider
     */
    public function testPage($slug, $heading)
    {
        $response = $this->get("/p/{$slug}");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $response->assertSee($heading);
    }

    /**
     * @return array
     */
    public function pageProvider()
    {
        return [
            ['privacy-policy', 'プライバシーポリシー'],
            ['terms-of-service', '利用規約'],
        ];
    }

    /**
     * Test GET /p/{slug} with missing page
     */
    public function testMissingPage()
    {
        $response = $this->get('/p/foo');

        $response->assertStatus(404);
        $response->assertSee('Resource not found');
    }
}
