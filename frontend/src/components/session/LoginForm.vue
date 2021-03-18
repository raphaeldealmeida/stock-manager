<template>
    <v-form
            ref="form"
            v-model="valid"
            lazy-validation
    >
        <v-text-field
                v-model="email"
                :rules="[rules.email]"
                label="E-mail"
                required
        ></v-text-field>
        <v-text-field
                v-model="password"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.required]"
                :type="showPassword ? 'text' : 'password'"
                name="password"
                label="Password"
                counter
                @click:append="showPassword = !showPassword"
        ></v-text-field>
        <v-btn
                class="mr-4"
                @click="submit"
        >
            login
        </v-btn>
        <v-btn @click="clear">
            clear
        </v-btn>
    </v-form>
</template>

<script>
    export default {
        name: "Login",
        data () {
            return {
                valid: false,
                email: '',
                showPassword: false,
                password: '',
                rules: {
                    email: v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                    required: value => !!value || 'Required.'
                },
            }
        },
        methods: {
            submit () {
                this.valid = false
                this.valid = this.$refs.form.validate()
                if(this.valid){
                    alert("Enviar");
                }
            },
            clear () {
                this.$refs.form.reset()
            },
        },
    }
</script>

<style scoped>

</style>