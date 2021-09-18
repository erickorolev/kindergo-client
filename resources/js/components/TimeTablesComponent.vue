<template>
  <div class="s-page overflow-hidden">
    <header-component />
    <div class="s-trips py-8">
      <div class="container mx-auto">
        <div class="flex justify-between items-center s-trips-top">
          <div>
            <h2 class="text-black text-2xl">Ваши расписания</h2>
          </div>
        </div>
        <div class="s-trips-table pt-8">
          <div class="divide-y divide-black border-t border-black border-b">
            <div>
              <div class="s-trips-table-head flex-nowrap flex font-bold py-1.5">
                <div class="px-3.5 w-80">Откуда</div>
                <div class="px-3.5 w-80">Куда</div>
                <div class="px-3.5 w-64 text-center">
                  Количество <br />поездок
                </div>
                <div class="pl-3.5 w-64">Статус</div>
              </div>
            </div>
            <div
              v-for="(item, key) in schedules"
              :key="key"
              class="hover:bg-header-blue transition duration-500 ease-in-out s-trops-table-linewrap"
            >
              <a
                @click="onNavigate('/timetables/' + item.id)"
                class="cursor-pointer s-trips-table-line flex-nowrap flex py-3"
              >
                <span class="px-3.5 w-80">{{ item.name }}</span>
                <span class="px-3.5 w-80">{{ item.where_address }}</span>
                <span class="px-3.5 w-64 text-center">{{ item.trips }}</span>
                <span class="pl-3.5 w-64">{{ item.status }}</span>
              </a>
            </div>
          </div>
        </div>
        <div class="flex justify-end items-center pt-12">
          <div
            class="s-trips-nav flex justify-start text-center text-base items-stretch"
          >
            
            <a
              v-if="links.prev"
              @click="getData(links.prev)"
              class="arrow-left block border-nav-gray-light border flex-initial rounded-l-md hover:border-main-gray-light transition duration-500 ease-in-out"
              ><i class="fa fa-angle-left text-main-gray"></i
            ></a>
            <ul class="flex justify-start items-stretch">
              <li class="active">
                <a
                  @click="getData(links.self)"
                  class="bg-nav-gray-light block"
                  >{{ current_page }}</a
                >
              </li>
            </ul>
            <a
              v-if="links.next"
              @click="getData(links.next)"
              class="arrow-right blockborder-nav-gray-light border rounded-r-md hover:border-main-gray-light transition duration-500 ease-in-out"
              ><i class="fa fa-angle-right text-main-gray"></i
            ></a>
            
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
import { Schedules } from "../types/schedules";

export default defineComponent({
  name: "TimeTablesComponent",
  components: {
    HeaderComponent
  },
  setup() {
    const schedules = ref<Schedules[]>([]);
    const links = ref<object>({});
    const current_page = ref<number>(0);
    return { schedules, links, current_page };
  },
  mounted() {
    this.getData("/api/v1/timetables");
  },
  methods: {
    onNavigate(url: string): void {
      this.$router.push(url);
    },
    getData(url: string) {
      const auth = localStorage.getItem("token");
      const vm = this;
      vm.schedules = [];
      axios
        .get(url, {
          headers: {
            "Content-Type": "application/vnd.api+json",
            Accept: "application/vnd.api+json",
            Authorization: "Bearer " + auth
          }
        })
        .then(function (response: any) {
          response.data.data.forEach((item: any) => {
            const itemData = {
              id: item.id,
              name: item.attributes.name,
              where_address: item.attributes.where_address,
              trips: item.attributes.trips,
              status: item.attributes.status.description
            };
            vm.schedules.push(itemData);
          });
          vm.links = Object.assign({}, response.data.links);
          vm.current_page = response.data.meta.pagination.current_page;
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }
});
</script>
