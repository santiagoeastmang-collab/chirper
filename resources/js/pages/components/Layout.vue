<script setup>
    import Toast from './Toast.vue';
    import SubmitChirp from './SubmitChirp.vue';

</script>
<template>
    <main class="flex-1 container mx-auto px-4 py-8">
        
        <Toast />

        <h3 class="text-3xl font-bold mt-8">Latest Chirps:</h3>
        
        <SubmitChirp />

        <div class="space-y-4 mt-8">
            <slot />
        </div>
    </main>
</template>