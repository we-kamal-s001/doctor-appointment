<script setup>
import {reactive, ref} from 'vue';

import Menu from 'primevue/menu';
import {useRoute} from 'vue-router';
const route = useRoute();

const inputs = {
}
const data = reactive(inputs);
const height = ref(window.innerHeight)

const menu = ref();

const menu_pt = ref({
  menuitem: ({ props }) => ({
    class: route.matched && route.matched[1] &&
    route.matched[1].path === props.item.route ? 'p-focus' : ''
  })
});

const items = ref([
    {
        label: 'appoinments',
        items: [
            {
                label: 'Dashboard',
                icon: 'fa-regular fa-chart-bar',
                route: "/"
            }, {
                label: 'Doctor',
                icon: 'fa-regular fa-chart-bar',
                route: "/doctors"
            },
            {
                label: 'Patient',
                icon: 'fa-regular fa-chart-bar',
                route: "/patients"
            },
            {
                label: 'Appointments',
                icon: 'fa-regular fa-chart-bar',
                route: "/appoinments"
            },
        ]
    },
]);

</script>
<template>

    <div v-if="height">
      <Menu :model="items"  class="w-full"
            :pt="menu_pt">
        <template #item="{ item, props }">
          <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
            <a v-ripple :href="href" v-bind="props.action" @click="navigate">
              <span :class="item.icon" />
              <span class="ml-2">{{ item.label }}</span>
            </a>
          </router-link>
          <a v-else v-ripple :href="item.url" :target="item.target" v-bind="props.action">
            <span :class="item.icon" />
            <span class="ml-2">{{ item.label }}</span>
          </a>
        </template>
      </Menu>
    </div>

</template>


