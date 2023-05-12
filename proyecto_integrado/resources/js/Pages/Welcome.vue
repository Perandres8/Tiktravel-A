<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

</script>

<template>
    <Head title="Welcome"/>

    <div id="fondo" class="flex flex-col relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100">
        <div class="pb-6">
            <h1 id="animacion" class="text-9xl justify-center flex text-white"><img src="../../assets/t.png" alt="logo" class="w-32"> <p id="text">Tik Travel</p></h1>
        </div>

        <div v-if="canLogin">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Volver
            </Link>

            <template v-else>
                <Link :href="route('login')" id="animacion" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    ACCESO
                </Link>

                <Link v-if="canRegister" :href="route('register')" id="animacion" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    REGISTRO
                </Link>
            </template>
        </div>

    </div>
</template>

<style>
#fondo {
    background-image: url('../../assets/f3.jpg');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    
    animation: image 5s infinite alternate;
  }

  #animacion {
    animation: anim-lineUp 4s;
  }
  @keyframes anim-lineUp {
    0% {
      opacity: 0;
      transform: translateY(0%);
    }
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }

  #text {
    font-family: 'Lobster';
  }

</style>
