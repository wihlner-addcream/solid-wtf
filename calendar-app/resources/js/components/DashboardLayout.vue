<template>
  <div class="min-h-screen flex bg-gray-100">
    <aside class="w-48 bg-gray-800 text-white p-4">
      <h1 class="text-xl font-bold mb-6">Calendar</h1>
      <nav class="space-y-2">
        <a href="#" class="block hover:underline">Events</a>
      </nav>
    </aside>
    <main class="flex-1 p-6">
      <slot />
    </main>
  </div>
</template>

<script setup>
// purely presentational
</script>
