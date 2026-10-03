<?php

namespace Tests\Feature;

use App\Models\Tugas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TugasApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_daftar_tugas_kosong_mengembalikan_json(): void
    {
        $response = $this->getJson('/api/tugas');

        $response->assertStatus(200)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(0, 'data');
    }

    public function test_bisa_membuat_tugas_baru(): void
    {
        $response = $this->postJson('/api/tugas', [
            'judul' => 'Mengerjakan Tugas 2',
            'deskripsi' => 'Pipeline empat tahap',
            'selesai' => false,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.judul', 'Mengerjakan Tugas 2');

        $this->assertDatabaseHas('tugas', ['judul' => 'Mengerjakan Tugas 2']);
    }

    public function test_judul_wajib_diisi(): void
    {
        $response = $this->postJson('/api/tugas', ['judul' => '']);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['judul']);
    }

    public function test_bisa_memperbarui_tugas(): void
    {
        $tugas = Tugas::factory()->create(['selesai' => false]);

        $response = $this->putJson("/api/tugas/{$tugas->id}", [
            'judul' => $tugas->judul,
            'selesai' => true,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.selesai', true);
    }

    public function test_bisa_menghapus_tugas(): void
    {
        $tugas = Tugas::factory()->create();

        $response = $this->deleteJson("/api/tugas/{$tugas->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tugas', ['id' => $tugas->id]);
    }
}
