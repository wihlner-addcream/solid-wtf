<template>
  <DashboardLayout>
  <div class="space-y-6">
    <h1 class="text-2xl font-bold">Events</h1>
    <form @submit.prevent="fetchEvents" class="bg-white p-4 shadow rounded space-y-2">
      <div class="flex flex-wrap gap-2">
        <input v-model="filters.title" placeholder="Search title" class="border p-1 flex-1" />
        <input type="date" v-model="filters.start" class="border p-1" />
        <input type="date" v-model="filters.end" class="border p-1" />
        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Search</button>
      </div>
    </form>
    <form @submit.prevent="createEvent" class="bg-white p-4 shadow rounded space-y-2">
      <input v-model="form.title" placeholder="Title" class="border p-1 w-full" />
      <input type="datetime-local" v-model="form.start_time" class="border p-1 w-full" />
      <input type="datetime-local" v-model="form.end_time" class="border p-1 w-full" />
      <textarea v-model="form.description" placeholder="Description" class="border p-1 w-full"></textarea>
      <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Create</button>
    </form>
    <div v-for="event in events" :key="event.id" class="bg-white p-4 shadow rounded mb-4">
      <h2 class="font-semibold">{{ event.title }}</h2>
      <p>{{ event.description }}</p>
      <p>{{ event.start_time }} - {{ event.end_time }}</p>
      <button @click="downloadIcs(event)" class="bg-gray-700 text-white px-2 py-1 rounded mb-2">Download ICS</button>
      <form @submit.prevent="rsvp(event)" class="mt-2 space-y-2">
        <input v-model="rsvpForm.name" placeholder="Your name" class="border p-1 w-full" />
        <input v-model="rsvpForm.email" placeholder="Your email" class="border p-1 w-full" />
        <select v-model="rsvpForm.status" class="border p-1 w-full">
          <option value="yes">Yes</option>
          <option value="no">No</option>
          <option value="maybe">Maybe</option>
        </select>
        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">RSVP</button>
      </form>
      <div class="mt-2">
        <h3 class="font-semibold">Responses:</h3>
        <ul>
          <li v-for="r in event.rsvps" :key="r.id">{{ r.name }} - {{ r.status }}</li>
        </ul>
      </div>
    </div>
  </div>
  </DashboardLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import DashboardLayout from './DashboardLayout.vue';
import axios from 'axios';

const events = ref([]);
const form = ref({ title: '', description: '', start_time: '', end_time: '' });
const rsvpForm = ref({ name: '', email: '', status: 'yes', event_id: null });
const filters = ref({ title: '', start: '', end: '' });

async function fetchEvents() {
  const { data } = await axios.get('/api/events', { params: filters.value });
  events.value = data;
}

async function createEvent() {
  await axios.post('/api/events', form.value);
  form.value = { title: '', description: '', start_time: '', end_time: '' };
  fetchEvents();
}

async function rsvp(event) {
  await axios.post(`/api/events/${event.id}/rsvp`, { ...rsvpForm.value });
  rsvpForm.value = { name: '', email: '', status: 'yes' };
  fetchEvents();
}

function downloadIcs(event) {
  window.location = `/api/events/${event.id}/ics`;
}

onMounted(fetchEvents);
</script>
