<template>
    <v-card
       class="py-4"
       color="surface-variant"
       image="https://cdn.vuetifyjs.com/docs/images/one/create/feature.png"
       prepend-icon="mdi-person"
       rounded="lg"
       variant="outlined"
   >
        <template #title>
            <h2 class="text-h5 font-weight-bold">Create a new user.</h2>
            <br>
        </template>
        <template #subtitle>
            <div class="text-subtitle-1">
                <v-form  ref="myForm" v-model="valid">
                    <v-text-field
                        :v-model="first_name"
                        clearable label="First Name"
                        :rules="[rules.required, rules.max(100)]"
                        required
                    >
                    </v-text-field>
                    <v-text-field
                        :v-model="last_name"
                        clearable label="Last Name"
                        :rules="[rules.required, rules.max(100)]"
                        required
                    >
                    </v-text-field>
                    <v-text-field
                        :v-model="email"
                        clearable label="Email"
                        :rules="[rules.max(100), rules.required, rules.emailMatch]"
                    >
                    </v-text-field>
                    <v-text-field
                        :v-model="phone_number"
                        clearable label="Phone Number"
                        :rules="[rules.required, rules.max(10)]"
                        required
                    >
                    </v-text-field>
                    <v-text-field 
                        :v-model="password"
                        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show ? 'text' : 'password'"
                        label="Password"
                        placeholder="Enter your password"
                        :rules="[rules.required, rules.min(8)]"
                        @click:append="(show = !show)"
                    >
                    </v-text-field>
                </v-form>
                <div class="d-flex flex-wrap ">
                    <v-btn
                        class="flex-grow-1 ma-2"
                        height="48"
                        variant="tonal"
                        to="/"
                    >
                        Sign In
                    </v-btn>
                    <v-btn
                        :loading="loadingSignIn"
                        class="flex-grow-1 ma-2"
                        height="48"
                        variant="tonal"
                        @click="save"
                        to="/register"
                    >
                        Register
                    </v-btn>
                </div>
            </div>
        </template>
    </v-card>
</template>


<script>
    import { ref } from 'vue';
    
    export default {
        setup() {
            const myForm = ref(null);
            
            let valid           =   false,
                email           =   "",
                password        =   "",
                last_name       =   "",
                first_name      =   "",
                phone_number    =   "", 
                show            =   false,
                loadingSignIn   =   false,
                rules   = {
                    required: value => !!value || 'Required.',
                    min(minNum) {
                        return v => (v || '').length >= minNum || `Min ${minNum} characters`;
                    },
                    emailMatch: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    },
                    max(maxNum) {
                        return v => (v || '').length <= maxNum || `Max ${maxNum} characters`;
                    }
                };

            function save() {
                loadingSignIn = true;
                myForm.value?.validate().then(({valid: isValid}) => {
                    console.log(isValid);
                })
                setTimeout(() => (loadingSignIn = false), 3000)
            };
            // ...
            return {
                myForm,
                valid,
                email,
                password,
                last_name,
                first_name,
                phone_number,
                show,
                loadingSignIn,
                rules,
                save
            }
        }
    }
</script>
  