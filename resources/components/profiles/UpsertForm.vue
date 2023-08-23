<template>
    <div>
        <h3 class="text-lg font-bold mb-4">{{ formTitle }}</h3>
        <form @submit.prevent="saveProfile">
            <div class="mb-4">
                <InputForm for-value="firstname" label="Prénom" v-model="profile.firstname" id="firstname"
                    type-value="text" />
                <Error v-if="errors.firstname" :error="errors.firstname[0]" />
            </div>

            <div class="mb-4">
                <InputForm for-value="lastname" label="Nom" v-model="profile.lastname" id="lastname" type-value="text" />
                <Error v-if="errors.lastname" :error="errors.lastname[0]" />
            </div>

            <div class="mb-4">
                <InputForm for-value="image" label="Image" @fileChanged="downloadImage" id="image" type-value="file" />
                <Error v-if="errors.image" :error="errors.image[0]" />
            </div>

            <div class="mb-4">
                <InputForm for-value="description" label="Description" v-model="profile.description" id="description"
                    type-value="textarea" />
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
import InputForm from '../design/InputForm.vue';
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

const downloadImage = async (file) => {
    try {
        props.profile.image = file;
    } catch (error) {
        console.error(error);
    }
}
const emits = defineEmits(['save', 'cancel']);

const saveProfile = () => {
    console.log(props.profile)
    emits('save', props.profile)
}
const cancelForm = () => {
    emits('cancel')
}
</script>