<template>
  <!-- <o-modal v-model:active="confirmDeleteActive">
    <p class="p-4">Are you sure you want to delete the record?</p>

    <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
      <o-button variant="danger" @click="deletePost">Delete</o-button>
      <o-button @click="confirmDeleteActive = false">Cancel</o-button>
    </div>
  </o-modal> -->

  <confirmation-modal :show="confirmDeleteActive">
    <template v-slot:title> Confirmation </template>


    <template v-slot:content>
      <p class="p-4">Are you sure you want to delete the record?</p>
    </template>


    <template v-slot:footer>
      <o-button variant="danger" @click="deletePost">Delete</o-button>
      <div class="mr-3"></div>
      <o-button @click="confirmDeleteActive = false">Cancel</o-button>
    </template>
  </confirmation-modal>


  <app-layout>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <Link class="link-button-default my-3" :href="route('post.create')">Create</Link>

          <table class="w-full border">
            <thead class="bg-gray-100">
              <tr class="border-b">
                <th class="p-3">Id</th>
                <th class="p-3">Title</th>
                <th class="p-3">Slug</th>
                <th class="p-3">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b" v-for="p in posts.data" :key="p.id">
                <td class="p-2">{{ p.id }}</td>
                <td class="p-2">{{ p.title }}</td>
                <td class="p-2">{{ p.slug }}</td>
                <td class="p-2">
                  <Link class="text-sm text-purple-400 hover:text-purple-700" :href="route('post.edit', p.id)">Edit</Link>
                  <!-- <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2"
                    :href="route('post.destroy', p.id)">Delete</Link> -->
                  <o-button iconLeft="delete" rounded size="small" variant="danger" @click="
                    confirmDeleteActive = true;
                  deletePostRow = p.id;
                                                                                                                        ">
                    Delete
                  </o-button>

                </td>
              </tr>
            </tbody>
          </table>
          <pagination class="my-4" :links="posts" />
        </div>
      </div>
    </div>
  </app-layout>
</template>
  
  
<script>
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";

import Pagination from "@/Shared/Pagination.vue";


export default {
  data() {
    return {
      confirmDeleteActive: false,
      deletePostRow: "",
    };
  },
  methods: {
    deletePost() {
      router.delete(route("post.destroy", this.deletePostRow));
      this.confirmDeleteActive = false;
    },
  },
  components: {
    AppLayout,
    Link,
    Pagination,
    ConfirmationModal,
    Modal
  },
  props: {
    posts: Object,
  },
};
</script>
  