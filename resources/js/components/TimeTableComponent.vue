<template>
  <div class="s-page overflow-hidden">
    <header-component />
    <div class="s-about py-8 pb-16">
      <div class="container mx-auto">
        <div class="border-b border-black pt-4">
          <h2 class="text-black text-2xl">Информация о расписании</h2>
        </div>
        <ul class="s-about-info text-black pt-8 flex flex-wrap">
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Откуда</div>
            <div class="w-3/6">{{ schedule.name }}</div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Куда</div>
            <div class="w-3/6">{{ schedule.where_address }}</div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Количество поездок</div>
            <div class="w-3/6">{{ schedule.trips }}</div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Количество детей</div>
            <div class="w-3/6">{{ schedule.children }}</div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Статус</div>
            <div class="w-3/6">{{ schedule.status }}</div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Время отправления</div>
            <div class="w-3/6">{{ schedule.time.substr(0, 5) }}</div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Оплачен ли счет</div>
            <div class="w-3/6">{{ schedule.bill_paid }}</div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Возраст детей</div>
            <div class="w-3/6">{{ schedule.childrens_age }}</div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Ребенок 1
            </div>
            <div class="w-3/6">
              <a
                @click="onNavigate(schedule.child1.url.replace(base_url, ''))"
                class="cursor-pointer text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ schedule.child1.name }}</a
              >
            </div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Ребенок 3
            </div>
            <div class="w-3/6">
              <a
                @click="onNavigate(schedule.child3.url.replace(base_url, ''))"
                class="cursor-pointer text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ schedule.child3.name }}</a
              >
            </div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Ребенок 2
            </div>
            <div class="w-3/6">
              <a
                @click="onNavigate(schedule.child2.url.replace(base_url, ''))"
                class="cursor-pointer text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ schedule.child2.name }}</a
              >
            </div>
          </li>
          <li class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Ребенок 4
            </div>
            <div class="w-3/6">
              <a
                @click="onNavigate(schedule.child4.url.replace(base_url, ''))"
                class="cursor-pointer text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ schedule.child4.name }}</a
              >
            </div>
          </li>
          <li class="block md:flex mb-6 md:w-3/4 w-full">
            <div class="font-bold w-2/6">
              Даты отправления
            </div>
            <div class="w-4/6">              
              {{("0" + new Date(schedule.date).getDate()).substr(-2) +
                "." +
                ("0" + (new Date(schedule.date).getMonth() + 1)).substr(-2) +
                "." +
                new Date(schedule.date).getFullYear()}}              
            </div>
          </li>
          <li class="block md:flex mb-6 md:w-3/4 w-full">
            <div class="font-bold w-2/6">
              Описание
            </div>
            <div class="w-4/6">
              <textarea
                name="info"
                cols="30"
                rows="10"
                class="block w-full border-0 outline-none h-28"
                v-model="schedule.description"
              ></textarea>
            </div>
          </li>
          <li class="block md:flex mb-6 md:w-3/4 w-full">
            <div class="font-bold w-2/6">
              Информация о парковке
            </div>
            <div class="w-4/6">
              <textarea
                name="info1"
                cols="30"
                rows="10"
                class="block w-full border-0 outline-none h-28"
                v-model="schedule.parking_info"
              ></textarea>
            </div>
          </li>
          <li v-if="showParam" class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Длительность маршрута (мин)</div>
            <div class="w-3/6">{{ schedule.duration }}</div>
          </li>
          <li v-if="showParam" class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              <div class="max-w-10">Дистанция маршрута (км)</div>
            </div>
            <div class="w-3/6">{{ schedule.distance }}</div>
          </li>
          <li v-if="showParam" class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              <div class="max-w-10">
                Запланированное ожидание в точке “Откуда” (мин)
              </div>
            </div>
            <div class="w-3/6">{{ schedule.scheduled_wait_from }}</div>
          </li>
          <li v-if="showParam" class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              <div class="max-w-10">
                Запланированное ожидание в точке “Куда” (мин)
              </div>
            </div>
            <div class="w-3/6">
              {{ schedule.scheduled_wait_where }}
            </div>
          </li>
          <li v-if="showParam" class="block md:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              <div class="max-w-10">Количество страховок</div>
            </div>
            <div class="w-3/6">{{ schedule.number_insurance }}</div>
          </li>
        </ul>
        <div class="mt-6">
          <a
            v-if="!showParam"
            @click="show(true)"
            class="cursor-pointer s-about-btn js-btn-more group relative inline-flex justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-btn-bg font-bold transition duration-500 ease-in-out hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-blue-400 text-sm border border-btn-border"
          >
            Показать все поля
          </a>
          <a
            v-if="showParam"
            @click="show(false)"
            class="cursor-pointer s-about-btn js-btn-more group relative inline-flex justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-btn-bg font-bold transition duration-500 ease-in-out hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-blue-400 text-sm border border-btn-border"
          >
            Скрыть все поля
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import HeaderComponent from "./HeaderComponent.vue";
import axios from "axios";
import { Schedule } from "../types/schedules";
import { base_url } from "../data";

