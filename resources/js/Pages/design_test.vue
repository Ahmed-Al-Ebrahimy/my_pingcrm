<template>
    <app-layout>
        <div class="py-2 px-1 flex flex-col lg:flex-row">
            <div class="px-2 sm:px-4 md:px-6   flex w-full sm:w-3/4 md:w-2/3  lg:w-2/4 sm:mr-0 mr-2 mb-2 lg:mb-0">
                <div class="bg-banafsagy-600 overflow-hidden rounded-md border-2 border-red-500 ">

                    <div v-if="patient.visits.length>0 && moment(patient.visits[0].created_at).format('YYYY-MM-DD') == moment().format('YYYY-MM-DD')" class="p-2 shadow-lg  rounded-md  overflow-y-auto  max-h-96">
                        <div class="mb-1 normal-case flex justify-center  bg-indigo-900 rounded-md rounded-b-none  p-0  shadow-lg text-gray-100">
                            <span class="p-1">تحاليل مراجعة اليوم الخاصة ب ( {{(patient.name)}} )</span>
                        </div>
                    <div class="mb-2 border-2 border-gray-300 rounded-md">
                        <div class="normal-case flex justify-center  bg-indigo-800 rounded-md rounded-b-none  p-0  shadow-lg text-gray-100">
                            <span class="p-1">Test of todays Vist {{moment(patient.visits[0].created_at).format('YYYY-MM-DD')}}</span>
                        </div>
                        <form  :id="patient.visits[0].id" @submit.prevent="submit(patient.visits[0].id)">
                        <div class="bg-indigo-400 rounded-md">
                            <div class="grid grid-cols-4 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative p-px" v-for="(t, i) in tests" :key="i">
                                    <div class="w-1/2 flex">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded-md rounded-r-none border border-gray-500 p-1 h-7 whitespace-no-wrap text-grey-dark text-sm">{{t.name}}  </span>
                                    </div>
                                    <input autocomplete="off" :name="t.id" :value="(patient.visits[0].tests.findIndex(test => test.pivot.test_id === t.id) >=0 ) ?  patient.visits[0].tests[patient.visits[0].tests.findIndex(test => test.pivot.test_id === t.id)].pivot.value : ''"
                                     type="text" class="rounded-md bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-7 p-1 border-gray-500   rounded-l-none relative ">
                                </div>
                            </div>
                        </div>
                         <div class="py-2 bg-indigo-800  rounded-t-none rounded-md grid grid-cols-4 justify-items-stretch ">
                            <div class="flex justify-start items-center pl-2 pr-4">
                                <loading-button :loading="sending" class="bg-green-500 px-2 py-1 rounded-md text-gray-200 whitespace-no-wrap hover:bg-green-600 focus:bg-green-600" type="submit">
                                    Update Patient
                                </loading-button>
                            </div>
                            <div></div>
                            <div class="flex justify-self-start items-center">
                                <inertia-link :href="route('laboratory')" class="bg-red-500 px-2 py-1 rounded-md text-gray-200 whitespace-no-wrap hover:bg-red-600 focus:bg-red-600">
                                    Cancel & Back
                                </inertia-link>
                            </div>
                        </div>
                   <!-- here buttons -->
                    </form>
                    </div>
                    </div>
                    <div v-else class="rtl bg-banafsagy-900 p-2 shadow-lg  rounded-md  overflow-y-auto h-full">
                      <div class="mb-1 normal-case flex justify-center  bg-indigo-900 rounded-md rounded-b-none  p-0  shadow-lg text-gray-300">
                            <span class="p-1">تحاليل مراجعة اليوم الخاصة ب ( {{(patient.name)}} )</span>
                      </div>

                        <div class="mb-1 normal-case flex justify-center  bg-indigo-900 rounded-md rounded-t-none p-0  shadow-lg text-red-600">
                            <span class="p-1"> مراجعة اليوم غير موجودة, الرجاء ارشاد المريض الى وحدة ادخال البيانات لتسجيل بياناته وفتح مراجعة اليوم
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-2 sm:px-4 md:px-6  flex w-full  sm:w-1/4 md:w-2/3 lg:w-2/4 mr-2 mb-2 lg:mb-0">

                <div class="bg-banafsagy-600 overflow-hidden rounded-md border-2 border-red-500   overflow-y-auto  max-h-screen">
                    <div v-if="patient.visits.length>0" class="p-2 shadow-lg  rounded-md">
                     <div class="mb-1 normal-case flex justify-center  bg-indigo-900 rounded-md rounded-b-none  p-0  shadow-lg text-gray-100">
                            <span class="p-1">تحاليل المراجعات السابقة</span>
                      </div>

                    <div v-if="moment(visit.created_at).format('YYYY-MM-DD') != moment().format('YYYY-MM-DD')"
                        v-for="(visit, index) in patient.visits" :key="index" class="mb-2 border-2 border-gray-300 rounded-md">
                        <div  class="normal-case flex justify-center  bg-indigo-800 rounded-md rounded-b-none  p-0  shadow-lg text-gray-100">
                            <span class="p-1">Tests of Vist {{patient.visits.length - index}} on {{moment(visit.updated_at).format('YYYY-MM-DD')}}</span>
                        </div>
                        <form  :id="visit.id" @submit.prevent="submit(visit.id)">
                        <div class="bg-indigo-400 rounded-md">
                            <div class="grid grid-cols-4 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative p-px" v-for="(t, i) in tests" :key="i">
                                    <div class="w-1/2 flex">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded-md rounded-r-none border border-gray-500 p-1 h-7 whitespace-no-wrap text-grey-dark text-sm">{{t.name}}  </span>
                                    </div>
                                    <input autocomplete="off" :name="t.id" :value="(visit.tests.findIndex(test => test.pivot.test_id === t.id) >=0 ) ?  visit.tests[visit.tests.findIndex(test => test.pivot.test_id === t.id)].pivot.value : ''" type="text" class="rounded-md bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-7 p-1 border-gray-500   rounded-l-none relative ">
                                </div>
                            </div>
                        </div>
                         <div class="py-2 bg-indigo-800  rounded-t-none rounded-md grid grid-cols-4 justify-items-stretch ">
                            <div class="flex justify-start items-center pl-2 pr-4">
                                <loading-button :loading="sending" class="bg-green-500 px-2 py-1 rounded-md text-gray-200 whitespace-no-wrap hover:bg-green-600 focus:bg-green-600" type="submit">
                                    Update Tests
                                </loading-button>
                            </div>
                            <div class="flex justify-self-start items-center">
                                <!-- <inertia-link :href="route('laboratory')" class="bg-red-500 px-2 py-1 rounded-md text-gray-200 whitespace-no-wrap hover:bg-red-600 focus:bg-red-600">
                                    Cancel & Back
                                </inertia-link> -->
                            </div>
                        </div>
                   <!-- here buttons -->
                    </form>
                    </div>
                    </div>
                    <div v-else class="rtl bg-banafsagy-900 p-2 shadow-lg  rounded-md  overflow-y-auto h-full">
                        <div class="mb-1 normal-case flex justify-center  bg-indigo-900 rounded-md rounded-b-none  p-0  shadow-lg text-gray-300">
                            <span class="p-1">تحاليل المراجعات السابقة</span>
                        </div>

                        <div class="mb-1 normal-case flex justify-center  bg-indigo-900 rounded-md rounded-t-none p-0  shadow-lg text-red-600">
                            <span class="p-1"> لا توجد مراجعات سابقة..!!</span>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import Icon from '@/Shared/Icon'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    AppLayout,
    Welcome,
    LoadingButton,
    Icon,
  },
  props: {
    tests: Array,
    patient: Object,
    errors: Object,
  },
  data() {
    return {
        // name:               this.patient.name,
        // patient_id:         this.patient.id,
        // visit_id:            this.todays_visit.id,

        sending: false,
    }
  },
  methods: {

    submit(visit_id) {
            var form = document.getElementById(visit_id);
            var data = new FormData(form);
            data.append('visit_id', visit_id);
            data.append('_method', 'PUT');

        this.$inertia.post(this.route('laboratory.update', {patient: this.patient.id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },
  },
}
</script>
