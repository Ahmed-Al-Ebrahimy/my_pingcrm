<template>
 <app-layout>
<div>
<div class="mb-8 font-bold text-3xl">
    <h1 class=""> Edit address</h1>
</div>
<div class="bg-white rounded shadow overflow-hidden max-w-3xl">
    <form id="update_address" @submit.prevent="submit()">

    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
        <input type="text" v-model="form.name" class="pr-6 pb-8 w-full lg:w-1/2 border-b" placeholder="name"/>
        <div class="text-sm text-red-600 mt-1" required="required" v-if="errors.name">{{errors.name[0]}}</div>
    </div>
    <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
        <button v-if="!address.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete address</button>
        <!-- <button  class="btn-indigo" :loading="sending"  type="submit">Update address</button> -->
        <button :loading="sending"  type="submit" class="ml-1 bg-indigo-800  w-1/4 border border-pink-500 outline-none px-1 py-1 shadow-md  text-gray-300 hover:bg-indigo-900 rounded-md">Reset</button>

        <p v-if="sending"  class="text-sm text-black">hi test v is {{testv }}</p>
    </div>

    </form>
</div>
</div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'

import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    AppLayout,
    Welcome,
    LoadingButton,
  },
  props: {
    address: Object,
    errors: Object,
  },
  data() {
    return {
      form: {
        name: this.address.name,
      },
      sending: false,
    }
  },
  methods: {

    submit() {
        let data = new FormData();
        data.append('name', this.form.name);
        data.append('_method', 'PUT');

        this.$inertia.post(this.route('addresses.update', {address: this.address.id}), data, {
            onStart: () => this.sending = true,
            onFinish: () => this.sending = false,
         })
    },

    destroy() {
      if (confirm('Are you sure you want to delete this address?')) {
        this.$inertia.post(this.route('addresses.destroy', this.address.id))
      }
    },
  },
}
</script>
