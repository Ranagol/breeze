<template>

    <!-- HEAD component -->
    <Head>
        <!-- With this here we can dynamically change the app title, which is displayed in the
        Chrome tab. Also, the Head component is globally registered, so that is why we are not
        importing it into this component. -->
        <title>Home tab title</title>
    </Head>

    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>

    <v-card
        title="Page: HOME"
        text="This is content"
        class="p-6"
    ></v-card>

    <v-card
        class="mx-auto"
        max-width="600"
    >
        <VForm
            ref="refForm"
            @submit.prevent="submit"
            class="p-6"
            v-model="formValidity"
        >
            <VRow>
                <VCol
                    cols="12"
                    md="6"
                >
                    <VTextField
                        v-model="form.name"
                        label="Name"
                        :rules="[requiredValidator]"
                    />
                </VCol>

                <VCol
                    cols="12"
                    md="6"
                >
                    <VTextField
                        v-model="form.email"
                        label="Email"
                        :rules="[requiredValidator, emailValidator]"
                    />
                </VCol>

                <VCol cols="12">
                    <VBtn
                        type="submit"
                    >
                        Submit
                    </VBtn>
                </VCol>
            </VRow>
        </VForm>
    </v-card>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import type { VForm } from 'vuetify/components/VForm';
import { emailValidator, requiredValidator } from '@validators';
import { useForm } from '@inertiajs/vue3';//0-Importing the form helper
import { reactive } from 'vue';

const formValidity = ref(false);
// const name = ref('');
// const email = ref('');

//When using useForm() we do not need reactive() to create reactive data. useForm can do that too.
let form = useForm({
    name: '',
    email: '',
});


//This function will be triggered, when clicked on Submit button
const submit = () => {
    console.log('Triggered.');
    console.log('formValidity:', formValidity.value);//this will be true, if VForm validation is ok
    console.log('name:', form.name);
    console.log('email:', form.email);
    form.post('/users');//2-We use the form object from the data() for sending requests
}

</script>
