<template>
  <div class="s-page overflow-hidden">
    <header-component />
    <div class="s-about py-8">
      <div class="container mx-auto">
        <div class="border-b border-black">
          <h2 class="text-black text-2xl">Информация о сопровождающем</h2>
        </div>
        <div class="flex pt-8 justify-start flex-wrap md:flex-nowrap">
          <div class="w-full lg:w-3/5 md:w-4/5 order-2 md:order-1 pt-6 md:pt-0">
            <ul class="s-about-info text-black max-w-2xl md:pr-20 text-base">
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Имя</div>
                <div class="w-3/5 md:w-3/6">
                  <div class="text flex items-center">Елена</div>
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Фамилия</div>
                <div class="w-3/5 md:w-3/6">{{ attendant.firstname }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Отчество</div>
                <div class="w-3/5 md:w-3/6">{{ attendant.lastname }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Пол</div>
                <div class="w-3/5 md:w-3/6">{{ attendant.middle_name }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Марка автомобиля</div>
                <div class="w-3/5 md:w-3/6">{{ attendant.car_model }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Год автомобиля</div>
                <div class="w-3/5 md:w-3/6">{{ attendant.car_year }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Анкета</div>
                <div class="w-3/5 md:w-3/6">
                  <p>
                    {{ attendant.resume }}
                  </p>
                </div>
              </li>
            </ul>
          </div>
          <div class="w-full lg:w-2/5 md:w-1/5 order-1 md:order-2">
            <div class="s-about-avatar pr-4">
              <div class="font-bold pb-4 text-black">Фотография</div>
              <img
                v-if="attendant.media !== ''"
                :src="attendant.media"
                alt="img"
                class="block w-full max-w-15"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import HeaderComponent from "./HeaderComponent.vue";
import axios from "axios";
import { Attendant } from "../types/attendants";

export default defineComponent({
  name: "AttendantComponent",
  components: {
    HeaderComponent
  },
  setup() {
    const showParam = ref<boolean>(false);
    const attendant = ref<Attendant>({
      firstname: "",
      lastname: "",
      middle_name: "",
      car_model: "",
      car_year: "",
      gender: "",
      resume: "",
      media: ""
    });
    return { showParam, attendant };
  },
  mounted() {
    const auth = localStorage.getItem("token");
    const vm = this;
    const currentUrl = window.location.hash;
    axios
      .get(`/api/v1/${currentUrl.replace("#/", "")}`, {
        headers: {
          "Content-Type": "application/vnd.api+json",
          Accept: "application/vnd.api+json",
          Authorization: "Bearer " + auth
        }
      })
      .then(function (response: any) {
        vm.attendant.firstname = response.data.data.attributes.firstname;
        vm.attendant.lastname = response.data.data.attributes.lastname;
        vm.attendant.middle_name = response.data.data.attributes.middle_name;
        vm.attendant.car_year = response.data.data.attributes.car_year;
        vm.attendant.car_model = response.data.data.attributes.car_model;
        vm.attendant.gender = response.data.data.attributes.gender.description;
        vm.attendant.resume = response.data.data.attributes.resume;
        vm.attendant.media =
          response.data.data.attributes.media.length > 0
            ? response.data.data.attributes.media[0].url
            : "";
      })
      .catch(function (error) {
        console.log(error);
      });
  },
  methods: {
    show(param: boolean): void {
      this.showParam = param;
    }
  }
});
</script>
