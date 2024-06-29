import { defineStore } from "pinia";

export const useLoginFormStore = defineStore('loginForm', {
        state: () =>({
            email: '',
            password: '',
            activeLoginDialog: false
        })
    }
)