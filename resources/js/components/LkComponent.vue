<template>
  <div class="s-page overflow-hidden">
    <header-component />
    <div class="s-about py-8">
      <div class="container mx-auto">
        <div class="border-b border-black">
          <h2 class="text-black text-2xl">Информация вашего профиля</h2>
        </div>
        <div class="flex pt-8 justify-start flex-wrap md:flex-nowrap">
          <div class="w-full lg:w-1/2 md:w-4/5 order-2 md:order-1 pt-6 md:pt-0">
            <ul class="s-about-info text-black max-w-2xl pr-6">
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Имя</div>
                <div class="w-3/5 md:w-3/6">
                  <div class="text flex items-center">{{ lk.firstname }}</div>
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Фамилия</div>
                <div class="w-3/5 md:w-3/6">{{ lk.lastname }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Отчество</div>
                <div class="w-3/5 md:w-3/6">{{ lk.middle_name }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Email</div>
                <div class="w-3/5 md:w-3/6">{{ lk.email }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Телефон</div>
                <div class="w-3/5 md:w-3/6">{{ lk.phone }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Другой тел</div>
                <div class="w-3/5 md:w-3/6">{{ lk.otherphone }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">
                  Предпочитаемый пол сопровождающего
                </div>
                <div class="w-3/5 md:w-3/6">{{ lk.attendant_gender }}</div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Ребенок 1</div>
                <div class="w-3/5 md:w-3/6">
                  <a
                    :href="lk.child1.url.replace(base_url, '#')"
                    class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                    >{{ lk.child1.name }}</a
                  >
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Ребенок 2</div>
                <div class="w-3/5 md:w-3/6">
                  <a
                    :href="lk.child2.url.replace(base_url, '#')"
                    class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                    >{{ lk.child2.name }}</a
                  >
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Ребенок 3</div>
                <div class="w-3/5 md:w-3/6">
                  <a
                    :href="lk.child3.url.replace(base_url, '#')"
                    class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                    >{{ lk.child3.name }}</a
                  >
                </div>
              </li>
              <li class="block sm:flex mb-6">
                <div class="font-bold w-2/5 md:w-3/6">Ребенок 4</div>
                <div class="w-3/5 md:w-3/6">
                  <a
                    :href="lk.child4.url.replace(base_url, '#')"
                    class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                    >{{ lk.child4.name }}</a
                  >
                </div>
              </li>
            </ul>
          </div>
          <div class="w-full lg:w-1/2 md:w-1/5 order-1 md:order-2">
            <div class="s-about-avatar pr-4">
              <div class="font-bold pb-4 text-black">Фотография</div>
              <img
                src="../../img/lk-img1.jpg"
                alt="img"
                class="block max-w-15 w-full"
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
import { Lk } from "../types/lk";
import { base_url } from "../data";

export default defineComponent({
  name: "LkComponent",
  components: {
    HeaderComponent
  },
  setup() {
    const lk = ref<Lk>({
      firstname: "",
      lastname: "",
      middle_name: "",
      email: "",
      phone: "",
      otherphone: "",
      attendant_gender: "",
      child1: {
        name: "",
        url: ""
      },
      child2: {
        name: "",
        url: ""
      },
      child3: {
        name: "",
        url: ""
      },
      child4: {
        name: "",
        url: ""
      }
    });
    const links = ref<object>({});
    const current_page = ref<number>(0);
    return { lk, links, current_page, base_url };
  },
  mounted() {
    this.getData("/api/v1/users/me?include=children");
  },
  methods: {
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
          vm.lk.firstname = response.data.data.attributes.firstname;
          vm.lk.lastname = response.data.data.attributes.lastname;
          vm.lk.middle_name = response.data.data.attributes.middle_name;
          vm.lk.email = response.data.data.attributes.email;
          vm.lk.phone = response.data.data.attributes.phone;
          vm.lk.otherphone = response.data.data.attributes.otherphone;
          vm.lk.attendant_gender =
            response.data.data.attributes.attendant_gender.description;
          vm.lk.child1 =
            children.length > 0
              ? {
                  name:
                    children[0].attributes.firstname +
                    " " +
                    children[0].attributes.lastname,
                  url: children[0].links.self
                }
              : { name: "", url: "" };
          vm.lk.child2 =
            children.length > 1
              ? {
                  name:
                    children[1].attributes.firstname +
                    " " +
                    children[1].attributes.lastname,
                  url: children[1].links.self
                }
              : { name: "", url: "" };
          vm.lk.child3 =
            children.length > 3
              ? {
                  name:
                    children[3].attributes.firstname +
                    " " +
                    children[3].attributes.lastname,
                  url: children[3].links.self
                }
              : { name: "", url: "" };
          vm.lk.child4 =
            children.length > 4
              ? {
                  name:
                    children[4].attributes.firstname +
                    " " +
                    children[4].attributes.lastname,
                  url: children[4].links.self
                }
              : { name: "", url: "" };

          vm.links = Object.assign({}, response.data.links);
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }
});
</script>
