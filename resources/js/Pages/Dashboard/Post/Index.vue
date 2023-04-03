<template>
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
                    <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2" :href="route('post.destroy', p.id)">Delete</Link>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- <template v-for="l in categories.links" :key="l">
              <Link v-if="!l.active" class="px-2 py-1" :href="l.url" v-html="l.label"/>
              <span v-else class="px-2 py-1 cursor-pointer text-gray-500"  v-html="l.label"  />
          </template> -->
  
  
            <pagination class="my-4" :links="posts" />
          </div>
        </div>
      </div>
    </app-layout>
  </template>
  
  
  <script>
  import { Link } from "@inertiajs/vue3";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import Pagination from "@/Shared/Pagination.vue";
  
  
  export default {
    components: {
      AppLayout,
      Link,
      Pagination,
    },
    props: {
      posts: Object,
    },
  };
  </script>
  