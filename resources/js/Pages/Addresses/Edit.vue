<template>
    <app-layout>
        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('addresses')">addresses</inertia-link>
                <span class="text-indigo-400 font-medium">/</span>
                {{ form.name }}
            </h1>
            <!-- <trashed-message v-if="addresses.deleted_at" class="mb-6" @restore="restore">
            This addresses has been deleted.
            </trashed-message> -->

            <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
                <form id="update_address" @submit.prevent="submit()">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <input type="text" v-model="form.name" class="pr-6 pb-8 w-full lg:w-1/2 border-b" placeholder="name"/>
                    <div class="text-sm text-red-600 mt-1" required="required" v-if="errors.name">{{errors.name[0]}}</div>
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                    <button v-if="!address.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete address</button>
                    <loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">Update Address</loading-button>
                </div>
                </form>
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
