<script setup>
import { onMounted, ref } from 'vue'
import { statusTugas } from '../utils/status'

// Alamat API diambil dari VITE_API_URL, bukan ditulis langsung di kode.
const API_URL = import.meta.env.VITE_API_URL

const tugas = ref([])
const memuat = ref(true)
const galat = ref('')

onMounted(async () => {
  try {
    const res = await fetch(`${API_URL}/api/tugas`)
    if (!res.ok) throw new Error(`HTTP ${res.status}`)
    const json = await res.json()
    tugas.value = json.data
  } catch (e) {
    galat.value = `Gagal memuat data dari ${API_URL}: ${e.message}`
  } finally {
    memuat.value = false
  }
})
</script>

<template>
  <section>
    <h1>Daftar Tugas</h1>
    <p class="info">Sumber data: <code>{{ API_URL }}/api/tugas</code></p>

    <p v-if="memuat">Memuat data…</p>
    <p v-else-if="galat" class="galat">{{ galat }}</p>
    <p v-else-if="tugas.length === 0">Belum ada tugas di database.</p>

    <table v-else>
      <thead>
        <tr>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in tugas" :key="item.id">
          <td>{{ item.judul }}</td>
          <td>{{ item.deskripsi || '-' }}</td>
          <td>{{ statusTugas(item.selesai) }}</td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<style scoped>
.info {
  color: #6b7280;
  font-size: 0.875rem;
}
.galat {
  color: #b91c1c;
}
table {
  border-collapse: collapse;
  width: 100%;
}
th,
td {
  border: 1px solid #d1d5db;
  padding: 0.5rem 0.75rem;
  text-align: left;
}
th {
  background: #f9fafb;
}
</style>
