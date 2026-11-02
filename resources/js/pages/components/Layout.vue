<script setup>
    defineProps({
        chirps: {
            type: Array,
            default: () => [],
        },
    });
</script>
<template>
    <main class="flex-1 container mx-auto px-4 py-8">
        <p v-if="chirps.length === 0">
            No hay chirps todavia.
        </p>
        <div v-else>
            <div v-for="chirp in chirps" :key="chirp.id" class="max-w-2xl mx-auto">
                <div class="card bg-base-100 shadow mt-8">
                    <div class="card-body">
                        <div>
                            <p class="text-3xl font-bold">{{ chirp.text }}</p>
                            <p class="mt-4 text-base-content/60">{{ chirp.created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>