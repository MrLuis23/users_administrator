<template>
    <v-card
        class="py-4"
        color="surface-variant"
        image="https://cdn.vuetifyjs.com/docs/images/one/create/feature.png"
        prepend-icon="mdi-login"
        rounded="lg"
        variant="outlined"
    >
  
        <template #title>
            <h2 class="text-h5 font-weight-bold">Login</h2>
        </template>
        <template #subtitle>
            <div class="text-subtitle-1">
                <v-form  ref="myForm" v-model="valid"  @submit.prevent="handleSubmit">
                    <v-text-field
                        v-model="form.email"
                        clearable label="Email"
                        :rules="[rules.required, rules.emailMatch]"
                    >
                    </v-text-field>
                    <v-text-field 
                        v-model="form.password"
                        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show ? 'text' : 'password'"
                        label="Password"
                        placeholder="Enter your password"
                        :rules="[rules.required, rules.min(8)]"
                        @click:append="(show = !show)"
                    >
                    </v-text-field>
                    <div class="d-flex flex-wrap ">
                        <v-btn
                            :loading="loadingSignIn"
                            class="flex-grow-1 ma-2"
                            height="48"
                            variant="tonal"
                            type="submit"
                            exact
                        >
                            Sign In
                        </v-btn>
                        <v-btn
                            class="flex-grow-1 ma-2"
                            height="48"
                            variant="tonal"
                            to="/register"
                            exact
                        >
                            Sign up
                        </v-btn>
                    </div>
                </v-form>
            </div>
        </template>
    </v-card>
</template>
  
<script>
    import AuthService from "../services/AuthService";
    import setAuthHeaders from "../utils/setAuthHeaders";
    import { reactive, ref } from 'vue';
    
    export default {
        setup() {
            const form = reactive({
                email: '',
                password:  '',
            }),
            myForm = ref(null);

            let valid           =   false,
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

            const handleSubmit = () => {
                
                const formData = new FormData();
                loadingSignIn = true;
                formData.append('email', form.email);
                formData.append('password', form.password);

                myForm.value?.validate()
                .then(({valid: isValid}) => {
                    if(!isValid) return; 
                    AuthService.login(formData)
                    .then(response => {
                        let data =  response.data.data;
                        console.log(data);
                        localStorage.setItem('jwt', data.token);
                        // this.submitted = true;
                    })
                    .catch(e => {
                        console.log(e);
                    });
                });
            };
            // ...
            return {
                form,
                myForm,
                valid,
                show,
                loadingSignIn,
                rules,
                handleSubmit
            }
        }
    }
</script>
  