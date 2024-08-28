<script setup>
import { ref, onMounted, defineProps, watch, nextTick } from 'vue';

import { usePage } from '@inertiajs/vue3';

const messages = ref();

const currentUser = usePage().props.auth.user;

const props = defineProps({
    friend: {
        type: Object,
        required: true,
    },

})

const messageContainer = ref(null);

watch(messages, () => {
    nextTick(() => {
        messageContainer.value.scrollTo({
        top: messageContainer.value.scrollHeight,
        behavior : "smooth",
      })
    })
    messageContainer.value.scrollTo({
        top: messageContainer.value.scrollHeight,
        behavior : "smooth",
    })
}, { deep: true });

const newMessage = ref('');

const sendMessage = () => {
    if (newMessage.value.trim() !== "")
    {
        axios.post(route('chat.sendMessage', props.friend.id), {
            message: newMessage.value,
        })
        .then((response) => {
            newMessage.value = "";
            messages.value.push(response.data.message);
        })
        .catch((error) => {
            console.log(error);
        })

    }
}

onMounted(() => {
    axios.get(route('chat.fetchMessages', props.friend.id))
        .then((response) => {
            messages.value = response.data.messages;
        })
        .catch((error) => {
            console.log(error);
        })
    Echo.private(`chat.${currentUser.id}`)
        .listen('MessageSentEvent', (response) => {
            messages.value.push(response.message);
        })
})
</script>

<template>
  <div class="flex flex-col p-4">
    <div ref="messageContainer" class="flex-grow overflow-y-auto space-y-4 h-[450px]">
      <div v-for="(message,index) in messages" :key="message.id" :class="message.sender_id === currentUser.id ? 'text-right' : ''">
        <div :class="message.sender_id === currentUser.id ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'" class="inline-block px-4 py-2 rounded-3xl">
          {{ message.message }}
        </div>
      </div>
    </div>
    <div class="flex items-center mt-4">
      <input v-model="newMessage" type="text" class="flex-grow px-4 py-2 rounded-l-lg" placeholder="Type your message...">
      <button @click="sendMessage" class="px-4 py-2 rounded-r-lg bg-blue-500 text-white">Send</button>
    </div>
  </div>
</template>
