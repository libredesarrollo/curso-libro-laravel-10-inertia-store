<template>
    <contact-layout>
        <jet-form-section @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title> Create Contact </template>
            <template #description> Create Contact </template>
            <template #form>
                <div class="col-span-6">
                    <jet-label>Subject</jet-label>
                    <jet-input class="w-full" type="text" v-model="form.subject" />
                    <jet-input-error :message="errors.subject" />
                </div>

                <div class="col-span-6">
                    <jet-label value="Message" />
                    <textarea class="rounded-md w-full border-gray-300" v-model="form.message"></textarea>
                    <jet-input-error :message="errors.message" />
                </div>


                <div class="col-span-6">
                    <jet-label value="Type" />


                    <select class="rounded-md w-full border-gray-300" v-model="form.type">
                        <option value="company">Company</option>
                        <option value="person">Person</option>
                    </select>


                    <jet-input-error :message="errors.type" />
                </div>

            </template>
            <template #actions>
                <jet-button type="submit">Send</jet-button>
            </template>
        </jet-form-section>


    </contact-layout>
</template>
   
<script>
import { useForm, router } from "@inertiajs/vue3"

import ContactLayout from "@/Layouts/ContactLayout.vue";
import JetInput from "@/Components/TextInput.vue";
import JetInputError from "@/Components/InputError.vue";
import JetLabel from "@/Components/InputLabel.vue";
import JetButton from "@/Components/PrimaryButton.vue";
import JetDangerButton from "@/Components/DangerButton.vue";
import JetFormSection from "@/Components/FormSection.vue";
export default {
    components: {
        ContactLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetButton,
        JetDangerButton,
        JetFormSection,
    },
    props: {
        errors: Object,
        contact: {
            type: Object,
            default: {
                id: "",
                subject: "",
                message: "",
                type: "",
            },
        },
        categories: Object,
        dropFiles: []
    },
    setup(props) {
        const form = useForm({
            id: props.contact.id,
            subject: props.contact.subject,
            message: props.contact.message,
            type: props.contact.type,
        });
        function submit() {
            if (form.id == "") router.post(route("contact-general.store"), form);
            else
                router.post(route("contact-general.update", form.id), {
                    _method: "put",
                    subject: form.subject,
                    type: form.type,
                    message: form.message,
                    contact_general_id: props.contactGeneralId,
                });
        }
        return { form, submit };
    },


};
</script>
  