<template>
  <div class="s-header bg-header-purple py-4">
    <div class="container mx-auto">
      <div class="flex justify-between items-center relative">
        <div class="flex justify-start items-center">
          <div
            class="s-header-toggle w-5 block lg:hidden text-3xl md:mr-6 mr-4 cursor-pointer"
          >
            <i class="fas fa-bars"></i>
            <i class="fas fa-times hidden"></i>
          </div>
          <div class="s-header-logo mr-6">
            <a href="/">
              <img
                class="mx-auto w-auto"
                src="../../img/logo.jpg"
                alt="Kindergo Driveclub"
              />
            </a>
          </div>
          <ul
            class="s-header-list list-none m-0 border border-main-gray-light flex justify-start rounded-lg bg-white items-stretch hidden lg:flex"
          >
            <li
              class="lg:border-r border-main-gray-light lg:rounded-l-lg"
              :class="currentUrl.indexOf('trips') > -1 ? 'active' : ''"
            >
              <a
                href="/#/trips"
                class="px-5 py-3.5 block lg:rounded-l-lg hover:bg-header-blue transition duration-500 ease-in-out"
                >Поездки</a
              >
            </li>
            <li
              class="lg:border-r border-main-gray-light"
              :class="currentUrl.indexOf('timetables') > -1 ? 'active' : ''"
            >
              <a
                href="/#/timetables"
                class="px-5 py-3.5 block hover:bg-header-blue transition duration-500 ease-in-out"
                >Расписания</a
              >
            </li>
            <li
              class="lg:border-r border-main-gray-light"
              :class="currentUrl.indexOf('payments') > -1 ? 'active' : ''"
            >
              <a
                href="/#/payments"
                class="px-5 py-3.5 block hover:bg-header-blue transition duration-500 ease-in-out"
                >Платежи</a
              >
            </li>
            <li
              class="lg:border-r border-main-gray-light"
              :class="currentUrl.indexOf('children') > -1 ? 'active' : ''"
            >
              <a
                href="/#/children"
                class="px-5 py-3.5 block hover:bg-header-blue transition duration-500 ease-in-out"
                >Дети</a
              >
            </li>
            <li
              class="lg:border-r border-main-gray-light"
              :class="currentUrl.indexOf('attendants') > -1 ? 'active' : ''"
            >
              <a
                href="/#/attendants"
                class="px-5 py-3.5 block rounded-r-lg hover:bg-header-blue transition duration-500 ease-in-out"
                >Сопровождающие</a
              >
            </li>
          </ul>
        </div>
        <div class="flex">
          <div class="s-header-user relative" id="usernav">
            <img
              src="../../img/avatar.png"
              alt="img"
              class="block sm:w-user w-12 max-w-10"
              width="60"
              @click="openpop"
            />
            <div
              v-if="userpop === true"
              class="s-header-user-nav absolute right-0 top-16 bg-header-purple border-main-gray-light border text-main-gray-light w-40 divide-y divide-main-gray-light transition duration-500 ease-in-out"
            >
              <ul>
                <li>
                  <a
                    href="#"
                    class="block px-2 py-0.5 hover:bg-white transition duration-500 ease-in-out"
                    >Личный профиль</a
                  >
                </li>
                <li>
                  <a
                    href="/#/passwordchange"
                    class="block px-2 py-0.5 open-popup hover:bg-white transition duration-500 ease-in-out"
                    data-effect="mfp-zoom-in"
                    >Изменить пароль</a
                  >
                </li>
                <li>
                  <a
                    @click="logout"
                    class="block px-2 py-0.5 hover:bg-white transition duration-500 ease-in-out"
                    >Выйти</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";

export default defineComponent({
  name: "HeaderComponent",
  data() {
    return {
      userpop: false,
      currentUrl: window.location.hash
    };
  },
  setup() {},
  mounted() {},
  methods: {
    openpop() {
      this.userpop = !this.userpop;
    },
    logout() {
      localStorage.clear();
      this.$router.push("/");
    }
  }
});
</script>
