<script setup lang="ts">
import axios from "axios";
import {ref} from "vue";

const shortedLink = ref()
const link = ref()
const errorMessage = ref()
const regexError = ref(true)

const store = async () => {
    if (regexError.value && !errorMessage.value) {
        await axios
            .post('api/link', {link: link.value})
            .then((response) => {
                console.log(response.data)
                shortedLink.value = response.data
            })
            .catch((error) => {
                errorMessage.value = error.response.data.message
            })
    }
}

const regex = /^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/
const checkLink = () => {
    link.value.length ? regexError.value = regex.test(link.value) : regexError.value = true
}

</script>

<template>
    <div class="flex flex-col justify-center items-center w-screen h-screen bg-[#35393C]">
        <div v-if="errorMessage" class="text-red-600">
            {{errorMessage}}
        </div>
        <div v-if="!regexError" class="text-red-600">
            Incorrect link!
        </div>
        <div class="flex flex-col w-1/2 justify-center items-center bg-[#42858C] rounded-lg p-2.5 gap-y-2.5">
            <div class="flex p-1 text-[#63CCCA] rounded-lg">Type your Link...</div>
            <div class="flex flex-row w-full gap-x-1">
                <input class="bg-[#63CCCA] w-full rounded-lg p-1" v-model="link" @input="errorMessage = ''; checkLink()" type="text" placeholder="Type your link here">
                <div class="bg-[#63CCCA] w-1/5 text-center cursor-pointer p-1 rounded-lg hover:bg-[#35393C] hover:text-[#63CCCA]" @click="store()">Make it short</div>
            </div>
            <div v-if="shortedLink" class="text-[#63CCCA]">Shorted link:</div>
            <a class="hover:text-[#63CCCA]" :href="shortedLink" target="_blank">{{shortedLink}}</a>
        </div>
    </div>

</template>
