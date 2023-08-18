<template>
    <div class="h-px max-h-px bg-gray-300"></div>
    <div class="my-4 flex justify-end">
        <button class="inline-block px-4 py-2 mr-2 text-white bg-cyan-900 rounded hover:bg-cyan-700"
            @click="isEditing = true">Éditer</button>
        <button class="inline-block px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600"
            @click="showConfirmationModal = true">Supprimer</button>
    </div>
    <div class="float-left md:mr-4">
        <img :src="profile.image_url" alt="Profile image" class="h-32 mr-4 mb-4">
    </div>
    <div class="min-h-full">
        <h2 class="text-lg font-bold">{{ profile.fullname }}</h2>
        <p class="mt-2">{{ profile.description }}</p>
    </div>

    <!-- Modal de confirmation -->
    <div v-if="showConfirmationModal" class="fixed inset-0 flex items-center justify-center z-10 bg-opacity-75 bg-gray-900">
        <div class="bg-white rounded-lg p-8">
            <p>Êtes-vous sûr de vouloir supprimer ce profil ?</p>
            <div class="mt-4 flex justify-center">
                <button
                    class="cancel-button inline-block px-4 py-2 text-gray-600 bg-gray-300 rounded hover:bg-gray-400 mr-4"
                    @click="showConfirmationModal = false">Annuler</button>
                <button class="confirm-button inline-block px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600"
                    @click="confirmDelete">Confirmer</button>
            </div>
        </div>
    </div>

    <!-- Utiliser le composant UpsertForm dans la modal d'édition -->
    <div v-if="isEditing" @close="cancelEditProfile"
        class="fixed inset-0 flex items-center justify-center z-10 bg-opacity-75 bg-gray-900">
        <upsert-form :profile="profile" form-title="Éditer le profil" submit-button-text="Modifier"
            @save="saveEditedProfile" @cancel="cancelEditProfile" class="bg-white rounded-lg p-8 w-5/6"></upsert-form>
    </div>
</template>

<script setup>
import { ref } from 'vue';

import UpsertForm from './UpsertForm.vue';

const props = defineProps({
    profile: {
        type: Object,
        required: true,
    }
})

const showConfirmationModal = ref(false);

const emits = defineEmits(['delete-confirmed', 'edit-profile'])

const confirmDelete = () => {
    const profileId = props.profile.id;
    emits('delete-confirmed', profileId);
    showConfirmationModal.value = false;
};

const isEditing = ref(false);

const saveEditedProfile = () => {
    const profile = props.profile;
    emits('edit-profile', profile);
    isEditing.value = false;
};

const cancelEditProfile = () => {
    isEditing.value = false;
};

</script>