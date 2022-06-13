<template>
    <div class="row">
        <div class="col-8 mx-auto mt-5">
            <h1 class="text-center h-200">{{ question.content }}</h1>
            <div class="row justify-content-between" v-if="isConnected">
                <button type="button" class="btn btn-lg btn-success col-5" @click="answer(question.id, true)">Pour</button>
                <button type="button" class="btn btn-lg btn-danger col-5"  @click="answer(question.id, false)">Contre</button>
            </div>
            <div class="row alert alert-primary" v-else>
                <p class="text-center">Connecter vous pour voter</p>
            </div>
            <div class="row">
                <button class="btn btn-primary btn-lg my-3" type="button" v-on:click="getQuestion()">Autre question aléatoire</button>
            </div>
            <div class="row alert" v-bind:class="classResultColor" role="alert" v-show="result">
                <p class="text-center">{{ result }} % des personnes ont choisit {{ choiceResult }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, computed } from "vue";
    import questionService from '../services/questionService.js';

    const { getQuestion, answer, question, result, choice, isConnected } = questionService();

    onMounted(getQuestion());

    const classResultColor = computed(() => choice.value ? 'alert-success' : 'alert-danger');
    const choiceResult = computed(() => choice.value ? 'Pour' : 'Contre');
</script>

<style>

.h-200 {
    height: 200px;
}

</style>