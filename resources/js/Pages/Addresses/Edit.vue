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
            <h2 class="mt-12 font-bold text-2xl">Patients</h2>
            <div class="mt-6 bg-white rounded shadow overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">Name</th>
                <th class="px-6 pt-6 pb-4">Birth_date</th>
                <th class="px-6 pt-6 pb-4" colspan="2">Gender</th>
                </tr>
                <tr v-if="address.patients[0]" v-for="patient in address.patients" :key="patient.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                <td class="border-t">
                    <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('patients.edit', patient.id)">
                    {{ patient.name }}
                    <icon v-if="patient.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-6 py-4 flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                    {{ patient.city }}
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-6 py-4 flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                    {{ patient.phone }}
                    </inertia-link>
                </td>
                <td class="border-t w-px">
                    <inertia-link class="px-4 flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                    <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                    </inertia-link>
                </td>
                </tr>
                <tr v-else>
                <td class="border-t px-6 py-4" colspan="4">No patients found.</td>
                </tr>
            </table>
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
