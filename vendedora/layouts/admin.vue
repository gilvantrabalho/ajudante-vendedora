<template>
    <div class="fundo-admin position-absolute w-100 h-100">

        <nav class="navbar navbar-expand-lg navbar-dark p-2 shadow-sm nav-admin">
            <div class="container">
                <NuxtLink to="/admin/home" class="navbar-brand">
                    <i class="fw-bold">ADMIN</i>
                </NuxtLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item me-3">
                            <a aria-current="page" href="#"></a>
                            <NuxtLink to="/admin/home" class="nav-link active">
                                <i class="bi bi-house-door-fill"></i>
                                Home
                            </NuxtLink>
                        </li>
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-box-seam-fill"></i>
                                Produtos
                            </a>
                            <ul class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown">
                                <li>
                                    <NuxtLink to="/admin/produtos/produtos-falta" class="dropdown-item">
                                        Produtos em falta
                                    </NuxtLink>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-flex">

                        <div class="dropdown">
                            <div class="img-perfil" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img width="100%" src="https://v4.rancher.gestorbullaweb.com.br/images/user.png" alt="">
                            </div>
                            <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                button
                            </button> -->
                            <ul class="dropdown-menu animate__animated animate__fadeInUp border-0 shadow"
                                aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <h6 class="dropdown-header text-center">{{ this.$auth.user.name }}</h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item p-2" href="#">
                                        <i class="bi bi-person-fill"></i>
                                        Minha conta
                                    </a>
                                </li>
                                <!-- <li><a class="dropdown-item p-2" href="#">Another action</a></li> -->
                                <li>
                                    <a @click="logout" class="dropdown-item p-2" href="#">
                                        <i class="bi bi-power"></i>
                                        Sair
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <Nuxt />
    </div>
</template>

<style>
.fundo-admin {
    background-color: #F0F8FF;
}

.nav-link.active {
    font-weight: 500;
}

.bg-success,
.btn-success {
    background-color: #32CD32 !important;
    border: 1px solid #32CD32 !important;
}

a.nav-link {
    color: black;
}

.nav-admin {
    background-color: #FF69B4 !important;
    /* #FF1493, #40E0D0 */
}

.img-perfil {
    width: 50px;
    height: 50px;
    background-color: black;
    border-radius: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}
</style>

<script>
import 'animate.css';

export default {
    methods: {
        logout: async function () {
            await this.$auth.logout('local');
            this.$router.push('/');
        }
    }
}
</script>