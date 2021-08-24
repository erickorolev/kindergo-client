<template>
  <div class="s-page overflow-hidden">
    <header-component />
    <div class="s-about py-8 pb-16">
      <div class="container mx-auto">
        <div class="border-b border-black pt-4">
          <h2 class="text-black text-2xl">Информация о поездке</h2>
        </div>
        <ul class="s-about-info text-black pt-8 flex flex-wrap">
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Откуда</div>
            <div class="w-3/6">{{ trip.name }}</div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Куда</div>
            <div class="w-3/6">{{ trip.where_address }}</div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Дата отправления</div>
            <div class="w-3/6">
              {{
                ("0" + new Date(trip.date).getDate()).substr(-2) +
                " " +
                ("0" + (new Date(trip.date).getMonth() + 1)).substr(-2) +
                " " +
                new Date(trip.date).getFullYear()
              }}
            </div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Время отправления</div>
            <div class="w-3/6">{{ trip.time.substr(0, 5) }}</div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Количество детей</div>
            <div class="w-3/6">{{ trip.childrens }}</div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Статус</div>
            <div class="w-3/6">{{ trip.status }}</div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Стоимость <br />парковки (руб)</div>
            <div class="w-3/6">{{ trip.parking_fee }}</div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Сопровождающий
            </div>
            <div class="w-3/6">
              <a
                :href="trip.attendant.url.replace(base_url, '#')"
                class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ trip.attendant.name }}</a
              >
            </div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Ребенок 1
            </div>
            <div class="w-3/6">
              <a
                :href="trip.child1.url.replace(base_url, '#')"
                class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ trip.child1.name }}</a
              >
            </div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Ребенок 3
            </div>
            <div class="w-3/6">
              <a
                :href="trip.child3.url.replace(base_url, '#')"
                class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ trip.child3.name }}</a
              >
            </div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Ребенок 2
            </div>
            <div class="w-3/6">
              <a
                :href="trip.child2.url.replace(base_url, '#')"
                class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ trip.child2.name }}</a
              >
            </div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">
              Ребенок 4
            </div>
            <div class="w-3/6">
              <a
                :href="trip.child4.url.replace(base_url, '#')"
                class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ trip.child4.name }}</a
              >
            </div>
          </li>
        </ul>
        <ul v-if="showParam" class="s-about-info text-black md:w-1/2 w-full">
          <li class="flex mb-6">
            <div class="font-bold w-3/6">Расписание</div>
            <div class="w-3/6">
              <a
                :href="trip.schedule.url.replace(base_url, '#')"
                class="text-breadcrumb-blue border-b border-transparent hover:border-breadcrumb-blue transition duration-500 ease-in-out"
                >{{ trip.schedule.name }}</a
              >
            </div>
          </li>
          <li class="flex mb-6">
            <div class="font-bold w-3/6">
              <div class="max-w-10">
                Незапланированное ожидание в точке "Куда" (мин)
              </div>
            </div>
            <div class="w-3/6">{{ trip.scheduled_wait_where }}</div>
          </li>
          <li class="flex mb-6">
            <div class="font-bold w-3/6">
              <div class="max-w-10">
                Незапланированное ожидание в точке "Откуда" (мин)
              </div>
            </div>
            <div class="w-3/6">{{ trip.scheduled_wait_from }}</div>
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
import { Trip } from "../types/trips";
import { base_url } from "../data";

export default defineComponent({
  name: "TripComponent",
  components: {
    HeaderComponent
  },
  setup() {
    const showParam = ref<boolean>(false);
    const trip = ref<Trip>({
      name: "",
      where_address: "",
      date: "",
      time: "",
      status: "",
      childrens: 0,
      parking_fee: 0,
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
      attendant: {
        name: "",
        url: ""
      },
      schedule: {
        name: "",
        url: ""
      },
      scheduled_wait_where: 0,
      scheduled_wait_from: 0
    });
    return { showParam, trip, base_url };
  },
  mounted() {
    const auth = localStorage.getItem("token");
    const vm = this;
    const currentUrl = window.location.hash;
    let timetables: Array<any> = [];
    let attendants: Array<any> = [];
    let children: Array<any> = [];
    axios
      .get(
        `/api/v1/${currentUrl.replace(
          "#/",
          ""
        )}?include=timetable,attendant,children`,
        {
          headers: {
            "Content-Type": "application/vnd.api+json",
            Accept: "application/vnd.api+json",
            Authorization: "Bearer " + auth
          }
        }
      )
      .then(function (response: any) {
        response.data.included.forEach((item: any) => {
          if (item && item.type === "timetables") {
            timetables.push(item);
          }
          if (item && item.type === "attendants") {
            attendants.push(item);
          }
          if (item && item.type === "children") {
            children.push(item);
          }
        });
        vm.trip.name = response.data.data.attributes.name;
        vm.trip.where_address = response.data.data.attributes.where_address;
        vm.trip.date = response.data.data.attributes.date;
        vm.trip.time = response.data.data.attributes.time;
        vm.trip.status = response.data.data.attributes.status.description;
        vm.trip.childrens = response.data.data.attributes.childrens;
        vm.trip.parking_fee = response.data.data.attributes.parking_cost.value;
        vm.trip.child1 =
          children.length > 0
            ? {
                name:
                  children[0].attributes.firstname +
                  " " +
                  children[0].attributes.lastname,
                url: children[0].links.self
              }
            : { name: "", url: "" };
        vm.trip.child2 =
          children.length > 1
            ? {
                name:
                  children[1].attributes.firstname +
                  " " +
                  children[1].attributes.lastname,
                url: children[1].links.self
              }
            : { name: "", url: "" };
        vm.trip.child3 =
          children.length > 3
            ? {
                name:
                  children[3].attributes.firstname +
                  " " +
                  children[3].attributes.lastname,
                url: children[3].links.self
              }
            : { name: "", url: "" };
        vm.trip.child4 =
          children.length > 4
            ? {
                name:
                  children[4].attributes.firstname +
                  " " +
                  children[4].attributes.lastname,
                url: children[4].links.self
              }
            : { name: "", url: "" };
        vm.trip.schedule =
          timetables.length > 0
            ? {
                name: timetables[0].attributes.name,
                url: timetables[0].links.self
              }
            : { name: "", url: "" };
        vm.trip.attendant =
          timetables.length > 0
            ? {
                name:
                  attendants[0].attributes.firstname +
                  " " +
                  attendants[0].attributes.lastname,
                url: attendants[0].links.self
              }
            : { name: "", url: "" };
        vm.trip.scheduled_wait_where =
          response.data.data.attributes.scheduled_wait_where;
        vm.trip.scheduled_wait_from =
          response.data.data.attributes.scheduled_wait_from;
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
