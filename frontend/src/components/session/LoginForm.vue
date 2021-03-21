<template>
  <v-container>
    <v-row>
      <v-col
          class="text-xs-center"
          cols="6"
          offset="3"
      >
        <v-card

        >
        <v-card-title>
          Login
        </v-card-title>
        <v-card-text>
          <v-form
              ref="form"
              v-model="valid"
              lazy-validation
          >
            <p v-if="error" style="color:red">{{ error }}</p>
            <v-text-field
                v-model="user.email"
                :rules="[rules.email]"
                label="E-mail"
                name="email"
                required
            ></v-text-field>
            <v-text-field
                v-model="user.password"
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
        </v-card-text>
      </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
    export default {
        name: "Login",
        data () {
            return {
                error: false,
                valid: false,
                user: {
                  email: 'admin@admin.com',
                  password: '12345678',
                },
                showPassword: false,
                rules: {
                    email: v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                    required: value => !!value || 'Required.'
                },
            }
        },
        methods: {
            async submit () {
                this.valid = false
                this.valid = this.$refs.form.validate()
                if(this.valid){
                  try {
                    await this.$store.dispatch('login', this.user);
                    await this.$router.push({ name: 'Products' });
                  } catch (error) {
                    this.error = error;
                    alert(error)
                  }
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