<template>
  <div>
    <h3 class="pb-3 text-center">REGISTER</h3>
    <hr>
    <form @submit.prevent="submit" class="form-login pt-3" action="">
      <Input v-model="user.name" icon="bi bi-person-fill" type="text" placeholder="Seu nome..." />
      <Input v-model="user.username" icon="bi bi-person-circle" type="text" placeholder="Username..." />
      <Input v-model="user.password" icon="bi bi-key-fill" type="password" placeholder="Senha..." />
      <Input v-model="user.c_password" icon="bi bi-key-fill" type="password" placeholder="Confirme senha..." />
      <ButtonBlock :loading="loading" title="CADASTRAR" type="submit" />
    </form>
    <div class="text-center p-3 mt-3">
      <NuxtLink to="/">
        <h6>LOGIN</h6>
      </NuxtLink>
    </div>
  </div>
</template>

<style>
.form-login {
  width: 350px;
}
</style>

<script>
import Input from '../components/form/Input.vue';
import ButtonBlock from '../components/buttons/ButtonBlock.vue';
export default {
  name: "IndexPage",
  layout: "auth",
  middleware: 'isAuthenticated',
  components: { Input, ButtonBlock },
  data() {
    return {
      user: {
        name: null,
        username: null,
        password: null,
        c_password: null
      },
      loading: false
    }
  },
  methods: {
    submit: function () {
      if (this.user.username && this.user.password) {
        if (this.user.password === this.user.c_password) {
          this.loading = true;
          this.$axios.post('/auth/register', this.user)
            .then(res => {
              if (!res.data.error) {
                this.$notify.success({
                  title: 'Sucesso!',
                  message: res.data.response.message
                })
                setTimeout(() => {
                  this.$router.push('/');
                }, 1500)
              } else {
                this.$notify.warning({
                  title: 'Ops',
                  message: res.data.response.message
                });
              }
            })
            .catch(error => {
              console.log(error)
            })
            .then(() => {
              this.loading = false;
            });
        } else {
          this.$notify.warning({
            title: 'Ops',
            message: 'Senhas não são iguais!'
          });
        }
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
