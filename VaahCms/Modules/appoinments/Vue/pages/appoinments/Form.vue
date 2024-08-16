<script setup>
import {onMounted, ref, watch} from "vue";
import {useDoctorPatientAppoinmentStore} from '../../stores/store-doctorpatientappoinments'

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';


const store = useDoctorPatientAppoinmentStore();
const route = useRoute();

onMounted(async () => {
    /**
     * Fetch the record from the database
     */
    if ((!store.item || Object.keys(store.item).length < 1)
        && route.params && route.params.id) {
        await store.getItem(route.params.id);
    }

    await store.getFormMenu();
});
const handleDateChange = (newDate, property) => {
    if (newDate && store.item[property] !== undefined) {
        store.item[property] = new Date(newDate.getTime() - newDate.getTimezoneOffset() * 60000);
    }
    console.log(property, store.item[property]);
};
//--------form_menu
const form_menu = ref();
const toggleFormMenu = (event) => {
    form_menu.value.toggle(event);
};
//--------/form_menu
const today_date = ref(new Date());
const isValidTime = (date) => date instanceof Date && !isNaN(date.getTime());

</script>
<template>

    <div class="col-6">

        <Panel class="is-small">

            <template class="p-1" #header>


                <div class="flex flex-row">
                    <div class="p-panel-title">
                        <span v-if="store.item && store.item.id">
                            Update Appointment
                        </span>
                        <span v-else>
                            Create Appointment
                        </span>
                    </div>

                </div>


            </template>

            <template #icons>
                <div class="p-inputgroup">

                    <Button class="p-button-sm"
                            v-tooltip.left="'View'"
                            v-if="store.item && store.item.id"
                            data-testid="doctorpatientappoinments-view_item"
                            @click="store.toView(store.item)"
                            icon="pi pi-eye"/>

                    <Button label="Save"
                            class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="doctorpatientappoinments-save"
                            @click="store.itemAction('save')"
                            icon="pi pi-save"/>

                    <Button label="Create an Appointment"
                            v-else
                            @click="store.itemAction('create-and-new')"
                            class="p-button-sm"
                            data-testid="doctorpatientappoinments-create-and-new"
                            icon="pi pi-save"/>


                    <!--form_menu-->
<!--                    <Button-->
<!--                        type="button"-->
<!--                        @click="toggleFormMenu"-->
<!--                        class="p-button-sm"-->
<!--                        data-testid="appoinments-form-menu"-->
<!--                        icon="pi pi-angle-down"-->
<!--                        aria-haspopup="true"/>-->

<!--                    <Menu ref="form_menu"-->
<!--                          :model="store.form_menu_list"-->
<!--                          :popup="true"/>-->
                    <!--/form_menu-->


                    <Button class="p-button-primary p-button-sm"
                            icon="pi pi-times"
                            data-testid="doctorpatientappoinments-to-list"
                            @click="store.toList()">
                    </Button>
                </div>


            </template>


            <div v-if="store.item" class="mt-2">

                <Message severity="error"
                         class="p-container-message mb-3"
                         :closable="false"
                         icon="pi pi-trash"
                         v-if="store.item.deleted_at">

                    <div class="flex align-items-center justify-content-between">

                        <div class="">
                            Deleted {{ store.item.deleted_at }}
                        </div>

                        <div class="ml-3">
                            <Button label="Restore"
                                    class="p-button-sm"
                                    data-testid="articles-item-restore"
                                    @click="store.itemAction('restore')">
                            </Button>
                        </div>

                    </div>

                </Message>

                <VhField label="Select Patient">
                    <Dropdown
                        filter
                        name="items-patient"
                        data-testid="items-patient"
                        placeholder="Select Patient"
                        :options="store.assets.patients"
                        v-model="store.item.patient_id"
                        option-label="name"
                        class="w-full"
                        showClear
                        option-value="id"
                    />
                </VhField>
                <VhField label="Select Doctor">
                    <Dropdown
                        filter
                        name="items-doctor"
                        data-testid="items-doctor"
                        placeholder="Select Doctor"
                        :options="store.assets.doctor"
                        v-model="store.item.doctor"
                        option-label="name"
                        class="w-full"
                        showClear
                    />
                </VhField>
                <VhField label="Doctor Details"  v-if="store.item.doctor" >
   <b>
       Email-
   </b> {{store.item.doctor?.email}}<br>
                    <b>Phone</b>
        - {{store.item.doctor?.phone}}<br>
    <b>Specialization
        </b>- {{store.item.doctor?.specialization}}<br>
                    <b>
Shift Time-</b>

                    {{store.item?.doctor?.shift_start_time}} -
                    {{store.item?.doctor?.shift_end_time}}
    (Please Select the time in the given time slot).

                </VhField>
                <VhField label="Date and Time" required>
                    <div class="p-inputgroup">
                        <Calendar
                            name="items-date"
                            date-format="yy-mm-dd"
                            :showIcon="true"
                            :minDate="today_date"
                            data-testid="items-date"
                            @date-select="handleDateChange($event,'date')"
                            v-model="store.item.date "
                            :pt="{
                                  monthPicker:{class:'w-15rem'},
                                  yearPicker:{class:'w-15rem'}
                              }"
                            placeholder="Select Appointment Date"
                        />
                        <Calendar
                            v-model="store.item.slot_start_time"
                            :pt="{
                                  monthPicker:{class:'w-15rem'},
                                  yearPicker:{class:'w-15rem'}
                              }"
                            time-only
                            placeholder="Appointment Start Time"
                        />
                        <Calendar
                            v-model="store.item.slot_end_time"
                             :minDate="isValidTime(store.item.slot_start_time) ? store.item.slot_start_time : null"
                            :pt="{
                                  monthPicker:{class:'w-15rem'},
                                  yearPicker:{class:'w-15rem'}
                              }"
                            time-only
                            placeholder="Appointment End Time"
                        />
                    </div>
                </VhField>
                <VhField label="Is Active">
                    <InputSwitch v-bind:false-value="0"
                                 v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 name="doctorpatientappoinments-active"
                                 data-testid="doctorpatientappoinments-active"
                                 v-model="store.item.is_active"/>
                </VhField>

            </div>
        </Panel>

    </div>

</template>
