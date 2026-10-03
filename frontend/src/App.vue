<template>
  <div class="app">
    <nav>
      <router-link to="/">Daftar Tugas</router-link>
      <router-link to="/tentang">Tentang</router-link>
    </nav>
    <main>
      <router-view />
    </main>
  </div>
</template>

<style>
body {
  font-family: system-ui, sans-serif;
  margin: 0;
  color: #1f2937;
}
nav {
  display: flex;
  gap: 1rem;
  padding: 1rem;
  background: #f3f4f6;
  border-bottom: 1px solid #e5e7eb;
}
nav a {
  color: #2563eb;
  text-decoration: none;
}
nav a.router-link-active {
  font-weight: bold;
  text-decoration: underline;
}
main {
  max-width: 720px;
  margin: 2rem auto;
  padding: 0 1rem;
}
</style>
