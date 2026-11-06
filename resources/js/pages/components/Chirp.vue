<script setup>
    import { useForm } from '@inertiajs/vue3';

    defineProps({
        chirps: {
            type: Array,
            default: () => [],
        },
    });

    const form = useForm ({});

    function editChirp (chirp) {
        if (!chirp.created_at || !chirp.updated_at) {
            return false

        } else {

            const created = new Date(chirp.created_at).getTime()
            const updated = new Date(chirp.updated_at).getTime()
    
            return updated > created + 5000
        }

    }

    function deleteChirp(id) {
        form.delete(`/chirps/${id}`)
    }

</script>
<template>

    <div v-for="chirp in chirps" class="card bg-base-100 shadow mb-4 space-y-4 mt-8">
        <div class="card-body">
            <div class="flex space-x-3">
                <div v-if="chirp.user?.name" style="align-self: center;">
                    <div class="avatar">
                        <div class="size-10 rounded-full">
                            <img :src="`https://avatars.laravel.cloud/${ encodeURIComponent(chirp.user.email)}`" :alt="`${ chirp.user?.name }'s avatar`" class="rounded-full" />
                        </div>
                    </div>
                </div>
                <div v-else class="avatar placeholder"> 
                    <div class="size-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth" alt="Anonymous User" class="rounded-full" />
                    </div>
                </div>
                
                
                <div class="min-w-0 flex-1">
                    <div class="flex justify-between w-full">

                        <div class="flex items-center gap-1">
                            <span class="text-sm font-semibold">{{ chirp.user?.name ?? 'Anónimo' }}</span>
                            <span class="text-base-content/60 pr-1 pl-1"> · </span>
                            <span class="text-sm text-base-content/60">
                                <time :datetime="chirps.created_at">
                                    {{ chirp.prettyDate }}
                                </time>
                            </span>
                        </div>
                        
                        <div class="flex gap-1">
                            <a :href="`/chirps/${chirp.id}/edit`" class="btn btn-ghost btn-xs">
                                Edit
                            </a>
                            <button type="button"
                            @click="deleteChirp(chirp.id)"
                            onclick="return confirm('Are you sure you want to delete this chirp?')"
                            class="btn btn-ghost btn-xs text-error"
                            :disabled="form.processing">
                            Delete
                        </button>
                    </div>
                </div>

                <div class="flex items-center mt-1">
                    <span class="flex-basis-xs">{{ chirp.text }}</span>
                    <span v-if="editChirp(chirp) ">
                        <span class="text-sm text-base-content/60 pr-1 pl-2"> · </span>
                        <span class="text-sm text-base-content/60 italic">edited </span>
                    </span>
                </div>

                </div>
            </div>
        </div>
    </div>

</template>