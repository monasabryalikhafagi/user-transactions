<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportApiTest extends TestCase
{
    use RefreshDatabase;
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
        $admin = User::where('email', 'admin@gmail.com')->first();

        $response = $this->actingAs($admin ,'api')->postJson('/api/import');
 
        $response
            ->assertStatus(422);
    }

    public function test_the_import_file_validation(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
      //  Storage::fake('importing');
       // json_decode(file_get_contents(), true);
       // $file = UploadedFile::fake()->create('users.json');
       $path = base_path().'/tests/users.json';
       $original_name = 'users.json';
       $mime_type = 'application/json';
       $size = 2476;
       $error = null;
       $test = true;
   
       $file = new UploadedFile($path, $original_name, $mime_type, null, true);
   
       //$file = new UploadedFile($path, $name, filesize($path), 'image/png', null, true);

        // $response = $this->post('/avatar', [
        //     'avatar' => $file,
        // ]);
 
       // Storage::disk('importing')->assertExists($file->hashName());

        $response = $this->actingAs($admin ,'api')->postJson('/api/import',['entity' => 'user' , 'file' => $file]);
 
        $response->assertStatus(200);
    }
}
