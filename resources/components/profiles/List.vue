<template>
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/3 flex flex-col items-center">
            <button v-if="profiles.length > 0" v-for="profile in profiles" :key="profile.id" class="name-button w-2/3"
                :class="{
                    'selected': selectedProfile.id === profile.id
                }" @click="selectProfile(profile)">
                {{ profile.fullname }}
            </button>
            <div v-else>
                Pas de données actuellement
            </div>
            <button
                class="inline-block px-4 py-2 mt-4 font-bold text-black bg-gray-200 rounded hover:bg-cyan-700  hover:text-white w-2/3"
                @click="addProfile = true">Ajouter un profil</button>
        </div>
        <div class="w-px max-w-px bg-gray-300" v-if="selectedProfile"></div>
        <div class="w-full md:w-2/3 md:ml-4 mt-4 md:mt-0">
            <div v-if="selectedProfile">
                <profiles-details :profile="selectedProfile" @delete-confirmed="deleteProfileConfirmed"
                    @edit-profile="editProfile" />
            </div>
        </div>
    </div>

    <!-- Utiliser le composant UpsertForm dans la modal d'ajout -->
    <div v-if="addProfile" @close="cancelEditProfile"
        class="fixed inset-0 flex items-center justify-center z-10 bg-opacity-75 bg-gray-900">
        <upsert-form :profile="createProfile" form-title="Ajouter un profil" submit-button-text="Ajouter"
            @save="createNewProfile" @cancel="addProfile = false" class="bg-white rounded-lg p-8 w-5/6"></upsert-form>
    </div>
</template>
  
<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import ProfilesDetails from './Details.vue';
import UpsertForm from './UpsertForm.vue';

const profiles = ref([]);
const selectedProfile = ref(null);

const createProfile = ref({
    firstname: null,
    lastname: null,
    image: null,
    description: null
})

const resetCreatedProfile = () => {
    createProfile.value = {
        firstname: null,
        lastname: null,
        image: null,
        description: null
    }
}
const addProfile = ref(false);

const getProfiles = async () => {
    try {
        const response = await axios.get('/api/profiles');
        profiles.value = response.data;
        if (profiles.value.length > 0 && selectedProfile.value === null) {
            selectedProfile.value = profiles.value[0];
        }

    } catch (error) {
        console.error(error);
    }
};

const editProfile = async (profile) => {
    try {
        await axios.put('/api/profiles/' + profile.id, profile);
        selectedProfile.value = profile;
        getProfiles();
    } catch (error) {
        console.error(error);
    }
};

const createNewProfile = async (createProfile) => {
    try {
        const justCreatedProfile = await axios.post('/api/profiles/', createProfile);
        selectedProfile.value = justCreatedProfile.data.profile;
        addProfile.value = false;
        resetCreatedProfile();
        getProfiles();
    } catch (error) {
        console.error(error);
    }
};

const deleteProfileConfirmed = async (deletedProfileId) => {
    try {
        await axios.delete(`/api/profiles/${deletedProfileId}`);
        await getProfiles();
        selectedProfile.value = profiles.value[0];
    } catch (error) {
        console.error(error);
    }
};

const selectProfile = (profile) => {
    selectedProfile.value = profile;
};

onMounted(() => {
    getProfiles();
});
</script>
  
<style scoped>
.name-button {
    @apply bg-gray-300 text-gray-700 py-2 px-4 mb-2 rounded;
}

.name-button.selected {
    @apply bg-cyan-900 text-white;
}
</style>