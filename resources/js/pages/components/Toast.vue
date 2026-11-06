<script setup>

    import { ref, watch, onUnmounted } from 'vue'
    import { usePage } from '@inertiajs/vue3'

    const page = usePage();
    const successMessage = ref('');
    let toastTimer;

    watch(
        () => page.props.flash?.success,
        (text) => {
            if (!text) return

            successMessage.value = text

            clearTimeout(toastTimer)
            toastTimer = setTimeout(() => {
                successMessage.value = ''
            }, 6000)
        }, 
        { immediate: true},
    )

    onUnmounted(() => clearTimeout(toastTimer))
</script>

<template>
    <!-- Toast -->
    <div v-if="successMessage" class="toast toast-top toast-center">
        <div class="alert alert-success animate-fade-out">
            <svg xmlns="<http://www.w3.org/2000/svg>" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ successMessage }}</span>
        </div>
    </div>
</template>