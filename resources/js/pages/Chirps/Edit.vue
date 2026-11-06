<script setup>
    import Navbar from '../components/Navbar.vue';
    import Footer from '../components/Footer.vue';
    
    import { Link, useForm } from '@inertiajs/vue3'

    // Recibe el chirp que envía el controlador.
    const props = defineProps({
        chirp: {
            type: Object,
            required: true,
        },
    })

    // El formulario empieza con el texto actual.
    const form = useForm({
        text: props.chirp.text,
    })

    function updateChirp() {
        form.put(`/chirps/${props.chirp.id}`)
    }
</script>

<template>
    <Navbar />

    <main class="flex-1 container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold mt-8">Edit chirp</h1>
            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">
                    <form @submit.prevent="updateChirp">
                        <div class="form-control w-full">
                            <textarea
                                v-model="form.text"
                                class="textarea textarea-bordered w-full resize-none"
                                rows="4"
                                maxlength="255"
                                required
                            ></textarea>

                            <div class="label">
                                <span v-if="form.errors.text" class="text-red-600">
                                    {{ form.errors.text }}
                                </span>
                            </div>
                        </div>
                            
                        <div class="card-actions justify-between mt-4">
                            <Link href="/" class="btn btn-ghost btn-sm">
                                Cancel
                            </Link>
                            <button
                                type="submit"
                                class="btn btn-primary btn-sm"
                                :disabled="form.processing"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <Footer />
</template>