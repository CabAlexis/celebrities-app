<template>
    <div>
        <h3 class="text-lg font-bold mb-4">{{ formTitle }}</h3>
        <form @submit.prevent="saveProfile">
            <div class="mb-4">
                <label for="firstname" class="block mb-2">Prénom</label>
                <input v-model="profile.firstname" id="firstname" type="text"
                    class="w-full p-2 border border-gray-300 rounded">
                <Error v-if="errors.firstname" :error="errors.firstname[0]" />
            </div>

            <div class="mb-4">
                <label for="lastname" class="block mb-2">Nom</label>
                <input v-model="profile.lastname" id="lastname" type="text"
                    class="w-full p-2 border border-gray-300 rounded">
                <Error v-if="errors.lastname" :error="errors.lastname[0]" />
            </div>

            <div class="mb-4">
                <label for="image" class="block mb-2">Image</label>
                <input @change="downloadImage" id="image" type="file" accept="image/*"
                    class="w-full p-2 border border-gray-300 rounded">
                    <Error v-if="errors.image" :error="errors.image[0]" />
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block mb-2">Description</label>
                    <textarea v-model="profile.description" id="description"
                    class="w-full p-2 border border-gray-300 rounded h-32"></textarea>
                    <Error v-if="errors.description" :error="errors.description[0]" />
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-block px-4 py-2 mr-2 text-white bg-cyan-900 rounded hover:bg-cyan-700">
                    {{ submitButtonText }}
                </button>
                <button @click="cancelForm"
                    class="inline-block px-4 py-2 ml-2 text-black bg-gray-100 rounded hover:bg-gray-300">Annuler</button>
            </div>
        </form>
    </div>
</template>
  
<script setup>
import Error from '../form/Error.vue';
const props = defineProps({
    profile: {
        type: Object,
        default: {
            firstname: '',
            lastname: '',
            image: '',
            description: '',
        },
    },
    formTitle: {
        type: String,
        default: 'Créer un profil',
    },
    submitButtonText: {
        type: String,
        default: 'Enregistrer',
    },
    errors: {
        type: Object,
        default: {}
    }
})

const downloadImage = async (event) => {
    try {
        const image = event.target.files[0];;

        props.profile.image = image;
    } catch (error) {
        console.error(error);
    }
}
const emits = defineEmits(['save', 'cancel']);

const saveProfile = () => {
    emits('save', props.profile)
}
const cancelForm = () => {
    emits('cancel')
}
</script>