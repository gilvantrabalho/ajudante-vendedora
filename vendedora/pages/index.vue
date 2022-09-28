<template>
  <div>
    <h3 class="pb-3 text-center">LOGIN</h3>
    <hr>
    <form @submit.prevent="submit" class="form-login pt-3" action="">
      <Input v-model="user.username" icon="bi bi-person-circle" type="text" placeholder="Username..." />
      <Input v-model="user.password" icon="bi bi-key-fill" type="password" placeholder="Senha..." />
      <ButtonBlock :loading="loading" title="ENTRAR" type="submit" />
    </form>
    <div class="text-center p-3 mt-3">
      <NuxtLink to="/register">
        <h6>CADASTRAR</h6>
      </NuxtLink>
    </div>
  </div>
</template>

<style>
.form-login {
  width: 350px;
}

@media only screen and (max-width: 505px) {
  .form-login {
    width: 250px !important;
  }
}
</style>

<script>
import Input from '../components/form/Input.vue';
import ButtonBlock from '../components/buttons/ButtonBlock.vue';
export default {
  middleware: 'isAuthenticated',
  name: "IndexPage",
  layout: "auth",
  components: { Input, ButtonBlock },
  data() {
    return {
      loading: false,
      user: {
        username: null,
        password: null
      }
    }
  },
  methods: {
    submit: async function () {
      if (this.user.username && this.user.password) {
        this.loading = true;
        let response = await this.$auth.loginWith('local', { data: this.user })
        if (!response.data.error) {
          this.$router.push('/home')
        } else {
          this.$notify.error({
            title: 'Ops!',
            message: 'Erro ao tentar fazer login. Tente novamente!'
          });
        }
        this.loading = false;
      } else {
        this.$notify.warning({
          title: 'Ops!',
          message: 'Inform todos os campos!'
        });
      }
    }
  }
}
</script>
