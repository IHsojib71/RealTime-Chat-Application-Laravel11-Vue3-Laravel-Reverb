<script setup>
import { ref } from 'vue';

const messages = ref([
  { text: 'Hello!', sender: 'user' },
  { text: 'Hi there!', sender: 'bot' },
]);

const newMessage = ref('');

function sendMessage() {
  if (newMessage.value.trim()) {
    messages.value.push({ text: newMessage.value, sender: 'user' });
    newMessage.value = '';
  }
}
</script>

<template>
  <div class="flex flex-col p-4">
    <div class="flex-grow overflow-y-auto space-y-4">
      <div v-for="message in messages" :key="message.text" :class="message.sender === 'user' ? 'text-right' : ''">
        <div :class="message.sender === 'user' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'" class="inline-block px-4 py-2 rounded-3xl">
          {{ message.text }}
        </div>
      </div>
    </div>
    <div class="flex items-center mt-4">
      <input v-model="newMessage" type="text" class="flex-grow px-4 py-2 rounded-l-lg" placeholder="Type your message...">
      <button @click="sendMessage" class="px-4 py-2 rounded-r-lg bg-blue-500 text-white">Send</button>
    </div>
  </div>
</template>
