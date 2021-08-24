<template>
  <div
    class="min-h-screen flex items-center justify-center bg-white py-12 px-4 sm:px-6 lg:px-8 s-login"
  >
    <div class="max-w-md w-full space-y-4">
      <div>
        <img
          class="mx-auto w-auto"
          src="../../img/logo.jpg"
          alt="Kindergo Driveclub"
        />
      </div>
      <div
        class="s-login-form border border-main-gray max-w-xs mx-auto p-4 pb-10"
      >
        <p class="text-main-gray-light text-sm tracking-tight mb-0.5">
          Вход в личный кабинет
        </p>
        <div class="line border-b-2 border-main-blue-light"></div>
        <form ref="form">
          <div class="mt-3 d-block">
            <label for="email-address" class="text-main-gray-light text-sm"
              >Email:</label
            >
            <input
              id="email-address"
              name="email"
              type="email"
              autocomplete="email"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-main-gray placeholder-gray-500 text-sm text-main-gray-light focus:outline-none focus:border-main-blue-light focus:z-10 transition duration-500 ease-in-out"
              placeholder=""
              v-model="email"
            />
          </div>
          <div class="mt-3">
            <label for="password" class="text-main-gray-light text-sm"
              >Пароль:</label
            >
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-main-gray placeholder-gray-500 text-main-gray-light focus:outline-none focus:border-main-blue-light focus:z-10 text-sm transition duration-500 ease-in-out"
              placeholder=""
              v-model="password"
            />
          </div>
          <div class="mt-3 ml-2">
            <button
              type="button"
              class="group text-lg relative flex justify-center px-4 border border-transparent text-sm font-medium rounded-md text-white bg-main-blue-medium font-bold transition duration-500 ease-in-out hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-blue-400"
              @click="submit"
            >
              Войти
            </button>
          </div>
        </form>
        <div class="mt-3">
          <div class="text-sm mb-1">
            <a
              href="/#/passwordchange"
              class="font-normal transition duration-500 ease-in-out underline text-main-purple-medium hover:text-indigo-500 text-sm open-popup"
              data-effect="mfp-zoom-in"
            >
              Забыли пароль?
            </a>
          </div>
          <div class="line border-b-2 border-main-blue-light"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import axios from "axios";

export default defineComponent({
  name: "LoginComponent",
  setup() {
    const email = ref("admin@admin.com");
    const password = ref<number | string>("password");

    return { email, password };
  },
  mounted() {},
  methods: {
    submit(): void {
      const vm = this;
      axios
        .post(
          "/api/v1/login",
          {
            email: this.email,
            password: this.password
          },
          {
            headers: {
              "Content-Type": "application/vnd.api+json",
              Accept: "application/vnd.api+json"
            }
          }
        )
        .then(function (response: any) {
          localStorage.setItem("token", response.data.token);
          vm.$router.push("/trips");
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }
});
</script>
