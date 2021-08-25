<template>
  <div class="s-page overflow-hidden">
    <header-component />
    <div class="s-about py-8">
      <div class="container mx-auto">
        <div class="border-b border-black">
          <h2 class="text-black text-2xl">
            Изменение информации вашего профиля
          </h2>
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
                <div class="font-bold w-2/5 md:w-3/6">Email</div>
                <div class="w-3/5 md:w-3/6">{{ email }}</div>
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
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">
                  Предпочитаемый пол сопровождающего
                </div>
                <div class="w-3/5 md:w-3/6">
                  <div class="select inline-flex">
                    <select
                      class="js-select"
                      name="type"
                      v-model="attendant_gender"
                    >
                      <option value=""></option>
                      <option value="Female">Женский</option>
                      <option value="Male">Мужчина</option>
                      <option value="Does not matter">Не важно</option>
                    </select>
                  </div>
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Ребенок 1</div>
                <div class="w-3/5 md:w-3/6">
                  <a
                    @click="onNavigate(child1.url.replace(base_url, ''))"
                    class="cursor-pointer text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                    >{{ child1.name }}</a
                  >
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Ребенок 2</div>
                <div class="w-3/5 md:w-3/6">
                  <a
                    @click="onNavigate(child2.url.replace(base_url, ''))"
                    class="cursor-pointer text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                    >{{ child2.name }}</a
                  >
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Ребенок 3</div>
                <div class="w-3/5 md:w-3/6">
                  <a
                    @click="onNavigate(child3.url.replace(base_url, ''))"
                    class="cursor-pointer text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                    >{{ child3.name }}</a
                  >
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Ребенок 4</div>
                <div class="w-3/5 md:w-3/6">
                  <a
                    @click="onNavigate(child4.url.replace(base_url, ''))"
                    class="cursor-pointer text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                    >{{ child4.name }}</a
                  >
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
                  @click="onNavigate('/lk')"
                  class="cursor-pointer s-about-btn group relative inline-flex justify-center w-28 px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-btn-bg font-bold transition duration-500 ease-in-out hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-blue-400 text-sm border border-btn-border"
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
                <form action="#">
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
                </form>
              </div>
              <div class="py-3" v-if="fileid !== ''">
                <span>файл выбран</span>
                <i
                  class="fas fa-times pl-2 cursor-pointer"
                  @click="removefile"
                ></i>
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
import { base_url } from "../data";

export default defineComponent({
  name: "LkEditComponent",
  components: {
    HeaderComponent
  },
  setup() {
    const id = ref<string>("");
    const firstname = ref<string>("");
    const lastname = ref<string>("");
    const middle_name = ref<string>("");
    const email = ref<string>("");
    const attendant_gender = ref<string>("");
    const phone = ref<string>("");
    const otherphone = ref<string>("");
    const media = ref<string>("");
    const child1 = ref<object>({
      name: "",
      url: ""
    });
    const child2 = ref<object>({
      name: "",
      url: ""
    });
    const child3 = ref<object>({
      name: "",
      url: ""
    });
    const child4 = ref<object>({
      name: "",
      url: ""
    });
    const fileid = ref<string>("");

    return {
      id,
      firstname,
      lastname,
      middle_name,
      email,
      attendant_gender,
      phone,
      otherphone,
      media,
      child1,
      child2,
      child3,
      child4,
      fileid,
      base_url
    };
  },
  mounted() {
    this.getData("/api/v1/users/me?include=children");
  },
  methods: {
    onNavigate(url: string): void {
      this.$router.push(url);
    },
    getData(url: string) {
      const auth = localStorage.getItem("token");
      const vm = this;
      let children: Array<any> = [];
      axios
        .get(url, {
          headers: {
            "Content-Type": "application/vnd.api+json",
            Accept: "application/vnd.api+json",
            Authorization: "Bearer " + auth
          }
        })
        .then(function (response: any) {
          if (response.data.included) {
            response.data.included.forEach((item: any) => {
              if (item && item.type === "children") {
                children.push(item);
              }
            });
          }
          vm.id = response.data.data.id;
          vm.firstname = response.data.data.attributes.firstname;
          vm.lastname = response.data.data.attributes.lastname;
          vm.middle_name = response.data.data.attributes.middle_name;
          vm.email = response.data.data.attributes.email;
          vm.phone = response.data.data.attributes.phone;
          vm.otherphone = response.data.data.attributes.otherphone;
          vm.attendant_gender =
            response.data.data.attributes.attendant_gender.value;
          vm.media =
            response.data.data.attributes.media.length > 0
              ? response.data.data.attributes.media[0].url
              : "";
          vm.child1 =
            children.length > 0
              ? {
                  name:
                    children[0].attributes.firstname +
                    " " +
                    children[0].attributes.lastname,
                  url: children[0].links.self
                }
              : { name: "", url: "" };
          vm.child2 =
            children.length > 1
              ? {
                  name:
                    children[1].attributes.firstname +
                    " " +
                    children[1].attributes.lastname,
                  url: children[1].links.self
                }
              : { name: "", url: "" };
          vm.child3 =
            children.length > 3
              ? {
                  name:
                    children[3].attributes.firstname +
                    " " +
                    children[3].attributes.lastname,
                  url: children[3].links.self
                }
              : { name: "", url: "" };
          vm.child4 =
            children.length > 4
              ? {
                  name:
                    children[4].attributes.firstname +
                    " " +
                    children[4].attributes.lastname,
                  url: children[4].links.self
                }
              : { name: "", url: "" };
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    update(): void {
      const vm = this;
      const auth = localStorage.getItem("token");
      const body = {
        data: {
          type: "users",
          id: this.id,
          attributes: {
            email: this.email,
            firstname: this.firstname,
            lastname: this.lastname,
            middle_name: this.lastname,
            phone: this.phone,
            attendant_gender: this.attendant_gender,
            file: this.fileid
          }
        }
      };
      axios
        .patch("/api/v1/users/" + this.id, body, {
          headers: {
            "Content-Type": "application/vnd.api+json",
            Accept: "application/vnd.api+json",
            Authorization: "Bearer " + auth
          }
        })
        .then(function (response: any) {
          document.location = <any>"/lk";
        })
        .catch(function (error) {
          console.log(error.response.data);
          document.location = <any>"/lk";
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
    },
    removefile() {
      this.fileid = "";
    }
  }
});
</script>
