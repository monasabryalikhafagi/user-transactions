<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class ImportApiTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_user_must_login_to_can_import(): void
    {

        $response = $this->postJson('/api/import');
 
        $response ->assertStatus(401);
 
    }
    public function test_the_import_require_validation(): void
    {
        $admin = User::where('email', 'admin@gmail.com');

        $response = $this->actingAs($admin ,'api')->postJson('/api/import');
 
        $response
            ->assertStatus(422)
            ->assertJson([
                'entity' => "entity field is required",
                'file' => "file field is required",

            ]);
    }

    public function test_the_import_file_validation(): void
    {
        $admin = User::where('email', 'admin@gmail.com');
      //  Storage::fake('importing');
       // json_decode(file_get_contents(), true);
        $file = UploadedFile::fake()->create('users.json');
 
        // $response = $this->post('/avatar', [
        //     'avatar' => $file,
        // ]);
 
       // Storage::disk('importing')->assertExists($file->hashName());

        $response = $this->actingAs($admin ,'api')->postJson('/api/import',['entity' => 'users' , 'file' => base_path().'/tests/users.json']);
 
        $response
            ->assertStatus(422)
            ->assertJson([
                'entity' => "entity field is required",
                'file' => "file field is required",

            ]);
    }
}
