<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <button v-if="authenticated" @click="logout">logout</button>
    </div>
    <router-view/>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex';

  export default {
    computed: {
      ...mapGetters({
        authenticated: 'authenticated'
      })
    },
    methods: {
      async logout() {
        this.loading = true;
        try {
          await this.$store.dispatch('logout');
          await this.$router.push({ name: 'Login' })
        } catch (error) {
          this.error = error;
        } finally {
          this.loading = false;
        }
      }
    }

  }
</script>
<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
