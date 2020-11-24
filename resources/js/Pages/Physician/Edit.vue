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

                <div v-if="patient.visits.length>0"  class="flex w-2/5 p-0.5 flex-lg-grow-1 bg-purple-900">
                    <form  :id="patient.visits[visitsIndex].id" @submit.prevent="submitTestsForm(patient.visits[visitsIndex].id)">
                        <div class="grid grid-cols-5">
                            <div class="flex p-0.5 " v-for="(t, i) in tests" :key="i">
                                <span  class="flex w-1/2 px-1 shadow-lg  bg-gray-400">{{t.name}}</span>
                                <input class="flex w-1/2 px-1 shadow-lg bg-gray-200" @change="submitTestsForm(patient.visits[visitsIndex].id)" autocomplete="off" :name="t.id" :value="(patient.visits[visitsIndex].tests.findIndex(test => test.pivot.test_id === t.id) >=0 ) ?  patient.visits[visitsIndex].tests[patient.visits[visitsIndex].tests.findIndex(test => test.pivot.test_id === t.id)].pivot.value : ''" type="text">
                            </div>
                        </div>
                    </form>
                </div>






                        <div class="bg-green-700 border border-red-700" style="width: 14%">
                            <div class="flex text-center bg-blue-600 shadow-lg  p-1">
                                <span class="flex w-1/3 lowercase text-gray-200">{{visitsIndex+1}} of {{patient.visits.length}}</span>
                                <span class="flex w-2/3 text-gray-200">{{moment(patient.visits[visitsIndex].created_at).format('YYYY-MM-DD')}}</span>
                            </div>
                            <div class="flex p-0.5 justify-center">
                                <button class="flex rounded-full mr-1 bg-blue-600 shadow-lg" @click="increaseIndex">
                                    <icon name="leftArrow" class="block w-10 h-10 fill-gray-100" />
                                </button>

                                <button class="flex rounded-full mr-1  bg-blue-600 shadow-lg" @click="reSetIndex">
                                    <icon name="circle" class="block w-10 h-10 fill-gray-100" />
                                </button>

                                <button class="flex rounded-full bg-blue-600 shadow-lg " @click="decreseIndex">
                                    <icon name="rightArrow" class="block w-10 h-10 fill-gray-100" />
                                </button>
                            </div>



                            <div class="flex p-0.5 justify-center">
                                <button class="flex mr-1 items-center justify-center px-4 py-1 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150" @click="newVisit">
                                    new
                                </button>

                                <button class="flex items-center justify-center px-4 py-1 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" @click="destroyVisit(patient.visits[visitsIndex].id)">
                                    delete
                                </button>
                            </div>




                            <form  id="visitFormOne" @submit.prevent="submitVisitFormOne(patient.visits[visitsIndex].id)">
                            <div class="grid grid-cols-1">

                                <div class="flex p-px">
                                    <span  class="flex w-2/3 px-px bg-gray-400">Systolic_bp</span>
                                    <input class="flex w-1/3 px-px bg-gray-200" type="text"  @change="submitVisitFormOne(patient.visits[visitsIndex].id)"
                                    name="systolic_bp" :value="(patient.visits[visitsIndex].systolic_bp)"
                                    >
                                </div>

                                <div class="flex p-px">
                                    <span  class="flex w-2/3  px-px bg-gray-400">Diastolic_bp</span>
                                    <input class="flex w-1/3  px-px bg-gray-200" type="text"  @change="submitVisitFormOne(patient.visits[visitsIndex].id)"
                                    name="diastolic_bp" :value="(patient.visits[visitsIndex].diastolic_bp)"
                                    >
                                </div>

                                <div class="flex p-px">
                                    <span  class="flex w-2/3 px-px bg-gray-400">Height</span>
                                    <input class="flex w-1/3 px-px bg-gray-200" type="text"  @change="submitVisitFormOne(patient.visits[visitsIndex].id)"
                                    name="height" :value="(patient.visits[visitsIndex].height)"
                                    >
                                </div>

                                <div class="flex p-px">
                                    <span  class="flex w-2/3 px-px bg-gray-400">Weight</span>
                                    <input class="flex w-1/3 px-px bg-gray-200" type="text"  @change="submitVisitFormOne(patient.visits[visitsIndex].id)"
                                    name="weight" :value="(patient.visits[visitsIndex].weight)"
                                    >
                                </div>
                            </div>
                             </form>
                        </div>

                        <div class="flex bg-blue-300 border flex-wrap  border-red-700" style="width: 23%">

                            <div class="flex justify-center bg-red-400 p-0.5 min-w-full" style="height:11%">
                                <span  class="flex w-1/5  justify-center bg-red-400 p-0.5">Rx</span>
                                <input class="flex w-w-3/5  justify-center bg-gray-200 p-0.5" type="text">
                                <button  class="flex w-1/5  justify-center bg-red-400 p-0.5">
                                    <icon name="printer" class="block w-6 h-6 fill-blue-500" />
                                </button>
                            </div>

                            <div class="flex p-0.5 h-8 w-full">

                                <span  class="flex shadow-lg  bg-blue-500 p-px py-0.5" style="width:76%">
                                    1-paracetamol tap 500mg
                                </span>

                                <select class="flex shadow-lg  bg-gray-200 p-px py-0.5" style="width:16%">
                                    <option value="1">BD</option>
                                    <option value="2">OD</option>
                                </select>

                                <button  class="flex justify-center bg-blue-500 p-px py-0.5" style="width:8%">
                                    <icon name="x-circle" class="block w-6 h-6 fill-red-600" />
                                </button>

                            </div>

                        </div>


                        <div class="flex bg-yellow-400 border border-red-700" style="width: 23%">
                            <form  id="visitFormTwo" @submit.prevent="submitVisitFormTwo(patient.visits[visitsIndex].id)">
                            <div class="flex justify-center bg-red-400 p-0.5" style="height:11%">
                              <span class="text-center">  clinial notes</span>
                            </div>
                            <div class="bg-black" style="height: 89%">
                                <textarea rows="10" cols="38" class="w-full h-full px-1 bg-gray-200"
                                name="notes" :value="(patient.visits[visitsIndex].notes)"
                                @change="submitVisitFormTwo(patient.visits[visitsIndex].id)"
                                ></textarea>
                                </div>
                            </form>
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

    //   visitForm: {
    //      notes: this.patient.visits[this.visitsIndex].notes
    //   },
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

        this.$inertia.post(this.route('physician.updateTests', {visit: visit_id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },


    submitVisitFormOne(visit_id) {
            var form = document.getElementById('visitFormOne');
            var data = new FormData(form);
            data.append('visit_id', visit_id);

        this.$inertia.post(this.route('physician.updateVisitFormOne', {visit: visit_id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },

    submitVisitFormTwo(visit_id) {
            var form = document.getElementById('visitFormTwo');
            var data = new FormData(form);
            data.append('visit_id', visit_id);

        this.$inertia.post(this.route('physician.updateVisitFormTwo', {visit: visit_id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },

    newVisit() {
      if (confirm('Are you sure you want to delete this patient?')) {
        this.$inertia.post(this.route('patients.destroy', this.patient.id))
      }
    },

    destroyVisit(visit_id) {
      if (confirm('Are you sure you want to delete this Visit?')) {
        this.$inertia.post(this.route('physician.destroyVisit', visit_id))
      }
    },
  },
}
</script>
