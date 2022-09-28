<template>
    <div class="fundo-cliente">

        <nav class="nav-client navbar navbar-expand-lg navbar-light p-2 shadow-sm">
            <div class="container">
                <NuxtLink to="/home" class="navbar-brand">Navbar</NuxtLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a aria-current="page" href="#"></a>
                            <NuxtLink to="/home" class="nav-link">Home</NuxtLink>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Notificar
                            </a>
                            <ul class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown">
                                <li>
                                    <NuxtLink to="/notificar/produtos-falta" class="dropdown-item">Produtos em falta
                                    </NuxtLink>
                                </li>
                                <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li> -->
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

                    <!-- <div class="d-flex">
                        <div class="m-2"><strong>Olá</strong>, {{ this.$auth.user.name }}</div>
                        <button @click="logout" class="btn btn-light">Sair</button>
                    </div> -->
                </div>
            </div>
        </nav>

        <Nuxt />
    </div>
</template>

<style>
.fundo-cliente {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #18191A;
}

body {
    background-color: var(--bg-fundo) !important;
}

.bg-success,
.btn-success {
    background-color: #32CD32 !important;
    border: 1px solid #32CD32 !important;
}

.nav-client {
    background-color: #242526;
    color: #CFCFCF;
}

.nav-link,
.navbar-brand {
    color: #CFCFCF !important;
    /* font-weight: 500; */
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
export default {
    methods: {
        logout: async function () {
            await this.$auth.logout('local');
            this.$router.push('/');
        }
    }
}
</script>