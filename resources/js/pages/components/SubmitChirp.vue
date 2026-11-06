<script setup>

    import { useForm } from '@inertiajs/vue3';


    const form = useForm ({
        text: '',
    })

    function submitChirp() {
        form.post('/chirps', {
            onSuccess: () => {
                form.reset('text')}
        })
    }

    

</script>

<template>

    <!-- Chirp Form -->
    <div class="card bg-base-100 shadow mt-8">
        <div class="card-body">
            <form @submit.prevent="submitChirp" >
                <div class="form-control w-full">
                    <textarea
                        v-model="form.text"
                        name="text"
                        placeholder="What's on your mind?"
                        class="textarea textarea-bordered w-full resize-none"
                        rows="4"
                        maxlength="255"
                    ></textarea>

                    <p v-if="form.errors.text" class="text-red-600">
                        {{ form.errors.text }}
                    </p>
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <button
                        type="submit"
                        class="btn btn-primary btn-sm"
                        :disabled="form.processing">
                        Chirp
                    </button>
                </div>
            </form>
        </div>
    </div>
    
</template>