export default defineComponent({
  name: "TimeTableComponent",
  components: {
    HeaderComponent
  },
  setup() {
    const showParam = ref<boolean>(false);
    const schedule = ref<Schedule>({
      name: "",
      where_address: "",
      trips: 0,
      children: 0,
      status: "",
      time: "",
      date: "",
      bill_paid: "",
      childrens_age: "",
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
      },
      description: "",
      parking_info: "",
      duration: 0,
      distance: 0,
      scheduled_wait_from: 0,
      scheduled_wait_where: 0,
      number_insurance: 0
    });
    return { showParam, schedule, base_url };
  },
  mounted() {
    const auth = localStorage.getItem("token");
    const vm = this;
    const currentUrl = this.$route.path;
    let children: Array<any> = [];
    axios
      .get(`/api/v1${currentUrl}?include=children`, {
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
        vm.schedule.name = response.data.data.attributes.name;
        vm.schedule.where_address = response.data.data.attributes.where_address;
        vm.schedule.date = response.data.data.attributes.date;
        vm.schedule.time = response.data.data.attributes.time;
        vm.schedule.status = response.data.data.attributes.status.description;
        vm.schedule.trips = response.data.data.attributes.trips;
        vm.schedule.children = response.data.data.attributes.childrens;
        vm.schedule.bill_paid = response.data.data.attributes.bill_paid
          ? "yes"
          : "No";
        vm.schedule.childrens_age = response.data.data.attributes.childrens_age;
        vm.schedule.child1 =
          children.length > 0
            ? {
                name:
                  children[0].attributes.firstname +
                  " " +
                  children[0].attributes.lastname,
                url: children[0].links.self
              }
            : { name: "", url: "" };
        vm.schedule.child2 =
          children.length > 1
            ? {
                name:
                  children[1].attributes.firstname +
                  " " +
                  children[1].attributes.lastname,
                url: children[1].links.self
              }
            : { name: "", url: "" };
        vm.schedule.child3 =
          children.length > 3
            ? {
                name:
                  children[3].attributes.firstname +
                  " " +
                  children[3].attributes.lastname,
                url: children[3].links.self
              }
            : { name: "", url: "" };
        vm.schedule.child4 =
          children.length > 4
            ? {
                name:
                  children[4].attributes.firstname +
                  " " +
                  children[4].attributes.lastname,
                url: children[4].links.self
              }
            : { name: "", url: "" };
        vm.schedule.description = response.data.data.attributes.description;
        vm.schedule.parking_info = response.data.data.attributes.parking_info;
        vm.schedule.duration = response.data.data.attributes.duration;
        vm.schedule.distance = response.data.data.attributes.distance;
        vm.schedule.scheduled_wait_from =
          response.data.data.attributes.scheduled_wait_from;
        vm.schedule.scheduled_wait_where =
          response.data.data.attributes.scheduled_wait_where;
      })
      .catch(function (error) {
        console.log(error);
      });
  },
  methods: {
    onNavigate(url: string): void {
      this.$router.push(url);
    },
    show(param: boolean): void {
      this.showParam = param;
    }
  }
});
</script>
