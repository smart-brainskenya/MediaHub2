<?php

namespace Tests\Feature\Feature;

use App\Models\MediaAsset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the application boots successfully and redirects from root.
     */
    public function test_application_boots_successfully_and_redirects_from_root(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('videos.index');
    }

    /**
     * Test that the public video index page is accessible.
     */
    public function test_public_video_index_is_accessible(): void
    {
        $response = $this->get('/videos');
        $response->assertStatus(200);
    }

    /**
     * Test that a public video show page is accessible with a valid video.
     */
    public function test_public_video_show_page_is_accessible_with_valid_video(): void
    {
        $video = MediaAsset::factory()->create([
            'type' => 'video',
            'file_path' => 'test-video.mp4', // Dummy path, not actually accessed
            'mime_type' => 'video/mp4',
        ]);

        $response = $this->get(route('videos.show', $video));
        $response->assertStatus(200);
    }

    /**
     * Test that a public video show page returns 404 for an invalid video.
     */
    public function test_public_video_show_page_returns_404_for_invalid_video(): void
    {
        $response = $this->get(route('videos.show', ['video' => 99999])); // Non-existent ID
        $response->assertStatus(404);
    }

    /**
     * Test that the admin dashboard is protected by authentication.
     */
    public function test_admin_dashboard_is_protected_by_authentication(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test that the admin video index is protected by authentication.
     */
    public function test_admin_video_index_is_protected_by_authentication(): void
    {
        $response = $this->get(route('admin.videos.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test that the embed route resolves correctly for a valid video.
     */
    public function test_embed_route_resolves_correctly_for_valid_video(): void
    {
        $video = MediaAsset::factory()->create([
            'type' => 'video',
            'file_path' => 'test-embed-video.mp4',
            'mime_type' => 'video/mp4',
        ]);

        $response = $this->get(route('videos.embed', $video));
        $response->assertStatus(200);
        $response->assertSee('<video controls autoplay src="' . Storage::disk('media_videos')->url($video->file_path) . '"></video>', false);
    }

    /**
     * Test that the embed route returns 404 for an invalid video.
     */
    public function test_embed_route_returns_404_for_invalid_video(): void
    {
        $response = $this->get(route('videos.embed', ['video' => 99999])); // Non-existent ID
        $response->assertStatus(404);
    }
}