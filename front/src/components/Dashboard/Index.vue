<template >
    <v-card 
    class="bg-white">
        <v-layout>
            <Aside class="bg-white"></Aside>
            <v-main style="height: 100vh">
                <HeaderBar/>
                <router-view/>
            </v-main>
        </v-layout>
    </v-card>
</template>
<script setup>
</script>