<template>
  <div class="s-page overflow-hidden">
    <header-component />
    <div class="s-about py-8 pb-16">
      <div class="container mx-auto">
        <div class="border-b border-black pt-4">
          <h2 class="text-black text-2xl">Информация о платеже</h2>
        </div>
        <ul class="s-about-info text-black pt-8 flex flex-wrap">
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Дата</div>
            <div class="w-3/6">
              {{
                ("0" + new Date(payment.pay_date).getDate()).substr(-2) +
                "." +
                ("0" + (new Date(payment.pay_date).getMonth() + 1)).substr(-2) +
                "." +
                new Date(payment.pay_date).getFullYear()
              }}
            </div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Статус</div>
            <div class="w-3/6">{{ payment.spstatus }}</div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Вид оплаты</div>
            <div class="w-3/6">{{ payment.type_payment }}</div>
          </li>
          <li class="block sm:flex mb-6 md:w-1/2 w-full">
            <div class="font-bold w-3/6">Сумма (руб)</div>
            <div class="w-3/6">{{ formatPrice(payment.amount) }}</div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import HeaderComponent from "./HeaderComponent.vue";
import axios from "axios";
import { Payment } from "../types/payments";

export default defineComponent({
  name: "PaymentComponent",
  components: {
    HeaderComponent
  },
  setup() {
    const showParam = ref<boolean>(false);
    const payment = ref<Payment>({
      pay_date: "",
      amount: 0,
      spstatus: "",
      type_payment: ""
    });
    return { showParam, payment };
  },
  mounted() {
    const auth = localStorage.getItem("token");
    const vm = this;
    const currentUrl = this.$route.path;
    axios
      .get(`/api/v1${currentUrl}`, {
        headers: {
          "Content-Type": "application/vnd.api+json",
          Accept: "application/vnd.api+json",
          Authorization: "Bearer " + auth
        }
      })
      .then(function (response: any) {
        vm.payment.pay_date = response.data.data.attributes.pay_date;
        vm.payment.amount = response.data.data.attributes.amount.value;
        vm.payment.spstatus =
          response.data.data.attributes.spstatus.description;
        vm.payment.type_payment =
          response.data.data.attributes.type_payment.description;
      })
      .catch(function (error) {
        console.log(error);
      });
  },
  methods: {
    show(param: boolean): void {
      this.showParam = param;
    },
    formatPrice(value:number): string {
      let val = (value/1).toFixed(2).replace('.', ',')
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
  }
});
</script>
