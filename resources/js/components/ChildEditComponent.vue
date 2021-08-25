<template>
  <div class="s-page overflow-hidden">
    <header-component />
    <div class="s-about py-8">
      <div class="container mx-auto">
        <div class="border-b border-black">
          <h2 class="text-black text-2xl">Изменение информации о ребенке</h2>
        </div>
        <div class="flex pt-8 justify-start flex-wrap md:flex-nowrap">
          <div class="w-full lg:w-1/2 md:w-4/5 order-2 md:order-1 pt-6 md:pt-0">
            <ul class="s-about-info text-black max-w-2xl pr-6">
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Имя</div>
                <div class="w-3/5 md:w-3/6">
                  <div class="input inline-flex">
                    <input
                      type="text"
                      name="name"
                      class="block border border-main-gray outline-none px-2 h-8 text-black"
                      v-model="firstname"
                    />
                  </div>
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Фамилия</div>
                <div class="w-3/5 md:w-3/6">
                  <div class="input inline-flex">
                    <input
                      type="text"
                      name="fname"
                      class="block border border-main-gray outline-none px-2 h-8 text-black"
                      v-model="lastname"
                    />
                  </div>
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Отчество</div>
                <div class="w-3/5 md:w-3/6">
                  <div class="input inline-flex">
                    <input
                      type="text"
                      name="lname"
                      class="block border border-main-gray outline-none px-2 h-8 text-black"
                      v-model="middle_name"
                    />
                  </div>
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Дата рождения</div>
                <div class="w-3/5 md:w-3/6">
                  {{
                    ("0" + new Date(birthday).getDate()).substr(-2) +
                    "." +
                    ("0" + (new Date(birthday).getMonth() + 1)).substr(-2) +
                    "." +
                    new Date(birthday).getFullYear()
                  }}
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Пол</div>
                <div class="w-3/5 md:w-3/6">
                  <div class="select inline-flex">
                    <select class="js-select" name="type" v-model="gender">
                      <option value=""></option>
                      <option value="Female">Женский</option>
                      <option value="Male">Мужчина</option>
                      <option value="Does not matter">Не важно</option>
                    </select>
                  </div>
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Телефон</div>
                <div class="w-3/5 md:w-3/6">
                  <div class="input inline-flex">
                    <input
                      type="text"
                      name="phone1"
                      class="block border border-main-gray outline-none px-2 h-8 text-black"
                      v-model="phone"
                    />
                  </div>
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Другой тел</div>
                <div class="w-3/5 md:w-3/6">
                  <div class="input inline-flex">
                    <input
                      type="text"
                      name="phone2"
                      class="block border border-main-gray outline-none px-2 h-8 text-black"
                      v-model="otherphone"
                    />
                  </div>
                </div>
              </li>
            </ul>
            <div class="md:mt-20 mt-8 flex">
              <div class="mr-8">
                <a
                  @click="update"
                  class="cursor-pointer s-about-btn group relative inline-flex justify-center w-28 px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-btn-green font-bold transition duration-500 ease-in-out hover:bg-btn-green-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-btn-green-hover text-sm border border-btn-border-green"
                >
                  Сохранить
                </a>
              </div>
              <div>
                <a
                  :href="'/#/children/' + id"
                  class="s-about-btn group relative inline-flex justify-center w-28 px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-btn-bg font-bold transition duration-500 ease-in-out hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-blue-400 text-sm border border-btn-border"
                >
                  Отмена
                </a>
              </div>
            </div>
          </div>
          <div class="w-full lg:w-1/2 md:w-1/5 order-1 md:order-2">
            <div class="s-about-avatar pr-4">
              <div class="flex">
                <div class="font-bold pb-4 text-black mr-4">Фотография</div>

                <div class="input-file-container">
                  <input
                    class="input-file"
                    id="my-file"
                    type="file"
                    @change="fileUpload($event)"
                  />
                  <label tabindex="0" for="my-file" class="input-file-trigger"
                    ><img src="../../img/icon-edit.png" alt="img" width="20"
                  /></label>
                </div>
              </div>
              <img
                v-if="media !== ''"
                :src="media"
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
import { Child } from "../types/children";

export default defineComponent({
  name: "ChildEditComponent",
  components: {
    HeaderComponent
  },
  setup() {
    const id = ref<string>("");
    const firstname = ref<string>("");
    const lastname = ref<string>("");
    const middle_name = ref<string>("");
    const birthday = ref<string>("");
    const gender = ref<string>("");
    const phone = ref<string>("");
    const otherphone = ref<string>("");
    const media = ref<string>("");
    const fileid = ref<string>("");
    return {
      id,
      firstname,
      lastname,
      middle_name,
      birthday,
      gender,
      phone,
      otherphone,
      media,
      fileid
    };
  },
  mounted() {
    const auth = localStorage.getItem("token");
    const vm = this;
    const currentUrl = window.location.hash.split("/");
    this.id = currentUrl[currentUrl.length - 1];
    axios
      .get(`/api/v1/children/${this.id}`, {
        headers: {
          "Content-Type": "application/vnd.api+json",
          Accept: "application/vnd.api+json",
          Authorization: "Bearer " + auth
        }
      })
      .then(function (response: any) {
        vm.firstname = response.data.data.attributes.firstname;
        vm.lastname = response.data.data.attributes.lastname;
        vm.middle_name = response.data.data.attributes.middle_name;
        vm.birthday = response.data.data.attributes.birthday;
        vm.gender = response.data.data.attributes.gender.value;
        vm.phone = response.data.data.attributes.phone;
        vm.otherphone = response.data.data.attributes.otherphone;
        vm.media =
          response.data.data.attributes.media.length > 0
            ? response.data.data.attributes.media[0].url
            : "";
      })
      .catch(function (error) {
        console.log(error);
      });
  },
  methods: {
    update(): void {
      const vm = this;
      const auth = localStorage.getItem("token");
      const body = {
        data: {
          type: "children",
          id: this.id,
          attributes: {
            firstname: this.firstname,
            lastname: this.lastname,
            middle_name: this.middle_name,
            birthday:
              new Date(this.birthday).getFullYear() +
              "-" +
              ("0" + (new Date(this.birthday).getMonth() + 1)).substr(-2) +
              "-" +
              ("0" + new Date(this.birthday).getDate()).substr(-2),
            gender: this.gender,
            phone: this.phone,
            otherphone: this.otherphone,
            crmid: "25x685",
            file: this.fileid
          }
        }
      };
      axios
        .patch("/api/v1/children/" + this.id, body, {
          headers: {
            "Content-Type": "application/vnd.api+json",
            Accept: "application/vnd.api+json",
            Authorization: "Bearer " + auth
          }
        })
        .then(function (response: any) {
          document.location = <any>`/#/children/${vm.id}`;
        })
        .catch(function (error) {
          console.log(error.response.data);
          document.location = <any>`/#/children/${vm.id}`;
        });
    },
    fileUpload(e: any) {
      const vm = this;
      const auth = localStorage.getItem("token");
      let requestData = new FormData();
      requestData.append("file_upload", e.target.files[0]);

      axios
        .post("/api/v1/upload", requestData, {
          headers: {
            "Content-Type": "application/vnd.api+json",
            Accept: "application/vnd.api+json",
            Authorization: "Bearer " + auth
          }
        })
        .then((res: any) => {
          vm.fileid = res.data;
          console.log(res.data);
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }
});
</script>
