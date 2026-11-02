<script setup>
    import Navbar from './components/Navbar.vue';
    import Footer from './components/Footer.vue';
    import Layout from './components/Layout.vue';

    defineProps({
        chirps: {
            type: Array,
            default: () => [],
        },
    });
</script>
<template>

    <Navbar />

    <Layout :chirps="chirps" />

    <Footer />

</template>