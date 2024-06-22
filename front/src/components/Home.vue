<template>
    <v-container class="fill-height">
      <v-responsive
        class="align-centerfill-height mx-auto"
        max-width="900"
      >
        <v-img
          class="mb-4"
          height="150"
          src="@/assets/logo.png"
        />
  
        <div class="text-center">
          <div class="text-body-2 font-weight-light mb-n1">Welcome to</div>
  
          <h1 class="text-h2 font-weight-bold">User Administrator</h1>
        </div>
  
        <div class="py-4" />
  
        <v-row>
          <v-col cols="12">
            <router-view></router-view>
          </v-col>
        </v-row>
      </v-responsive>
    </v-container>
  </template>
  
  <script setup>
    let loading= false,
        load  = () => {
            loading = true;
            setTimeout(() => (loading = false), 3000);
            console.log('qwerty');
         };
    
  </script>
  