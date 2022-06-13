import { ref } from 'vue';
import axios from 'axios';

export default function questionService() {

    const question = ref({});
    const result = ref(null);
    const choice = ref(null);
    const isConnected = ref(false);

    const getQuestion = async () => {
        let response = await axios.get('/api/question');
        question.value = response.data.question;
        choice.value = null;
        result.value = null;
        isConnected.value = response.data.isConnected;
    }

    const answer = async (id, value) => {
        let response = await axios.post('/api/answer', {
            'questionId': id,
            'value': value
        });
        choice.value = value;
        result.value = response.data.stat.result * 100;
    }

    return {
        getQuestion,
        answer,
        question,
        result,
        choice,
        isConnected
    }

}