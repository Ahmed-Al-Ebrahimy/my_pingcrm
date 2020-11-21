<template>
    <app-layout>
        <div class="p-1 flex flex-col">
            <div class="w-full mb-4 border-4 border-gray-900">
                <form id="update_profile" @submit.prevent="submitProfileForm()">
                <div class="bg-white rounded shadow overflow-x-auto">

                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="bg-purple-900 text-gray-200">
                            <th width="20%" class="border border-yellow-300 px-1 py-1 text-center">Name</th>
                            <th width="10%" class="border border-yellow-300 px-1 py-1 text-center">BirthDate</th>
                            <th width="8%"  class="border border-yellow-300 px-1 py-1 text-center">Address</th>
                            <th width="8%"  class="border border-yellow-300 px-1 py-1 text-center">Gender</th>
                            <th width="8%"  class="border border-yellow-300 px-1 py-1 text-center">marital</th>
                            <th width="8%"  class="border border-yellow-300 px-1 py-1 text-center">smoking</th>
                            <th width="10%" class="border border-yellow-300 px-1 py-1 text-center">Education</th>
                            <th width="10%" class="border border-yellow-300 px-1 py-1 text-center">Occupation</th>
                            <th width="10%" class="border border-yellow-300 px-1 py-1 text-center">DMFH</th>
                            <th width="10%" class="border border-yellow-300 px-1 py-1 text-center">Created_at</th>
                        </tr>
                    </thead>
                    <tr class="font-medium text-gray-800">

                         <td class="border border-yellow-300">
                            <input v-model="form.name"  type="text" class="rtl w-full bg-yellow-100 px-1">
                        </td>
                         <td class="border border-yellow-300">
                            <input v-model="form.birth_date"  type="text" class="w-full bg-yellow-100 px-1">
                        </td>
                         <td class="border border-yellow-300">
                            <select v-model="form.address_id" class="w-full bg-yellow-100 px-1">
                                <option v-for="(address, i) in addresses" :key="i"  :value="address.id" >{{address.name}}</option>
                            </select>
                        </td>
                         <td class="border border-yellow-300">
                            <select v-model="form.gender"  class="w-full bg-yellow-100 px-1">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </td>

                        <td class="border border-yellow-300">
                            <select v-model="form.marital" class="w-full bg-yellow-100 px-1">
                                <option value="1">اعزب</option>
                                <option value="2">متزوج</option>
                                <option value="3">ارمل</option>
                                <option value="4">مطلق</option>
                            </select>
                        </td>

                        <td class="border border-yellow-300">
                            <select v-model="form.smoking" class="w-full bg-yellow-100 px-1" @change="submitProfileForm()">
                                <option value="1">Smoker</option>
                                <option value="2">Non-Smoker</option>
                                <option value="3">Ex-Smoker</option>
                            </select>
                        </td>

                        <td class="border  border-yellow-300">
                            <select v-model="form.educationlevel_id" class="w-full bg-yellow-100 px-1">
                                <option v-for="(education, i) in educationlevels" :key="i"  :value="education.id" >{{education.name}}</option>
                            </select>
                        </td>

                        <td class="border border-yellow-300">
                            <select v-model="form.occupation_id" class="w-full bg-yellow-100 px-1">
                                <option v-for="(occupation, i) in addresses" :key="i"  :value="occupation.id" >{{occupation.name}}</option>
                            </select>
                        </td>
                        <td class="border border-yellow-300">
                            <select v-model="form.fh_of_dm" class="w-full bg-yellow-100 px-1">
                                <option value="1">Positive</option>
                                <option value="2">Negative</option>
                            </select>
                        </td>

                        <td class="border border-yellow-300 bg-yellow-100 px-1">
                            {{moment(patient.created_at).format('YYYY-MM-DD')}}
                        </td>

                    </tr>
                    <tr v-if="!patient">
                        <td class="border-t px-6 py-4" colspan="6">No patient found.</td>
                    </tr>
                </table>
                </div>


                <div class="flex  w-full">
                    <div class="w-1/3 bg-purple-700">

                        <div class="flex mb-1">
                            <span  class="flex  w-1/2 px-1 bg-gray-400">systolic_bp</span>
                            <input class="flex  w-1/4 px-1 bg-gray-200" @change="submitProfileForm()" v-model="form.systolic_bp">
                        </div>

                        <div class="flex mb-1">
                            <span  class="flex  w-1/2 px-1 bg-gray-400">diastolic_bp</span>
                            <input class="flex  w-1/4 px-1 bg-gray-200" @change="submitProfileForm()" v-model="form.diastolic_bp">
                        </div>

                        <div class="flex mb-1">
                            <span  class="flex w-1/2 px-1 bg-gray-400">height</span>
                            <input class="flex w-1/4 px-1 bg-gray-200" @change="submitProfileForm()" v-model="form.height">
                        </div>

                        <div class="flex">
                            <span  class="flex w-1/2 px-1 bg-gray-400">weight</span>
                            <input class="flex w-1/4 px-1 bg-gray-200" @change="submitProfileForm()" v-model="form.weight">
                        </div>


                    </div>

                    <div class="flex flex-lg-grow-1 mr-1 ml-1 w-full p-1 bg-purple-800">2</div>
                    <div class="flex flex-lg-grow-1 w-full p-1 bg-purple-900">3</div>
                </div>

            </form>
            </div>



        <div class="flex border-2 w-full border-red-600">

            <div class="flex flex-lg-grow-1 w-full w mr-1 bg-purple-700">
                <div class="bg-banafsagy-600 overflow-hidden rounded-md rounded-t-none  border-2 border-red-500  overflow-y-auto  max-h-screen">
                    <div v-if="patient.visits.length>0" class="p-2 shadow-lg  rounded-md">
                    <div class="mb-2 border-2 border-gray-300 rounded-md">
                        <div  class="normal-case flex justify-center  bg-indigo-800 rounded-md rounded-b-none  p-0  shadow-lg text-gray-100">
                            <span class="p-1">Tests of Vist {{patient.visits.length - visitsIndex}} on {{moment(patient.visits[visitsIndex].updated_at).format('YYYY-MM-DD')}}</span>
                        </div>
                        <form  :id="patient.visits[visitsIndex].id" @submit.prevent="submitTestsForm(patient.visits[visitsIndex].id)">
                        <div class="bg-indigo-400 rounded-md">
                            <div class="grid grid-cols-5 p-1">
                                <div class="flex flex-wrap items-stretch w-full relative p-px" v-for="(t, i) in tests" :key="i">
                                    <div class="w-1/2 flex">
                                        <span class="w-full flex items-center leading-normal bg-gray-400 rounded-md rounded-r-none border border-gray-500 p-1 h-7 whitespace-no-wrap text-grey-dark text-sm">{{t.name}}  </span>
                                    </div>
                                    <input @change="submitTestsForm(patient.visits[visitsIndex].id)" autocomplete="off" :name="t.id" :value="(patient.visits[visitsIndex].tests.findIndex(test => test.pivot.test_id === t.id) >=0 ) ?  patient.visits[visitsIndex].tests[patient.visits[visitsIndex].tests.findIndex(test => test.pivot.test_id === t.id)].pivot.value : ''" type="text" class="rounded-md bg-gray-200 flex-shrink focus:shadow-outline flex-grow flex-auto leading-normal w-px  border h-7 p-1 border-gray-500   rounded-l-none relative ">
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    </div>
                    <div v-else class="rtl bg-banafsagy-900 p-2 shadow-lg  rounded-md  overflow-y-auto h-full">
                        <div class="mb-1 normal-case flex justify-center  bg-indigo-900 rounded-md rounded-t-none p-0  shadow-lg text-red-600">
                            <span class="p-1"> لا توجد مراجعات ..!!</span>
                        </div>
                    </div>
                </div>


            </div>



            <div class="w-full bg-purple-800">
                <div class="flex p-1 justify-center">
                    <button class="flex rounded-full" @click="increaseIndex">
                        <icon name="leftArrow" class="block w-10 h-10 fill-gray-100" />
                    </button>

                    <button class="flex rounded-full" @click="reSetIndex">
                        <icon name="circle" class="block w-10 h-10 fill-gray-100" />
                    </button>

                    <button class="flex rounded-full" @click="decreseIndex">
                        <icon name="rightArrow" class="block w-10 h-10 fill-gray-100" />
                    </button>
                </div>

                <div>
                <input type="text" :value="patient.visits[visitsIndex].diastolic_bp">
                </div>


            </div>

            <div class="flex flex-lg-grow-1 w-full p-1 bg-purple-900">
               {{patient.visits[visitsIndex].diastolic_bp}}
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
    addresses: Array,
    educationlevels: Array,
    occupations: Array,
    types: Array,
    patient: Object,
    todays_visit: Object,
    errors: Object,

    tests: Array,
  },
  data() {
    return {

      form: {
        name:               this.patient.name,
        birth_date:         this.patient.birth_date,
        gender:             this.patient.gender,
        marital:            this.patient.marital,
        smoking:            this.patient.smoking,
        fh_of_dm:           this.patient.fh_of_dm,

        address_id:         this.patient.address_id,
        occupation_id:      this.patient.occupation_id,
        educationlevel_id:  this.patient.educationlevel_id,
        type_id:            this.patient.type_id,

        systolic_bp:        this.patient.systolic_bp,
        diastolic_bp:       this.patient.diastolic_bp,
        height:             this.patient.height,
        weight:             this.patient.weight,

      },
      sending: false,
      visitsIndex: 0 ,
      incresButton: true,
    }
  },
  methods: {

      increaseIndex(){
          if(this.visitsIndex < this.patient.visits.length - 1){
            this.visitsIndex ++;
          }
      },

    reSetIndex(){
          this.visitsIndex = 0;
      },

    decreseIndex(){
          if(this.visitsIndex > 0){
            this.visitsIndex --;
          }
      },

    submitProfileForm() {
        let data = new FormData();
        data.append('name', this.form.name);
        data.append('birth_date', this.form.birth_date);
        data.append('gender', this.form.gender);
        data.append('marital', this.form.marital);
        data.append('smoking', this.form.smoking);
        data.append('fh_of_dm', this.form.fh_of_dm);

        data.append('address_id', this.form.address_id);
        data.append('occupation_id', this.form.occupation_id);
        data.append('educationlevel_id', this.form.educationlevel_id);
        data.append('type_id', this.form.type_id);

        data.append('systolic_bp', this.form.systolic_bp);
        data.append('diastolic_bp', this.form.diastolic_bp);
        data.append('height', this.form.height);
        data.append('weight', this.form.weight);

        data.append('_method', 'PUT');

        this.$inertia.post(this.route('physician.updateProfile', {patient: this.patient.id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },


    submitTestsForm(visit_id) {
            var form = document.getElementById(visit_id);
            var data = new FormData(form);
            data.append('visit_id', visit_id);
            data.append('_method', 'PUT');

        this.$inertia.post(this.route('physician.updateTests', {patient: this.patient.id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },

    destroy() {
      if (confirm('Are you sure you want to delete this patient?')) {
        this.$inertia.post(this.route('patients.destroy', this.patient.id))
      }
    },
  },
}
</script>
