<template>
    <v-navigation-drawer
    location="right"
    permanent
    theme="dark"
    >
    <template v-slot:prepend>
        <v-list-item
        lines="two"
        prepend-avatar="https://randomuser.me/api/portraits/women/81.jpg"
        subtitle="Logged in"
        title="Jane Smith"
        ></v-list-item>
    </template>

    <v-divider></v-divider>

    <v-list density="compact" nav class="bg-dark-gray">
        <v-list-item 
            prepend-icon="mdi-home-city"
            title="Home"
            value="home"
        ></v-list-item>
        <v-list-item
            prepend-icon="mdi-account"
            title="My Account"
            value="account"
        >
        </v-list-item>
        <v-list-item
            prepend-icon="mdi-account-group-outline"
            title="Users"
            value="users"
            to="/dashboard/users"
        >
        </v-list-item>
    </v-list>
    </v-navigation-drawer>
</template>