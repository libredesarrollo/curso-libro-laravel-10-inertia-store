
<template>
    <app-layout>
        <div class="container">
            <div class="card">
                <div class="card-body">

                    <Link class="link-button-default my-3" :href="route('category.create')" >Create</Link>

                    <table class="w-full border">
                        <thead class="bg-gray-100">
                            <th class="p-3">Id</th>
                            <th class="p-3">Title</th>
                            <th class="p-3">Slug</th>
                            <th class="p-3">Actions</th>
                        </thead>
                        <tbody>
                            <tr v-for="c in categories.data" :key="c.id">
                                <td class="p-2">{{ c.id }}</td>
                                <td class="p-2">{{ c.title }}</td>
                                <td class="p-2">{{ c.slug }}</td>
                                <td class="p-2">
                                    <Link class="text-sm text-purple-400 hover:text-purple-700"
                                        :href="route('category.edit', c.id)" >Edit</Link>
                                    <Link method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2"
                                        :href="route('category.destroy', c.id)" as="button" >Delete</Link>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <pagination :links="categories" />
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import { Link } from "@inertiajs/vue3"
import AppLayout from "@/Layouts/AppLayout.vue"

import Pagination from '@/Shared/Pagination.vue'

export default {
    components: {
        AppLayout,
        Link,
        Pagination
    },
    props: {
        categories: Object
    }
}
</script>